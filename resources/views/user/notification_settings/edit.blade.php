@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content">
        <x-parts.basic_card_layout>
            <x-slot name="cardHeader">
                <h4 class="my-2">Notification Settings</h4>
            </x-slot>
            <x-slot name="cardBody">
                <form method="POST" action="{{ route('user.notification_settings.update') }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        @foreach (\App\Enums\DayOfWeek::cases() as $dayOfWeek)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link @if ($loop->first) active @endif"
                                id="{{ $dayOfWeek->value }}-tab" data-bs-toggle="tab"
                                data-bs-target="#{{ $dayOfWeek->value }}" type="button" role="tab"
                                aria-controls="{{ $dayOfWeek->value }}" aria-selected="true">{{ $dayOfWeek->value
                                }}</button>
                        </li>
                        @endforeach
                    </ul>

                    <!-- Tab panes -->
                    {{-- ここにバリデーションエラーメッセージを出す --}}
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li class="">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="tab-content">
                        {{-- <div class="p-5 tab-pane active" id="Monday" role="tabpanel" aria-labelledby="Monday-tab"
                            tabindex="0">
                            <div class="col-md-8 mb-3 mx-auto">
                                <label class="" for="Monday-content">content</label>
                                @include('components.form.textarea', ['name' => 'Monday' . '-content', 'required' =>
                                false,])
                            </div>
                            <div class="col-md-8 mb-3 mx-auto">
                                <label class="" for="Monday-action_time">time</label>
                                @include('components.form.time', ['name' => 'Monday' .'-action_time', 'required' =>
                                false])
                            </div>
                            <fieldset class="form-group col-md-8 mb-3 mx-auto">
                                <label class="">methods</label>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="Monday-methods[]"
                                            value="{{ \App\Enums\NotificationMethodType::Email }}">
                                        メール
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="Monday-methods[]"
                                            value="{{ \App\Enums\NotificationMethodType::Line }}">
                                        Line
                                    </label>
                                </div>
                            </fieldset>
                            <div class="form-check form-switch col-md-8 mb-3 mx-auto">
                                <input type="hidden" name="Monday-is_enable" value="off">
                                <input class="form-check-input" type="checkbox" role="switch" id="Monday-is_enable"
                                    name="Monday-is_enable">
                                <label class="form-check-label" for="Monday-is_enable">is Enable?</label>
                            </div>
                        </div> --}}
                        @foreach (\App\Enums\DayOfWeek::cases() as $dayOfWeek)
                        @php
                            $notificationSetting = $notificationSettings->where('day_of_week', $dayOfWeek->value)->first();
                        @endphp
                        <div class="p-5 tab-pane @if ($loop->first) active @endif" id="{{ $dayOfWeek->value }}"
                            role="tabpanel" aria-labelledby="{{ $dayOfWeek->value }}-tab" tabindex="0">
                            <div class="col-md-8 mb-3 mx-auto">
                                <label class="" for="{{ $dayOfWeek->value }}-content">content</label>
                                @include('components.form.textarea', ['name' => $dayOfWeek->value . '-content', 'required' =>
                                false, 'value' => $notificationSetting ? $notificationSetting->content : ''])
                                {{-- @include('components.form.error', ['name' => $dayOfWeek->value . '-content']) --}}
                            </div>
                            <div class="col-md-8 mb-3 mx-auto">
                                <label class="" for="{{ $dayOfWeek->value }}-action_time">time</label>
                                @include('components.form.time', ['name' => $dayOfWeek->value .'-action_time', 'required' =>
                                false, 'value' => $notificationSetting ?
                                $notificationSetting->action_time->format('H:i') : ''])
                                {{-- @include('components.form.error', ['name' => $dayOfWeek->value .'-action_time']) --}}
                            </div>
                            <fieldset class="form-group col-md-8 mb-3 mx-auto">
                                <label class="">methods</label>
                                {{-- <input type="hidden" name="{{ $dayOfWeek->value }}-methods[]" value=""> --}}
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox"
                                            name="{{ $dayOfWeek->value }}-methods[]"
                                            value="{{ \App\Enums\NotificationMethodType::Email }}" 
                                            @if ($notificationSetting && $notificationSetting->isSendEmail())
                                                checked
                                            @endif
                                        >
                                        メール
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox"
                                            name="{{ $dayOfWeek->value }}-methods[]"
                                            value="{{ \App\Enums\NotificationMethodType::Line }}" 
                                            @if ($notificationSetting && $notificationSetting->isSendLine())
                                                checked
                                            @endif>
                                        Line
                                    </label>
                                </div>
                            </fieldset>
                            <div class="form-check form-switch col-md-8 mb-3 mx-auto">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    id="{{ $dayOfWeek->value }}-is_enable" name="{{ $dayOfWeek->value }}-is_enable" 
                                    @if ($notificationSetting && $notificationSetting->is_enable)
                                        checked
                                    @endif
                                    >
                                <label class="form-check-label" for="{{ $dayOfWeek->value }}-is_enable">Enable?</label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary text-white w-50 mx-auto">Update</button>
                    </div>
                </form>
            </x-slot>
        </x-parts.basic_card_layout>
    </div>
</section>
@endsection
@section('script')
<script>
    const triggerTabList = document.querySelectorAll('#myTab button')
    triggerTabList.forEach(triggerEl => {
        const tabTrigger = new bootstrap.Tab(triggerEl)

        triggerEl.addEventListener('click', event => {
            event.preventDefault()
            tabTrigger.show()
        })
    })
</script>
@endsection