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
        <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm ">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{-- {{ config('app.name', 'Laravel') }} --}}
                    Veterinaria vida 
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                        @else
                       
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{route('home')}}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{  Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('home') }}">
                                     {{ __('Perfil') }}
                                    </a>
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
                            <?php $customer = Auth::user()->customer ?>   
                            @if ($customer)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('show_pets',Auth::user()->id) }}">{{ __('Mascotas') }}</a>
                                </li>
                               
                            @endif
                           
                            @if (Auth::user()->veterinarian)
                                @if(Auth::user()->admin == 0)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('see_Customers') }}">{{ __('Ver Clientes') }}</a>
                                </li>
                                @endif
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('show_all_reservations') }}">{{ __('ver reservas') }}</a>
                                </li>
                            @endif
                            <?php $admin = Auth::user()->admin ?>   
                            @if ($admin)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('see_users') }}">{{ __('Ver usuarios') }}</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      Panel de control
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                      <a class="dropdown-item" href="{{ route('show_Services') }}">Servicios</a>
                                      <a class="dropdown-item" href="{{ route('showBreeds') }}">Razas</a>
                                      <a class="dropdown-item" href="{{ route('show_species') }}">Especies</a>
                                      <a class="dropdown-item" href="{{ route('all_bargains') }}">Ofertas</a>
                                    </div>
                                </li>
                            @endif
                        @endguest
                            <li class="nav-item">
                            <a href="{{route('showAvailableBargains')}}" class="nav-link">Ofertas</a>
                            </li>
                            <li class="nav-item">
                            <a href="{{route('recomendaciones')}}" class="nav-link">Recomendaciones</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('contactanos')}}" class="nav-link">Contactanos</a>
                            </li>
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
