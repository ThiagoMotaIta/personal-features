@if(isset($protocoloVirtual->id))
<form id="form-protocolo" action="{{route('protocolo-virtual.update', ['protocolo_virtual' => Hashids::encode($protocoloVirtual->id) ])}}" method="post">
    @csrf
    @method('put')
    @else
    <form id="form-protocolo" action="{{ route('protocolo-virtual.store') }}" method="POST">
        @csrf
        @endif

        <input type="hidden" name="user_id" value="{{ isset($protocoloVirtual->user_id) ? Hashids::encode($protocoloVirtual->user_id) : Hashids::encode($user_id) }}">
        <input type="hidden" name="status_confirmacao_id" value="0">
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="tipo_licenca_id" class="label-form-custom">Tipo de Licença</label>
                <div class="input-container">
                    <select id="tipo_licenca_id" name="tipo_licenca_id" class="select-form form-select @error('tipo_licenca_id') is-invalid @enderror">
                        <option value="">Selecione o tipo de licença</option>
                        @foreach($tipo_licencas as $key => $tipo_licenca)
                        <option value="{{$tipo_licenca->id}}" {{ ( old('tipo_licenca_id') ?? ($protocoloVirtual->
                            tipo_licenca_id ??'') ) == $tipo_licenca->id ? 'selected' : ''}}>
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
                    <input class="form-check-input" type="radio" name="licenca" id="pj" value="pj" {{ ( ( old('licenca')
                        ?? ($protocoloVirtual->licenca ??'')) == 'pj') ? 'checked' : ''}}>
                    <label class="custom-check-label" for="">Licença Pessoa Jurídica</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="licenca" id="pf" value="pf" {{ ( ( old('licenca')
                        ?? ($protocoloVirtual->licenca ??'')) == 'pf') ? 'checked' : ''}}>
                    <label class="custom-check-label" for="">Licença Pessoa Física</label>
                    @if($errors->has('licenca'))
                    <span role="alert">
                        <strong class="text-danger">{{ $errors->first('licenca')}}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="position-yORn requerent" style="display: none">
            <label for="proprietario" class="label-form-custom">Você não é o responsável/proprietário dessa licença?</label>
            <div class="posiiton-check">
                <div class="form-check">
                    <input class="form-check-input requerente" type="radio" {{ ( ( old('requerente') ??
                        ($protocoloVirtual->requerente ??'') ) == '1') ? 'checked' : ''}} name="requerente" value="1">
                    <label class="custom-check-label" for="">Sim</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input requerente" type="radio" {{ ( ( old('requerente') ??
                        ($protocoloVirtual->requerente ??'') ) == '0') ? 'checked' : ''}} name="requerente" value="0">
                    <label class="custom-check-label" for="">Não</label>
                </div>
                @if($errors->has('requerente'))
                <span role="alert">
                    <strong class="text-danger">{{ $errors->first('requerente')}}</strong>
                </span>
                @endif
            </div>
        </div>
        {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif --}}
        <div class="form-row proprietario pf" style="display: none">
            <label for="proprietario" class="label-form-text">*Os dados a serem inseridos são do proprietário da licença</label>
        </div>
        <div class="form-row proprietario" style="display: none">
            <div class="form-group col-md-12">
                <label for="empreendedor" class="label-form-custom">Nome do Empreendimento/Proprietário</label>
                <div class="input-container">
                    <input type="text" name="empreendimento" id="empreendimento"
                        value="{{ old('empreendimento') ?? ($protocoloVirtual->empreendimento ??'')  }}"
                        class="form-control @error('empreendimento') is-invalid @enderror"
                        placeholder="Digite aqui o nome do Emprendimento ou proprietário.">
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
                    <input type="text" name="cnpj" id="cnpj"
                        value="{{ old('cnpj') ?? ($protocoloVirtual->cnpj ??'')  }}"
                        class="form-control @error('cnpj') is-invalid @enderror" placeholder="Digite o CNPJ.">
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
                    <input type="text" id="razao_social" name="razao_social"
                        value="{{ old('razao_social') ?? ($protocoloVirtual->razao_social ??'')  }}"
                        class="form-control @error('razao_social') is-invalid @enderror"
                        placeholder="Digite a razão social.">
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
                    <input type="text" name="cpf" id="cpf" value="{{ old('cpf') ?? ($protocoloVirtual->cpf ??'')  }}"
                        class="form-control @error('cpf') is-invalid @enderror" id="cpf" placeholder="Digite seu CPF.">
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
                    <input id="mail" type="email" name="email" value="{{ old('email') ?? ($protocoloVirtual->email ??'')  }}"
                        class="form-control @error('email') is-invalid @enderror" placeholder="Digite seu e-mail.">
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
                    <input type="text" name="telefone" id="tel" value="{{ Auth::user()->telefone }}" class="form-control telefone @error('telefone') is-invalid @enderror" placeholder="Digite telefone para contato.">
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
                    <input  type="text" name="cep" id="cep" value="{{ Auth::user()->cep }}"
                        class="form-control @error('cep') is-invalid @enderror" placeholder="Digite seu CEP.">
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
                    <input  type="text" name="endereco" id="endereco"
                        value="{{ Auth::user()->endereco }}"
                        class="form-control @error('endereco') is-invalid @enderror" placeholder="Digite seu Endereço.">
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
        'PB' => 'Paraí­ba',
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
            <div class="form-group col-md-6">
                <label for="uf" class="label-form-custom">Estado</label>
                <div class="input-container">
                    <select id='uf' name="uf" class="select-form form-select @error('uf') is-invalid @enderror">            
                        @if(Auth::user()->uf)
                        <option selected value="{{Auth::user()->uf}}">{{Auth::user()->uf}}</option>
                        @else
                        <option value="">Selecione o estado</option>
                        @foreach($estados as $key => $value)
                        <option value="{{$key}}" {{ (old('uf') ?? ($protocoloVirtual->uf ??'') ) == $key ? 'selected' :
                            ''}}>{{ $value }}</option>
                        @endforeach
                        @endif
                    </select>
                    @error('uf')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="cidade" class="label-form-custom">Cidade</label>
                <div class="input-container">
                    <input  type="text" name="municipio" id="cidade"
                        value="{{ Auth::user()->cidade }}"
                        class="form-control @error('municipio') is-invalid @enderror" placeholder="Digite a Cidade.">
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
                    <input  type="text" name="bairro" id="bairro"
                        value="{{ Auth::user()->bairro }}"
                        class="form-control @error('bairro') is-invalid @enderror" placeholder="Digite seu bairro.">
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
                    <input id="numero" type="number" name="numero" value="{{ Auth::user()->numero }}"
                        class="form-control @error('numero') is-invalid @enderror" placeholder="Digite o nº.">
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
                <label for="complemento" class="label-form-custom">Complemento(Campo Opcional)</label>
                <div class="input-container">
                    <input type="text" name="complemento"
                        id="complemento"
                        value="{{ Auth::user()->complemento }}"
                        class="form-control @error('complemento') is-invalid @enderror" placeholder="Opcional.">
                    @error('complemento')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        @if(Auth::user()->tipo != 1)
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="status_protocolo_id" class="label-form-custom">Status Protocolo</label>
                <div class="input-container">
                    <i class="icon-password fas fa-chevron-down fa-sm"></i>
                    <select name="status_protocolo_id" class="form-control @error('status_protocolo_id') is-invalid @enderror">
                        <option value="">Selecione o status</option>
                        @foreach($status_protocolos as $key => $status_protocolo)
                        <option value="{{$status_protocolo->id}}" {{ (old('status_protocolo_id') ?? ($protocoloVirtual->
                            status_protocolo_id??'')) == $status_protocolo->id ? 'selected' : ''}}>
                            {{ $status_protocolo->descricao }}
                        </option>
                        @endforeach
                    </select>
                    @error('status_protocolo_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        @endif
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="descricao" class="label-form-custom">Descrição</label>
                <div class="input-container">
                    <textarea name="descricao" id="descricao" rows="5" class="form-control @error('descricao') is-invalid @enderror" placeholder="Digite uma descrição sobre o protocolo">{{ old('descricao') ?? ($protocoloVirtual->descricao ??'')  }}</textarea>
                    @error('descricao')
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
    </form>
