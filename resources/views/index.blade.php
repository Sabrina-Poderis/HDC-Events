@extends('layouts.main')
@section('title', 'HDC Events')

@section('content')

    <!-- Intro -->
    <div class="container py-3">
        <div class="row align-items-center">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 ">
                <h2>Participe dos eventos do mundo da computação</h2>
                <p>Desenvolva os seus conhecimentos com eventos presenciais, online e conteúdos gravados</p>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <img src="/img/evento_1.jpg" class="img-fluid rounded" alt="...">
            </div>
        </div>
    </div>

    <!-- Carrossel -->
    <div class="container py-3">
        <div id="carouselIndex" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselIndex" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselIndex" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselIndex" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="/img/evento_2.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>First slide label</h5>
                        <p>Some representative placeholder content for the first slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="/img/evento_3.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Second slide label</h5>
                        <p>Some representative placeholder content for the second slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="/img/evento_4.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Third slide label</h5>
                        <p>Some representative placeholder content for the third slide.</p>
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselIndex" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselIndex" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Próximo</span>
            </button>
        </div> 
    </div>

    <!-- Espaçador -->
    <div class="bg-danger">
        <div class="container px-3">
            <div class="row d-flex align-items-center text-center g-2 p-3">
                <div class="col-4">
                    <img src="/img/undraw_world_re_768g.svg" 
                         class="img-fluid" 
                         alt="...">
                </div>
    
                <div class="col-4">
                    <h4>Procurando o que fazer?</h4>
                    <p>Entre em sua conta e veja recomendações personalizadas!</p>
                </div>
    
                <div class="col-4">
                    <button type="button" class="btn btn-light">Acesse sua conta</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Eventos -->
    <div class="container py-3">
        <div class="row gx-5">
            <h3>Eventos presenciais</h3>
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 my-2">
                <a href="" class="link-dark text-decoration-none">
                    <div class="card">
                        <img src="https://images.unsplash.com/photo-1638913970895-d3df59be1466?ixlib=rb-1.2.1&ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1031&q=80" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">
                                <span class="badge bg-danger">22 DEZ > 22 JAN</span>
                            </p>
                            <h5 class="card-title">Nome evento</h5>
                            <p class="card-text">Local - Cidade, UF</p>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 my-2">
                <a href="" class="link-dark text-decoration-none">
                    <div class="card">
                        <img src="https://images.unsplash.com/photo-1638913970895-d3df59be1466?ixlib=rb-1.2.1&ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1031&q=80" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">
                                <span class="badge bg-danger">22 DEZ > 22 JAN</span>
                            </p>
                            <h5 class="card-title">Nome evento</h5>
                            <p class="card-text">Local - Cidade, UF</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 my-2">
                <a href="" class="link-dark text-decoration-none">
                    <div class="card">
                        <img src="https://images.unsplash.com/photo-1638913970895-d3df59be1466?ixlib=rb-1.2.1&ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1031&q=80" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">
                                <span class="badge bg-danger">22 DEZ > 22 JAN</span>
                            </p>
                            <h5 class="card-title">Nome evento</h5>
                            <p class="card-text">Local - Cidade, UF</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 my-2">
                <a href="" class="link-dark text-decoration-none">
                    <div class="card">
                        <img src="https://images.unsplash.com/photo-1638913970895-d3df59be1466?ixlib=rb-1.2.1&ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1031&q=80" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">
                                <span class="badge bg-danger">22 DEZ > 22 JAN</span>
                            </p>
                            <h5 class="card-title">Nome evento</h5>
                            <p class="card-text">Local - Cidade, UF</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Eventos online -->
    <div class="container py-3">
        <div class="row gx-5">
            <h3>Eventos online</h3>
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 my-2">
                <a href="" class="link-dark text-decoration-none">
                    <div class="card">
                        <img src="https://images.unsplash.com/photo-1638913970895-d3df59be1466?ixlib=rb-1.2.1&ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1031&q=80" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">
                                <span class="badge bg-danger">22 DEZ > 22 JAN</span>
                            </p>
                            <h5 class="card-title">Nome evento</h5>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 my-2">
                <a href="" class="link-dark text-decoration-none">
                    <div class="card">
                        <img src="https://images.unsplash.com/photo-1638913970895-d3df59be1466?ixlib=rb-1.2.1&ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1031&q=80" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">
                                <span class="badge bg-danger">22 DEZ > 22 JAN</span>
                            </p>
                            <h5 class="card-title">Nome evento</h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 my-2">
                <a href="" class="link-dark text-decoration-none">
                    <div class="card">
                        <img src="https://images.unsplash.com/photo-1638913970895-d3df59be1466?ixlib=rb-1.2.1&ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1031&q=80" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">
                                <span class="badge bg-danger">22 DEZ > 22 JAN</span>
                            </p>
                            <h5 class="card-title">Nome evento</h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 my-2">
                <a href="" class="link-dark text-decoration-none">
                    <div class="card">
                        <img src="https://images.unsplash.com/photo-1638913970895-d3df59be1466?ixlib=rb-1.2.1&ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1031&q=80" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">
                                <span class="badge bg-danger">22 DEZ > 22 JAN</span>
                            </p>
                            <h5 class="card-title">Nome evento</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection