@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content">
        <x-parts.basic_card_layout>
            <x-slot name="cardHeader">
                <h4 class="my-2">Daily Goal List</h4>
                <a href="{{ route('user.daily_run_goals.create') }}" class="btn btn-primary text-white">
                    <i class="fa-solid fa-plus fa-xs me-1"></i><i class="fa-solid fa-flag"></i>
                </a>
            </x-slot>
            <x-slot name="cardBody">
                <div class="mb-4">
                    <x-parts.basic_table_layout>
                        <x-slot name="thead">
                            <tr>
                                <th scope="col" class="text-nowrap">title</th>
                                <th scope="col" class="text-nowrap"></th>
                            </tr>
                        </x-slot>
                        <x-slot name="tbody">
                            @if ($allDailyRunGoals->isEmpty())
                                <tr>
                                    <td colspan="3" class="text-center">毎日の目標が登録されていません</td>
                                </tr>
                            @else
                                @foreach($allDailyRunGoals as $dailyRunGoal)
                                    <tr>
                                        <td class="text-nowrap px-2"><a href="{{ route('user.daily_run_goals.edit', $dailyRunGoal) }}">{{ $dailyRunGoal->title }}</a></td>
                                        <td class="text-nowrap px-2 text-center">
                                            <form action="{{ route('user.daily_run_goals.destroy', $dailyRunGoal) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('本当に削除しますか？')"
                                                ><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </x-slot>
                    </x-parts.basic_table_layout>
                </div>
            </x-slot>
        </x-parts.basic_card_layout>
    </div>
</section>
@endsection
