@extends('layouts.user.app')

@section('content')
<div class="d-flex flex-wrap pt-2 ps-3 pe-3 z-3 position-fixed bg-white">
    <div class="me-3">
        {{-- 一覧へ戻るボタン --}}
        <a href="{{ route('user.mind_maps.index') }}" class="btn  btn-sm btn-outline-secondary"><i class="fa-solid fa-arrow-left"></i></a>
    </div>
    <div class="me-3 d-flex">
        {{-- ノード追加 --}}
        <button type="button" class="btn  btn-sm btn-outline-dark" id="add_button"><i class="fa-regular fa-square-plus"></i></button>
        {{-- ノード編集 --}}
        <button type="button" class="btn  btn-sm btn-outline-success" id="edit_button"><i class="fa-regular fa-pen-to-square"></i></button>
        {{-- ノード削除 --}}
        <button type="button" class="btn  btn-sm btn-outline-danger" id="remove_button"><i class="fa-solid fa-minus"></i></button>
        {{-- マインドマップ登録 --}}
        <button type="button" class="btn  btn-sm btn-primary text-white" id="update_button"><i class="fa-regular fa-floppy-disk"></i></button>
    </div>
    <div class="me-3 d-flex">
        {{-- カラー変更→default --}}
        <button type="button" class="btn  btn-sm btn-outline-secondary" id="chage_air"><i class="fa-solid fa-droplet"></i></button>
        {{-- カラー変更→gray --}}
        <button type="button" class="btn  btn-sm btn-secondary text-white" id="chage_gray"><i class="fa-solid fa-droplet"></i></button>
        {{-- カラー変更→orange --}}
        <button type="button" class="btn  btn-sm btn-primary text-white" id="change_orange"><i class="fa-solid fa-droplet"></i></button>
        {{-- カラー変更→blue --}}
        <button type="button" class="btn  btn-sm btn-info text-white" id="change_blue"><i class="fa-solid fa-droplet"></i></button>
    </div>
    <div class="me-3 d-flex">
        {{-- ノードサイズ拡大 --}}
        <button type="button" class="btn  btn-sm btn-outline-secondary" id="change_font_size_large"><i class="fa-solid fa-up-right-and-down-left-from-center"></i></button>
        {{-- ノードサイズ標準 --}}
        <button type="button" class="btn  btn-sm btn-outline-secondary" id="change_font_size_normal"><i class="fa-solid fa-rotate-left"></i></button>
        {{-- ノードサイズ縮小 --}}
        <button type="button" class="btn  btn-sm btn-outline-secondary" id="change_font_size_small"><i class="fa-solid fa-down-left-and-up-right-to-center"></i></button>
    </div>
    <div class="d-flex">
        <div class="btn-group" role="group" aria-label="Basic example">
            {{-- マインドマップ拡大 --}}
            <button type="button" class="btn  btn-sm btn-outline-secondary" id="zoomIn"><i class="fa-solid fa-magnifying-glass-plus"></i></button>
            {{-- マインドマップ縮小 --}}
            <button type="button" class="btn  btn-sm btn-outline-secondary" id="zoomOut"><i class="fa-solid fa-magnifying-glass-minus"></i></button>
        </div>
    </div>
