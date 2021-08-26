@if(isset($horario->id))
<form id="form-horario" action="{{route('horario.update', ['id' => Hashids::encode($horario->id) ])}}" method="post">
    @csrf
    @method('put')
    @else
    <form id="form-horario" action="{{ route('horario.store') }}" method="POST">
        @csrf
        @endif

        <input type="hidden" name="user_id"
            value="{{ isset($horario->user_id) ? Hashids::encode($horario->user_id) : Hashids::encode($user_id) }}">

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="licenca" class="label-form-custom">Setor:</label>
                <div class="input-container">
                    <select id="licenca" name="setor_id"
                        class="select-form form-select @error('setor_id') is-invalid @enderror">
                        <option value="">Selecione o setor</option>
                        @foreach($setores as $setor)
                        <option value="{{$setor->id}}" {{ ( ( old('setor_id') ?? ($horario->setor_id ?? '') ) ==
                            $setor->id) ? 'selected' : '' }}>
                            {{ $setor->nome }}</option>
                        @endforeach
                    </select>
                    @error('setor_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="data_atendimento" class="label-form-custom">Data:</label>
                <div class="input-container">
                    <i id="date-icon" class="icon-password far fa-calendar"></i>
                    <input id="data_atendimento" name="data" value="{{old('data')}}"
                        class="form-control @error('data') is-invalid @enderror" type="text"
                        placeholder="Selecione a Data:" readonly/>

                    @error('data')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        @php

        $horarios = [
        '08:00:00',
        '08:30:00',
        '09:00:00',
        '09:30:00',
        '10:00:00',
        '10:30:00',
        '11:00:00',
        '11:30:00',
        '12:00:00',
        '12:30:00',
        '13:00:00',
        '13:30:00',
        '14:00:00',
        '14:30:00',
        '15:00:00',
        '15:30:00',
        ];

        @endphp
        @if(isset($horario->id))
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="hora" class="label-form-custom">Hora</label>
                <div class="input-container">
                    <select name="horarios" id="hora"
                        class="select-form form-select @error('horarios') is-invalid @enderror">
                        <option value="">Selecione a hora</option>
                        @foreach($horarios as $hora)
                        @foreach(explode(' ', $hora) as $h)
                        <option value="{{$hora}}" {{ ( ( old('horarios') ?? ($horario->horario ?? '') ) == $hora) ?
                            'selected' : '' }}>{{$h[0]}}{{$h[1]}}:{{$h[3]}}{{$h[4]}}</option>
                        @endforeach
                        @endforeach
                    </select>
                    @error('horarios')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>

        @else
        <div class="form-row">
            <div class="form-group col-md-12">
                @php
                $count = 0;
                @endphp
                <div class="positon-title-card">
                    <label class="name-module"><strong><i>Hora:</i></strong></label>
                </div>
                @foreach ($horarios as $horario)
                <div class="form-check form-check-inline form-switch">
                    <input id="hora" class="form-check-input @error('horarios') is-invalid @enderror" type="checkbox"
                        name="horarios[]" value="{{$horario}}" {{ (is_array(old('horarios')) && in_array($horario,
                        old('horarios'))) ? ' checked' : '' }}>
                    @foreach(explode(' ', $horario) as $hora)
                    <label class="form-check-label">{{$hora[0]}}{{$hora[1]}}:{{$hora[3]}}{{$hora[4]}}</label>
                    @endforeach
                </div>
                @php
                $count++;
                @endphp
                @if($count == 4)
                <br>
                @php
                $count = 0;
                @endphp
                @endif
                @endforeach
                <div>
                    @error('horarios')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        @endif

        <div class="form-row">
            <div class="form-group col-md-12">
                <button type="button" class="btn-confirm-login" data-bs-toggle="modal"
                    data-bs-target="#ModalInsertHorario">Salvar</button>
            </div>
        </div>
    </form>
    <script>

        $(document).ready(function () {
            
            $('#data_atendimento').multiDatesPicker({
                dateFormat: "dd-mm-yy",
                minDate: 0 
            });
            //factory para estilização do calendário
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