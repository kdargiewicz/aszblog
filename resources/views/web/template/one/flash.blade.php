@if(session('success'))
    <div id="flash-message" class="w3-panel w3-green w3-center flash-message">
        <p style="margin:0.5rem 1rem;">{{ session('success') }}</p>
    </div>

    <script>
        window.addEventListener('load', function() {
            var fm = document.getElementById('flash-message');
            var topbar = document.querySelector('.w3-top');
            if (fm && topbar) {
                fm.style.top = topbar.offsetHeight + 'px';
            }
            setTimeout(function() {
                if (!fm) return;
                fm.style.opacity = '0';
                setTimeout(function() { fm.style.display = 'none'; }, 300);
            }, 5000);
        });
    </script>
@endif