</div>
<div class="mx-auto mindmap-size" id="jsmind_container" style="padding-top: 4rem"></div>
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
                theme:'default',
                mode:'side',
                support_html:true,
                view:{
                    engine: 'svg',
                    node_overflow: 'wrap',
                    zoom: {             // 配置缩放
                        min: 0.1,       // 最小的缩放比例
                        max: 1.5,       // 最大的缩放比例
                        step: 0.1,      // 缩放比例间隔
                    },
                },
                shortcut:{
                    enable:true, 		// whether to enable shortcut
                    handles:{}, 			// Named shortcut key event processor
                    mapping:{ 			// shortcut key mapping
                        // addchild : [45, 4096+13], 	// <Insert>, <Ctrl> + <Enter>
                        addchild : 9, 	// <Tab>
                        addbrother : 13, // <Enter>
                        delnode : 46, 	// <Delete>
                        left : 37, 		// <Left>
                        up : 38, 		// <Up>
                        right : 39, 		// <Right>
                        down : 40, 		// <Down>
                    }
                },
            }

            // ノードのスタイルを設定

    
            var jm = new jsMind(options);
            jm.show(mind);
            
            // 拡大・縮小ボタン
            $('#zoomIn').on('click', function() {
                jm.view.zoomIn();
            });
            $('#zoomOut').on('click', function() {
                jm.view.zoomOut();
            });
    
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
    
            // マインドマップを更新する関数
            function updateMindMap() {
                var mindData = jm.get_data(); // マインドマップのデータを取得
    
                var mindDataJson = JSON.stringify(mindData); // マインドマップのデータをJSON形式に変換
                
                // マインドマップのデータを送信
                axios.post('/api/mindMaps/update', {
                    params: {
                        mind_data_json: mindDataJson,
                        mind_map_id: mindMap.id,
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
            // ボタンをクリックしたらマインドマップを更新
            document.getElementById('update_button').addEventListener('click', updateMindMap);

            // 選択したマインドマップを装飾なしにする関数
            function changeColorAir() {
                var selected_node = jm.get_selected_node(); // 選択されたノードを取得
                if (!selected_node) {
                    alert('ノードを選択してください');
                    return;
                }
                // 選択したノードの背景色を透明にする
                jm.set_node_color(selected_node.id, '#ffffff', '#333');
            }
            // ボタンをクリックしたら選択したマインドマップを装飾なしにする
            document.getElementById('chage_air').addEventListener('click', changeColorAir);

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
            function changeColorGray() {
                var selected_node = jm.get_selected_node(); // 選択されたノードを取得
                if (!selected_node) {
                    alert('ノードを選択してください');
                    return;
                }
                // 選択したノードの色を白色にする
                jm.set_node_color(selected_node.id, '#ecf0f1', '#333');
            }
            // ボタンをクリックしたら選択したマインドマップをデフォルトカラーにする
            document.getElementById('chage_gray').addEventListener('click', changeColorGray);

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

            // 選択したマインドマップのフォントサイズを大きくする関数
            function changeFontSizeLarge() {
                var selected_node = jm.get_selected_node(); // 選択されたノードを取得
                if (!selected_node) {
                    alert('ノードを選択してください');
                    return;
                }
                // 選択したノードのフォントサイズを大きくする
                jm.set_node_font_style(selected_node.id, 18.5);
            }
            // ボタンをクリックしたら選択したマインドマップのフォントサイズを大きくする
            document.getElementById('change_font_size_large').addEventListener('click', changeFontSizeLarge);

            // 選択したマインドマップのフォントサイズを標準サイズにする関数
            function changeFontSizeNormal() {
                var selected_node = jm.get_selected_node(); // 選択されたノードを取得
                if (!selected_node) {
                    alert('ノードを選択してください');
                    return;
                }
                // 選択したノードのフォントサイズを標準サイズにする
                jm.set_node_font_style(selected_node.id, 16);
            }
            // ボタンをクリックしたら選択したマインドマップのフォントサイズを標準サイズにする
            document.getElementById('change_font_size_normal').addEventListener('click', changeFontSizeNormal);

            // 選択したマインドマップのフォントサイズを小さくする関数
            function changeFontSizeSmall() {
                var selected_node = jm.get_selected_node(); // 選択されたノードを取得
                if (!selected_node) {
                    alert('ノードを選択してください');
                    return;
                }
                // 選択したノードのフォントサイズを小さくする
                jm.set_node_font_style(selected_node.id, 13.5);
            }
            // ボタンをクリックしたら選択したマインドマップのフォントサイズを小さくする
            document.getElementById('change_font_size_small').addEventListener('click', changeFontSizeSmall);


            
        }
        
    }
    load_jsmind();
</script>
@endsection
