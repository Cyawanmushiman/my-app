@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content">
        <x-parts.basic_card_layout>
            <x-slot name="cardHeader">
                <h4 class="my-2">挑戦内容の設定</h4>
            </x-slot>
            <x-slot name="cardBody">
                <form method="POST" action="{{ route('user.challengings.store') }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="col-md-8 mb-3 mx-auto">
                        <label class="" for="opponent_max_hit_point">敵の名前を設定</label>
                        @include('components.form.text', ['name' => 'opponent_name', 'required' => true])
                        @include('components.form.error', ['name' => 'opponent_name'])
                    </div>

                    <div class="col-md-8 mb-3 mx-auto">
                        <label class="" for="opponent_max_hit_point">敵の最大HPを設定</label>
                        @include('components.form.number', ['name' => 'opponent_max_hit_point', 'required' => true])
                        @include('components.form.error', ['name' => 'opponent_max_hit_point'])
                    </div>

                    <div class="col-md-8 mb-3 mx-auto">
                        <label class="" for="user_max_hit_point">自分の最大HPを設定</label>
                        @include('components.form.number', ['name' => 'user_max_hit_point', 'required' => true])
                        @include('components.form.error', ['name' => 'user_max_hit_point'])
                    </div>
                    
                    <div class="col-md-8 mb-3 mx-auto">
                        <label class="" for="reward">報酬</label>
                        @include('components.form.text', ['name' => 'reward'])
                        @include('components.form.error', ['name' => 'reward'])
                    </div>

                    <div class="text-center my-4">
                        <a href="{{ route('user.home') }}" class="btn btn-outline-dark"><i
                                class="fa-solid fa-reply"></i></a>
                        <button type="submit" class="btn btn-primary text-white">
                            <i class="fa-regular fa-floppy-disk me-2"></i>
                            <span class="vertical-align-middle">Create</span>
                        </button>
                    </div>
                </form>
            </x-slot>
        </x-parts.basic_card_layout>
    </div>
</section>
@endsection