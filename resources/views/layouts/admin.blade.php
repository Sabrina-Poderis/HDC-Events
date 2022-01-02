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

        <header class="navbar bg-danger navbar-dark">
            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/admin/">HDC Events</a>
            
            <div class="navbar-nav">
                <div class="nav-item">
                    <a class="nav-link px-3" href="#">Usuário - Sair</a>
                </div>
            </div>
        </header>

        <section>
            <div class="container-fluid">
                <div class="row">
                    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light border-end sidebar collapse">
                        <div class="position-sticky pt-3">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link link-danger" aria-current="page" href="/admin/">
                                        <ion-icon name="home-outline" style="font-size:24px"></ion-icon>
                                        Dashboard
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link link-danger" href="/admin/estabelecimentos">
                                        <ion-icon name="business-outline" style="font-size:24px"></ion-icon>
                                        Estabelecimentos
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link link-danger" href="/admin/eventos">
                                        <ion-icon name="calendar-outline" style="font-size:24px"></ion-icon>
                                        Eventos
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link link-danger" href="/admin/usuarios">
                                        <ion-icon name="people-outline" style="font-size:24px"></ion-icon>
                                        Usuários
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link btn btn-light link-danger" data-bs-toggle="modal" data-bs-target="#modalProfile">
                                        <ion-icon name="person-outline" style="font-size:24px"></ion-icon>
                                        Alterar perfil
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </nav>

                    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-3">
                        @yield('content')
                    </main>
                </div>
            </div>
        </section>

        <div class="modal fade" id="modalProfile" tabindex="-1" aria-labelledby="modalProfileLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalProfileLabel">Alterar perfil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="register_name" name="register_name" placeholder="Nome">
                            <label for="register_name">Nome</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="register_email" name="login_email" placeholder="E-mail">
                            <label for="register_email">E-mail</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="register_password" name="register_password" placeholder="Senha">
                            <label for="register_password">Nova senha</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" id="register_confirm_password" name="register_confirm_password" placeholder="Confirmar senha">
                            <label for="register_confirm_password">Confirmar senha</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger">Salvar</button>
                </div>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Ícones -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>
</html>