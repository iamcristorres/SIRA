<div id="pass" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Cambiar Contraseña</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="{{route('cpass')}}" method="post" enctype="multipart/form-data">
      {!!csrf_field()!!}
      <div class="modal-body">

        <div class="row m-3">
          <div class="col-md-offset-4 col-md-4">
          {!!Form::label("CONTRASEÑA ANTIGUA",null,['class' => 'textsm'])!!}
          <input type="password" class="form-control" name='con_ant' id="con_ant" placeholder="Contraseña Antigua">
          </div>
        </div>
        <hr>
        <div class="row m-3">
          <div class="col-md-offset-2 col-md-4">
          {!!Form::label("CONTRASEÑA NUEVA",null,['class' => 'textsm'])!!}
          <input type="password" class="form-control" name='con_n1' id="con_n1" placeholder="Contraseña Nueva">
          </div>
          <div class="col-md-4">
          {!!Form::label("CONFIRME CONTRASEÑA",null,['class' => 'textsm'])!!}
          <input type="password" class="form-control" name='con_n2' id="con_n2" placeholder="Confirme Contraseña Nueva">
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