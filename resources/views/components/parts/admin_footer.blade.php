<footer id="footer" class="py-md-4">
    <div class="container-md">
        <div class="row">
            <div class="footer-logo col-md-auto">
                {{-- @include("components.includes.objects.logo") --}}
            </div>
            @if (!Str::contains(request()->url(), '/admin'))
                <nav class="footer-nav col-md w-100">
                    <ul class="list-unstyled  mb-0 mx-md-3 mt-md-3">
                        <li><a href="/sample/user/notation">
                                <span>特定商取引法に基づく表記</span>
                            </a></li>
                        <li><a href="/sample/user/terms-of-service">
                                <span>利用規約</span>
                            </a></li>
                        <li><a href="/sample/user/privacy-policy">
                                <span>プライバシーポリシー</span>
                            </a></li>
                        <li><a href="/sample/user/about-us">
                                <span>About Us</span>
                            </a></li>
                        <li><a href="/sample/user/contact/create">
                                <span>お問い合わせ</span>
                            </a></li>
                    </ul>
                </nav>
            @endif
        </div>
    </div>
    <div class="col-md-auto text-center">
        <div class="copyright row mt-md-3">
            <span>&copy; 2023 株式会社メドアップ</span>
        </div>
    </div>
</footer>
