@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
  <h1>Dashboard</h1>

  <div class="row">
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
      <div class="card border-success mb-3">
        <div class="card-body text-success">
          <h5 class="card-title"> <ion-icon size="large" name="business-outline"></ion-icon> Estabelecimentos</h5>
          <h4 class="card-text">10</h4>
        </div>
      </div>
    </div>

    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
      <div class="card border-danger mb-3">
        <div class="card-body text-danger">
          <h5 class="card-title"><ion-icon size="large" name="calendar-outline"></ion-icon> Eventos</h5>
          <h4 class="card-text">20</h4>
        </div>
      </div>
    </div>

    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
      <div class="card border-primary mb-3">
        <div class="card-body text-primary">
          <h5 class="card-title"><ion-icon size="large" name="people-outline"></ion-icon> Usuários</h5>
          <h4 class="card-text">1</h4>
        </div>
      </div>
    </div>
  </div>

  <div class="card mt-2">
    <div class="card-body">
      <h2>Eventos</h2>
      <div class="table-responsive mt-3">
        <table class="table table-striped table-borderless table-hover">
          <caption>Total: 0 eventos</caption>
            <thead class=>
              <th>#</th>
              <th>First</th>
              <th>Last</th>
              <th>Handle</th>
            </thead>

            <tbody>
              <tr>
                <td>1</td>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
              </tr>

              <tr>
                <td>1</td>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
              </tr>

              <tr>
                <td>1</td>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
              </tr>
              </tbody>
            <tfoot>
              <td colspan="4">1</td>
            </tfoot>
        </table>
      </div>
    </div>
  </div>
@endsection