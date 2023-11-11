@extends('layouts.user.app')

@section('content')
<div class="container">
    <x-parts.basic_card_layout>
        <x-slot name="cardHeader">
            <h4 class="my-2">今日の目標</h4>
        </x-slot>
        <x-slot name="cardBody">
            <form method="POST" action="{{ route('user.home.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="d-flex flex-column align-items-center justify-content-center">
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

                    <div class="form-body mt-5">
                        <div class="row">
                            <div class="col-6 text-md-end">
                                <label class="col-form-label">今日の点数</label>
                            </div>
                            <div class="col-6 d-flex align-items-center">
                                @include('components.form.number', ['name' => 'score'])点
                            </div>
                            @include('components.form.error', ['name' => 'score'])
                        </div>
                    </div>
                </div>



                <div class="text-center my-4">
                    <button type="submit" class="btn btn-primary" >
                        登録する
                    </button>
                </div>
            </form>
        </x-slot>
    </x-parts.basic_card_layout>
</div>
@endsection