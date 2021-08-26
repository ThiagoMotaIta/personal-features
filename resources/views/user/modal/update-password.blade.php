<div class="modal fade" id="ModalUpdateSenha" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="position-title-card">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <p class="title-card">Atualizar Senha</p>
            </div>
            <div class="modal-body">
                <div id="form-update-senha">

                </div>
                <form method="POST" id="updateSenhaForm">
                    @csrf
                    <div class="form-group col-md-12">
                        <label class="label-form-custom" for="name">CPF</label>
                        <div class="input-container">
                            <input type="text" disabled name="cpfUpsenha" id="cpfUpsenha" value="{{ Auth::user()->cpf }}" class="form-control cpfMostra">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="label-form-custom" for="name">Nome</label>
                        <div class="input-container">
                            <input type="text" disabled id="nameUpsenha" name="nameUpsenha" value="{{ Auth::user()->name }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="label-form-custom" for="name">E-mail</label>
                        <div class="input-container">
                            <input type="text" disabled name="emailUpsenha" value="{{ Auth::user()->email }}" id="emailUpsenha" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="label-form-custom" for="name">Perfil</label>
                        <div class="input-container">
                            <input type="text" disabled name="perfilUpsenha" value="{{old('perfilUpsenha')}}" id="perfilUpsenha" class="form-control">
                        </div>
                    </div>
                    @if(Auth::user()->tipo == 1)
                    <div class="form-group col-md-12">
                        <label class="label-form-custom" for="name">Telefone</label>
                        <div class="input-container">
                            <input type="text" disabled name="telefoneUpsenha" value="{{ Auth::user()->telefone }}" id="telefoneUpsenha" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="label-form-custom" for="name">CEP</label>
                        <div class="input-container">
                            <input type="text" disabled name="cepUpsenha" value="{{ Auth::user()->cep }}" id="cepUpsenha" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="label-form-custom" for="name">Endereço</label>
                        <div class="input-container">
                            <input type="text" disabled name="enderecoUpsenha" value="{{ Auth::user()->endereco }}" id="enderecoUpsenha" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="label-form-custom" for="name">Número</label>
                        <div class="input-container">
                            <input type="text" disabled name="numeroUpsenha" value="{{ Auth::user()->numero }}" id="numeroUpsenha" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="label-form-custom" for="name">Complemento</label>
                        <div class="input-container">
                            <input type="text" disabled name="complementoUpsenha" value="{{ Auth::user()->complemento }}" id="complementoUpsenha" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="label-form-custom" for="name">Bairro</label>
                        <div class="input-container">
                            <input type="text" disabled name="bairroUpsenha" value="{{ Auth::user()->bairro }}" id="bairroUpsenha" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="label-form-custom" for="name">Cidade</label>
                        <div class="input-container">
                            <input type="text" disabled name="cidadeUpsenha" value="{{ Auth::user()->cidade }}" id="cidadeUpsenha" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="label-form-custom" for="name">UF</label>
                        <div class="input-container">
                            <input type="text" disabled name="ufUpsenha" value="{{ Auth::user()->uf }}" id="ufUpsenha" class="form-control">
                        </div>
                    </div>
                    @endif
                    <div class="form-group col-md-12">
                        <label onclick="tooglePassword('atual')" class="label-form-custom" for="old_password">Senha Atual</label>
                        <div class="input-container">
                            <i onclick="tooglePassword('atual')" id="old_password_view" class="icon-password far fa-eye-slash"></i>
                            <input type="password" name="old_password" value="{{old('old_password')}}" class="form-control" id="old_password" placeholder="Digite sua senha atual">
                            <span class="invalid-feedback" role="alert" id="old_password_err">
                                <strong></strong>
                            </span>                         
                        </div>

                        
                        
                    </div>
                    <div class="form-group col-md-12">
                        <label onclick="tooglePassword('nova')" class="label-form-custom" for="password">Nova Senha</label>
                        <div class="input-container">
                            <i onclick="tooglePassword('nova')" id="password_view" class="icon-password far fa-eye-slash"></i>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Digite sua nova senha ">
                            <span class="invalid-feedback" role="alert" id="password_err">
                                 <strong></strong>
                            </span>
                        </div>
                        
                    </div>
                    <div class="form-group col-md-12">
                        <label onclick="tooglePassword('confirmar')"class="label-form-custom" for="password_confirmation">Confirmar Senha</label>
                        <div class="input-container">
                            <i onclick="tooglePassword('confirmar')" id="password_confirmation_view" class="icon-password far fa-eye-slash"></i>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirme sua nova senha">
                            <span class="invalid-feedback" role="alert" id="password_confirmation_err">
                                <strong></strong>
                            </span>
                        </div>
                        
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="positon-card-edit-profile">
                                <button type="submit" class="btn-confirm-login btn-submit-update-pswd">Alterar Senha</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            {{-- <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Send message</button>
            </div> --}}
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal modal-confirm fade" id="ModalSenhaAtualizada" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="position-contetn-modal">
                <p class="content-modal">Senha Atualizada!</p>
            </div>
            <button type="button" id="ModalSenhaAtualizadaCloses" class="btn-confirm-login confirm-senha-atualizada" data-bs-dismiss="modal" aria-label="Close">OK</button>
        </div>
    </div>
