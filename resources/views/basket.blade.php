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
            <input type="hidden" name="products" value="{{json_encode($products)}}">
            <button type="submit">Achèter</button>
        </form>


        @if($products)
        <table>é
            <thead>
                <tr>
                    <th>
                        Produits
                    </th>
                    <th>
                        Prix
                    </th>
                    <th>
                        Options
                    </th>
                </tr>
            </thead>

            @foreach($products as $key => $product)
            <tbody>
                <tr>
                    <td>
                        {{$product['name']}}
                    </td>
                    <td>
                        {{$product['price']}} CHF
                    </td>
                    <td>
                        <form action="/remove-basket" method="GET">
                            <input type="hidden" value="{{$product['id'] ?? ''}}" name="id">
                            <input type="hidden" value="{{$key}}" name="index">
                            <button type="submit">Effacer</button>
                        </form>
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
            <p>Total: {{$sum}} CHF</p>
            <a href="/remove-all">Effacer</a>
        @else
            <p>Pas de produits ajoutées</p>
        @endif
    </header>
    </body>
</html>
