<div class="col-md-12 col-lg-4 sidebar">
    <div class="sidebar-box search-form-wrap custom-user-color custom-user-color-padding" style="background-color: darkred">
        <form action="#" class="sidebar-search-form">
            <span class="bi-search"></span>
            <input type="text" class="form-control" id="s" placeholder="Type a keyword and hit enter" disabled>
        </form>
    </div>
    <!-- END sidebar-box -->
    <div class="sidebar-box custom-user-color custom-user-color-padding">
        <div class="text-center avatar-wrapper">
            <img src="{{ asset($blogSettings->about_me_image ?? 'web/theme/blogy/images/img_7_sq.jpg') }}"
                 alt="Avatar"
                 class="avatar-circle">

            <div class="bio-body">
                <h2 class="custom-font-color">{{ __('blog.author_name') }}</h2>
                <p class="mb-4 custom-font-color">{!! Str::limit(strip_tags($blogSettings->about_me ?? __('blog.about_me_text')), 100) !!}</p>
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

    <div class="sidebar-box custom-user-color custom-user-color-padding">
        <h3 class="heading category-heading">
            <i class="bi bi-tags-fill"></i> {{ __('blog.sidebar.categories') }}
        </h3>
        <ul class="categories clean-list">
            @foreach($categories as $category)
                <li><a href="#">- {{ $category->name }}</a></li>
            @endforeach
        </ul>
    </div>

    {{--    TAGI--}}

    <div class="sidebar-box custom-user-color custom-user-color-padding">
        <h3 class="heading tag-heading">
            <i class="bi bi-cloud"></i> {{ __('blog.sidebar.tags') }}
        </h3>

        <div class="tag-html-cloud">
            @php
                $grayColors = [];
                for ($i = 0; $i < 1000; $i++) {
                    $val = dechex(round($i * (255 / 999)));
                    $hex = str_pad($val, 2, '0', STR_PAD_LEFT);
                    $grayColors[] = "#{$hex}{$hex}{$hex}";
                }
            @endphp

            @foreach($tags as $tag)
                @php
                    $color = $grayColors[array_rand($grayColors)];
                    $size = rand(12, 30);
                @endphp
                <a href=""
                   class="tag-html-item"
                   style="font-size: {{ $size }}px; color: {{ $color }};">
                    {{ $tag->name }}
                </a>
            @endforeach
{{--            @if(isset($tags))--}}
{{--                @php--}}
{{--                    $grayColors = [];--}}
{{--                    for ($i = 0; $i < 1000; $i++) {--}}
{{--                        $val = dechex(round($i * (255 / 999)));--}}
{{--                        $hex = str_pad($val, 2, '0', STR_PAD_LEFT);--}}
{{--                        $grayColors[] = "#{$hex}{$hex}{$hex}";--}}
{{--                    }--}}
{{--                @endphp--}}

{{--                @foreach($tags as $tag)--}}
{{--                    @php--}}
{{--                        $color = $grayColors[array_rand($grayColors)];--}}
{{--                        $size = rand(12, 30);--}}
{{--                    @endphp--}}
{{--                    <a href=""--}}
{{--                       class="tag-html-item"--}}
{{--                       style="font-size: {{ $size }}px; color: {{ $color }};">--}}
{{--                        {{ $tag->name }}--}}
{{--                    </a>--}}
{{--                @endforeach--}}
{{--            @endif--}}
        </div>
    </div>
</div>

