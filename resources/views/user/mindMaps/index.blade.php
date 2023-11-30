@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content">
        <div id="jsmind_container" style="width:100%;height:500px;"></div>
        <div class="d-flex flex-column">
            <div class="mb-3">
                <button type="button" class="btn btn-outline-dark" id="add_button">追加</button>
                <button type="button" class="btn btn-outline-success" id="edit_button">編集</button>
                <button type="button" class="btn btn-outline-danger" id="remove_button">削除</button>
                <button type="button" class="btn btn-primary text-white" id="store_button">保存</button>
            </div>
            <div>
                <button type="button" class="btn btn-outline-secondary" id="chage_default">デフォルト</button>
                <button type="button" class="btn btn-outline-primary" id="change_orange">オレンジ</button>
                <button type="button" class="btn btn-outline-info" id="change_blue">ブルー</button>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script type="text/javascript">
    function load_jsmind(){
        const userId = @json(auth()->user()->id);

        mindMap = @json($mindMap);
        if (mindMap) {
            var mind = JSON.parse(mindMap.mind_data_json);
            
            var options = {
                container:'jsmind_container',
                editable:true,
                theme:'clouds',
                view:{
                    engine: 'svg',
                    node_overflow: 'wrap',
                    zoom: {             // 配置缩放
                        min: 0.1,       // 最小的缩放比例
                        max: 1.5,       // 最大的缩放比例
                        step: 0.1,      // 缩放比例间隔
                    },
                }
            }

            // ノードのスタイルを設定

    
            var jm = new jsMind(options);
            jm.show(mind);
    
            // 新しいノードを追加する関数
            function addNewNode() {
                var selected_node = jm.get_selected_node(); // 選択されたノードを取得
                if (!selected_node) {
                    alert('ノードを選択してください');
                    return;
                }
                var nodeid = jsMind.util.uuid.newid(); // 新しいノードのIDを生成
                var topic = '新しいノード ' + nodeid.substr(0, 5); // ノードのトピック
                var node = jm.add_node(selected_node, nodeid, topic); // ノードを追加
                jm.select_node(nodeid); // 追加したノードを選択
                jm.begin_edit(nodeid); // 追加したノードを編集状態にする
            }
            // ボタンをクリックしたら新しいノードを追加
            document.getElementById('add_button').addEventListener('click', addNewNode);
    
            // 選択したノードを編集する関数
            function editNode() {
                var selected_node = jm.get_selected_node(); // 選択されたノードを取得
                if (!selected_node) {
                    alert('ノードを選択してください');
                    return;
                }
                jm.begin_edit(selected_node); // 選択したノードを編集状態にする
            }
            // ボタンをクリックしたら選択したノードを編集
            document.getElementById('edit_button').addEventListener('click', editNode);
    
            // 選択したノードを削除する関数
            function removeNode() {
                var selected_node = jm.get_selected_node(); // 選択されたノードを取得
                if (!selected_node) {
                    alert('ノードを選択してください');
                    return;
                }
                jm.remove_node(selected_node); // ノードを削除
            }
            // ボタンをクリックしたら選択したノードを削除
            document.getElementById('remove_button').addEventListener('click', removeNode);
    
            // マインドマップを保存する関数
            function storeMindMap() {
                var mindData = jm.get_data(); // マインドマップのデータを取得
    
                var mindDataJson = JSON.stringify(mindData); // マインドマップのデータをJSON形式に変換
                
                // マインドマップのデータを送信
                axios.post('/api/mindMaps/store', {
                    params: {
                        mind_data_json: mindDataJson,
                        user_id: userId,
                    }
                })
                .then((response) => {
                    if(response.data.status === 'success'){
                        alert(response.data.message)
                    }
                    else{
                        alert(response.data.message)
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
            }
            // ボタンをクリックしたらマインドマップを保存
            document.getElementById('store_button').addEventListener('click', storeMindMap);

            // 選択したマインドマップをオレンジにする関数
            function changeColorOrange() {
                var selected_node = jm.get_selected_node(); // 選択されたノードを取得
                if (!selected_node) {
                    alert('ノードを選択してください');
                    return;
                }
                // 選択したノードの色を白色にする
                jm.set_node_color(selected_node.id, '#ff9900', '#ffffff');
                // 選択したノードの背景をオレンジにする
                // jm.set_node_background(selected_node.id, null, '#ff9900');
            }
            // ボタンをクリックしたら選択したマインドマップをオレンジにする
            document.getElementById('change_orange').addEventListener('click', changeColorOrange);

            // 選択したマインドマップをデフォルトカラーにする関数
            function changeColorDefault() {
                var selected_node = jm.get_selected_node(); // 選択されたノードを取得
                if (!selected_node) {
                    alert('ノードを選択してください');
                    return;
                }
                // 選択したノードの色を白色にする
                jm.set_node_color(selected_node.id, '#ecf0f1', '#333');
            }
            // ボタンをクリックしたら選択したマインドマップをデフォルトカラーにする
            document.getElementById('chage_default').addEventListener('click', changeColorDefault);

            // 選択したマインドマップをブルーにする関数
            function changeColorBlue() {
                var selected_node = jm.get_selected_node(); // 選択されたノードを取得
                if (!selected_node) {
                    alert('ノードを選択してください');
                    return;
                }
                // 選択したノードの色を白色にする
                jm.set_node_color(selected_node.id, '#3498db', '#ffffff');
            }
            // ボタンをクリックしたら選択したマインドマップをブルーにする
            document.getElementById('change_blue').addEventListener('click', changeColorBlue);

            
        }
        
    }
    load_jsmind();
</script>
@endsection
