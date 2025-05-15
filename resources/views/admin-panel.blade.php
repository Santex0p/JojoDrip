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
        <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{$product['name']}}</td>
            <td>
                <a href="/edit">Editer</a>
                <a href="/delete">Effacer</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

    <table>
        <thead>
        <tr>
            <th>Order - List</th>
            <th>Status</th>
            <th>Change Status</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
            </tr>
        </tbody>
    </table>

    </body>
</html>
