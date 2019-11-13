@extends("layouts.teachers")

@section('head')
<title>Carga Académica - Diagnosticos</title>
@endsection
@section('cuerpo')
<div class="d-flex align-items-center p-5 text-white-50 bg-purple rounded box-shadow">
        <img class="mr-3" src="{{ url('/logo/'.$institucion->LOGO) }}" alt="" width="48" height="48">
        <div class="lh-100">
          <h3 class="mb-0 text-white lh-100">SUBIDA DE DIAGNOSTICO</h3>
        </div>
</div>


<div class="my-3 p-3 bg-white rounded box-shadow">
	<div class="row">
	<div class="col-md-12">
	<?php

	function diferenciaDias($inicio, $fin)
	{
    $inicio = strtotime($inicio);
    $fin = strtotime($fin);
    $dif = $fin - $inicio;
    $diasFalt = (( ( $dif / 60 ) / 60 ) / 24);
    return ceil($diasFalt);
	}
	$cod_diagnostico=Crypt::encrypt($diagnostico->NO_DIAG);
	$diferencia = diferenciaDias($diagnostico->FECHA_APERTURA, $diagnostico->FECHA_CIERRE);

	?>
	       <h4>Su carga académica asignada para el periodo anual::: {{$institucion->ANO_ACTIVO}}</h4>
	       <p>Información::: Código de Diagnostico: {{$diagnostico->NO_DIAG}} Periodo: {{$diagnostico->PERIODO}} Fecha de Corte: {{$diagnostico->FECHA_CORTE}}</p>
	       <p>Hábilitación::: Desde: {{$diagnostico->FECHA_APERTURA}} Hasta: {{$diagnostico->FECHA_CIERRE}} <span style="color:red"> |||| Quedan:: {{$diferencia}} días<span></p>
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
	    	<center><a href={{url('/diagnostico/'.$asignatura->id.'/'.$cod_diagnostico)}}><button type="button" class="btn btn-primary">{{$asignatura->NOMBRE_ASIGNATURA." ".$asignatura->curso->CURSO  }}</button></a></center>
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