@foreach (['success' => 'green', 'error' => 'red', 'warning' => 'yellow', 'info' => 'blue'] as $type => $color)
    @if(session($type))
        <div
            id="flash-message-{{ $type }}"
            class="w3-panel w3-{{ $color }} w3-center flash-message"
            style="
                position: fixed;
                top: 0;
                left: 50%;
                transform: translateX(-50%);
                z-index: 9999;
                opacity: 0;
                transition: all 0.6s ease;
                border-radius: 12px;
                width: 80%;
                max-width: 800px;
                padding: 1rem 2rem;
                box-shadow: 0 4px 10px rgba(0,0,0,0.1);
                display: none;
            "
        >
            <p style="margin: 0;">{{ session($type) }}</p>
        </div>
    @endif
@endforeach


<script>
    window.addEventListener('load', function () {
        const types = ['success', 'error', 'warning', 'info'];
        const topbar = document.querySelector('.w3-top');

        types.forEach(function (type) {
            const el = document.getElementById('flash-message-' + type);
            if (el) {
                const offset = topbar ? topbar.offsetHeight + 8 : 20;
                el.style.top = offset + 'px';
                el.style.display = 'block';

                setTimeout(() => {
                    el.style.opacity = '1';
                }, 50);

                setTimeout(() => {
                    el.style.opacity = '0';
                    setTimeout(() => el.style.display = 'none', 500);
                }, 5000);
            }
        });
    });
</script>

