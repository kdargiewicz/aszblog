<div class="w3-top">
    <div class="w3-bar w3-white w3-padding w3-card article-title" style="position: relative;">
        <a href="#home" class="w3-bar-item w3-button">
            <div class="logo-and-title">
                <img class="w3-image topbar-logo" src="{{ asset('img/aszblog_logo.png') }}" alt="Logo">
            </div>
        </a>

        <div class="w3-right w3-hide-small topbar-links w3-margin-top w3-margin-bottom">
            <a href="#about" class="w3-bar-item w3-button">{{ __('blog.topbar.home') }}</a>
            <a href="{{ route('about-me') }}" class="w3-bar-item w3-button">{{ __('blog.topbar.about') }}</a>
            <a href="{{ route('gallery.preview') }}" class="w3-bar-item w3-button">{{ __('blog.topbar.gallery') }}</a>
            <a href="{{ route('contact') }}" class="w3-bar-item w3-button">{{ __('blog.topbar.contact') }}</a>
        </div>

        <a href="javascript:void(0);" class="w3-bar-item w3-button w3-right w3-hide-medium w3-hide-large"
           onclick="toggleMobileMenu()" style="position: absolute; right: 0;">
            ☰ Menu
        </a>
    </div>

    <div id="mobileMenu" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-margin-top w3-margin-bottom">
        <a href="#about" class="w3-bar-item w3-button">{{ __('blog.topbar.home') }}</a>
        <a href="{{ route('about-me') }}" class="w3-bar-item w3-button">{{ __('blog.topbar.about') }}</a>
        <a href="{{ route('gallery.preview') }}" class="w3-bar-item w3-button">{{ __('blog.topbar.gallery') }}</a>
        <a href="#contact" class="w3-bar-item w3-button">{{ __('blog.topbar.contact') }}</a>
    </div>
</div>

<script>
    function toggleMobileMenu() {
        const menu = document.getElementById("mobileMenu");
        menu.classList.toggle("w3-show");
        menu.classList.toggle("w3-hide");
    }
</script>


