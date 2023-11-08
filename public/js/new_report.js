mapboxgl.accessToken = 'pk.eyJ1IjoiZGFtaWFuLW1pemVyYSIsImEiOiJjbGRjNTB6cWkwNzdwM25ucjVtNzM1Mjd5In0.vgUZ1PRYJvQ24-3HkT1XTw';
let mapMarkers = [];

const map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/outdoors-v12',
    center: [20, 49.55],
    zoom: 8
});

fetch("/retrieve", {
    method: "POST",
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify('')
}).then(function (response) {
    return response.json();
}).then(function (projects) {
    loadPins(projects);
});

function loadPins(projects) {
    mapMarkers.forEach((marker) => marker.remove())
    mapMarkers = []

    projects.forEach(project => {
        const el = document.createElement('div');
        el.className = 'marker';

        const id = project.id;

        const marker = new mapboxgl.Marker(el)
            .setLngLat([project.longitude, project.latitude])
            .setPopup(
                new mapboxgl.Popup({offset: 25})
                    .setHTML (
                        `<h4>` + getTypeDescription(project.type) + `</h4>` + project.title + `<br>` + project.description +
                        `
                            <form class="view-form" action="report_view" method="POST">
                            <button onclick="setCookie(` + project.id + `)" type="submit">Więcej</button>
                            </form>
                        `
                    )
            )
            .addTo(map);
        mapMarkers.push(marker);
    });
}

function getTypeDescription(type) {
    switch (type) {
        case 'photo':
            return "Zdjęcie / relacja";
        case 'calendar':
            return "Ogłoszenie o wycieczce";
        case 'weather':
            return "Warunki pogodowe";
        case 'exclamation':
            return "Ostrzeżenie / ogólne";
        case 'closed':
            return "Ostrzeżenie / zamknięcie";
        case 'signpost':
            return "Ostrzeżenie / oznakowanie";
        case 'path':
            return "Ostrzeżenie / nawierzchnia"
        case 'animals':
            return "Ostrzeżenie / zwierzęta";
        case 'accident':
            return "Wypadek";
    }
}   

function setCookie(id) {
    document.cookie = "report_id=" + id;
}

function setNewReportCookie(type) {
    document.cookie = "new_report_type=" + type;
}

new_report_photo_button = document.querySelector(".new-report-photo-button");
new_report_calendar_button = document.querySelector(".new-report-calendar-button");
new_report_weather_button = document.querySelector(".new-report-weather-button");
new_report_exclamation_button = document.querySelector(".new-report-exclamation-button");
new_report_closed_button = document.querySelector(".new-report-closed-button");
new_report_signpost_button = document.querySelector(".new-report-signpost-button");
new_report_path_button = document.querySelector(".new-report-path-button");
new_report_animals_button = document.querySelector(".new-report-animals-button");
new_report_accident_button = document.querySelector(".new-report-accident-button");

new_report_photo_button

new_report_photo_button.addEventListener('click', function () {
    setNewReportCookie('photo');
});
new_report_calendar_button.addEventListener('click', function () {
    setNewReportCookie('calendar');
});
new_report_weather_button.addEventListener('click', function () {
    setNewReportCookie('weather');
});
new_report_exclamation_button.addEventListener('click', function () {
    setNewReportCookie('exclamation');
});
new_report_closed_button.addEventListener('click', function () {
    setNewReportCookie('closed');
});
new_report_signpost_button.addEventListener('click', function () {
    setNewReportCookie('signpost')
});
new_report_path_button.addEventListener('click', function () {
    setNewReportCookie('path');
});
new_report_animals_button.addEventListener('click', function () {
    setNewReportCookie('animals');
});
new_report_accident_button.addEventListener('click', function () {
    setNewReportCookie('accident');
});