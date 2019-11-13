@extends("layouts.administrative")

@section('head')
<title>Curso {{$curso->CURSO}}</title>
@endsection

@section('cuerpo')

<div class="d-flex align-items-center p-5 text-white-50 bg-purple rounded box-shadow">
        <img class="mr-3" src="{{ url('/logo/'.$institucion->LOGO) }}" alt="" width="48" height="48">
        <div class="lh-100">
          <h3 class="mb-0 text-white lh-100">{{$curso->CURSO}}</h3>
          <small>Director de Curso:: {{$curso->docente->APELLIDO1." ".$curso->docente->APELLIDO2." ".$curso->docente->NOMBRES }}</small>
        </div>
</div>



<div class="my-3 p-3 bg-white rounded box-shadow">
	<h5>Impresión de Informes Evaluativos Periodicos Por Periodo. Año Académico: {{$institucion->ANO_ACTIVO}}</h5>
	<table class="table table-striped table-bordered dataTable no-footer">
		<thead> 
		<tr>
			<th>PERIODO 1.</th>
			<th>PERIODO 2.</th>
			<th>PERIODO 3.</th>
			<th>PERIODO 4.</th>
			<th>INFORME FINAL</th>
		</tr>
		</thead>
		<tr>
			<td><center><a href="{{url('/exportpdf/'.$curso->id)}}"><button type="button" class="btn btn-primary"><i class="fas fa-print"></i> Imprimir</button></a></center></td>
			<td><center><a href="{{url('/p2/'.$curso->id)}}"><button type="button" class="btn btn-primary"><i class="fas fa-print"></i> Imprimir</button></a></center></td>
			<td><center><a href="{{url('/p3/'.$curso->id)}}"><button type="button" class="btn btn-primary"><i class="fas fa-print"></i> Imprimir</button></a></center></td>
			<td><center><a href="{{url('/p4/'.$curso->id)}}"><button type="button" class="btn btn-primary"><i class="fas fa-print"></i> Imprimir</button></a></center></td>
			<td><center><a href="{{url('/fin/'.$curso->id)}}"><button type="button" class="btn btn-primary"><i class="fas fa-print"></i> Imprimir</button></a></center></td>
		</tr>
	</table>
</div>

<div class="my-3 p-3 bg-white rounded box-shadow">
	<h5>Consolidados y/o Sabana de Notas Año Académico: {{$institucion->ANO_ACTIVO}}</h5>
	<table class="table table-striped table-bordered dataTable no-footer">
		<thead> 
		<tr>
			<th>Por Asignatura</th>
			<th>Por Área</th>
		</tr>
		</thead>
		<tr>
			<td><center><a href="{{url('/consolids/'.$curso->id)}}"><button type="button" class="btn btn-primary"><i class="fas fa-print"></i> Imprimir</button></a></center></td>
			<td><center><a href=""><button type="button" class="btn btn-primary"><i class="fas fa-print"></i> Imprimir</button></a></center></td>
			
		</tr>
	</table>
</div>
@endsection

@section('space_scripts')
@endsection