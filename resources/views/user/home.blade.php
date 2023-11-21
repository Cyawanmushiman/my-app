@extends('layouts.user.app')

@section('content')
<section class="resume-section" id="home">
    <div class="resume-section-content">
        <div id="jsmind_container" style="width:100%;height:500px;"></div>
        <form method="POST" action="{{ route('user.home.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="d-flex flex-column align-items-center justify-content-center">
                @foreach (auth()->user()->dailyRunGoals as $dailyRunGoal)
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <input type="checkbox" name="daily_run_goal_ids[]" value="{{ $dailyRunGoal->id }}" id="{{ $dailyRunGoal->id }}">
                                <label class="h5" for="{{ $dailyRunGoal->id }}">{{ $dailyRunGoal->title }}</label>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="form-body mt-5">
                    <div class="row">
                        <div class="col-2 text-md-end">
                            <label class="col-form-label">日記</label>
                        </div>
                        <div class="col-10 d-flex align-items-center">
                            @include('components.form.textarea', ['name' => 'diary', 'rows' => 10, 'placeholder' => '今日の出来事を記入してください'])
                        </div>
                        @include('components.form.error', ['name' => 'diary'])
                    </div>
                </div>

                <div class="form-body mt-5">
                    <div class="row">
                        <div class="col-4 text-md-end">
                            <label class="col-form-label">今日の点数</label>
                        </div>
                        <div class="col-6 d-flex align-items-center">
                            @include('components.form.number', ['name' => 'score'])点
                        </div>
                        @include('components.form.error', ['name' => 'score'])
                    </div>
                </div>
            </div>



            <div class="text-center my-4">
                <button type="submit" class="btn btn-primary text-white">
                    Log today's record
                </button>
            </div>
        </form>
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
            theme:'primary'
        }
        var jm = new jsMind(options);
        jm.show(mind); 
    }
    load_jsmind();
</script>
@endsection