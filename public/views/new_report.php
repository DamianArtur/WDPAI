<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="/public/css/style.css">
    <link rel="stylesheet" type="text/css" href="/public/css/new_report.css">

    <script type="text/javascript" src="/public/js/new_report.js" defer></script>

    <script src="https://kit.fontawesome.com/e8f8119eda.js" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">

    <meta name='viewport' content='width=device-width, initial-scale=1' />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v2.9.2/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v2.9.2/mapbox-gl.css' rel='stylesheet' />

    <title>Dodaj zgłoszenie - Warunki w Górach</title>
</head>

<body>
    <div class="container">
        <header>
            <div class="div-logo">
                <img class="logo" src="public/img/logo.svg">
            </div>
            <div class="title"> 
                Warunki w górach
            </div>
            <form action='reports' method="GET">
                <button class="return-reports-button" type="submit">Powrót do strony głównej</button>
            </form>
        </header>
        <main>
            <div id='map'></div>

            <div class="panel">
                <div class="new-report-title">
                    Wybierz rodzaj zgłoszenia
                </div>
                <div class="pins">
                    <form class="pin" action='add_report' method="GET">
                        <button class="new-report-photo-button" type="submit"><img class="icon" src="public/img/camera.svg"></button>
                    </form>
                    <form class="pin" action='add_report_calendar' method="GET">
                        <button class="new-report-calendar-button" type="submit"><img class="icon" src="public/img/calendar.svg"></button>
                    </form>
                    <form class="pin" action='add_report' method="GET">
                        <button class="new-report-weather-button" type="submit"><img class="icon" src="public/img/weather.svg"></button>
                    </form>
                    <form class="pin" action='add_report' method="GET">
                        <button class="new-report-exclamation-button" type="submit"><img class="icon" src="public/img/exclamation.svg"></button>
                    </form>
                    <form class="pin" action='add_report' method="GET">
                        <button class="new-report-closed-button" type="submit"><img class="icon" src="public/img/closed.svg"></button>
                    </form>
                    <form class="pin" action='add_report' method="GET">
                        <button class="new-report-signpost-button" type="submit"><img class="icon" src="public/img/signpost.svg"></button>
                    </form>
                    <form class="pin" action='add_report' method="GET">
                        <button class="new-report-path-button" type="submit"><img class="icon" src="public/img/path.svg"></button>
                    </form>
                    <form class="pin" action='add_report' method="GET">
                        <button class="new-report-animals-button" type="submit"><img class="icon" src="public/img/animals.svg"></button>
                    </form>
                    <form class="pin" action='add_report' method="GET">
                        <button class="new-report-accident-button" type="submit"><img class="icon" src="public/img/accident.svg"></button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>