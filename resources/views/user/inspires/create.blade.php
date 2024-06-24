@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content">
        <x-parts.basic_card_layout>
            <x-slot name="cardHeader">
                <h4 class="my-2">create inspire</h4>
            </x-slot>
            <x-slot name="cardBody">
                <form method="POST" action="{{ route('user.inspires.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="col-md-8 mb-3 mx-auto">
                        <label class="" for="image_file">image</label>
                        @include('components.form.file', ['name' => 'image_file', 'required' => true, 'accept' =>
                        'image/*'])
                        @include('components.form.error', ['name' => 'image_file'])
                    </div>

                    <div class="col-md-8 mb-3 mx-auto">
                        <label class="" for="comment">comment</label>
                        @include('components.form.text', ['name' => 'comment', 'required' => true])
                        @include('components.form.error', ['name' => 'comment'])
                    </div>

                    <div class="text-center my-4">
                        <a href="{{ route('user.inspires.index') }}" class="btn btn-outline-dark"><i
                                class="fa-solid fa-reply"></i></a>
                        <button type="submit" class="btn btn-primary text-white">
                            <i class="fa-regular fa-floppy-disk me-2"></i>
                            <span class="vertical-align-middle">Save</span>
                        </button>
                    </div>
                </form>
            </x-slot>
        </x-parts.basic_card_layout>
    </div>
</section>
@endsection