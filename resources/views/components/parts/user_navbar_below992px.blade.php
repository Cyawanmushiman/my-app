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
                    <li class="nav-item">
                        @if (Str::contains(request()->url(), '/histories'))
                            <a class="nav-link text-info" href="{{ route('user.histories.index') }}">
                                Histories<i class="fas fa-history ms-2"></i>
                            </a>
                        @else
                            <a class="nav-link js-scroll-trigger" href="{{ route('user.histories.index') }}">
                                Histories<i class="fas fa-history ms-2"></i>
                            </a>
                        @endif
                    </li>
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