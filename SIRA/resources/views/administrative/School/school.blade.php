@extends("layouts.administrative")

@section('head')
<title>Tu Institución</title>
@endsection

@section('cuerpo')
<div class="d-flex align-items-center p-5 text-white-50 bg-purple rounded box-shadow">
        <img class="mr-3" src="{{ url('/logo/'.$institucion->LOGO) }}" alt="" width="48" height="48">
        <div class="lh-100">
          <h6 class="mb-0 text-white lh-100">{{$institucion->NOMBRE_ESTABLECIMIENTO}}</h6>
          <small>{{$institucion->PEI}}</small>
        </div>
      </div>

@if($errors->any())
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-danger" role="alert">
		<i class="fas fa-exclamation-triangle"></i> No fue posible realizar los cambios por los siguientes motivos:<br>
		<ul>
		@foreach($errors->all() as $error)
		<li>{{$error}}</li>
		@endforeach
		</ul>
		</div>
	</div>
</div>
@endif
@if($institucion->ACTIVO)

<div class="my-3 p-3 bg-white rounded box-shadow">
	        <div class="row">
	        <div class="col-md-12">
	        <h6 class="border-bottom border-gray pb-2 mb-0">{{$institucion->NOMBRE_ESTABLECIMIENTO}}  ::: PERIODO ACTIVO {{$institucion->ANO_ACTIVO}}</h6>
	        </div>
	        </div>
	        <br>
	        <div class="row">
	        <div class="col-md-4"><center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basic_information_s">Configuración Básica</button></center></div>
	        <div class="col-md-4"><center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#academic_config">Configuración Académica</button></center></div>
	        <div class="col-md-4"><center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#portals_configuration">Configuración de Portales</button></center></div>
	       </div>

</div>
@include("administrative.School.Modal.basic_information")
@include("administrative.School.Modal.academic_config")
@include("administrative.School.Modal.portals_configuration")
@else

<div class="row my-3">
	<div class="col-md-12">
		<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Aun no hay ningún año lectivo activo, para iniciar un nuevo año académico puedes dar clic en el botón "Iniciar Año". </div>
	</div>
</div>

<div class="bgothers_green my-3 p-3 rounded box-shadow">
	        <br>
	        <div class="row">
	        <div class="col-md-12"><center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevo_periodo">Iniciar Año</button></center></div>
	       </div>
</div>

@include("administrative.School.Modal.newperiod")

@endif







<div class="bgothers_red my-3 p-3 rounded box-shadow">
	        <br>
	        <div class="row">
	        <div class="col-md-4"><center><a href="#" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span> Información Básica</a></center></div>
	        <div class="col-md-4"><center><a href="#" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span> Configuración Académica</a></center></div>
	        <div class="col-md-4"><center><a href="#" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span> Configuración de Portales</a></center></div>
	       </div>
</div>





@endsection

@section('space_scripts')
 <script type="text/javascript" charset="utf-8">
  $( document ).ready(function() {
  	nuevo_periodo();
  });

</script>
@endsection