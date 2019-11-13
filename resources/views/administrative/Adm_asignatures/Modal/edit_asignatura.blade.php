<div id="edit_asignatura" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Editar Asignatura</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="{{route('SaveEditionAsignature')}}" method="post" enctype="multipart/form-data">
      {!!csrf_field()!!}
      <div class="modal-body">


        <div class="row">
          <div class="col-md-8">
          {!!Form::label("ÁREA",null,['class' => 'textsm'])!!}
           <select class="form-control input-sm" name="e_area" id="e_area"> 
                 <option value="">SIN ASIGNAR</option>
               @foreach($areas as $area)
               <option value="{{$area->id}}" {{ $asignatura->id_area == $area->id ? 'selected="selected"' : '' }}>{{ $area->NOMBRE_AREA }}</option>
               @endforeach
          </select>
          </div>
          <div class="col-md-4">
           {!!Form::label("PERIODO ACADÉMICO",null,['class' => 'textsm'])!!}
           {!!Form::text("periodo_aca_e",$institucion->ANO_ACTIVO,["class"=>"form-control","placeholder"=>"Periodo Académico","id"=>"periodo_aca_e","readonly"=>true])!!}
          </div>
        </div>



        <div class="row my-3">
          <div class="col-md-6">
          {!!Form::label("ASIGNATURA",null,['class' => 'textsm'])!!}
          {!!Form::text("asignatura_e",null,["class"=>"form-control","placeholder"=>"Nombre de la asignatura","id"=>"asignatura_e"])!!}
          </div>
          <div class="col-md-3">
           {!!Form::label("GRADO",null,['class' => 'textsm'])!!}
           <select class="form-control input-sm" name="grado_asig_e" id="grado_asig_e">
                <option></option>
               @foreach($grados as $grado)
                 <option value="{{$grado->id}}">{{$grado->GRADO}}</option>
               @endforeach
          </select>
          </div>
          <div class="col-md-3">
           {!!Form::label("CURSO",null,['class' => 'textsm'])!!}
           <select class="form-control input-sm" name="curso_e" id="curso_e">
           @foreach($cursos as $curso)
            <option value="{{$curso->id}}" {{ $asignatura->id_curso == $curso->id ? 'selected="selected"' : '' }}>{{ $curso->CURSO }}</option>
          @endforeach
          </select>
          </div>

          </div>

          <div class="row my-3">
          <div class="col-md-8">
          {!!Form::label("DOCENTE RESPONSABLE",null,['class' => 'textsm'])!!}
           <select class="form-control input-sm" name="docente_resp_e" id="docente_resp_e"> 
                 <option value="0">SIN ASIGNAR</option>
               @foreach($docentes as $docente)
                 <option value="{{$docente->CODIGO}}" {{ $asignatura->id_docente == $docente->CODIGO ? 'selected="selected"' : '' }}>{{ $docente->APELLIDO1." ".$docente->APELLIDO2." ".$docente->NOMBRES }}</option>
               @endforeach
          </select>
          </div>

          <div class="col-md-4">
           {!!Form::label("IH/S",null,['class' => 'textsm'])!!}
           {!!Form::text("ihs_e",null,["class"=>"form-control","placeholder"=>"IH/S","id"=>"ihs_e"])!!}
          </div>
          <input type="hidden" value="" id="id_asignature" name="id_asignature">
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