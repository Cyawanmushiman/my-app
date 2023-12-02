@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content">
        <ul class="progressbar mb-5">
            <li class="complete">First Goal</li>
            <li class="complete">Mind Map</li>
            <li class="active">Daily Goal</li>
        </ul>
        <p class="mb-5 text-center">これで初期設定は最後です。毎日欠かさず取り組む目標をまずは1つ、設定しましょう<br>
            <small>※毎日の目標は後から編集することができます。</small>
        </p>
        <form method="POST" action="{{ route('user.set_ups.store_daily_goal') }}"  enctype="multipart/form-data">
            @csrf

            <div class="col-md-8 mb-3 mx-auto">
                @include('components.form.text', ['name' => 'title', 'required' => true])
                @include('components.form.error', ['name' => 'title'])
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
