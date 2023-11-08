<?php
    $reportRepository = new ReportRepository();
    $report = $reportRepository->getReport((int)$_COOKIE['report_id']);
?>

<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="/public/css/style.css">
    <link rel="stylesheet" type="text/css" href="/public/css/report_view.css">

    <script type="text/javascript" src="/public/js/report_view.js" defer></script>

    <script src="https://kit.fontawesome.com/e8f8119eda.js" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">

    <meta name='viewport' content='width=device-width, initial-scale=1' />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v2.9.2/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v2.9.2/mapbox-gl.css' rel='stylesheet' />

    <title>Zgłoszenie #<?php echo $_COOKIE['report_id'] ?> - Warunki w Górach</title>
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
            <form action="reports" method="GET">
                <button type="submit">Powrót do strony głównej</button>
            </form>
            <?php
                $sessionRepository = new SessionRepository();
                $userRepository = new UserRepository();
                if (isset($_COOKIE['id']) and isset($_COOKIE['login']) and $sessionRepository->isSession($_COOKIE['id'], $_COOKIE['login']) and $userRepository->isUserModerator($_COOKIE['id'])) {
                    ?>
                    <form action="delete" method="POST">
                        <button type="submit">Usuń to zgłoszenie</button>
                    </form>
                    <?php
                }
            ?>
    </header>
    <main>
        <div id='map'></div>
        <div class="panel">
            <?php if ($report->getType() == 'calendar') { ?>
                <form class="properties-calendar-form">
                    <input class="type-input" name="type" type="text" placeholder="Typ zgłoszenia: poszukuję towarzysza wyprawy">
                    <input class="title-input" name="title" type="text" placeholder="<?php echo $report->getTitle() ?>">
                    <input class="date-input" name="date" type="text" placeholder="<?php echo $report->getDate() ?>">
                    <input class="contact-input" name="contact" type="text" placeholder="<?php echo $report->getContact() ?>">
                    <textarea class="description-input" name="description" rows=10 placeholder="<?php echo $report->getDescription() ?>"></textarea>
                </form>
            <?php } else { ?>
                <form class="properties-report-form">
                    <input class="type-input" name="type" type="text" placeholder="<?php echo $report->getTypeString() ?>">
                    <input class="title-input" name="title" type="text" placeholder="<?php echo $report->getTitle() ?>">
                    <textarea class="description-input" name="description" rows=3 placeholder="<?php echo $report->getDescription() ?>"></textarea>
                    <img class="uploaded-image" src="<?php echo "/public/uploads/".$report->getImage() ?>">
                </form>
            <?php } ?>
        </div>
    </main>
</div>
</body>