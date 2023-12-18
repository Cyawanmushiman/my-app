@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content">
        <ul class="progressbar mb-5">
            <li class="complete">First Goal</li>
            <li class="">Mind Map</li>
            <li>Daily Goal</li>
        </ul>
        <p class="text-center mb-5">はじめまして！一緒に初期設定をしていきましょう。</p>
        <p class="text-center mb-5">最初に、あなたが達成したい目標を登録して下さい。</p>
        <form method="POST" action="{{ route('user.set_ups.store_first_goal') }}"  enctype="multipart/form-data">
            @csrf

            <div class="col-md-8 mb-3 mx-auto">
                @include('components.form.text', ['name' => 'first_goal_text', 'required' => true])
                @include('components.form.error', ['name' => 'first_goal_text'])
            </div>

            <div class="text-center my-4">
                <button type="submit" class="btn btn-primary text-white">
                    register
                </button>
            </div>
        </form>
    </div>
</section>
@endsection
