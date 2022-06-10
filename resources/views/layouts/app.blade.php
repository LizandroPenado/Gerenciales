<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    @guest
                    @else
                        
                        @if($usuario == "[1]")
                        <div class="collapse navbar-collapse">
                            <a class="nav-link" href="{{ route('ETL') }}">ETL</a>
                            <a class="nav-link" href="{{ route('mantenimientoUser') }}">Mantenimiento de Usuario</a>
                            <a class="nav-link" href="{{ route('respaldo_restauracion') }}">Respaldo y restauracion</a>
                        </div>
                        @elseif($usuario == "[2]")
                        <div class="collapse navbar-collapse">
                            <a class="nav-link" href="{{ route('cobro_especies') }}">cobro de especies</a>
                            <a class="nav-link" href="{{ route('especies_disponibles') }}">Especies disponibles</a>
                            <a class="nav-link" href="{{ route('inventario_especies') }}">Inventario de especies</a>
                        </div>
                        @elseif($usuario == "[3]")
                        <div class="collapse navbar-collapse">
                            <a class="nav-link" href="{{ route('cobros_zonas') }}">cobro por zonas</a>
                            <a class="nav-link" href="{{ route('especies_vendidas_zonas') }}">Especies vendidas por zonas</a>
                            <a class="nav-link" href="{{ route('inventario_zonas') }}">Inventario por zonas</a>
                        </div>
                        @endif
                    
                    @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                @if(route('login') == url()->current())
                                
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
