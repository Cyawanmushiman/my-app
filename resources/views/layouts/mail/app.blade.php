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

<body id="@yield('body_id')" class="@yield('body_class')">
    @yield('content')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    {{-- bundle.js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    @yield('script')
</body>

</html>
