@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content">
        <x-parts.basic_card_layout>
            <x-slot name="cardHeader">
                <h4 class="my-2">Edit Long Term</h4>
            </x-slot>
            <x-slot name="cardBody">
                <form method="POST" action="{{ route('user.long_run_goals.update', $longRunGoal) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="col-md-8 mb-3 mx-auto">
                        <label class="" for="title">title</label>
                        @include('components.form.text', ['name' => 'title', 'value' => $longRunGoal->title, 'required'
                        => true])
                        @include('components.form.error', ['name' => 'title'])
                    </div>

                    <div class="text-center my-4">
                        <a href="{{ route('user.long_run_goals.index') }}" class="btn btn-outline-dark me-4">
                            一覧に戻る
                        </a>
                        <button type="submit" class="btn btn-dark">
                            更新する
                        </button>
                    </div>
                </form>
            </x-slot>
        </x-parts.basic_card_layout>
    </div>
</section>
@endsection