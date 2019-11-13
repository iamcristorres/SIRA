<div id="calificationc" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Calificaciones</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="{{route('Savecalifications_E')}}" method="post" enctype="multipart/form-data">
      {!!csrf_field()!!}
      <div class="modal-body">

        <div class="row">
         <div class="col-md-12">
         <h5>Registro de Calificaciones Periodo Anual:: {{$institucion->ANO_ACTIVO}}</h5>
         <input hidden value='{{$estudiante->CODIGO}}' name="codigo_estudiante" >
          <table class="table table-condensed">
              <thead>
                <tr>
                <th>Asignatura</th>
                <th>P1</th>
                <th>P2</th>
                <th>P3</th>
                <th>P4</th>
                </tr>
              </thead>
              <tbody>

              @foreach($calificaciones as $calificacion)                
                <tr>
                <td width="40%">{{$calificacion->asignatura->NOMBRE_ASIGNATURA}}</td>
                <input hidden value='{{$calificacion->id_asignatura}}' name="idasi[]" >
                <td><input class="form-control definitivaperiodo" type="number" value="{{$calificacion->P1}}" id="example-number-input1" max='{{$periodo_anual->nota_max}}' min='{{$periodo_anual->nota_min}}' step='any' name="p1[]"></td>
                <td><input class="form-control definitivaperiodo" type="number" value="{{$calificacion->P2}}" id="example-number-input1" max='{{$periodo_anual->nota_max}}' min='{{$periodo_anual->nota_min}}' step='any' name="p2[]"></td>
                <td><input class="form-control definitivaperiodo" type="number" value="{{$calificacion->P3}}" id="example-number-input1" max='{{$periodo_anual->nota_max}}' min='{{$periodo_anual->nota_min}}' step='any' name="p3[]"></td>
                <td><input class="form-control definitivaperiodo" type="number" value="{{$calificacion->P4}}" id="example-number-input1" max='{{$periodo_anual->nota_max}}' min='{{$periodo_anual->nota_min}}' step='any' name="p4[]"></td>
                </tr>
              @endforeach
                </tbody>
          </table>
         </div>
        </div>

      <div class="row">
      <div class="col-md-4">
      <?php 
      $id_estudiante=Crypt::encrypt($estudiante->CODIGO);
      ?>
      <a href="{{url('/delete_califications_estudiantes/'.$id_estudiante)}}">Borrar el registro de Calificaciones</a>
      </div>
      <div class="col-md-4">
       <a href="{{url('/create_califications_estudiantes/'.$id_estudiante)}}">Crear Registro de Calificaciones</a>
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