mapboxgl.accessToken = 'pk.eyJ1IjoiZGFtaWFuLW1pemVyYSIsImEiOiJjbGRjNTB6cWkwNzdwM25ucjVtNzM1Mjd5In0.vgUZ1PRYJvQ24-3HkT1XTw';

report_id = getCookie('report_id');

const map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/outdoors-v12',
    zoom: 12
});

fetch("/get_report", {
    method: "POST",
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify(report_id)
}).then(function (response) {
    return response.json();
}).then(function (project) {
    loadPin(project);
});

function loadPin(project) {

    const el = document.createElement('div');
    el.className = 'marker';

    const marker = new mapboxgl.Marker(el)
        .setLngLat([project.longitude, project.latitude])
        .addTo(map);
    map.flyTo({center:[Number(project.longitude) + Number(0.06), project.latitude]});
}

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}