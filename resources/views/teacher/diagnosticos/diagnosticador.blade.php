@extends("layouts.teachers")
@section('head')
<title>{{$asignatura->NOMBRE_ASIGNATURA}} - {{$asignatura->curso->CURSO}}</title>
<?php 
use App\Encryption;
use Illuminate\Support\Facades\Crypt;
use App\calificacion;
use App\diagnostico;
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
<form action="{{route('SaveDiagnosticos')}}" method="post" enctype="multipart/form-data">
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
 			<th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 1000px;">Diagnostico</th>
 			<th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 110px;">Seguimiento</th>
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
				$diagnosticos=diagnostico::where('CODIGO_ESTUDIANTE','=',$estudiante->CODIGO)->where('COD_DIAGNOSTICO','=',Crypt::decrypt($diagnosticoc))->where('ANO','=',$institucion->ANO_ACTIVO)->where('ASIGNATURA','=',$asignatura->id)->get()->first();
				if(isset($diagnosticos)){
				$diagtext=$diagnosticos->DIAGNOSTICO;
				$seg=$diagnosticos->SEGUIMIENTO;
				}else{
				$diagtext="";
				$seg="No";
				}
			?>
			<tr role="row" class="even">
			<td class="sorting_1">{{$i.'.'}}</td>
			<td class="sorting_1"><input hidden value='{{$estudiante->CODIGO}}' name="dni[]" > {{$estudiante->APELLIDO1.' '.$estudiante->APELLIDO2.' '.$estudiante->NOMBRES}}</td>
			<td class="sorting_1"><textarea class="form-control" rows="5" id="comment" style="resize:none;" name="diagnostico[]">{{$diagtext}}</textarea></td>
			<td class="sorting_1"><select class="form-control" id="seguimiento" name="seguimiento[]">
               <?php if($seg=="No"){?>
               <option value="Si">Si</option>
               <option value="No" selected>No</option>
               <?php }else{ ?>
               <option value="Si" selected>Si</option>
               <option value="No">No</option>
               <?php } ?>
               </td></td>
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
	<input hidden value='{{$diagnosticoc}}' name="codigodiag" >
	<center><button type="submit" class="btn btn-primary">Enviar Diagnosticos</button></center></div>
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

