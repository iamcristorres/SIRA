
@extends("layouts.studens")

@section('head')
<title>Solicitud de Certificados</title>
@endsection
@section('cuerpo')

@if(Session::has('success'))
<div class="row">
        <div class="col-md-12">
        <div class="card-header messagepost" style="background-color:#026C18;" id="error_logueo">
        <center><h6 style="color:#fff;"><i class="fas fa-check-circle"></i> {{ Session::get('success') }}</h6></center>
        </div>  
        </div>
        </div>
<br>
@endif

@if(Session::has('error'))
<div class="row">
        <div class="col-md-12">
        <div class="card-header messagepost" style="background-color:#AB001F;" id="error_logueo">
        <center><h6 style="color:#fff;"><i class="fas fa-times-circle"></i> {{ Session::get('error') }}</h6></center>
        </div>  
        </div>
        </div>
<br>
@endif


<div class="my-3 p-3 bg-white rounded box-shadow">
	        <div class="row">
	        <div class="col-md-12">
	        <h6 class="border-bottom border-gray pb-2 mb-0">Código: {{auth('student')->user()->CODIGO}} ::: Estudiante: {{auth('student')->user()->NOMBRES." ".auth('student')->user()->APELLIDO1." ".auth('student')->user()->APELLIDO2 }} ::: GRADO: {{$estudiante->GRADO}} ::: CURSO: {{$estudiante->CURSO}} ::: ESTADO: {{$estudiante->ESTADO_DEL_ESTUDIANTE}}</h6>
	        </div>
	        </div>
</div>
<br>

<div class="row">
	        <div class="col-md-12">
	        <center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#solcert">Solicitud Nueva</button></center>
	        </div>
	        </div>

<br>
@include("students.solicitud_cert.Modal.new_cert")

<div class="row">
	<div class="col-md-12">
  @if($solicitudes==0)
		<center><h3><i class="fas fa-exclamation-triangle"></i> No tienes certificados solicitados disponibles</h3></center>
    @else


		<table class="table table-bordered">
    	<thead>
      	<tr>
        <th>REFERENCIA</th>
        <th>ESTUDIANTE</th>
        <th>TIPO CERTIFICADO</th>
        <th>ANO</th>
        <th>VALOR</th>
        <th>ESTADO</th>
        <th>DISPONIBLE HASTA</th>
        <th>OPCIONES DISPONIBLES</th>
      	</tr>
    	</thead>
    	<tbody>

      @foreach($certificados as $certificado)
      	<tr>
        <td>{{$certificado->REFERENCIA}}</td>
        <td>{{$certificado->CODIGO_ES}}</td>
        <td>{{$certificado->cost_certificates->TIPO_CERTIFICADO}}</td>
        <td>{{$certificado->ANO}}</td>
        <td>$ {{$certificado->VALOR}} COP</td>
        <td><center>@if($certificado->ESTADO=="NO PAGO")
        <span class="badge badge-danger" style="background-color: red;">NO PAGO</span>
        @else
        <span class="badge badge-success" style="background-color: green;">PAGO</span>
        @endif
        </center></td>
        <td>{{$certificado->FECHA_FIN}}</td>

        <?php
        $nombrecompleto=$estudiante->APELLIDO1." ".$estudiante->APELLIDO2." ".$estudiante->NOMBRES;
        $firmav=$infopago->API_KEY."~".$infopago->merchantId."~".$certificado->REFERENCIA."~".$certificado->VALOR."~COP";
        $texto_codificado=md5($firmav);
        ?>

        @if($certificado->ESTADO=="NO PAGO")
          <form method="post" action="https://checkout.payulatam.com/ppp-web-gateway-payu">
          <input name="merchantId"    type="hidden"  value="{{$infopago->merchantId}}"   >
          <input name="accountId"     type="hidden"  value="{{$infopago->acountId}}" >
          <input name="description"   type="hidden"  value="{{$certificado->cost_certificates->TIPO_CERTIFICADO}}"  >
          <input name="referenceCode" type="hidden"  value="{{$certificado->REFERENCIA}}" >
          <input name="amount"        type="hidden"  value="{{$certificado->VALOR}}"   >
          <input name="tax"           type="hidden"  value="0"  >
          <input name="taxReturnBase" type="hidden"  value="0" >
          <input name="currency"      type="hidden"  value="COP" >
          <input name="signature"     type="hidden"  value="{{$texto_codificado}}"  >
          <input name="test"          type="hidden"  value="0" >
          <input name="buyerFullName"   type="hidden"  value="<?php echo $nombrecompleto;?>" >
          <input name="buyerEmail"    type="hidden"  value="{{$estudiante->CORREO_ELECTRONICO}}" >
         @endif
        <td><center>
        @if($certificado->ESTADO=="NO PAGO")
        <input name="Submit"        type="submit"  value="Pago Online" >
        </form>
        @else
        <a href="{{url('/certificate_view/'.$certificado->TIPO_CERT.'/'.$certificado->REFERENCIA)}}"><button type="button" class="btn btn-primary"> <i class="fas fa-eye"></i> Ver</button></a>

        @endif
        </center>
        </td>
        </tr>
      @endforeach
      	</tbody>
      	</table>

        @endif

	</div>
</div>
@endsection
@section('space_scripts')
@endsection