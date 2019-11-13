@extends("layouts.administrative")

@section('head')
<title>Docentes</title>
@endsection
<?php 
$nombre_docente=$docente->APELLIDO1." ".$docente->APELLIDO2." ".$docente->NOMBRES;
?>
@section('cuerpo')
<div class="d-flex align-items-center p-5 text-white-50 bg-purple rounded box-shadow">
        <img class="mr-3" src="{{ url('/logo/'.$institucion->LOGO) }}" alt="" width="48" height="48">
        <div class="lh-100">
          <h3 class="mb-0 text-white lh-100">{{$nombre_docente}}</h3>
        </div>
</div>



<div class="my-3 p-3 bg-white rounded box-shadow">
	<div class="row">
		<div class="col-md-4"><center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit_teacher"><i class="fas fa-pen"></i> Editar Información</button></center></div>
		<div class="col-md-4"><center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basic_information_s"><i class="fas fa-print"></i> Imprimir Planillas Carga Académica</button></center></div>
		<div class="col-md-4"><center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basic_information_s"><i class="fas fa-print"></i> Imprimir Consolidados Por Docente</button></center></div>
	</div>
	
	<div class="row my-3 p-3">
		<div class="col-md-6 border">
		<center><h3>CARGA ACADÉMICA</h3></center>
		<hr>
		@foreach($asignaturas as $asignatura)
		<center><button type="button" class="btn btn-info">{{$asignatura->curso->CURSO.' - '.$asignatura->NOMBRE_ASIGNATURA}}</button></center>
		<br>
		@endforeach
		</div>
		<div class="col-md-6 border">
		<center><h3>PERFIL</h3></center>
		<hr>
		<h5>Último Acceso:{{$docente->ULT_ACCESO}}</h5>
		</div>
	</div>
	<div class="row my-3">
		<div class="col-md-12"><center><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#update_password"><i class="fab fa-diaspora"></i> Reiniciar Contraseña</button></center></div>
	</div>
</div>
@include("administrative.Adm_teachers.Modal.edit_teacher")
@include("administrative.Adm_teachers.Modal.update_password")
@endsection

@section('space_scripts')
@endsection