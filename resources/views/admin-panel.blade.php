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
                <form id="edit" action="/edit-product" method="POST">
                    @csrf
                    <input type="hidden" value="{{$product['id']}}" name="id">
                </form>
                <form id="remove" action="/remove-product" method="POST">
                    @csrf
                    <input type="hidden" value="{{$product['id']}}" name="id">
                </form>
                <button type="submit" form="edit">Editer</button>
                <button type="submit" form="remove">Effacer</button>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
        <a href="/products">Ajouter un nouveau produit</a>

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
