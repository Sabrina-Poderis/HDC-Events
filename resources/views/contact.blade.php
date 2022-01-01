@extends('layouts.main')
@section('title', 'Contato')

@section('content')
    <div class="container py-3">
        <h1>Contato</h1>

        <p class="w-responsive mx-auto mb-5">
            Você tem alguma dúvida? Não hesite em entrar em contato conosco. 
        </p>

        <div class="row">
            <div class="col-md-9 mb-md-0 mb-5">
                <form id="contact_form" name="contact_form" action="" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Nome completo">
                                <label for="contact_name">Nome completo</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="contact_email" name="contact_email" placeholder="E-mail">
                                <label for="contact_email">E-mail</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="contact_subject" name="contact_subject" placeholder="Assunto">
                                <label for="contact_subject">Assunto</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-floating">
                                <textarea id="contact_message" name="contact_message" style="height: 200px" class="form-control" placeholder="Mensagem"></textarea>
                                <label for="contact_message">Mensagem</label>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="text-md-left">
                    <a class="btn btn-outline-danger" onclick="document.getElementById('contact-form').submit();">Enviar</a>
                </div>

            </div>

            <div class="col-md-3 text-center">
                <ul class="list-unstyled mb-0">
                    <li><ion-icon size="large" style="color: #e3342f" name="location-outline"></ion-icon>
                        <p>Santo André, SP</p>
                    </li>

                    <li><ion-icon size="large" style="color: #e3342f" name="call-outline"></ion-icon>
                        <p>(11) 8002-8922</p>
                    </li>

                    <li><ion-icon size="large"style="color: #e3342f"  name="mail-outline"></ion-icon>
                        <p>nome@exemplo.com.br</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection