@extends("layouts.administrative")

@section('head')
<title>Administrar Cursos</title>
@endsection

@section('cuerpo')
<div class="d-flex align-items-center p-5 text-white-50 bg-purple rounded box-shadow">
        <img class="mr-3" src="{{ url('/logo/'.$institucion->LOGO) }}" alt="" width="48" height="48">
        <div class="lh-100">
          <h3 class="mb-0 text-white lh-100">ADMINISTRAR CURSOS</h3>
        </div>
</div>

<div class="my-3 p-3 bg-white rounded box-shadow">
	        <div class="row">
	        <div class="col-md-12">
	       	<center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create_new_course">Crear Nuevo Curso</button></center>
	        </div>
	        </div>
</div>

@include("administrative.Adm_cursos.Modal.create_new_course")


<div class="my-3 p-3 bg-white rounded box-shadow">
<table id="example" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="example_info">
 <thead> <tr role="row">
 <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" style="width: 256px;" aria-sort="ascending">GRADO</th> 
 <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 100px;">CURSO</th> 
 <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 494px;">DIRECTOR DE CURSO</th>
 <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 155px;">N° ESTUDIANTES</th>
 <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 155px;">OPCIONES</th>  
 </tr>
 </thead> 
 <?php if(isset($cursos)){ ?>
<tbody> 

 @foreach($cursos as $curso)
@include("administrative.Adm_cursos.Modal.edit_course")
 <?php
 if(isset($curso->docente)){
 $nombre=$curso->docente->APELLIDO1." ".$curso->docente->APELLIDO2." ".$curso->docente->NOMBRES;
 }else{
 $nombre="SIN ASIGNAR";
 }
 ?>

<tr role="row" class="even">
<td class="sorting_1">{{$curso->grado->GRADO}}</td>
<td>{{$curso->CURSO}}</td>
<td>{{$nombre}}</td>
<td>H:0, M:0, T:0</td>
<td><center><a href="{{url('/delete_course/'.$curso->id)}}"><button><i class="fas fa-trash"></i></button></a>&nbsp;&nbsp;&nbsp;<button onclick="edit_course({{$curso->id}},'{{url('/edit_course/')}}')"><i class="fas fa-edit"></i></button>&nbsp;&nbsp;&nbsp;<a href="{{url('/view_courses/'.$curso->id)}}"><i class="fas fa-eye"></i></a></center></td>
@endforeach
</tr>


</tbody>
<?php } ?>
</table>

</div>


@endsection

@section('space_scripts')
@endsection