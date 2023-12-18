@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content">
        <x-parts.basic_card_layout>
            <x-slot name="cardHeader">
                <h4 class="my-2">Create Daily Goal</h4>
            </x-slot>
            <x-slot name="cardBody">
                <form method="POST" action="{{ route('user.daily_run_goals.store') }}"  enctype="multipart/form-data">
                    @csrf

                    <div class="col-md-8 mb-3 mx-auto">
                        <label class="" for="title">タイトル</label>
                        @include('components.form.text', ['name' => 'title', 'required' => true])
                        @include('components.form.error', ['name' => 'title'])
                    </div>

                    <div class="text-center my-4">
                        <a href="{{ route('user.daily_run_goals.index') }}" class="btn btn-outline-dark">back to list</a>
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
