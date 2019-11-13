<div id="create_new_student" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Registar Nuevo Estudiante</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="{{route('SaveNewStudent')}}" method="post" enctype="multipart/form-data">
      {!!csrf_field()!!}
      <div class="modal-body">

        <div class="row">
          <div class="col-md-6">
           {!!Form::label("CODIGO",null,['class' => 'textsm'])!!}
           {!!Form::text("CODIGO",null,["class"=>"form-control","placeholder"=>"CODIGO","id"=>"CODIGO"])!!}
          </div>
          <div class="col-md-6">
           {!!Form::label("CONTRASEÑA",null,['class' => 'textsm'])!!}
           <input type="password" class="form-control" id="pass" placeholder="Contraseña" name="pass">
          </div>
        </div>
        <div class="row my-3">
          <div class="col-md-3">
           {!!Form::label("PRIMER APELLIDO",null,['class' => 'textsm'])!!}
           {!!Form::text("apellido1",null,["class"=>"form-control","placeholder"=>"PRIMER APELLIDO","id"=>"apellido1"])!!}
          </div>
          <div class="col-md-3">
           {!!Form::label("SEGUNDO APELLIDO",null,['class' => 'textsm'])!!}
           {!!Form::text("apellido2",null,["class"=>"form-control","placeholder"=>"SEGUNDO APELLIDO","id"=>"apellido2"])!!}
          </div>
          <div class="col-md-6">
           {!!Form::label("NOMBRES",null,['class' => 'textsm'])!!}
           {!!Form::text("nombres",null,["class"=>"form-control","placeholder"=>"NOMBRES","id"=>"nombres"])!!}
          </div>
        </div>

        <div class="row my-3">
          <div class="col-md-6">
          {!!Form::label("GRADO",null,['class' => 'textsm'])!!}
           <select class="form-control input-sm" name="grado_ce" id="grado_ce">
           @foreach($grados as $grado)
           <option value="{{$grado->GRADO}}">{{$grado->GRADO}}</option>
           @endforeach
           </select>
          </div>
          <div class="col-md-6">
            {!!Form::label("CURSO",null,['class' => 'textsm'])!!}
            <select class="form-control input-sm" name="curso" id="curso">
            </select>
          </div>
        </div>


        <div class="row my-3">
          <div class="col-md-4">
           {!!Form::label("ESTADO ESTUDIANTE",null,['class' => 'textsm'])!!}
            <select class="form-control input-sm" name="estado_estudiante" id="estado_estudiante">
            <option value="ACTIVO">ACTIVO</option>
            <option value="INACTIVO">INACTIVO</option>
            </select>
          </div>
          <div class="col-md-4">
           {!!Form::label("TIPO DE ESTUDIANTE",null,['class' => 'textsm'])!!}
            <select class="form-control input-sm" name="tipo_estudiante" id="tipo_estudiante">
            <option value="REGULAR">REGULAR</option>
            <option value="REINICIANTE">REINICIANTE</option>
            </select>
          </div>
        </div>

        <div class="row my-3">
          <div class="col-md-6">
            {!!Form::label("TIPO DE DOCUMENTO",null,['class' => 'textsm'])!!}
            <select class="form-control input-sm" name="tipo_documento" id="tipo_documento">
            <option value="REGISTRO CIVIL">REGISTRO CIVIL</option>
            <option value="TARJETA DE IDENTIDAD">TARJETA DE IDENTIDAD</option>
            <option value="CÉDULA DE CIUDADANÍA">CÉDULA DE CIUDADANÍA</option>
            </select>
          </div>
          <div class="col-md-6">
            {!!Form::label("NÚMERO DE DOCUMENTO",null,['class' => 'textsm'])!!}
            {!!Form::text("numero_doc",null,["class"=>"form-control","placeholder"=>"NÚMERO DE DOCUMENTO","id"=>"numero_doc"])!!}
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