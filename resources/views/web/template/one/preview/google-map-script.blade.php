<script>
    const articles = {!! json_encode($articles) !!};
    const googleApiKey = '{{ config('services.google-map.api_key') }}';

    console.log('ARTICLES:', articles);

    const markerColors = [
        'red', 'blue', 'green', 'purple', 'orange', 'pink', 'yellow', 'brown'
    ];

    function getRandomColor() {
        return markerColors[Math.floor(Math.random() * markerColors.length)];
    }

    function initMap() {
        // Początkowe centrum (Polska) – zostaje na wypadek braku artykułów
        const defaultCenter = { lat: 52.2297, lng: 21.0122 };

        const map = new google.maps.Map(document.getElementById('blog-map'), {
            zoom: 6,
            center: defaultCenter,
            mapTypeId: 'roadmap',
            mapId: '8d4f0950e892b8c5'
        });

        const infoWindow = new google.maps.InfoWindow();

        // Nowość: obiekt bounds
        const bounds = new google.maps.LatLngBounds();

        articles.forEach(article => {
            const position = {
                lat: parseFloat(article.latitude),
                lng: parseFloat(article.longitude)
            };

            const color = getRandomColor();

            const marker = new google.maps.Marker({
                position: position,
                map: map,
                title: article.title,
                icon: {
                    path: google.maps.SymbolPath.BACKWARD_CLOSED_ARROW,
                    scale: 5,
                    fillColor: color,
                    fillOpacity: 1,
                    strokeWeight: 1,
                    strokeColor: '#000'
                }
            });

            marker.addListener('click', () => {
                window.location.href = `/article-preview/${article.id}`;
            });

            marker.addListener('mouseover', () => {
                infoWindow.setContent(`
                    <div class="infowindow-content">
                        ${article.title}
                    </div>
                `);
                infoWindow.open(map, marker);
            });

            marker.addListener('mouseout', () => {
                infoWindow.close();
            });

            // Rozszerz granice mapy o ten punkt
            bounds.extend(position);
        });

        // Dopasuj widok do wszystkich markerów
        if (articles.length > 0) {
            map.fitBounds(bounds);
        }

        google.maps.event.addListenerOnce(map, 'bounds_changed', function () {
            if (map.getZoom() > 10) {
                map.setZoom(10); // Maksymalny zoom np. 10
            }
        });


    }

    function loadGoogleMapsApi() {
        const script = document.createElement('script');
        script.src = `https://maps.googleapis.com/maps/api/js?key=${googleApiKey}&callback=initMap&loading=async&libraries=marker`;
        script.async = true;
        script.defer = true;
        document.head.appendChild(script);
    }

    loadGoogleMapsApi();
</script>
