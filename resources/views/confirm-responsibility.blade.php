@extends('home')

@section('content-app')

    <div class="">
        <form method="POST" id="confirm-responsiblity" action="{{ route('postConfirmResponsibility',['id' => count($protocoloVirtuais) ] )}}">
            @csrf
            @if (isset($message))
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @endif

            @if (count($protocoloVirtuais) == 0)
                <div class="alert alert-success" role="success">
                    Não há protocolos pendentes!
                </div>

            @else

                <div class="positon_name_include">
                    <p class="name_table">CONFIRMAR RESPONSABILIDADE</p>
                </div>
                <div class="position-btn-include">
                    <a class="btn_include btn-more-space" href="{{ route('protocolo-virtual.index')}}">
                        <i class="icon-space fa fa-plus-circle"></i>
                        Ver todos protocolos
                    </a>
                </div>

                <div class="position-btn-save">
                    <input type="checkbox" id="markall" name="markall" onclick="marcarTodos(this.checked)">  <span id="acao">Confirmar todas as pendências</span> <br>
                </div>
                <div class="position-protocolos">
                @foreach ($protocoloVirtuais as $protocolos)
                    <div class="division-accordion">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <div class="accordion-header"id="headingOne">
                                    <button class="accordion-button accordion-button-custom collapsed" type="button" id="x-{{$loop->index}}"  data-bs-toggle="collapse" data-bs-target="#collapseOne-{{$protocolos->id}}" aria-expanded="true" aria-controls="collapseOne-{{$protocolos->id}}">
                                        PMC{{$protocolos->id}}
                                    </button>

                                </div>
                                <div id="collapseOne-{{$protocolos->id}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="form-group">
                                        <div class="content-descri">
                                            <p class="licence-descrip"> Quem solicitou essa licença: <span class="strong-descri-card">{{ @$protocolos->userRequerente->name  }}</span></p>
                                            <p class="licence-descrip">Tipo de licença: <span class="strong-descri-card">{{ $protocolos->tipoLicenca->descricao }}</span></p>
                                        </div>
                                        <input class="form-check-input-true" type="radio" name="{{$loop->index}}" id="id1" value="{{$protocolos->id}}-true">
                                        <label class="form-check-label check-label-custom" for="protocolo-radio-{{$protocolos->id}}">Confirmar Protocolo</label>
                                        <input class="form-check-input-false" type="radio" name="{{$loop->index}}" id="id2" value="{{$protocolos->id}}-false">
                                        <label class="form-check-label" for="protocolo-radio-{{$protocolos->id}}">Rejeitar Protocolo</label>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
                <div class="position-btn-save">
                    <a onclick="checarMark()" class="btn-confirm-login">Salvar</a>
                </div>
            @endif

        </form>


    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.nav_btn').click(function () {
                $('.mobile_nav_items').toggleClass('active');
            });
        });

        function marcarTodos(marcar) {
            console.log("marcar",marcar);
            var itens = document.getElementsByClassName('form-check-input-true');

            if (marcar) {
                document.getElementById('acao').innerHTML = 'Desmarcar Todos';
            }
            else {
                document.getElementById('acao').innerHTML = 'Confirmar todas as pendências';
            }

            var i = 0;

            for(i=0; i < itens.length; i++){
                itens[i].checked = marcar;
            }
        }

        function checarMark(dados) {
            var itensFalse = document.getElementsByClassName('form-check-input-false');
            var itensTrue = document.getElementsByClassName('form-check-input-true');

            var i = 0;
            var id;
            var validado = true;
            var marked = 0;
            totalItens = itensFalse.length;

            for (i=0; i < totalItens; i++) {
                id = document.getElementById('x-'+i);
                if ((itensFalse[i].checked == false) && (itensTrue[i].checked == false)) {
                    // $(`#x-${i}`).css("color", "#FF0000");
                    // validado = false;
                }
                else {
                    marked++;

                    // $(`#x-${i}`).css("color", "#39B51A");
                }

            }
            
            if (marked > 0) {
                $('#confirm-responsiblity').submit();
            }

        }



    </script>

@endsection


