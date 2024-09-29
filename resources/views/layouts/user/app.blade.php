<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <!-- title -->
    @hasSection('title')
    <title>MyApp | @yield('title')</title>
    @else
    <title>MyApp</title>
    @endif
    
    <!-- description -->
    @hasSection('description')
        <meta name="description" content="@yield('description')">
    @else
        <meta name="description" content="自分だけの目標達成アプリ">
    @endif

    <meta name="keywords" content>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">

    {{-- OGP --}}
    @hasSection('ogp')
        @yield('ogp')
    @else
        <meta property="og:title" content="MyApp" />
        <meta property="og:description" content="自分だけの目標達成アプリ">
        <meta property="og:type" content="website" />
        <meta property="og:url" content="{{ config('app.url') }}" />
        <meta property="og:image" content="{{asset("images/logo.png")}}" />
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:image" content="{{asset("images/logo.png")}}">
    @endif

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if (!app()->environment('production'))
    {{-- 本番環境以外では必ずnoindexを付与 --}}
    <meta name="robots" content="noindex">
    @endif

    {{-- favicon --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/images/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('/images/favicon-180.png') }}" sizes="180x180">
    <link rel="icon" type="image/png" href="{{ asset('/images/favicon-190.png') }}" sizes="192x192">

    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet" type="text/css" />
    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- bootstrap icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    @vite(['resources/sass/app.scss'])
    {{-- js-mind css --}}
    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsmind@0.7.5/style/jsmind.css"/>
</head>

