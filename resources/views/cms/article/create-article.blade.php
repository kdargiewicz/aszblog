{{--@extends('cms-main')--}}
{{--@section('content')--}}
{{--<div class="w3-container w3-light-grey w3-margin">--}}
{{--    <h2 class="w3-text-blue">{{ __('article.add') }}</h2>--}}

{{--    <form method="POST" action="{{ route('article.store') }}">--}}
{{--        @csrf--}}

{{--        <input type="hidden" name="article_uuid" value="{{ old('article_uuid', (string) Str::uuid()) }}">--}}

{{--        <label class="w3-text-grey"><b>{{ __('article.create-form.title') }}</b></label>--}}
{{--        <input class="w3-input w3-border w3-round w3-margin-bottom" name="title" type="text" placeholder="{{ __('article.create-form.title-placeholder') }}">--}}

{{--        <label class="w3-text-grey"><b>{{ __('article.create-form.tags') }}</b></label>--}}
{{--        <input class="w3-input w3-border w3-round w3-margin-bottom" name="tags" type="text" placeholder="{{ __('article.create-form.tags-placeholder') }}">--}}

{{--        <label class="w3-text-grey"><b>{{ __('article.create-form.category') }}</b></label>--}}
{{--        <input--}}
{{--            list="category-options"--}}
{{--            name="category"--}}
{{--            class="w3-input w3-border w3-round w3-margin-bottom"--}}
{{--            placeholder="{{ __('article.create-form.select-category') }}"--}}
{{--            value="{{ old('category_id') }}"--}}
{{--        >--}}

{{--        <datalist id="category-options">--}}
{{--            @if(isset($categories))--}}
{{--                @foreach($categories as $category)--}}
{{--                    <option value="{{ $category->name }}">--}}
{{--                @endforeach--}}
{{--            @endif--}}
{{--        </datalist>--}}

{{--        <label class="w3-text-grey"><b>{{ __('article.create-form.set-map-location') }}</b></label>--}}
{{--        <div id="map" style="height: 400px; width: 100%;" class="w3-margin-bottom w3-border w3-round"></div>--}}
{{--        <input type="hidden" name="latitude" id="latitude">--}}
{{--        <input type="hidden" name="longitude" id="longitude">--}}

{{--        <label class="w3-text-grey"><b>{{ __('article.create-form.content') }}</b></label>--}}
{{--        <textarea class="w3-input w3-border w3-round w3-margin-bottom"--}}
{{--                  style="height: 50vh;"--}}
{{--                  id="editor"--}}
{{--                  name="content"--}}
{{--                  rows="10"--}}
{{--                  placeholder="{{ __('article.create-form.content-placeholder') }}"--}}
{{--                  ></textarea>--}}

{{--        <label class="w3-text-grey"><b>{{ __('article.create-form.allow-comments') }}</b></label>--}}
{{--        <select class="w3-select w3-border w3-round w3-margin-bottom" name="allow_comments">--}}
{{--            <option value="" selected>{{ __('article.create-form.allow-comments-select') }}</option>--}}
{{--            <option value="1">{{ __('article.create-form.allow-comments-yes') }}</option>--}}
{{--            <option value="0">{{ __('article.create-form.allow-comments-no') }}</option>--}}
{{--        </select>--}}

{{--        <button class="w3-button w3-blue w3-round w3-margin-top" type="submit">--}}
{{--            {{ __('buttons.save') }}--}}
{{--        </button>--}}
{{--    </form>--}}

{{--    <form method="POST" action="{{ route('logout') }}">--}}
{{--        @csrf--}}
{{--        <button type="submit" class="btn btn-danger">--}}
{{--            Wyloguj się--}}
{{--        </button>--}}
{{--    </form>--}}

{{--    @if(Auth::user()->is_admin)--}}
{{--        </br></br></br></br>--}}
{{--    TO ZOSTAJE DO TESTOW ! ! !--}}

{{--    <h2>Upload zdjęcia testowego</h2>--}}

{{--    @if(session('success'))--}}
{{--        <div class="alert alert-success">{{ session('success') }}</div>--}}
{{--        <p><strong>Wersja max:</strong> <a href="{{ session('max') }}" target="_blank">{{ session('max') }}</a></p>--}}
{{--        <p><strong>Wersja min:</strong> <a href="{{ session('min') }}" target="_blank">{{ session('min') }}</a></p>--}}
{{--        <img src="{{ session('min') }}" style="max-width: 200px; margin-top: 10px;">--}}
{{--    @endif--}}

{{--    <form method="POST" action="{{ route('image.upload') }}" enctype="multipart/form-data">--}}
{{--        @csrf--}}
{{--        <div class="mb-3">--}}
{{--            <label for="image" class="form-label">Wybierz zdjęcie:</label>--}}
{{--            <input type="file" class="form-control" id="image" name="image" required accept="image/*">--}}
{{--        </div>--}}
{{--        <button type="submit" class="btn btn-primary">Wyślij</button>--}}
{{--    </form>--}}
{{--    @endif--}}

{{--</div>--}}

{{--@include('cms.article.tinymce-script')--}}
{{--@endsection--}}

