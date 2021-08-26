<div class="modal fade" id="modalAtendimento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="position-title-card">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <p class="title-form">AGENDAR ATENDIMENTO VIRTUAL</p>
            </div>
            <div class="modal-body">
                <form action="{{ route('atendimento-virtual.store') }}" method="post">
                    @csrf
                    <div class="form-content ">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="empreendedor" class="label-form-custom">Nome completo</label>
                                <div class="input-container">
                                    <input id="empreendedor" type="text" name="nome_atend" id="nome"
                                        onkeypress="onlyLetters()" value="{{ old('nome_atend') }}"
                                        class="form-control @error('nome_atend') is-invalid @enderror"
                                        placeholder="Digite nome completo.">
                                    @error('nome_atend')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="cpf_atend" class="label-form-custom">CPF</label>
                                <div class="input-container">
                                    <input id="cpf_atend" type="text" name="cpf_atend" value="{{ old('cpf_atend') }}"
                                        class="form-control @error('cpf_atend') is-invalid @enderror cpf"
                                        placeholder="Digite seu CPF.">
                                    @error('cpf_atend')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="mail" class="label-form-custom">Email</label>
                                <div class="input-container">
                                    <input id="mail" type="email" name="email_atend" value="{{ old('email_atend') }}"
                                        class="form-control @error('email_atend') is-invalid @enderror"
                                        placeholder="Digite seu e-mail.">
                                    <span id="errorEmail" class="invalid-feedback d-none">
                                        <strong>Informe um e-mail válido</strong>
                                    </span>
                                    @error('email_atend')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="tel" class="label-form-custom">Telefone</label>
                                <div class="input-container">
                                    <input id="tel" type="text" name="telefone_atend"
                                        value="{{ old('telefone_atend') }}"
                                        class="form-control telefone @error('telefone_atend') is-invalid @enderror"
                                        placeholder="Digite telefone.">
                                    @error('telefone_atend')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label id="setor_label" for="setor" class="label-form-custom">Setor</label>
                                <div class="input-container">
                                    <select name="setor_id" id="setor"
                                        class="select-form form-select @error('setor_id') is-invalid @enderror"
                                        onclick="ClearInputs()"></select>
                                    @error('setor_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="n_process" class="label-form-custom">Número do processo(Opcional)</label>
                                <div class="input-container">
                                    <input type="text" name="numero_processo" id="n_process"
                                        value="{{ old('numero_processo') }}"
                                        class="form-control @error('numero_processo') is-invalid @enderror"
                                        placeholder="Digite o n° do processo(opcional)">
                                    @error('numero_processo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                        </div>

                    </div>
                    {{-- guarda valor do input caso error --}}
                    <input id="old-setor" type="hidden" value="{{ old('setor_id') ?? ''}}">

                    <div class="form-row complemento-form">
                        <div class="form-group col-md-12">
                            <label for="assunto" class="label-form-custom">Assunto</label>
                            <div class="input-container">
                                <input id="assunto" type="text" name="assunto" value="{{ old('assunto') }}"
                                    class="form-control @error('assunto') is-invalid @enderror"
                                    placeholder="Digite o assunto do atendimento">
                                @error('assunto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-row complemento-form">
                        <div class="form-group col-md-6">
                            <label for="data_atendimento" class="label-form-custom">Selecione a melhor data</label>
                            <div class="input-container">
                                <i id="date-icon"
                                    class="@error('data_atendimento') icon-error @enderror icon-password far fa-calendar"></i>
                                <input id="data_atendimento" name="data_atendimento"
                                    value="{{ old('data_atendimento') }}"
                                    class="form-control  @error('data_atendimento') is-invalid @enderror" type="text"
                                    placeholder="Selecione a Data:" readonly>

                                @error('data_atendimento')
                                <span class='invalid-feedback' role='alert'>
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group horario-form col-md-6">
                            <label id="hora_label" for="hora_atendimento" class="label-form-custom">Selecione o melhor horário</label>
                            <div class="input-container">
                                <select name="hora_atendimento" id="hora_atendimento" data-content="far fa-clock"
                                    class="select-form form-select @error('hora_atendimento') is-invalid @enderror">
                                </select>
                                @error('hora_atendimento')
                                <span class='invalid-feedback' role='alert'>
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- guarda valor do input caso error --}}
                    <input id="old-data-atendimento" type="hidden" value="{{ old('data_atendimento') ?? ''}}">
                    <input id="old-hora-atendimento" type="hidden" value="{{ old('hora_atendimento') ?? ''}}">

                    <div class="form-row complemento-form">
                        <div class="form-group col-md-12">
                            <div class="label-form-custom">
                                <label for="mens">Descrição</label>
                                <textarea id="mens" name="mensagem"
                                    class="form-control @error('mensagem') is-invalid @enderror"
                                    placeholder="Descreva sua dúvida">{{old('mensagem')}}</textarea>
                            </div>
                            @if($errors->has('mensagem'))
                            <span class="text-danger" role="alert">
                                <strong>{{ $errors->first('mensagem')}}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-row complemento-form">
                        <button type="submit" class="btn-confirm-login ">Agendar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function () {
        //Busca setores
        var old_setor = $('#old-setor').val();
        var dates = [];

        $.ajax({
            url: "/setor-virtual/" + old_setor,
            method: "GET",
            async: false,
            success: function (data) {
                $('#setor').html(data.html);
            }
        });

        $('.complemento-form').hide();

        $('#setor').change(function () {
            var id = $(this).val(); // Setor ID
            dates = [];
            if (id) {
                $.ajax({
                    url: "/horario-virtual/" + id,
                    method: "GET",
                    async: false,
                    success: function (data) {
                        // $('#data_atendimento').html(data.html);
                        for (let i = 0; i < data.html.length; ++i) {
                            dates.push(data.html[i].data.substring(0, 10));
                        }
                    }
                });

                $('.complemento-form').show();

            } else {
                $('.complemento-form').hide();
            }

        });

        $("#data_atendimento").datepicker({
            dateFormat: "dd-mm-yy",
            beforeShowDay: function (date) {
                if ($.inArray($.datepicker.formatDate('yy-mm-dd', date), dates) > -1) {
                    return [true, "", "Available"];
                } else {
                    return [false, '', "Not Available"];
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
                    "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
                ],
                monthNamesShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun",
                    "Jul", "Ago", "Set", "Out", "Nov", "Dez"
                ],
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


        $('#data_atendimento').change(function () {
            var old = $('#old-hora-atendimento').val();
            var setor_id = $('#setor').val();
            var data_atend = $('#data_atendimento').val();

            if (data_atend) {
                $.ajax({
                    url: "/horario-virtual/" + setor_id + "/" + data_atend + "/" + old,
                    method: "GET",
                    async: false,
                    success: function (data) {
                        $('#hora_atendimento').html(data.html);
                    }
                });

                $('.horario-form').show();

            } else {
                $('.horario-form').hide();
            }

        });

        $('#setor').change();
        $('#data_atendimento').change();
        $('.fa-calendar').click(function () {
            $("#data_atendimento").focus();
        });
        // $("#setor_label").click(function () {
        //     console.log('chegou');
        //     var size = $('#setor option').size();
        //     if (size != $("#setor").prop('size')) {
        //         $("#setor").prop('size', size);
        //     } else { 
        //         $("#setor").prop('size', 1);
        //     }
        // })


    });

    function onlyLetters() {
        if ((event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event
            .charCode > 191 && event.charCode < 219) || (event.charCode > 223 && event.charCode < 252) || (event
                .charCode == 32)) {

        } else {
            event.preventDefault();
        }
    }

    $(document).ready(function () {
        $("input[type=email][name=email]").blur(function () {
            var valid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var email = $("#email").val();

            console.log(email);
            if (!valid.test(email)) {
                $('#email').addClass('is-invalid');
                $('#errorEmail').removeClass('d-none');
            } else {
                $('#email').removeClass('is-invalid');
                $('#errorEmail').addClass('d-none');
            }
        });
    });

    function calendar() {
        $("#data_atendimento").datepicker({
            dateFormat: "dd-mm-yy",
            beforeShowDay: function (date) {
                if ($.inArray($.datepicker.formatDate('yy-mm-dd', date), dates) > -1) {
                    return [true, "", "Available"];
                } else {
                    return [false, '', "Not Available"];
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
                    "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
                ],
                monthNamesShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun",
                    "Jul", "Ago", "Set", "Out", "Nov", "Dez"
                ],
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
    }

    function ClearInputs() {
        $('#data_atendimento').datepicker("setDate", "");
    }

</script>