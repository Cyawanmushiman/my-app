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
                <form method="POST" action="{{ route('user.middle_run_goals.store') }}"  enctype="multipart/form-data">
                    @csrf
                    
                    <input type="hidden" name="long_run_goal_id" value="{{ $longRunGoal->id }}">
                    
                    <div class="col-md-8 mb-3 mx-auto">
                        <label class="" for="title">タイトル</label>
                        @include('components.form.text', ['name' => 'title', 'required' => true])
                        @include('components.form.error', ['name' => 'title'])
                    </div>

                    <div class="text-center my-4">
                        <a href="{{ route('user.middle_run_goals.index') }}" class="btn btn-outline-dark">一覧画面へ戻る</a>
                        <button type="submit" class="btn btn-dark">
                            register
                        </button>
                    </div>
                </form>
            </x-slot>
        </x-parts.basic_card_layout>
    </div>
</section>
@endsection
