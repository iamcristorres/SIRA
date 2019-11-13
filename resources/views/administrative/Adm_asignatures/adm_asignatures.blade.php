@extends("layouts.administrative")

@section('head')
<title>Administrar Cursos</title>
@endsection

@section('cuerpo')
<div class="d-flex align-items-center p-5 text-white-50 bg-purple rounded box-shadow">
        <img class="mr-3" src="{{ url('/logo/'.$institucion->LOGO) }}" alt="" width="48" height="48">
        <div class="lh-100">
          <h3 class="mb-0 text-white lh-100">ADMINISTRAR ASIGNATURAS</h3>
        </div>
</div>

<div class="my-3 p-3 bg-white rounded box-shadow">
	        <div class="row">
	        <div class="col-md-12">
	       	<center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create_new_asignatura">Crear Asignatura</button></center>
	        </div>
	        </div>
</div>
@include("administrative.Adm_asignatures.Modal.create_new_asignatura")

<div class="my-3 p-3 bg-white rounded box-shadow">
<table id="example" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="example_info">
 <thead> <tr role="row">
 <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" style="width: 400px;" aria-sort="ascending">ASIGNATURA</th> 
 <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 400px;">ÁREA</th> 
 <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 100px;">CURSO</th>
 <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 300px;">DOCENTE</th>
 <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 155px;">OPCIONES</th>  
 </tr>
 </thead>


@foreach($asignaturas as $asignatura)
 <?php $nombre_docente=""; if(isset($asignatura->docente->APELLIDO1)){
 $nombre_docente=$asignatura->docente->APELLIDO1.' '.$asignatura->docente->APELLIDO2.' '.$asignatura->docente->NOMBRES;
 	}else{
 $nombre_docente="SIN ASIGNAR";
 		} ?>
@include("administrative.Adm_asignatures.Modal.edit_asignatura")
<tr role="row" class="even">
<td class="sorting_1">{{$asignatura->NOMBRE_ASIGNATURA}}</td>
<td>{{$asignatura->area->NOMBRE_AREA}}</td>
<td>{{$asignatura->curso->CURSO}}</td>
<td>{{$nombre_docente}}</td>
<td><center><a href="{{url('/view_asignatura/'.$asignatura->id)}}"><button><i class="fas fa-eye"></i></button></a>&nbsp;&nbsp;&nbsp;<a href="{{url('/detele_asignature/'.$asignatura->id)}}"><button><i class="fas fa-trash"></i></button></a>&nbsp;&nbsp;&nbsp;<button onclick="edit_asignatura({{$asignatura->id}},'{{url('/edit_asignatura/')}}')"><i class="fas fa-edit"></i></button></center></td>
</tr>
@endforeach
</tbody>
</table>

</div>


@endsection
@section('space_scripts')
{!!Html::script("js/pages/function_adm_asignatures.js")!!}
@endsection