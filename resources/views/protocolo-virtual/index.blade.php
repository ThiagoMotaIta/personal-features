@extends('home')

{{-- Rota apenas para administradores --}}
{{-- @if(Auth::user()->tipo == 1)
    <script>
        window.location.href = '{{route("protocolo-virtual.listar")}}';
    </script>
@endif --}}

@section('content-app')

<div class="positon_name_include">
    <p class="name_table">PROTOCOLOS</p>
</div>

@if(Auth::user()->tipo == 1)
<div class="position-btn-include">
    <a class="btn_include btn-more-space" href="{{ route('protocolo-virtual.create')}}"><i class="icon-space fa fa-plus-circle"></i>Abrir Novo Protocolo</a>
</div>
@endif

<form action="{{route('protocolo-virtual.index')}}" method="GET">
    <div class="position_content_search">
        <div class="position_content_inputs">
            <div class="position-inside-input">
                <label class="label-form-custom" for="tipo_licenca">Tipo de Licença</label>
                <select id="tipo_licenca" name="tipo_licenca" class="form-control form-select">
                    <option value="">Selecione o tipo de licença</option>
                    @foreach ($tiposLicencas as $licencas)
                    <option value="{{ $licencas->id }}">{{ $licencas->descricao }}</option>
                    @endforeach
                </select>
            </div>
            @if(Auth::user()->tipo != 1)
                <div class="position-inside-input">
                    <label class="label-form-custom" for="cpfcnpj">CPF do Solicitante</label>
                    <input id="cpfcnpj" type="text" name="cpf" class="cpf form-control" placeholder="Digite o CPF do solicitante">
                </div>
            @endif

            <div class="position-inside-input">
                <label class="label-form-custom" for="cpf">CPF do Proprietário</label>
                <input id="cpf" type="text" name="cpf_proprietario" class="cpf form-control" placeholder="Digite o CPF do proprietário">
            </div>

            <div class="position-inside-input">
                <label class="label-form-custom" for="cnpj">CNPJ</label>
                <input id="cnpj" type="text" name="cnpj" class="form-control" placeholder="Digite o CNPJ do solicitante">
            </div>
        </div>
        <div class="position-inside-input">
            <button id="pesquisar" class="tresh-btn edit-btn btn-bigSize" type="submit" title="Pesquisar Protocolo" name="pesquisar" alt="Pesquisar protocolo">
                <span class="tooltiptext">Pesquisar Protocolo</span>
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
</form>

<div class="navbar position-btn-confirm">
    <a class="btn_include btn-more-space" href="{{route('protocolo-virtual.index')}}">Limpar Consulta</a>
    {{-- @if(Auth::user()->tipo != 1)
    <a class="btn_include btn-more-space" href="{{route('protocolo-virtual.arquivados')}}">Desarquivar</a>
    @endif --}}
</div>

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

@if($protocolo_virtuais->isNotEmpty())

