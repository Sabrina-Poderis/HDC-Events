@extends('layouts.main')
@section('title',  $event->title)

@section('content')
    <!-- Hero -->
    <div class="container py-3">
        @if($event->image)
            <img src="{{ isset($event->image) ? asset('img/events/'.$event->image) :  asset('img/no-found.png')}}" alt="{{ $event->title }}" class="img-fluid rounded">
        @else
            <img src="{{ asset('img/not-found.png') }}" alt="Sem Imagem" class="img-fluid rounded">
        @endif
    </div>

    <!-- Nome do evento -->
    <div class="container py-3">
        <h1>{{ $event->title }}</h1>
        <p>
            <ion-icon name="time-outline"></ion-icon> {{ \Carbon\Carbon::parse($event->event_Date)->format('d/m h:m') }}
        </p>

        @if($event->type == 'presencial')
            <p>
                <ion-icon name="location-outline"></ion-icon> {{ $event->establishment->address}} - {{ $event->establishment->district}}, {{ $event->establishment->address_number}}, {{ $event->establishment->city}} - {{ $event->establishment->uf}}
            </p>
       
            <p>
                <ion-icon name="heart-outline"></ion-icon> Lembre-se das medidas de prevenção ao COVID-19.
            </p>
        @endif

        <h2>Descrição do evento</h2>
        <p>
            {{ $event->description }}
        </p>


        @auth
            @if($userParticipating)
                <div class="float-end">
                    <form method="post" action="{{ route('desmarcar-presenca') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                        <button type="submit" class="btn btn-outline-danger"> 
                            Desmarcar presença
                        </button>
                    </form>
                </div>
            @else
                <div class="float-end">
                    <form method="post" action="{{ route('confirmar-presenca') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                        <button type="submit" class="btn btn-outline-danger"> 
                            Confirmar presença
                        </button>
                    </form>
                </div>
            @endif
        @else desmarcar
            <div class="float-end">
                
                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="tooltip" title="Você precisa estar logado para participar de um evento"> 
                    Confirmar presença
                </button>
            </div>
        @endif
    </div>

    <!-- Covid -->
    @if($event->type == 'presencial')
        <div class="bg-danger mt-5">
            <div class="container px-3">
                <p class="text-white" >
                <br><br>
                    <strong>PARA EVENTOS PRESENCIAIS</strong> <br>
                    Fique ligado! A segurança é responsabilidade de todos.
                </p>
                <div class="row d-flex align-items-center text-center g-2 p-3">
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mb-2">
                        <div class="card text-dark bg-light" style="max-width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title"><ion-icon size="large" style="color: #e3342f" name="warning-outline"></ion-icon></h5>
                                <p class="card-text">Ao frequentar um evento neste período de pandemia provocado pela COVID-19, você está ciente e assume os riscos de saúde envolvidos.</p>
                            </div>
                        </div>
                    </div>
        
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mb-2">
                        <div class="card text-dark bg-light" style="max-width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title"><ion-icon size="large" style="color: #e3342f" name="medkit-outline"></ion-icon></h5>
                                <p class="card-text">A adoção dos protocolos de saúde e segurança pelo local e pelos participantes visa mitigar os riscos de exposição e contaminação pelo coronavírus.</p>
                            </div>
                        </div>
                    </div>
        
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                        <div class="card text-dark bg-light" style="max-width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title"><ion-icon size="large" style="color: #e3342f" name="fitness-outline"></ion-icon></h5>
                                <p class="card-text">Use máscara, mantenha o distanciamento, higienize as mãos com frequência e se informe sobre as normas de segurança vigentes na cidade do evento.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection