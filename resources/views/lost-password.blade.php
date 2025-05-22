<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    <body>
    <header>
        <nav>
            <a href="/">Accueil</a>
        </nav>
    </header>
        <form action="/reset-password" method="POST">
            @csrf
        <label for="user">Utilisateur</label>
        <input id="user" name="user">

        <label for="password">Nouveau mot de passe</label>
        <input id="password" type="password" name="password">
        <label for="password-confirmation">Confirmer le mot de passe</label>
        <input id="password-confirmation" type="password" name="password-confirmation">
            <button type="submit">Reset</button>
        </form>
    </body>
</html>
