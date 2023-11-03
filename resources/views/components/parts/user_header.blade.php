<nav class="navbar navbar-expand-md navbar-dark bg-info shadow-sm">
	<div class="container">
		<a class="navbar-brand" href="{{ route('user.home') }}">
			{{ config('app.name', 'Laravel') }}
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<!-- Left Side Of Navbar -->
			<ul class="navbar-nav me-auto">
				<li class="nav-item active">
					<a class="nav-link" href="{{ route('user.products.index') }}">商品管理</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="#">注文管理</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="#">顧客管理</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="#">ブログ管理</a>
				</li>
			</ul>
			<!-- Right Side Of Navbar -->
			<ul class="navbar-nav ms-auto">
				<li class="nav-item dropdown">
					<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
						ショップ管理画面
					</a>

					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
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
			</ul>
		</div>
	</div>
</nav>
