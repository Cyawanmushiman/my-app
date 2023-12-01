@extends('layouts.mail.app')
@section('content')
<div class="container mt-5" style="max-width: 600px;">
    <h1 class="h3 border-bottom border-primary border-3 mb-5">MyAppからのお知らせ</h1>
    <div>
        下記のURLをクリックして会員登録手続きを完了して下さい。<br>
        <div class="text-center mt-3">
            <a href="{!! $verificationUrl !!}" class="w-50 btn btn-secondary">メールアドレス認証</a><br><br>
        </div>
    </div>
    <div class="mt-5">
        @include('components.parts.mail_footer')
    </div>
</div>
@endsection