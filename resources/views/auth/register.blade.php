@extends('layouts.app')

{{-- Bloqueia rota por acceso direto na URL --}}
@if(!isset($cpf) && empty(old()))
<script>
    window.location.href = '{{route("pesquisa")}}';
</script>
@endif

@section('content')
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
                    <p class="title-card">Registrar</p>
                </div>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="cpf" class="label-form-custom">{{ __('CPF') }}</label>
                            <div class="input-container">
                                <!-- Input apenas para mostrar e travar o CPF -->
                                <input id="cpfMostra" type="text" class="form-control" name="cpfMostra"
                                    value="{{ $cpf ?? old('cpf') }}" disabled="disabled">
                                <!-- Input VERDADEIRO para CPF -->
                                <input id="cpf" type="hidden" name="cpf" value="{{ $cpf ?? old('cpf') }}"
                                    autocomplete="cpf" placeholder="Digite seu CPF">
                                @error('cpf')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="name" class="label-form-custom">{{ __('Nome') }}</label>
                            <div class="input-container">
                                <input id="name" type="text" onkeypress="onlyLetters()"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" placeholder="Digite seu Nome" />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="email" class="label-form-custom">E-mail</label>
                            <div class="input-container">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" placeholder="Digite seu E-mail" />
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="telefone" class="label-form-custom">{{ __('Telefone') }}</label>
                            <div class="input-container">
                                <input id="telefone" type="text"
                                    class="form-control telefone @error('telefone') is-invalid @enderror" name="telefone"
                                    value="{{ old('telefone') }}" placeholder="Digite seu Telefone" />
                                @error('telefone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="cep" class="label-form-custom">{{ __('CEP') }}</label>
                            <small id="loadCep" style="display: none;"><i class="fa fa-spinner fa-spin"></i>
                                Carregando...</small>
                            <div class="input-container">
                                <input id="cep" type="text" class="form-control @error('cep') is-invalid @enderror"
                                    name="cep" value="{{ old('cep') }}" placeholder="Digite seu CEP" />
                                @error('cep')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="endereco" class="label-form-custom">{{ __('Endereço') }}</label>
                            <div class="input-container">
                                <input id="endereco" type="text"
                                    class="form-control @error('endereco') is-invalid @enderror" name="endereco"
                                    value="{{ old('endereco') }}" placeholder="Digite seu endereço" />
                                @error('endereco')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="numero" class="label-form-custom">{{ __('Número') }}</label>
                            <div class="input-container">
                                <input id="numero" type="number"
                                    class="form-control @error('numero') is-invalid @enderror" name="numero"
                                    value="{{ old('numero') }}" placeholder="Digite seu número" />
                                @error('numero')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="complemento" class="label-form-custom">{{ __('Complemento') }}</label>
                            <div class="input-container">
                                <input id="complemento" type="text"
                                    class="form-control @error('complemento') is-invalid @enderror" name="complemento"
                                    value="{{ old('complemento') }}"
                                    placeholder="Digite seu complemento (caso possua)" />
                                @error('complemento')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="bairro" class="label-form-custom">{{ __('Bairro') }}</label>
                            <div class="input-container">
                                <input id="bairro" type="text"
                                    class="form-control @error('bairro') is-invalid @enderror" name="bairro"
                                    value="{{ old('bairro') }}" placeholder="Digite seu bairro" />
                                @error('bairro')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="cidade" class="label-form-custom">{{ __('Cidade') }}</label>
                            <div class="input-container">
                                <input id="cidade" type="text"
                                    class="form-control @error('cidade') is-invalid @enderror" name="cidade"
                                    value="{{ old('cidade') }}" placeholder="Digite sua cidade" />
                                @error('cidade')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    @php
                    $estados = [
                    'AC' => 'Acre',
                    'AL' => 'Alagoas',
                    'AP' => 'Amapá',
                    'AM' => 'Amazonas',
                    'BA' => 'Bahia',
                    'CE' => 'Ceará',
                    'DF' => 'Distrito Federal',
                    'ES' => 'Espírito Santo',
                    'GO' => 'Goiás',
                    'MA' => 'Maranhão',
                    'MT' => 'Mato Grosso',
                    'MS' => 'Mato Grosso do Sul',
                    'MG' => 'Minas Gerais',
                    'PA' => 'Pará',
                    'PB' => 'Paraíba',
                    'PR' => 'Paraná',
                    'PE' => 'Pernambuco',
                    'PI' => 'Piauí',
                    'RJ' => 'Rio de Janeiro',
                    'RN' => 'Rio Grande do Norte',
                    'RS' => 'Rio Grande do Sul',
                    'RO' => 'Rondônia',
                    'RR' => 'Roraima',
                    'SC' => 'Santa Catarina',
                    'SP' => 'São Paulo',
                    'SE' => 'Sergipe',
                    'TO' => 'Tocantins'
                    ];
                    @endphp
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="uf" class="label-form-custom">{{ __('Estado') }}</label>
                            <div class="input-container">
                                <select id='uf' name="uf" class="select-form form-select @error('uf') is-invalid @enderror" />
                                    <option value="">Selecione o estado</option>
                                    @foreach($estados as $key => $value)
                                    <option value="{{$key}}" {{ $key==old('uf') ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                    </select>
                                    @error('uf')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label onclick="viewPassword('n')" for="password" class="label-form-custom">{{ __('Senha') }}</label>
                            <div class="input-container">
                                <i onclick="viewPassword('n')" id="password-view"
                                    class="@error('password') icon-error @enderror icon-password far fa-eye-slash"></i>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    placeholder="Digite sua senha com no mínimo 8 caracteres">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label onclick="viewPassword('c')" for="password-confirm" class="label-form-custom">{{ __('Confirmar Senha') }}</label>
                            <div class="input-container">
                                <i onclick="viewPassword('c')" id="password-confirm-view"
                                    class="@error('password') icon-error @enderror icon-password far fa-eye-slash"></i>
                                <input id="password-confirm" type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password_confirmation" placeholder="Confirme sua Senha">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <button type="submit" onclick="upload()" class="btn-confirm-login">Criar conta</button>
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

</script>

<script type="text/javascript">

    function viewPassword(x) {
        if(x=='n'){
            console.log('n');
            var senha = document.getElementById("password");
            // var icon = document.getElementById("password-view");
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
        else if(x=='c'){
            console.log('c');
            var senha = document.getElementById("password-confirm");
            // var icon = document.getElementById("password-confirm-view");
            if (senha.type === "password") {
                senha.type = "text";
                $('#password-confirm-view').removeClass('fa-eye-slash');
                $('#password-confirm-view').addClass('fa-eye');
            } else {
                senha.type = "password";
                $('#password-confirm-view').removeClass('fa-eye');
                $('#password-confirm-view').addClass('fa-eye-slash');
            }
        }
    }
       

    function onlyLetters() {
        if ((event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode > 191 && event.charCode < 219) || (event.charCode > 223 && event.charCode < 252) || (event.charCode == 32)) {

        }
        else {
            event.preventDefault();
        }
    }
    $(document).ready(function () {

        $("#btnToTop").click(function () {
            $('#modalSelect').modal('show');
        });

        $("#modalAtendimentoId").click(function () {
            $('#modalSelect').modal('hide');
            $('#modalAtendimento').modal('show');
        });

        $("#modalConsultId").click(function () {
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