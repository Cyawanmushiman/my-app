@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content">
        <x-parts.basic_card_layout>
            <x-slot name="cardHeader">
                <h4 class="my-2">what's the tips?</h4>
            </x-slot>
            <x-slot name="cardBody">
                <form method="POST" action="{{ route('user.tips.update') }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="col-md-8 mb-3 mx-auto">
                        @include('components.form.textarea', ['name' => 'content', 'value' => $tip->content ?? ''])
                        @include('components.form.error', ['name' => 'content'])
                    </div>

                    <div class="text-center my-4">
                        <a href="{{ route('user.daily_run_goals.index') }}" class="btn btn-outline-dark"><i
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