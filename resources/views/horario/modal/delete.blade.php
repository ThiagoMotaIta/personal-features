<form id="form_{{$horario->id}}" action="{{ route('horario.destroy', ['id' => Hashids::encode($horario->id)]) }}" method="POST">
  @csrf
  @method('delete')
  <div class="modal modal-confirm fade" id="ModalDelete{{$horario->id}}" tabindex="-1" aria-labelledby="wanna-save" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="positon-btn-close">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="position-contetn-modal">
                  <p class="content-modal">Deseja deletar o horário?</p>
              </div>
              <div class="position-bottons">
                  <button type="button" class="btn-back btn-confirm-login" data-bs-dismiss="modal">Não</button>
                  <button type="submit" class="btn-confirm-login">Sim</button>
              </div>
          </div>
      </div>
  </div>
</form>