@extends('layouts.admin')
@section('title', 'Participantes do evento')

@section('script')
<script>
    $(document).ready(function(){
        // Filter
            @if(\Request::hasAny(['name','email']))
                $('#collapseFilter').show();
            @endif
    });

    function deleteParticipant(id){
        Swal.fire({
            title: 'Deseja excluir este participante?',
            showDenyButton: true,
            confirmButtonText: 'Sim',
            denyButtonText: `Não`,
            icon: 'error',
        }).then((result) => {
            if (result.isConfirmed) {
                $('#participantDelete_id').val(id);
                $('#form_event_delete').submit();
            } else {
                Swal.close();
            }
        })
    }
</script>
@endsection

@section('content')
    <h1 class="mb-2">Participantes do evento {{$event->title}}</h1>

    <div class="mb-5">
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
                            <input type="text" class="form-control" id="filter_name" name="name" value="{{Request('name') }}" placeholder="Nome do participante">
                            <label for="filter_name">Nome do participante</label>
                        </div>
                    </div>
                
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="filter_email" name="email" value="{{Request('email') }}" placeholder="E-Mail">
                            <label for="filter_name">E-Mail</label>
                        </div>
                    </div>
                </div>

                <div class="float-end">
                    @if(\Request::hasAny(['name','email','establishment_id','event_date','type']))
                        <a class="btn btn-danger" href="{{ url('admin/evento-participantes') . $event->id }}">
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
                    <caption>Total: {{ $countParticipants }} participantes</caption>
                    <thead class=>
                        <th>#</th>
                        <th>Nome do participante</th>
                        <th>E-Mail</th>
                        <th>Data de inscrição</th>
                        <th> </th>
                    </thead>
                    <tbody>
                        @forelse($participants as $participant)
                            <tr>
                                <td>{{ $participant->id }}</td>
                                <td>{{ $participant->user->name }}</td>
                                <td>{{ $participant->user->email }}</td>
                                <td>{{ \Carbon\Carbon::parse($participant->created_at)->format('d/m/Y h:i') }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="deleteParticipant({{ $participant->user->id }})">
                                        <ion-icon name="trash"></ion-icon>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Nenhum participante encontrado</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="text-center">
                {{ $participants->appends(['name' => Request('name'), 'email' => Request('email')])->links()}}
            </div>
        </div>
    </div>

    <form id="form_event_delete" action="{{ route('desmarcar-presenca-participante') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" class="form-control" value="{{$event->id}}" name="event_id">
        <input type="hidden" class="form-control" id="participantDelete_id" name="user_id">
    </form>
@endsection