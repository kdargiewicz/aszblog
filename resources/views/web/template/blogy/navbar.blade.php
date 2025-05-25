<nav class="site-nav">
        <div class="container">
            <div class="menu-bg-wrap">
                <div class="site-navigation">
                    <div class="row g-0 align-items-center">
                        <div class="col-2">
                            <a href="{{ route('first.blog.preview', ['name' => 'blogy']) }}" class="logo m-0 float-start">AszBlog<span class="text-primary">.</span></a>
                        </div>
                        <div class="col-8 text-center">
{{--                            <form action="#" class="search-form d-inline-block d-lg-none">--}}
{{--                                <input type="text" class="form-control" placeholder="Search...2137">--}}
{{--                                <span class="bi-search"></span>--}}
{{--                            </form>--}}

                            <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu mx-auto">
                                @auth
                                    <li><a href="{{ route('dashboard') }}">{{ __('blog.topbar.cms') }}</a></li>
                                @endauth
{{--                                <li class="has-children">--}}
{{--                                    <a href="category.html">Pages</a>--}}
{{--                                    <ul class="dropdown">--}}
{{--                                        <li><a href="search-result.html">Search Result</a></li>--}}
{{--                                        <li><a href="blog.html">Blog</a></li>--}}
{{--                                        <li><a href="single.html">Blog Single</a></li>--}}
{{--                                        <li><a href="category.html">Category</a></li>--}}
{{--                                        <li><a href="about.html">About</a></li>--}}
{{--                                        <li><a href="contact.html">Contact Us</a></li>--}}
{{--                                        <li><a href="#">Menu One</a></li>--}}
{{--                                        <li><a href="#">Menu Two</a></li>--}}
{{--                                        <li class="has-children">--}}
{{--                                            <a href="#">Dropdown</a>--}}
{{--                                            <ul class="dropdown">--}}
{{--                                                <li><a href="#">Sub Menu One</a></li>--}}
{{--                                                <li><a href="#">Sub Menu Two</a></li>--}}
{{--                                                <li><a href="#">Sub Menu Three</a></li>--}}
{{--                                            </ul>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </li>--}}
                                <li><a href="{{ route('about-me') }}" class="w3-bar-item w3-button">{{ __('blog.topbar.about') }}</a></li>
                                <li><a href="{{ route('gallery.preview') }}" class="w3-bar-item w3-button">{{ __('blog.topbar.gallery') }}</a></li>
                                <li><a href="{{ route('contact') }}" class="w3-bar-item w3-button">{{ __('blog.topbar.contact') }}</a></li>
                                <li><a href="{{ route('blog.map') }}" class="w3-bar-item w3-button">{{ __('blog.topbar.map') }}</a></li>
                                <li><a href="" class="w3-bar-item w3-button">ZDJECIA KRZYSKA :P</a></li>
                            </ul>
                        </div>
{{--                        <div class="col-2 text-end">--}}
{{--                            <a href="#" class="burger ms-auto float-end site-menu-toggle js-menu-toggle d-inline-block d-lg-none light">--}}
{{--                                <span></span>--}}
{{--                            </a>--}}
{{--                            <form action="#" class="search-form d-none d-lg-inline-block">--}}
{{--                                <input type="text" class="form-control" placeholder="Search...">--}}
{{--                                <span class="bi-search"></span>--}}
{{--                            </form>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
</nav>
