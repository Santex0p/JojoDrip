<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css'])
    </head>
    <body>
    <header>
        <nav>
            <div class="logo"><a href="/"><img src="{{asset('img/Logo-jojo.png')}}" alt="logo"></a></div>
            <div class="menu">
                <a href="/">Accueil</a>
                @if(Auth::check())
                    <a href="/admin"><img src="{{asset('img/admin.png')}}" alt="admin"></a>
                    <a href="/logout"><img src="{{asset('img/logout.png')}}" alt="logout"></a>
                @else
                    <a href="/login"><img src="{{asset('img/login.png')}}" alt="login"></a>
                @endif
                <a href="/basket"><img src="{{asset('img/panier.png')}}" alt="basket"></a>
            </div>
        </nav>
    </header>
    <section class="product-edit">
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
    </section>
    @else
        <section class="product-detail">
            <div class="image">
                <img src="{{ asset('img/' . $product['photo']) }}"
                     alt="{{ $product['name'] }}">
            </div>
            <div class="info">
                <h2>{{ $product['name'] }}</h2>
                <p class="price">{{ $product['price'] }} fr</p>
                <p class="description">
                    {{ $product['description'] }}
                </p>
            </div>
        </section>
    @endif

    <form id="add-basket" action="/add-to-basket" method="GET">

        <input type="hidden" value="{{$product['id']}}" name="id-product">
        <button type="submit" form="add-basket">Mettre au Panier</button>

    </form>

    </body>
</html>
