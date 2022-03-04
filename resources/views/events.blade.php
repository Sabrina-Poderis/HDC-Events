@extends('layouts.main')
@section('title', 'Eventos')

@section('content')

    <!-- Eventos -->
    <div class="container py-3">
        <h1>Eventos</h1>

        <form method="GET">
            <div class="row gx-5">
                <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 my-2">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="event_title" name="title" placeholder="Evento" value="{{Request('title') }}">
                        <label for="event_name">Nome do evento</label>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 my-2">
                    <div class="form-floating">
                        <select data-live-search="true" class="form-select selectpicker" id="event_type" name="type" aria-label="Tipo">
                            <option value="">Selecione</option>
                            <option {{ Request('type') == "presencial" ? "selected" : "" }} value="presencial">Presencial</option>
                            <option {{ Request('type') == "online"     ? "selected" : "" }} value="online">Online</option>
                        </select>
                        <label for="event_type">Tipo de evento</label>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 my-2">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="event_date_from" name="date_from" placeholder="Data de" value="{{Request('date_from') }}">
                        <label for="event_date_from">Data de</label>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 my-2">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="event_date_to" name="date_to" placeholder="Data até" value="{{Request('date_to') }}">
                        <label for="event_date_to">Data até</label>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 my-2">
                    <div class="form-floating mb-3">
                        <input type="time" class="form-control" id="event_time_from" name="time_from" placeholder="Data de" value="{{Request('time_from') }}">
                        <label for="event_time_from">Hora de</label>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 my-2">
                    <div class="form-floating mb-3">
                        <input type="time" class="form-control" id="event_time_to" name="time_to" placeholder="Data até" value="{{Request('time_to') }}">
                        <label for="event_time_to">Hora até</label>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control cep" id="event_cep" name="cep" value="{{Request('cep') }}" placeholder="CEP">
                        <label for="event_cep">CEP</label>
                    </div>
                </div>

                <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="event_address" name="address" value="{{Request('address') }}" placeholder="Endereço">
                        <label for="event_address">Endereço</label>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="event_address_number" name="address_number" value="{{Request('address_number') }}" placeholder="Nº">
                        <label for="event_address_number">Nº</label>
                    </div>
                </div>

                <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="event_address_addon" name="address_addon" value="{{Request('address_addon') }}" placeholder="Complemento">
                        <label for="event_address_addon">Complemento</label>
                    </div>
                </div>

                <div class="col-lg-5 col-md-5 col-sm-12">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="event_district" name="district" value="{{Request('district') }}" placeholder="Bairro">
                        <label for="event_district">Bairro</label>
                    </div>
                </div>

                <div class="col-lg-5 col-md-5 col-sm-12">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="event_city" name="city" value="{{Request('city') }}" placeholder="Cidade">
                        <label for="event_city">Cidade</label>
                    </div>
                </div>

                <div class="col-lg-2 col-md-2 col-sm-12">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control uf" id="event_uf" name="uf" value="{{Request('uf') }}" placeholder="UF">
                        <label for="event_uf">UF</label>
                    </div>
                </div>

                <div class="col-12">
                    <div class="float-end">
                        @if(\Request::hasAny(['title','type','date_from','date_to','time_to','cep','address','address_number','address_addon','district','city','uf']))
                            <a class="btn btn-danger" href="{{ url('eventos') }}">
                                Limpar filtros
                            </a>
                        @endif
                        <button type="submit" class="btn btn-danger me-3"> 
                            Filtrar
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <div class="row gx-2">
            @forelse($events as $event)
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 my-2">
                    <a href="{{url('evento') . '/' . $event->id}}" class="link-dark text-decoration-none">
                        <div class="card">
                            @if($event->image)
                                <img src="{{ isset($event->image) ? asset('img/events/'.$event->image) :  asset('img/no-found.png')}}" alt="{{ $event->title }}" class="img-responsive">
                            @else
                                <img src="{{ asset('img/not-found.png') }}" alt="Sem Imagem" class="img-responsive">
                            @endif
                            <div class="card-body">
                                <p class="card-text">
                                    <span class="badge bg-danger">{{ \Carbon\Carbon::parse($event->event_Date)->format('d/m h:m') }}</span>
                                </p>
                                <h5 class="card-title">{{$event->title}}</h5>
                                <p class="card-text">{{ $event->establishment->district}} - {{ $event->establishment->city}}, {{ $event->establishment->uf}}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <p>Não foram encontrados eventos</p>
            @endforelse
        </div>

        <div class="text-center">
                {{ $events->appends(
                    ['title'         => Request('title'),         'type'           => Request('type'),
                     'date_from'     => Request('date_from'),     'date_to'        => Request('date_to'),
                     'time_from'     => Request('time_from'),     'time_to'        => Request('time_to'),
                     'address'       => Request('address'),       'address_number' => Request('address_number'),
                     'address_addon' => Request('address_addon'), 'district'       => Request('district'),
                     'city'          => Request('city'),          'uf'             => Request('uf'),
                     'cep'           => Request('cep')
                    ])->links()
                }}
        </div>
    </div>
@endsection