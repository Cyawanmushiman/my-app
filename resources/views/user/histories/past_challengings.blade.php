@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content">
        <x-parts.basic_card_layout>
            <x-slot name="cardHeader">
                <h4 class="my-2">past challengings</h4>
                <a href="{{ route('user.histories.index') }}" class="btn btn-outline-dark"><i
                        class="fa-solid fa-reply"></i></a>
            </x-slot>
            <x-slot name="cardBody">
                {{-- 検索フォーム --}}
                {{-- <form action="{{ route('user.histories.past_challengings') }}" method="get">
                    @csrf
                    
                    <div class="d-flex justify-content-center align-items-center mb-3">
                        <div class="col-2">
                            <label for="search_challenging">search challenging</label>
                        </div>
                        <div class="col-8">
                            @include('components.form.text', ['name' => "search_challenging", 'value' => \Request::get('search_challenging') ?? ''])
                            @include('components.form.error', ['name' => "search_challenging"])
                        </div>
                        <button type="submit" class="btn btn-primary text-white">
                            <i class="fa-solid fa-search"></i>
                        </button>
                        <a href="{{ route('user.histories.past_challengings') }}">
                            <button type="button" class="btn btn-outline-dark">
                                <i class="fa-solid fa-rotate-right"></i>
                            </button>
                        </a>
                    </div>
                </form> --}}
                <div class="row justify-content-center">
                    {{ $challengings->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
                <x-parts.basic_table_layout>
                    <x-slot name="thead">
                        <tr>
                            <th scope="col" class="text-nowrap text-center">challeng date</th>
                            <th scope="col" class="text-nowrap text-center">result</th>
                            <th scope="col" class="text-nowrap text-center">reward</th>
                            <th scope="col" class="text-nowrap text-center">reward link</th>
                            <th scope="col" class="text-nowrap text-center">archive date</th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @if($challengings->isNotEmpty())
                            @foreach($challengings as $challenging)
                                <tr>
                                    <td class="text-nowrap px-2 text-center">
                                        {{ $challenging->created_at->format('Y/m/d') }}
                                    </td>
                                    <td class="text-nowrap px-2 text-center">
                                        {{ App\Models\Challenging::FIGHTING_STATUS[$challenging->result_status] }}
                                    </td>
                                    <td class="text-nowrap px-2 text-start">
                                        {{ $challenging->reward }}
                                    </td>
                                    <td class="text-nowrap px-2 text-start">
                                        <a href="{{ $challenging->reward_link }}">
                                            {{ \Illuminate\Support\Str::limit($challenging->reward_link, 25) }}
                                        </a>
                                    </td>                                    
                                    <td class="text-nowrap px-2 text-start">
                                        {{ $challenging->archived_on?->format('Y/m/d') }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="text-nowrap px-2 text-center">登録されたチャレンジはありません</td>
                            </tr>
                        @endif
                    </x-slot>
                </x-parts.basic_table_layout>
            </x-slot>
        </x-parts.basic_card_layout>
    </div>
</section>
@endsection