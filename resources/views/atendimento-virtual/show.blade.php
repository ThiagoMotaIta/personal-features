@extends('home')

{{-- Rota apenas para administradores --}}
@if(Auth::user()->tipo == 1)
<script>
    window.location.href = '{{route("protocolo-virtual.index")}}';
</script>
@endif

@section('content-app')
<h2>Atendimento Virtual</h2>
<div class="positon-btn-back">
    <a class="btn_include" href="{{route('atendimento-virtual.index')}}"><i class="icon-space fas fa-angle-left"></i>Voltar</a>
</div>
<table class="table table-custom position-forgot">
    <tr>
        <th scope="col">CPF</th>
        <td>{{ $atendimento_virtual->cpf }}</td>
    </tr>
    <tr>
        <th scope="col">Nome</th>
        <td>{{ $atendimento_virtual->nome }}</td>
    </tr>
    <tr>
        <th scope="col">Telefone</th>
        <td>{{ $atendimento_virtual->telefone }} </td>
    </tr>
    <tr>
        <th scope="col">E-mail</th>
        <td>{{ $atendimento_virtual->email }} </td>
    </tr>
    <tr>
        <th scope="col">Número Processo</th>
        <td>{{ $atendimento_virtual->numero_processo}} </td>
    </tr>
    <tr>
        <th scope="col">Assunto</th>
        <td>{{ $atendimento_virtual->assunto}} </td>
    </tr>
    <tr>
        <th scope="col">Setor</th>
        <td>{{ $atendimento_virtual->setor->nome}} </td>
    </tr>
    <tr>
        <th scope="col">Data do Atendimento</th>
        <td>{{ $atendimento_virtual->data_atendimento->format('d/m/Y à\s H:i') }} </td>
    </tr>
    <tr>
        <th scope="col">Mensagem</th>
        <td>{{ $atendimento_virtual->mensagem}} </td>
    </tr>
    <tr>
        <th scope="col">Status</th>
        <td>{{ $atendimento_virtual->status_atendimento->descricao}} </td>
    </tr>
    <tr>
        <th scope="col">Link</th>
        @if($atendimento_virtual->status_atendimento->id == 2)
        <td>{{ $atendimento_virtual->link}} </td>
        @else
        <td>Link não enviado</td>
        @endif
    </tr>
</table>

@endsection
