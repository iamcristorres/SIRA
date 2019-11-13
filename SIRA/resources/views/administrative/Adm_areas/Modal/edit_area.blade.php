<div id="edit_area" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Editar área</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="{{route('SaveEditionArea')}}" method="post" enctype="multipart/form-data">
      {!!csrf_field()!!}
      <div class="modal-body">

        <div class="row">
          <div class="col-md-8">
          {!!Form::label("NOMBRE DEL ÁREA",null,['class' => 'textsm'])!!}
           {!!Form::text("nombre_areae",null,["class"=>"form-control textmayusc","placeholder"=>"Nombre del área","id"=>"nombre_areae"])!!}
          </select>
          </div>
          <div class="col-md-4">
           {!!Form::label("PERIODO ACADÉMICO",null,['class' => 'textsm'])!!}
           {!!Form::text("periodo_acae",null,["class"=>"form-control","placeholder"=>"Periodo Académico","id"=>"periodo_acae","readonly"=>true])!!}
          </div>
        </div>
      </div>
      <input type="hidden" value="" id="id_area" name="id_area">
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Guardar</button>
        </form>
      </div>
    </div>

  </div>
</div>