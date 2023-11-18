@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content">
        <x-parts.basic_card_layout>
            <x-slot name="cardHeader">
                <h4 class="my-2">inspire list</h4>
                <form action="{{ route('user.inspires.set_default') }}" method="POST">
                    @csrf

                    <button type="submit" class="btn btn-outline-success" onclick="return confirm('デフォルトの設定を適用しますか？')">デフォルトをセット</button>
                </form>
                <a href="{{ route('user.inspires.create') }}" class="btn btn-primary text-white">create</a>
            </x-slot>
            <x-slot name="cardBody">
                <x-parts.basic_table_layout>
                    <x-slot name="thead">
                        <tr>
                            <th scope="col" class="text-nowrap text-center">削除</th>
                            <th scope="col" class="text-nowrap text-center">画像</th>
                            <th scope="col" class="text-nowrap text-center">コメント</th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @if($inspires->isNotEmpty())
                            @foreach($inspires as $inspire)
                                <tr>
                                    <td class="text-nowrap px-2 text-center">
                                        <form action="{{ route('user.inspires.destroy', $inspire) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('本当に削除しますか？')"
                                            >削除</button>
                                        </form>
                                    </td>
                                    <td class="text-nowrap px-2 text-center">
                                        <a href="{{ route('user.inspires.edit', $inspire) }}">
                                            <img src="{{ $inspire->image_url }}" alt="インスパイア画像" style="max-width: 60px">
                                        </a>
                                    </td>
                                    <td class="text-nowrap px-2 text-start"><a href="{{ route('user.inspires.edit', $inspire) }}">{{ $inspire->comment }}</a></td>
                                </tr>
                            @endforeach
                        @endif
                    </x-slot>
                </x-parts.basic_table_layout>
            </x-slot>
        </x-parts.basic_card_layout>
    </div>
</section>
@endsection
