@extends('layouts.admin.app')

@section('content')
<div class="container">
    <x-parts.basic_card_layout>
        <x-slot name="cardHeader">
            <h4 class="my-2">インスパイア作成</h4>
        </x-slot>
        <x-slot name="cardBody">
            <form method="POST" action="{{ route('admin.inspires.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="col-md-8 mb-3 mx-auto">
                    <label class="" for="image_file">画像</label>
                    @include('components.form.file', ['name' => 'image_file', 'required' => true, 'accept' =>
                    'image/*'])
                    @include('components.form.error', ['name' => 'image_file'])
                </div>

                <div class="col-md-8 mb-3 mx-auto">
                    <label class="" for="comment">コメント</label>
                    @include('components.form.text', ['name' => 'comment', 'required' => true])
                    @include('components.form.error', ['name' => 'comment'])
                </div>

                <div class="text-center my-4">
                    <a href="{{ route('admin.inspires.index') }}" class="btn btn-outline-dark"><i
                            class="fa-solid fa-reply"></i></a>
                    <button type="submit" class="btn btn-dark">
                        register
                    </button>
                </div>
            </form>
        </x-slot>
    </x-parts.basic_card_layout>
</div>
@endsection