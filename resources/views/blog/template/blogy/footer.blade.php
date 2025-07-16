<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="widget">

                    <div class="row">
                        @include('blog.template.blogy.logo')
                    </div>
                        {{ $blogSettings->my_footer_motto }}
                </div>
                <div class="widget">
                    <h3>Social</h3>
                    <ul class="list-unstyled social">
                        <li><a href="https://instagram.com/aszblog" target="_blank"><span class="icon-instagram"></span></a>
                        </li>
                        <li><a href="https://facebook.com/aszblog" target="_blank"><span
                                    class="icon-facebook"></span></a></li>
                        <li><a href="mailto:kontakt@aszblog.pl"><span class="icon-envelope"></span></a></li>
                    </ul>

                </div>
            </div>
            <div class="col-lg-4 ps-lg-5">
                <div class="widget">
                    <h3 class="mb-4">{{ __('footer.footer_nav') }}</h3>
                    <ul class="list-unstyled float-start links">
                        <li><a href="{{ route('blog.about-me') }}">{{ __('blog.topbar.about') }}</a></li>
                        <li><a href="{{ route('blog.gallery') }}">{{ __('blog.topbar.gallery') }}</a></li>
                        <li><a href="{{ route('blog.contact') }}">{{ __('blog.topbar.contact') }}</a></li>
                        <li><a href="{{ route('blog.google-map') }}">{{ __('blog.topbar.map') }}</a></li>
                        <li><a href="{{ route('blog.privacy-policy') }}">{{ __('footer.privacy_policy') }}</a></li>
                    </ul>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="widget">
                    <h3 class="mb-4">{{ __('footer.recent_post') }}</h3>
                    <div class="post-entry-footer">
                        <ul>
                            @foreach($footerArticles as $article)
                                <li>
                                    <a href="{{ route('blog.article.slug', ['categorySlug' => $article->category_slug, 'articleSlug' => $article->slug]) }}">
                                        <img src="{{ asset($article->preview_image) }}" alt="Image placeholder"
                                             class="me-4 rounded">
                                        <div class="text">
                                            <h4>{{ $article->title }}</h4>
                                            <div class="post-meta">
                                                <span class="mr-2">{{ $article->created_at }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12 text-center">
                <!--
                    **==========
                    NOTE:
                    Please don't remove this copyright link unless you buy the license here https://untree.co/license/
                    **==========
                  -->
                <p>
                    {{ date('Y') }} {{ __('footer.main') }}
                    <span class="footer-span">{{ __('footer.author') }}</span>
                    {!! __('footer.license') !!}
                </p>
            </div>
        </div>
    </div>
</footer>
