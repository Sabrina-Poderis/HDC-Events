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
                <img src="/img/evento_1.jpg" class="img-fluid rounded" alt="imagem de evento">
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
                    <img src="/img/evento_2.jpg" class="d-block w-100" alt="imagem de palestra">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Acompanhe os principais palestrantes do mundo da computação</h5>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="/img/evento_3.jpg" class="d-block w-100" alt="imagem de evento">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Presencie eventos exclusivos</h5>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="/img/evento_4.jpg" class="d-block w-100" alt="palestra de UX">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Receba informações sobre as principais tecnologias do mercado</h5>
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
                         alt="mulher abraçando o mundo">
                </div>
    
                <div class="col-4">
                    <h4>Procurando o que fazer?</h4>
                    <p>Entre em sua conta e veja recomendações personalizadas!</p>
                </div>
    
                <div class="col-4">
                    <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modalLogin">Acesse sua conta</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Eventos -->
    <div class="container py-3">
        <div class="row gx-5">
            <h3>Eventos presenciais</h3>
            @forelse($liveEvents as $liveEvent)
                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 my-2">
                    <a href="{{url('evento') . '/' . $liveEvent->id}}" class="link-dark text-decoration-none">
                        <div class="card">
                            @if($liveEvent->image)
                                <img src="{{ isset($liveEvent->image) ? asset('img/events/'.$liveEvent->image) :  asset('img/no-found.png')}}" alt="{{ $liveEvent->title }}" class="img-responsive">
                            @else
                                <img src="{{ asset('img/not-found.png') }}" alt="Sem Imagem" class="img-responsive">
                            @endif
                            <div class="card-body">
                                <p class="card-text">
                                    <span class="badge bg-danger">{{ \Carbon\Carbon::parse($liveEvent->event_Date)->format('d/m h:m') }}</span>
                                </p>
                                <h5 class="card-title">{{$liveEvent->title}}</h5>
                                <p class="card-text">{{ $liveEvent->establishment->district}} - {{ $liveEvent->establishment->city}}, {{ $liveEvent->establishment->uf}}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <p>Não foram encontrados eventos presenciais</p>
            @endforelse
        </div>
        <div class="float-end">
            <a href="{{ route('eventos', ['type' => 'online']) }}" class="btn btn-outline-danger me-3"> 
                Veja mais
            </a>
        </div>
    </div>

    <!-- Eventos online -->
    <div class="container py-3">
        <div class="row gx-5">
            <h3>Eventos online</h3>
            @forelse($onlineEvents as $onlineEvent)
                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 my-2">
                    <a href="{{url('evento') . '/' . $onlineEvent->id}}" class="link-dark text-decoration-none">
                        <div class="card">
                            @if($onlineEvent->image)
                                <img src="{{ isset($onlineEvent->image) ? asset('img/events/'.$onlineEvent->image) :  asset('img/no-found.png')}}" alt="{{ $onlineEvent->title }}" class="img-responsive">
                            @else
                                <img src="{{ asset('img/not-found.png') }}" alt="Sem Imagem" class="img-responsive">
                            @endif
                            <div class="card-body">
                                <p class="card-text">
                                    <span class="badge bg-danger">{{ \Carbon\Carbon::parse($onlineEvent->event_Date)->format('d/m h:m') }}</span>
                                </p>
                                <h5 class="card-title">{{$onlineEvent->title}}</h5>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <p>Não foram encontrados eventos online</p>
            @endforelse
        </div>
        <div class="float-end">
            <a href="{{ route('eventos', ['type' => 'presencial']) }}" class="btn btn-outline-danger me-3"> 
                Veja mais
            </a>
        </div>
    </div>
@endsection