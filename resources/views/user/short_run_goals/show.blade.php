@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content">
        <x-parts.basic_card_layout>
            <x-slot name="cardHeader">
                <h4 class="my-2">〜〜詳細</h4>
            </x-slot>
            <x-slot name="cardBody">
                <p>{{ $shortRunGoal->title }}</p>
            </x-slot>
        </x-parts.basic_card_layout>
    </div>
</section>
@endsection
