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
                    今日の記録を登録する
                </button>
            </div>
        </form>
    </div>
</section>
{{-- <div class="container">
    <x-parts.basic_card_layout>
        <x-slot name="cardHeader">
            <h4 class="my-2">今日の目標</h4>
        </x-slot>
        <x-slot name="cardBody">
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
                    <button type="submit" class="btn btn-primary text-white" >
                        登録する
                    </button>
                </div>
            </form>
        </x-slot>
    </x-parts.basic_card_layout>
</div> --}}
@endsection
@section('script')
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsmind@0.7.5/style/jsmind.css"/>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jsmind@0.7.5/es6/jsmind.js"></script>
<script type="text/javascript" src="https://unpkg.com/jsmind@0.7.5/es6/jsmind.draggable-node.js"></script>
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
        var jm = jsMind.show(options,mind);
        // jm.set_readonly(true);
        // var mind_data = jm.get_data();
        // alert(mind_data);
        jm.add_node("sub2","sub23", "new node", {"background-color":"red"});
        jm.set_node_color('sub21', 'green', '#ccc');
    }
    load_jsmind();
</script>
{{-- resources/views/user/home.blade.php --}}

@endsection