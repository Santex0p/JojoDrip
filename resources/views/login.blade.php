{{--
/// ETML
/// Author      : Santiago Escobar Toro
/// Date        : 2025-05-28
/// Description : login view
--}}
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
        <form action="/auth" method="POST">
            @csrf
        <label for="user">Utilisateur</label>
        <input id="user" name="user">

        <label for="password">Mot de passe</label>
        <input id="password" type="password" name="password">
            <button type="submit">Login</button>
        </form>
        <a href="/lost-password">Réinitialiser le mot de passe</a>
    <footer>JojoDrip - © Santiago Escobar Toro</footer>
    </body>
</html>
