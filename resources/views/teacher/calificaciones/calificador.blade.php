@extends("layouts.teachers")
@section('head')
<title>{{$asignatura->NOMBRE_ASIGNATURA}} - {{$asignatura->curso->CURSO}}</title>
<?php 
use App\calificacion;
?>
@endsection
@section('cuerpo')
<div class="d-flex align-items-center p-5 text-white-50 bg-purple rounded box-shadow">
        <img class="mr-3" src="{{ url('/logo/'.$institucion->LOGO) }}" alt="" width="48" height="48">
        <div class="lh-100">
          <h3 class="mb-0 text-white lh-100">ASIGNATURA:: {{$asignatura->NOMBRE_ASIGNATURA}}</h3>
          <small>Docente:: {{$asignatura->docente->APELLIDO1." ".$asignatura->docente->APELLIDO2." ".$asignatura->docente->NOMBRES}}</small>
        </div>
</div>
<form action="{{route('Savecalifications')}}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="my-3 p-3 bg-white rounded box-shadow">
	<div class="row">
	<div class="col-md-12">
	      <h4>CURSO:: {{$asignatura->curso->CURSO}}</h4>
	      <hr>
	      <div class="my-3 p-3 bg-white rounded box-shadow">
			<table id="examples" class="table table-striped table-bordered no-footer" style="width: 100%;" role="grid" aria-describedby="example_info">
 			<thead> <tr role="row">
 			<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" style="width: 50px;" aria-sort="ascending">No</th> 
 			<th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 500px;">APELLIDOS Y NOMBRES</th>
 			<th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 110px;">F. P1</th>
 			<th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 110px;">DEF. P1</th>
 			<th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 110px;">F. P2</th>
 			<th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 110px;">DEF. P2</th>
 			<th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 110px;">F. P3</th>
 			<th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 110px;">DEF. P3</th>
 			<th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 110px;">F. P4</th>
 			<th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 110px;">DEF. P4</th>
 			</tr>
 			</thead> 
 	
			<tbody>
			<?php $i=1; ?>
			@foreach($estudiantes as $estudiante)
			<?php
				$f1=0;
				$f2=0;
				$f3=0;
				$f4=0;
				$p1=0;
				$p2=0;
				$p3=0;
				$p4=0;
			?>
			<?php
				$calificaciones=calificacion::where('id_asignatura','=',$asignatura->id)->where('CODIGO_ESTUDIANTE','=',$estudiante->CODIGO)->get()->first();
				if(isset($calificaciones)){
				$f1=$calificaciones->F1;
				$p1=$calificaciones->P1;
				$f2=$calificaciones->F2;
				$p2=$calificaciones->P2;
				$f3=$calificaciones->F3;
				$p3=$calificaciones->P3;
				$f4=$calificaciones->F4;
				$p4=$calificaciones->P4;
				}else{
				$f1=0;
				$p1=0;
				$f2=0;
				$p2=0;
				$f3=0;
				$p3=0;
				$f4=0;
				$p4=0;	
				}
			?>
			<tr role="row" class="even">
			<td class="sorting_1">{{$i.'.'}}</td>
			<td class="sorting_1"><input hidden value='{{$estudiante->CODIGO}}' name="dni[]" > {{$estudiante->APELLIDO1.' '.$estudiante->APELLIDO2.' '.$estudiante->NOMBRES}}</td>
			<td class="sorting_1"><input class="form-control" type="number" value="{{$f1}}" id="example-number-input" name="f1[]" readonly></td>
			<td class="sorting_1"><input class="form-control definitivaperiodo" type="number" value="{{$p1}}"  id="example-number-input1"  max='{{$periodo_anual->nota_max}}' min='{{$periodo_anual->nota_min}}' step='any' name="p1[]" readonly></td></td>
			<td class="sorting_1"><input class="form-control" type="number" value="{{$f2}}" id="example-number-input"  name="f2[]" readonly></td></td>
			<td class="sorting_1"><input class="form-control definitivaperiodo" type="number" value="{{$p2}}"  id="example-number-input2"  max='{{$periodo_anual->nota_max}}' min='{{$periodo_anual->nota_min}}' step='any' name="p2[]" readonly></td></td>
			<td class="sorting_1"><input class="form-control" type="number" value="{{$f3}}" id="example-number-input"  name="f3[]" readonly ></td></td>
			<td class="sorting_1"><input class="form-control definitivaperiodo" type="number" value="{{$p3}}" id="example-number-input3"  max='{{$periodo_anual->nota_max}}' min='{{$periodo_anual->nota_min}}' step='any' name="p3[]" readonl></td></td>
			<td class="sorting_1"><input class="form-control" type="number" value="{{$f4}}" id="example-number-input"  name="f4[]" readonly></td></td>
			<td class="sorting_1"><input class="form-control definitivaperiodo" type="number" value="{{$p4}}" id="example-number-input4"  max='{{$periodo_anual->nota_max}}' min='{{$periodo_anual->nota_min}}' step='any' name="p4[]" readonly></td></td>
			</tr>
			
			<?php $i++; ?>
			@endforeach
			</tbody>
			</table>
			</div>
	</div>
	</div>
</div>

<div class="my-3 p-3 bg-white rounded box-shadow">
	<div class="row">
	<div class="col-md-12">
	<input hidden value='{{$asignatura->id}}' name="asignatura" >
	<center><button type="submit" class="btn btn-primary">Enviar Calificaciones</button></center></div>
	</div>
	</div>
</div>
</form>
@endsection

@section('space_scripts')
<script>
	$( document ).ready(function() {

		
	})
</script>
@endsection

