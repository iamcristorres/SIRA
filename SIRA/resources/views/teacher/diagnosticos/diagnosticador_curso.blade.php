@extends("layouts.teachers")
@section('head')
<title>{{$cod_diagnostico ." - ". $curso}}</title>
<?php 
use App\Encryption;
use Illuminate\Support\Facades\Crypt;
use App\visualizador_diagnostico;
use App\coddiagnostico;
?>
@endsection
@section('cuerpo')
<div class="d-flex align-items-center p-5 text-white-50 bg-purple rounded box-shadow">
        <img class="mr-3" src="{{ url('/logo/'.$institucion->LOGO) }}" alt="" width="48" height="48">
        <div class="lh-100">
          <h3 class="mb-0 text-white lh-100">DIAGNOSTICO:: {{$cod_diagnostico}}</h3>
          <small>Director de Curso: {{auth('teachers')->user()->APELLIDO1." ".auth('teachers')->user()->APELLIDO2." ".auth('teachers')->user()->NOMBRES}}</small>
        </div>
</div>

@if(Session::has('success'))
<div class="row">
        <div class="col-md-12">
        <div class="card-header messagepost" style="background-color:#026C18;" id="error_logueo">
        <center><h6 style="color:#fff;"><i class="fas fa-check-circle"></i> {{ Session::get('success') }}</h6></center>
        </div>  
        </div>
        </div>
<br>
@endif
@if(Session::has('error'))
<div class="row">
        <div class="col-md-12">
        <div class="card-header messagepost" style="background-color:#AB001F;" id="error_logueo">
        <center><h6 style="color:#fff;"><i class="fas fa-times-circle"></i> {{ Session::get('errors') }}</h6></center>
        </div>  
        </div>
        </div>
<br>
@endif



<div class="my-3 p-3 bg-white rounded box-shadow">
	<div class="row">
	<div class="col-md-12">
	      <h4>CURSO:: {{$curso}} </h4>
	      <center><a href="{{url('/diagnostico_view_course/'.$cod_diagnostico.'/'.$curso)}}"><button class="btn btn-primary">Ver Diagnosticos PDF</button></a></center>
	      <hr>
	      <form action="{{route('SaveDiagnosticosComm')}}" method="post" enctype="multipart/form-data">
	      {{ csrf_field() }}
	      <div class="my-3 p-3 bg-white rounded box-shadow">
			<table id="examples" class="table table-striped table-bordered no-footer" style="width: 100%;" role="grid" aria-describedby="example_info">
 			<thead> <tr role="row">
 			<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" style="width: 50px;" aria-sort="ascending">No</th> 
 			<th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 500px;">APELLIDOS Y NOMBRES</th>
 			<th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 1000px;">COMENTARIO DIR CURSO</th>
 			<th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 300px;">VISUALIZADO</th>
 			</tr>
 			</thead> 
 	
			<tbody>
			<?php $i=1; ?>
			@foreach($estudiantes as $estudiante)
			<?php
			$diagnotico_info=coddiagnostico::where('NO_DIAG','=',$cod_diagnostico)->first();
			$fecha_publicacion=$diagnotico_info->FECHA_PUBLICACION;
			$actualdate=date("Y-m-d");
			$comm=visualizador_diagnostico::where('ESTUDIANTE','=',$estudiante->CODIGO)->where('COD_DIAG','=',$cod_diagnostico)->first();
				$comentario_dircurso="";
				$comentario_padre="";
				$comentario_estudiante="";
				$visto="";
			if(isset($comm)){
				$comentario_dircurso=$comm->COMENTARIO_DIRCURSO;
				$comentario_padre=$comm->COMENTARIO_PADRE;
				$comentario_estudiante=$comm->COMENTARIO_ESTUDIANTE;
				$visto=$comm->VISTO." ".$comm->FECHA_VISTO;
			}
			?>
			<tr role="row" class="even">
			<td class="sorting_1">{{$i.'.'}}</td>
			<td class="sorting_1"><input hidden value='{{$estudiante->CODIGO}}' name="dni[]" > {{$estudiante->APELLIDO1.' '.$estudiante->APELLIDO2.' '.$estudiante->NOMBRES}}</td>
			@if($actualdate<$fecha_publicacion)
			<td class="sorting_1"><textarea class="form-control" rows="5" id="comment" style="resize:none;" name="diagnostico[]">{{$comentario_dircurso}}</textarea></td>
			@else
			<td class="sorting_1"><textarea class="form-control" rows="5" id="comment" style="resize:none;" name="diagnostico[]" disabled>{{$comentario_dircurso}}</textarea></td>
			@endif
			<td class="sorting_1"><center>{{$visto}}</center></td>
			</tr>
			@endforeach
			<?php $i++; ?>
			</tbody>
			</table>
			</div>
	</div>
	</div>
</div>
@if($actualdate<$fecha_publicacion)
<div class="my-3 p-3 bg-white rounded box-shadow">
	<div class="row">
	<div class="col-md-12">
	<input type="hidden" name="coddiagn" value="{{$cod_diagnostico}}">
	<input type="hidden" name="curso" value="{{$curso}}">
	<center><button type="submit" class="btn btn-primary">Enviar Comentarios</button></center></div>
	</div>
</div>
@endif
</div>
</form>

@endsection

@section('space_scripts')
<script>
	$( document ).ready(function() {

		
	})
</script>
@endsection

