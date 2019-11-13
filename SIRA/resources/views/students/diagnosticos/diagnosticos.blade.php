
@extends("layouts.studens")

@section('head')
<title>Consulta de Diagnosticos</title>
@endsection
@section('cuerpo')

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
<h4>Diagnosticos publicados en el periodo anual {{$institucion->ANO_ACTIVO}}</h4>
<br>
<table id="example" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="example_info">
 <thead> <tr role="row">
 <th tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 230px;" class="sorting" aria-label="CÓDIGO: activate to sort column ascending">CÓDIGO</th>
 <th tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 230px;" class="sorting" aria-label="PERIODO: activate to sort column ascending">PERIODO</th>
 <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="FECHA DE CORTE: activate to sort column ascending" style="width: 150x;" aria-sort="descending">FECHA DE CORTE</th> 
 <th tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 300px;" class="sorting" aria-label="OPCIONES: activate to sort column ascending">OPCIONES</th>

 </tr>
 </thead> 
<tbody>
@foreach($info as $codigodiag)

<tr role="row">
<td>{{$codigodiag->NO_DIAG}}</td>
<td>{{$codigodiag->PERIODO}}</td>
<td class="sorting sorting_1">{{$codigodiag->FECHA_CORTE}}</td>
<td><center><a href="{{url('/diagnostico_view/'.$codigodiag->NO_DIAG)}}"><i class="far fa-file-pdf"></i></a></center></td>
</tr>

@endforeach
</tbody>
</table>
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