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
                    <a href="{{ url('/logout') }}" class="nav-link px-3"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"
                    >
                        {{ Auth::user()->name }} - Sair
                    </a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
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
                        @if(session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Sucesso!</strong> {{ session()->get('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if(session()->has('error'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Atenção!</strong> {{ session()->get('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
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
                    <form method="POST" action="{{ url('admin/profile') }}">
                        {{ csrf_field() }}
                        <input type="hidden" class="form-control" id="profile_id" name="id" value="{{ Auth::user()->id }}">

                        <div class="modal-body">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="profile_name" name="name" placeholder="Nome" value="{{ Auth::user()->name }}">
                                <label for="profile_name">Nome</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="profile_email" name="email" placeholder="E-mail" value="{{ Auth::user()->email }}">
                                <label for="profile_email">E-mail</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="profile_password" name="password" placeholder="Senha">
                                <label for="profile_password">Senha</label>
                            </div>

                            <div class="form-floating">
                                <input type="password" class="form-control" id="profile_confirm_password" name="confirm_password" placeholder="Confirmar senha">
                                <label for="profile_confirm_password">Confirmar senha</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @yield('script')

        <!-- Ícones -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>
</html>