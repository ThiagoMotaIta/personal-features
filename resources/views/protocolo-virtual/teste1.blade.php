<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <button id="test1" type="button" class="btn btn-secondary" data-dismiss="modal">Teste 1</button>
        <button id="test2" type="button" class="btn btn-secondary" data-dismiss="modal">Teste 2</button>
      </div>
     
    </div>
  </div>
</div>
<button id="btnToTop" title="Está com dúvidas?"><i class="far fa-comment fa-2x"></i></button>

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
        $("#btnToTop").click(function(){
            $('#exampleModal').modal('show');
        });

        $("#test1").click(function(){
            
            $('#teste3').modal('show');
            $('#exampleModal').modal('hide');
            $('#test22').modal('hide');

        });

        $("#test2").click(function(){
          $('#teste3').modal('hide');
            $('#exampleModal').modal('hide');
            $('#test22').modal('show');
        });

      });

   

</script>