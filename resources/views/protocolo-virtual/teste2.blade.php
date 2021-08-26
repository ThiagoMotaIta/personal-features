<!-- Modal -->
<div class="modal fade" id="test22" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('protocolo-virtual.licenca')}}" method="GET">
          <div class="row">
              <div class="col-md-4">
                  <label class="label-form-custom">Nº da licença</label>
                  <input type="text" name="licenca" class="form-control">
              </div>
              <div class="navbar position-btn-confirm">
                  <button class="btn_include btn-search" type="submit"><i class="icon-space fas fa-search"></i>Pesquisar</button>
                  
              </div>
          </div>
      </form>
      
      <div class="row">
          <div class="navbar position-btn-confirm">
              <a class="btn_include btn-search" href="{{route('protocolo-virtual.licenca')}}">Limpar Consulta</a>
          </div>
      </div>
      
      
      @if(isset($_GET['licenca']))
        @if(isset($protocolo_virtuais->id))
        @php
          $id = Hashids::encode($protocolo_virtuais->id);
        @endphp
        <script type="text/javascript">
          $( document ).ready(function() {
              $('#licenca').modal('show');
          });
        </script>
        
      
        {!! QrCode::format('svg')->size(150)->errorCorrection('H')->generate(Request::getHttpHost() . '/protocolo-virtual/' . $id . '/exportar-pdf') !!}  
        @else
        <h2>Licença não encontrada</h2>
        @endif
      @endif
      
      {{-- <!-- Modal -->
      <div class="modal modal-confirm fade" id="licenca" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="positon-btn-close">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="position-contetn-modal">
                  @if(isset($protocolo_virtuais->id))
                    {!! QrCode::format('svg')->size(150)->errorCorrection('H')->generate(Request::getHttpHost() . '/protocolo-virtual/' . $id . '/exportar-pdf') !!}  
                  @endif
                </div>
            </div>
        </div>
      </div> --}}
      
      
      <script type="text/javascript">
        
      </script>
      </div>
     
    </div>
  </div>
</div>