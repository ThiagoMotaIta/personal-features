<div>
    <div class="position-title-card position-forgot">
        <h3>Protocolo: PMC{{$protocolo_virtuais->id}}</h3>
    </div>
    <table class="table">
        @if( $protocolo_virtuais->licenca == 'pf')
        <tr>
            <td colspan="6">
                <b class="icon-space">Usuário:</b> <label class="custom-check-label">{{ $protocolo_virtuais->user->name }}</label>
            </td>
            <td colspan="6">
                <b class="icon-space">CPF:</b> 
                @if($protocolo_virtuais->requerente == 0)
                <label class="custom-check-label">{{ Helper::mask($protocolo_virtuais->cpf, '###.###.###-##')}} </label>
                @else
                <label class="custom-check-label">{{ Helper::mask($protocolo_virtuais->user->cpf, '###.###.###-##')}} </label>
                @endif
            </td>
        </tr>
        @else
        @endif
        <tr>
            <td colspan="6">
                <b class="icon-space">E-mail:</b> <label class="custom-check-label">{{ $protocolo_virtuais->email }}</label>
            </td>
            <td colspan="6">
                <b class="icon-space">Telefone:</b> <label class="custom-check-label">{{ $protocolo_virtuais->telefone }}</label>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <b class="icon-space">Licença:</b> <label class="custom-check-label">{{ $protocolo_virtuais->licenca == 'pj' ? 'PJ' : 'PF'}}</label>
            </td>
            <td colspan="8">
                <b class="icon-space">Tipo de Licença:</b> <label class="custom-check-label">{{ $protocolo_virtuais->tipoLicenca->descricao }}</label>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <b class="icon-space">Responsável/proprietário</b> <label class="custom-check-label">{{ $protocolo_virtuais->requerente == 1 ? "Sim" : "Não"}}</label>
            </td>
            <td colspan="8">
                <b class="icon-space">Nome do Empreendimento/Proprietário:</b> 
                @if($protocolo_virtuais->requerente == 0)
                <label class="custom-check-label">{{ $protocolo_virtuais->empreendimento }}</label>
                @else
                <label class="custom-check-label">{{ $protocolo_virtuais->user->name }}</label>
                @endif
            </td>
        </tr>
        @if( $protocolo_virtuais->licenca == 'pj' )
        <tr>
            <td colspan="6">
                <b class="icon-space">CNPJ:</b> <label class="custom-check-label">{{ $protocolo_virtuais->cnpj }}</label>
            </td>
            <td colspan="6">
                <b class="icon-space">Razão Social:</b> <label class="custom-check-label">{{ $protocolo_virtuais->razao_social }}</label>
            </td>
        </tr>
        @endif
        <tr>
            <td colspan="3">
                <b class="icon-space">CEP:</b> <label class="custom-check-label">{{ $protocolo_virtuais->cep }}</label>
            </td>
            <td colspan="3">
                <b class="icon-space">Endereço:</b> <label class="custom-check-label">{{ $protocolo_virtuais->endereco }}</label> 
            </td>
            <td colspan="3">
                <b class="icon-space">Número:</b> <label class="custom-check-label">{{ $protocolo_virtuais->numero }}</label> 
            </td>
            <td colspan="3">
                <b class="icon-space">Complemento:</b> <label class="custom-check-label">{{ $protocolo_virtuais->complemento }}</label> 
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <b class="icon-space">Bairro:</b> <label class="custom-check-label">{{ $protocolo_virtuais->bairro }}</label>
            </td>
            <td colspan="4">
                <b class="icon-space">Cidade:</b> <label class="custom-check-label">{{ $protocolo_virtuais->municipio}}</label>
            </td>
            <td colspan="4">
                <b class="icon-space">Estado:</b> <label class="custom-check-label">{{ $protocolo_virtuais->uf }}</label>
            </td>
        </tr>
        @if(!empty($protocolo_virtuais->license))
            <tr>
                <td colspan="4">
                    <b class="icon-space">Licença:</b> <label class="custom-check-label"><a href="storage/{{$protocolo_virtuais->license}}" target="blank">licença</a></label>
                </td>
            </tr>
        @endif

    </table>
    {{-- Form para anexa licença dp protocolo --}}
    <div id="attach" style="display: none">
        <form id="formAttachLicense" method="POST" enctype="multipart/form-data" action="{{route('protocolo-virtual.attach.license')}}">
            @csrf
            <input type="hidden" name="protocol_id" id="protocol_id">
            <div class="form-group">
                <label for="exampleFormControlFile1">Example file input</label>
                <input type="file" name="license" class="form-control-file license" id="license-input">
                <span class="invalid-feedback license_err" role="alert">
                    <strong></strong>
                </span>
            </div>
            <button type="submit" id="submitButtonAttachLicense" class="btn btn-primary">Anexar</button>
        </form>
    </div>
    @if($message)
    <h5 class="custom-check-label title-form profile_info tfoot-btn">*{{ $message }}</h5>
    @else
    <form id="authorize-protocol" action="{{ route('protocolo-virtual.authorizeProtocol',$protocolo_virtuais->id) }}" method="POST">
        @csrf
        <div class="position-protocolos">
            @foreach ($protocolo_virtuais->attachDocument as $document)
                <div class="division-accordion">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <div class="accordion-header"id="headingOne">
                                <button class="accordion-button accordion-button-custom collapsed xd-{{$loop->index}}" type="button"  id="x-{{$loop->index}}"  data-bs-toggle="collapse" data-bs-target="#collapseExample-{{$document['id']}}" aria-expanded="true" aria-controls="collapseExample-{{$document['id']}}">
                                    {{$document['name']}}
                                </button>
                            </div>
                            <div id="collapseExample-{{$document['id']}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">                        
                                <div class="accordion-body">
                                    <div class="navbar position-btn-confirm">
                                        <a target="_blank" href="{{asset('/storage/documentos/'.$protocolo_virtuais->id.'/'.$document['id'].'/'.$document['file'])}}" class="custom-check-label descripttio_title_custom tfoot-edit">Visualizar Documento</a>                                        
                                        <div class="posiiton-check-{{$loop->index}}">
                                            
                                            <input class="form-check-input-true-{{$loop->index}}" type="radio" name="{{$loop->index}}" id="accept" value="{{$document['id']}}-true"  {{ (@$document['approved_document'] == 1) ? 'checked' : 'unchecked' }}  >
                                            <label class="custom-check-label" for="protocolo-radio-{{$document['id']}}">Aprovado</label>
                                            <input class="form-check-input-false-{{$loop->index}}" type="radio" name="{{$loop->index}}" id="refuse" value="{{$document['id']}}-false" {{ (@$document['approved_document'] == 2) ? 'checked' : 'unchecked' }} >
                                            <label class="custom-check-label" for="protocolo-radio-{{$document['id']}}">Recusar</label>
                                            
                                            
                                            
                                        </div>
                                        <textarea id="textarea-{{$loop->index}}" class="form-control d-none"  rows="4" cols="50" name="note_document-{{$loop->index}}" placeholder="{{@$document['note_document']}}" {{ (@$document['note_document']) ? 'disabled' : '' }}></textarea>

                                        <!-- <p class="licence-descrip"><span class="strong-descri-card">OBS:</span> Este documento deve estar nas extensões: <span class="strong-descri-card">{{ $document['extension'] }}</span></p> -->
                                    </div>
                                    <div class="form-group" id="form-group-document-{{$loop->index}}">
                                        {{--
                                        @if (!isset($document['file']))
                                            <label for="file">Clique aqui para anexar: </label>                                               
                                            <input type="file" id="input-document-{{$loop->index}}" name="{{$document['id']}}" value="{{$document['id']}}" accept=".{{$document['extension']}}" {{ ($document['required'] == 1)  ? 'required' : '' }}>
                                        @else
                                        <span id="archive-{{$loop->index}}">Arquivo: <strong>{{ @$document['file'] }}</strong></span>
                                        @endif
                                        --}}
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- <div class="form-row">
            <div class="form-group col-md-12">
                <label for="descricao" class="label-form-custom">Observações:</label>
                <div class="input-container">
                    <textarea id="w3review" rows="5" class="form-control" placeholder="Observaçõs gerais da solicitação."></textarea>
                </div>  
            </div>
        </div> -->
        <div class="buttons-detail">
            @if (@$document['approved_document'])   
                <button id="closeBtnInside" onclick="closeModal()" type="button" class="btn-confirm-login">Fechar</button> 
            @else
                <button onclick="checkInput()" type="button"  class="btn-confirm-login">Salvar</button> 
            @endif
            @if (Auth::user()->profile_id == 3 && @$document['approved_document'])
                <button id="anexarBtn" onclick="attachLicense({{$protocolo_virtuais}})" type="button" class="btn-confirm-login">Anexar</button>
            @endif
        </div>

    </form>
    @endif
