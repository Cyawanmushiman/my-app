@extends('layouts.user.app')

@section('content')
<div class="container">
    <x-parts.basic_card_layout>
        <x-slot name="cardHeader">
            <h4 class="my-2">一覧：{{ $shortRunGoals->total() . '件中' . $shortRunGoals->firstItem() . '-' . $shortRunGoals->lastItem() }}件</h4>
            <a href="{{ route('user.short_run_goals.create') }}" class="btn btn-primary">作成する</a>
        </x-slot>
        <x-slot name="cardBody">
            <x-parts.basic_table_layout>
                <x-slot name="thead">
                    <tr>
                        <th scope="col" class="text-nowrap">タイトル</th>
                        <th scope="col" class="text-nowrap">作成日</th>
                        <th scope="col" class="text-nowrap">編集</th>
                        <th scope="col" class="text-nowrap">削除</th>
                    </tr>
                </x-slot>
                <x-slot name="tbody">
                    @if($shortRunGoals->isNotEmpty())
                        @foreach($shortRunGoals as $shortRunGoal)
                            <tr>
                                <td class="text-nowrap px-2"><a href="{{ route('user.short_run_goals.show', $shortRunGoal) }}">{{ $shortRunGoal->title }}</a></td>
                                <td class="text-nowrap px-2">{{ $shortRunGoal->created_at }}</td>
                                <td class="text-nowrap px-2"><a href="{{ route('user.short_run_goals.edit', $shortRunGoal) }}" class="btn btn-sm btn-outline-secondary">編集</a></td>
                                <td class="text-nowrap px-2">
                                    <form action="{{ route('user.short_run_goals.destroy', $shortRunGoal) }}" method="POST">
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
            <div class="row justify-content-center">
                {{ $shortRunGoals->links('pagination::bootstrap-4') }}
            </div>
        </x-slot>
    </x-parts.basic_card_layout>
</div>
@endsection
