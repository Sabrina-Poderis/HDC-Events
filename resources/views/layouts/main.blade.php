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
        <nav class="navbar navbar-expand-sm navbar-light bg-light fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">HDC Events</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbar">
                    <ul class="navbar-nav me-auto mb-2 mb-sm-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/eventos">Eventos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/contato">Contato</a>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="btn btn-light text-danger" data-bs-toggle="modal" data-bs-target="#modalLogin">
                                Acessar sua conta
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="btn btn-outline-danger me-3" data-bs-toggle="modal" data-bs-target="#modalRegister"> 
                                Cadastre-se
                            </button>
                        </li>
                    </ul>
                    <form>
                        <div class="input-group">
                            <input type="search" class="form-control" placeholder="Pesquisar eventos" aria-label="Pesquisar eventos">
                            <button class="btn btn-outline-danger" type="submit">
                                <ion-icon name="search-outline"></ion-icon>
                            </button>
                        </div>
                    </form>
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
                            <ul class="nav justify-content-center">
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

        <!-- Modal Login-->
        <div class="modal fade" id="modalLogin" tabindex="-1" aria-labelledby="modalLoginLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLoginLabel">Acesse sua conta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('login') }}">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="login_email" name="login_email" placeholder="E-mail">
                            <label for="login_email">E-mail</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" id="login_password" name="login_password" placeholder="Senha">
                            <label for="login_password">Senha</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger">Logar</button>
                </div>
                </div>
            </div>
        </div>

        <!-- Modal Register-->
        <div class="modal fade" id="modalRegister" tabindex="-1" aria-labelledby="modalRegisterLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalRegisterLabel">Cadastre-se</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="register_name" name="name" placeholder="Nome">
                                <label for="register_name">Nome</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="register_email" name="email" placeholder="E-mail">
                                <label for="register_email">E-mail</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="register_password" name="password" placeholder="Senha">
                                <label for="register_password">Senha</label>
                            </div>
                            <div class="form-floating">
                                <input type="password" class="form-control" id="register_confirm_password" name="confirm_password" placeholder="Confirmar senha">
                                <label for="register_confirm_password">Confirmar senha</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Cadastrar-se</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        @yield('scripts')

        <!-- Ícones -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>
</html>