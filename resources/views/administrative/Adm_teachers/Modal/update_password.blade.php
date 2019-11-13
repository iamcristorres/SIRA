<div id="update_password" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Reiniciar Contraseña</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="{{route('UpPassTeacher')}}" method="post" enctype="multipart/form-data">
      {!!csrf_field()!!}
      <div class="modal-body">

        <div class="row">
          <div class="col-md-12">
            <center>
            <div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> ¿Esta seguro que desea reiniciar la contraseña de este usuario?</div>
            <h5>La contraseña cambiara al número de usuario registrado hasta el momento.</h5>
            <h5><strong>Nueva Contraseña:</strong><span style="color:red;">{{$docente->CODIGO}}</span></h5>
           </center>
          </div>
        </div>
        <input type="hidden" name="user" value="{{$docente->CODIGO}}">
        </div>


      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Aceptar</button>
        </form>
      </div>
    </div>

  </div>
</div>