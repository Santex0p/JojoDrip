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
                    <a href="/admin"><img src="{{asset('img/admin.png')}}" alt="admin"></a>
                    <a href="/logout"><img src="{{asset('img/logout.png')}}" alt="logout"></a>
                @else
                    <a href="/login"><img src="{{asset('img/login.png')}}" alt="login"></a>
                @endif
                <a href="/basket"><img src="{{asset('img/panier.png')}}" alt="basket"></a>
            </div>
        </nav>
    </header>
    <div class="form-add">
        <form action="/add-product" method="POST" enctype="multipart/form-data">
            @csrf
        <label for="name">Nom</label>
        <input type="text" name="name">
        <label for="category">Catégorie</label>
        <select name="category" id="category">
            <option value="homme">Homme</option>
            <option value="femme">Femme</option>
        </select>
        <label for="price">Prix</label>
        <input type="number" name="price" step=".01">
        <label for="image">Image</label>
        <input type="file" name="image" >
        <label for="description">Description</label>
        <textarea name="description"></textarea>

        <button type="submit">Ajouter</button>
        </form>
    </div>
    </body>
</html>
