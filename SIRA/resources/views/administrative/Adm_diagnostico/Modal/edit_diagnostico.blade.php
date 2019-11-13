<div id="edit_diagnostico" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edicion de Diagnostico</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="{{route('SaveEditionDiag')}}" method="post" enctype="multipart/form-data">
      {!!csrf_field()!!}
      <div class="modal-body">

        <div class="row">
          <div class="col-md-4">
           <label for="periodo">Periodo:</label>
               <select class="form-control" id="periodo_e" name="periodo">
               <option value="1">1</option>
               <option value="2">2</option>
               <option value="3">3</option>
               <option value="4">4</option>
               </select>
          </div>
        </div>
        <div class="row my-3">
          <div class="col-md-3">
           {!!Form::label("FECHA DE CORTE",null,['class' => 'textsm'])!!}
           {!!Form::date('fc', null, ['class' => 'form-control',"id"=>"fc_e"])!!}
           </div>
          <div class="col-md-3">
           {!!Form::label("FECHA DE APERTURA",null,['class' => 'textsm'])!!}
           {!!Form::date('fa', null, ['class' => 'form-control',"id"=>"fa_e"])!!}
          </div>
          <div class="col-md-3">
           {!!Form::label("FECHA DE CIERRE",null,['class' => 'textsm'])!!}
           {!!Form::date('fcc',null, ['class' => 'form-control',"id"=>"fcc_e"])!!}
          </div>
          <div class="col-md-3">
           {!!Form::label("FECHA PUBLICA",null,['class' => 'textsm'])!!}
           {!!Form::date('fcp',null, ['class' => 'form-control',"id"=>"fcp_e"])!!}
          </div>
        </div>
        <input type="hidden" id="id_diagnostico" value="" name="id_diagnostico">
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Guardar</button>
        </form>
      </div>
    </div>

  </div>
</div>