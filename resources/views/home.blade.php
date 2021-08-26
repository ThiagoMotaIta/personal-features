@extends('layouts.app')

@section('content')

    <!-- Modais -->
    {{-- @include('modais.confirm-responsibility') --}}

    <input type="checkbox" id="check">
    <!--NAVHEADER-->

    <header class="header-nav">

        <label for="check">
            <i class="fas fa-bars" id="sidebar_btn"></i>
        </label>
        <div class="position_top_area">
            <div class="left_area">
               <a href="{{ route('protocolo-virtual.index') }}"><img class="img-logo-dash" src="https://blockchainone.com.br/logo-min.png" /></a>
                <button class="accessibility-btn" id="fontL" title="Diminuir Fonte"><i class="fas fa-minus"></i></button>
                <button class="accessibility-btn" id="fontD" title="Fonte Padrão"> A </button>
                <button class="accessibility-btn" id="fontB" title="Aumentar Fonte"><i class="fas fa-plus"></i></button>
            </div>
            <div class="right_area">
                <p class="name-user">{{ Auth::user()->name }}</p>
                <a class="logout_btn btn-back btn_include" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon-space fas fa-sign-out-alt"></i>Sair</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </header>
    <!--/NAVHEADER-->

    <!--MOBILE-->
    <div class="mobile_nav">
        <div class="nav_bar">
            <p class="name-user">{{ Auth::user()->name }}</p>
            <i class="fa fa-bars nav_btn"></i>
        </div>
        <div class="mobile_nav_items">
            @if (Auth::user()->tipo == 1)
            <a href="{{ route('home')}}"><i class="fas fa-file"></i><span>Protocolo Virtual</span></a>
            <a href="#"><i class="fas fa-search"></i><span>Pesquisar Processo</span></a>
            <a href="#"><i class="fas fa-search"></i><span>Desarquivar Processo</span></a>
            <a href="#"><i class="fas fa-search"></i><span>Confirmar Responsabilidade</span></a>
            @endif

            @if (Auth::user()->tipo != 1)
            <a href="{{ route('home')}}"><i class="fas fa-desktop"></i><span>Analisar Processo</span></a>
            @can('permissoes-view')
            <a href="{{ route('getDadosUser')}}"><i class="fas fa-sliders-h"></i><span>Permissões</span></a>
            @endcan
            @can('usuario-view')
            <a href="{{ route('getUser')}}"><i class="fas fa-cogs"></i><span>Usuários</span></a>
            @endcan
            <a href="#"><i class="fas fa-table"></i><span>Relatórios</span></a>
            @endif
        </div>
    </div>
    <!--/MOBILE-->

    <!--SIDEBAR-->
    <div class="sidebar">
        @if (Auth::user()->tipo == 1)
            <a href="{{ route('protocolo-virtual.create')}}"><i class="fas fa-file"></i><span>Protocolo Virtual</span></a>
            <a href="{{ route('protocolo-virtual.index')}}"><i class="fas fa-search"></i><span>Pesquisar Processo</span></a>
            {{-- <a href="#" onclick="divAlerta('DESARQUIVAR PROCESSO')"><i class="fas fa-save"></i><span>Desarquivar Processo</span></a> -- }}
            {{-- <a href="#addBookDialog" data-id="xSDSDDDD" data-title-responsibility="{{$ovo ? $ovo : 'nada'}}" class="open-AddBookDialog"><i class="fas fa-check-circle"></i><span>Confirmar Resp.</span></a> --}}
            <a href="{{ route('getConfirmResponsibility')}}"><i class="fas fa-check-circle"></i><span class="ajust_text">Confirmar Responsabilidade</span></a>
        {{-- <a href="{{ route('atendimento-virtual.index')}}"><i class="fas fa-comments"></i><span>Atendimento Virtual</span></a> --}}
        <a href="#" id="update-password"><i class="fas fa-unlock"></i><span>Atualizar Senha</span></a>

        @endif

        @if (Auth::user()->tipo != 1)
            @can('processo-view')
            <a href="{{ route('protocolo-virtual.index')}}"><i class="fas fa-search"></i><span>Analisar Processo</span></a>
            @endcan
            @can('permissoes-view')
            <a href="{{ route('getDadosUser')}}"><i class="fas fa-check-circle"></i><span>Permissões</span></a>
            @endcan
            @can('usuarios-view')
            <a href="{{ route('getUser')}}"><i class="fas fa-user"></i><span>Usuários</span></a>
            @endcan
            @can('atendimento-view')
            <a href="{{ route('atendimento-virtual.index')}}"><i class="fas fa-comments"></i><span>Atendimento Virtual</span></a>
            @endcan
            @can('horario-view')
            <a href="{{ route('horario.index')}}"><i class="far fa-calendar-alt"></i><span>Horários de Atendimento</span></a>
            @endcan
            @can('relatorios-view')
            <a href="#"><i class="fas fa-file"></i><span>Relatórios</span></a>
            @endcan
            @can('fale-conosco-view')
            <a href="{{ route('ouvidoria.index')}}"><i class="far fa-comment"></i><span>Fale Conosco</span></a>
            @endcan
            <a href="#" id="update-password"><i class="fas fa-unlock"></i><span>Atualizar Senha</span></a>
        @endif

        {{-- input para guardar id user logado usado in requisição ajax --}}
        <input id="id_user" type="hidden" value="{{Hashids::encode(Auth::id())}}">
    </div>
    <!--/SIDEBAR-->

    <div class="content">

        @if(Auth::user()->tipo == 1)

        @endif

        <div class="alert alert-info" style="display: none;" id="alerta-dev">

        </div>

        {{-- Modal dados user atualizar senha --}}
        @include('user.modal.update-password')
        @yield('content-app')



    </div>

    <script type="text/javascript">

        $(document).ready(function () {
            $('.nav_btn').click(function () {
                $('.mobile_nav_items').toggleClass('active');
            });

            updateSizeFont("size_font",".content");
        });

        function divAlerta(func){
            $("#alerta-dev").hide();
            $("#alerta-dev").show(500);
            $("#alerta-dev").html("<i class='fa fa-thumbs-up'></i> Opa, a funcionalidade <strong>"+func+"</strong> ainda não está disponível.");
        }

        $(document).on("click", ".open-AddBookDialog", function (e) {

            e.preventDefault();

            var _self = $(this);

            var myBookId = _self.data('id');
            var titleResponsibility = _self.data('title-responsibility');
            $("#bookId").val(myBookId);
            $("#title-responsibility").text(titleResponsibility);



            $(_self.attr('href')).modal('show');
        });

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

    </script>

@endsection
