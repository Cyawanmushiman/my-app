@if ($purpose)
<div class="d-flex mb-3 align-items-center">
    <div class="col-11 position-relative">
        <label class="long-run-popover-today-label" style="left: {{ $progressbarPerForLong }}%">{{ today()->format('Y/m/d') }}</label>
        <img src="{{ $gifImageUrl }}" alt=""
            style="left: {{ $progressbarPerForLong }}%"
            class="walking-gif-popover" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="{{ GoalProgress::getSupportComment() }}">
        <div class="progress" role="progressbar" aria-label="Example 20px high"
            aria-valuenow="{{ $progressbarPerForLong }}" aria-valuemin="0" aria-valuemax="100" style="height: 5px">
            <div class="progress-bar bg-info" style="width: {{ $progressbarPerForLong }}%"></div>
        </div>
        @if ($longRunGoal)
            <div class="long-run-popover-start" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="start!!">
            </div>
            <label class="long-run-popover-start-label">{{ $longRunGoal->start_on->format('Y/m/d') }}</label>
            
            <div class="long-run-popover-finish" data-bs-toggle="popover" data-bs-placement="top" data-bs-content={{
                $longRunGoal->title }}>
            </div>
            <label class="long-run-popover-finish-label">{{ $longRunGoal->finish_on->format('Y/m/d') }}</label>
        @endif
        @if ($middleGoalMap)
            @foreach ($middleGoalMap as $per => $middleGoalContent)
                <div class="middle-run-popover" style="left: {{ $per }}%;" data-bs-toggle="popover"
                    data-bs-placement="top" data-bs-content="{{ $middleGoalContent }}">
                </div>
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
    <a href="{{ route('user.purposes.edit', $purpose) }}" class="goal-breadcrumb">Purposes</a>
@else
    <a href="{{ route('user.purposes.create') }}" class="goal-breadcrumb">Purposes</a>
@endif
<span class="mx-2 goal-breadcrumb">></span>
@if ($purpose && $longRunGoal === null)
    <a href="{{ route('user.long_run_goals.create', $purpose) }}" class="goal-breadcrumb">LongRunGoal</a>
@elseif ($longRunGoal)
    <a href="{{ route('user.long_run_goals.edit', $longRunGoal) }}" class="goal-breadcrumb">LongRunGoal</a>
@else
    <a tabindex="-1" style="font-size: 10px">LongRunGoal</a>
@endif
<span class="mx-2 goal-breadcrumb">></span>
@if ($longRunGoal)
    <a href="{{ route('user.middle_run_goals.index', $longRunGoal) }}" class="goal-breadcrumb">MiddleRunGoal</a>
@else
    <a tabindex="-1" style="font-size: 10px">MiddleRunGoal</a>
@endif
</div>