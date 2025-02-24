@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content">
        <x-parts.basic_card_layout>
            <x-slot name="cardHeader">
                <h4 class="my-2">Password Change</h4>
            </x-slot>
            <x-slot name="cardBody">
                <form method="POST" action="{{ route('user.passwords.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="col-md-8 mb-3 mx-auto">
                        <label class="" for="current_password">current password</label>
                        @include('components.form.password', ['name' => 'current_password', 'required' => true])
                        @include('components.form.error', ['name' => 'current_password'])
                    </div>

                    <div class="col-md-8 mb-3 mx-auto">
                        <label class="" for="new_password">new password</label>
                        @include('components.form.password', ['name' => 'new_password', 'required' => true])
                        @include('components.form.error', ['name' => 'new_password'])
                    </div>

                    <div class="col-md-8 mb-3 mx-auto">
                        <label class="" for="new_password_confirmation">new password confirmation</label>
                        @include('components.form.password', ['name' => 'new_password_confirmation', 'required' => true])
                        @include('components.form.error', ['name' => 'new_password_confirmation'])
                    </div>

                    <div class="text-center my-4">
                        <a href="" class="btn btn-outline-dark"><i class="fa-solid fa-reply"></i></a>
                        <button type="submit" class="btn btn-primary text-white">
                            <i class="fa-regular fa-floppy-disk me-2"></i>
                            <span class="vertical-align-middle">update</span>
                        </button>
                    </div>
                </form>
            </x-slot>
        </x-parts.basic_card_layout>
    </div>
</section>
@endsection