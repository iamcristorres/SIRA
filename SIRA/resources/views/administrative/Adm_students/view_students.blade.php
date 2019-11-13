@extends("layouts.administrative")

@section('head')
<title></title>
@endsection

@section('cuerpo')
<?php 
$nombre_estudiante=$estudiante->APELLIDO1." ".$estudiante->APELLIDO2." ".$estudiante->NOMBRES;
?>
<div class="d-flex align-items-center p-5 text-white-50 bg-purple rounded box-shadow">
        <img class="mr-3" src="{{ url('/logo/'.$institucion->LOGO) }}" alt="" width="48" height="48">
        <div class="lh-100">
          <h3 class="mb-0 text-white lh-100">{{$nombre_estudiante}}</h3>
          <small>CURSO:: {{$estudiante->CURSO}}</small>
        </div>
</div>



<div class="my-3 p-3 bg-white rounded box-shadow">
	<div class="row">
		<div class="col-md-3"><center><a href=""><button class="btn btn-primary"><i class="fas fa-address-book"></i> Información Personal</button></a></center></div>
		<div class="col-md-3"><center><a href=""><button class="btn btn-primary"><i class="fas fa-hand-holding-usd"></i> Registro Financiero</button></a></center></div>
		<div class="col-md-3"><center><a href=""><button class="btn btn-primary"><i class="fas fa-print"></i> Impresiones</button></a></center></div>
		<div class="col-md-3"><center><a href=""><button class="btn btn-primary"><i class="fas fa-copy"></i> Historia Académica SIRA</button></a></center></div>
	</div>
</div>

<?php if($estudiante->ESTADO_DEL_ESTUDIANTE=="ACTIVO") { ?>
@include("administrative.Adm_students.Modal.califications")
<div class="my-3 p-3 bg-white rounded box-shadow">
	<h5>Registro Académico. Año Académico: {{$institucion->ANO_ACTIVO}}</h5>
	<div class="row">
		<div class="col-md-6"><center><button class="btn btn-primary" data-toggle="modal" data-target="#calificationc"><i class="fas fa-address-book"></i> Registro de Calificaciones</button></center></div>
		<div class="col-md-6"><center><a href=""><button class="btn btn-primary"><i class="fas fa-hand-holding-usd"></i> Estado Académico Anual y Final</button></a></center></div>
		
	</div>
</div>

<?php } ?>


@endsection

@section('space_scripts')
@endsection