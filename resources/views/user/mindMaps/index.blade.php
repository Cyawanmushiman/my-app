@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content">
        <div id="jsmind_container" style="width:100%;height:500px;"></div>
        <button type="button" class="btn btn-outline-dark" id="add_button">追加</button>
        <button type="button" class="btn btn-outline-success" id="edit_button">編集</button>
        <button type="button" class="btn btn-outline-danger" id="remove_button">削除</button>
        <button type="button" class="btn btn-primary text-white" id="store_button">保存</button>
    </div>
</section>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script type="text/javascript">
    function load_jsmind(){
        const userId = @json(auth()->user()->id);
        
        // let data = {
        //     "id": "root",
        //     "topic": longRunGoal.title,
        //     "children": longRunGoal.middle_run_goals.map(middleRunGoal => ({
        //         "id": "middleRunGoalId" + middleRunGoal.id,
        //         "topic": middleRunGoal.title,
        //         "direction": "right",
        //         "children": middleRunGoal.short_run_goals.map(shortRunGoal => ({
        //             "id": shortRunGoal.id,
        //             "topic": shortRunGoal.title
        //         }))
        //     }))
        // };

        // var mind = {
        //     "meta":{
        //     },
        //     "format":"node_tree",
        //     "data":data
        // };
        // var mind = {"meta":{},"format":"node_tree","data":{"id":"root","topic":"IELTS 5.0","expanded":true,"children":[{"id":"middleRunGoalId1","topic":"TOEIC700点","expanded":true,"direction":"right"},{"id":"bf1f3aa22bffdacb","topic":"新しいノード bf1f3","expanded":true,"direction":"right"},{"id":"bf1f3c1a5b78f5fd","topic":"New Node","expanded":true,"direction":"left"},{"id":"bf1f3b41ce3c3820","topic":"New Node","expanded":true,"direction":"left"}]}}
        mindMap = @json($mindMap);
        
        if (mindMap) {
            var mind = JSON.parse(mindMap.mind_data_json);
            console.log(mind);
            
            var options = {
                container:'jsmind_container',
                editable:true,
                theme:'primary',
            }
    
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
        }
        
    }
    load_jsmind();
</script>
@endsection
