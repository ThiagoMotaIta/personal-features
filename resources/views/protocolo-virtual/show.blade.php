@extends('home')

@section('content-app')
<h2>Protocolo</h2>
<div class="positon-btn-back">
    <a class="btn_include" href="{{ route('protocolo-virtual.index')}}"><i class="icon-space fas fa-angle-left"></i>Voltar</a>
</div>
<table class="table table-custom position-forgot">
    <tr>
        <th scope="col">Usuário</th>
        <td>{{ $protocolo_virtual->user->name}}</td>
    </tr>
    <tr>
        <th scope="col">Licença</th>
        <td>{{ $protocolo_virtual->licenca == 'pj' ? 'PJ' : 'PF' }}</td>
    </tr>
    <tr>
        <th scope="col">Tipo de Licença</th>
        <td>{{ $protocolo_virtual->tipoLicenca->descricao }} </td>
    </tr>
    <tr>
        <th scope="col">Nome do Empreendimento/Proprietário</th>
        @if($protocolo_virtual->requerente == 0)
        <td>{{ $protocolo_virtual->empreendimento}} </td>
        @else
        <td>{{ $protocolo_virtual->user->name}} </td>
        @endif
    </tr>
    @if($protocolo_virtual->licenca == 'pj')
    <tr>
        <th scope="col">CNPJ</th>
        <td>{{ Helper::mask($protocolo_virtual->cnpj, '##.###.###/####-##') }} </td>
    </tr>
    <tr>
        <th scope="col">Razão Social</th>
        <td>{{ $protocolo_virtual->razao_social}} </td>
    </tr>
    @else
    <tr>
        <th scope="col">CPF</th>
        @if($protocolo_virtual->requerente == 0)
        <td>{{ Helper::mask($protocolo_virtual->cpf, '###.###.###-##')}} </td>
        @else
        <td>{{ Helper::mask($protocolo_virtual->user->cpf, '###.###.###-##')}} </td>
        @endif
    </tr>
    @endif
    <tr>
        <th scope="col">E-mail</th>
        <td>{{ $protocolo_virtual->email}} </td>
    </tr>
    <tr>
        <th scope="col">Telefone</th>
        <td>{{ $protocolo_virtual->telefone}} </td>
    </tr>
    <tr>
        <th scope="col">CEP</th>
        <td>{{ $protocolo_virtual->cep}} </td>
    </tr>
    <tr>
        <th scope="col">Endereço</th>
        <td>{{ $protocolo_virtual->endereco}} </td>
    </tr>
    <tr>
        <th scope="col">Estado</th>
        <td>{{ $protocolo_virtual->uf}} </td>
    </tr>
    <tr>
        <th scope="col">Cidade</th>
        <td>{{ $protocolo_virtual->municipio}} </td>
    </tr>
    <tr>
        <th scope="col">Bairro</th>
        <td>{{ $protocolo_virtual->bairro}} </td>
    </tr>
    <tr>
        <th scope="col">Número</th>
        <td>{{ $protocolo_virtual->numero}} </td>
    </tr>
    <tr>
        <th scope="col">Complemento</th>
        <td>{{ $protocolo_virtual->complemento}} </td>
    </tr>
    <tr>
        <th scope="col">Status Protocolo</th>
        <td>{{ statusProtocoloComContagemCronologiaPorStatus($protocolo_virtual) }}</td>
    </tr>
    <tr>
        <th scope="col">Status Documentação</th>
        <td>{{ $protocolo_virtual->status->descricao }}</td>
    </tr>
    @if($protocolo_virtual->licenca == 'pf')
        <tr>
            <th scope="col">Responsável/proprietário</th>
            <td>{{ $protocolo_virtual->requerente == 1 ? "Sim" : "Não"}} </td>
        </tr>
        @if($protocolo_virtual->requerente == 0)
            <tr>
                <th scope="col">Status de Confirmação Proprietário</th>
                <td>{{ $protocolo_virtual->statusConfirmacao->descricao}} </td>
            </tr> 
        @endif
        
    @endif
    
    <tr>
        <th scope="col">Descrição</th>
        <td>{{ $protocolo_virtual->descricao}} </td>
    </tr>
</table>

@php
    use Carbon\Carbon;

    /*Formata a mensagem de status de protocolo, adicinando o tempo
    * em que o protocolo se encontra no status atual
    */
    function statusProtocoloComContagemCronologiaPorStatus($protocolo) {

        $statusProtocolo = $protocolo->statusProtocolo->descricao;
        
        $dt = Carbon::create($protocolo->status_protocolo_updated_at);
        $future = Carbon::now();
        $diffYears = $dt->DiffInYears($future);
        $diffMonths = $dt->DiffInMonths($future);
        $diffDays = $dt->DiffInDays($future);
        $diffHours = $dt->DiffInHours($future);
        $diffMinutes = $dt->DiffInMinutes($future);
        $diffSeconds = $dt->DiffInSeconds($future);
        $mensP2 = " há ";

        if($diffYears != 0) {
            $mensTempo = $diffYears > 1 ? " anos" : " ano";   
            $mensP2 = $mensP2.$diffYears.$mensTempo; 
        }else if($diffMonths != 0) {
            $mensTempo = $diffMonths > 1 ? " meses" : " mes";
            $mensP2 = $mensP2.$diffMonths.$mensTempo; 
        }else if($diffDays != 0) {
            $mensTempo = $diffDays > 1 ? " dias" : " dia";
            $mensP2 = $mensP2.$diffDays.$mensTempo; 
        }else if($diffHours != 0) {
            $mensTempo = $diffHours > 1 ? " horas" : " hora";
            $mensP2 = $mensP2.$diffHours.$mensTempo; 
        }else if($diffMinutes != 0) {
            $mensTempo = $diffMinutes > 1 ? " minutos" : " minuto";
            $mensP2 = $mensP2.$diffMinutes.$mensTempo; 
        }else {
            $mensTempo = $diffSeconds > 1 ? " segundos" : " segundo";
            $mensP2 = $mensP2.$diffSeconds.$mensTempo; 
        }

        return $statusProtocolo.$mensP2;
    }
@endphp

@endsection