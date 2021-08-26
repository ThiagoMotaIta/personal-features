@extends('home')

{{-- Rota apenas para administradores --}}
@if(Auth::user()->tipo == 1)
    <script>
        window.location.href = '{{route("protocolo-virtual.index")}}';
    </script>
@endif

@section('content-app')

<div class="positon_name_include">
    <p class="name_table">Atendimentos Virtuais</p>
</div>

<form action="{{route('atendimento-virtual.index')}}" method="GET">
    <div class="position_content_search">
        <div class="position_content_inputs">
            <div class="position-inside-input">
                <label for="sec_atend" class="label-form-custom">Setor</label>
                <select id="sec_atend" name="setor" class="form-control form-select">
                    <option value="">Selecione</option>
                    @foreach ($setores as $setor)
                    <option value="{{ $setor->id }}">{{ $setor->nome }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="position_content_inputs">
            <div class="position-inside-input">
                <label for="date_atend" class="label-form-custom">Data</label>
                <input id="date_atend" type="text" name="data" class="form-control date" placeholder="Selecione a data" readonly>
            </div>
        </div>

        <div class="position-inside-input">
            <button class="tresh-btn edit-btn btn-bigSize" type="submit" title="Persquisar Atendimento"><span class="tooltiptext">Pesquisar por atendimento</span><i class="fas fa-search"></i></button>
        </div>
    </div>
</form>

<div class="navbar position-btn-confirm">
    <a class="btn_include btn-more-space" href="{{route('atendimento-virtual.index')}}">Limpar Consulta</a>
</div>

@if($atendimento_virtuais->isNotEmpty())

<table class="table table-custom">
    <thead class="thead-dark">
        <tr>
          <th scope="col">CPF</th>
          <th scope="col">Nome</th>
          <th scope="col">Assunto</th>
          <th scope="col">Setor</th>
          <th scope="col">Data do Atendimento</th>
          <th scope="col">Status</th>
          <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($atendimento_virtuais as $atendimento)
        <tr>
          <td>{{ $atendimento->cpf }}</td>
          <td>{{ $atendimento->nome }}</td>
          <td>{{ $atendimento->assunto }}</td>
          <td>{{ $atendimento->setor->nome }}</td>
          <td>{{ $atendimento->data_atendimento->format('d/m/Y à\s H:i') }}</td>
          <td>{{ $atendimento->status_atendimento->descricao }}</td>
          <td>
            <div class="positon-icons-table">
                <a class="tresh-btn view-btn" href="{{ route('atendimento-virtual.show', ['atendimento_virtual' => $atendimento->id]) }}" title="Visualizar"><span class="tooltiptext">Visualizar detalhes do atendimento</span><i class="fas fa-book-reader"></i></a>
                @can('atendimento-create')
                <a class="tresh-btn edit-btn" data-bs-toggle="modal" href="#ModalSendMail{{$atendimento->id}}" title="Enviar kink"><span class="tooltiptext">Enviar link para reunião de atendimento</span><i class="fas fa-link"></i></a>
                @endcan
            </div>
          </td>
        </tr>

        <!-- Modal -->
        @include('atendimento-virtual.modal.send-email')

        @endforeach
        <tr>
            <td class="tfoot-align" colspan="8">
                <span class="icon-space descripttio_title_custom">Legenda:</span>
                <span class="icon-space"><i class="icon-space tfoot-view fas fa-book-reader"></i>Visualizar</span>
                @can('atendimento-create')
                <span class="icon-space"><i class="icon-space tfoot-edit fas fa-link"></i>Enviar link</span>
                @endcan
            </td>
        </tr>
    </tbody>
</table>

@else
<table class="table table-custom">
    <thead class="thead-dark">
        <tr>
            <th scope="col">CPF</th>
            <th scope="col">Nome</th>
            <th scope="col">Assunto</th>
            <th scope="col">Setor</th>
            <th scope="col">Data do Atendimento</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th class="position-title-card" colspan="12">Nenhum registro de atendimento encontrado!</th>
        </tr>
    </tbody>
</table>
@endif

{{-- Abre Modal para enviar link caso ocorra error na validação --}}
@if(Session::has('send-link'))
    <script>
        var id = {{session('send-link')}};
        $(function () {
            $('#ModalSendMail' + id).modal('show');
        });
    </script>
@endif

@if(Session::has('record_added'))
    <script>
        toastr.success("{!!Session::get('record_added')!!}", 'Sucesso!');
    </script>
@endif

{{-- <nav aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item"><a class="page-link" href="{{$atendimento_virtuais->previousPageUrl()}}">Voltar</a></li>
        @for ($i = 1; $i <= $atendimento_virtuais->lastPage(); $i++)
        <li class="page-item  {{$atendimento_virtuais->currentPage() == $i ? 'active' : ''}}">
            <a class="page-link" href="{{$atendimento_virtuais->url($i)}}">{{$i}}</a>
        </li>
        @endfor
        <li class="page-item"><a class="page-link" href="{{$atendimento_virtuais->nextPageUrl()}}">Avançar</a></li>
    </ul>
</nav> --}}

<div class="d-flex">
    {{ $atendimento_virtuais->appends($request)->links() }}
</div>
<script>
    $(document).ready(function () {
            //Busca setores
            var dates = [];
            $("#date_atend").datepicker({
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
@endsection


