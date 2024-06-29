@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content px-4">
        @if ($purpose)
            <div class="d-flex mb-5 align-items-center">
                <div class="col-11 position-relative">
                    <img src="{{ asset('images/gifs/cat-8915_128.gif') }}" alt="" style="width: 30px; height: 30px; top: -14px; left: {{ $progressbarPer }}%" class="position-absolute translate-middle">
                    <div class="progress" role="progressbar" aria-label="Example 20px high" aria-valuenow="{{ $progressbarPer }}" aria-valuemin="0" aria-valuemax="100" style="height: 5px">
                        <div class="progress-bar bg-info" style="width: {{ $progressbarPer }}%"></div>
                    </div>
                </div>
                <div class="col-1 d-flex justify-content-end">
                    <div class="purpose-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" title={{ $purpose->content }}>
                    </div>
                </div>
            </div>
        @endif
        <div class="d-flex">
            @if ($purpose)
                <a href="{{ route('user.purposes.edit', $purpose) }}">Purposes</a>
            @else
                <a href="{{ route('user.purposes.create') }}">Purposes</a>
            @endif            
            <span class="mx-2">></span>
            @if ($purpose)
                <a href="{{ route('user.long_run_goals.create') }}">LongRunGoal</a>
            @else
                <a tabindex="-1">LongRunGoal</a>
            @endif
            <span class="mx-2">></span>
            @if ($purpose->longRunGoal)
                <a href="{{ route('user.middle_run_goals.create') }}">MiddleRunGoal</a>
            @else
                <a tabindex="-1">MiddleRunGoal</a>
            @endif
        </div>
        
    </div>
</section>
@endsection