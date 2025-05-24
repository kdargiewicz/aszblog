<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;position:fixed;top:43px;bottom:0;overflow-y:auto" id="mySidebar"><br>
    <div class="w3-container w3-row">
        <div class="w3-col s4">

            @if(!empty($userAvatar))
                <img src="{{ asset($userAvatar) }}"
                     class="w3-circle w3-margin-right"
                     style="width:90px; height:90px; object-fit: cover;"
                     alt="Avatar">
            @else
                <img src="https://www.w3schools.com/w3images/avatar2.png"
                     class="w3-circle w3-margin-right"
                     style="width:90px; height:90px; object-fit: cover;"
                     alt="Default Avatar">
            @endif



            {{--            <img src="https://www.w3schools.com/w3images/avatar2.png" class="w3-circle w3-margin-right" style="width:46px">--}}
        </div>
        <div class="w3-col s8 w3-bar">
            <span>Welcome, <strong>{{ Auth::user()->name }}</strong></span><br>
            <a href="#" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i></a>
            <a href="#" class="w3-bar-item w3-button"><i class="fa fa-user"></i></a>
            <a href="#" class="w3-bar-item w3-button"><i class="fa fa-cog"></i></a>
        </div>
    </div>
    <hr>

    <div class="w3-bar-block">
        <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
        <a href="{{ route('dashboard') }}" class="w3-bar-item w3-button w3-padding"><i class="fa fa-tachometer w3-margin-right"></i>Pulpit</a>
        <a href="{{ route('article.create') }}" class="w3-bar-item w3-button w3-padding"><i class="fa fa-plus-square w3-margin-right"></i>Utwórz artykuł</a>
        <a href="{{ route('article.list') }}" class="w3-bar-item w3-button w3-padding"><i class="fa fa-list-alt w3-margin-right"></i>Lista artykułów</a>
        <a href="{{ route('article.list.delete') }}" class="w3-bar-item w3-button w3-padding"><i class="fa fa-list-alt w3-margin-right"></i>Lista usuniętych artykułów</a>
        <a href="{{ route('comments.list') }}" class="w3-bar-item w3-button w3-padding"><i class="fa fa-list-alt w3-margin-right"></i>Komentarze</a>
        <a href="{{ route('user.settings') }}" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>  Ustawienia</a>
        <hr>
        <a href="{{ route('first.blog.preview', 'one') }}" class="w3-bar-item w3-button w3-padding"><i class="fa fa-list-alt w3-margin-right"></i>  Podgląd bloga</a>
{{--        <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-folder-open w3-margin-right"></i>Kategorie</a>--}}
{{--        <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-tags w3-margin-right"></i>Tagi</a>--}}
{{--        <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i>  Overview</a>--}}
{{--        <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-eye fa-fw"></i>  Views</a>--}}
{{--        <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i>  Traffic</a>--}}
{{--        <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bullseye fa-fw"></i>  Geo</a>--}}
{{--        <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-diamond fa-fw"></i>  Orders</a>--}}
{{--        <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bell fa-fw"></i>  News</a>--}}
{{--        <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bank fa-fw"></i>  General</a>--}}
{{--        <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-history fa-fw"></i>  History</a>--}}

        @if(Auth::user()->is_admin)
            <a href="{{ route('errors.log') }}" class="w3-bar-item w3-button w3-padding w3-text-red">
                <i class="fa fa-exclamation-triangle"></i>  Error_log
            </a>
            <a href="{{ route('first.blog.preview', 'one') }}" class="w3-bar-item w3-button w3-padding w3-text-red"><i class="fa fa-list-alt w3-margin-right"></i>  podglad bloga one</a>
            <a href="{{ route('first.blog.preview', 'two') }}" class="w3-bar-item w3-button w3-padding w3-text-red"><i class="fa fa-list-alt w3-margin-right"></i>  podglad bloga two</a>
            <a href="{{ route('first.blog.preview', 'blogy') }}" class="w3-bar-item w3-button w3-padding w3-text-red"><i class="fa fa-list-alt w3-margin-right"></i>  podglad bloga blogy</a>
            <p>  ładne linki url !</p>
            <p>  zahaszowane adresy img</p>
            <p>  zakładka galeria ! !</p>

            <div class="w3-container">
                <a href="{{ url('/') }}"><h5>BLOG-zoba go :P</h5></a>

            </div>
        @endif
    </div>
</nav>
