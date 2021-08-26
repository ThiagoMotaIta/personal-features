@extends('home')

@section('content-app')

    <div class="positon-btn-back">
        <a class="btn_include" href="{{ route('horario.index')}}"><i class="icon-space fas fa-angle-left"></i>Voltar</a>
    </div>
    <div class="card card-custom">
        <div class="position-title-card">
            <p class="title-card">Adicionar Horários</p>
        </div>

        @component('horario._components.form_create_edit', compact('user_id','setores'))

        @endcomponent
    </div>

  <!-- Modal -->
    <div class="modal modal-confirm fade" id="ModalInsertHorario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="positon-btn-close">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="position-contetn-modal">
                    <p class="content-modal">Confimar envio dos dados?</p>
                </div>
                <div class="position-bottons">
                    <button type="button" class="btn-back btn-confirm-login" data-bs-dismiss="modal">Não</button>
                    <button type="submit" id="btnYes" class="btn-confirm-login">Sim</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(function(){
            $('#btnYes').click(function() {
                $('#form-horario').submit();
            });
        });
    </script>

@endsection
