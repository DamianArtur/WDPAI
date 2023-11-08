<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="/public/css/style.css">
    <link rel="stylesheet" type="text/css" href="/public/css/login.css">

    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">

    <title>Logowanie - Warunki w Górach</title>
</head>
<body>
    <div class="container">
        <div class="logo-container">
            <div class="logo-background">
                <div class="logo">
                    <img src="public/img/logo.svg">
                </div>
            </div>
            <div class="title-text">Warunki w Górach</div>
        </div>
        <div class="login-container">
            <form class="login-form" action="login" method="POST">
                <div class="messages">
                    <?php include './src/utilities/messages.php'; ?>
                </div>
                <div class="login-text">Logowanie</div>
                <a href="/register">Nie masz konta? Zarejestruj się</a>
                <input name="email" type="text" placeholder="E-mail">
                <input name="password" type="password" placeholder="Hasło">
                <button type="submit">Zaloguj!</button>
            </form>
        </div>
    </div>
</body>