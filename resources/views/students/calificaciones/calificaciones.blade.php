
@extends("layouts.studens")

@section('head')
<title>Consulta de Calificaciones</title>
@endsection
@section('cuerpo')

<?php
use App\asignatura;
use App\curso;
$actualdate=date("Y-m-d");
?>
<div class="d-flex align-items-center p-5 text-white-50 bg-purple rounded box-shadow">
        <img class="mr-3" src="{{ url('/logo/'.$institucion->LOGO) }}" alt="" width="48" height="48">
        <div class="lh-100">
          <h6 class="mb-0 text-white lh-100">{{$institucion->NOMBRE_ESTABLECIMIENTO}}</h6>
          <small>{{$institucion->PEI}}</small>
        </div>
      </div>

<div class="my-3 p-3 bg-white rounded box-shadow">
	        <div class="row">
	        <div class="col-md-12">
	        <h6 class="border-bottom border-gray pb-2 mb-0">Código: {{auth('student')->user()->CODIGO}} ::: Estudiante: {{auth('student')->user()->NOMBRES." ".auth('student')->user()->APELLIDO1." ".auth('student')->user()->APELLIDO2 }} ::: GRADO: {{$estudiante->GRADO}} ::: CURSO: {{$estudiante->CURSO}} ::: ESTADO: {{$estudiante->ESTADO_DEL_ESTUDIANTE}}</h6>
	        </div>
	        </div>
</div>
<hr>
<div class="my-3 p-3 bg-white rounded box-shadow">
          <div class="row">
          <div class="col-md-12">

      <table id="examples" class="table table-striped table-bordered no-footer" style="width: 100%;" role="grid" aria-describedby="example_info">
      <thead> <tr role="row">
      <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" style="width: 400px;" aria-sort="ascending">Área / Asignatura</th> 
      <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 110px;"><center>DEF. P1</center></th>
      <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 110px;"><center>DEF. P2</center></th>
      <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 110px;"><center>DEF. P3</center></th>
      <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 110px;"><center>DEF. P4</center></th>
      <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 110px;"><center>DEFINITIVA</center></th>
      </tr>
      </thead> 
  

      <tbody>
      @foreach($areas as $area)

      <?php
      $curso=curso::where('CURSO','=',$estudiante->CURSO)->first();
      $curso_id=$curso->id;
      $asignaturasc=asignatura::where('id_area','=',$area->id)->where('id_curso','=',$curso_id)->where('ANO','=',$institucion->ANO_ACTIVO)->count();
      ?>
      @if($asignaturasc>0)

      <tr role="row" class="even">
      <td colspan="5" style="background-color:#052F5F; color:#fff;font-weight: bold;">{{$area->NOMBRE_AREA}}</td>
      <td></td>
      </tr>
      
      @foreach($asignaturas as $asignatura)
      @if($asignatura->id_area==$area->id)

      @foreach($calificaciones as $calificacion)
      @if($calificacion->id_asignatura==$asignatura->id)
      <tr role="row" class="even">
      <td class="sorting_1">:::{{$asignatura->NOMBRE_ASIGNATURA}}</td>
      <td class="sorting_1"><center>{{$calificacion->P1}}</center></td>
      <td class="sorting_1"><center>{{$calificacion->P2}}</center></td>
      <td class="sorting_1"><center>{{$calificacion->P3}}</center></td>
      <td class="sorting_1"><center>{{$calificacion->P4}}</center></td>
      <td class="sorting_1"></td>
      </tr>
      @endif
      @endforeach

      @endif
      @endforeach

      @endif
      @endforeach
      </tbody>

      </table>


          </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-12">
              <table class="table table-bordered">
              <thead style="background-color:#052F5F; color:#fff;font-weight: bold;">
              <tr>
              <th scope="col"><center>PRIMER PERIODO</center></th>
              <th scope="col"><center>SEGUNDO PERIODO</center></th>
              <th scope="col"><center>TERCER PERIODO</center></th>
              <th scope="col"><center>CUARTO PERIODO</center></th>
              </tr>
              </thead>
              <tbody>
              <tr>
              @if($actualdate>=$portal->EP_PER1)
              <td style="color:#6C6C6C"><center><a href>DISPONIBLE</a></center></td>
              @else
              <td style="color:#6C6C6C"><center>NO DISPONIBLE</center></td>
              @endif

              @if($actualdate>=$portal->EP_PER2)
              <td style="color:#6C6C6C"><center>DISPONIBLE</center></td>
              @else
              <td style="color:#6C6C6C"><center>NO DISPONIBLE</center></td>
              @endif

              @if($actualdate>=$portal->EP_PER3)
              <td style="color:#6C6C6C"><center><a href="{{url('/p3e/'.$estudiante->CODIGO)}}">DISPONIBLE</a></center></td>
              @else
              <td style="color:#6C6C6C"><center>NO DISPONIBLE</center></td>
              @endif

              @if($actualdate>=$portal->EP_PER4)
              <td style="color:#6C6C6C"><center><a href="{{url('/p4e/'.$estudiante->CODIGO)}}">DISPONIBLE</a></center></td>
              @else
              <td style="color:#6C6C6C"><center>NO DISPONIBLE</center></td>
              @endif
              </tr>
              </tbody>
              </table>
            </div>
          </div>
          <br>
          <br>
</div>

@endsection
@section('space_scripts')
<script type="text/javascript" charset="utf-8">
$('#information_inicial').modal({backdrop: 'static', keyboard: false})
		</script>
<script type="text/javascript" charset="utf-8">
$('#confirmation_one').modal({backdrop: 'static', keyboard: false})
		</script>
@endsection