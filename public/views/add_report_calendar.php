<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="/public/css/style.css">
    <link rel="stylesheet" type="text/css" href="/public/css/add_report_calendar.css">

    <script type="text/javascript" src="/public/js/add_report.js" defer></script>

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
            <div class="report-logo">
                <img class="icon" src="public/img/calendar.svg">
            </div>
            <form class="add-report-form" action="add_report_calendar" method="POST" ENCTYPE="multipart/form-data">
                <input class="type-input" name="type" type="text" placeholder="Typ zgłoszenia: poszukuję towarzysza wyprawy">
                <input class="latitude-input" name="latitude" type="text" placeholder="Szerokość geograficzna (wybierz z mapy)">
                <input class="longitude-input" name="longitude" type="text" placeholder="Długość geograficzna (wybierz z mapy)">
                <input class="title-input" name="title" type="text" placeholder="Tytuł (np. Wycieczka na Turbacz)">
                <input class="date-input" name="date" type="text" placeholder="Data (np. 12/07/2023)">
                <input class="contact-input" name="contact" type="text" placeholder="Dane do kontaktu (imię, nazwisko, nr telefonu)">
                <textarea class="description-input" name="description" rows=3 placeholder="Opis wycieczki (punkt startu, punkty pośrednie, planowany czas przejścia)"></textarea>
                <button type="submit">Dodaj pinezkę do mapy!</button>
            </form>
        </div>
    </main>
</div>
</body>