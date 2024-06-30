@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content">
        <x-parts.basic_card_layout>
            <x-slot name="cardHeader">
                <h4 class="my-2">Create Middle Term</h4>
            </x-slot>
            <x-slot name="cardBody">
                <p>{{ $longRunGoal->title }}を達成するために必要な中期的な目標を登録して下さい</p>
                <form method="POST" action="{{ route('user.middle_run_goals.store') }}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="long_run_goal_id" value="{{ $longRunGoal->id }}">

                    <div class="col-md-8 mx-auto">
                        <label class="" for="title">title</label>
                        @include('components.form.text', ['name' => "title"])
                        @include('components.form.error', ['name' => "title"])
                    </div>
                    <div class="col-md-8 mx-auto">
                        <label class="" for="finish_on">finish date</label>
                        @include('components.form.date', ['name' => "finish_on", 'min' =>
                        $longRunGoal->start_on->format('Y-m-d'), 'max' => $longRunGoal->finish_on->format('Y-m-d')])
                        @include('components.form.error', ['name' => "finish_on"])
                    </div>
                    
                    <div class="text-center my-4">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-dark"><i class="fa-solid fa-reply"></i></a>
                        <button type="submit" class="btn btn-primary text-white">
                            <i class="fa-regular fa-floppy-disk me-2"></i>
                            <span class="vertical-align-middle">Save</span>
                        </button>
                    </div>
                </form>
            </x-slot>
        </x-parts.basic_card_layout>
    </div>
</section>
@endsection