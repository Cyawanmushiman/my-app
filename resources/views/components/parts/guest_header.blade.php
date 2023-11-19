<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
	<div class="container">
		<a class="navbar-brand" href="{{ url('/') }}">
			{{ config('app.name', 'Laravel') }}
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<!-- Left Side Of Navbar -->
			<ul class="navbar-nav me-auto">

			</ul>
			<span class="navbar-text">
				未ログイン時のヘッダー
			</span>
			<!-- Right Side Of Navbar -->
			<ul class="navbar-nav ms-auto">
				<li class="nav-item">
					<a class="nav-link" href="{{ route('user.login') }}">ショップログイン</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('user.register') }}">ショップ新規登録</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('buyer.login') }}">購入者ログイン</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('buyer.register') }}">購入者新規登録</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('admin.login') }}">管理画面ログイン</a>
				</li>
			</ul>
		</div>
	</div>
</nav>

