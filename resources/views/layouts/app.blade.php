<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white" style="height: 70px;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <!-- <span style="color:#1d1dff" class="fw-bold">{{ config('app.name', 'Laravel') }}</span> -->
                    <span class="logo-lg"><img src="/Corporate Tech Computer Logo (1).png" class="img-responsive" width="130" ></span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item menu-item">
                            <a class="nav-link" href="#">X menu</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('devs-talks') }}">{{ __('Devs Meetup') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('devs-talks') }}">{{ __('Post job') }}</a>
                        </li>
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" style="font-size: 18px; color:#000;" class="fw-bold nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <span class="">Register</span>
                            </a>

                            <div class="shadow-lg dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/user/register">
                                   <!-- <img src="{{asset('img/dev.png')}}" style="width: 25; height:25px;"> -->
                                   Register as a Developer
                                </a>
                                <a class="dropdown-item" href="/company/register">
                                <!-- <img src="{{asset('img/company.png')}}" style="width: 25; height:25px;"> -->
                                 Register as a Company
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>

                        </li>

                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" style="font-size: 18px;" class="fw-bold nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <span class="">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</span>
                            </a>

                            <div class="shadow-lg dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/user/dashboard">
                                    <i class="bi bi-house-door-fill" style="color: #1d1dff;"></i> Dashboard
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="bi bi-gear-fill" style="color: #1d1dff;"></i> Account Settings
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    <i class="bi bi-arrow-left-circle-fill" style="color: #1d1dff;"></i> {{ __('Logout') }}
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
<style>
    .nav-link {
        font-size: 18px; /* Increase the font size as desired */
        margin-right: 10px; /* Add some gap between each link */
        transition: background-color 0.3s; /* Add a smooth transition effect */
    }

    .nav-link:hover {
        background-color: #1d1dff; /* Change the background color to red on hover */
        color: #fff;
        border-radius: 5px;
    }
</style>
<style>
    body{
        font-family: 'Nunito';
        font-size: 16px;
    }
    .navbar {
        /* background-color:  rgb(79, 68, 148)!important; */
        
    } .navbar a {
        /* color:#fff!important; */

    }
    /* .navbar {
        background-color: navy!important;
        height: 90px!important;
    }
    .navbar a {
        color:#fff!important;

    } */
    .dropdown-menu {
        width: 300px;
        /* adjust as needed */
        /* height: 300px; */
        line-height: 2;
        font-size: 18px;
        border-radius: 10px;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
        /* adjust as needed */
    }
    .menu-item {
        margin-left: 100px;
        font-size: 18px;
        font-weight: bold;
    }
</style>

</html>