<div id="create_new_teacher" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Registar Nuevo Docente</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="{{route('SaveNewTeacher')}}" method="post" enctype="multipart/form-data">
      {!!csrf_field()!!}
      <div class="modal-body">

        <div class="row">
          <div class="col-md-6">
           {!!Form::label("USUARIO",null,['class' => 'textsm'])!!}
           {!!Form::text("USUARIO",null,["class"=>"form-control","placeholder"=>"USUARIO","id"=>"USUARIO"])!!}
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
          <div class="col-md-4">
           {!!Form::label("CORREO ELECTRONICO",null,['class' => 'textsm'])!!}
           {!!Form::text("correo",null,["class"=>"form-control","placeholder"=>"CORREO ELECTRONICO","id"=>"correo"])!!}
          </div>
          <div class="col-md-4">
           {!!Form::label("EPS",null,['class' => 'textsm'])!!}
           <select class="form-control input-sm" name="eps" id="eps">
           <option value="NINGUNA">NINGUNA</option> 
           @foreach($epss as $eps)
           <option value="{{$eps->NOMBRE}}">{{$eps->NOMBRE}}</option>
           @endforeach
           </select>
          </div>
          <div class="col-md-4">
           {!!Form::label("ARL",null,['class' => 'textsm'])!!}
           <select class="form-control input-sm" name="arl" id="arl">
           <option value="NINGUNA">NINGUNA</option> 
           @foreach($arls as $arl)
           <option value="{{$arl->NOMBRE}}">{{$arl->NOMBRE}}</option>
           @endforeach
           </select>
          </div>
        </div>

        <div class="row my-3">
          <div class="col-md-3">
           {!!Form::label("ESCALAFON",null,['class' => 'textsm'])!!}
           {!!Form::text("escalafon",null,["class"=>"form-control","placeholder"=>"ESCALAFON","id"=>"escalafon"])!!}
          </div>
          <div class="col-md-3">
           {!!Form::label("RESOLUCIÓN",null,['class' => 'textsm'])!!}
           {!!Form::text("resolucion",null,["class"=>"form-control","placeholder"=>"RESOLUCIÓN","id"=>"resolucion"])!!}
          </div>
          <div class="col-md-3">
           {!!Form::label("TELÉFONO FIJO / CELULAR",null,['class' => 'textsm'])!!}
           {!!Form::text("tel",null,["class"=>"form-control","placeholder"=>"TELÉFONO FIJO","id"=>"tel"])!!}
          </div>
          <div class="col-md-3">
           {!!Form::label("DIRECCION",null,['class' => 'textsm'])!!}
           {!!Form::text("dir",null,["class"=>"form-control","placeholder"=>"DIRECCION","id"=>"dir"])!!}
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