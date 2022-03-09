@extends('layouts.admin')
@section('title', 'Dashboard')

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
              <th>Participantes</th>
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
@endsection