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
                        <p class="title-card">{{ __('Login') }}</p>
                    </div>
                    <form method="POST" action="{{ route('pesquisaCPF') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="cpf" class="label-form-custom">{{ __('CPF') }}</label>
                                <div class="input-container">
                                    <input id="cpf" type="text" class="form-control {{ $errors->login->has('cpf') ? 'is-invalid' : ''}} " name="cpf" value="{{ old('cpf') }}" placeholder="Digite seu CPF" required autocomplete="CPF" >
                                    @if($errors->login->has('cpf'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->login->first('cpf')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn-confirm-login">Verificar</button>
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
    </script>

@endsection
