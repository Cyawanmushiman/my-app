@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content">
        <x-parts.basic_card_layout>
            <x-slot name="cardHeader">
                <h4 class="my-2">Setting</h4>
            </x-slot>
            <x-slot name="cardBody">
                <div class="mb-4">
                    <x-parts.basic_table_layout>
                        <x-slot name="thead">
                            <tr>
                                <th scope="col" class="text-nowrap">terms</th>
                                <th scope="col" class="text-nowrap"></th>
                            </tr>
                        </x-slot>
                        <x-slot name="tbody">
                            <tr>
                                <td class="text-nowrap px-2">
                                    <a href="{{ route('user.email.change.form') }}">change your email</a>
                                </td>
                            </tr>
                        </x-slot>
                    </x-parts.basic_table_layout>
                </div>
            </x-slot>
        </x-parts.basic_card_layout>
    </div>
</section>
@endsection
