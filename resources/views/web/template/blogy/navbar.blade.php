{{--<nav class="site-nav">--}}
{{--        <div class="container">--}}
{{--            <div class="menu-bg-wrap">--}}
{{--                <div class="site-navigation">--}}
{{--                    <div class="row g-0 align-items-center">--}}
{{--                        <div class="col-2">--}}
{{--                            <a href="{{ route('first.blog.preview', ['name' => 'blogy']) }}" class="logo m-0 float-start">AszBlog<span class="text-primary">.</span></a>--}}
{{--                        </div>--}}
{{--                        <div class="col-8 text-center">--}}
{{--                            <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu mx-auto">--}}
{{--                                @auth--}}
{{--                                    <li><a href="{{ route('dashboard') }}">{{ __('blog.topbar.cms') }}</a></li>--}}
{{--                                @endauth--}}
{{--                                <li><a href="{{ route('about-me') }}" class="w3-bar-item w3-button">{{ __('blog.topbar.about') }}</a></li>--}}
{{--                                <li><a href="{{ route('gallery.preview') }}" class="w3-bar-item w3-button">{{ __('blog.topbar.gallery') }}</a></li>--}}
{{--                                <li><a href="{{ route('contact') }}" class="w3-bar-item w3-button">{{ __('blog.topbar.contact') }}</a></li>--}}
{{--                                <li><a href="{{ route('blog.map') }}" class="w3-bar-item w3-button">{{ __('blog.topbar.map') }}</a></li>--}}
{{--                                <li><a href="" class="w3-bar-item w3-button">ZDJECIA KRZYSKA :P</a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--</nav>--}}

<nav class="site-nav">
    <div class="container">
        <div class="menu-bg-wrap">
            <div class="site-navigation">
                <div class="row g-0 align-items-center">
                    <div class="col-2">
                        <a href="{{ route('first.blog.preview', ['name' => 'blogy']) }}" class="logo m-0 float-start">
                            AszBlog<span class="text-primary">.</span>
                        </a>
                    </div>

                    {{-- Hamburger button --}}
                    <div class="col-2 d-lg-none text-end">
                        <button class="menu-toggle btn btn-link" id="mobileMenuToggle">
                            <span class="navbar-toggler-icon">☰</span>
                        </button>
                    </div>

                    {{-- Desktop menu --}}
                    <div class="col-8 text-center d-none d-lg-block">
                        <ul class="js-clone-nav site-menu mx-auto">
                            @auth
                                <li><a href="{{ route('dashboard') }}">{{ __('blog.topbar.cms') }}</a></li>
                            @endauth
                            <li><a href="{{ route('about-me') }}">{{ __('blog.topbar.about') }}</a></li>
                            <li><a href="{{ route('gallery.preview') }}">{{ __('blog.topbar.gallery') }}</a></li>
                            <li><a href="{{ route('contact') }}">{{ __('blog.topbar.contact') }}</a></li>
                            <li><a href="{{ route('blog.map') }}">{{ __('blog.topbar.map') }}</a></li>
                            @if(Auth::user()->is_admin)
                                <li><a href="#">ZDJECIA KRZYSKA :P</a></li>
                            @endif
                        </ul>
                    </div>
                </div>

                {{-- Mobile menu --}}
                <div class="mobile-menu d-lg-none" id="mobileMenu" style="display: none;">
                    <ul class="site-menu text-center">
                        @auth
                            <li><a href="{{ route('dashboard') }}">{{ __('blog.topbar.cms') }}</a></li>
                        @endauth
                        <li><a href="{{ route('about-me') }}">{{ __('blog.topbar.about') }}</a></li>
                        <li><a href="{{ route('gallery.preview') }}">{{ __('blog.topbar.gallery') }}</a></li>
                        <li><a href="{{ route('contact') }}">{{ __('blog.topbar.contact') }}</a></li>
                        <li><a href="{{ route('blog.map') }}">{{ __('blog.topbar.map') }}</a></li>
                        <li><a href="#">ZDJECIA KRZYSKA :P</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
