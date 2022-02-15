@extends('layouts.admin')
@section('title', 'Estabelecimentos')

@section('script')
<script>
    $(document).ready(function(){
        // Mask
            $('.uf').mask('SS');
            $('.cep').mask('00000-000');
            $('.cnpj').mask('00.000.000/0000-00');

        // Filter
            @if(\Request::hasAny(['name','cnpj','address','address_number','address_addon','district','city','uf','cep']))
                $('#collapseFilter').show();
            @endif

        // Errors
            @if(session()->has('form_error'))
                $("#modalEstablishment{{ session()->get('form_error') }}").modal('show');

                if("{{ session()->get('form_error') }}" == "Store"){
                    $("#establishmentStore_name").addClass("is-invalid");
                    $("#establishmentStore_cnpj").addClass("is-invalid");
                    $("#establishmentStore_cep").addClass("is-invalid");
                    $("#establishmentStore_address").addClass("is-invalid");
                    $("#establishmentStore_address_number").addClass("is-invalid");
                    $("#establishmentStore_district").addClass("is-invalid");
                    $("#establishmentStore_city").addClass("is-invalid");
                    $("#establishmentStore_uf").addClass("is-invalid");
                } else {
                    $("#establishmentUpdate_name").addClass("is-invalid");
                    $("#establishmentUpdate_cnpj").addClass("is-invalid");
                    $("#establishmentUpdate_cep").addClass("is-invalid");
                    $("#establishmentUpdate_address").addClass("is-invalid");
                    $("#establishmentUpdate_address_number").addClass("is-invalid");
                    $("#establishmentUpdate_district").addClass("is-invalid");
                    $("#establishmentUpdate_city").addClass("is-invalid");
                    $("#establishmentUpdate_uf").addClass("is-invalid");
                }
            @endif

        // CEP
            function clearInputCEP(form) {
                $("#" + form + "_address").val("");
                $("#" + form + "_address_number").val("");
                $("#" + form + "_address_addon").val("");
                $("#" + form + "_district").val("");
                $("#" + form + "_city").val("");
                $("#" + form + "_uf").val("");
            }
        
            $(".cep").blur(function() {
                var cep = $(this).val().replace(/\D/g, '');
                form = $(this).prop('id');
                form = form.split('_', 1)[0];

                if(!cep){
                    clearInputCEP();
                } else {
                    var validateCEP = /^[0-9]{8}$/;

                    if(validateCEP.test(cep)) {
                        $("#" + form + "_address").val("...");
                        $("#" + form + "_district").val("...");
                        $("#" + form + "_city").val("...");
                        $("#" + form + "_uf").val("...");

                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(data) {
                            if (!("erro" in data)) {

                                //Desbloqueia os campos em casos de ter o mesmo CEP pra cidade inteira e o form não for de filtro
                                if(!data.logradouro && form != 'filter'){
                                    $("#" + form + "_address").removeAttr("readonly").focus();
                                    $("#" + form + "_district").removeAttr("readonly");
                                } else {
                                    $("#" + form + "_address").attr('readonly', 'true');
                                    $("#" + form + "_district").attr('readonly', 'true');
                                    $("#" + form + "_address_number").focus();
                                }

                                $("#" + form + "_address").val(data.logradouro);
                                $("#" + form + "_district").val(data.bairro);
                                $("#" + form + "_city").val(data.localidade);
                                $("#" + form + "_uf").val(data.uf);
                            } else {
                                clearInputCEP();
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'CEP não encontrado'
                                });
                            }
                        });
                    } else {
                        clearInputCEP();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Formato de CEP inválido'
                        });
                    }
                } 
            });
    });

    function updateEstablishment(id){
        $.ajax({
            url: "{{url('admin/getEstablishment')}}",
            method: 'get',
            data: {'id': id},
            dataType: 'json',
            success: function(response){
                if(response){
                    $("#establishmentUpdate_id").val(response.id);
                    $("#establishmentUpdate_name").val(response.name);
                    $("#establishmentUpdate_cnpj").val(response.cnpj);
                    $("#establishmentUpdate_cep").val(response.cep);
                    $("#establishmentUpdate_address").val(response.address);
                    $("#establishmentUpdate_address_number").val(response.address_number);
                    $("#establishmentUpdate_address_addon").val(response.address_addon);
                    $("#establishmentUpdate_district").val(response.district);
                    $("#establishmentUpdate_city").val(response.city);
                    $("#establishmentUpdate_uf").val(response.uf);

                    $('#modalEstablishmentUpdate').modal('show');
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

    function deleteEstablishment(id){
        Swal.fire({
            title: 'Deseja inativar este estabelecimento?',
            showDenyButton: true,
            confirmButtonText: 'Sim',
            denyButtonText: `Não`,
            icon: 'error',
        }).then((result) => {
            if (result.isConfirmed) {
                $('#establishmentDelete_id').val(id);
                $('#form_establishment_delete').submit();
            } else {
                Swal.close();
            }
        })
    }

    $('#modalEstablishmentStore').on('hide.bs.modal', function (event) {
        $("#establishmentStore_name").val('');
        $("#establishmentStore_cnpj").val('');
        $("#establishmentStore_cep").val('');
        $("#establishmentStore_address").val('');
        $("#establishmentStore_address_number").val('');
        $("#establishmentStore_address_addon").val('');
        $("#establishmentStore_district").val('');
        $("#establishmentStore_city").val('');
        $("#establishmentStore_uf").val('');
    });

    $('#modalEstablishmentUpdate').on('hide.bs.modal', function (event) {
        $("#establishmentUpdate_id").val('');
        $("#establishmentUpdate_name").val('');
        $("#establishmentUpdate_cnpj").val('');
        $("#establishmentUpdate_cep").val('');
        $("#establishmentUpdate_address").val('');
        $("#establishmentUpdate_address_number").val('');
        $("#establishmentUpdate_address_addon").val('');
        $("#establishmentUpdate_district").val('');
        $("#establishmentUpdate_city").val('');
        $("#establishmentUpdate_uf").val('');
    });
</script>
@endsection

@section('content')
    <h1 class="mb-2">Estabelecimentos</h1>

    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sucesso!</strong> {{ session()->get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Atenção!</strong> {{ session()->get('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div>
        <button class="btn btn-success text-light" data-bs-toggle="modal" data-bs-target="#modalEstablishmentStore">
            Cadastrar estabelecimento
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
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="filter_name" name="name" value="{{Request('name') }}" placeholder="Nome do estabelecimento">
                            <label for="filter_name">Nome do estabelecimento</label>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control cnpj" id="filter_cnpj" name="cnpj" value="{{Request('cnpj') }}" placeholder="CNPJ">
                            <label for="filter_cnpj">CNPJ</label>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control cep" id="filter_cep" name="cep" value="{{Request('cep') }}" placeholder="CEP">
                            <label for="filter_cep">CEP</label>
                        </div>
                    </div>

                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="filter_address" name="address" value="{{Request('address') }}" placeholder="Endereço">
                            <label for="filter_address">Endereço</label>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="filter_address_number" name="address_number" value="{{Request('address_number') }}" placeholder="Nº">
                            <label for="filter_address_number">Nº</label>
                        </div>
                    </div>

                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="filter_address_addon" name="address_addon" value="{{Request('address_addon') }}" placeholder="Complemento">
                            <label for="filter_address_addon">Complemento</label>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="filter_district" name="district" value="{{Request('district') }}" placeholder="Bairro">
                            <label for="filter_district">Bairro</label>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="filter_city" name="city" value="{{Request('city') }}" placeholder="Cidade">
                            <label for="filter_city">Cidade</label>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control uf" id="filter_uf" name="uf" value="{{Request('uf') }}" placeholder="UF">
                            <label for="filter_uf">UF</label>
                        </div>
                    </div>
                </div>

                <div class="float-end">
                    @if(\Request::hasAny(['name','cnpj','address','address_number','address_addon','district','city','uf','cep']))
                        <a class="btn btn-danger" href="{{ url('admin/estabelecimentos') }}">
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
                    <caption>Total: {{ $countEstablishment }} estabelecimentos</caption>
                    <thead class=>
                        <th>#</th>
                        <th>Nome</th>
                        <th>CNPJ</th>
                        <th>Localização</th>
                        <th> </th>
                    </thead>
                    <tbody>
                        @forelse($establishments as $establishment)
                            <tr>
                                <td>{{ $establishment->id }}</td>
                                <td>{{ $establishment->name }}</td>
                                <td>{{ $establishment->cnpj }}</td>
                                <td>{{ $establishment->district . ", " . $establishment->city . " - " . $establishment->uf }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning" onclick="updateEstablishment({{ $establishment->id }})">
                                        <ion-icon name="pencil"></ion-icon>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="deleteEstablishment({{ $establishment->id }})">
                                        <ion-icon name="trash"></ion-icon>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Nenhum estabelecimento encontrado</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="text-center">
                {{ $establishments->appends(
                    ['name'          => Request('name'),          'cnpj'           => Request('cnpj'),
                     'address'       => Request('address'),       'address_number' => Request('address_number'),
                     'address_addon' => Request('address_addon'), 'district'       => Request('district'),
                     'city'          => Request('city'),          'uf'             => Request('uf'),
                     'cep'           => Request('cep')
                    ])->links()
                }}
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEstablishmentStore" tabindex="-1" aria-labelledby="modalEstablishmentStoreLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form_establishment_store" action="{{ url('admin/estabelecimento/store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEstablishmentStoreLabel">Estabelecimento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-2">
                            <div class="col-lg-8 col-md-8 col-sm-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="establishmentStore_name" name="name" value="{{old('name')}}" placeholder="Nome do estabelecimento">
                                    <label id="establishmentStoreLabel_name" for="establishment_name">Nome do estabelecimento</label>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control cnpj" id="establishmentStore_cnpj" name="cnpj" value="{{old('cnpj')}}" placeholder="CNPJ">
                                    <label id="establishmentStoreLabel_cnpj" for="establishment_cnpj">CNPJ</label>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control cep" id="establishmentStore_cep" name="cep" value="{{old('cep')}}" placeholder="CEP">
                                    <label id="establishmentStoreLabel_cep" for="establishment_cep">CEP</label>
                                </div>
                            </div>

                            <div class="col-lg-8 col-md-8 col-sm-12">
                                <div class="form-floating mb-3">
                                    <input type="text" readonly class="form-control" id="establishmentStore_address" name="address" value="{{old('address')}}" placeholder="Endereço">
                                    <label id="establishmentStoreLabel_address" for="establishment_address">Endereço</label>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="establishmentStore_address_number" name="address_number" value="{{old('address_number')}}" placeholder="Nº">
                                    <label id="establishmentStoreLabel_address_number" for="establishment_address_number">Nº</label>
                                </div>
                            </div>

                            <div class="col-lg-8 col-md-8 col-sm-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="establishmentStore_address_addon" name="address_addon" value="{{old('address_addon')}}" placeholder="Complemento">
                                    <label id="establishmentStoreLabel_address_addon" for="establishment_address_addon">Complemento</label>
                                </div>
                            </div>

                            <div class="col-lg-5 col-md-5 col-sm-12">
                                <div class="form-floating mb-3">
                                    <input type="text" readonly class="form-control" id="establishmentStore_district" name="district" value="{{old('district')}}" placeholder="Bairro">
                                    <label id="establishmentStoreLabel_district" for="establishment_district">Bairro</label>
                                </div>
                            </div>

                            <div class="col-lg-5 col-md-5 col-sm-12">
                                <div class="form-floating mb-3">
                                    <input type="text" readonly class="form-control" id="establishmentStore_city" name="city" value="{{old('city')}}" placeholder="Cidade">
                                    <label id="establishmentStoreLabel_city" for="establishment_city">Cidade</label>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-12">
                                <div class="form-floating mb-3">
                                    <input type="text" readonly class="form-control uf" id="establishmentStore_uf" name="uf" value="{{old('uf')}}" placeholder="UF">
                                    <label id="establishmentStoreLabel_uf" for="establishment_uf">UF</label>
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

    <div class="modal fade" id="modalEstablishmentUpdate" tabindex="-1" aria-labelledby="modalEstablishmentUpdateLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form_establishment_update" action="{{ url('admin/estabelecimento/update') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control" id="establishmentUpdate_id" name="id" value="{{old('id')}}">

                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEstablishmentUpdateLabel">Estabelecimento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-2">
                            <div class="col-lg-8 col-md-8 col-sm-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="establishmentUpdate_name" name="name" value="{{old('name')}}" placeholder="Nome do estabelecimento">
                                    <label id="establishmentUpdateLabel_name" for="establishment_name">Nome do estabelecimento</label>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control cnpj" id="establishmentUpdate_cnpj" name="cnpj" value="{{old('cnpj')}}" placeholder="CNPJ">
                                    <label id="establishmentUpdateLabel_cnpj" for="establishment_cnpj">CNPJ</label>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control cep" id="establishmentUpdate_cep" name="cep" value="{{old('cep')}}" placeholder="CEP">
                                    <label id="establishmentUpdateLabel_cep" for="establishment_cep">CEP</label>
                                </div>
                            </div>

                            <div class="col-lg-8 col-md-8 col-sm-12">
                                <div class="form-floating mb-3">
                                    <input type="text" readonly class="form-control" id="establishmentUpdate_address" name="address" value="{{old('address')}}" placeholder="Endereço">
                                    <label id="establishmentUpdateLabel_address" for="establishment_address">Endereço</label>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="establishmentUpdate_address_number" name="address_number" value="{{old('address_number')}}" placeholder="Nº">
                                    <label id="establishmentUpdateLabel_address_number" for="establishment_address_number">Nº</label>
                                </div>
                            </div>

                            <div class="col-lg-8 col-md-8 col-sm-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="establishmentUpdate_address_addon" name="address_addon" value="{{old('address_addon')}}" placeholder="Complemento">
                                    <label id="establishmentUpdateLabel_address_addon" for="establishment_address_addon">Complemento</label>
                                </div>
                            </div>

                            <div class="col-lg-5 col-md-5 col-sm-12">
                                <div class="form-floating mb-3">
                                    <input type="text" readonly class="form-control" id="establishmentUpdate_district" name="district" value="{{old('district')}}" placeholder="Bairro">
                                    <label id="establishmentUpdateLabel_district" for="establishment_district">Bairro</label>
                                </div>
                            </div>

                            <div class="col-lg-5 col-md-5 col-sm-12">
                                <div class="form-floating mb-3">
                                    <input type="text" readonly class="form-control" id="establishmentUpdate_city" name="city" value="{{old('city')}}" placeholder="Cidade">
                                    <label id="establishmentUpdateLabel_city" for="establishment_city">Cidade</label>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-12">
                                <div class="form-floating mb-3">
                                    <input type="text" readonly class="form-control uf" id="establishmentUpdate_uf" name="uf" value="{{old('uf')}}" placeholder="UF">
                                    <label id="establishmentUpdateLabel_uf" for="establishment_uf">UF</label>
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

    <form id="form_establishment_delete" action="{{ url('admin/estabelecimento/destroy') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" class="form-control" id="establishmentDelete_id" name="id">
    </form>
@endsection