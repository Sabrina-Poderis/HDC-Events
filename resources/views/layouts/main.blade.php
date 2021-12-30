<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>
    
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">HDC Events</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Pesquisar eventos" aria-label="Pesquisar eventos">
                        <button class="btn btn-outline-danger" type="submit">
                            <ion-icon name="search-outline"></ion-icon>
                        </button>
                    </form>

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                        <li class="nav-item">
                            <button class="btn btn-light m-1" type="button">
                                <ion-icon style="color: #e3342f; font-size=64px" name="location-outline"></ion-icon> Qualquer Lugar
                                <ion-icon style="color: #e3342f; font-size=64px" name="chevron-down-outline"></ion-icon>
                            </button>
                        </li>
                    </ul>


                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-light text-danger px-3 me-2">
                            Acessar sua conta
                        </button>
                        <button type="button" class="btn btn-outline-danger me-3">
                            Cadastre-se
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>

        <section class="mt-5">
            @yield('content')
        </section>

        <footer>
            <div class="container">
                <footer class="border-top">
                    <div class="row align-items-center text-center gx-5 py-3">
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                            <a href="/" class="link-dark text-decoration-none">
                                HDC Events &copy; 2021
                            </a>
                        </div>
            
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                            <a href="/" class="link-dark text-decoration-none">
                                Desenvolvido por Sabrina Poderis
                            </a>
                        </div>
            
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                            <ul class="nav">
                                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted"><ion-icon size="large" style="color: #e3342f" name="mail-outline"></ion-icon></a></li>
                                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted"><ion-icon size="large" style="color: #e3342f" name="logo-linkedin"></ion-icon></a></li>
                                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted"><ion-icon size="large" style="color: #e3342f" name="logo-github"></ion-icon></a></li>
                                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted"><ion-icon size="large" style="color: #e3342f" name="logo-instagram"></ion-icon></a></li>
                            </ul>
                        </div>
                    </div>
                </footer>
            </div>
        </footer>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Ícones -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>
</html>