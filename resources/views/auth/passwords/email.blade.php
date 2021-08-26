
@extends('layouts.app')

@section('content')
<div class="background-login"></div>
    <div class="container">
        <div class="col-md-12">
            <div class="position-center-login">
                <img class="logo-login" src="https://blockchainone.com.br/logo-min.png" />
            </div>
            <div class="position-center-login p-system-name">
                <p class="system-name">Licenciamento</p>
            </div>
            <div class="card card-custom">
                <div class="position-title-card">
                    <p class="title-card">RECUPERAR SENHA</p>
                </div>
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                @endif
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="cpf" class="label-form-custom">{{ __('E-Mail') }}</label>
                            <div class="input-container">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ isset($_GET['email']) ? $_GET['email'] : old('email') }}" required autocomplete="email" autofocus placeholder="Digite seu e-mail">
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
                            <button type="submit" class="btn-confirm-login">Enviar Link</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<a href="{{ route('home') }}" id="btnToTop" type="button" class="btn btn-primary"><i class="fas fa-undo-alt fa-2x"></i></a>
   {{-- @include('modais.select-modal') --}}
@endsection
