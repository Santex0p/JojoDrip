<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    <body>
        <form action="/login" method="POST">
            @csrf
        <label for="user">Utilisateur</label>
        <input id="user" name="user">

        <label for="password">Nouveau mot de passe</label>
        <input id="password" type="password" name="password">
            <button type="submit">Login</button>
        </form>
    </body>
</html>
