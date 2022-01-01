@extends('layouts.main')
@section('title', 'Eventos')

@section('content')

    <!-- Eventos -->
    <div class="container py-3">
        <h1>Eventos</h1>

        <div class="row gx-5">
            <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 my-2">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="event_name" name="event_name" placeholder="Evento">
                    <label for="event_name">Nome do evento</label>
                </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 my-2">
                <div class="form-floating">
                    <select class="form-select" id="event_type" aria-label="Floating label select example">
                        <option></option>
                        <option value="presencial">Presencial</option>
                        <option value="online">Online</option>
                        <option value="ambos">Ambos</option>
                    </select>
                    <label for="event_type">Tipo de evento</label>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 my-2">
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="event_date_from" name="event_date_from" placeholder="Data de">
                    <label for="event_date_from">Data de</label>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 my-2">
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="event_date_to" name="event_date_to" placeholder="Data até">
                    <label for="event_date_to">Data até</label>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 my-2">
                <div class="form-floating mb-3">
                    <input type="time" class="form-control" id="event_time_from" name="event_time_from" placeholder="Data de">
                    <label for="event_time_from">Hora de</label>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 my-2">
                <div class="form-floating mb-3">
                    <input type="time" class="form-control" id="event_time_to" name="event_time_to" placeholder="Data até">
                    <label for="event_time_to">Hora até</label>
                </div>
            </div>

            <div class="col-12">
                <button type="button" class="btn btn-outline-danger me-3" data-bs-toggle="modal" data-bs-target="#modalLocation"> 
                    Localização <ion-icon name="location-outline"></ion-icon>
                </button>

                <button type="submit" class="btn btn-danger  me-3"> 
                    Filtrar
                </button>
            </div>
        </div>

        <div class="row gx-2">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 my-2">
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

            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 my-2">
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

            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 my-2">
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

            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 my-2">
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

     <!-- Modal Localização-->
     <div class="modal fade" id="modalLocation" tabindex="-1" aria-labelledby="modalLocationLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLocationLabel">Localização</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="location_where" name="location_where" placeholder="Onde?">
                                <label for="location_where">Onde?</label>
                            </div>
                        </form>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <a href="" class="link-dark text-decoration-none">
                                    <ion-icon style="color: #e3342f" size="" name="location-outline"></ion-icon>
                                    Santo André
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="" class="link-dark text-decoration-none">
                                    <ion-icon style="color: #e3342f" size="" name="location-outline"></ion-icon>
                                    São Bernardo
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="" class="link-dark text-decoration-none">
                                    <ion-icon style="color: #e3342f" size="" name="location-outline"></ion-icon>
                                    São Caetano
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="" class="link-dark text-decoration-none">
                                    <ion-icon style="color: #e3342f" size="" name="location-outline"></ion-icon>
                                    Diadema
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="" class="link-dark text-decoration-none">
                                    <ion-icon style="color: #e3342f" size="" name="location-outline"></ion-icon>
                                    Alagoinha
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
@endsection