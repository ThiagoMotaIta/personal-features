@extends('layouts.app')

@section('content')
    <div class="position-btns-accessibility">
        <button class="accessibility-btn" id="fontL" title="Diminuir Fonte"><i class="fas fa-minus"></i></button>
        <button class="accessibility-btn" id="fontD" title="Fonte Padrão"> A </button>
        <button class="accessibility-btn" id="fontB" title="Aumentar Fonte"><i class="fas fa-plus"></i></button>
    </div> 
    <div class="background-login"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="position-center-login">
                    <img class="logo-login" src="img/geral/logo-min.png" />
                </div>
                <div class="position-center-login p-system-name">
                    <p class="system-name">Licenciamento</p>
                </div>
                <div class="card card-custom">
                    <div class="position-title-card">
                        <p class="title-card">Entrar</p>
                    </div>
                        @php
                            //dd(request()->route());
                        @endphp
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="cpf" class="label-form-custom">{{ __('CPF') }}</label>
                                <div class="input-container">
                                    <input id="cpfMostra" type="text" class="form-control @error('cpf') is-invalid @enderror" name="cpf" value="{{ isset($_GET['cpf']) ? $_GET['cpf'] : old('cpf') }}" autocomplete="cpf" autofocus required readonly placeholder="Digite seu CPF" >
                                    @error('cpf')
                                        @if($message == 'Usuário não cadastrado')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>
                                                CPF informado não consta em nosso sistema.Verifique o dado informado.
                                                Verifique também se você já possui cadastro junto à SEFIN-Clique aqui para acessar o portal da <a class="link_another" target="_blank" href="https://www.sefin.fortaleza.ce.gov.br/">SEFIN. </a>
                                                Se já possui CPF cadastrado na SEFIN, <a class="link_another" href="{{ route('pesquisa') }}">clique aqui</a> para criar seu acesso ao portal de Licenciamento
                                            </strong>
                                        </span>
                                        @else
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @endif
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label onclick="tooglePassword()" for="password" class="label-form-custom">{{ __('Senha') }}</label>
                                <div class="input-container">
                                    <i onclick="tooglePassword()" id="password-view" class="@error('password') icon-error @enderror icon-password far fa-eye-slash"></i>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Digite sua Senha">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="position-forgot">
                            @if (Route::has('password.request'))
                                <a class="link-forgot-pass" href="{{ route('password.request', ['email' => isset($_GET['email']) ? $_GET['email'] : '']) }}">{{ __('Esqueceu sua senha?') }}</a>
                            @endif
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn-confirm-login">Entrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('modais.select-modal')
    @include('atendimento-virtual.create')
    @include('protocolo-virtual.licenca')
    @include('modais.fale-conosco')

    <script type="text/javascript">

        $( document ).ready(function() {
            updateSizeFont("size_font",".container");

            $("#btnToTop" ).click(function() {
                $('#modalSelect').modal('show');
            });

            $("#modalAtendimentoId" ).click(function() {
                $('#modalSelect').modal('hide');
                $('#modalAtendimento').modal('show');
            });

            $("#modalConsultId" ).click(function() {
                $('#modalSelect').modal('hide');
                $('#modalConsult').modal('show');
            });

            $("#modalFalaConoscoId" ).click(function() {
                $('#modalSelect').modal('hide');
                $('#modalFalaConosco').modal('show');
            });

        });

        function tooglePassword() {
            var senha = document.getElementById("password");
            var icon = document.getElementById("password-view");
            if (senha.type === "password") {
                senha.type = "text";
                $('#password-view').removeClass('fa-eye-slash');
                $('#password-view').addClass('fa-eye');
            } else {
                senha.type = "password";
                $('#password-view').removeClass('fa-eye');
                $('#password-view').addClass('fa-eye-slash');
            }
        }

    </script>

@endsection
