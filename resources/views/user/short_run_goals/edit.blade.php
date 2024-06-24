@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content">
        <x-parts.basic_card_layout>
            <x-slot name="cardHeader">
                <h4 class="my-2">Edit Short Term</h4>
            </x-slot>
            <x-slot name="cardBody">
                <p>{{ $longRunGoal->title }}を達成するために必要な短期的な目標を登録して下さい</p>
                <form method="POST" action="{{ route('user.short_run_goals.update', $shortRunGoal) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="col-md-8 mb-3 mx-auto">
                        <label class="" for="title">達成したい中期目標</label>
                        @include('components.form.select', ['name' => 'middle_run_goal_id', 'required' => true, 'data'
                        => $longRunGoal->middleRunGoals, 'key' => 'id', 'value' => 'title', 'selected' =>
                        $shortRunGoal->middleRunGoal->id])
                        @include('components.form.error', ['name' => 'middle_run_goal_id'])
                    </div>

                    <div class="col-md-8 mb-3 mx-auto">
                        <label class="" for="title">title</label>
                        @include('components.form.text', ['name' => 'title', 'value' => $shortRunGoal->title, 'required'
                        => true])
                        @include('components.form.error', ['name' => 'title'])
                    </div>

                    <div class="text-center my-4">
                        <a href="{{ route('user.short_run_goals.index') }}" class="btn btn-outline-dark"><i
                                class="fa-solid fa-reply"></i></a>
                        <button type="submit" class="btn btn-primary text-white">
                            <i class="fa-regular fa-floppy-disk me-2"></i>
                            <span class="vertical-align-middle">Update</span>
                        </button>
                    </div>
                </form>
            </x-slot>
        </x-parts.basic_card_layout>
    </div>
</section>
@endsection