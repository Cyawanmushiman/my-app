@extends('layouts.user.app')

@section('content')
<section class="resume-section pt-0" id="home">
    <div class="resume-section-content">
        <div id="jsmind_container" style="width:100%;height:500px;"></div>
        <form method="POST" action="{{ route('user.home.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="d-flex justify-content-center">
                <div class="d-flex flex-column justify-content-start">
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
                </div>
            </div>
            
            <div class="d-flex flex-column align-items-center">
                <div class="form-body mt-5">
                    <div class="row">
                        <div class="col-12 d-flex align-items-center">
                            @include('components.form.textarea', ['name' => 'diary', 'rows' => 10, 'placeholder' => 'Please enter what happened today'])
                        </div>
                        @include('components.form.error', ['name' => 'diary'])
                    </div>
                </div>

                <div class="form-body mt-5">
                    <div class="row">
                        <div class="col-12 d-flex align-items-center">
                            @include('components.form.number', ['name' => 'score', 'placeholder' => "today's score", 'class' => 'text-center'])
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
        const userId = @json(auth()->user()->id);
        
        mindMap = @json($mindMap);
        if (mindMap) {
            var mind = JSON.parse(mindMap.mind_data_json);
            
            var options = {
                container:'jsmind_container',
                editable:false,
                theme:'default',
                view:{
                    engine: 'svg',
                }
            }
    
            var jm = new jsMind(options);
            jm.show(mind);    
        }
        
    }
    load_jsmind();
</script>
@endsection