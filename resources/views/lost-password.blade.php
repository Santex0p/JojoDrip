{{--
/// ETML
/// Author      : Santiago Escobar Toro
/// Date        : 2025-05-28
/// Description : lost-password view
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
                    <a href="/admin">Admin</a>
                    <a href="/logout">Se déconnecter</a>
                @else
                    <a href="/login">Se connecter</a>
                @endif
                <a href="/basket"><img src="{{asset('img/panier.png')}}" alt="basket"></a>
            </div>
        </nav>
    </header>
        <form action="/reset-password" method="POST">
            @csrf
        <label for="user">Utilisateur</label>
        <input id="user" name="user">

        <label for="password">Nouveau mot de passe</label>
        <input id="password" type="password" name="password">
        <label for="password-confirmation">Confirmer le mot de passe</label>
        <input id="password-confirmation" type="password" name="password-confirmation">
            <button type="submit">Reset</button>
        </form>
    <footer>JojoDrip - © Santiago Escobar Toro</footer>
    </body>
</html>
