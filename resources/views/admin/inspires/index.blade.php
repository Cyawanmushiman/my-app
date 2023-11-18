@extends('layouts.admin.app')

@section('content')
<div class="container">
    <x-parts.basic_card_layout>
        <x-slot name="cardHeader">
            <h4 class="my-2">インスパイア一覧：{{ $inspires->count() }}件</h4>
            <a href="{{ route('admin.inspires.create') }}" class="btn btn-primary text-white">作成する</a>
        </x-slot>
        <x-slot name="cardBody">
            <x-parts.basic_table_layout>
                <x-slot name="thead">
                    <tr>
                        <th scope="col" class="text-nowrap text-center">画像</th>
                        <th scope="col" class="text-nowrap text-center">コメント</th>
                        <th scope="col" class="text-nowrap text-center">削除</th>
                    </tr>
                </x-slot>
                <x-slot name="tbody">
                    @if($inspires->isNotEmpty())
                        @foreach($inspires as $inspire)
                            <tr>
                                <td class="text-nowrap px-2 text-center">
                                    <a href="{{ route('admin.inspires.edit', $inspire) }}">
                                        <img src="{{ $inspire->image_url }}" alt="インスパイア画像" style="max-width: 60px">
                                    </a>
                                </td>
                                <td class="text-nowrap px-2 text-center"><a href="{{ route('admin.inspires.edit', $inspire) }}">{{ $inspire->comment }}</a></td>
                                <td class="text-nowrap px-2 text-center">
                                    <form action="{{ route('admin.inspires.destroy', $inspire) }}" method="POST">
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
        </x-slot>
    </x-parts.basic_card_layout>
</div>
@endsection
