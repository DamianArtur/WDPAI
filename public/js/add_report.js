mapboxgl.accessToken = 'pk.eyJ1IjoiZGFtaWFuLW1pemVyYSIsImEiOiJjbGRjNTB6cWkwNzdwM25ucjVtNzM1Mjd5In0.vgUZ1PRYJvQ24-3HkT1XTw';
let mapMarkers = [];
let newMarker = null;

const latitudeInput = document.querySelector(".latitude-input");
const longitudeInput = document.querySelector(".longitude-input");
const logoIcon = document.querySelector(".icon");
const typeInput = document.querySelector(".type-input");
const titleInput = document.querySelector(".title-input");
const descriptionInput = document.querySelector(".description-input");

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

switch (getCookie("new_report_type")) {
    case 'photo':
        logoIcon.src="public/img/camera.svg";
        typeInput.placeholder="Typ zgłoszenia: zdjęcie / relacja";
        titleInput.placeholder="Tytuł (np. Relacja z Turbacza)";
        descriptionInput.placeholder="Opis (np. przebieg wyprawy)";
        break;
    case 'weather':
        logoIcon.src="public/img/weather.svg";
        typeInput.placeholder="Typ zgłoszenia: warunki pogodowe";
        titleInput.placeholder="Tytuł (np. Warunki pogodowe na Turbaczu)";
        descriptionInput.placeholder="Opis (np. zachmurzenie, 10°C, brak opadów)";
        break;
    case 'exclamation':
        logoIcon.src="public/img/exclamation.svg";
        typeInput.placeholder="Typ zgłoszenia: ostrzeżenie - ogólne";
        titleInput.placeholder="Tytuł (np. Powalone drzewo na szlaku)";
        descriptionInput.placeholder="Szczegóły ostrzeżenia";
        break;
    case 'closed':
        logoIcon.src="public/img/closed.svg";
        typeInput.placeholder="Typ zgłoszenia: zamknięcie szlaku / drogi";
        titleInput.placeholder="Tytuł (np. Zamknięcie szlaku na Turbacz)";
        descriptionInput.placeholder="Opis (przyczyna zamknięcia / data ponownego otwarcia)";
        break;
    case 'signpost':
        logoIcon.src="public/img/signpost.svg";
        typeInput.placeholder="Typ zgłoszenia: ostrzeżenie - znakowanie szlaku";
        titleInput.placeholder="Tytuł (np. Zniszczony drogowskaz)";
        descriptionInput.placeholder="Opis (kolor szlaku, informacje z drogowskazu)";
        break;
    case 'path':
        logoIcon.src="public/img/path.svg";
        typeInput.placeholder="Typ zgłoszenia: ostzeżenie - stan nawierzchni";
        titleInput.placeholder="Tytuł (np. Uszkodzona nawierzchnia na szlaku)";
        descriptionInput.placeholder="Opis utrudnienia";
        break;
    case 'animals':
        logoIcon.src="public/img/animals.svg";
        typeInput.placeholder="Typ zgłoszenia: ostrzeżenie - dzikie zwierzęta";
        titleInput.placeholder="Tytuł";
        descriptionInput.placeholder="Opis";
        break;
    case 'accident':
        logoIcon.src="public/img/accident.svg";
        typeInput.placeholder="Typ zgłoszenia: ostrzeżenie - wypadek z udziałem ludzi";
        titleInput.placeholder="Tytuł";
        descriptionInput.placeholder="Opis";
        break;
}