</div>

<script type="text/javascript">
    /**
    $(document).ready(function(){ 
        var count = document.getElementsByClassName('accordion-item');
        console.log('count', count.length);
        if ($('input[type=radio]:checked').length == count.length) {
            $(`input[type=radio]`).click(function () {
                $(`.btn-confirm-login`).removeClass('d-none');
            });   
        }
    });
    **/

    $(function(){
        /* 
            Author: Rafael Morais
            Description: Submet form para controller validar e inserir
        */
        $(document).on("submit", "#formAttachLicense", function(event){
            //$("#formAttachLicense").submit();
            event.preventDefault();
            $('*').removeClass("is-invalid");
            $.ajax({
                url: $(this).attr("action"),
                type: $(this).attr("method"),
                dataType: "JSON",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function (data, status)
                {   
                    if ($.isEmptyObject(data.error)) {
                        $('#attach').hide();
                        location.reload();
                    } else {
                        printErrorMsg(data.error);
                    }
                },
            });        

        });

    });

    //Mostrar mensagem de erro da validação no form.
    function printErrorMsg(msg) {
        $.each(msg, function (key, value) {
            $("." + key).addClass("is-invalid");
            $('.' + key + '_err').children("strong").text(value);
        });
    }
    /* 
      Author: Rafael Morais
      Description: Mostrar form para anexar licença
    */
    function attachLicense(protocolo) {
        $('#protocol_id').val(protocolo.id);
        $('#attach').show();
    }

    function closeModal() {
        var modal = document.getElementById("modalMore");                    
        modal.style.display = "none";
    }
 
    function checkInput() { 
        var count = document.getElementsByClassName('accordion-item');


        var i = 0;
        var id;
        var validado = true;
        console.log('1');
        for (i=0; i < count.length; i++) {
            var itensFalse = document.getElementsByClassName(`form-check-input-false-${i}`);
            var itensTrue = document.getElementsByClassName(`form-check-input-true-${i}`);

            if ((itensFalse[0]?.checked == false)  && (itensTrue[0]?.checked == false)) {
                $(`#x-${i}`).css("color", "#FF0000");
                validado = false;
            }
            else {
                // $(`#x-${i}`).css("color", "#39B51A");
            }

        }

        if (validado) {
            $('#authorize-protocol').submit();
        }

    }

    $(document).ready(function(){  
        var count = $(`input[type=radio][id=refuse]:checked`).length;
        var ref, acc;
        var i = 0;
        var idRefuse = 0;

        for (i = 0; i < count; i++) {

            idRefuse = $(`input[type=radio][id=refuse]:checked`)[i].name;
            if ($(`input[type=radio][id=refuse]:checked`).length > 0) {                
                $(`#textarea-${idRefuse}`).removeClass('d-none');    
            }               
        }
          
       
     
        $(`input[type=radio][id=refuse]`).change(function (eventRefuse) {
            console.log("i r",eventRefuse.currentTarget.className);
            ref = eventRefuse.currentTarget.className.split('-');
            if (eventRefuse.currentTarget.checked == true) {
                $(`#textarea-${ref[4]}`).removeClass('d-none');    
                    $(`#textarea-${ref[4]}`).removeClass('d-none');    
                $(`#textarea-${ref[4]}`).removeClass('d-none');    
            }
        });

        $(`input[type=radio][id=accept]`).change(function (eventAccept) {
            console.log("i a ",eventAccept.currentTarget.className);
            acc = eventAccept.currentTarget.className.split('-');
            if (eventAccept.currentTarget.checked == true) {
                $(`#textarea-${acc[4]}`).addClass('d-none');
            } 
        }); 
    S
   
    });

</script>
