@extends("layouts.administrative")

@section('head')
<title>Administrar Áreas</title>
@endsection

@section('cuerpo')
<div class="d-flex align-items-center p-5 text-white-50 bg-purple rounded box-shadow">
        <img class="mr-3" src="{{ url('/logo/'.$institucion->LOGO) }}" alt="" width="48" height="48">
        <div class="lh-100">
          <h3 class="mb-0 text-white lh-100">ADMINISTRAR ÁREAS</h3>
        </div>
</div>

<div class="my-3 p-3 bg-white rounded box-shadow">
	        <div class="row">
	        <div class="col-md-12">
	       	<center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create_new_area">Crear Nueva Área</button></center>
	        </div>
	        </div>
</div>

@include("administrative.Adm_areas.Modal.create_new_area")
@include("administrative.Adm_areas.Modal.edit_area")
<div class="my-3 p-3 bg-white rounded box-shadow">
<table id="example" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="example_info">
 <thead> <tr role="row">
 <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" style="width: 580px;" aria-sort="ascending">ÁREA</th> 
 <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 100px;">PERIODO ACADÉMICO</th> 
 <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 155px;">OPCIONES</th>  
 </tr>
 </thead> 
 <tbody> 

 @foreach($areas as $area)
<tr role="row" class="even">
<td class="sorting_1">{{$area->NOMBRE_AREA}}</td>
<td>{{$area->ANO}}</td>
<td><center><a href="{{url('/delete_area/'.$area->id)}}"><button><i class="fas fa-trash"></i></button></a>&nbsp;&nbsp;&nbsp;<button onclick="edit_area({{$area->id}},'{{url('/edit_area/')}}')"><i class="fas fa-edit"></i></button></center></td>
@endforeach


</tr>


</tbody>
</table>

</div>


@endsection

@section('space_scripts')
@endsection