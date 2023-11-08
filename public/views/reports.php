<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="/public/css/style.css">
    <link rel="stylesheet" type="text/css" href="/public/css/reports.css">

    <script type="text/javascript" src="/public/js/reports.js" defer></script>

    <script src="https://kit.fontawesome.com/e8f8119eda.js" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">

    <meta name='viewport' content='width=device-width, initial-scale=1' />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v2.9.2/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v2.9.2/mapbox-gl.css' rel='stylesheet' />

    <title>Strona główna - Warunki w Górach</title>
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
        <div class="search-bar">
            <input placeholder="Szukaj pinezki">
        </div>
        <?php
            $sessionRepository = new SessionRepository();
            if (isset($_COOKIE['id']) and isset($_COOKIE['login']) and $sessionRepository->isSession($_COOKIE['id'], $_COOKIE['login'])) {
                ?>
                    <form class="login" action='logout' method="GET">
                    <button class="login-button" type="submit">Wyloguj</button>
                    </form>
                <?php
            } else {
                ?>
                    <form class="login" action='login' method="GET">
                        <button class="login-button" type="submit">Zaloguj</button>
                    </form>
                <?php
            }
        ?>
    </header>
    <main>
        <div id='map'></div>
        <?php if (isset($_COOKIE['id']) and isset($_COOKIE['login']) and $sessionRepository->isSession($_COOKIE['id'], $_COOKIE['login'])) { ?>
            <form action='new_report' method="GET">
                <button class="plus-button" type="submit"><img src="/public/img/plus.svg"></button>
            </form>
        <?php } ?>
    </main>
</div>
</body>