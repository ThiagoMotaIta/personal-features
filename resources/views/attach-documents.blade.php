@extends('home')

@section('content-app')
    <div class="" >
        <form method="POST" id="attach-document" action="{{ route('postAttachDocument',$documents->id)}}" enctype="multipart/form-data">
            @csrf
            <meta name="csrf-token" content="{{ csrf_token() }}">


            <!-- <div id="hehehe" >

            </div> -->



            @if (count($documents->documents) == 0)
                <div class="alert alert-success" id="" role="success">
                    Não há anexos pendentes!
                </div>

            @else
                <div class="navbar position-btn-confirm">
                    <p class="name_table">ANEXO DE DOCUMENTOS</p>
                    <a class="btn_include" href="{{ route('protocolo-virtual.index')}}"><i class="icon-space fas fa-angle-left"></i>Voltar</a>
                </div>
                <div class="positon_name_include">
                    <p class="descripttio_title">Anexando documentos referente ao Protocolo:<span class="descripttio_title_custom"> PMC{{$documents->id}}</span></p>
                </div>
                <div class="position-protocolos">
                    @foreach ($documents->documents as $document)
                        <div class="division-accordion">
                            @if($document['required'] == 1)
                                <div class="mandatory-document">* Documento obrigatório</div>
                            @endif
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <div class="accordion-header"id="headingOne">
                                        <button class="accordion-button accordion-button-custom collapsed" type="button" id="x-{{$loop->index}}"  data-bs-toggle="collapse" data-bs-target="#collapseExample-{{$document['id']}}" aria-expanded="true" aria-controls="collapseExample-{{$document['id']}}">
                                            {{ $document['name'] }}
                                        </button>

                                    </div>
                                    <div id="collapseExample-{{$document['id']}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="form-group">
                                            <div class="content-descri">
                                                <p class="licence-descrip">{{ $document['orientation'] }}</p>
                                                <p class="licence-descrip"><span class="strong-descri-card">OBS:</span> Este documento deve estar nas extensões: <span class="strong-descri-card">{{ $document['extension'] }}</span></p>
                                            </div>
                                            @if (@$document['mensagem'])
                                                <div class="alert alert-danger salve-salve" id="message-accordion-{{$loop->index}}"  style="margin-bottom: 40px;">
                                                    {{ $document['mensagem'] }}
                                                </div>
                                            @endif

                                            @if (@$document['repproved'])
                                                <div id="message-accordion-{{$loop->index}}"></div>
                                            @endif

                                            {{-- <div class="send-to-file" id="form-group-document-{{$loop->index}}">
                                                <p class="style-label-file">Realize o upload do comprovante logo abaixo:</p>
                                                <label class="button-label" for="input-document-{{$loop->index}}">Realizar Upload</label>
                                                <input class="button-send-file" type="file" id="input-document-{{$loop->index}}" name="{{$document->id}}"  value="{{$document->id}}" accept=".{{$document->extension}}" {{ ($document->required == 1)  ? 'required' : '' }}>
                                                <!-- name of file chosen -->
                                                <p id="file-chosen">Nenhum arquivo escolhido</p>
                                            </div> --}}
                                            <div class="form-group" id="form-group-document-{{$loop->index}}">

                                                @if (isset($document['file']))
                                                 <span id="archive-{{$loop->index}}" >Arquivo: <strong>{{ @$document['file'] }}</strong></span>
                                                 <div class="d-flex mt-3">
                                                    <label for="file">Clique aqui para anexar: </label>
                                                    <input type="file" id="input-document-{{$loop->index}}" name="{{$document['id']}}" value="{{$document['id']}}" accept=".{{$document['extension']}}" {{ ($document['required'] == 1)  ? 'required' : '' }}>
                                                </div>
                                                @else

                                                <div class="d-flex mt-3">
                                                    <label for="file">Clique aqui para anexar: </label>
                                                    <input type="file" id="input-document-{{$loop->index}}" name="{{$document['id']}}" value="{{$document['id']}}" accept=".{{$document['extension']}}" {{ ($document['required'] == 1)  ? 'required' : '' }}>
                                                </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="position-btn-save" onclick="enviaDocumento({{count($documents->documents)}})">
                    <button type="button" class="btn-confirm-login">Enviar dados</button>
                </div>
            @endif

        </form>


    </div>
    @if(Session::has('record_added'))
        <script>
            toastr.success("{!!Session::get('record_added')!!}", 'Sucesso!');
        </script>
    @endif
    <script type="text/javascript">
        const actualBtn = document.getElementById('input-document');

        const fileChosen = document.getElementById('file-chosen');

        // actualBtn.addEventListener('change', function () {
        //     fileChosen.textContent = this.files[0].name
        // })

        $(document).ready(function () {
            $('.nav_btn').click(function () {
                $('.mobile_nav_items').toggleClass('active');
            });
            var accordionCount = document.getElementsByClassName('accordion');
            var i = 0;
            for ( i = 0; i < accordionCount.length; i++) {
                var classRep = document.getElementById(`message-accordion-${i}`);
                if (classRep) {
                    $(`#x-${i}`).addClass('document-btn icone-lightOn');
                }
            }
        });




        function marcarTodos(marcar) {
            console.log("marcar",marcar);
            var itens = document.getElementsByClassName('form-check-input-true');

            if (marcar) {
                document.getElementById('acao').innerHTML = 'Desmarcar Todos';
            }
            else {
                document.getElementById('acao').innerHTML = 'Marcar Todos';
            }

            var i = 0;

            for(i=0; i < itens.length; i++){
                itens[i].checked = marcar;
            }
        }

        function enviaDocumento(count) {

            var validado = true;
            var i = 0;
            var inputDocumentId = [];
            var innerHTMLString = "";
            var typeDocument = [];
            var archive = [];


            for (i = 0; i < count; i++) {
                inputDocumentId[i] = document.getElementById('input-document-'+i)?.files[0];
                
                //Remover div de error da validação de tentativa do submit anterior
                $("#error-document-"+i).remove();

                if (inputDocumentId[i]?.size > 5097152) {
                    innerHTMLString = "<div class='alert alert-danger' id='error-document-"+i+"' style='margin-top:15px;'>Arquivo excedeu 5Mb</div>";
                    document.getElementById("form-group-document-"+i).innerHTML += innerHTMLString;
                    validado = false;
                } else {
                    $("#error-document-"+i).remove();
                }


            }


            for (i = 0; i < inputDocumentId.length; i++) {
                checkRequired = document.getElementById('input-document-'+i);
                typeDocument[i] = document.getElementById('input-document-'+i);
                archive = document.getElementById('archive-'+i);

                if (archive != null && (inputDocumentId[i] == undefined)) { 
                    
                }
                else {

                    if (inputDocumentId[i]?.name.includes('.pdf')) {

                        if (!typeDocument[i].accept.includes('.pdf')) {
                            innerHTMLString = "<div class='alert alert-danger' id='error-document-"+i+"' style='margin-top:15px;'>Formato do documento errado!</div>";
                            document.getElementById("form-group-document-"+i).innerHTML += innerHTMLString;
                            $(`#x-${i}`).css("color", "red");
                            validado = false;

                        }
                    }

                    else if (inputDocumentId[i]?.name.includes('.kmz')) {

                        if (!typeDocument[i].accept.includes('.kmz')) {
                            innerHTMLString = "<div class='alert alert-danger' id='error-document-"+i+"' style='margin-top:15px;'>Formato do documento errado!</div>";
                            document.getElementById("form-group-document-"+i).innerHTML += innerHTMLString;
                            $(`#x-${i}`).css("color", "red");
                            validado = false;

                        }
                    }



                    else if (inputDocumentId[i]?.name.includes('.kml')) {

                        if (!typeDocument[i].accept.includes('.kml')) {
                            innerHTMLString = "<div class='alert alert-danger' id='error-document-"+i+"' style='margin-top:15px;'>Formato do documento errado!</div>";
                            document.getElementById("form-group-document-"+i).innerHTML += innerHTMLString;
                            $(`#x-${i}`).css("color", "red");
                            validado = false;

                        }
                    }


                    else if (inputDocumentId[i]?.name.includes('.dwg')) {

                        if (!typeDocument[i].accept.includes('.dwg')) {
                            innerHTMLString = "<div class='alert alert-danger' id='error-document-"+i+"' style='margin-top:15px;'>Formato do documento errado!</div>";
                            document.getElementById("form-group-document-"+i).innerHTML += innerHTMLString;
                            $(`#x-${i}`).css("color", "red");
                            validado = false;

                        }
                    }

                    if (checkRequired.hasAttribute('required')) {
                        if ( (inputDocumentId[i]?.name.includes('.pdf')) || (inputDocumentId[i]?.name.includes('.kmz')) || (inputDocumentId[i]?.name.includes('.kml')) || (inputDocumentId[i]?.name.includes('.dwg')) ) {
                            if ((inputDocumentId[i] == undefined))   {
                                $(`#x-${i}`).css("color", "red");
                                validado = false;
                            }
                        }
                        else if ((inputDocumentId[i] == undefined))  {
                            innerHTMLString = "<div class='alert alert-danger' id='error-document-"+i+"' style='margin-top:15px;'>Não enviou nenhum arquivo</div>";
                            document.getElementById("form-group-document-"+i).innerHTML += innerHTMLString;
                            $(`#x-${i}`).css("color", "red");
                            validado = false;
                        }
                        else   {
                            innerHTMLString = "<div class='alert alert-danger' id='error-document-"+i+"' style='margin-top:15px;'>Formato do documento errado!</div>";
                            document.getElementById("form-group-document-"+i).innerHTML += innerHTMLString;
                            $(`#x-${i}`).css("color", "red");
                            validado = false;
                        }

                    }
                    else {

                        if (inputDocumentId[i]) {
                            if ( (inputDocumentId[i]?.name.includes('.pdf')) || (inputDocumentId[i]?.name.includes('.kmz')) || (inputDocumentId[i]?.name.includes('.kml'))) {
                                if ((inputDocumentId[i] == undefined))   {
                                    $(`#x-${i}`).css("color", "red");
                                    validado = false;
                                }
                            }
                            else {
                                innerHTMLString = "<div class='alert alert-danger' id='error-document-"+i+"' style='margin-top:15px;'>Formato do documento errado!</div>";
                                document.getElementById("form-group-document-"+i).innerHTML += innerHTMLString;
                                $(`#x-${i}`).css("color", "red");

                                validado = false;
                            }

                        }
                        else if (checkRequired.hasAttribute('required')) {

                            validado = false;
                        }

                    }

                }


            }


            // validado = false;
            // var data = new FormData();


            // data.append('file', id[0], id[0].name);

            // var xhr = new XMLHttpRequest();
            // // headers: {'': $('meta[name="_token"]').attr('content')}
            // // xhr.setRequestHeader("Content-Type",'multipart/form-data');
            // //post file data for upload
            // xhr.open('POST', 'save', true);
            // xhr.setRequestHeader("X-CSRF-TOKEN",  document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

            // xhr.send(data);

            // xhr.onload = function () {
            //     //get response and show the uploading status
            //     // c
            //     // var response = JSON.parse(xhr.responseText);
            //     // if(xhr.status === 200 && response.status == 'ok'){
            //     //     $("#dropBox").html("File has been uploaded successfully. Click to upload another.");
            //     // }else if(response.status == 'type_err'){
            //     //     $("#dropBox").html("Please choose an images file. Click to upload another.");
            //     // }else{
            //     //     $("#dropBox").html("Some problem occured, please try again.");
            //     // }
            // };

            if (validado) {
                //console.log("SUBMIT");
                $('#attach-document').submit();
            }


        }



    </script>
@endsection
