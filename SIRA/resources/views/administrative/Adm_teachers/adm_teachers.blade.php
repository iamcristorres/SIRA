@extends("layouts.administrative")

@section('head')
<title>Docentes</title>
@endsection

@section('cuerpo')
<div class="d-flex align-items-center p-5 text-white-50 bg-purple rounded box-shadow">
        <img class="mr-3" src="{{ url('/logo/'.$institucion->LOGO) }}" alt="" width="48" height="48">
        <div class="lh-100">
          <h3 class="mb-0 text-white lh-100">ADMINISTRAR DOCENTES</h3>
        </div>
</div>

<div class="my-3 p-3 bg-white rounded box-shadow">
	        <div class="row">
	        <div class="col-md-12">
	       	<center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create_new_teacher">Registrar Nuevo Docente</button></center>
	        </div>
	        </div>
</div>



<div class="my-3 p-3 bg-white rounded box-shadow">
<table id="example" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="example_info">
 <thead> <tr role="row">
 <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" style="width: 100px;" aria-sort="ascending">CÓDIGO</th> 
 <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 250px;">APELLIDOS Y NOMBRES</th> 
 <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 50px;">DIRECTOR DE CURSO</th>
 <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 155px;">OPCIONES</th>  
 </tr>
 </thead> 
 @foreach($docentes as $docente)
 <?php $nombre=$docente->APELLIDO1.' '.$docente->APELLIDO2.' '.$docente->NOMBRES; ?>
<tr role="row" class="even">
<td class="sorting_1">{{$docente->CODIGO}}</td>
<td>{{$nombre}}</td>
<td>{{$docente->DIRECTOR_DE_CURSO}}</td>
<td><center><a href="{{url('/delete_teacher/'.$docente->CODIGO)}}"><button><i class="fas fa-trash"></i></button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{url('/view_teacher/'.$docente->CODIGO)}}"><button><i class="fas fa-eye"></i></button></a></center></td>
</tr>
@endforeach

</tbody>
</table>

</div>
@include("administrative.Adm_teachers.Modal.create_new_teacher")

@endsection

@section('space_scripts')
@endsection