{{--@section('scripts')--}}
{{--<script>--}}
{{--    (g => {--}}
{{--        var h, a, k, p = "The Google Maps JavaScript API",--}}
{{--            c = "google",--}}
{{--            l = "importLibrary",--}}
{{--            q = "__ib__",--}}
{{--            m = document,--}}
{{--            b = window;--}}
{{--        b = b[c] || (b[c] = {});--}}
{{--        var d = b.maps || (b.maps = {}),--}}
{{--            r = new Set,--}}
{{--            e = new URLSearchParams,--}}
{{--            u = () => h || (h = new Promise(async(f, n) => {--}}
{{--                await (a = m.createElement("script"));--}}
{{--                e.set("libraries", [...r] + "");--}}
{{--                for (k in g)--}}
{{--                    e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]);--}}
{{--                e.set("callback", c + ".maps." + q);--}}
{{--                a.src = `https://maps.${c}apis.com/maps/api/js?` + e;--}}
{{--                d[q] = f;--}}
{{--                a.onerror = () => h = n(Error(p + " could not load."));--}}
{{--                a.nonce = m.querySelector("script[nonce]")?.nonce || "";--}}
{{--                m.head.append(a);--}}
{{--            }));--}}
{{--        d[l] ? console.warn(p + " only loads once. Ignoring:", g) :--}}
{{--            d[l] = (f, ...n) => r.add(f) && u().then(() => d[l](f, ...n))--}}
{{--    })({--}}
{{--        key: "{{ config('services.google-map.api_key') }}",--}}
{{--        v: "weekly"--}}
{{--    });--}}
{{--</script>--}}
{{--<script>--}}
{{--    let map;--}}
{{--    let marker;--}}
{{--    let dragging = false;--}}
{{--    let overlayProjection = null;--}}

{{--    async function initMap() {--}}
{{--        const { Map } = await google.maps.importLibrary("maps");--}}
{{--        const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");--}}

{{--        const center = { lat: 52.2297, lng: 21.0122 };--}}

{{--        map = new Map(document.getElementById("map"), {--}}
{{--            center,--}}
{{--            zoom: 8,--}}
{{--            mapId: 'DEMO_MAP_ID'--}}
{{--        });--}}

{{--        marker = new AdvancedMarkerElement({--}}
{{--            position: center,--}}
{{--            map,--}}
{{--            title: "Przeciągnij mnie"--}}
{{--        });--}}

{{--        // Ustaw początkowe wartości w inputach--}}
{{--        setLatLngInputs(center.lat, center.lng);--}}

{{--        // OverlayView do tłumaczenia pikseli na współrzędne--}}
{{--        const overlay = new google.maps.OverlayView();--}}
{{--        overlay.onAdd = () => {};--}}
{{--        overlay.draw = () => {};--}}
{{--        overlay.onRemove = () => {};--}}
{{--        overlay.setMap(map);--}}

{{--        overlayProjection = await new Promise((resolve) => {--}}
{{--            const check = () => {--}}
{{--                if (overlay.getProjection()) {--}}
{{--                    resolve(overlay.getProjection());--}}
{{--                } else {--}}
{{--                    setTimeout(check, 50);--}}
{{--                }--}}
{{--            };--}}
{{--            check();--}}
{{--        });--}}

{{--        // Zdarzenia myszki--}}
{{--        marker.element.style.cursor = "grab";--}}

{{--        marker.element.addEventListener("pointerdown", (e) => {--}}
{{--            dragging = true;--}}
{{--            map.setOptions({ draggable: false });--}}
{{--            marker.element.style.cursor = "grabbing";--}}
{{--            e.preventDefault();--}}
{{--        });--}}

{{--        document.addEventListener("pointerup", () => {--}}
{{--            if (dragging) {--}}
{{--                dragging = false;--}}
{{--                map.setOptions({ draggable: true });--}}
{{--                marker.element.style.cursor = "grab";--}}

{{--                // Zapisz pozycję do inputów--}}
{{--                const pos = marker.position;--}}
{{--                setLatLngInputs(pos.lat, pos.lng);--}}
{{--            }--}}
{{--        });--}}

{{--        document.addEventListener("pointermove", (e) => {--}}
{{--            if (!dragging) return;--}}

{{--            const mapDiv = map.getDiv();--}}
{{--            const bounds = mapDiv.getBoundingClientRect();--}}

{{--            const x = e.clientX - bounds.left;--}}
{{--            const y = e.clientY - bounds.top;--}}

{{--            const latLng = overlayProjection.fromContainerPixelToLatLng(--}}
{{--                new google.maps.Point(x, y)--}}
{{--            );--}}

{{--            marker.position = latLng;--}}
{{--        });--}}
{{--    }--}}

{{--    // 🔄 Aktualizacja pól hidden--}}
{{--    function setLatLngInputs(lat, lng) {--}}
{{--        document.getElementById("latitude").value = lat;--}}
{{--        document.getElementById("longitude").value = lng;--}}
{{--    }--}}

{{--    initMap();--}}
{{--</script>--}}
{{--@endsection--}}
