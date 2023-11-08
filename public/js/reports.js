mapboxgl.accessToken = 'pk.eyJ1IjoiZGFtaWFuLW1pemVyYSIsImEiOiJjbGRjNTB6cWkwNzdwM25ucjVtNzM1Mjd5In0.vgUZ1PRYJvQ24-3HkT1XTw';
let mapMarkers = [];

const map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/outdoors-v12',
    center: [20, 49.55],
    zoom: 8
});

const search = document.querySelector('input[placeholder="Szukaj pinezki"]');

search.addEventListener("keyup", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();

        let data = this.value;

        fetch("/retrieve", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function (response) {
            return response.json();
        }).then(function (reports) {
            loadPins(reports);
        })
    }
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