<body id="page-top" class="d-flex">
    <!-- 狭いナビバー-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary narrowNav" id="sideNav">
        <div id="toWideButton" class="d-none d-lg-block" style="cursor:pointer; color:white;">
            <i class="fa-solid fa-right-left"></i>
        </div>
        @guest
            <a class="navbar-brand js-scroll-trigger" href="{{ route('user.home') }}">
                <h5 class="d-none d-lg-block text-white">M</h5>
            </a>
            {{-- ログインしていれば表示 --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav">
                    @if (Route::has('user.login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.login') }}"> 
                                @if (Str::contains(request()->url(), '/login'))
                                    <i class="fas fa-sign-in-alt text-info"></i>
                                @else
                                    <i class="fas fa-sign-in-alt"></i>
                                @endif
                            </a>
                        </li>
                    @endif
                    @if (Route::has('user.register'))
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="{{ route('user.register') }}">
                                @if (Str::contains(request()->url(), '/register'))
                                    <i class="fas fa-user-plus text-info"></i>
                                @else
                                    <i class="fas fa-user-plus"></i>
                                @endif
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        @else
            <a class="navbar-brand js-scroll-trigger" href="{{ route('user.home') }}">
                <h5 class="d-none d-lg-block text-white">M</h5>
            </a>
            {{-- ログインしていれば表示 --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="{{ route('user.home') }}" id="HOME">
                            @if (Str::contains(request()->url(), '/home'))
                                <i class="fa-solid fa-house text-info"></i>
                            @else
                                <i class="fa-solid fa-house"></i>
                            @endif
                        </a>
                    </li>
                    @if (auth()->user()->isFinishedSetUp())
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="{{ route('user.mind_maps.index') }}" id="MindMap">
                                @if (Str::contains(request()->url(), '/mind_maps'))
                                    <i class="bi bi-diagram-3-fill text-info"></i>    
                                @else
                                    <i class="bi bi-diagram-3-fill"></i>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="{{ route('user.daily_run_goals.index') }}">
                                @if (Str::contains(request()->url(), '/daily_run_goals'))
                                    <i class="fa-solid fa-flag text-info"></i>    
                                @else
                                    <i class="fa-solid fa-flag"></i>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="{{ route('user.inspires.index') }}">
                                @if (Str::contains(request()->url(), '/inspires'))
                                    <i class="fa-solid fa-fire-flame-curved text-info"></i>
                                @else
                                    <i class="fa-solid fa-fire-flame-curved"></i>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="{{ route('user.purposes.index') }}">
                                @if (Str::contains(request()->url(), '/purposes'))
                                    <i class="fa-solid fa-bullseye text-info"></i>
                                @else
                                    <i class="fa-solid fa-bullseye"></i>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="{{ route('user.histories.index') }}">
                                @if (Str::contains(request()->url(), '/histories'))
                                    <i class="fas fa-history text-info"></i>
                                @else
                                    <i class="fas fa-history"></i>
                                @endif
                            </a>
                        </li>
                        @if (auth()->user()->email === 'smallriver1878@gmail.com' || app()->environment('local'))
                            <li class="nav-item">
                                <a class="nav-link js-scroll-trigger" href="{{ route('user.notification_settings.edit') }}">
                                    @if (Str::contains(request()->url(), '/notification_settings'))
                                        <i class="fa-solid fa-bell text-info"></i>
                                    @else
                                        <i class="fa-solid fa-bell"></i>
                                    @endif
                                </a>
                            </li>
                        @endif
                    @endif
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="{{ url('user/logout') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </a>

                        <form id="logout-form" action="{{ url('user/logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        @endguest
    </nav>
    {{-- 広いナビバー --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary wideNav" id="sideNav">
        <div id="toNarrowButton" class="d-none d-lg-block" style="cursor:pointer; color:white;">
            <i class="fa-solid fa-right-left"></i>
        </div>
        @guest
            <a class="navbar-brand js-scroll-trigger" href="{{ route('user.home') }}">
                <h3 class="d-block d-lg-none text-white mb-0">MyApp</h3>
                <h2 class="d-none d-lg-block text-white">MyApp</h2>
            </a>
            {{-- ログインしていれば表示 --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-end">
                    @if (Route::has('user.login'))
                        <li class="nav-item">
                            @if (Str::contains(request()->url(), '/login'))
                                <a class="nav-link text-info" href="{{ route('user.login') }}">
                                    Login<i class="fas fa-sign-in-alt ms-2"></i>
                                </a>
                            @else
                                <a class="nav-link js-scroll-trigger" href="{{ route('user.login') }}">
                                    Login<i class="fas fa-sign-in-alt ms-2"></i>
                                </a>
                            @endif
                        </li>
                    @endif
                    @if (Route::has('user.register'))
                        <li class="nav-item">
                            @if (Str::contains(request()->url(), '/register'))
                                <a class="nav-link text-info" href="{{ route('user.register') }}">
                                    Register<i class="fas fa-user-plus ms-2"></i>
                                </a>
                            @else
                                <a class="nav-link js-scroll-trigger" href="{{ route('user.register') }}">
                                    Register<i class="fas fa-user-plus ms-2"></i>
                                </a>
                            @endif
                        </li>
                    @endif
                </ul>
            </div>
        @else
            <a class="navbar-brand js-scroll-trigger" href="{{ route('user.home') }}">
                <h3 class="d-block d-lg-none text-white mb-0">MyApp</h3>
                <h2 class="d-none d-lg-block text-white">MyApp</h2>
            </a>
            {{-- ログインしていれば表示 --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-end">
                    <li class="nav-item">
                        @if (Str::contains(request()->url(), '/home'))
                            <a class="nav-link text-info" href="{{ route('user.home') }}" id="HOME">
                                HOME<i class="fa-solid fa-house ms-2"></i>
                            </a>
                        @else
                            <a class="nav-link js-scroll-trigger" href="{{ route('user.home') }}" id="HOME">
                                HOME<i class="fa-solid fa-house ms-2"></i>
                            </a>
                        @endif
                    </li>
                    @if (auth()->user()->isFinishedSetUp())
                        <li class="nav-item">
                            @if (Str::contains(request()->url(), '/mind_maps'))
                                <a class="nav-link text-info" href="{{ route('user.mind_maps.index') }}" id="MindMap">
                                    Mind Map<i class="bi bi-diagram-3-fill ms-2"></i>
                                </a>
                            @else
                                <a class="nav-link js-scroll-trigger" href="{{ route('user.mind_maps.index') }}" id="MindMap">
                                    Mind Map<i class="bi bi-diagram-3-fill ms-2"></i>
                                </a>
                            @endif
                        </li>
                        <li class="nav-item">
                            @if (Str::contains(request()->url(), '/daily_run_goals'))
                                <a class="nav-link text-info" href="{{ route('user.daily_run_goals.index') }}">
                                    Daily Goals<i class="fa-solid fa-flag ms-2"></i>
                                </a>
                            @else
                                <a class="nav-link js-scroll-trigger" href="{{ route('user.daily_run_goals.index') }}">
                                    Daily Goals<i class="fa-solid fa-flag ms-2"></i>
                                </a>
                            @endif
                        </li>
                        <li class="nav-item">
                            @if (Str::contains(request()->url(), '/inspires'))
                                <a class="nav-link text-info" href="{{ route('user.inspires.index') }}">
                                    Inspires<i class="fa-solid fa-fire-flame-curved ms-2"></i>
                                </a>
                            @else
                                <a class="nav-link js-scroll-trigger" href="{{ route('user.inspires.index') }}">
                                    Inspires<i class="fa-solid fa-fire-flame-curved ms-2"></i>
                                </a>
                            @endif
                        </li>
                        <li class="nav-item">
                            @if (Str::contains(request()->url(), '/purposes'))
                                <a class="nav-link text-info" href="{{ route('user.purposes.index') }}">
                                    Purpose<i class="fa-solid fa-bullseye ms-2"></i>
                                </a>
                            @else
                                <a class="nav-link js-scroll-trigger" href="{{ route('user.purposes.index') }}">
                                    Purpose<i class="fa-solid fa-bullseye ms-2"></i>
                                </a>
                            @endif
                        </li>
                        {{-- <li class="nav-item">
                            @if (Str::contains(request()->url(), '/histories'))
                                <a class="nav-link text-info" href="{{ route('user.histories.index') }}">
                                    Histories<i class="fas fa-history ms-2"></i>
                                </a>
                            @else
                                <a class="nav-link js-scroll-trigger" href="{{ route('user.histories.index') }}">
                                    Histories<i class="fas fa-history ms-2"></i>
                                </a>
                            @endif
                        </li> --}}
                        @if (auth()->user()->email === 'smallriver1878@gmail.com' || app()->environment('local'))
                            <li class="nav-item">
                                @if (Str::contains(request()->url(), '/notification_settings'))
                                    <a class="nav-link text-info" href="{{ route('user.notification_settings.edit') }}">
                                        Notifications<i class="fa-solid fa-bell ms-2"></i>
                                    </a>
                                @else
                                    <a class="nav-link js-scroll-trigger" href="{{ route('user.notification_settings.edit') }}">
                                        Notifications<i class="fa-solid fa-bell ms-2"></i>
                                    </a>
                                @endif
                            </li>
                        @endif
                    @endif
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="{{ url('user/logout') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            logout
                            <i class="fa-solid fa-right-from-bracket ms-1"></i>
                        </a>

                        <form id="logout-form" action="{{ url('user/logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        @endguest
    </nav>
    {{-- 992px以下のサイドバー --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary d-lg-none px-3 fixed-top" id="sideNav">
        @guest
            <a class="navbar-brand js-scroll-trigger" href="{{ route('user.home') }}">
                <h3 class="d-block d-lg-none text-white mb-0">MyApp</h3>
                <h2 class="d-none d-lg-block text-white">MyApp</h2>
            </a>
            {{-- ログインしていれば表示 --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-end">
                    @if (Route::has('user.login'))
                        <li class="nav-item">
                            @if (Str::contains(request()->url(), '/login'))
                                <a class="nav-link text-info" href="{{ route('user.login') }}">
                                    Login<i class="fas fa-sign-in-alt ms-2"></i>
                                </a>
                            @else
                                <a class="nav-link js-scroll-trigger" href="{{ route('user.login') }}">
                                    Login<i class="fas fa-sign-in-alt ms-2"></i>
                                </a>
                            @endif
                        </li>
                    @endif
                    @if (Route::has('user.register'))
                        <li class="nav-item">
                            @if (Str::contains(request()->url(), '/register'))
                                <a class="nav-link text-info" href="{{ route('user.register') }}">
                                    Register<i class="fas fa-user-plus ms-2"></i>
                                </a>
                            @else
                                <a class="nav-link js-scroll-trigger" href="{{ route('user.register') }}">
                                    Register<i class="fas fa-user-plus ms-2"></i>
                                </a>
                            @endif
                        </li>
                    @endif
                </ul>
            </div>
        @else
            <a class="navbar-brand js-scroll-trigger" href="{{ route('user.home') }}">
                <h3 class="d-block d-lg-none text-white mb-0">MyApp</h3>
                <h2 class="d-none d-lg-block text-white">MyApp</h2>
            </a>
            {{-- ログインしていれば表示 --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-end">
                    <li class="nav-item">
                        @if (Str::contains(request()->url(), '/home'))
                            <a class="nav-link text-info" href="{{ route('user.home') }}" id="HOME">
                                HOME<i class="fa-solid fa-house ms-2"></i>
                            </a>
                        @else
                            <a class="nav-link js-scroll-trigger" href="{{ route('user.home') }}" id="HOME">
                                HOME<i class="fa-solid fa-house ms-2"></i>
                            </a>
                        @endif
                    </li>
                    @if (auth()->user()->isFinishedSetUp())
                        <li class="nav-item">
                            @if (Str::contains(request()->url(), '/mind_maps'))
                                <a class="nav-link text-info" href="{{ route('user.mind_maps.index') }}" id="MindMap">
                                    Mind Map<i class="bi bi-diagram-3-fill ms-2"></i>
                                </a>
                            @else
                                <a class="nav-link js-scroll-trigger" href="{{ route('user.mind_maps.index') }}" id="MindMap">
                                    Mind Map<i class="bi bi-diagram-3-fill ms-2"></i>
                                </a>
                            @endif
                        </li>
                        <li class="nav-item">
                            @if (Str::contains(request()->url(), '/daily_run_goals'))
                                <a class="nav-link text-info" href="{{ route('user.daily_run_goals.index') }}">
                                    Daily Goals<i class="fa-solid fa-flag ms-2"></i>
                                </a>
                            @else
                                <a class="nav-link js-scroll-trigger" href="{{ route('user.daily_run_goals.index') }}">
                                    Daily Goals<i class="fa-solid fa-flag ms-2"></i>
                                </a>
                            @endif
                        </li>
                        <li class="nav-item">
                            @if (Str::contains(request()->url(), '/inspires'))
                                <a class="nav-link text-info" href="{{ route('user.inspires.index') }}">
                                    Inspires<i class="fa-solid fa-fire-flame-curved ms-2"></i>
                                </a>
                            @else
                                <a class="nav-link js-scroll-trigger" href="{{ route('user.inspires.index') }}">
                                    Inspires<i class="fa-solid fa-fire-flame-curved ms-2"></i>
                                </a>
                            @endif
                        </li>
                        <li class="nav-item">
                            @if (Str::contains(request()->url(), '/purposes'))
                                <a class="nav-link text-info" href="{{ route('user.purposes.index') }}">
                                    Purpose<i class="fa-solid fa-bullseye ms-2"></i>
                                </a>
                            @else
                                <a class="nav-link js-scroll-trigger" href="{{ route('user.purposes.index') }}">
                                    Purpose<i class="fa-solid fa-bullseye ms-2"></i>
                                </a>
                            @endif
                        </li>
                        {{-- <li class="nav-item">
                            @if (Str::contains(request()->url(), '/histories'))
                                <a class="nav-link text-info" href="{{ route('user.histories.index') }}">
                                    Histories<i class="fas fa-history ms-2"></i>
                                </a>
                            @else
                                <a class="nav-link js-scroll-trigger" href="{{ route('user.histories.index') }}">
                                    Histories<i class="fas fa-history ms-2"></i>
                                </a>
                            @endif
                        </li> --}}
                        @if (auth()->user()->email === 'smallriver1878@gmail.com' || app()->environment('local'))
                            <li class="nav-item">
                                @if (Str::contains(request()->url(), '/notification_settings'))
                                    <a class="nav-link text-info" href="{{ route('user.notification_settings.edit') }}">
                                        Notifications<i class="fa-solid fa-bell ms-2"></i>
                                    </a>
                                @else
                                    <a class="nav-link js-scroll-trigger" href="{{ route('user.notification_settings.edit') }}">
                                        Notifications<i class="fa-solid fa-bell ms-2"></i>
                                    </a>
                                @endif
                            </li>
                        @endif
                    @endif
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="{{ url('user/logout') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            logout
                            <i class="fa-solid fa-right-from-bracket ms-1"></i>
                        </a>

                        <form id="logout-form" action="{{ url('user/logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        @endguest
    </nav>
    <!-- Page Content-->
    <div class="container-fluid p-0" id="container">
        {{-- フラッシュメッセージ --}}
        @include('components.parts.flash_message')
        @yield('content')
    </div>
    {{-- vue3 --}}
    <script src="https://unpkg.com/vue@3"></script>
    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    {{-- Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    {{-- popoverの初期化 --}}
    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>
    {{-- js-mind --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jsmind@0.7.5/es6/jsmind.js"></script>
    <script type="text/javascript" src="https://unpkg.com/jsmind@0.7.5/es6/jsmind.draggable-node.js"></script>
    @yield('script')
    @yield('flash_message_script')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // ナビバーの表示切り替え
            const narrowNav = document.querySelector('.narrowNav');
            const wideNav = document.querySelector('.wideNav');
            const toNarrowButton = document.querySelector('#toNarrowButton');
            const toWideButton = document.querySelector('#toWideButton');
            
            // セッションに保存されたナビバーの表示状態を取得
            const navState = sessionStorage.getItem('navState');
            if (navState === 'narrow') {
                narrowNav.classList.remove('d-none');
                wideNav.classList.add('d-none');
            } else {
                narrowNav.classList.add('d-none');
                wideNav.classList.remove('d-none');
            }
            
            toNarrowButton.addEventListener('click', () => {
                narrowNav.classList.remove('d-none');
                wideNav.classList.add('d-none');
                sessionStorage.setItem('navState', 'narrow');
            });
            
            toWideButton.addEventListener('click', () => {
                narrowNav.classList.add('d-none');
                wideNav.classList.remove('d-none');
                sessionStorage.setItem('navState', 'wide');
            });            
        });
    </script>
</body>
</html>