@extends('home')

@section('content-app')

    <div class="positon-btn-back">
        <a class="btn_include" href="{{ isset($protocoloVirtual->id) ? route('protocolo-virtual.index') : route('protocolo-virtual.listar')}}"><i class="icon-space fas fa-angle-left"></i>Voltar</a>
    </div>
    <div class="card card-custom">
        <div class="position-title-card">
            <p class="title-card">ABRIR PROTOCOLO VIRTUAL - EDITAR</p>
        </div>
        @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif
        @component('protocolo-virtual._components.form_create_edit', [
        'user_id' => $user_id,
        'tipo_licencas' => $tipo_licencas,
        'protocoloVirtual' => $protocoloVirtual,
        'status_protocolos' => $status_protocolos,
        ])
        @endcomponent
    </div>

  <!-- Modal -->
    <div class="modal modal-confirm fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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


    <script src="{{ asset('js/esconde-campos-form-protocolo.js') }}"></script>

@endsection
