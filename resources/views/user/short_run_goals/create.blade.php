@extends('layouts.user.app')

@section('content')
<div class="container">
    <x-parts.basic_card_layout>
        <x-slot name="cardHeader">
            <h4 class="my-2">短期目標作成</h4>
        </x-slot>
        <x-slot name="cardBody">
            <form method="POST" action="{{ route('user.short_run_goals.store') }}"  enctype="multipart/form-data">
                @csrf

                <div class="col-md-8 mb-3 mx-auto">
                    <label class="" for="title">達成したい長期目標</label>
                    @include('components.form.select', ['name' => 'long_run_goal_id', 'required' => true, 'data' => $allLongRunGoals, 'key' => 'id', 'value' => 'title'])
                    @include('components.form.error', ['name' => 'long_run_goal_id'])
                </div>

                <div class="col-md-8 mb-3 mx-auto">
                    <label class="" for="title">達成したい中期目標</label>
                    @include('components.form.select', ['name' => 'middle_run_goal_id', 'required' => true, 'data' => $allMiddleRunGoals, 'key' => 'id', 'value' => 'title'])
                    @include('components.form.error', ['name' => 'middle_run_goal_id'])
                </div>

                <div class="col-md-8 mb-3 mx-auto">
                    <label class="" for="title">タイトル</label>
                    @include('components.form.text', ['name' => 'title', 'required' => true])
                    @include('components.form.error', ['name' => 'title'])
                </div>

                <div class="text-center my-4">
                    <a href="{{ route('user.short_run_goals.index') }}" class="btn btn-outline-dark">一覧画面へ戻る</a>
                    <button type="submit" class="btn btn-dark">
                        登録する
                    </button>
                </div>
            </form>
        </x-slot>
    </x-parts.basic_card_layout>
</div>
@endsection
