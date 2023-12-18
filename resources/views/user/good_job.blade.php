@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content">
        @if ($inspire)
            <div class="fadeRight d-flex align-items-center justify-content-center">
                <img src="{{ $inspire->image_url }}" style="max-width:100px;">
                <p style="font-family: serif;">「{{ $inspire->comment }}」</p>
            </div>
        @endif
        
        <div class="row mb-5">
            <div class="col-12 mt-3">
                <h2 class="text-center">Achieved <span class="text-danger">{{ $consecutiveDays }}</span> consecutive days</h2>
            </div>
        </div>
        @for ($i = 0; $i < $dailyScores->count(); $i++)
            @if ($dailyScores[$i]->score >= 80)
                <i class="fa-solid fa-fire-flame-curved text-danger"></i>
            @elseif ($dailyScores[$i]->score >= 60)
                <i class="fa-solid fa-fire-flame-curved text-warning"></i>
            @elseif ($dailyScores[$i]->score >= 40)
                <i class="fa-solid fa-fire-flame-curved text-info"></i>
            @elseif ($dailyScores[$i]->score >= 20)
                <i class="fa-solid fa-fire-flame-curved text-primary"></i>
            @else
                <i class="fa-solid fa-fire-flame-curved text-secondary"></i>
            @endif
        @endfor
    </div>
</section>
@endsection