@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content">
        <x-parts.basic_card_layout>
            <x-slot name="cardHeader">
                <h4 class="my-2">Daily Goal List</h4>
                <a href="{{ route('user.daily_run_goals.create') }}" class="btn btn-primary text-white">create</a>
            </x-slot>
            <x-slot name="cardBody">
                <div class="mb-4">
                    <x-parts.basic_table_layout>
                        <x-slot name="thead">
                            <tr>
                                <th scope="col" class="text-nowrap">タイトル</th>
                                <th scope="col" class="text-nowrap">作成日</th>
                                <th scope="col" class="text-nowrap">削除</th>
                            </tr>
                        </x-slot>
                        <x-slot name="tbody">
                            @foreach($allDailyRunGoals as $dailyRunGoal)
                                <tr>
                                    <td class="text-nowrap px-2"><a href="{{ route('user.daily_run_goals.edit', $dailyRunGoal) }}">{{ $dailyRunGoal->title }}</a></td>
                                    <td class="text-nowrap px-2">{{ $dailyRunGoal->created_at }}</td>
                                    <td class="text-nowrap px-2">
                                        <form action="{{ route('user.short_run_goals.destroy', $dailyRunGoal) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('本当に削除しますか？')"
                                            >削除</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </x-slot>
                    </x-parts.basic_table_layout>
                </div>
            </x-slot>
        </x-parts.basic_card_layout>
    </div>
</section>
@endsection
