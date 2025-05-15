<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

    </head>
    <body>
        <header>
            <h1>JojoDrip</h1>
            <p>Bienvenue {{$admin['user']}}</p>
            <a href="/logout">Se déconnecter</a>
            <nav>

            </nav>
        </header>

    <h2>Panneau d'administration</h2>

    <table>
        <thead>
        <tr>
            <th>Tous les produits</th>
            <th>Options</th>
        </tr>
        </thead>
        <tr>
            <td></td>
            <td></td>
        </tr>

    </table>

    </body>
</html>
