mapboxgl.accessToken = process.env.MAPBOX_TOKEN;
let mapMarkers = [];
let newMarker = null;

const search = document.querySelector('input[placeholder="Szukaj pinezki"]');
const latitudeInput = document.querySelector('input[placeholder="X"]');
const longitudeInput = document.querySelector('input[placeholder="Y"]');
const logoIcon = document.querySelector('.icon')

const map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/outdoors-v12',
    center: [20, 49.55],
    zoom: 8
});

map.on('style.load', function() {
    map.on('click', function(e) {
        var coordinates = e.lngLat;

        if (newMarker != null) {
            newMarker.remove();
        }

        latitudeInput.value = coordinates.lat;
        longitudeInput.value = coordinates.lng;

        const el = document.createElement('div');
        el.className = 'marker';

        newMarker = new mapboxgl.Marker(el)
            .setLngLat(coordinates)
            .setPopup(
                new mapboxgl.Popup({offset: 25})
                    .setHTML(
                        `<h3>Tytul</h3><p>Opis</p>`
                    )
            )
            .addTo(map);
    });
});

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}