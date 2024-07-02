@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content">
        @include('components.parts.purposes.goal_progress')
        <x-parts.basic_card_layout>
            <x-slot name="cardHeader">
                <h4 class="my-2">Middle Term List</h4>
                <div class="d-flex">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-dark me-1">
                        <i class="fa-solid fa-reply"></i>
                    </a>
                    <a href="{{ route('user.middle_run_goals.create', $longRunGoal) }}" class="btn btn-primary text-white">create</a>
                </div>
            </x-slot>
            <x-slot name="cardBody">
                <div class="mb-4">
                    <h5 class="my-2">{{ $longRunGoal->title }}</h5>
                    <x-parts.basic_table_layout>
                        <x-slot name="thead">
                            <tr>
                                <th scope="col" class="text-nowrap">title</th>
                                <th scope="col" class="text-nowrap">finish date</th>
                                <th scope="col" class="text-nowrap"></th>
                            </tr>
                        </x-slot>
                        <x-slot name="tbody">
                            @if($middleRunGoals->isNotEmpty())
                                @foreach($middleRunGoals as $middleRunGoal)
                                    <tr>
                                        <td class="text-nowrap px-2"><a href="{{ route('user.middle_run_goals.edit', $middleRunGoal) }}">{{ $middleRunGoal->title }}</a></td>
                                        <td class="text-nowrap px-2">{{ $middleRunGoal->finish_on->format('Y-m-d') }}</td>
                                        <td class="text-nowrap px-2 text-center">
                                            <form action="{{ route('user.middle_run_goals.destroy', $middleRunGoal) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                
                                                <input type="hidden" name="long_run_goal_id" value="{{ $longRunGoal->id }}">
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
