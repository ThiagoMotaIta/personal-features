@extends('home')

{{-- Rota apenas para administradores --}}
@if(Auth::user()->tipo == 1)
    <script>
        window.location.href = '{{route("protocolo-virtual.index")}}';
    </script>
@endif

@section('content-app')

<div class="positon_name_include">
    <p class="name_table">Horário Atendimento Virtual</p>
</div>

@can('horario-create')
    <div class="position-btn-include">
        <a class="btn_include btn-more-space" href="{{ route('horario.create')}}"><i class="icon-space fas fa-plus-circle"></i>Incluir Data e Hora</a>
    </div>
@endcan

<form action="{{route('horario.index')}}" method="GET">
    <div class="position_content_search">
        <div class="position_content_inputs">
            <div class="position-inside-input">
                <label class="label-form-custom" for="setor">Setor</label>
                <select name="setor" id="setor" class="form-control form-select">
                    <option value="">Selecione</option>
                    @foreach ($setores as $setor)
                    <option value="{{ $setor->id }}">{{ $setor->nome }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="position_content_inputs">
            <div class="position-inside-input">
                <label class="label-form-custom" for="data">Data:</label>
                <input type="text" name="data" id="data" class="form-control date" placeholder="dd-mm-aaaa" readonly>
            </div>
        </div>

        <div class="position-inside-input">
            <button class="tresh-btn edit-btn btn-bigSize" type="submit" title="Pesquisar Horário">
                <i class="fas fa-search"></i>
                <span class="tooltiptext">Botão de Pesquisar Horário</span> 
            </button>      
        </div>
    </div>
</form>

<div class="navbar position-btn-confirm">
    <a class="btn_include btn-more-space" href="{{route('horario.index')}}">Limpar Consulta</a>
</div>

@if($horarios->isNotEmpty())
    
<table class="table table-custom">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Usuário</th>
            <th scope="col">Setor</th>
            <th scope="col">Data</th>
            <th scope="col">Horário</th>
            <th scope="col">Disponível</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($horarios as $horario)      
        <tr>
            <td>{{$horario->user->name}}</td>
            <td>{{$horario->setor->nome}}</td>
            <td>{{$horario->data->format('d/m/Y')}}</td>
            @foreach(explode(' ', $horario->horario) as $hora) 
                <td>{{$hora[0]}}{{$hora[1]}}:{{$hora[3]}}{{$hora[4]}}</td>
            @endforeach
            <td>{{($horario->disponivel ? 'Sim' : 'Não')}}</td>
            <td>
                <div class="positon-icons-table">
                    @can('horario-edit') 
                        <a class="tresh-btn edit-btn" href="{{ route('horario.edit', ['id' => Hashids::encode($horario->id) ]) }}" title="Editar"><span class="tooltiptext">Editar horário de atendimento</span><i class="fas fa-edit"></i></a>
                    @endcan 
                    @can('horario-remove') 
                        <a class="tresh-btn" data-bs-toggle="modal" href="#ModalDelete{{$horario->id}}" title="Excluir"><span class="tooltiptext">Excluir atendimento marcado</span><i class="fas fa-trash"></i></a> 
                    @endcan 
                </div>
            </td>
            
        </tr>

        <!-- Modal -->
        @include('horario.modal.delete')
        
        @endforeach
        <tr>
            <td class="tfoot-align" colspan="8">
                <span class="icon-space descripttio_title_custom">Legenda:</span>
                <span class="icon-space"><i class="icon-space tfoot-edit fas fas fa-edit"></i>Editar Horários</span>
                <span class="icon-space"><i class="icon-space tfoot-btn fas fa-trash"></i>Excluir Horários</span>
            </td>
        </tr>
    </tbody>
</table>

<div class="d-flex">
    {{ $horarios->appends($request)->links() }}
</div>
<script>
     $(document).ready(function () {
            //Busca setores
            var dates = [];
            $("#data").datepicker({
                dateFormat: "dd-mm-yy",
                changeMonth: true,
                changeYear: true,
                yearRange: "2021:2041",
                beforeShowDay: function (date) {
                    if ($.inArray($.datepicker.formatDate('yy-mm-dd', date), dates) > -1) {
                        return [false, '', "Not Available"];
                    } else {
                        return [true, "", "Available"];
                    }
                }

            });
            (function (factory) {
                "use strict";

                if (typeof define === "function" && define.amd) {

                    // AMD. Register as an anonymous module.
                    define(["../widgets/datepicker"], factory);
                } else {

                    // Browser globals
                    factory(jQuery.datepicker);
                }
            })(function (datepicker) {
                "use strict";

                datepicker.regional["pt-BR"] = {
                    closeText: "Fechar",
                    prevText: "&#x3C;Anterior",
                    nextText: "Próximo&#x3E;",
                    currentText: "Hoje",
                    monthNames: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
                        "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
                    monthNamesShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun",
                        "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
                    dayNames: [
                        "Domingo",
                        "Segunda-feira",
                        "Terça-feira",
                        "Quarta-feira",
                        "Quinta-feira",
                        "Sexta-feira",
                        "Sábado"
                    ],
                    dayNamesShort: ["Do", "Seg", "Ter", "Qua", "Qui", "Sex", "Sá"],
                    dayNamesMin: ["Do", "Seg", "Ter", "Qua", "Qui", "Sex", "Sá"],
                    weekHeader: "Sm",
                    dateFormat: "dd/mm/yyyy",
                    firstDay: 0,
                    isRTL: false,
                    showMonthAfterYear: false,
                    yearSuffix: ""
                };
                datepicker.setDefaults(datepicker.regional["pt-BR"]);

                return datepicker.regional["pt-BR"];

            });

        });
</script>

{{-- <nav aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item"><a class="page-link" href="{{$horarios->previousPageUrl()}}">Voltar</a></li>
        @for ($i = 1; $i <= $horarios->lastPage(); $i++)
        <li class="page-item  {{$horarios->currentPage() == $i ? 'active' : ''}}">
            <a class="page-link" href="{{$horarios->url($i)}}">{{$i}}</a>
        </li>
        @endfor
        <li class="page-item"><a class="page-link" href="{{$horarios->nextPageUrl()}}">Avançar</a></li>
    </ul>
</nav> --}}

@else
<table class="table table-custom">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th class="position-title-card" colspan="12">Nenhum registro de horarios de atendimento virtuais encontrado!</th>
        </tr>
    </tbody>
</table>

@endif

@if(Session::has('record_added')) 
    <script>
        toastr.success("{!!Session::get('record_added')!!}", 'Sucesso!');
    </script>
@endif

@endsection





