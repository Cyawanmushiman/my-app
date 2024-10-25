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