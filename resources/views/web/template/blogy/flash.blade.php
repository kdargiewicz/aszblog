@if(session('success'))
    <div id="flash-message" class="alert alert-success text-center position-fixed w-100" style="top: 56px; z-index: 1050;">
        <p class="mb-0">{{ session('success') }}</p>
    </div>

    <script>
        window.addEventListener('load', function() {
            const fm = document.getElementById('flash-message');
            const topbar = document.querySelector('.navbar');

            if (fm && topbar) {
                fm.style.top = topbar.offsetHeight + 'px';
            }

            setTimeout(() => {
                if (!fm) return;
                fm.style.transition = 'opacity 0.5s';
                fm.style.opacity = '0';
                setTimeout(() => fm.style.display = 'none', 500);
            }, 5000);
        });
    </script>
@endif
