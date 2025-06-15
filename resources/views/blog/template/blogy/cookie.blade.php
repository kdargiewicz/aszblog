@if(!request()->cookie('cookie_consent'))
    <div id="cookie-banner" style="position: fixed; bottom: 0; left: 0; width: 100%; background: #333; color: white; padding: 15px; text-align: center; z-index: 9999;">
        <span>
            {{ __('blog.cookie_info') }}
        </span>
        <button onclick="acceptCookies()" style="margin-left: 15px; padding: 6px 12px;">Akceptuję</button>
        <button onclick="declineCookies()" style="margin-left: 5px; padding: 6px 12px; background: #555; color: #eee;">Nie wyrażam zgody</button>
    </div>

    <script>
        function acceptCookies() {
            document.getElementById('cookie-banner').style.display = 'none';
            // Ustaw cookie na 7 dni (7 * 24 * 60 * 60 = 604800)
            document.cookie = "cookie_consent=1; max-age=604800; path=/";
        }

        function declineCookies() {
            document.getElementById('cookie-banner').style.display = 'none';
            // NIE ustawiamy żadnego ciasteczka
        }
    </script>
@endif