<table class="table table-custom">
    <thead class="thead-dark">
        <tr>
            <th scope="col">N° Protocolo</th>
            <th scope="col">Usuário</th>
            <th scope="col">Licença</th>
            <th scope="col">Tipo de Licença</th>
            {{-- <th scope="col">Status</th> --}}
            <th scope="col">Status Protocolo</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($protocolo_virtuais as $protocolo)
        <tr>
            <td>PMC{{$protocolo->id}}</td>
            <td>{{ $protocolo->user->name }}</td>
            <td>{{ $protocolo->licenca == 'pj' ? 'PJ' : 'PF' }}</td>
            <td>{{ $protocolo->tipoLicenca->descricao }}</td> 
            <td>{{ statusProtocoloComContagemCronologiaPorStatus($protocolo) }}</td>
            <td>
                <div class="positon-icons-table">
                    @if (Auth::user()->tipo == 2 || Auth::user()->tipo == 3)
                        @if ($protocolo->aprovacaoProtocolo >= 0 && Auth::user()->profile_id == 1)
                            <a class="btn_include" onclick="documents({{$protocolo}})" id="btnModal"><i class="icon-space fas fa-plus-circle"></i>Detalhes</a>
                        @elseif ($protocolo->aprovacaoProtocolo >= 1 && Auth::user()->profile_id == 2)          
                            <a class="btn_include" onclick="documents({{$protocolo}})" id="btnModal"><i class="icon-space fas fa-plus-circle"></i>Detalhes</a>
                        @elseif ($protocolo->aprovacaoProtocolo >= 2 && Auth::user()->profile_id == 3)
                            <a class="btn_include" onclick="documents({{$protocolo}})" id="btnModal"><i class="icon-space fas fa-plus-circle"></i>Detalhes</a>
                        @elseif ($protocolo->aprovacaoProtocolo >= 4 && Auth::user()->profile_id == 4)
                            <a class="btn_include" onclick="documents({{$protocolo}})" id="btnModal"><i class="icon-space fas fa-plus-circle"></i>Detalhes</a>
                        @elseif ($protocolo->aprovacaoProtocolo >= 5 && Auth::user()->profile_id == 5)
                            <a class="btn_include" onclick="documents({{$protocolo}})" id="btnModal"><i class="icon-space fas fa-plus-circle"></i>Detalhes</a>
                        @endif
                    @else
                        @if($protocolo->status_protocolo_id == 5)
                            <a class="tresh-btn view-btn" href="{{ route('protocolo-virtual.show', ['protocolo_virtual' => Hashids::encode($protocolo->id)]) }}" title="Visualizar"><span class="tooltiptext">Visualizar Protocolo</span><i class="fas fa-book-reader"></i></a>
                            <a class="tresh-btn document-btn" href="{{ route('protocolo-virtual.restore', ['protocolo_virtual' => Hashids::encode($protocolo->id)]) }}" title="Desarquivar"><span class="tooltiptext">Desarquivar Documentos</span><i class="fas fa-upload"></i></a>
                        @else
                            <a class="tresh-btn view-btn" href="{{ route('protocolo-virtual.show', ['protocolo_virtual' => Hashids::encode($protocolo->id)]) }}" title="Visualizar"><span class="tooltiptext">Visualizar Protocolo</span><i class="fas fa-book-reader"></i></a>
                             @if ($protocolo->aprovacaoProtocolo >= 7) 
                                <a target="_blank" href="{{ route('protocolo-virtual.exportarPDF', ['protocolo_virtual' => Hashids::encode($protocolo->id) ]) }}" class="tresh-btn emitir-licenca-button" ref=""><i class=" fas fa-plus-circle"></i></a>
                            @endif 
                            {{-- <a class="tresh-btn" data-bs-toggle="modal" href="#ModalDelete{{$protocolo->id}}" title="Arquivar Protocolo"><i class="fas fa-archive"></i></a>  --}}
                            @if ($protocolo->status_confirmacao_id == 1)
                                @if ($protocolo->status_protocolo_id == 3)
                                    <a class="tresh-btn document-btn icone-lightOn" href="{{ route('getAttachDocument',$protocolo->id)}}" title="Anexar Documento"><span class="tooltiptext">Anexar Documento</span><i class="fas fa-file"></i></a>
                                @elseif ($protocolo->status_protocolo_id == 1)
                                    <a class="tresh-btn document-btn" href="{{ route('getAttachDocument',$protocolo->id)}}" title="Anexar Documento"><span class="tooltiptext">Anexar Documento</span><i class="fas fa-file"></i></a>
                                @endif
                            @endif
                            <a class="edit-btn tresh-btn" href="{{ route('protocolo-virtual.edit', ['protocolo_virtual' => Hashids::encode($protocolo->id) ]) }}" title="Editar"> <span class="tooltiptext">Editar Campos</span> <i class="fas fa-edit"></i></a>                           
                        @endif
                    @endif
                </div>
            </td>

        </tr>
        <!-- Modal -->
        @include('protocolo-virtual.modal.delete')

        @endforeach
        @if(Auth::user()->tipo === 1)
        <tr>
            <td class="tfoot-align" colspan="8">
                <span class="icon-space descripttio_title_custom">Legenda:</span>
                <span class="icon-space"><i class="icon-space tfoot-view fas fa-book-reader"></i>Visualizar</span>
                @if ($protocolo->aprovacaoProtocolo >= 7)
                <span class="icon-space"><i class="icon-space tfoot-btn fas fa-plus-circle"></i>Exportar PDF</span>
                @endif
                @if($protocolo->status_protocolo_id == 5)
                <span class="icon-space"><i class="icon-space tfoot-doc fas fa-upload"></i>Desarquivar </span>
                @endif            
                <span class="icon-space"><i class="icon-space tfoot-doc far fa-file"></i>Anexar Doc </span>
                <span class="icon-space"><i class="icon-space tfoot-edit fas fa-edit"></i>Editar</span>
            </td>
        </tr>
        @endif
    </tbody>
</table>

<div id="modalMore" class="modal">
    <div class="modal-content w-75">
        <span id="closeBtn" class="close">&times;</span>
        <div class="modal-body" id="modal-aceite">

        </div>
    </div>
</div>

