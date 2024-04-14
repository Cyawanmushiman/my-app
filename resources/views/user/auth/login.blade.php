@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user.login') }}" class="mb-3">
                            @csrf

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-12 d-flex flex-column align-items-center">
                                    <button type="submit" class="btn btn-primary text-white mb-2">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('user.password.request'))
                                        <a class="btn btn-link mb-2" href="{{ route('user.password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif

                                    @if (app()->environment('local'))
                                        <a href="{{ route('user_dev_login') }}" class="btn btn-dark mb-2">開発中ログイン</a>
                                    @endif
                                    
                                    <a href="{{ route('user.linelogin') }}" class="line-button d-flex align-items-center">
                                        <i class="fa-brands fa-line me-2 fa-2x"></i>LINEでログインする
                                    </a>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                    

                </div>
                <div class="alert alert-light" role="alert">
                    <p>
                        本サイトの会員情報を連携することにより、各サイトIDを使ってログインすることができます。ログイン画面にある、【LINEログインする】ボタンより手続きを行なってください。なお、ログイン時の認証画面にて許可をいただいた場合のみ、LINEの登録情報を取得し連携します。情報は以下の項目となります。<br>
                        <i class="fa-solid fa-square me-2"></i>LINE:名前・メールアドレス
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
