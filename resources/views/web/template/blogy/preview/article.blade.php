@extends('web.template.blogy.main')
@section('content')

    @if($article && $article->firstImageFromArticle)
        <div class="site-cover site-cover-sm same-height overlay single-page"
             style="background-image: url('{{ asset($article->firstImageFromArticle) }}');">
    @else
        <div class="site-cover site-cover-sm same-height overlay single-page"
             style="background-image: url('{{ asset('web/theme/blogy/images/hero_5.jpg') }}');">
    @endif

    <div class="container">
            <div class="row same-height justify-content-center">
                <div class="col-md-6">
                    <div class="post-entry text-center">
                        <h1 class="mb-4 article-title">{{ $article->title ?? __('article.article_list.no_title') }}</h1>
                        <div class="post-meta align-items-center text-center">
{{--                            <figure class="author-figure mb-0 me-3 d-inline-block rounded-circle">--}}
{{--                                <img src="{{ asset($userAvatar) }}" alt="Image" class="img-fluid rounded-circle">--}}
{{--                            </figure>--}}
                            <span class="d-inline-block mt-1">
                                @if(!empty($article->category) || !empty($article->created_at))
                                    <p class="meta-serif text-white">
                                        {{ $article->category ?? '' }}
                                        @if(!empty($article->category) && !empty($article->created_at))
                                            &nbsp;&bull;&nbsp;
                                        @endif
                                        {{ $article->created_at ? \Carbon\Carbon::parse($article->created_at)->format('Y-m-d') : '' }}
                                    </p>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="container">

            <div class="row blog-entries element-animate">

                <div class="col-md-12 col-lg-8 main-content">
                    <div class="post-content-body shadow-box custom-user-color custom-font-color">
                        <h1 class="text-center">
                            {{ $article->title ?? __('article.article_list.no_title') }}
                        </h1>
                        @if(!empty($article->category) || !empty($article->created_at))
                            <p class="text-center" style="font-style: italic; color: #555;">
                                {{ $article->category ?? '' }}
                                @if(!empty($article->category) && !empty($article->created_at))
                                    &nbsp;&bull;&nbsp;
                                @endif
                                {{ $article->created_at ? \Carbon\Carbon::parse($article->created_at)->format('Y-m-d') : '' }}
                            </p>
                        @endif
                        {!! $article->content !!}

                        <p>{{ __('article.create-form.category') }}:  <a href="#">{{ $article->category }}</a>, {{ __('article.create-form.tags') }}:
                            @foreach ($article->tags as $tag)
{{--                                tu trzeba uzupełnić route żeby klikająć w taga kierować do tej przestrzeni tagów--}}
{{--                                <a href="{{ route('tag.show', ['id' => $tag->id]) }}">#{{ $tag->name }}</a>@if (!$loop->last), @endif--}}
                                <a href="">#{{ $tag->name }}</a>@if (!$loop->last), @endif
                            @endforeach
                        </p>

                        <h3 class="mb-5 heading">6 Comments</h3>
                        <ul class="comment-list">
                            <li class="comment">
                                <div class="vcard">
                                    <img src="{{ asset('web/theme/blogy/images/person_1.jpg')}}" alt="Image placeholder">
                                </div>
                                <div class="comment-body">
                                    <h3>Jean Doe</h3>
                                    <div class="meta">January 9, 2018 at 2:21pm</div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                                    <p><a href="#" class="reply rounded">Reply</a></p>
                                </div>
                            </li>

                            <li class="comment">
                                <div class="vcard">
                                    <img src="{{ asset('web/theme/blogy/images/person_2.jpg')}}" alt="Image placeholder">
                                </div>
                                <div class="comment-body">
                                    <h3>Jean Doe</h3>
                                    <div class="meta">January 9, 2018 at 2:21pm</div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                                    <p><a href="#" class="reply rounded">Reply</a></p>
                                </div>

                                <ul class="children">
                                    <li class="comment">
                                        <div class="vcard">
                                            <img src="{{ asset('web/theme/blogy/images/person_3.jpg')}}" alt="Image placeholder">
                                        </div>
                                        <div class="comment-body">
                                            <h3>Jean Doe</h3>
                                            <div class="meta">January 9, 2018 at 2:21pm</div>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                                            <p><a href="#" class="reply rounded">Reply</a></p>
                                        </div>


                                        <ul class="children">
                                            <li class="comment">
                                                <div class="vcard">
                                                    <img src="{{ asset('web/theme/blogy/images/person_4.jpg')}}" alt="Image placeholder">
                                                </div>
                                                <div class="comment-body">
                                                    <h3>Jean Doe</h3>
                                                    <div class="meta">January 9, 2018 at 2:21pm</div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                                                    <p><a href="#" class="reply rounded">Reply</a></p>
                                                </div>

                                                <ul class="children">
                                                    <li class="comment">
                                                        <div class="vcard">
                                                            <img src="{{ asset('web/theme/blogy/images/person_5.jpg')}}" alt="Image placeholder">
                                                        </div>
                                                        <div class="comment-body">
                                                            <h3>Jean Doe</h3>
                                                            <div class="meta">January 9, 2018 at 2:21pm</div>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                                                            <p><a href="#" class="reply rounded">Reply</a></p>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <li class="comment">
                                <div class="vcard">
                                    <img src="{{ asset('web/theme/blogy/images/person_1.jpg')}}" alt="Image placeholder">
                                </div>
                                <div class="comment-body">
                                    <h3>Jean Doe</h3>
                                    <div class="meta">January 9, 2018 at 2:21pm</div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                                    <p><a href="#" class="reply rounded">Reply</a></p>
                                </div>
                            </li>
                        </ul>
                        <!-- END comment-list -->

                        <div class="comment-form-wrap pt-5">
                            <h3 class="mb-5">Leave a comment</h3>
                            <form action="#" class="p-5 bg-light">
                                <div class="form-group">
                                    <label for="name">Name *</label>
                                    <input type="text" class="form-control" id="name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email *</label>
                                    <input type="email" class="form-control" id="email">
                                </div>
                                <div class="form-group">
                                    <label for="website">Website</label>
                                    <input type="url" class="form-control" id="website">
                                </div>

                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea name="" id="message" cols="30" rows="10" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Post Comment" class="btn btn-primary">
                                </div>

                            </form>
                        </div>
{{--                    </div>--}}

                </div>
                </div>

                <!-- END main-content -->

                <div class="col-md-12 col-lg-4 sidebar">
                    <div class="sidebar-box search-form-wrap custom-user-color custom-user-color-padding">
                        <form action="#" class="sidebar-search-form">
                            <span class="bi-search"></span>
                            <input type="text" class="form-control" id="s" placeholder="Type a keyword and hit enter">
                        </form>
                    </div>
                    <!-- END sidebar-box -->
                    <div class="sidebar-box custom-user-color custom-user-color-padding">
                        <div class="text-center avatar-wrapper">
                            <img src="{{ asset($blogSettings->about_me_image ?? 'web/theme/blogy/images/img_7_sq.jpg') }}"
                                 alt="Avatar"
                                 class="avatar-circle">

                            <div class="bio-body">
                                <h2>{{ __('blog.author_name') }}</h2>
                                <p class="mb-4">{!! Str::limit(strip_tags($blogSettings->about_me ?? __('blog.about_me_text')), 100) !!}</p>
                                <p><a href="{{ route('about-me') }}" class="btn btn-primary btn-sm rounded px-2 py-2">{{ __('blog.content.read_the_author') }}</a></p>
                                <p class="social">
                                    <a href="#" class="p-2"><span class="fa fa-facebook"></span></a>
                                    <a href="#" class="p-2"><span class="fa fa-twitter"></span></a>
                                    <a href="#" class="p-2"><span class="fa fa-instagram"></span></a>
                                    <a href="#" class="p-2"><span class="fa fa-youtube-play"></span></a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- END sidebar-box -->
                    <div class="sidebar-box custom-user-color custom-user-color-padding">
                        <h3 class="heading">Popular Posts</h3>
                        <div class="post-entry-sidebar">
                            <ul>
                                <li>
                                    <a href="">
                                        <img src="{{ asset('web/theme/blogy/images/img_1_sq.jpg')}}" alt="Image placeholder" class="me-4 rounded">
                                        <div class="text">
                                            <h4>There’s a Cool New Way for Men to Wear Socks and Sandals</h4>
                                            <div class="post-meta">
                                                <span class="mr-2">March 15, 2018 </span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <img src="{{ asset('web/theme/blogy/images/img_2_sq.jpg')}}" alt="Image placeholder" class="me-4 rounded">
                                        <div class="text">
                                            <h4>There’s a Cool New Way for Men to Wear Socks and Sandals</h4>
                                            <div class="post-meta">
                                                <span class="mr-2">March 15, 2018 </span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <img src="{{ asset('web/theme/blogy/images/img_3_sq.jpg')}}" alt="Image placeholder" class="me-4 rounded">
                                        <div class="text">
                                            <h4>There’s a Cool New Way for Men to Wear Socks and Sandals</h4>
                                            <div class="post-meta">
                                                <span class="mr-2">March 15, 2018 </span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- END sidebar-box -->

                    <div class="sidebar-box custom-user-color custom-user-color-padding">
                        <h3 class="heading">Categories</h3>
                        <ul class="categories">
                            <li><a href="#">Food <span>(12)</span></a></li>
                            <li><a href="#">Travel <span>(22)</span></a></li>
                            <li><a href="#">Lifestyle <span>(37)</span></a></li>
                            <li><a href="#">Business <span>(42)</span></a></li>
                            <li><a href="#">Adventure <span>(14)</span></a></li>
                        </ul>
                    </div>
                    <!-- END sidebar-box -->

                    <div class="sidebar-box custom-user-color custom-user-color-padding">
                        <h3 class="heading">Tags</h3>
                        <ul class="tags">
                            <li><a href="#">Travel</a></li>
                            <li><a href="#">Adventure</a></li>
                            <li><a href="#">Food</a></li>
                            <li><a href="#">Lifestyle</a></li>
                            <li><a href="#">Business</a></li>
                            <li><a href="#">Freelancing</a></li>
                            <li><a href="#">Travel</a></li>
                            <li><a href="#">Adventure</a></li>
                            <li><a href="#">Food</a></li>
                            <li><a href="#">Lifestyle</a></li>
                            <li><a href="#">Business</a></li>
                            <li><a href="#">Freelancing</a></li>
                        </ul>
                    </div>
                </div>
                <!-- END sidebar -->

            </div>
        </div>
    </section>
@include('web.template.image-modal.modal')
@endsection
