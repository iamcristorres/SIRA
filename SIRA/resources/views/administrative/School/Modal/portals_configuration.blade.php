<div id="portals_configuration" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Configuración de Portales</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="{{route('Update_Portals')}}" method="post" enctype="multipart/form-data">
      {!!csrf_field()!!}
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <h5>Portal Docente:: Registro de Calificaciones y Periodos</h5>
            <hr>
          </div>
        </div>

        <div class="row">
        <div class="col-md-4 offset-md-2">
            {!!Form::label("FECHA DE APERTURA PERIODO 1",null,['class' => 'textsm'])!!}
            {!!Form::date('fa1', $portal->A_P1, ['class' => 'form-control'])!!}
        </div>
        <div class="col-md-4">
            {!!Form::label("FECHA DE CIERRE PERIODO 1",null,['class' => 'textsm'])!!}
            {!!Form::date('fc1', $portal->C_P1, ['class' => 'form-control'])!!}
        </div>
        </div>

        <div class="row">
        <div class="col-md-4 offset-md-2">
            {!!Form::label("FECHA DE APERTURA PERIODO 2",null,['class' => 'textsm'])!!}
            {!!Form::date('fa2', $portal->A_P2, ['class' => 'form-control'])!!}
        </div>
        <div class="col-md-4">
            {!!Form::label("FECHA DE CIERRE PERIODO 2",null,['class' => 'textsm'])!!}
            {!!Form::date('fc2', $portal->C_P2, ['class' => 'form-control'])!!}
        </div>
        </div>

        <div class="row">
        <div class="col-md-4 offset-md-2">
            {!!Form::label("FECHA DE APERTURA PERIODO 3",null,['class' => 'textsm'])!!}
            {!!Form::date('fa3', $portal->A_P3, ['class' => 'form-control'])!!}
        </div>
        <div class="col-md-4">
            {!!Form::label("FECHA DE CIERRE PERIODO 3",null,['class' => 'textsm'])!!}
            {!!Form::date('fc3', $portal->C_P3, ['class' => 'form-control'])!!}
        </div>
        </div>

        <div class="row">
        <div class="col-md-4 offset-md-2">
            {!!Form::label("FECHA DE APERTURA PERIODO 4",null,['class' => 'textsm'])!!}
            {!!Form::date('fa4', $portal->A_P4, ['class' => 'form-control'])!!}
        </div>
        <div class="col-md-4">
            {!!Form::label("FECHA DE CIERRE PERIODO 4",null,['class' => 'textsm'])!!}
            {!!Form::date('fc4', $portal->C_P4, ['class' => 'form-control'])!!}
        </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-12">
            <h5>Portal Estudiante:: Disponibilidad y Publicacion de los boletines de calificaciones</h5>
            <hr>
          </div>
        </div>

        <div class="row">
        <div class="col-md-4 offset-md-4">
            {!!Form::label("PERIODO 1:: DISPONIBLE DESDE",null,['class' => 'textsm'])!!}
            {!!Form::date('pubp1', $portal->EP_PER1, ['class' => 'form-control'])!!}
        </div>
        </div>

        <div class="row">
        <div class="col-md-4 offset-md-4">
            {!!Form::label("PERIODO 2:: DISPONIBLE DESDE",null,['class' => 'textsm'])!!}
            {!!Form::date('pubp2', $portal->EP_PER2, ['class' => 'form-control'])!!}
        </div>
        </div>

        <div class="row">
        <div class="col-md-4 offset-md-4">
            {!!Form::label("PERIODO 3:: DISPONIBLE DESDE",null,['class' => 'textsm'])!!}
            {!!Form::date('pubp3', $portal->EP_PER3, ['class' => 'form-control'])!!}
        </div>
        </div>

        <div class="row">
        <div class="col-md-4 offset-md-4">
            {!!Form::label("PERIODO 4:: DISPONIBLE DESDE",null,['class' => 'textsm'])!!}
            {!!Form::date('pubp4', $portal->EP_PER4, ['class' => 'form-control'])!!}
        </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <h5>Portal Estudiante:: Hábilitación portal de matriculas</h5>
            <hr>
          </div>
        </div>

        <div class="row">
        <div class="col-md-5 offset-md-1">
            {!!Form::label("FECHA DE APERTURA MATRICULAS",null,['class' => 'textsm'])!!}
            {!!Form::date('matr1', null, ['class' => 'form-control'])!!}
        </div>
        <div class="col-md-5">
            {!!Form::label("FECHA DE CIERRE MATRICULAS",null,['class' => 'textsm'])!!}
            {!!Form::date('matr2', null, ['class' => 'form-control'])!!}
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

