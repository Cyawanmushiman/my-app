@extends('layouts.admin.app')

@section('content')
<div class="container">
    <x-parts.basic_card_layout>
        <x-slot name="cardHeader">
            <h4 class="my-2">インスパイア編集</h4>
        </x-slot>
        <x-slot name="cardBody">
            <form method="POST" action="{{ route('admin.inspires.update', $inspire) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')



                <div class="col-md-8 mb-3 mx-auto">
                    <img src="{{ $inspire->image_url }}" alt="インスパイア画像" style="max-width: 100px">
                    <label class="" for="image_file">画像</label>
                    @include('components.form.file', ['name' => 'image_file', 'required' => true, 'accept' =>
                    'image/*'])
                    @include('components.form.error', ['name' => 'image_file'])
                </div>

                <div class="col-md-8 mb-3 mx-auto">
                    <label class="" for="comment">コメント</label>
                    @include('components.form.text', ['name' => 'comment', 'value' => $inspire->comment, 'required' =>
                    true])
                    @include('components.form.error', ['name' => 'comment'])
                </div>

                <div class="text-center my-4">
                    <a href="{{ route('admin.inspires.index') }}" class="btn btn-outline-dark"><i
                            class="fa-solid fa-reply"></i></a>
                    <button type="submit" class="btn btn-dark">
                        更新する
                    </button>
                </div>
            </form>
        </x-slot>
    </x-parts.basic_card_layout>
</div>
@endsection