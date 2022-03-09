@extends('layouts.admin')
@section('title', 'Eventos')

@section('script')
<script>
    $(document).ready(function(){
        // Filter
            @if(\Request::hasAny(['title','description','establishment_id','event_date','type']))
                $('#collapseFilter').show();
            @endif

        // Errors
            @if(session()->has('form_error'))
                $("#modalEvent{{ session()->get('form_error') }}").modal('show');

                if("{{ session()->get('form_error') }}" == "Store"){
                    $("#eventStore_title").addClass("is-invalid");
                    $("#eventStore_description").addClass("is-invalid");
                    $("#eventStore_establishment_id").addClass("is-invalid");
                    $("#eventStore_event_date").addClass("is-invalid");
                    $("#eventStore_type").addClass("is-invalid");
                } else {
                    $("#eventUpdate_title").addClass("is-invalid");
                    $("#eventUpdate_description").addClass("is-invalid");
                    $("#eventUpdate_establishment_id").addClass("is-invalid");
                    $("#eventUpdate_event_date").addClass("is-invalid");
                    $("#eventUpdate_type").addClass("is-invalid");
                }
            @endif
    });

    function updateEvent(id){
        $.ajax({
            url: "{{url('admin/getEvent')}}",
            method: 'get',
            data: {'id': id},
            dataType: 'json',
            success: function(response){
                debugger;
                if(response){
                    $("#eventUpdate_id").val(response.id);
                    $("#eventUpdate_title").val(response.title);
                    $("#eventUpdate_description").val(response.description);
                    $("#eventUpdate_establishment_id").val(response.establishment_id);
                    $("#eventUpdate_event_date").val(response.event_date);
                    $("#eventUpdate_type").val(response.type);

                    $('#modalEventUpdate').modal('show');
                } else {
                    console.log(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Não foi possível obter os dados deste registro'
                    });
                }

            },
            error: function(error){
                console.log(error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Algo deu errado'
                });
            }
        });
    }

    function deleteEvent(id){
        Swal.fire({
            title: 'Deseja inativar este evento?',
            showDenyButton: true,
            confirmButtonText: 'Sim',
            denyButtonText: `Não`,
            icon: 'error',
        }).then((result) => {
            if (result.isConfirmed) {
                $('#eventDelete_id').val(id);
                $('#form_event_delete').submit();
            } else {
                Swal.close();
            }
        })
    }

    $('#modalEventStore').on('hide.bs.modal', function (event) {
        $("#eventStore_title").val('');
        $("#eventStore_description").val('');
        $("#eventStore_establishment_id").val('');
        $("#eventStore_event_date").val('');
        $("#eventStore_type").val('');
    });

    $('#modalEventUpdate').on('hide.bs.modal', function (event) {
        $("#eventUpdate_title").val('');
        $("#eventUpdate_description").val('');
        $("#eventUpdate_establishment_id").val('');
        $("#eventUpdate_event_date").val('');
        $("#eventUpdate_type").val('');
    });
</script>
@endsection

