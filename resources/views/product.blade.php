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

    @if(Auth::check() && $action == 'edit')
        <form action="/update-product" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{$product['id']}}" name="id">
            <input type="hidden" value="{{$product['photo']}}" name="photo-name">
            <img src="{{asset('img/'.$product['photo'])}}" width="500px" alt="Product-Image">
            <label for="image">Changer d'image</label>
            <input type="file" name="image">
            <input type="text" value="{{$product['name']}}" name="name">
            <input type="number" value="{{$product['price']}}" name="price">
            <h3>Categorie</h3>
            <select name="category" id="category">
                <option value="homme" {{$product['category'] === 'homme' ? 'selected' : ''}}>Homme</option>
                <option value="femme" {{$product['category'] === 'femme' ? 'selected' : ''}}>Femme</option>
            </select>
            <h3>Description</h3>
            <textarea name="description">{{$product['description']}}</textarea>
            <input type="hidden" value="edit" name="action">
            <button type="submit">Mettre à Jour</button>
        </form>
    @else
            <img src="{{asset('img/'.$product['photo'])}}" width="500px" alt="Product-Image">
            <h3>{{$product['name']}}</h3>
            <h3>Prix</h3>
            <p>{{$product['price']}}</p>
            <h3>Categorie</h3>
            <p>{{$product['category']}}</p>
            <h3>Description</h3>
            <p>{{$product['description']}}</p>
    @endif

    <form action="/add-to-basket" method="GET">

        <input type="hidden" value="{{$product['id']}}" name="id-product">
        <button type="submit">Mettre au Panier</button>

    </form>

    </body>
</html>
