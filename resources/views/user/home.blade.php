@extends('layouts.user.app')

@section('title', 'Home')
@section('content')
<section class="resume-section pt-0" id="home">
    <div class="resume-section-content px-5 mt-5">
        @include('components.parts.purposes.goal_progress')
        <div style="max-height: 600px; overflow-y: auto;">
            <form method="POST" action="{{ route('user.home.store') }}" enctype="multipart/form-data" class="mt-4">
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
{{--                 
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
                </div> --}}
    
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Why do you want to achieve this goal ?
                        </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">{!! nl2br(e(auth()->user()->reason->content)) !!}</div>
                    </div>
                </div>
    
                <div class="text-center my-4">
                    <button type="submit" class="btn btn-primary text-white">
                        Log today's record
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection