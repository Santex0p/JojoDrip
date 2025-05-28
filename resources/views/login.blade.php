{{--
/// ETML
/// Author      : Santiago Escobar Toro
/// Date        : 2025-05-28
/// Description : login view
--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        @vite(['resources/css/app.css'])
    </head>
    <body>
    <header>
        <nav>
            <a href="/">Accueil</a>
        </nav>
    </header>
        <form action="/auth" method="POST">
            @csrf
        <label for="user">Utilisateur</label>
        <input id="user" name="user">

        <label for="password">Mot de passe</label>
        <input id="password" type="password" name="password">
            <button type="submit">Login</button>
        </form>
        <a href="/lost-password">Réinitialiser le mot de passe</a>
    <footer>JojoDrip - © Santiago Escobar Toro</footer>
    </body>
</html>