{{-- <div class="page-crud">
    <a href="{{$protocolo_virtuais->previousPageUrl()}}"><span class="page-text">Voltar</span></a>
    @for ($i = 1; $i <= $protocolo_virtuais->lastPage(); $i++)
    <a class="{{$protocolo_virtuais->currentPage() == $i ? 'active' : ''}}" href="{{$protocolo_virtuais->url($i)}}">{{$i}}</a>
    @endfor
    <a href="{{$protocolo_virtuais->nextPageUrl()}}"><span class="page-text">Avançar</span></a>
</div> --}}
<div class="d-flex">
    {{ $protocolo_virtuais->appends($request)->links() }}
</div>

{{-- <nav aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item"><a class="page-link" href="{{$protocolo_virtuais->previousPageUrl()}}">Voltar</a></li>
        @for ($i = 1; $i <= $protocolo_virtuais->lastPage(); $i++)
        <li class="page-item  {{$protocolo_virtuais->currentPage() == $i ? 'active' : ''}}">
            <a class="page-link" href="{{$protocolo_virtuais->url($i)}}">{{$i}}</a>
        </li>
        @endfor
        <li class="page-item"><a class="page-link" href="{{$protocolo_virtuais->nextPageUrl()}}">Avançar</a></li>
    </ul>
</nav> --}}

@else
<table class="table table-custom">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Usuário</th>
            <th scope="col">Licença</th>
            <th scope="col">Tipo de Licença</th>
            {{-- <th scope="col">Status</th> --}}
            <th scope="col">Status Protocolo</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th class="position-title-card" colspan="12">Nenhum registro de protocolo encontrado!</th>
        </tr>
    </tbody>
</table>
    <!-- <h2>Nenhum Registro de Protocolo encontrado!</h2> -->
@endif

@if(Session::has('record_added'))
    <script>
        toastr.success("{!!Session::get('record_added')!!}", 'Sucesso!');
    </script>
@endif

@php
    //Verifica se user está com senha padrão
    
    $default_password = substr(Auth::user()->cpf ,0,-6);
    $pw_default = false;
    
    if(!Session::get('remember_pw')){
        Session::put('remember_pw', '1');
    }
    
    if( Hash::check( $default_password, Auth::user()->password)) {
        $pw_default = true;
    }

@endphp

{{-- Verifica se user está com senha padrão --}}
@if($pw_default == true AND Session::get('remember_pw') == 1)
    <script>
        $(document).ready(function () {
          $('#update-password').click(); 
        });
    </script>
     {{  Session::put('remember_pw', '2')}}
@endif


<script type="text/javascript">
     $(function(){
        //Ao emitir licença carrega a pagina para atualiza o status do protocolo.
        $(".emitir-licenca-button").click(function(){
            var url = $(this).attr('href');
            window.open(url);
            setTimeout(function(){ location.reload(); }, 1000);
        });
    });
    function documents(protocolo) {
        var modal = document.getElementById("modalMore");
        // var btn = document.getElementById("btnModal");
        var span = document.getElementById("closeBtn");
        modal.style.display = "block";
        console.log("protocolo",protocolo);

        $.ajax({
            url: "protocolo-virtual/" + protocolo.id + "/modal",
            method: "GET",
            success: function (data) {
                console.log("data",data);
                $('#modal-aceite').html(data.html);
            }
        });

        // for (i = 0; i < protocolo.attachDocument.length; i++) {
        //     innerHTMLString = "<div class='division-accordion'>" +
        //                             "<div class='accordion' id='accordionExample'>" +
        //                                 "<div class='accordion-item1>" +
        //                                     "<div class='accordion-header' id='headingOne'>" +
        //                                         "<button class='accordion-button accordion-button-custom collapsed' type='button' id='x-"+i+"'  data-bs-toggle='collapse' data-bs-target='#collapseExample-"+protocolo.attachDocument[i].id+"' aria-expanded='true' aria-controls='ae'>" +
        //                                             protocolo.attachDocument[i].file
        //                                         "</button>" +
        //                                 "</div>" +
        //                             "</div>" +
        //                         "</div>";
        //     document.getElementById("modal-accordion").innerHTML = innerHTMLString;

        // }
        // console.log( "xd",document.getElementById("position-protocolos"));

        console.log(span);
        span.onclick = function () {
            modal.style.display = "none";
        }
    
    }
    // $( document ).ready(function() {
    //     $('#button').onclick(function () {
    //             var id = $(this).val();
    //             //Se setor não está vazio pega os horarios para esse setor

    //                 $.ajax({
    //                     url: "/prot-virtual/" + id + "/",
    //                     method: "GET",
    //                     success: function (data) {
    //                         $('#data_atendimento').html(data.html);
    //                     }
    //                 });



    //     })
    // });
</script>

@endsection





