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

        <form action="/buy" method="POST">
            @csrf
            <label for="name">Name</label>
            <input type="text" name="name">
            <label for="email">Email</label>
            <input type="text" name="email">
            <label for="address">Adresse</label>
            <input type="text" name="address">
            <button type="submit">Achèter</button>
        </form>
    </header>
    </body>
</html>
