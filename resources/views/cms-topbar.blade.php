<div class="w3-bar w3-top w3-asphalt w3-large" style="z-index:4">
    <span class="w3-bar-item w3-right">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w3-button w3-dark-grey w3-small w3-round">
                {{ __('auth.logout') }}
            </button>
        </form>
    </span>
</div>
