@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content">
        <x-parts.basic_card_layout>
            <x-slot name="cardHeader">
                <h4 class="my-2">Mind Map List</h4>
                <div class="d-flex">
                    <a href="{{ route('user.mind_maps.edit_sort') }}" class="btn btn-outline-primary me-2"><i class="fa-solid fa-arrow-down-1-9"></i></a>
                    <a href="{{ route('user.mind_maps.create') }}" class="btn btn-primary text-white">
                        <i class="fa-solid fa-plus fa-xs me-1"></i><i class="bi bi-diagram-3-fill"></i>
                    </a>
                </div>
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
                            @if ($mindMaps->isEmpty())
                                <tr>
                                    <td colspan="3" class="text-center">毎日の目標が登録されていません</td>
                                </tr>
                            @else
                                @foreach($mindMaps as $mindMap)
                                    <tr>
                                        <td class="text-nowrap px-2">
                                            <a href="{{ route('user.mind_maps.edit', $mindMap) }}">{{ $mindMap->title }}</a>
                                        </td>
                                        <td class="text-nowrap text-center px-2">
                                            <form action="{{ route('user.mind_maps.destroy', $mindMap) }}" method="POST">
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
