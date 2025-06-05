<!-- /*
* Template Name: Blogy
* Template Author: Untree.co
* Template URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/

TRZEBA TO PRZEROBIĆ NA SWOJE ! ! !

*/ -->
<!doctype html>
<html lang="pl">
@include('web.template.blogy.header')
<body>

<div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close">
            <span class="icofont-close js-menu-toggle"></span>
        </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div>

@include('web.template.blogy.preview.custom_colors')

@include('web.template.blogy.navbar')

@include('web.template.blogy.flash')

@yield('content')

@include('web.template.blogy.footer')

@include('web.template.blogy.scripts')

@include('web.template.cookie')

</body>
</html>
