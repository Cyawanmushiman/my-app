@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content">
        <div id="jsmind_container" style="width:100%;height:500px;"></div>
        <button type="button" class="btn btn-outline-dark" id="add_button">追加</button>
        <button type="button" class="btn btn-outline-danger" id="remove_button">削除</button>
    </div>
</section>
@endsection
@section('script')
<script type="text/javascript">
    function load_jsmind(){
        const longRunGoal = @json($longRunGoal);
        // foreach
        let data = {
            "id": "root",
            "topic": longRunGoal.title,
            "children": longRunGoal.middle_run_goals.map(middleRunGoal => ({
                "id": "middleRunGoalId" + middleRunGoal.id,
                "topic": middleRunGoal.title,
                "direction": "right",
                "children": middleRunGoal.short_run_goals.map(shortRunGoal => ({
                    "id": shortRunGoal.id,
                    "topic": shortRunGoal.title
                }))
            }))
        };

        var mind = {
            "meta":{
            },
            "format":"node_tree",
            "data":data
        };

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
            console.log(jm.get_data());
        }
        // ボタンをクリックしたら新しいノードを追加
        document.getElementById('add_button').addEventListener('click', addNewNode);

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

        // ダブルクリックでノードの編集を開始
        jm.add_event_listener(function(type, event, data){
            if(type === jsMind.event_type.dblclick){
                jm.begin_edit(data); // ダブルクリックされたノードの編集を開始
            }
        });
    }
    load_jsmind();
</script>
@endsection
