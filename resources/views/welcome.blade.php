<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Carbon Footrint Tracker</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
</head>

{{-- styles --}}
<style>
    * {
        margin: 0;
        padding: 0
    }

    .links {
        text-decoration: none;
        color: black;
    }

    .background {
        position: fixed;
        height: 100dvh;
        width: 100vw;
    }

    .nav {
        display: flex;
        height: 100dvh;
        width: 100vw;
        justify-content: center;
        align-items: center;
        position: relative;
    }

</style>

<body>
    <img class="background" src="http://carbon-footprint-tracking-app.test/storage/images/welcome_bg.jpg" alt="">
    <div class="nav">
        <div >
        </div>
        @if (Route::has('login'))
            <nav >
                @auth
                    <a href="{{ url('/dashboard') }}" class="links">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="links">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="links">
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
        </div>
</body>

</html>
