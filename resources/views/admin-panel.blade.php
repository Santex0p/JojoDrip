{{--
/// ETML
/// Author      : Santiago Escobar Toro
/// Date        : 2025-05-28
/// Description : admin panel view
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
            <div class="logo"><a href="/"><img src="{{asset('img/Logo-jojo.png')}}" alt="logo"></a></div>
            <div class="menu">
                <a href="/">Accueil</a>
                @if(Auth::check())
                    <a href="/logout"><img src="{{asset('img/logout.png')}}" alt="logout"></a>
                @else
                    <a href="/login"><img src="{{asset('img/login.png')}}" alt="login"></a>
                @endif
                <a href="/basket"><img src="{{asset('img/panier.png')}}" alt="basket"></a>
            </div>
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
                <form id="remove-{{$product['id']}}" action="/remove-product" method="GET">
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
            <th>Commande - Liste</th>
            <th>Statut</th>
            <th>Changement d'état</th>
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
                    <button type="submit" form="pending-{{$order['id']}}">En attente</button>
                    <button type="submit" form="progress-{{$order['id']}}">Progrès</button>
                    <button type="submit" form="delivered-{{$order['id']}}">Livré</button>
                </td>
            </tr>
        </tbody>
        @endforeach
    </table>
    <footer>JojoDrip - © Santiago Escobar Toro</footer>
    </body>
</html>
