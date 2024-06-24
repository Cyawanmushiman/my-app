@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content">
        <x-parts.basic_card_layout>
            <x-slot name="cardHeader">
                <h4 class="my-2">inspire list</h4>
                <div class="d-flex">
                    <form action="{{ route('user.inspires.set_default') }}" method="POST">
                        @csrf
    
                        <button type="submit" class="btn btn-outline-success me-2" onclick="return confirm('デフォルトの設定を適用しますか？')">set default</button>
                    </form>
                    <a href="{{ route('user.inspires.create') }}" class="btn btn-primary text-white">
                        <i class="fa-solid fa-plus fa-xs me-1"></i><i class="fa-solid fa-fire-flame-curved"></i>
                    </a>
                </div>
            </x-slot>
            <x-slot name="cardBody">
                <x-parts.basic_table_layout>
                    <x-slot name="thead">
                        <tr>
                            <th scope="col" class="text-nowrap text-center"></th>
                            <th scope="col" class="text-nowrap text-center">image</th>
                            <th scope="col" class="text-nowrap text-center">comment</th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @if($inspires->isNotEmpty())
                            @foreach($inspires as $inspire)
                                <tr class="align-baseline">
                                    <td class="text-nowrap px-2 text-center">
                                        <form action="{{ route('user.inspires.destroy', $inspire) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('本当に削除しますか？')"
                                            ><i class="fa-solid fa-trash"></i></button>
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
