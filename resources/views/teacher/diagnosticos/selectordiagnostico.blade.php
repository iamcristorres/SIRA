@extends("layouts.teachers")

@section('head')
<title>Selector de Diagnostico</title>
@endsection
@section('cuerpo')
<div class="d-flex align-items-center p-5 text-white-50 bg-purple rounded box-shadow">
        <img class="mr-3" src="{{ url('/logo/'.$institucion->LOGO) }}" alt="" width="48" height="48">
        <div class="lh-100">
          <h3 class="mb-0 text-white lh-100">DIAGNOSTICO ACTIVO A SUBIR</h3>
        </div>
</div>
@if(isset($messagee1))
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-danger" role="alert" id="alerta_message">
		<i class="fas fa-exclamation-triangle"></i> {{$messagee1}}<br>
		</div>
	</div>
</div>
@endif
<div class="my-3 p-3 bg-white rounded box-shadow">
	<div class="row">
	<div class="col-md-12">
	       <h4>Seleccione el codigo de diagnostico ACTIVO para el periodo anual::: {{$institucion->ANO_ACTIVO}}</h4>
	</div>
	</div>
</div>

<div class="my-3 p-3 bg-white rounded box-shadow">
	<form action="{{route('IraDiag')}}" method="post" enctype="multipart/form-data">
	{!!csrf_field()!!}
	<div class="row">
	<div class="col-md-5">
		<center>
			<label for="codigo">Periodo:</label>
               <select class="form-control" id="codigo" name="codigo">
               <option value="">Seleccione</option>
               @foreach($codigo_diagnosticos as $codigodiag)
               <?php $estado=0; ?>
               <?php $titulodiag= "Codigo:: ".$codigodiag->NO_DIAG." |||| Desde::".$codigodiag->FECHA_APERTURA." Hasta::".$codigodiag->FECHA_CIERRE; ?>
               <?php $actualdate=date("Y-m-d");
					$fi=$codigodiag->FECHA_APERTURA;
					$ff=$codigodiag->FECHA_CIERRE;

					if(($actualdate>=$fi)&&($actualdate<=$ff)){
					$estado=1;
				} ?>
				<?php if($estado==1) {?>
               <option value="{{$codigodiag->NO_DIAG}}">{{$titulodiag}}</option>
               <?php } ?>
               @endforeach
               </select>
		</center>
	</div>
	<div class="col-md-4">
	<br>
			<button type="submit" id="boton_env" name="boton_env" class="btn btn-primary" disabled >Ir</button>
		</div>
	</div>
	 </form>	
</div>

<div class="my-3 p-3 bg-white rounded box-shadow">
<table id="example" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="example_info">
 <thead> <tr role="row">
 <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" style="width: 50px;" aria-sort="ascending">No.</th> 
 <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 120px;">COD DIAG</th> 
 <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 120px;">CURSO</th> 
 <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 80px;">PERIODO</th>
 <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 155px;">FECHA PUBLICACIÓN</th>
 <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 155px;">OPCIONES</th>  
 </tr>
 </thead> 
 <tbody>
 @foreach($diagnosticos_post as $diagnostico_publicado)
 @foreach($cursos as $curso)
<tr role="row" class="even">
<td class="sorting_1"></td>
<td>{{$diagnostico_publicado->NO_DIAG}}</td>
<td>{{$curso->CURSO}}</td>
<td>{{$diagnostico_publicado->PERIODO}}</td>
<td>{{$diagnostico_publicado->FECHA_PUBLICACION}}</td>
<td><center><a href="{{url('/diagnosticos_curso/'.$diagnostico_publicado->NO_DIAG.'/'.$curso->CURSO)}}"><button><i class="fas fa-eye"></i> Ver</button></a></center></td>

</tr>
 @endforeach
 @endforeach
  </tbody>
 </table>
</div>


	</div>
</div>


@endsection

@section('space_scripts')
<script>
	$( document ).ready(function() {
		setTimeout(function(){
  		$("#alerta_message").alert('close');
		}, 2000);

		var codigo_diag=$("#codigo").val();

		if(codigo_diag!=""){
			$("#boton_env").removeAttr("disabled");
		}

		$("#codigo").change(function() {
			verificadordesbloqueador();
		})

	})

	function verificadordesbloqueador(){
		var codigo_diag=$("#codigo").val();
		if(codigo_diag!=""){
			$("#boton_env").removeAttr("disabled");
		}else{
			$("#boton_env").attr("disabled","diabled");
		}
	}
</script>
@endsection