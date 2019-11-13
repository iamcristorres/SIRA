<?php 
$historial_periodo=App\historial_periodo::where('periodo_anual',$institucion->ANO_ACTIVO)->first();
?>
<div id="psubidalogros" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Subida de Logros</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="{{route('SaveNewLogro')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
      <div class="modal-body">
        <div class="row">
            <div class="col-md-3">
               <label for="periodo">Periodo:</label>
               <select class="form-control" id="periodo" name="periodo">
               <option value="1">1</option>
               <option value="2">2</option>
               <option value="3">3</option>
               <option value="4">4</option>
               </select>
            </div>
            <div class="col-md-3">
               <label for="tlogro">Logro:</label>
               <select class="form-control" id="tlogro" name="tlogro">
               <option value="SABER">SABER</option>
               <option value="HACER">HACER</option>
               <option value="SER">SER</option>
               </select>
            </div>
        </div>

        <div class="row my-3">
        <div class="col-md-12">
        <label for="description">Descripción del logro</label>
        <textarea id="description" name="description" class="md-textarea form-control" rows="3"></textarea>
        </div>
        </div>
        <input type="hidden" value="{{$asignatura->id}}" id="id_asignature" name="id_asignature">
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Enviar</button>
        </form>
      </div>
    </div>

  </div>
</div>