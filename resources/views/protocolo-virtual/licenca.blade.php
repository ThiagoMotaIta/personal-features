<div class="modal fade" id="modalConsult" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="position-title-card">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">Licença</h5>
            </div>
            <div class="modal-body">
                <form id="registerForm" method="GET">
                    @csrf
                    <div class="position_content_search">
                        <div class="input-container modal-n">
                            <label for="licenca" class="label-form-custom">Pesquisar Licença</label>
                            <input type="text" name="licenca" id="licenca" placeholder="Digite o código de Licença Ex:(PMC0000)" class="form-control form-control">
                        </div>
                        <button class="tresh-btn btn-bigSize edit-btn" id="submitLicenca" type="submit"><span class="tooltiptext">pesquisar licença</span><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $(function () {
        $('#registerForm').submit(function (e) {
            e.preventDefault();
            var id = $('#licenca').val();
            if (id) {
                console.log(id);
                $.ajax({
                    url: "/protocolo-virtual/licenca/" + id,
                    method: "GET",
                    async: false,
                    success: function (data) {
                        console.log(data);
                        if (data.licenca) {
                            // $('#modalPlim').modal('show');
                            Swal.fire({
                                icon: "success",
                                title: "<h2>Licença encontrada</h2>",
                                html: data.html,
                            });
                            $('#gerada').html(data.html);
                            $('#gerada').show();
                            $('#nao-gerada').hide();

                        } else {
                            Swal.fire({
                                icon: "error",
                                html: " <h2>Licença não encontrada</h2>",
                            });
                            $('#gerada').hide();
                            // $('#modalPlim').modal('show');
                            $('#nao-gerada').show();
                        }
                    }
                });
            }
        });
    });

</script>
