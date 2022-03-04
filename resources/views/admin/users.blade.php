@extends('layouts.admin')
@section('title', 'Usuários')

@section('script')
<script>
    $(document).ready(function(){
        // Filter
            @if(\Request::hasAny(['name','email']))
                $('#collapseFilter').show();
            @endif

        // Errors
            @if(session()->has('form_error'))
                $("#modalUser{{ session()->get('form_error') }}").modal('show');

                if("{{ session()->get('form_error') }}" == "Store"){
                    $("#userStore_name").addClass("is-invalid");
                    $("#userStore_email").addClass("is-invalid");
                    $("#userStore_password").addClass("is-invalid");
                    $("#userStore_confirm_password").addClass("is-invalid");
                } else {
                    $("#userUpdate_name").addClass("is-invalid");
                    $("#userUpdate_email").addClass("is-invalid");
                    $("#userUpdate_password").addClass("is-invalid");
                    $("#userUpdate_confirm_password").addClass("is-invalid");
                }
            @endif
    });

    function updateUser(id){
        $.ajax({
            url: "{{url('admin/getUser')}}",
            method: 'get',
            data: {'id': id},
            dataType: 'json',
            success: function(response){
                if(response){
                    $("#userUpdate_id").val(response.id);
                    $("#userUpdate_name").val(response.name);
                    $("#userUpdate_email").val(response.email);
                    $("#userUpdate_is_admin").val(response.is_admin);
                    $('#modalUserUpdate').modal('show');
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

    function deleteUser(id){
        Swal.fire({
            title: 'Deseja inativar este usuário?',
            showDenyButton: true,
            confirmButtonText: 'Sim',
            denyButtonText: `Não`,
            icon: 'error',
        }).then((result) => {
            if (result.isConfirmed) {
                $('#userDelete_id').val(id);
                $('#form_user_delete').submit();
            } else {
                Swal.close();
            }
        })
    }

    $('#modalUserStore').on('hide.bs.modal', function (user) {
        $("#userStore_name").val('');
        $("#userStore_email").val('');
        $("#userStore_password").addClass('');
        $("#userStore_confirm_password").addClass('');
    });

    $('#modalUserUpdate').on('hide.bs.modal', function (user) {
        $("#userUpdate_name").val('');
        $("#userUpdate_email").val('');
        $("#userUpdate_password").addClass('');
        $("#userUpdate_confirm_password").addClass('');
    });
</script>
@endsection

@section('content')
    <h1 class="mb-2">Usuários</h1>
    
    <div>
        <button class="btn btn-success text-light" data-bs-toggle="modal" data-bs-target="#modalUserStore">
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
            <form method="GET">
                <div class="row g-2">
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="filter_name" name="name" value="{{Request('name') }}" placeholder="Nome do usuário">
                            <label for="filter_name">Nome do usuário</label>
                        </div>
                    </div>
                
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="filter_email" name="email" value="{{Request('email') }}" placeholder="E-Mail">
                            <label for="filter_email">E-Mail</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="filter_is_admin" name="is_admin">
                            <label class="form-check-label" for="filter_is_admin">
                                Administrador
                            </label>
                        </div>
                    </div>
                </div>

                <div class="float-end">
                    @if(\Request::hasAny(['name','email']))
                        <a class="btn btn-danger" href="{{ url('admin/usuarios') }}">
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
                    <caption>Total: {{ $countUser }} usuários</caption>
                    <thead class=>
                        <th>#</th>
                        <th>Nome</th>
                        <th>E-Mail</th>
                        <th>Admin</th>
                        <th> </th>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td> 
                                    @if($user->is_admin)
                                        <ion-icon name="key-outline"></ion-icon>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning" onclick="updateUser({{ $user->id }})">
                                        <ion-icon name="pencil"></ion-icon>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="deleteUser({{ $user->id }})">
                                        <ion-icon name="trash"></ion-icon>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Nenhum usuário encontrado</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="text-center">
                {{ $users->appends(['name' => Request('name'), 'email' => Request('email')])->links() }}
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalUserStore" tabindex="-1" aria-labelledby="modalUserStoreLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form_user_store" action="{{ url('admin/usuario/store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalUserStoreLabel">Usuário</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-2">
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="userStore_name" name="name" value="{{old('name') }}" placeholder="Nome do usuário">
                                    <label for="userStore_name">Nome do usuário</label>
                                </div>
                            </div>
                        
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="userStore_email" name="email" value="{{old('email') }}" placeholder="E-Mail">
                                    <label for="userStore_email">E-Mail</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="userStore_password" value="{{old('password') }}" name="password" placeholder="Senha">
                                    <label for="userStore_password">Senha</label>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="userStore_confirm_password" value="{{old('confirm_password') }}" name="confirm_password" placeholder="Confirmar senha">
                                    <label for="userStore_confirm_password">Confirmar senha</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="userStore_is_admin" name="is_admin" value="{{old('password') }}">
                                    <label class="form-check-label" for="userStore_is_admin">
                                        Administrador
                                    </label>
                                </div>
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

    <div class="modal fade" id="modalUserUpdate" tabindex="-1" aria-labelledby="modalUserUpdateLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form_user_update" action="{{ url('admin/usuario/update') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control" id="userUpdate_id" name="id" value="{{old('id')}}">

                    <div class="modal-header">
                        <h5 class="modal-title" id="modalUserUpdateLabel">Usuário</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-2">
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="userUpdate_name" name="name" value="{{old('name') }}" placeholder="Nome do usuário">
                                    <label for="userUpdate_name">Nome do usuário</label>
                                </div>
                            </div>
                        
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="userUpdate_email" name="email" value="{{old('email') }}" placeholder="E-Mail">
                                    <label for="userUpdate_email">E-Mail</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="userUpdate_password" value="{{old('password') }}" name="password" placeholder="Senha">
                                    <label for="userUpdate_password">Senha</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="userUpdate_confirm_password" class="form-control" id="userUpdate_confirm_password" value="{{old('confirm_password') }}" name="confirm_password" placeholder="Confirmar senha">
                                    <label for="userStore_confirm_password">Confirmar senha</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="userUpdate_is_admin" name="is_admin" value="{{old('password') }}">
                                    <label class="form-check-label" for="userUpdate_is_admin">
                                        Administrador
                                    </label>
                                </div>
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

    <form id="form_user_delete" action="{{ url('admin/usuario/destroy') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" class="form-control" id="userDelete_id" name="id">
    </form>
@endsection