@extends('home')

@section('content-app')

<div class="position-btn-include">
    <a class="btn_include btn-more-space" href="{{ route('protocolo-virtual.create')}}"><i class="icon-space fa fa-plus-circle"></i>Abrir Novo Protocolo</a>
</div>

@if($protocolo_virtuais->isNotEmpty())

<h2>Lista de Protocolos</h2>

<table class="table table-custom">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Usuário</th>
            <th scope="col">Licença</th>
            <th scope="col">Tipo de Licença</th>
            <th scope="col">Status</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($protocolo_virtuais as $protocolo)
        <tr>
            <td>{{ $protocolo->user->name }}</td>
            <td>{{ $protocolo->licenca }}</td>
            <td>{{ $protocolo->tipoLicenca->descricao }}</td>
            <td>{{ $protocolo->status->descricao }}</td>
            <td>
                <div class="positon-icons-table">
                    <a class="tresh-btn edit-btn" href="{{ route('protocolo-virtual.edit',$protocolo->id) }}"><i class="fas fa-user-edit"></i></a>
                    <form action="{{route('protocolo-virtual.destroy',$protocolo->id)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="tresh-btn" type="submit"><i class="fas fa-trash"></i></button>
                    </form>
                    <button class="tresh-btn edit-btn" type="submit"><i class="fas fa-upload"></i></button>
                    <button class="tresh-btn" type="submit"><i class="far fa-file-pdf"></i></button>
                </div>
            </td>
        </tr>
        @endforeach
        </tr>
    </tbody>
</table>

{{-- {{ $protocolo_virtuais->appends($request)->links()}}

Exibindo {{ $protocolo_virtuais->count()}} protocolo de {{ $protocolo_virtuais->total()}}
de ( {{ $protocolo_virtuais->firstItem()}} a {{ $protocolo_virtuais->lastItem()}}) --}}

<nav aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item"><a class="page-link" href="{{$protocolo_virtuais->previousPageUrl()}}">Voltar</a></li>

        @for ($i = 1; $i <= $protocolo_virtuais->lastPage(); $i++)
            <li class="page-item  {{$protocolo_virtuais->currentPage() == $i ? 'active' : ''}}">
                <a class="page-link" href="{{$protocolo_virtuais->url($i)}}">{{$i}}</a>
            </li>
            @endfor


            <li class="page-item"><a class="page-link" href="{{$protocolo_virtuais->nextPageUrl()}}">Avançar</a></li>
    </ul>
</nav>

@else
 <h1>Nenhum Protocolo Cadastrado!</h1>
@endif
@endsection
