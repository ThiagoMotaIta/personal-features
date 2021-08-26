@extends('home')

{{-- Rota apenas para administradores --}}
@if(Auth::user()->tipo == 1)
    <script>
        window.location.href = '{{route("protocolo-virtual.index")}}';
    </script>
@endif

@section('content-app')

<div class="positon_name_include">
    <p class="name_table">Fale conosco</p>
</div>

<form action="{{route('ouvidoria.index')}}" method="GET">
    <div class="position_content_search">
        <div class="position_content_inputs">
            <div class="position-inside-input">
                <label for="tipo_assunto" class="label-form-custom">Assunto</label>
                <select id="tipo_assunto" name="tipo_assunto" class="form-control form-select">
                    <option  value="" disabled selected>Selecione</option>
                    @foreach ($tipo_assunto as $assunto)
                    @php
                        $descricao = mb_convert_case($assunto->descricao, MB_CASE_TITLE, "UTF-8");
                    @endphp
                    <option value="{{ $assunto->id }}">{{ $descricao }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="position_content_inputs">
            <div class="position-inside-input">
                <label for="status" class="label-form-custom">Status</label>
                <select id="status" name="status" class="form-control form-select">
                    <option value="" disabled selected>Selecione</option>
                    <option value="1">Em aberto</option>
                    <option value="2">Concluído</option>
                </select>
            </div>
        </div>
        <div class="position-inside-input">
            <button class="tresh-btn edit-btn btn-bigSize" type="submit" title="Pesquisar"><span class="tooltiptext">Pesquisar feedback específico</span><i class="fas fa-search"></i></button>
        </div>
    </div>
</form>


<div class="navbar position-btn-confirm">
    <a class="btn_include btn-more-space" href="{{route('ouvidoria.index')}}">Limpar Consulta</a>
</div>

@if($ouvidorias->isNotEmpty())
<table class="table table-custom">
    <thead class="thead-dark">
        <tr>
          <th scope="col">Nº do atendimento</th>
          <th scope="col">Usuário</th>
          <th scope="col">E-mail</th>
          <th scope="col">Assunto</th>
          <th scope="col">Status</th>
          <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ouvidorias as $ouvidoria)
        <tr>
          <td>{{ $ouvidoria->id}}</td>
          <td>{{ $ouvidoria->nome }}</td>
          <td>{{ $ouvidoria->email }}</td>
          @php
            $descricao = mb_convert_case($ouvidoria->assuntoTipo->descricao, MB_CASE_TITLE, "UTF-8");
          @endphp
          <td>{{ $descricao }}</td>
          @php
            $descricao = ucfirst(strtolower($ouvidoria->status->descricao));
          @endphp
          <td>{{ $descricao }}</td>
          @can('fale-conosco-create')
          <td>
            <div class="positon-icons-table">
                {{-- ID do Fale conosco. utilizado nos Ajaxs --}}
                <span style="display: none">{{ Hashids::encode($ouvidoria->id) }}</span>
                <a class="tresh-btn edit-btn ModalSendMailButton" title="Mais detalhes"><i class="fas fa-plus-circle"></i></a>
            </div>
          </td>
          @endcan
        </tr>



        @endforeach
        <tr>
            <td class="tfoot-align" colspan="8">
                <span class="icon-space descripttio_title_custom">Legenda:</span>
                <span class="icon-space"><i class="icon-space tfoot-edit fas fa-plus-circle"></i>Detalhes</span>
            </td>
        </tr>
    </tbody>
</table>

<!-- Modal -->
@include('ouvidoria.modal.send-email')

@else

<table class="table table-custom">
    <thead class="thead-dark">
        <tr>
          <th scope="col">Nº do atendimento</th>
          <th scope="col">Usuário</th>
          <th scope="col">E-mail</th>
          <th scope="col">Assunto</th>
          <th scope="col">Status</th>
          <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th class="position-title-card" colspan="12">Nenhum contato com a ouvidoria encontrado!</th>
        </tr>
    </tbody>
</table>

@endif

{{-- Mensagem de successo ao enviar respota --}}
@if(Session::has('record_added'))
    <script>
        toastr.success("{!!Session::get('record_added')!!}", 'Sucesso!');
    </script>
@endif

<div class="d-flex">
    {{ $ouvidorias->appends($request)->links() }}
</div>

<script>
    $(function(){
        //Busca dados do serviço a ser editado
        $(".ModalSendMailButton").click(function () {
            $('*').removeClass("is-invalid");
            var id = $(this).siblings('span').text();
            $.ajax({
                url: "ouvidoria/" + id + "/edit",
                method: "GET",
                dataType: 'json',
                async: true,
                success: function (data) {
                    $('.ouvidoria_id').html(data.id);
                    $('#ouvidoria_id').val(data.id);
                    $('#nome').val(data.nome);
                    $('#email').val(data.email);
                    $('#telefone').val(data.telefone);
                    $('#assunto ').val(data.assunto_tipo.descricao);
                    $('#mensagem').val(data.mensagem);

                    if(data.status_id == 2){
                        $("#resposta").val(data.resposta);
                        $("#resposta").prop('disabled', true);
                        $("#enviarResposta").hide();
                        $("#fecharModal").show();
                    }else{
                        $("#resposta").val('');
                        $("#resposta").prop('disabled', false);
                        $("#enviarResposta").show();
                        $("#fecharModal").hide();
                    }

                }
            });

            $('#ModalSendMail').modal('show');

        });

        //Enviar dados do form para o controller para inserção
        $('#ouvidoriaForm').submit(function (e) {
                //$("#servicoForm").submit();
                e.preventDefault();
                let formData = $(this).serializeArray();
                var id = $('#ouvidoria_id').val();

                $('*').removeClass("is-invalid");

                $.ajax({
                    url: 'ouvidoria/' + id + '/send-mensagem',
                    type: 'POST',
                    dataType: 'json',
                    data: formData,
                    success: function (data) {
                        if ($.isEmptyObject(data.error)) {
                            location.reload();
                            //window.location.href = "{{route('ouvidoria.index')}}";
                        } else {
                            printErrorMsg(data.error);
                        }
                    }
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
  </script>

@endsection


