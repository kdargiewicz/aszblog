<script>
    (g => {
        var h, a, k, p = "The Google Maps JavaScript API",
            c = "google",
            l = "importLibrary",
            q = "__ib__",
            m = document,
            b = window;
        b = b[c] || (b[c] = {});
        var d = b.maps || (b.maps = {}),
            r = new Set,
            e = new URLSearchParams,
            u = () => h || (h = new Promise(async(f, n) => {
                await (a = m.createElement("script"));
                e.set("libraries", [...r] + "");
                for (k in g)
                    e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]);
                e.set("callback", c + ".maps." + q);
                a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
                d[q] = f;
                a.onerror = () => h = n(Error(p + " could not load."));
                a.nonce = m.querySelector("script[nonce]")?.nonce || "";
                m.head.append(a);
            }));
        d[l] ? console.warn(p + " only loads once. Ignoring:", g) :
            d[l] = (f, ...n) => r.add(f) && u().then(() => d[l](f, ...n))
    })({
        key: "{{ config('services.google-map.api_key') }}",
        v: "weekly"
    });

    let map;
    let marker;
    let dragging = false;
    let overlayProjection = null;

    async function initMap() {
        const { Map } = await google.maps.importLibrary("maps");
        const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

//            const center = { lat: 52.2297, lng: 21.0122 };
        const center = {
            lat: parseFloat(document.getElementById("latitude").value) || 52.2297,
            lng: parseFloat(document.getElementById("longitude").value) || 21.0122
        };


        map = new Map(document.getElementById("map"), {
            center,
            zoom: 8,
            mapId: 'DEMO_MAP_ID'
        });

        marker = new AdvancedMarkerElement({
            position: center,
            map,
            title: "Przeciągnij mnie"
        });

        // Ustaw początkowe wartości w inputach
        setLatLngInputs(center.lat, center.lng);

        // OverlayView do tłumaczenia pikseli na współrzędne
        const overlay = new google.maps.OverlayView();
        overlay.onAdd = () => {};
        overlay.draw = () => {};
        overlay.onRemove = () => {};
        overlay.setMap(map);

        overlayProjection = await new Promise((resolve) => {
            const check = () => {
                if (overlay.getProjection()) {
                    resolve(overlay.getProjection());
                } else {
                    setTimeout(check, 50);
                }
            };
            check();
        });

        // Zdarzenia myszki
        marker.element.style.cursor = "grab";

        marker.element.addEventListener("pointerdown", (e) => {
            dragging = true;
            map.setOptions({ draggable: false });
            marker.element.style.cursor = "grabbing";
            e.preventDefault();
        });

        document.addEventListener("pointerup", () => {
            if (dragging) {
                dragging = false;
                map.setOptions({ draggable: true });
                marker.element.style.cursor = "grab";

                // Zapisz pozycję do inputów
                const pos = marker.position;
                setLatLngInputs(pos.lat, pos.lng);
            }
        });

        document.addEventListener("pointermove", (e) => {
            if (!dragging) return;

            const mapDiv = map.getDiv();
            const bounds = mapDiv.getBoundingClientRect();

            const x = e.clientX - bounds.left;
            const y = e.clientY - bounds.top;

            const latLng = overlayProjection.fromContainerPixelToLatLng(
                new google.maps.Point(x, y)
            );

            marker.position = latLng;
        });
    }

    // 🔄 Aktualizacja pól hidden
    function setLatLngInputs(lat, lng) {
        document.getElementById("latitude").value = lat;
        document.getElementById("longitude").value = lng;
    }

    initMap();
</script>
