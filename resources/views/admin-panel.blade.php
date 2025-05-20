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
            <a href="/">Accueil</a>
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
                <form id="edit-{{$product['id']}}" action="/product/{{$product['id']}}/{{$action = 'edit'}}" method="GET">
                </form>
                <form id="remove-{{$product['id']}}" action="/remove-product" method="POST">
                    @csrf
                    <input type="hidden" value="{{$product['id']}}" name="id">
                </form>
                <button type="submit" form="edit-{{$product['id']}}">Editer</button>
                <button type="submit" form="remove-{{$product['id']}}">Effacer</button>
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
        @foreach($orders as $order)
        <tbody>
            <tr>
                <td>{{$order['id']}}</td>
                <td>{{$order['status']}}</td>
                <td>
                    <form id="pending-{{$order['id']}}" action="/change-status" method="POST">
                        @csrf
                        <input type="hidden" value="{{$order['id']}}" name="id">
                        <input type="hidden" value="PENDING" name="status">
                    </form>
                    <form id="progress-{{$order['id']}}" action="/change-status" method="POST">
                        @csrf
                        <input type="hidden" value="{{$order['id']}}" name="id">
                        <input type="hidden" value="PROGRESS" name="status">
                    </form>
                    <form id="delivered-{{$order['id']}}" action="/change-status" method="POST">
                        @csrf
                        <input type="hidden" value="{{$order['id']}}" name="id">
                        <input type="hidden" value="DELIVERED" name="status">
                    </form>
                    <button type="submit" form="pending-{{$order['id']}}">Pending</button>
                    <button type="submit" form="progress-{{$order['id']}}">Progress</button>
                    <button type="submit" form="delivered-{{$order['id']}}">Delivered</button>
                </td>
            </tr>
        </tbody>
        @endforeach
    </table>

    </body>
</html>
