@extends("layouts.administrative")

@section('head')
<title>Estudiantes</title>
@endsection

@section('cuerpo')
<div class="d-flex align-items-center p-5 text-white-50 bg-purple rounded box-shadow">
        <img class="mr-3" src="{{ url('/logo/'.$institucion->LOGO) }}" alt="" width="48" height="48">
        <div class="lh-100">
          <h3 class="mb-0 text-white lh-100">ADMINISTRAR ESTUDIANTES</h3>
        </div>
</div>

<div class="my-3 p-3 bg-white rounded box-shadow">
	        <div class="row">
	        <div class="col-md-12">
	       	<center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create_new_student">Registrar Nuevo Estudiante</button></center>
	        </div>
	        </div>
</div>

@include("administrative.Adm_students.Modal.create_new_students")

<div class="my-3 p-3 bg-white rounded box-shadow">
<table id="example" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="example_info">
 <thead> <tr role="row">
 <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" style="width: 100px;" aria-sort="ascending">CÓDIGO</th> 
 <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 250px;">APELLIDOS Y NOMBRES</th> 
 <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 50px;">GRADO</th>
 <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 50px;">CURSO</th>
 <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 50px;">ESTADO</th>
 <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 155px;">OPCIONES</th>  
 </tr>
 </thead> 
 @foreach($estudiantes as $estudiante)
 <?php $nombre=$estudiante->APELLIDO1.' '.$estudiante->APELLIDO2.' '.$estudiante->NOMBRES; ?>
<tr role="row" class="even">
<td class="sorting_1">{{$estudiante->CODIGO}}</td>
<td>{{$nombre}}</td>
<td>{{$estudiante->GRADO}}</td>
<td>{{$estudiante->CURSO}}</td>
<td>{{$estudiante->ESTADO_DEL_ESTUDIANTE}}</td>
<td><center><a href=""><button><i class="fas fa-trash"></i></button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{url('/view_students/'.$estudiante->CODIGO)}}"><button><i class="fas fa-eye"></i></button></a></center></td>
</tr>
@endforeach

</tbody>
</table>

</div>

@endsection

@section('space_scripts')
<script>
	$( document ).ready(function() {
			$("#grado_ce").change(function() {

	var grado_id=$("#grado_ce").val();
	var route='curso_n/'+grado_id;
	var inputCursos=$("#curso");
	$.get(route,function(res){
		inputCursos.empty();
	$(res).each(function(key,value){
		inputCursos.append("<option value='"+value.CURSO+"'>"+value.CURSO+"</option>");
	});
	});	

	});
	});
</script>
@endsection