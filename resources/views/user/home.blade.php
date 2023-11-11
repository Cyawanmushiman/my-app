@extends('layouts.user.app')

@section('content')
<div class="container">
    <x-parts.basic_card_layout>
        <x-slot name="cardHeader">
            <h4 class="my-2">今日の目標</h4>
        </x-slot>
        <x-slot name="cardBody">
            <form method="POST" action=""  enctype="multipart/form-data">
                @csrf

                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6 text-md-end">
                            <label class="col-form-label">入社年月日@include('components.parts.required_badge')</label>
                        </div>
                        <div class="col-md-2 form-group">
                            @include('components.form.date', ['name' => 'entry_on', 'required' => true])
                            @include('components.form.error', ['name' => 'entry_on'])
                        </div>
                    </div>
                </div>

                <div class="text-center my-4">
                    <button type="submit" class="btn btn-primary" >
                        登録する
                    </button>
                </div>
            </form>
        </x-slot>
    </x-parts.basic_card_layout>
</div>
@endsection