<div id="information_inicial" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Bienvenido/a {{auth('student')->user()->NOMBRES}} al sistema SIRA</h4>
      </div>
      <form action="{{route('verone')}}" method="post" enctype="multipart/form-data">
      {!!csrf_field()!!}
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
          <p>Para continuar deberá hacer una actualización de la siguiente información, es importante que no olvide los datos que registrará a continuación</p>
          </div>
        </div>
        <hr>

        @if(Session::has('message1'))
        <div class="row">
        <div class="col-md-12">
        <div class="card-header messagepost" style="background-color:#C20917;" id="error_logueo">
        <center><h6 style="color:#fff;"><i class="fas fa-exclamation-triangle"></i> {{ Session::get('message1') }}</h6></center>
        </div> 
        </div>
        </div>
        <br>
        @endif

        @if(Session::has('message2'))
        <div class="row">
        <div class="col-md-12">
        <div class="card-header messagepost" style="background-color:#C20917;" id="error_logueo">
        <center><h6 style="color:#fff;"><i class="fas fa-exclamation-triangle"></i> {{ Session::get('message2') }}</h6></center>
        </div> 
        </div>
        </div>
        <br>
        @endif


        <div class="row">
          <div class="col-md-6">
          {!!Form::label("CORREO ELECTRONICO",null,['class' => 'textsm'])!!}
          {!!Form::text("correo",null,["class"=>"form-control","placeholder"=>"Correo Electronico","id"=>"correo"])!!}
          </div>
          <div class="col-md-6">
          {!!Form::label("CONFIRME CORREO",null,['class' => 'textsm'])!!}
          {!!Form::text("correoc",null,["class"=>"form-control","placeholder"=>"Confirme Correo Electronico","id"=>"correoc"])!!}
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