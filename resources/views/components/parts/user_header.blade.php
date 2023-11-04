<nav class="navbar navbar-expand-md navbar-light bg-white sticky-top border-bottom border-3 border-primary">
    <div class="container">
        <a href="{{ route('user.home') }}" class="d-block">
            <img class="logo" src="{{ asset('images/logo2.png') }}" alt="" style="width: 50px">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @if (auth()->check() && auth()->user()->email_verified_at !== null)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.home') }}">
                            <i class="fas fa-home me-1"></i>{{ __('トップ') }}
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fas fa-cogs me-1"></i>設定
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('user.logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.home') }}"><i class="fas fa-home me-1"></i>{{ __('トップ') }}</a>
                    </li>
                    @if (Route::has('user.login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i>{{ __('Login') }}
                            </a>
                        </li>
                    @endif

                    @if (Route::has('user.register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.register') }}">
                                <i class="fas fa-user-plus me-1"></i>{{ __('Register') }}
                            </a>
                        </li>
                    @endif
                @endif
            </ul>
        </div>
    </div>
</nav>