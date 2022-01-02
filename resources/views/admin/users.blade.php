@extends('layouts.admin')
@section('title', 'Usuários')

@section('content')
    <h1 class="mb-2">Usuários</h1>

    <div>
        <button class="btn btn-success text-light" data-bs-toggle="modal" data-bs-target="#modalUser">
            Cadastrar usuário
        </button>
    
        <div class="float-end">
            <button class="btn btn-outline-danger" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter">
                <ion-icon name="caret-down-outline"></ion-icon>
            </button>
        </div>
    </div>

    <div class="collapse mt-2" id="collapseFilter">
        <div class="card card-body">
            <form id="form" action="" method="GET">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="filtro_1" name="" placeholder="Filtro 1">
                            <label for="filtro_1">Filtro 1</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="filtro_2" name="" placeholder="Filtro 2">
                            <label for="filtro_2">Filtro 2</label>
                        </div>
                    </div>
                </div>

                <div class="float-end">
                    <a class="btn btn-danger" href="#">
                        Limpar filtros
                    </a>
                    <a class="btn btn-outline-danger" type="submit">Filtrar</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-2">
        <div class="card-body">
            <div class="table-responsive mt-3">
                <table class="table table-striped table-borderless table-hover">
                    <caption>Total: 0 usuários</caption>
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

    <div class="modal fade" id="modalUser" tabindex="-1" aria-labelledby="modalUserLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalUserLabel">Usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="" action="" method="">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="campo1" name="campo1" placeholder="campo1">
                            <label for="campo1">campo1</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" >Salvar e criar outro</button>
                    <button type="button" class="btn btn-danger">Salvar</button>
                </div>
            </div>
        </div>
    </div>
@endsection