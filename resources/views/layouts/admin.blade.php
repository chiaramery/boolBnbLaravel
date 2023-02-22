<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- Vite --}}
    @vite(['resources/js/app.js'])

    {{-- cdn tomtom --}}
    <link rel="stylesheet" type="text/css" href="https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.50.0/maps/maps.css">
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.50.0/maps/maps-web.min.js"></script>
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.23/services/services-web.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tomtom-international/web-sdk@6.23.0"></script>
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.8.0/services/services-web.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tomtom-international/web-sdk-maps@6.14.0/services-and-helpers.min.js">
    </script>

    <script src="https://js.braintreegateway.com/web/dropin/1.33.7/js/dropin.js"></script>


    {{-- Fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>BoolBNB</title>
</head>

<body>
    <div class="dashboard">
        {{-- Header Navigation --}}
        <header class="menu-dash">
            <div class="menu-navi">
                <div class="btn-dash rounded-1 me-3">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); 
                    document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
                <a class="btn-dash rounded-1 me-3" href="{{ route('admin.apartments.create') }}">
                    <i class="fa-solid fa-plus"></i>
                    Aggiungi
                </a>
                <a class="btn-dash rounded-1 me-3" href="{{ route('admin.apartments.create') }}">
                    <i class="fa-solid fa-user"></i>
                    {{ Auth::user()->name }} {{ Auth::user()->lastname }}
                </a>

            </div>
        </header>
        {{-- NavBar Navigation --}}
        <div class="navbar-dash">
            <div class="nav-dash">
                <div class="logo">
                    <h3 class="text-logo">Bool</h3>
                </div>
                <ul class="navigation">
                    <li class="single-nav {{ Route::currentRouteName() === 'admin.dashboard' ? 'dash-active' : '' }}">
                        <a class="nav-link title-link {{ Route::currentRouteName() === 'admin.dashboard' ? 'color-active' : '' }}"
                            href="{{ route('admin.dashboard') }}">
                            <i class="fa-solid fa-house me-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li
                        class="single-nav mt-4 {{ Route::currentRouteName() === 'admin.apartments.index' ? 'dash-active' : '' }}">
                        <a class="nav-link title-link {{ Route::currentRouteName() === 'admin.apartments.index' ? 'color-active' : '' }}"
                            href="{{ route('admin.apartments.index') }}">
                            <i class="fa-solid fa-person-shelter me-2"></i>
                            Appartamenti
                        </a>
                    </li>
                    <li
                        class="single-nav mt-4 {{ Route::currentRouteName() === 'admin.search' ? 'dash-active' : '' }}">
                        <a class="nav-link title-link {{ Route::currentRouteName() === 'admin.search' ? 'color-active' : '' }}"
                            href="{{ route('admin.search') }}">
                            <i class="fa-solid fa-magnifying-glass me-2"></i>
                            Cerca
                        </a>
                    </li>
                    <li
                        class="single-nav mt-4 {{ Route::currentRouteName() === 'admin.messages.index' ? 'dash-active' : '' }}">
                        <a class="nav-link title-link {{ Route::currentRouteName() === 'admin.messages.index' ? 'color-active' : '' }}"
                            href="{{ route('admin.messages.index') }}">
                            <i class="fa-solid fa-message me-2"></i>
                            Messaggi
                        </a>
                    </li>
                </ul>
            </div>



            <!-- Open menu -->
            <div class="open-btn">
                <i class="fa-solid fa-circle-chevron-right"></i>
            </div>

        </div>
        <main class="main-content">
            @yield('content')
        </main>



</body>

</html>
