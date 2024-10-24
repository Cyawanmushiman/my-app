@extends('layouts.user.app')

@section('title', 'Home')
@section('content')
<section class="resume-section pt-0" id="home">
    <div class="resume-section-content px-5 mt-5">
        @include('components.parts.purposes.goal_progress')
        <div style="max-height: 600px; overflow-y: auto;">
            {{-- <form method="POST" action="{{ route('user.home.store') }}" enctype="multipart/form-data" class="mt-4"> --}}
            <form method="POST" action="{{ route('user.challenging_logs.store') }}" enctype="multipart/form-data" class="mt-4">
                @csrf
                @error('daily_run_goal_ids')
                    <p class="text-center text-danger">{{ $message }}</p>
                @enderror
                <div class="d-flex justify-content-center">
                    <div class="d-flex flex-column justify-content-start">
                        <div class="form-body" v-for="goal in goals" :key="goal.id">
                            <div class="row">
                                <div class="col-12">
                                    <input type="checkbox" v-model="goal.is_finished" @change="updateGoal(goal)" :id="'goal-' + goal.id" name="daily_run_goal_ids[]" :value="Number(goal.id)">
                                    <label :class="{ 'text-decoration-line-through': goal.is_finished }" class="h5" :for="'goal-' + goal.id">
                                        @{{ goal.title }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="accordion accordion-flush" id="accordionFlushReason">
                    @if ($reason && $reason->content !== null)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingReason">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-reason" aria-expanded="false" aria-controls="flush-reason">
                                Why do you want to achieve this goal ?
                            </button>
                            </h2>
                            <div id="flush-reason" class="accordion-collapse collapse" aria-labelledby="flush-headingReason" data-bs-parent="#accordionFlushReason">
                            <div class="accordion-body">{!! nl2br(e($reason->content)) !!}</div>
                        </div>
                    @endif
                    @if ($tip && $tip->content !== null)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTip">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-tip" aria-expanded="false" aria-controls="flush-tip">
                                What's the tips ?
                            </button>
                            </h2>
                            <div id="flush-tip" class="accordion-collapse collapse" aria-labelledby="flush-headingTip" data-bs-parent="#accordionFlushReason">
                            <div class="accordion-body">{!! nl2br(e($tip->content)) !!}</div>
                        </div>
                    @endif
                    @if ($reward && $reward->content !== null)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingReward">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-reward" aria-expanded="false" aria-controls="flush-reward">
                                What do you want ?
                            </button>
                            </h2>
                            <div id="flush-reward" class="accordion-collapse collapse" aria-labelledby="flush-headingReward" data-bs-parent="#accordionFlushReason">
                            <div class="accordion-body">{!! nl2br(e($reward->content)) !!}</div>
                        </div>
                    @endif
                </div>
                
                <div class="form-body mt-5">
                    <div class="row">
                        <div class="col-12 d-flex align-items-center">
                            @include('components.form.textarea', [
                                'name' => 'diary', 
                                'rows' => 10,
                                'placeholder' => 'Please enter what happened today'
                            ])
                        </div>
                        @include('components.form.error', ['name' => 'diary'])
                    </div>
                </div>
                @if ($isNotChallenging)
                    <div class="text-center my-4">
                        <a href="{{ route('user.challengings.create') }}">戦いに挑戦する方はこちら</a>
                    </div>
                @endif
                <div class="text-center my-4">
                    <button type="submit" class="btn btn-primary text-white">
                        Log today's record
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
@section('script')
<script>
    Vue.createApp({
        data() {
            return {
                goals: @json($goals),
            };
        },
        methods: {
            updateGoal(goal) {
                axios.post('/api/daily_run_goals/update', {
                    id: goal.id,
                    is_finished: goal.is_finished,
                })
                .then(response => {
                    console.log(response);
                })
                .catch(error => {
                    console.error(error);
                });
            },
        }
    }).mount('#home')
</script>

@endsection