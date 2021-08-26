<div id="ModalSendMail" class="modal">
    <div class="content-form">
        <form id="ouvidoriaForm">
            @csrf
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="position-title-card">
                        <div class="form-row">
                            <div class="col">
                                <h5 class="title-form">Fale Conosco: <span class="ouvidoria_id"></span></h5>
                            </div>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">
                        {{-- sendo utilizado no ajax pegando id --}}
                        <input type="hidden" id="ouvidoria_id">
                        <div class="form-group">
                            <label for="recipient-name" class="label-form-custom">Usuário:</label>
                            <input type="text" id="nome" disabled class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="label-form-custom">E-mail:</label>
                            <input type="text" id="email" disabled class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="label-form-custom">Telefone:</label>
                            <input type="text" id="telefone" disabled class="form-control telefone">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="label-form-custom">Assunto:</label>
                            <input type="text" id="assunto" disabled class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="label-form-custom">Mensagem:</label>
                            <div class="input-container">
                                <textarea type="text" id="mensagem" disabled class="form-control" rows="5"></textarea>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="resposta" class="label-form-custom">Resposta</label>
                                <div class="input-container">
                                    <textarea type="text" id="resposta" name="resposta" class="form-control resposta"
                                        rows="5"></textarea>

                                    <span class="invalid-feedback resposta_err" role="alert">
                                        <strong></strong>
                                    </span>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row complemento-form">
                        <button type="submit" id="enviarResposta" class="btn-confirm-login">Enviar</button>
                        <button type="button" id="fecharModal" class="btn-confirm-login" data-bs-dismiss="modal" aria-label="Close">Fechar</button>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>
