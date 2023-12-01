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
    {{-- bootstrap icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    {{-- js-mind css --}}
    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsmind@0.7.5/style/jsmind.css"/>
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
        @guest
            <a class="navbar-brand js-scroll-trigger" href="{{ route('user.home') }}">
                {{-- <span class="d-block d-lg-none">MyApp</span> --}}
                <h3 class="d-block d-lg-none text-white mb-0">MyApp</h3>
                {{-- <span class="d-none d-lg-block"><img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="assets/img/profile.jpg" alt="..." /></span> --}}
                <h2 class="d-none d-lg-block text-white">MyApp</h2>
            </a>
            {{-- ログインしていれば表示 --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-end">
                    @if (Route::has('user.login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.login') }}">
                                Login<i class="fas fa-sign-in-alt ms-2"></i>
                            </a>
                        </li>
                    @endif
                    @if (Route::has('user.register'))
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="{{ route('user.register') }}">
                                Register<i class="fas fa-user-plus ms-2"></i>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        @else
            <a class="navbar-brand js-scroll-trigger" href="{{ route('user.home') }}">
                {{-- <span class="d-block d-lg-none">MyApp</span> --}}
                <h3 class="d-block d-lg-none text-white mb-0">MyApp</h3>
                {{-- <span class="d-none d-lg-block"><img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="assets/img/profile.jpg" alt="..." /></span> --}}
                <h2 class="d-none d-lg-block text-white">MyApp</h2>
            </a>
            {{-- ログインしていれば表示 --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-end">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ route('user.home') }}" id="HOME">HOME<i class="fa-solid fa-house ms-2"></i></a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ route('user.mindMaps.index') }}" id="MindMap">Mind Map<i class="bi bi-diagram-3-fill ms-2"></i></a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ route('user.daily_run_goals.index') }}">Daily Goals<i class="fa-solid fa-flag ms-2"></i></a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ route('user.inspires.index') }}">Inspires<i class="fa-solid fa-fire-flame-curved ms-2"></i></a></li>
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
    <div class="container-fluid p-0">
        @yield('content')
        <hr class="m-0" />
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://unpkg.com/vue@3"></script>
    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    {{-- js-mind --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jsmind@0.7.5/es6/jsmind.js"></script>
    <script type="text/javascript" src="https://unpkg.com/jsmind@0.7.5/es6/jsmind.draggable-node.js"></script>
    @yield('script')
</body>
</html>