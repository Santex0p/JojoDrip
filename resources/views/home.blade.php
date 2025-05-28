{{--
/// ETML
/// Author      : Santiago Escobar Toro
/// Date        : 2025-05-28
/// Description : home view
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
        <section class="product-grid">
            @foreach($products as $product)
                <div class="product-card">
                    <img src="{{ asset('img/'.$product['photo']) }}" alt="{{ $product['name'] }}">
                    <div class="info">
                        <h3>{{ $product['name'] }}</h3>
                        <p>{{ number_format($product['price'], 2) }} fr</p>
                        <a href="{{ url('/product/'.$product['id'].'/view') }}">Details</a>
                    </div>
                </div>
            @endforeach
        </section>
    <footer>JojoDrip - © Santiago Escobar Toro</footer>
    </body>
</html>
