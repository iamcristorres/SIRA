<div id="confirmation_one" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Bienvenido/a {{auth('student')->user()->NOMBRES}} al sistema SIRA</h4>
      </div>
      <form action="{{route('vertwo')}}" method="post" enctype="multipart/form-data">
      {!!csrf_field()!!}
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
          <p>Hemos enviado un código de 6 digitos al correo electronico diligenciado anteriormente en caso de no estar en la carpeta de entrada verifique en la carpeta de SPAM o correo no deseado. Dispone de 30 minutos para llenar el siguiente campo.</p>
          </div>
        </div>
        <hr>

        @if(Session::has('message3'))
        <div class="row">
        <div class="col-md-12">
        <div class="card-header messagepost" style="background-color:#C20917;" id="error_logueo">
        <center><h6 style="color:#fff;"><i class="fas fa-exclamation-triangle"></i> {{ Session::get('message3') }}</h6></center>
        </div> 
        </div>
        </div>
        <br>
        @endif

        @if(Session::has('messagereenvio'))
        <div class="row">
        <div class="col-md-12">
        <div class="card-header messagepost" style="background-color:#026C18;" id="error_logueo">
        <center><h6 style="color:#fff;"><i class="fas fa-check-circle"></i> {{ Session::get('messagereenvio') }}</h6></center>
        </div>
        </div>
        </div>
        <br>
        @endif


        <div class="row">
        <div class="col-md-4">
        </div>

          <div class="col-md-4">
          {!!Form::label("CÓDIGO DE VERIFICACIÓN",null,['class' => 'textsm'])!!}
          {!!Form::text("codigover",null,["class"=>"form-control","placeholder"=>"CÓDIGO DE VERIFICACIÓN","id"=>"codigover"])!!}
          </div>

        <div class="col-md-4">
        </div>

        </div>

        <div class="row m-5">
          <div class="col-md-6">
            <center><a href="{{url('/reinicio_correo')}}"><input type="button" value="Corregir Correo Electronico" class="btn btn-primary"/></a></center>
          </div>
          <div class="col-md-6">
            <center><a href="{{url('/reenvio_correo')}}"><input type="button" value="No me ha llegado el código. Reenviar Correo." class="btn btn-primary"/></a></center>
          </div>
        </div>

      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Guardar</button>
        </form>
      </div>
    </div>

  </div>
</div>