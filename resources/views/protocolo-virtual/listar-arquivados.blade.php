@extends('home')

{{-- Rota apenas para administradores --}}
@if(Auth::user()->tipo == 1)
<script>
    window.location.href = '{{route("protocolo-virtual.index")}}';
</script>
@endif

@section('content-app')

<div class="positon_name_include">
    <p class="name_table">Protocolos Arquivados</p>
</div>

<form action="{{route('protocolo-virtual.arquivados')}}" method="GET">
    <div class="row">
        <div class="col-md-4">
            <label class="label-form-custom">Tipo de Licença</label>
            <input type="text" name="licenca" class="form-control">
        </div>
        <div class="col-md-4">
            <label class="label-form-custom">CPF Usuário</label>
            <input id="cpf" type="text" name="cpf" class="form-control">
        </div>
        <div class="navbar position-btn-confirm">
            <button type="submit" class="btn_include btn-search">Pesquisar</button>
            <a class="btn_include btn-search" href="{{route('protocolo-virtual.index')}}">Voltar</a>
        </div>
    </div>
</form>

<table class="table table-custom">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Usuário</th>
            <th scope="col">Licença</th>
            <th scope="col">Tipo de Licença</th>
            <th scope="col">Status</th>
            {{-- <th scope="col" colspan="1" class="text-center">Ações</th> --}}
            <th scope="col" colspan="1">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($protocolo_virtuais as $protocolo)
        <tr>
            <td>{{ $protocolo->user->name }}</td>
            <td>{{ $protocolo->licenca }}</td>
            <td>{{ $protocolo->tipoLicenca->descricao }}</td>
            <td>{{ $protocolo->status->descricao }}</td>
            {{-- <td><a
                    href="{{ route('protocolo-virtual.show', ['protocolo_virtual' => $protocolo->id]) }}">Visualizar</a>
            </td>
            <td>
                <form id="form_{{$protocolo->id}}"
                    action="{{ route('protocolo-virtual.destroy', ['protocolo_virtual' => $protocolo->id, 'del' => 1]) }}"
                    method="POST">
                    @csrf
                    @method('delete')
                </form>

                <a href="#" onclick="document.getElementById('form_{{$protocolo->id}}').submit()">Excluir</a>
            </td> --}}
            <td>
                <div class="positon-icons-table">
                    <a class="btn_include document-btn" href="{{ route('protocolo-virtual.restore', ['protocolo_virtual' => $protocolo->id]) }}">Desarquivar</a>
                </div>
            </td>
        </tr>
        @endforeach
        </tr>
    </tbody>
</table>

@if(Session::has('record_added')) 
    <script>
        toastr.success("{!!Session::get('record_added')!!}", 'Sucesso!');
    </script>
@endif

{{-- {{ $protocolo_virtuais->appends($request)->links()}}

Exibindo {{ $protocolo_virtuais->count()}} protocolo de {{ $protocolo_virtuais->total()}}
de ( {{ $protocolo_virtuais->firstItem()}} a {{ $protocolo_virtuais->lastItem()}}) --}}

<div class="page-crud">
    <a href="{{$protocolo_virtuais->previousPageUrl()}}"><span class="page-text">Voltar</span></a>
    @for ($i = 1; $i <= $protocolo_virtuais->lastPage(); $i++)
    <a class="{{$protocolo_virtuais->currentPage() == $i ? 'active' : ''}}" href="{{$protocolo_virtuais->url($i)}}">{{$i}}</a>
    @endfor
    <a href="{{$protocolo_virtuais->nextPageUrl()}}"><span class="page-text">Avançar</span></a>
</div>

@endsection