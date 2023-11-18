@extends('layouts.user.app')

@section('content')
<div class="container">
    <x-parts.basic_card_layout>
        <x-slot name="cardHeader">
            <h4 class="my-2">今日の目標</h4>
        </x-slot>
        <x-slot name="cardBody">
            {{-- <div id="jsmind_container"></div> --}}
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
                    <button type="submit" class="btn btn-primary" >
                        登録する
                    </button>
                </div>
            </form>
        </x-slot>
    </x-parts.basic_card_layout>
</div>
@endsection
@section('script')
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsmind@0.7.5/style/jsmind.css"/>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jsmind@0.7.5/es6/jsmind.js"></script>
<script type="text/javascript" src="https://unpkg.com/jsmind@0.7.5/es6/jsmind.draggable-node.js"></script>
<script type="text/javascript">
    function load_jsmind(){
        const longRunGoal = @json($longRunGoal);
        console.log(longRunGoal.middleRunGoals);
        // foreach
        let data = [
            {
                "id": "root",
                "topic": longRunGoal.title,
                "children": longRunGoal.middleRunGoals.map(middleRunGoal => ({
                    "id": middleRunGoal.id,
                    "topic": middleRunGoal.title,
                    "direction": "right",
                    "children": middleRunGoal.shortRunGoals.map(shortRunGoal => ({
                        "id": shortRunGoal.id,
                        "topic": shortRunGoal.title
                    }))
                }))
            }
        ];

        console.log(data);


        var mind = {
            "meta":{
            },
            "format":"node_tree",
            "data":{"id":"root","topic":longRunGoal.title,"children":[ 
                {"id":"aaaa","topic":"ああああ","direction":"right","children":[
                    {"id":"aaaa1","topic":"ああああ to show"},
                    {"id":"aaaa2","topic":"ああああ to edit"},
                    {"id":"aaaa3","topic":"ああああ to store"},
                    {"id":"aaaa4","topic":"ああああ to embed"}
                ]},
                {"id":"bbbb","topic":"ババババ Source","direction":"right","children":[
                    {"id":"bbbb1","topic":"ババババ GitHub"},
                    {"id":"bbbb2","topic":"ババババ License"}
                ]},
                {"id":"iiii","topic":"いいいい","direction":"right","children":[
                    {"id":"iiii1","topic":"いいいい on Javascript"},
                    {"id":"iiii2","topic":"いいいい on HTML5"},
                    {"id":"iiii3","topic":"いいいい on you"}
                ]},
                {"id":"uuuu","topic":"うううう node","direction":"right","children":[
                    {"id":"uuuu1","topic":"ううううI'm from local variable"},
                    {"id":"uuuu2","topic":"ううううI can do everything"}
                ]}
            ]}
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