@section('content')
    <h1 class="mb-2">Eventos</h1>

    <div>
        <button class="btn btn-success text-light" data-bs-toggle="modal" data-bs-target="#modalEventStore">
            Cadastrar evento
        </button>
    
        <div class="float-end">
            <button class="btn btn-outline-danger" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter">
                <ion-icon name="caret-down-outline"></ion-icon>
            </button>
        </div>
    </div>

    <div class="collapse mt-2" id="collapseFilter">
        <div class="card card-body">
            <form method="GET">
                <div class="row g-2">
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="filter_title" name="title" value="{{Request('title') }}" placeholder="Título do evento">
                            <label for="filter_name">Título do evento</label>
                        </div>
                    </div>
                
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="Descrição" id="filter_description" name="description" style="height: 100px">{{ trim(Request('description')) }}</textarea>
                            <label for="filter_description">Descrição</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <select data-live-search="true" class="form-select selectpicker" id="filter_establishment_id" name="establishment_id" aria-label="Estabelecimento">
                                <option value="">Selecione</option>
                                @foreach($establishments as $establishment)
                                    <option {{ Request('establishment_id') == $establishment->id ? "selected" : "" }} value="{{$establishment->id}}">{{$establishment->name}}</option>
                                @endforeach
                            </select>
                            <label for="filter_establishment_id">Estabelecimento</label>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-floating mb-3">
                            <input type="datetime-local" class="form-control" id="filter_event_date" name="event_date" value="{{Request('event_date') }}" placeholder="Dia do evento">
                            <label for="filter_cep">Dia do Evento</label>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-floating mb-3">
                            <select data-live-search="true" class="form-select selectpicker" id="filter_type" name="type" aria-label="Tipo">
                                <option value="">Selecione</option>
                                <option {{ Request('status') == "presencial" ? "selected" : "" }} value="presencial">Presencial</option>
                                <option {{ Request('status') == "online"     ? "selected" : "" }} value="online">Online</option>
                            </select>
                            <label for="filter_type">Tipo</label>
                        </div>
                    </div>
                </div>

                <div class="float-end">
                    @if(\Request::hasAny(['title','description','establishment_id','event_date','type']))
                        <a class="btn btn-danger" href="{{ url('admin/eventos') }}">
                            Limpar filtros
                        </a>
                    @endif
                    <button class="btn btn-outline-danger" type="submit">Filtrar</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-2">
        <div class="card-body">
            <div class="table-responsive mt-3">
                <table class="table table-striped table-borderless table-hover">
                    <caption>Total: {{ $countEvent }} eventos</caption>
                    <thead class=>
                        <th>#</th>
                        <th>Título</th>
                        <th>Localização</th>
                        <th>Data do evento</th>
                        <th>Tipo</th>
                        <th>Participantes</th>
                        <th> </th>
                    </thead>
                    <tbody>
                        @forelse($events as $event)
                            <tr>
                                <td>{{ $event->id }}</td>
                                <td>{{ $event->title }}</td>
                                <td>{{ $event->establishment->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y h:i') }}</td>
                                <td>{{ $event->type }}</td>
                                <td>
                                    @php
                                        $totParticipants = \App\EventsParticipants::where('event_id', $event->id)->count('id');
                                    @endphp
                                    <a href="{{ route('evento-participantes', [$event->id]) }}">
                                        {{ $totParticipants == null || $totParticipants == '' ? 0 : $totParticipants}}
                                    </a>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning" onclick="updateEvent({{ $event->id }})">
                                        <ion-icon name="pencil"></ion-icon>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="deleteEvent({{ $event->id }})">
                                        <ion-icon name="trash"></ion-icon>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Nenhum evento encontrado</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="text-center">
                {{ $events->appends(
                    ['title'            => Request('title'),            'description'           => Request('description'),
                     'establishment_id' => Request('establishment_id'), 'event_date' => Request('event_date'),
                     'type'             => Request('type')
                    ])->links()
                }}
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEventStore" tabindex="-1" aria-labelledby="modalEventStoreLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form_event_store" action="{{ url('admin/evento/store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEventStoreLabel">Evento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-2">
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="eventStore_title" name="title" value="{{old('title') }}" placeholder="Título do evento">
                                    <label for="eventStore_name">Título do evento</label>
                                </div>
                            </div>
                        
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" placeholder="Descrição" id="eventStore_description" name="description" style="height: 100px">{{ trim(old('description')) }}</textarea>
                                    <label for="eventStore_description">Descrição</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <select data-live-search="true" class="form-select selectpicker" id="eventStore_establishment_id" name="establishment_id" aria-label="Estabelecimento">
                                        <option>Selecione</option>
                                        @foreach($establishments as $establishment)
                                            <option {{ old('establishment_id') == $establishment->id ? "selected" : "" }} value="{{$establishment->id}}">{{$establishment->name}}</option>
                                        @endforeach
                                    </select>
                                    <label for="eventStore_establishment_id">Estabelecimento</label>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-floating mb-3">
                                    <input type="datetime-local" class="form-control" id="eventStore_event_date" name="event_date" value="{{old('event_date') }}" placeholder="Dia do evento">
                                    <label for="eventStore_cep">Dia do Evento</label>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-floating mb-3">
                                    <select data-live-search="true" class="form-select selectpicker" id="eventStore_type" name="type" aria-label="Tipo">
                                        <option>Selecione</option>
                                        <option {{ old('type') == "presencial" ? "selected" : "" }} value="presencial">Presencial</option>
                                        <option {{ old('type') == "online"     ? "selected" : "" }} value="online">Online</option>
                                    </select>
                                    <label for="eventStore_type">Tipo</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <input type="file" accept="image/x-png,image/jpeg" value="{{ old('image') }}" id="eventUpdate_event_image" name="image" >
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-danger">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEventUpdate" tabindex="-1" aria-labelledby="modalEventUpdateLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form_event_update" action="{{ url('admin/evento/update') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control" id="eventUpdate_id" name="id" value="{{old('id')}}">

                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEventUpdateLabel">Evento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-2">
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="eventUpdate_title" name="title" value="{{old('title') }}" placeholder="Título do evento">
                                    <label for="eventUpdate_name">Título do evento</label>
                                </div>
                            </div>
                        
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" placeholder="Descrição" id="eventUpdate_description" name="description" style="height: 100px">{{ trim(old('description')) }}</textarea>
                                    <label for="eventUpdate_description">Descrição</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <select data-live-search="true" class="form-select selectpicker" id="eventUpdate_establishment_id" name="establishment_id" aria-label="Estabelecimento">
                                        <option>Selecione</option>
                                        @foreach($establishments as $establishment)
                                            <option {{ old('establishment_id') == $establishment->id ? "selected" : "" }} value="{{$establishment->id}}">{{$establishment->name}}</option>
                                        @endforeach
                                    </select>
                                    <label for="eventUpdate_establishment_id">Estabelecimento</label>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-floating mb-3">
                                    <input type="datetime-local" class="form-control" id="eventUpdate_event_date" name="event_date" value="{{old('event_date') }}" placeholder="Dia do evento">
                                    <label for="eventUpdate_cep">Dia do Evento</label>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-floating mb-3">
                                    <select data-live-search="true" class="form-select selectpicker" id="eventUpdate_type" name="type" aria-label="Tipo">
                                        <option>Selecione</option>
                                        <option {{ old('type') == "presencial" ? "selected" : "" }} value="presencial">Presencial</option>
                                        <option {{ old('type') == "online"     ? "selected" : "" }} value="online">Online</option>
                                    </select>
                                    <label for="eventUpdate_type">Tipo</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <input type="file" accept="image/x-png,image/jpeg" value="{{ old('image') }}" id="eventUpdate_event_image" name="image" >
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-danger">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <form id="form_event_delete" action="{{ url('admin/evento/destroy') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" class="form-control" id="eventDelete_id" name="id">
    </form>
@endsection