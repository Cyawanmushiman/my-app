@extends('layouts.user.app')

@section('content')
<div class="container">
    <x-parts.basic_card_layout>
        <x-slot name="cardHeader">
            <h4 class="my-2">中期目標一覧</h4>
            <a href="{{ route('user.middle_run_goals.create') }}" class="btn btn-primary">作成する</a>
        </x-slot>
        <x-slot name="cardBody">
            @foreach ($groupedMiddleRunGoals as $longRunGoalTitle => $middleRunGoals)
                <div class="mb-4">
                    <h5 class="my-2">{{ $longRunGoalTitle }}</h5>
                    <x-parts.basic_table_layout>
                        <x-slot name="thead">
                            <tr>
                                <th scope="col" class="text-nowrap">タイトル</th>
                                <th scope="col" class="text-nowrap">作成日</th>
                                <th scope="col" class="text-nowrap">削除</th>
                            </tr>
                        </x-slot>
                        <x-slot name="tbody">
                            @if($middleRunGoals->isNotEmpty())
                                @foreach($middleRunGoals as $middleRunGoal)
                                    <tr>
                                        <td class="text-nowrap px-2"><a href="{{ route('user.middle_run_goals.edit', $middleRunGoal) }}">{{ $middleRunGoal->title }}</a></td>
                                        <td class="text-nowrap px-2">{{ $middleRunGoal->created_at }}</td>
                                        <td class="text-nowrap px-2">
                                            <form action="{{ route('user.middle_run_goals.destroy', $middleRunGoal) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('本当に削除しますか？')"
                                                >削除</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </x-slot>
                    </x-parts.basic_table_layout>
                </div>
            @endforeach
        </x-slot>
    </x-parts.basic_card_layout>
</div>
@endsection
