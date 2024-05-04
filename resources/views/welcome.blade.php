<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Carbon Footrint Tracker</title>
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
        padding: 10px;
        font-size: 17px;
        font-family: Verdana, Geneva, Tahoma, sans-serif
    }

    .background {
        position: fixed;
        height: 100dvh;
        width: 100vw;
    }

    .main-content-section {
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: relative;
        height: 100dvh;
    }

    .nav-section {
        display: flex;
        width: 100%;
        justify-content: flex-end;
    }

    .about-section {
        display: flex;
        position: relative;
        bottom: 10%;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
        align-self: center;
        margin: 2px;
        height: 100%;
        width: 300px;
    }

    .about-section * {
        font-family: Verdana, Geneva, Tahoma, sans-serif
    }

</style>

<body>
    <img class="background" src="http://carbon-footprint-tracking-app.test/storage/images/welcome_1.jpg" alt="">
    <div class="main-content-section">
        @if (Route::has('login'))
            <nav class="nav-section">
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
        <div class="about-section">
            <h2>EcoTrack</h2>
            <p>The app that let's you track your carbon footprint and share it with your friends!</p>
        </div>
        </div>
</body>

</html>
