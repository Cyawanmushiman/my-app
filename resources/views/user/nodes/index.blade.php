@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content">
        <div id="jsmind_container" style="width:100%;height:500px;"></div>
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
            view:{
                zoom: {             // ズーム設定
                    min: 0.8,       // 最小ズーム比率
                    max: 2.1,       // 最大ズーム比率
                    step: 0.1,      // ズーム比率の間隔
                },
            },
        }

        var jm = new jsMind(options);
        jm.show(mind);

        function addNewNode() {
            
        }
    }
    load_jsmind();
</script>
@endsection
