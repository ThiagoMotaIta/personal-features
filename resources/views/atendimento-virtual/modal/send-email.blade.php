<div id="ModalSendMail{{$atendimento->id}}" class="modal">
    <div class="content-form">
        <form action="{{ route('atendimento-virtual.send-link', ['atendimento_virtual' => Hashids::encode($atendimento->id)]) }}" method="POST">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="position-title-card">
                        <div class="form-row">
                            <div class="col">
                                <h5 class="title-form " id="exampleModalLabel">Link para atendimento</h5>
                            </div>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" readonly name="id" value="{{$atendimento->id}}" class="form-control">
                        <div class="form-group">
                            <label for="recipient-name" class="label-form-custom">CPF:</label>
                            <input type="text" disabled value="{{$atendimento->cpf}}" class="form-control cpf">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="label-form-custom">Nome:</label>
                            <input type="text" disabled value="{{$atendimento->nome}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="label-form-custom">E-mail:</label>
                            <input type="text" disabled value="{{$atendimento->email}}" class="form-control">
                        </div>
                        @if($atendimento->status_atendimento->id == 1)
                        <div class="form-group">
                            <label for="recipient-name"
                                class="label-form-custom @error('link') is-invalid @enderror">Link:</label>
                            <input type="text" name="link" class="form-control"
                                placeholder="Informe o link que foi enviado ao seu e-mail">
                            @error('link')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row complemento-form">
                        <button type="submit" class="btn-confirm-login ">Enviar</button>
                    </div>
                        @else
                        <div class="form-group">
                            <label for="recipient-name"
                                class="label-form-custom @error('link') is-invalid @enderror">Link:</label>
                            <input type="text" name="link" class="form-control"
                                value="{{$atendimento->link}}"
                                disabled>
                        </div>
                    </div>
                    <div class="form-row complemento-form">
                        <button type="button" class="btn-confirm-login" data-bs-dismiss="modal" aria-label="Close"">Fechar</button>
                    </div>
                        @endif
                </div>
            </div>
        </form>
    </div>
</div>
