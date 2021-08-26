<!-- Modal -->
<div class="modal fade" id="teste3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('atendimento-virtual.store') }}" method="post">
          @csrf
          <div class="form-content ">
              <p class="title-form">AGENDAR ATENDIMENTO VIRTUAL</p>
              <div class="form-group col-md-13">
                  <label for="empreendedor" class="label-form-custom">Nome completo</label>
                  <div class="input-container">
                      <input type="text" name="nome" id="nome" onkeypress="onlyLetters()"
                          value="{{ old('nome') }}" class="form-control @error('nome') is-invalid @enderror"
                          placeholder="Digite nome completo.">
                      @error('nome')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                  </div>
              </div>
              <div class="form-group col-md-13">
                  <label for="cpf" class="label-form-custom">CPF</label>
                  <div class="input-container">
                      <input type="text" name="cpf" value="{{ old('cpf') }}"
                          class="form-control @error('cpf') is-invalid @enderror cpf"
                          placeholder="Digite seu CPF.">
                      @error('cpf')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                  </div>
              </div>
              <div class="form-group col-md-13">
                  <label for="mail" class="label-form-custom">Email</label>
                  <div class="input-container">
                      <input id="email" type="email" name="email" value="{{ old('email') }}"
                          class="form-control @error('email') is-invalid @enderror"
                          placeholder="Digite seu e-mail.">
                      <span id="errorEmail" class="invalid-feedback d-none">
                          <strong>Digite um e-mail válido</strong>
                      </span>
                      @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                  </div>
              </div>
              <div class="form-group col-md-13">
                  <label for="tel" class="label-form-custom">Telefone</label>
                  <div class="input-container">
                      <input type="text" name="telefone" value="{{ old('telefone') }}"
                          class="form-control telefone @error('telefone') is-invalid @enderror"
                          placeholder="Digite telefone.">
                      @error('telefone')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                  </div>
              </div>
              <div class="form-row">
                  <div class="form-group col-md-6">
                      <label for="licenca" class="label-form-custom">Setor</label>
                      <div class="input-container">
                          <select name="setor_id" id="setor"
                              class="form-control @error('setor_id') is-invalid @enderror" onclick="ClearInputs()">

                          </select>
                          @error('setor_id')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                      </div>
                  </div>

                  <div class="form-group col-md-6">
                      <label for="" class="label-form-custom">Número do processo</label>
                      <div class="input-container">
                          <input type="text" name="numero_processo" id="" value="{{ old('numero_processo') }}"
                              class="form-control @error('numero_processo') is-invalid @enderror" placeholder="">
                          @error('numero_processo')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                      </div>
                  </div>


              </div>

          </div>
          {{-- guarda valor do input caso error --}}
          <input id="old-setor" type="hidden" value="{{ old('setor_id') ?? ''}}">

          <div class="form-row complemento-form">
              <div class="form-group col-md-12">
                  <label for="" class="label-form-custom">Assunto</label>
                  <div class="input-container">
                      <input type="text" name="assunto" value="{{ old('assunto') }}"
                          class="form-control @error('assunto') is-invalid @enderror" placeholder="">
                      @error('assunto')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                  </div>
              </div>
          </div>

          <div class="form-row complemento-form">
              <div class="form-group col-md-6">
                  <label class="label-form-custom">Selecione a melhor data</label>
                  <div class="input-container">
                      <i id="date-icon" class="icon-password far fa-calendar"></i>
                      <input id="data_atendimento" name="data_atendimento" value="{{ old('data_atendimento') }}"
                          class="form-control  @error('data_atendimento') is-invalid @enderror" type="text"
                          placeholder="Selecione a Data:" readonly>
                      </input>

                      @error('data_atendimento')
                      <span class='invalid-feedback' role='alert'>
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                  </div>
              </div>

              <div class="form-group col-md-6">
                  <label class="label-form-custom">Selecione a melhor horário</label>
                  <i id="hour-icon" class=" icon-password far fa-clock"></i>
                  <div class="input-container">
                      <select name="hora_atendimento" id="hora_atendimento" data-icon="far fa-clock"
                          class="form-control @error('hora_atendimento') is-invalid @enderror">

                      </select>

                      @error('hora_atendimento')
                      <span class='invalid-feedback' role='alert'>
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                  </div>
              </div>
          </div>

          {{-- guarda valor do input caso error --}}
          <input id="old-data-atendimento" type="hidden" value="{{ old('data_atendimento') ?? ''}}">
          <input id="old-hora-atendimento" type="hidden" value="{{ old('hora_atendimento') ?? ''}}">

          <div class="form-row complemento-form">
              <div class="form-group col-md-12">
                  <div class="label-form-custom">
                      <label for="">Descrição</label>
                      <textarea name="mensagem" class="form-control @error('mensagem') is-invalid @enderror"
                          placeholder="Descreva sua dúvida">{{old('mensagem')}}</textarea>
                  </div>
                  @if($errors->has('mensagem'))
                  <span class="text-danger" role="alert">
                      <strong>{{ $errors->first('mensagem')}}</strong>
                  </span>
                  @endif
              </div>
          </div>
          <div class="form-row complemento-form">
              <button type="submit" class="btn-confirm-login ">Agendar</button>
          </div>
      </form>
      </div>
     
    </div>
  </div>
