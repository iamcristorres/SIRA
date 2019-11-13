@extends("layouts.teachers")

@section('head')
<title>Subida de Logros/Desempeños</title>
@endsection
@section('cuerpo')
<div class="d-flex align-items-center p-5 text-white-50 bg-purple rounded box-shadow">
        <img class="mr-3" src="{{ url('/logo/'.$institucion->LOGO) }}" alt="" width="48" height="48">
        <div class="lh-100">
          <h3 class="mb-0 text-white lh-100">ASIGNATURA:: {{$asignatura->NOMBRE_ASIGNATURA}}</h3>
          <small>Docente:: {{$asignatura->docente->APELLIDO1." ".$asignatura->docente->APELLIDO2." ".$asignatura->docente->NOMBRES}}</small>
        </div>
</div>


<div class="my-3 p-3 bg-white rounded box-shadow">
	<div class="row">
	<div class="col-md-12">
	      <h4>PRIMER PERIODO</h4>
	      <hr>
	      <div class="my-3 p-3 bg-white rounded box-shadow">
			<table id="examples" class="table table-striped table-bordered no-footer" style="width: 100%;" role="grid" aria-describedby="example_info">
 			<thead> <tr role="row">
 			<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" style="width: 100px;" aria-sort="ascending">LOGRO</th> 
 			<th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 500px;">DESCRIPCIÓN DEL LOGRO</th>
 			<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 150px;">OPCIONES</th>  
 			</tr>
 			</thead> 
 	
			<tbody>
			@foreach($logros as $logros1)
			@if($logros1->PERIODO==1)
			<tr role="row" class="even">
			<td class="sorting_1">{{$logros1->TIPO_LOGRO}}</td>
			<td>{{$logros1->DESCRIPCION}}</td>
			<td><center><a href="{{url('/delete_logro/'.$logros1->id_logro.'/'.$asignatura->id)}}"><button><i class="fas fa-trash"></i></button></a>&nbsp;&nbsp;&nbsp;<button onclick="edit_logro({{$logros1->id_logro}},'{{url('/edit_logro/')}}')"><i class="fas fa-edit"></i></button></center></td>
			</tr>
			@endif
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
	      <h4>SEGUNDO PERIODO</h4>
	      <hr>
	      <div class="my-3 p-3 bg-white rounded box-shadow">
			<table id="examples" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="example_info">
 			<thead> <tr role="row">
 			<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" style="width: 100px;" aria-sort="ascending">LOGRO</th> 
 			<th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 500px;">DESCRIPCIÓN DEL LOGRO</th>
 			<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 150px;">OPCIONES</th>  
 			</tr>
 			</thead> 
 	
			<tbody> 
			@foreach($logros as $logros2)
			@if($logros2->PERIODO==2)
			<tr role="row" class="even">
			<td class="sorting_1">{{$logros2->TIPO_LOGRO}}</td>
			<td>{{$logros2->DESCRIPCION}}</td>
			<td><center><a href="{{url('/delete_logro/'.$logros2->id_logro.'/'.$asignatura->id)}}"><button><i class="fas fa-trash"></i></button></a>&nbsp;&nbsp;&nbsp;<button onclick="edit_logro({{$logros2->id_logro}},'{{url('/edit_logro/')}}')"><i class="fas fa-edit"></i></button></center></td>
			</tr>
			@endif
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
	      <h4>TERCER PERIODO</h4>
	      <hr>
	      <div class="my-3 p-3 bg-white rounded box-shadow">
			<table id="examples" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="example_info">
 			<thead> <tr role="row">
 			<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" style="width: 100px;" aria-sort="ascending">LOGRO</th> 
 			<th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 500px;">DESCRIPCIÓN DEL LOGRO</th>
 			<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 150px;">OPCIONES</th>  
 			</tr>
 			</thead> 
 	
			<tbody> 
			@foreach($logros as $logros2)
			@if($logros2->PERIODO==3)
			<tr role="row" class="even">
			<td class="sorting_1">{{$logros2->TIPO_LOGRO}}</td>
			<td>{{$logros2->DESCRIPCION}}</td>
			<td><center><a href="{{url('/delete_logro/'.$logros2->id_logro.'/'.$asignatura->id)}}"><button><i class="fas fa-trash"></i></button></a>&nbsp;&nbsp;&nbsp;<button onclick="edit_logro({{$logros2->id_logro}},'{{url('/edit_logro/')}}')"><i class="fas fa-edit"></i></button></center></td>
			</tr>
			@endif
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
	      <h4>CUARTO PERIODO</h4>
	      <hr>
	      <div class="my-3 p-3 bg-white rounded box-shadow">
			<table id="examples" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="example_info">
 			<thead> <tr role="row">
 			<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" style="width: 100px;" aria-sort="ascending">LOGRO</th> 
 			<th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 500px;">DESCRIPCIÓN DEL LOGRO</th>
 			<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 150px;">OPCIONES</th>  
 			</tr>
 			</thead> 
 	
			<tbody> 
			@foreach($logros as $logros2)
			@if($logros2->PERIODO==4)
			<tr role="row" class="even">
			<td class="sorting_1">{{$logros2->TIPO_LOGRO}}</td>
			<td>{{$logros2->DESCRIPCION}}</td>
			<td><center><a href="{{url('/delete_logro/'.$logros2->id_logro.'/'.$asignatura->id)}}"><button><i class="fas fa-trash"></i></button></a>&nbsp;&nbsp;&nbsp;<button onclick="edit_logro({{$logros2->id_logro}},'{{url('/edit_logro/')}}')"><i class="fas fa-edit"></i></button></center></td>
			</tr>
			@endif
			@endforeach
			</tbody>
			</table>
			</div>
	</div>
	</div>
</div>

@include("teacher.logrosxasig.modal.logros_psubida")
@include("teacher.logrosxasig.modal.logros_edit")
<div class="my-3 p-3 bg-white rounded box-shadow">
	<div class="row">
	<div class="col-md-12">
	<center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#psubidalogros">Subir Logro</button></center></div>
	</div>
	</div>
</div>



@endsection

