@extends('layouts.admin')
@section('title', 'Dashboard')

@section('script')
  <script>
    $(document).ready(function(){

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
  });
  </script>
@endsection

@section('content')
  <h1>Dashboard</h1>

  <div class="row">
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
      <div class="card border-success mb-3">
        <div class="card-body text-success">
          <h5 class="card-title"> <ion-icon size="large" name="business-outline"></ion-icon> Estabelecimentos</h5>
          <h4 class="card-text">{{$countEstablishment}}</h4>
        </div>
      </div>
    </div>

    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
      <div class="card border-danger mb-3">
        <div class="card-body text-danger">
          <h5 class="card-title"><ion-icon size="large" name="calendar-outline"></ion-icon> Eventos</h5>
          <h4 class="card-text">{{$countEvent}}</h4>
        </div>
      </div>
    </div>

    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
      <div class="card border-primary mb-3">
        <div class="card-body text-primary">
          <h5 class="card-title"><ion-icon size="large" name="people-outline"></ion-icon> Usuários</h5>
          <h4 class="card-text">{{$countUser}}</h4>
        </div>
      </div>
    </div>
  </div>

  <div class="card mt-2">
    <div class="card-body">
      <h2>Eventos</h2>
      <div class="table-responsive mt-3">
        <table class="table table-striped table-borderless table-hover">
          <caption>Total: {{ $countEvent }} eventos</caption>
          <thead class=>
              <th>#</th>
              <th>Título</th>
              <th>Localização</th>
              <th>Data do evento</th>
              <th>Tipo</th>
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
    </div>
  </div>

  <form id="form_event_delete" action="{{ url('admin/evento/destroy') }}" method="post">
    {{ csrf_field() }}
    <input type="hidden" class="form-control" id="eventDelete_id" name="id">
  </form>
@endsection