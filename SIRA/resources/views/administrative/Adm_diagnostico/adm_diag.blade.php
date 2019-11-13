@extends("layouts.administrative")

@section('head')
<title>Administrar Diagnosticos</title>
@endsection

@section('cuerpo')
<div class="d-flex align-items-center p-5 text-white-50 bg-purple rounded box-shadow">
        <img class="mr-3" src="{{ url('/logo/'.$institucion->LOGO) }}" alt="" width="48" height="48">
        <div class="lh-100">
          <h3 class="mb-0 text-white lh-100">ADMINISTRAR DIAGNOSTICOS AÑO {{$institucion->ANO_ACTIVO}}</h3>
        </div>
</div>

<?php if(Session::get('message') !== null) {?>
<div class="alert alert-success" role="alert" id='alerta_message'><i class="far fa-check-circle"></i> {{ Session::get('message') !== null ? Session::get('message') : '' }}</div>
<?php } ?>

<div class="my-3 p-3 bg-white rounded box-shadow">
	        <div class="row">
	        <div class="col-md-12">
	       	<center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create_new_diagnostico">Crear Nuevo Diagnostico</button></center>
	        </div>
	        </div>
</div>

@include("administrative.Adm_diagnostico.Modal.create_new_diagnostico")
@include("administrative.Adm_diagnostico.Modal.edit_diagnostico")
<div class="my-3 p-3 bg-white rounded box-shadow">
<table id="example" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="example_info">
 <thead> <tr role="row">
 <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" style="width: 50px;" aria-sort="ascending">No.</th> 
 <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 120px;">COD DIAG</th> 
 <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 80px;">PERIODO</th>
 <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 155px;">FECHA CORTE</th>
 <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 155px;">FECHA INICIO</th>
 <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 155px;">FECHA CIERRE</th>
 <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 70px;">ESTADO</th>
 <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 155px;">OPCIONES</th>  
 </tr>
 </thead> 
 
<tbody>
@foreach($diagnosticos as $diagnostico)
<?php
$estado=0;
$actualdate=date("Y-m-d");
$fi=$diagnostico->FECHA_APERTURA;
$ff=$diagnostico->FECHA_CIERRE;

if(($actualdate>=$fi)&&($actualdate<=$ff)){
	$estado=1;
}

?>
<tr role="row" class="even">
<td class="sorting_1"></td>
<td>{{$diagnostico->NO_DIAG}}</td>
<td>{{$diagnostico->PERIODO}}</td>
<td>{{$diagnostico->FECHA_CORTE}}</td>
<td>{{$diagnostico->FECHA_APERTURA}}</td>
<td>{{$diagnostico->FECHA_CIERRE}}</td>
<?php if($estado==1){ ?>
<td><center><span class="badge badge-success">Activo</span></center></td>
<?php }else { ?>
<td><center><span class="badge badge-danger">Inactivo</span></center></td>
<?php } ?>
<td><center><a href="{{url('/delete_diagnostico/'.$diagnostico->ID)}}"><button><i class="fas fa-trash"></i></button></a>&nbsp;&nbsp;&nbsp;<button onclick="edit_diagnostico({{$diagnostico->ID}},'{{url('/edit_diagnostico/')}}')"><i class="fas fa-edit"></i></button></center></td>
</tr>
@endforeach

</tbody>
</table>

</div>


@endsection

@section('space_scripts')
{!!Html::script("js/pages/function_adm_asignatures.js")!!}
@endsection