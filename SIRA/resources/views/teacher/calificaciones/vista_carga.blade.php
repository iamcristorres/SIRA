@extends("layouts.teachers")

@section('head')
<title>Carga Académica</title>
@endsection
@section('cuerpo')
<div class="d-flex align-items-center p-5 text-white-50 bg-purple rounded box-shadow">
        <img class="mr-3" src="{{ url('/logo/'.$institucion->LOGO) }}" alt="" width="48" height="48">
        <div class="lh-100">
          <h3 class="mb-0 text-white lh-100">SUBIDA DE CALIFICACIONES</h3>
        </div>
</div>


<div class="my-3 p-3 bg-white rounded box-shadow">
	<div class="row">
	<div class="col-md-12">
	       <h4>Su carga académica asignada para el periodo anual::: {{$institucion->ANO_ACTIVO}}</h4>
	       <p>Periodo Académico :::::1 (4 feb- 8 abr)</p>
	</div>
	</div>
</div>
<?php if(Session::get('message') !== null) {?>
<div class="alert alert-success" role="alert" id='alerta_message'><i class="far fa-check-circle"></i> {{ Session::get('message') !== null ? Session::get('message') : '' }}</div>
<?php } ?>

<div class="my-3 p-3 bg-white rounded box-shadow">
	<div class="row">
	<div class="col-md-12">
	    @foreach($asignaturas as $asignatura)
	    	<center><a href={{url('/calificador/'.$asignatura->id)}}><button type="button" class="btn btn-primary">{{$asignatura->NOMBRE_ASIGNATURA." ".$asignatura->curso->CURSO  }}</button></a></center>
	    	<br>
		@endforeach
	</div>	
	</div>
	</div>
</div>


@endsection

@section('space_scripts')
<script>
	$( document ).ready(function() {
		setTimeout(function(){
  		$("#alerta_message").alert('close');
		}, 2000);
	})
</script>
@endsection