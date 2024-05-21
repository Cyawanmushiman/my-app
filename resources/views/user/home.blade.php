@extends('layouts.user.app')

@section('content')
<section class="resume-section pt-0" id="home">
    <div class="resume-section-content">
        <div class="mx-auto mindmap-size" id="jsmind_container"></div>
        {{-- 拡大・縮小ボタン --}}
        <div class="d-flex justify-content-center mt-3 mb-3">
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-outline-secondary" id="zoomIn"><i class="fa-solid fa-magnifying-glass-plus"></i></button>
                <button type="button" class="btn btn-outline-secondary" id="zoomOut"><i class="fa-solid fa-magnifying-glass-minus"></i></button>
            </div>
        </div>
        <form method="POST" action="{{ route('user.home.store') }}" enctype="multipart/form-data">
            @csrf
            @error('daily_run_goal_ids')
                <p class="text-center text-danger">{{ $message }}</p>
            @enderror
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
                            @include('components.form.textarea', [
                                'name' => 'diary', 
                                'rows' => 10,
                                'placeholder' => 'Please enter what happened today'
                            ])
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
                }
            }
    
            var jm = new jsMind(options);
            
            // 最小の拡大率で表示
            jm.view.setZoom(0.1);
            
            jm.show(mind);
            
            // 拡大・縮小ボタン
            $('#zoomIn').on('click', function() {
                jm.view.zoomIn();
            });
            $('#zoomOut').on('click', function() {
                jm.view.zoomOut();
            });
        }
        
    }
    load_jsmind();
</script>
@endsection