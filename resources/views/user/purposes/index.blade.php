@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content px-4">
        <div class="d-flex mb-5 align-items-center">
            <div class="col-11 position-relative">
                <img src="{{ asset('images/gifs/cat-8915_128.gif') }}" alt="" style="width: 30px; height: 30px; top: -14px; left: 25%" class="position-absolute translate-middle">
                {{-- <div style=
                "width: 15px; 
                height: 15px; 
                background-color: #fff;
                border: 2px solid #bd5d38;
                border-radius: 50%;
                top: 2px;
                left: 105%;
                " class="position-absolute translate-middle"
                ></div> --}}
                <div class="progress" role="progressbar" aria-label="Example 20px high" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 5px">
                    <div class="progress-bar bg-info" style="width: 25%"></div>
                </div>
            </div>
            <div class="col-1 d-flex justify-content-end">
                <div style=
                "width: 15px; 
                height: 15px; 
                background-color: #fff;
                border: 2px solid #bd5d38;
                border-radius: 50%;
                " data-bs-toggle="tooltip" data-bs-placement="top" title="上に出るツールチップ">
                </div>
            </div>
        </div>
        {{-- @dd($purpose) --}}
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