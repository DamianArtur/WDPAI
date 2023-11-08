<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="/public/css/style.css">
    <link rel="stylesheet" type="text/css" href="/public/css/register.css">

    <script type="text/javascript" src="/public/js/register.js" defer></script>

    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">

    <title>Zarejestruj - Warunki w Górach</title>
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
    <div class="register-container">
        <form class="register-form" action="register" method="POST">
            <div class="messages">
                <?php include './src/utilities/messages.php'; ?>
            </div>
            <div class="register-text">Rejestracja</div>
            <a href="/login">Masz konto? Zaloguj się</a>
            <input name="email" type="text" placeholder="Adres e-mail">
            <input name="password" type="password" placeholder="Hasło">
            <input name="confirmedPassword" type="password" placeholder="Potwierdź hasło">
            <input name="name" type="text" placeholder="Imię">
            <input name="surname" type="text" placeholder="Nazwisko">
            <input name="phone" type="text" placeholder="Nr telefonu">
            <button type="submit">Zarejestruj się</button>
        </form>
    </div>
</div>
</body>