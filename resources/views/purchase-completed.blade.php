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
            <a href="/basket">Panier</a>
            <nav>
                <a href="/">Accueil</a>
            </nav>
        </header>
        <p>Merci pour votre achat</p>
        <p>Le statut de votre achat se trouve en {{$status}}</p>
        <a href="/">Retourner</a>
    </body>
</html>
