@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content">
        <x-parts.basic_card_layout>
            <x-slot name="cardHeader">
                <h4 class="my-2">past scores</h4>
                <a href="{{ route('user.histories.index') }}" class="btn btn-outline-dark"><i
                        class="fa-solid fa-reply"></i></a>
            </x-slot>
            <x-slot name="cardBody">
                <form action="{{ route('user.histories.past_scores') }}" method="get">
                    @csrf
                    
                    {{-- 日記のフォーム --}}
                    <div class="d-flex justify-content-center align-items-center mb-3">
                        <div class="col-2">
                            <label for="search_diary">search diary</label>
                        </div>
                        <div class="col-8">
                            @include('components.form.text', ['name' => "search_diary", 'value' => \Request::get('search_diary') ?? ''])
                            @include('components.form.error', ['name' => "search_diary"])
                        </div>
                        <button type="submit" class="btn btn-primary text-white">
                            <i class="fa-solid fa-search"></i>
                        </button>
                        <a href="{{ route('user.histories.past_scores') }}">
                            <button type="button" class="btn btn-outline-dark">
                                <i class="fa-solid fa-rotate-right"></i>
                            </button>
                        </a>
                    </div>
                </form>
                <div class="row justify-content-center">
                    {{ $dailyScores->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
                <x-parts.basic_table_layout>
                    <x-slot name="thead">
                        <tr>
                            <th scope="col" class="text-nowrap text-center">save date</th>
                            <th scope="col" class="text-nowrap text-center">score</th>
                            <th scope="col" class="text-nowrap text-center">diary</th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @if($dailyScores->isNotEmpty())
                        @foreach($dailyScores as $dailyScore)
                        <tr>
                            <td class="text-nowrap px-2 text-center">
                                {{ $dailyScore->created_at->format('Y/m/d') }}
                            </td>
                            <td class="text-nowrap px-2 text-center">
                                {{ $dailyScore->score }}
                            </td>
                            <td class="text-nowrap px-2 text-start">
                                {{-- {!! $dailyScore->diary !!} --}}
                                {!! nl2br(e($dailyScore->diary)) !!}

                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="3" class="text-nowrap px-2 text-center">登録されたスコアはありません</td>
                        </tr>
                        @endif
                    </x-slot>
                </x-parts.basic_table_layout>
            </x-slot>
        </x-parts.basic_card_layout>
    </div>
</section>
@endsection