<form id="form_{{$protocolo->id}}" action="{{ route('protocolo-virtual.destroy', ['protocolo_virtual' => Hashids::encode($protocolo->id)]) }}" method="POST">
  @csrf
  @method('delete')
  <div class="modal modal-confirm fade" id="ModalDelete{{$protocolo->id}}" tabindex="-1" aria-labelledby="wanna-save" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="positon-btn-close">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="position-contetn-modal">
                  <p class="content-modal">Deseja arquivar o protocolo?</p>
              </div>
              <div class="position-btn-confirm">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                  <button type="submit" class="btn btn-primary">Sim</button>
              </div>
          </div>
      </div>
  </div>
</form>