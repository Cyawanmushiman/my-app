@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content px-4">
        @if ($purpose)
        <div class="d-flex mb-5 align-items-center">
            <div class="col-11 position-relative">
                <img src="{{ asset('images/gifs/cat-8915_128.gif') }}" alt=""
                    style="width: 30px; height: 30px; top: -14px; left: {{ $progressbarPer }}%"
                    class="position-absolute translate-middle">
                <div class="progress" role="progressbar" aria-label="Example 20px high"
                    aria-valuenow="{{ $progressbarPer }}" aria-valuemin="0" aria-valuemax="100" style="height: 5px">
                    <div class="progress-bar bg-info" style="width: {{ $progressbarPer }}%"></div>
                </div>
                @if ($purpose->longRunGoal)
                <div class="long-run-popover" data-bs-toggle="popover" data-bs-placement="top" data-bs-content={{
                    $purpose->longRunGoal->title }}>
                </div>
                <label class="long-run-popover-lobel">{{ $purpose->longRunGoal->finish_on->format('Y/m/d') }}</label>
                @endif
                @if ($middleGoalMap)
                @foreach ($middleGoalMap as $per => $middleGoal)
                <div class="middle-run-popover" style="left: {{ $per }}%;" data-bs-toggle="popover"
                    data-bs-placement="top" data-bs-content={{ $middleGoal->title }}>
                </div>
                <label class="middle-run-popover-lobel" style="left: {{ $per }}%;">{{
                    $middleGoal->finish_on->format('Y/m/d') }}</label>
                @endforeach
                @endif
            </div>
            <div class="col-1 d-flex justify-content-end">
                <div class="purpose-popover" data-bs-toggle="popover" data-bs-placement="top"
                    data-bs-content="{{ $purpose->content }}">
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
            @if ($purpose->longRunGoal === null)
            <a href="{{ route('user.long_run_goals.create', $purpose) }}">LongRunGoal</a>
            @elseif ($purpose->longRunGoal)
            <a href="{{ route('user.long_run_goals.edit', $purpose->longRunGoal) }}">LongRunGoal</a>
            @else
            <a tabindex="-1">LongRunGoal</a>
            @endif
            <span class="mx-2">></span>
            @if ($purpose->longRunGoal && $purpose->middleRunGoals->isEmpty())
            <a href="{{ route('user.middle_run_goals.create', $purpose->longRunGoal) }}">MiddleRunGoal</a>
            @elseif ($purpose->longRunGoal && $purpose->middleRunGoals)
            <a href="{{ route('user.middle_run_goals.edit', $purpose->longRunGoal) }}">MiddleRunGoal</a>
            @else
            <a tabindex="-1">MiddleRunGoal</a>
            @endif
        </div>

    </div>
</section>
@endsection