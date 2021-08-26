<div class="modal fade" id="modalFalaConosco" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="position-title-card">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title">Fale Conosco</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('ouvidoria.store') }}" method="post">
                    @csrf
                    <div class="form-content">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" id="checkAnonimo" name="anonymousFC[]" @if (!empty(old('anonymousFC'))) checked @endif>
                                  <label class="form-check-label" for="flexCheckDefault">
                                    Usuário Anônimo
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row groupAnonimo">
                        <div class="form-group col-md-6">
                            <label for="nomeFC" class="label-form-custom">Nome completo</label>
                            <div class="input-container">
                                <input type="text" name="nomeFC" id="nomeFC" onkeypress="onlyLetters()" value="{{ old('nomeFC') }}" class="form-control @error('nomeFC') is-invalid @enderror" placeholder="Digite nome completo.">
                                @error('nomeFC')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cpfFC" class="label-form-custom">CPF</label>
                            <div class="input-container">
                                <input id="cpfFC" type="text" name="cpfFC" value="{{ old('cpfFC') }}" class="form-control cpf @error('cpfFC') is-invalid @enderror" placeholder="Digite seu CPF.">
                                @error('cpfFC')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div id="size-email" class="form-group col-md-8">
                            <label for="emailFC" class="label-form-custom">Email</label>
                            <div class="input-container">
                                <input id="emailFC" type="text" name="emailFC" value="{{ old('emailFC') }}" class="form-control @error('emailFC') is-invalid @enderror" placeholder="Digite seu e-mail.">
                                <span id="errorEmail" class="invalid-feedback d-none">
                                    <strong>Informe um e-mail válido</strong>
                                </span>
                                @error('emailFC')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-4 groupAnonimo">
                            <label for="telefoneFC" class="label-form-custom">Telefone</label>
                            <div class="input-container">
                                <input id="telefoneFC" type="text" name="telefoneFC" value="{{ old('telefoneFC') }}" class="form-control telefone @error('telefoneFC') is-invalid @enderror" placeholder="Digite telefone.">
                                @error('telefoneFC')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="reclamacaoFC" class="label-form-custom">Tipo de Assunto</label>
                            <div class="input-container">
                                <i class="@error('reclamacaoFC') icon-error @enderror icon-password icon-password fas fa-chevron-down fa-sm"></i>
                                <select name="reclamacaoFC" id="reclamacaoFC" class="form-control @error('reclamacaoFC') is-invalid @enderror">

                                </select>
                                @error('reclamacaoFC')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- Quarda o valor old do tipo de assunto --}}
                    <input id="old-assunto" type="hidden" value="{{ old('reclamacaoFC') ?? ''}}">

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="mensagem" class="label-form-custom">Mensagem</label>
                            <div class="input-container">
                                <textarea type="text" name="mensagemFC" id="mensagem" class="form-control @error('mensagemFC') is-invalid @enderror" rows="5">{{old('mensagemFC')}}</textarea>
                                @error('mensagemFC')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <button type="submit" class="btn-confirm-login ">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<script>
    $(function(){
        var old_assunto = $('#old-assunto').val();

        $.ajax({
            url: "assunto/" + old_assunto,
            method: "GET",
            async: false,
            success: function (data) {
                $('#reclamacaoFC').html(data.html);
            }
        });

        //$('#reclamacao').change();
    });

    var checkAnonymousForm = function(){
        if($('#checkAnonimo').is(":checked")){
            $('.groupAnonimo').hide('slow');
            $('#nomeFC').val('');
            $('#cpfFC').val('');
            $('#telefoneFC').val('');
            $('#size-email').removeClass('col-md-8'); 
            $('#size-email').addClass('col-md-12');
        }else{
            $('.groupAnonimo').show('slow');
            $('#size-email').addClass('col-md-8');
            $('#size-email').removeClass('col-md-12'); 
        }
    }

    $('#checkAnonimo').change(function(){
        checkAnonymousForm();
    });

    $(document).ready(function(){
        checkAnonymousForm();
    });
</script>