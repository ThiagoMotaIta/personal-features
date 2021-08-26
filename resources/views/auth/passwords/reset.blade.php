@extends('layouts.app')

@section('content')
<div class="background-login"></div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="position-center-login">
                <img class="logo-login" src="https://blockchainone.com.br/logo-min.png" />
            </div>
            <div class="position-center-login p-system-name">
                <p class="system-name">Licenciamento</p>
            </div>
            <div class="card card-custom">
                <div class="position-title-card">
                    <p class="title-card">{{ __('Recuperar Senha') }}</p>
                </div>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="email" class="label-form-custom">{{ __('E-Mail') }}</label>
                            <div class="input-container">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" readonly name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
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
                            <label for="password" class="label-form-custom">{{ __('Senha') }}</label>
                            <div class="input-container">
                                <i onclick="tooglePassword()" id="password-view" class="@error('password') icon-error @enderror icon-password far fa-eye-slash"></i>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Digite sua nova senha" autocomplete="new-password">
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
                            <label for="password-confirm" class="label-form-custom">{{ __('Confirmar Senha') }}</label>
                            <div class="input-container">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirme sua senha" required autocomplete="new-password">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-container offset-md-4">
                            <button type="submit" class="btn-confirm-login">
                                {{ __('Enviar') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

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

@include('modais.select-modal')

@endsection