</div>

<script type="text/javascript">
     function tooglePassword(x) {
         if(x == 'atual'){
            var senha = document.getElementById("old_password");
            if (senha.type === "password") {
                senha.type = "text";
                console.log('antigo');
                $('#old_password_view').removeClass('fa-eye-slash');
                $('#old_password_view').addClass('fa-eye');
            } else {
                senha.type = "password";
                $('#old_password_view').removeClass('fa-eye');
                $('#old_password_view').addClass('fa-eye-slash');
            }
         }
         else if(x == "nova"){
            var senha = document.getElementById("password");
            if (senha.type === "password") {
                senha.type = "text";
                $('#password_view').removeClass('fa-eye-slash');
                $('#password_view').addClass('fa-eye');
            } else {
                senha.type = "password";
                $('#password_view').removeClass('fa-eye');
                $('#password_view').addClass('fa-eye-slash');
            }
         }
         else if(x =="confirmar"){
            var senha = document.getElementById("password_confirmation");
            if (senha.type === "password") {
                senha.type = "text";
                $('#password_confirmation_view').removeClass('fa-eye-slash');
                $('#password_confirmation_view').addClass('fa-eye');
            } else {
                senha.type = "password";
                $('#password_confirmation_view').removeClass('fa-eye');
                $('#password_confirmation_view').addClass('fa-eye-slash');
            }
         }
     };
    $(document).ready(function () {
        
        $("#ModalSenhaAtualizadaClose").click(function(){
            location.reload();
        });

        $('#updateSenhaForm').submit(function (e) {
            e.preventDefault();
            let formData = $(this).serializeArray();

            // var _token = $("input[name='_token']").val();
            // var old_password = $("input[name='old_password']").val();
            // var password = $("input[name='password']").val();
            // var password_confirmation = $("input[name='password_confirmation']").val();

            $('.error-text').text('');
            $('input').removeClass("is-invalid");

            $.ajax({
                url: "{{ route('update.password') }}",
                type: 'POST',
                // data: {
                //     _token: _token,
                //     old_password: old_password,
                //     password: password,
                //     password_confirmation: password_confirmation,
                // },
                data: formData,    
                success: function (data) {
                    if ($.isEmptyObject(data.error)) {
                        $('#ModalUpdateSenha').modal('hide');
                        $('#ModalSenhaAtualizada').modal('show');
                        //window.location.href = '{{route("protocolo-virtual.index")}}';
                    } else {
                        console.log(data.error);
                        printErrorMsg(data.error);
                    }
                }
            });

        });

        function printErrorMsg(msg) {
            $.each(msg, function (key, value) {
                $("#" + key).addClass("is-invalid");
                $('#' + key + '_err').children("strong").text(value);
                $('#' + key + '_view').addClass('icon-error');
                $('#' + key + '_view').removeClass('icon-password');   
            });
        }

        $(".confirm-senha-atualizada").click(function () {
            $("input[name='old_password']").val('');
            $("input[name='password']").val('');
            $("input[name='password_confirmation']").val('');
        });

        $("#update-password").click(function(){
                //Usuario logado pega no elemento na home.blade
                var id = $('#id_user').val();
                $.ajax({
                    url: "user/" + id + "/editPassword",
                    method: "GET",
                    async: false,
                    success: function (data) {

                        $('#cpfUpsenha').val(data.cpf);
                        $('#bairroUpsenha').val(data.bairro);
                        $('#cepUpsenha').val(data.cep);
                        $('#cidadeUpsenha').val(data.cidade);
                        $('#complementoUpsenha').val(data.complemento);
                        $('#emailUpsenha').val(data.email);
                        $('#enderecoUpsenha').val(data.endereco);
                        $('#nameUpsenha').val(data.name);
                        $('#numeroUpsenha').val(data.numero);
                        $('#idUpsenha').val(data.id);
                        $('#perfilUpsenha').val(data.profile.name);
                        $('#telefoneUpsenha').val(data.telefone);
                        $('#ufUpsenha').val(data.uf);
                    }
                });

                $('#ModalUpdateSenha').modal('show');
        });



    });

</script>
