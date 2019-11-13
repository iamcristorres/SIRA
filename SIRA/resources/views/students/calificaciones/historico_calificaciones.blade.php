
@extends("layouts.studens")

@section('head')
<title>Historico Calificaciones</title>
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
<div class="my-3 p-3 bg-white rounded box-shadow">
  <div class="row">
  <div class="col-md-12">
         <h4>Seleccione el año a consultar del registro de calificaciones historico SIRA</h4>
  </div>
  </div>
</div>

<div class="my-3 p-3 bg-white rounded box-shadow">
  <form action="#" method="post" enctype="multipart/form-data">
  {!!csrf_field()!!}
  <div class="row">
  <div class="col-md-5">
    <center>
      <label for="codigo">Periodo:</label>
               <select class="form-control" id="codigo" name="codigo">
               <option value="">Seleccione</option>
               </select>
    </center>
  </div>
  <div class="col-md-4">
  <br>
      <button type="submit" id="boton_env" name="boton_env" class="btn btn-primary" disabled >Ir</button>
    </div>
  </div>
   </form>  
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