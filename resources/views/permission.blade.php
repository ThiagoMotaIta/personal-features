@extends('home')

@section('content-app')
   
    <div class="">
            @php
                //dd($user->name);
            @endphp
            @if ($editing)
                <div class="positon-btn-back">
                    <a class="btn_include" href="{{ route('getDadosUser')}}"><i class="icon-space fas fa-angle-left"></i>Voltar</a>
                </div>
                <div class="card card-custom">
                    <div class="position-title-card">
                        @if ($editing && !$profileData->id)
                            <p class="title-card">Incluir Perfil</p>
                        @else
                            <p class="title-card">Editar Perfil</p>
                        @endif
                    </div>
                    <form id="form-permission" method="POST" action="{{ route('postPermission', ['id' => $profileData->id]) }}">
                    @csrf
                        <div class="positon-label-before-module position-yORn">
                            <label class="label-form-custom">Perfil</label>
                            <input class="form-control" type="text" id="{{$profileData->name}}" name="name" value="{{$profileData->name}}" placeholder="Digite o nome do perfil" required>
                        </div>
                        <div class="positon-label-before-module position-yORn">
                            <label class="label-form-text">Digite as permissões para cada módulo abaixo</label>
                        </div>
                        @foreach ($permissoes as $permission)
                        <div class="position-yORn">
                            <div class="positon-title-card position-contetn-modal">
                                <label class="name-module">Módulo: <strong><i>{{ $permission->title }}</i></strong></label>
                            </div>
                            <div class="position-card-body">
                                <div class="form-check form-switch">
                                    <input type="hidden" name="{{@$permission->tag}}-create" value="0"> 
                                    <input type="checkbox" class="form-check-input" id="{{@$permission->create}}" name="{{$permission->tag}}-create" value="1" {{ (@$permission->create || old('create',0) === 1) ? 'checked' : 'unchecked' }}>
                                    <label class="custom-check-label">Inserir</label>
                                </div>
                                <div class="form-check form-switch">                                    
                                    <input type="hidden" name="{{$permission->tag}}-list" value="0"> 
                                    @if($editing && !$profileData->id)
                                    <input type="checkbox" class="form-check-input" id="{{@$permission->list}}" name="{{$permission->tag}}-list" value="1" checked {{ ($permission->list || old('list',0) === 1) ? 'checked' : 'unchecked' }}>
                                    @else 
                                    <input type="checkbox" class="form-check-input" id="{{@$permission->list}}" name="{{$permission->tag}}-list" value="1" {{ ($permission->list || old('list',0) === 1) ? 'checked' : 'unchecked' }}>
                                    @endif
                                    <label class="custom-check-label">Visualizar</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input type="hidden" name="{{$permission->tag}}-edit" value="0"> 
                                    <input type="checkbox" class="form-check-input" id="{{@$permission->edit}}" name="{{$permission->tag}}-edit" value="1" {{ (@$permission->edit || old('edit',0) === 1) ? 'checked' : 'unchecked' }}>
                                    <label class="custom-check-label">Editar</label>
                                </div>  
                                <div class="form-check form-switch">
                                    <input type="hidden" name="{{$permission->tag}}-remove" value="0"> 
                                    <input type="checkbox" class="form-check-input" id="{{@$permission->remove}}" name="{{$permission->tag}}-remove" value="1" {{ (@$permission->remove || old('remove',0) === 1) ? 'checked' : 'unchecked' }}>
                                    <label class="custom-check-label">Remover</label>
                                </div>
                            </div>
                        @endforeach
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <div class="positon-card-edit-profile">
                                    <button type="submit" class="btn-confirm-login">Salvar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            @else
                <div class="positon_name_include">
                    <p class="name_table">Permissões de Perfil</p>
                </div>

                @can('permissoes-create')
                    <div class="position-btn-include">
                        <a class="btn_include btn-more-space" href="{{ route('getDadosUser')}}?editing=true"><i class="icon-space fas fa-plus-circle"></i>Incluir Perfil</a>
                    </div>
                @endcan

                <table class="table table-custom">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Perfil</th>
                            <th scope="col">Módulos</th>
                            <th scope="col">Permissões</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($profileData as $profile)
                        <tr>
                            <td>{{ $profile->name }}</td>   
                            <td class="permission-tag-breaker"> 
                                @foreach ($permissoes as $permission)
                                    <span class="tag-spacing">{{ $permission->title }}</span> 
                                @endforeach
                            </td>
                            <td>@foreach ($profile->permission as $permissionTable)
                                <p> 
                                    @if(@$permissionTable->create == 1)
                                    <span class="space-p">
                                        <i class="fas fa-check-circle text-success"></i> Inserir
                                    </span>
                                    @else
                                    <span class="space-p">
                                        <i class="fas fa-times-circle text-danger"></i> Inserir
                                    </span>
                                    @endif
                                    @if($permissionTable->list == 1)
                                    <span class="space-p">
                                        <i class="fas fa-check-circle text-success"></i> Visualizar
                                    </span>
                                    @else
                                    <span class="space-p">
                                        <i class="fas fa-times-circle text-danger"></i> Visualizar
                                    </span>
                                    @endif
                                    @if(@$permissionTable->edit == 1)
                                    <span class="space-p">
                                        <i class="fas fa-check-circle text-success"></i> Editar
                                    </span>
                                    @else
                                    <span class="space-p">
                                        <i class="fas fa-times-circle text-danger"></i> Editar
                                    </span>
                                    @endif
                                    @if(@$permissionTable->remove == 1)
                                    <span class="space-p">
                                        <i class="fas fa-check-circle text-success">
                                        </i> Remover
                                    </span>
                                    @else
                                    <span class="space-p">
                                        <i class="fas fa-times-circle text-danger">
                                        </i> Remover
                                    </span>
                                    @endif
                                </p>
                                @endforeach 
                            </td>
                            <td>
                                <div class="positon-icons-table">
                                    @can('permissoes-edit')
                                        <a class="tresh-btn edit-btn" href="{{ route('getDadosUser',$profile->id) }}" title="Editar Permissões"><span class="tooltiptext">Editar permissões</span><i class="fas fa-edit"></i></a>
                                    @endcan
                                    @can('permissoes-remove')
                                        <a class="tresh-btn" data-bs-toggle="modal" href="#ModalDelete{{$profile->id}}" title="Excluir"><span class="tooltiptext">Excluir Perfil</span><i class="fas fa-trash"></i></a> 
                                    @endcan
                                
                                </div>
                            </td>
                        </tr>
                        @include('user.modal.delete-profile')
                    @endforeach
                        <tr>
                            <td class="tfoot-align" colspan="8">
                                <span class="icon-space descripttio_title_custom">Legenda:</span>
                                <span class="icon-space"><i class="icon-space fas fa-check-circle text-success"></i>Possui permissão</span>
                                <span class="icon-space"><i class="icon-space fas fa-times-circle text-danger"></i>Não possui permissão</span>
                                <span class="icon-space"><i class="icon-space tfoot-edit fas fa-edit"></i>Editar permissão</span>
                                <span class="icon-space"><i class="icon-space tfoot-btn fas fa-trash"></i>Excluir </span>
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

@endsection