</div>


<script>
    
  // var modal = document.getElementById("modalCss");
  // var btn = document.getElementById("btnToTop");
  // var span = document.getElementById("closeBtn");
  // btn.onclick = function () {
  //     modal.style.display = "block";
  // }
  // span.onclick = function () {
  //     console
  //     modal.style.display = "none";
  // }
  // window.onclick = function (event) {
  //     if (event.target == modal) {
  //         modal.style.display = "none";
  //     }
  // }

 
  $(document).ready(function () {

      //Busca setores
      var old_setor = $('#old-setor').val();
      var dates = [];

      $.ajax({
          url: "/setor-virtual/" + old_setor,
          method: "GET",
          async: false,
          success: function (data) {
              $('#setor').html(data.html);
          }
      });

      $('.complemento-form').hide();

      $('#setor').change(function () {
          var id = $(this).val(); // Setor ID
          dates = [];
          if (id) {
              $.ajax({
                  url: "/horario-virtual/" + id,
                  method: "GET",
                  async: false,
                  success: function (data) {
                      // $('#data_atendimento').html(data.html);
                      for (let i = 0; i < data.html.length; ++i) {
                          dates.push(data.html[i].data.substring(0, 10));
                      }
                  }
              });

              $('.complemento-form').show();

          } else {
              $('.complemento-form').hide();
          }

      });

      $("#data_atendimento").datepicker({
          dateFormat: "dd-mm-yy",
          beforeShowDay: function (date) {
              if ($.inArray($.datepicker.formatDate('yy-mm-dd', date), dates) > -1) {
                  return [true, "", "Available"];
              } else {
                  return [false, '', "Not Available"];
              }
          }

      });
      (function (factory) {
          "use strict";

          if (typeof define === "function" && define.amd) {

              // AMD. Register as an anonymous module.
              define(["../widgets/datepicker"], factory);
          } else {

              // Browser globals
              factory(jQuery.datepicker);
          }
      })(function (datepicker) {
          "use strict";

          datepicker.regional["pt-BR"] = {
              closeText: "Fechar",
              prevText: "&#x3C;Anterior",
              nextText: "Próximo&#x3E;",
              currentText: "Hoje",
              monthNames: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
                  "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
              monthNamesShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun",
                  "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
              dayNames: [
                  "Domingo",
                  "Segunda-feira",
                  "Terça-feira",
                  "Quarta-feira",
                  "Quinta-feira",
                  "Sexta-feira",
                  "Sábado"
              ],
              dayNamesShort: ["Do", "Seg", "Ter", "Qua", "Qui", "Sex", "Sá"],
              dayNamesMin: ["Do", "Seg", "Ter", "Qua", "Qui", "Sex", "Sá"],
              weekHeader: "Sm",
              dateFormat: "dd/mm/yyyy",
              firstDay: 0,
              isRTL: false,
              showMonthAfterYear: false,
              yearSuffix: ""
          };
          datepicker.setDefaults(datepicker.regional["pt-BR"]);

          return datepicker.regional["pt-BR"];

      });


      $('#data_atendimento').change(function () {
          var old = $('#old-hora-atendimento').val();
          var setor_id = $('#setor').val();
          var data_atend = $('#data_atendimento').val();

          $.ajax({
              url: "/horario-virtual/" + setor_id + "/" + data_atend + "/" + old,
              method: "GET",
              async: false,
              success: function (data) {
                  $('#hora_atendimento').html(data.html);
              }
          });
      });

      $('#setor').change();
      $('#data_atendimento').change();


  });
  function onlyLetters() {
      if ((event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode > 191 && event.charCode < 219) || (event.charCode > 223 && event.charCode < 252) || (event.charCode == 32)) {

      }
      else {
          event.preventDefault();
      }
  }

  $(document).ready(function () {
      $("input[type=email][name=email]").blur(function () {
          var valid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          var email = $("#email").val();

          console.log(email);
          if (!valid.test(email)) {
              $('#email').addClass('is-invalid');
              $('#errorEmail').removeClass('d-none');
          }
          else {
              $('#email').removeClass('is-invalid');
              $('#errorEmail').addClass('d-none');
          }
      });
  });

  function ClearInputs(){
      $('#data_atendimento').datepicker( "setDate", "" );
  }

</script>