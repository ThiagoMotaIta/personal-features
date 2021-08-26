<!-- Button trigger modal -->

<button id="btnToTop" type="button" class="btn btn-primary" data-toggle="modal">
    <i class="fas fa-question fa-2x"></i>
</button>
<button id="modalConsultId" type="button" class="btn btn-primary" data-toggle="modal">
    <i class="fas fa-search-plus fa-2x"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="modalSelect" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Serviços</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body position-bottons">
            <button id="modalAtendimentoId" class="btn_include btn_select"><i class="icon-space fas fa-headset fa-2x"></i>Atendimento</button>
            <!-- <button id="modalConsultId" class="btn_include btn_select" ><i class="icon-space fas fa-search-plus fa-2x"></i>Verificar Nº protocolo</button> -->
            <button id="modalFalaConoscoId" class="btn_include btn_select" ><i class="icon-space far fa-comment fa-2x"></i>Fale Conosco</button>
        </div>
      </div>
    </div>
</div>
