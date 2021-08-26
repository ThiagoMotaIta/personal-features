<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Atualiza pagina ao terminar sessão do usuario evitar csrf token expired --}}
    <meta http-equiv="refresh" content="{{ config('session.lifetime') * 60 }}">

    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="Stylesheet" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-multidatespicker/1.6.6/jquery-ui.multidatespicker.js" integrity="sha512-shDVoXhqpazAEKzSzJQTn5mAtynJ5eIl8pNX2Ah25/GZvZWDEJ/EKiVwfu7DGo8HnIwxlbu4xPi+C0SsHWCCNw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-multidatespicker/1.6.6/jquery-ui.multidatespicker.css" integrity="sha512-VXbqGGD29gdYg6HSSzLd6+eVwBznGTrVoIqZOruvkIbuWSZNDjg/I4p2/zKGMllL5dxzj1PoNoh0dqX1dWxBsQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- JQuery  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.60/inputmask/jquery.inputmask.js"></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/geral.css') }}" rel="stylesheet">

    <!-- BOOTSTRAP -->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- TOATSR -->
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- SWEETALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        toastr.options = {
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "700",
            "hideDuration": "600"
        }

    </script>

</head>

<body>
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    {{-- Abre modal Atendimento virtual inserido --}}
    @if(Session::has('message-atendimento'))
    <script>
        $(function () {
            $('#atend-id').html("{{ Session::get('atend-id')}}");
            $('#atend-virtual').modal('show');
        });
    </script>
    @endif
    {{-- Abre modal Atendimento virtual em caso erro de dados --}}
    @if (session('atend'))
    <script type="text/javascript">
        $(document).ready(function () {
            $('#modalAtendimento').modal('show');
        });
    </script>
    @endif

    {{-- Abre modal Fale Conosco em caso erro de dados --}}
    @if (session('ouvidoria'))
    <script type="text/javascript">
        $(document).ready(function () {
            $('#modalFalaConosco').modal('show');
        });
    </script>
    @endif

    {{-- Abre modal Fale conosco inserido --}}
    @if(Session::has('message-fale-conosco'))
    <script>
        $(function () {
            $('#fale-id').html("{{ Session::get('fale-id')}}");
            $('#fale-conosco').modal('show');
        });
    </script>
    @endif

    <!-- Modal -->
    <div class="modal modal-confirm fade" id="atend-virtual" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="position-contetn-modal">
                    <p class="content-modal">Agendamento nº<span id="atend-id"></span> realizado!</p>
                    <p class="content-modal">Você receberá o link via e-mail para entrar na reunião.</p>
                    <p>Fique atento na sua caixa de entrada e spam.</p>
                </div>
                <button type="button" class="btn-confirm-login " data-bs-dismiss="modal" aria-label="Close">OK</button>
            </div>
        </div>
    </div>

    <!-- Modal Fale Conosco-->
    <div class="modal modal-confirm fade" id="fale-conosco" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="position-contetn-modal">
                    <p class="content-modal">Seu feedback foi enviado!</p>
                    <p class="content-modal">O número de seu protocolo é: <span id="fale-id"></span> </p>
                    <p class="content-modal">Em breve analisaremos a sua demanda.</p>
                    <p>Nossa equipe agradece o seu contato!</p>
                </div>
                <button type="button" class="btn-confirm-login " data-bs-dismiss="modal" aria-label="Close">OK</button>
            </div>
        </div>
    </div>



    <script>

        function updateSizeFont(nameSavedInLocalStorage, nameClassBase) {
            var limitVariationSizeFont = 3;
            var sizePatternFont = 16;
            var sizeMaxFont = sizePatternFont + limitVariationSizeFont;
            var sizeMinFont = sizePatternFont - limitVariationSizeFont;

            (
                // setSizeFontInDomIfSavedInLocalStorage
                function () {
                    var sizeFontSaved = localStorage.getItem(nameSavedInLocalStorage);

                    if (sizeFontSaved) {
                        sizeFontSaved = parseInt(sizeFontSaved);

                        if (sizeFontSaved === sizeMaxFont) {
                            $('#fontB').prop('disabled', true);
                        } else if (sizeFontSaved === sizeMinFont) {
                            $('#fontL').prop('disabled', true);
                        }

                        $(nameClassBase).css("fontSize", sizeFontSaved);
                    }
                }
            )()

            //Aumenta tamanho da fonte
            $("#fontB").on("click", function(){
                var classBase = $(nameClassBase);
                var sizeCurrentFont = parseInt(classBase.css('font-size'));

                if (sizeCurrentFont < sizeMaxFont) {
                    //Habilita botao de diminuir fonte
                    $('#fontL').prop('disabled', false);

                    if (sizeCurrentFont === sizeMaxFont - 1) {
                        //Desabilita botao de aumentar fonte
                        $('#fontB').prop('disabled', true);
                    } else {
                        //Habilita o botao de aumentar fonte
                        $('#fontB').prop('disabled', false);
                    }

                    classBase.css("fontSize", sizeCurrentFont + 1);
                    localStorage.setItem(nameSavedInLocalStorage, sizeCurrentFont + 1);
                }
            });

            //Diminui tamanho da fonte
            $("#fontL").on("click", function(){
                var classBase = $(nameClassBase);
                var sizeCurrentFont = parseInt(classBase.css('font-size'));

                if (sizeCurrentFont > sizeMinFont) {
                    //Habilita botao de aumentar fonte
                    $('#fontB').prop('disabled', false);

                    if (sizeCurrentFont === sizeMinFont + 1) {
                        //Desabilita o botao de diminuir fonte
                        $('#fontL').prop('disabled', true);
                    } else {
                        //Habilita o botao de diminuir fonte
                        $('#fontL').prop('disabled', false);
                    }

                    classBase.css("fontSize", sizeCurrentFont - 1);
                    localStorage.setItem(nameSavedInLocalStorage, sizeCurrentFont - 1);
                }
            });

            //Seta tamanho da fonte para valor padrao
            $("#fontD").on("click", function() {
                $(nameClassBase).css('fontSize', sizePatternFont);
                localStorage.setItem(nameSavedInLocalStorage, sizePatternFont);

                $('#fontB').prop('disabled', false);
                $('#fontL').prop('disabled', false);
            });
        }

        function openModal(modalId) {
            var MyModal = document.getElementById(modalId);
            MyModal.style.display = "block";
        }

        function closeModal(modalId) {
            var MyModal = document.getElementById(modalId);
            MyModal.style.display = "none";
        }
        jQuery(function ($) {
            jQuery(document).ready(function () {

                if ($('.telefone').val().length ==
                        15) { // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
                        $('.telefone').inputmask('(99) 99999-999[9]', {
                            clearIncomplete: true
                        });
                    } else {
                        $('.telefone').inputmask('(99) 99999-999[9]', {
                            clearIncomplete: true
                        });
                }

                $(".end").hide();

                $("#cpfMostra").inputmask("999.999.999-99"); // Apenas para mostrar desabilitado

                $(".cpfMostra").inputmask("999.999.999-99"); // Apenas para mostrar desabilitado

                $("#cpf").inputmask("999.999.999-99"); // Apenas para mostrar desabilitado

                $("input[id*='cpfcnpj']").inputmask({
                    mask: ['999.999.999-99', '99.999.999/9999-99'],
                    keepStatic: true,
                    clearIncomplete: true
                });

                $('#cpf').click(function () {
                    $("#cpf").inputmask("999.999.999-99", {
                        clearIncomplete: true
                    });
                })

                $('.cpf').click(function () {
                    $('.cpf').inputmask("999.999.999-99", {
                        clearIncomplete: true
                    });
                });

                $('#cpf').focus(function () {
                    $("#cpf").inputmask("999.999.999-99", {
                        clearIncomplete: true
                    });
                })

                $('.cpf').focus(function () {
                    $('.cpf').inputmask("999.999.999-99", {
                        clearIncomplete: true
                    });
                });

                $("#cnpj").click(function () {
                    $("#cnpj").inputmask("99.999.999/9999-99", {
                        clearIncomplete: true
                    });
                });

                $("#cnpj").focus(function () {
                    $("#cnpj").inputmask("99.999.999/9999-99", {
                        clearIncomplete: true
                    });
                });

                $("#cep").click(function () {
                    $("#cep").inputmask("99.999-999", {
                        clearIncomplete: true
                    });
                });

                $("#cep").focus(function () {
                    $("#cep").inputmask("99.999-999", {
                        clearIncomplete: true
                    });
                });

                $("#telefone").click(function () {
                    $("#telefone").inputmask("(99) 99999-999[9]", {
                        clearIncomplete: true
                    });
                });

                $(".telefone").click(function () {
                    $(".telefone").inputmask("(99) 99999-999[9]", {
                        clearIncomplete: true
                    });
                });

                $("#data").click(function () {
                    $("#data").inputmask("9999-99-99 99:99", {
                        clearIncomplete: true
                    });
                });

                $(".date").click(function () {
                    $(".date").inputmask("99-99-9999", {
                        clearIncomplete: true
                    });
                });

                // mascar 8 ou 9 digitos telefone
                $('.telefone').blur(function (event) {
                    if ($(this).val().length ==
                        15) { // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
                        $('.telefone').inputmask('(99) 99999-999[9]', {
                            clearIncomplete: true
                        });
                    } else {
                        $('.telefone').inputmask('(99) 99999-999[9]', {
                            clearIncomplete: true
                        });
                    }
                });

                function limpa_formulário_cep() {
                    // Limpa valores do formulário de cep.
                    $("#endereco").val("");
                    $("#bairro").val("");
                    $("#cidade").val("");
                    $("#uf").val("");
                }

                //Quando o campo cep perde o foco.
                $("#cep").blur(function () {

                    //Nova variável "cep" somente com dígitos.
                    var cep = $(this).val().replace(/\D/g, '');

                    //Verifica se campo cep possui valor informado.
                    if (cep != "") {

                        $("#loadCep").show();

                        //Expressão regular para validar o CEP.
                        var validacep = /^[0-9]{8}$/;

                        //Valida o formato do CEP.
                        if (validacep.test(cep)) {

                            //Preenche os campos com "..." enquanto consulta webservice.
                            $("#endereco").val("...");
                            $("#bairro").val("...");
                            $("#cidade").val("...");

                            //Consulta o webservice viacep.com.br/
                            $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?",
                                function (dados) {

                                    if (!("erro" in dados)) {
                                        console.log(dados);
                                        //Atualiza os campos com os valores da consulta.
                                        $("#endereco").val(dados.logradouro);
                                        $("#bairro").val(dados.bairro);
                                        $("#cidade").val(dados.localidade);
                                        $("#uf").val(dados.uf).change();

                                        $("#loadCep").hide(500);
                                        $(".end").show(500);
                                    } //end if.
                                    else {
                                        //CEP pesquisado não foi encontrado.
                                        limpa_formulário_cep();
                                        alert("CEP não encontrado.");
                                    }
                                });
                        } //end if.
                        else {
                            //cep é inválido.
                            limpa_formulário_cep();
                            alert("Formato de CEP inválido.");
                        }
                    } //end if.
                    else {
                        //cep sem valor, limpa formulário.
                        limpa_formulário_cep();
                    }
                });

            });

        });

    </script>
</body>

</html>
