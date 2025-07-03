<!-- /*
* Template Name: Blogy
* Template Author: Untree.co
* Template URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
<!doctype html>
<html lang="pl">
@include('blog.template.blogy.header')
<body>

<div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close">
            <span class="icofont-close js-menu-toggle"></span>
        </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div>

@include('blog.template.blogy.custom_colors')

@include('blog.template.blogy.navbar')

@include('blog.template.blogy.flash')

@yield('content')

@include('blog.template.blogy.footer')

@include('blog.template.blogy.scripts')

@include('blog.template.blogy.cookie')

</body>
</html>
