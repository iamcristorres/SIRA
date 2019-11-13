<div id="create_new_course" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Crear Nuevo Curso</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="{{route('SaveNewCourse')}}" method="post" enctype="multipart/form-data">
      {!!csrf_field()!!}
      <div class="modal-body">

        <div class="row">
          <div class="col-md-6">
           {!!Form::label("GRADO",null,['class' => 'textsm'])!!}
           <select class="form-control input-sm" name="grado" id="grado"> 
               @foreach($grados as $grado)
                 <option value="{{$grado->id}}">{{$grado->GRADO}}     </option>
               @endforeach
          </select>
          </div>
          <div class="col-md-6">
           {!!Form::label("CURSO",null,['class' => 'textsm'])!!}
           {!!Form::text("curso",null,["class"=>"form-control","placeholder"=>"Curso","id"=>"curso"])!!}
          </div>
        </div>

        <div class="row my-3">
            <div class="offset-md-2 col-md-8">
              {!!Form::label("DIRECTOR DE CURSO",null,['class' => 'textsm'])!!}
           <select class="form-control input-sm" name="dircurso" id="dircurso">
                 <option value="">SIN ASIGNAR</option> 
               @foreach($docentes as $docente)
                 <option value="{{$docente->CODIGO}}">{{$docente->APELLIDO1." ".$docente->APELLIDO2." ".$docente->NOMBRES}}     </option>
               @endforeach
          </select>
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