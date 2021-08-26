@extends('home')

{{-- Rota apenas para administradores --}}
@if(Auth::user()->tipo == 1)
    <script>
        window.location.href = '{{route("protocolo-virtual.index")}}';
    </script>
@endif

@section('content-app')

    <div class="">
        @php
            //dd($record_added);
        @endphp
        @if ($editing)
            <div class="positon-btn-back">
                <a class="btn_include" href="{{ route('getUser')}}"><i class="icon-space fas fa-angle-left"></i>Voltar</a>
            </div>

            <div class="permission-footer">
                <form method="POST" action="{{ route('postUser', ['id' => $userData->id]) }}">
                @csrf
                    <div class="card card-custom">
                        <div class="position-title-card">
                            @if ($editing && !$userData->id)
                                <p class="title-card">Incluir usuário</p>
                            @else
                                <p class="title-card">Editar usuário</p>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="cpf" class="label-form-custom">CPF</label>
                                    <div class="input-container">
                                        <input class="form-control @error('cpf') is-invalid @enderror" type="text" id="cpf" name="cpf" value="{{old('cpf') ?? $userData->cpf}}" autocomplete="cpf" autofocus required placeholder="Digite o CPF">
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
                                    <label for="name" class="label-form-custom">Nome e sobrenome</label>
                                    <div class="input-container">
                                        <input class="form-control @error('name') is-invalid @enderror" type="text" onkeypress="onlyLetters()" id="name" name="name" value="{{old('name') ?? $userData->name}}" placeholder="Digite nome e sobrenome">
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
                                        <input class="form-control @error('email') is-invalid @enderror" type="text" id="email" name="email" value="{{old('email') ?? $userData->email}}" placeholder="Digite o e-mail">
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
                                    <label for="profile_id" class="label-form-custom">Perfil</label>
                                    <div class="input-container">
                                        <select class="select-form form-select @error('profile_id') is-invalid @enderror" name="profile_id" id="{{$userData->profile_id}}" value="{{old('profile_id') ?? $userData->profile_id}}">
                                            <option value="">Selecione o tipo de Perfil</option>
                                            @foreach ($profiles as $profile)
                                                @if ($userData->profile_id == $profile->id)
                                                    <option value="{{ $profile->id }}" selected>{{ $profile->name }}</option>
                                                @else
                                                    <option value="{{ $profile->id }}">{{ $profile->name  }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('profile_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="cpf" class="label-form-text">A Senha é gerada automaticamente pelos 5 primeiros digitos do CPF.</label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="positon-card-edit-profile">
                                        <button type="submit" class="btn-confirm-login">Salvar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @else
            <div class="positon_name_include">
                <p class="name_table">Usuários</p>
            </div>

            @can('usuarios-create')
                <div class="position-btn-include">
                    <a class="btn_include btn-more-space" href="{{ route('getUser')}}?editing=true"><i class="icon-space fas fa-plus-circle"></i>Incluir Usuário</a>
                </div>
            @endcan

            <table class="table table-custom">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Perfil</th>
                        <th scope="col">Email</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($userData as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->profile ? $user->profile->name : 'Usuário sem perfil' }}
                        <td>{{ $user->email }}</td>
                        <td>
                            <div class="positon-icons-table">
                            @can('usuarios-edit')
                                <a class="tresh-btn edit-btn" href="{{ route('getUser',$user->id) }}" title="Editar Usuário"><span class="tooltiptext">Editar Usuário</span><i class="fas fas fa-edit"></i></a>
                            @endcan
                            @can('usuarios-remove')
                                <a class="tresh-btn" data-bs-toggle="modal" href="#ModalDelete{{$user->id}}" title="Excluir"><span class="tooltiptext">Excluir usuário</span><i class="fas fa-trash"></i></a>
                            @endcan
                            </div>
                        </td>
                    </tr>

                    <!-- Modal -->
                    @include('user.modal.delete-user')
                @endforeach
                    <tr>
                        <td class="tfoot-align" colspan="8">
                            <span class="icon-space descripttio_title_custom">Legenda:</span>
                            <span class="icon-space"><i class="icon-space tfoot-edit fas fas fa-edit"></i>Editar Usuário</span>
                            <span class="icon-space"><i class="icon-space tfoot-btn fas fa-trash"></i>Excluir Usuário</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        @endif
    </div>

    @if(Session::has('record_added'))
    <script>
        toastr.success("{!!Session::get('record_added')!!}", 'Sucesso!');
    </script>
    @endif

    <script type="text/javascript">
        function onlyLetters() {
            if ((event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) ||  (event.charCode > 191 && event.charCode < 219) || (event.charCode > 223 && event.charCode < 252) || (event.charCode == 32)) {

            }
            else {
                event.preventDefault();
            }
        }
    </script>

@endsection

