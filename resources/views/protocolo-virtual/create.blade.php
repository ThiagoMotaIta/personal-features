@extends('home')

@section('content-app')

    <div class="positon-btn-back">
        <a class="btn_include" href="{{ route('protocolo-virtual.index')}}"><i class="icon-space fas fa-angle-left"></i>Voltar</a>
    </div>
    <div class="card card-custom">
        <div class="position-title-card">
            <p class="title-card">ABRIR PROTOCOLO VIRTUAL</p>
        </div>

        @component('protocolo-virtual._components.form_create_edit', [
            'user_id' => $user_id,
            'tipo_licencas' => $tipo_licencas,
            'status_protocolos' => $status_protocolos
        ])

        @endcomponent
        {{-- <form action="{{ route('protocolo-virtual.store') }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user_id }}">
            <input type="hidden" name="status_confirmacao_id" value="0">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="licenca" class="label-form-custom" for="tipo_licenca_id">Tipo Licença</label>
                    <div class="input-container">
                        <select id="tipo_licenca_id" name="tipo_licenca_id" class="form-select @error('tipo_licenca_id') is-invalid @enderror">
                            <option value="">Selecione o tipo de licença</option>
                            @foreach($tipo_licencas as $key => $tipo_licenca)
                            <option value="{{$tipo_licenca->id}}" {{ $tipo_licenca->id == old('tipo_licenca_id') ? 'selected' : ''}}>
                                {{ $tipo_licenca->descricao }}</option>
                            @endforeach

                        </select>
                        @error('tipo_licenca_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="position-yORn">
                <div class="posiiton-check">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="licenca" id="pj" value="pj" {{ (old('licenca') == 'pj') ? 'checked' : ''}}>
                        <label class="custom-check-label" for="pj">Licença PJ</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="licenca" id="pf"  value="pf" {{ (old('licenca') == 'pf') ? 'checked' : ''}}>
                        <label class="custom-check-label" for="pf">Licença PF</label>
                        @if($errors->has('licenca'))
                        <span role="alert">
                            <strong class="text-danger">{{ $errors->first('licenca')}}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="position-yORn requerent" style="display: none">
                <label for="proprietario" class="label-form-custom">Você é o responsável/proprietário dessa licença?</label>
                <div class="posiiton-check">
                    <div class="form-check">
                        <input class="form-check-input requerente" type="radio" {{ (old('requerente') == '1') ? 'checked' : ''}} name="requerente" value="1">
                        <label class="custom-check-label" for="">Sim</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input requerente" type="radio" {{ (old('requerente') == '0') ? 'checked' : ''}} name="requerente" value="0">
                        <label class="custom-check-label" for="">Não</label>
                    </div>
                    @if($errors->has('requerente'))
                    <span role="alert">
                        <strong class="text-danger">{{ $errors->first('requerente')}}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-row proprietario" style="display: none">
                <div class="form-group col-md-12">
                    <label for="empreendedor" class="label-form-custom">Nome do Empreendimento/Proprietário</label>
                    <div class="input-container">
                        <input type="text" name="empreendimento" id="empreendimento" value="{{ old('empreendimento') }}" class="form-control @error('empreendimento') is-invalid @enderror" placeholder="Digite aqui o nome do Emprendimento ou proprietário.">
                        @error('empreendimento')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-row pj" style="display: none">
                <div class="form-group col-md-12">
                    <label for="cnpj" class="label-form-custom">CNPJ</label>
                    <div class="input-container">
                        <input type="text" name="cnpj" id="cnpj" value="{{ old('cnpj') }}" class="form-control @error('cnpj') is-invalid @enderror" placeholder="Digite o CNPJ.">
                        @error('cnpj')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-row pj" style="display: none">
                <div class="form-group col-md-12">
                    <label for="razao_social" class="label-form-custom">Razão Social</label>
                        <div class="input-container">
                        <input type="text" id="razao_social" name="razao_social" value="{{ old('razao_social') }}" class="form-control @error('razao_social') is-invalid @enderror" placeholder="Digite a razão social.">
                        @error('razao_social')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-row proprietario pf" style="display: none">
                <div class="form-group col-md-12">
                    <label for="cpf" class="label-form-custom">CPF</label>
                    <div class="input-container">
                        <input type="text" name="cpf" id="cpf" value="{{ old('cpf') }}" class="form-control @error('cpf') is-invalid @enderror" id="cpf" placeholder="Digite seu CPF.">
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
                    <label for="mail" class="label-form-custom">Email</label>
                    <div class="input-container">
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Digite seu e-mail.">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="tel" class="label-form-custom">Telefone</label>
                    <div class="input-container">
                        <input type="text" name="telefone" id="telefone" value="{{ old('telefone') }}" class="form-control @error('telefone') is-invalid @enderror" placeholder="Digite telefone para contato.">
                        @error('telefone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="cep" class="label-form-custom">CEP</label>
                    <div class="input-container">
                        <input type="text" name="cep" id="cep" value="{{ old('cep') }}" class="form-control @error('cep') is-invalid @enderror" placeholder="Digite seu CEP.">
                        @error('cep')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group col-md-8">
                    <label for="endereco" class="label-form-custom">Endereço</label>
                    <div class="input-container">
                        <input type="text" name="endereco" id="endereco" value="{{ old('endereco') }}" class="form-control @error('endereco') is-invalid @enderror" placeholder="Endereço.">
                        @error('endereco')
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
            'SE' => 'Serigipe',
            'TO' => 'Tocantins'
            ];
            @endphp
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="estado" class="label-form-custom">Estado</label>
                    <div class="input-container">
                            <select id='uf' name="uf" class="select-form form-select @error('uf') is-invalid @enderror">
                                <option value="">Selecione o estado</option>
                                @foreach($estados as $key => $value)
                                <option value="{{$key}}" {{ $key == old('uf') ? 'selected' : ''}}>{{ $value }}</option>
                                @endforeach
                            </select>
                            @error('uf')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="municipio" class="label-form-custom">Município</label>
                    <div class="input-container">
                        <input type="text" name="municipio" id="cidade" value="{{ old('municipio') }}" class="form-control @error('municipio') is-invalid @enderror" placeholder="Digite a Cidade.">
                        @error('municipio')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="bairro" class="label-form-custom">Bairro</label>
                    <div class="input-container">
                        <input type="text" name="bairro" id="bairro" value="{{ old('bairro') }}"class="form-control @error('bairro') is-invalid @enderror" placeholder="Digite seu bairro.">
                        @error('bairro')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="numero" class="label-form-custom">Número</label>
                    <div class="input-container">
                        <input type="text" name="numero" value="{{ old('numero') }}" class="form-control @error('numero') is-invalid @enderror" placeholder="Digite o número.">
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
                    <label for="complemento" class="label-form-custom">Complemento</label>
                    <div class="input-container">
                        <input type="text" name="complemento" value="{{ old('complemento') }}" class="form-control @error('complemento') is-invalid @enderror" placeholder="Opcional.">
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
                    <button type="button" class="btn-confirm-login" data-bs-toggle="modal" data-bs-target="#exampleModal">Salvar</button>
                </div>
            </div>
        </form> --}}
    </div>

  <!-- Modal -->
    <div class="modal modal-confirm fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="positon-btn-close">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="position-contetn-modal">
                    <p class="content-modal">Confimar envio dos dados?</p>
                </div>
                <div class="position-bottons">
                    <button type="button" class="btn-back btn-confirm-login" data-bs-dismiss="modal">Não</button>
                    <button type="submit" id="btnYes" class="btn-confirm-login">Sim</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/esconde-campos-form-protocolo.js') }}"></script>


@endsection
