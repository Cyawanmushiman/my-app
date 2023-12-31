@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content">
        <h3 class="mb-5">Line連携の手順</h3>
        <ul class="mb-5">
            <li>1.「友達追加」をしてください。</li>
            <li>2. 「line連携」を行なってください。</li>
        </ul>
        <div class="mb-5">
            <h4>1.「友達追加」をしてください。</h4>
            <span>※ID：@021ksmkq</span>
            <img src="{{ asset('images/lines/line-qr.png') }}" alt="lineのQRコード">
        </div>
        @if (auth()->user()->line_id === null)
            <div class="mb-3">
                <h4>2. 「line連携」を行なってください。</h4>
                <a href="{{ route('user.notification_settings.line_alignment') }}" class="line-button d-flex align-items-center" style="width: 250px">
                    <i class="fa-brands fa-line me-2 fa-2x"></i>LINEと連携する
                </a>
            </div>
        @else
            <div class="alert alert-success">
                <p>現在、LINEと連携しています。</p>
            </div>
        @endif
        
        <div class="text-center my-4">
            <a href="{{ route('user.notification_settings.edit') }}" class="btn btn-outline-dark">前の画面へ戻る</a>
        </div>
        
    </div>
</section>
@endsection