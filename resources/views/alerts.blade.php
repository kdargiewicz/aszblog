@if(session('success'))
    <div
        class="alert alert-success alert-dismissible fade show"
        role="alert"
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 10000)"
        x-show="show"
        x-transition
    >
        {{ session('success') }}
        <button type="button" class="btn-close" @click="show = false" aria-label="Close"></button>
    </div>
@endif
