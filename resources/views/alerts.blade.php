@foreach (['success' => 'green', 'error' => 'red', 'warning' => 'yellow', 'info' => 'blue'] as $type => $color)
    @if(session($type))
        <div
            class="w3-container w3-{{ $color }} w3-padding-16 w3-animate-opacity w3-round w3-margin-bottom"
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 10000)"
            x-show="show"
            x-transition
        >
            <span @click="show = false" class="w3-button w3-{{ $color }} w3-display-topright" style="font-weight: bold;">×</span>
            <h3 class="w3-margin-top">
                {{ __('messages.'.$type.'-title', ['default' => ucfirst($type)]) }}
            </h3>
            <p>{{ session($type) }}</p>
        </div>
    @endif
@endforeach
