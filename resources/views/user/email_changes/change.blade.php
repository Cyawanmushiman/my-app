@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content">
        <x-parts.basic_card_layout>
            <x-slot name="cardHeader">
                <h4 class="my-2">Email Change</h4>
            </x-slot>
            <x-slot name="cardBody">
                <form method="POST" action="{{ route('user.email.change.send') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="col-md-8 mb-3 mx-auto">
                        <label class="" for="new_email">new email</label>
                        @include('components.form.text', ['name' => 'new_email', 'required' => true])
                        @include('components.form.error', ['name' => 'new_email'])
                    </div>

                    <div class="text-center my-4">
                        <a href="" class="btn btn-outline-dark"><i class="fa-solid fa-reply"></i></a>
                        <button type="submit" class="btn btn-primary text-white">
                            <i class="fa-regular fa-floppy-disk me-2"></i>
                            <span class="vertical-align-middle">Email Verification</span>
                        </button>
                    </div>
                </form>
            </x-slot>
        </x-parts.basic_card_layout>
    </div>
</section>
@endsection