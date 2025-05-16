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
            <a href="/admin">@if(Auth::check())Admin @else Se connecter @endif</a>
            <nav>

            </nav>
        </header>
    <table>
        <tr>
            <th colspan="{{count($products)}}">Produits</th>
        </tr>
        <tr>
            @foreach($products as $product)
                <td>
                    {{$product['name']}}
                </td>
                <td>
                    <a href="/product/{{$product['id']}}">Details</a>
                </td>
            @endforeach
        </tr>
    </table>
    </body>
</html>
