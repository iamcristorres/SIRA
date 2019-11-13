<div id="create_new_diagnostico" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Iniciar Nuevo Registro de Diagnosticos</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="{{route('SaveNewDiagCod')}}" method="post" enctype="multipart/form-data">
      {!!csrf_field()!!}
      <div class="modal-body">

        <div class="row">
          <div class="col-md-4">
           <label for="periodo">Periodo:</label>
               <select class="form-control" id="periodo" name="periodo">
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
           {!!Form::date('fc', new \DateTime(), ['class' => 'form-control'])!!}
           </div>
          <div class="col-md-3">
           {!!Form::label("FECHA DE APERTURA",null,['class' => 'textsm'])!!}
           {!!Form::date('fa', new \DateTime(), ['class' => 'form-control',"id"=>"fa"])!!}
          </div>
          <div class="col-md-3">
           {!!Form::label("FECHA DE CIERRE",null,['class' => 'textsm'])!!}
           {!!Form::date('fcc',null, ['class' => 'form-control',"id"=>"fcc",'disabled'])!!}
          </div>
          <div class="col-md-3">
           {!!Form::label("FECHA PUBLICA",null,['class' => 'textsm'])!!}
           {!!Form::date('fcp',null, ['class' => 'form-control',"id"=>"fcp"])!!}
          </div>
        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Guardar</button>
        </form>
      </div>
    </div>

  </div>
</div>