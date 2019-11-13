
@extends("layouts.studens")

@section('head')
<title>Bienvenido</title>
@endsection
@section('cuerpo')


<?php 
use App\coddiagnostico;
$hoy=date("Y-m-d");
$activo="INACTIVO";
if(!isset($verificador)){
	$vernum=0;
}else{
	$vernum=$verificador->VER1;
}
?>
@if($vernum==0)
@include("students.dashboard.Modal.information_date_initial")
<center><button class="btn btn-primary" data-toggle="modal" data-target="#information_inicial">Modal</button></center>
@endif


@if($vernum==1)
@include("students.dashboard.Modal.confirmationone")
<center><button class="btn btn-primary" data-toggle="modal" data-target="#confirmation_one">Modal</button></center>

@endif


@if(Session::has('messageend'))
<div class="row">
        <div class="col-md-12">
        <div class="card-header messagepost" style="background-color:#026C18;" id="error_logueo">
        <center><h6 style="color:#fff;"><i class="fas fa-check-circle"></i> {{ Session::get('messageend') }}</h6></center>
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
	        <h4 class="border-bottom border-gray pb-2 mb-0">Bienvenido(a) {{auth('student')->user()->NOMBRES." ".auth('student')->user()->APELLIDO1." ".auth('student')->user()->APELLIDO2 }}  ::: PERIODO ACTIVO {{$institucion->ANO_ACTIVO}}</h4>
	        </div>
	        </div>
</div>


<div class="my-3 p-3 bg-white rounded box-shadow">
<div class="row p-3">
  <div class="col-md-8">
  <div class="card mb-4 box-shadow">
          <div class="card-header bluecolor">
            <h4 class="my-0 texttitlecolor">ORDENES DE PAGO PROXIMAS A VENCER</h4>
          </div>
          <div class="card-body">

            <table class="table table-hover">
            <tbody>
            <tr>
            
            <?php
            $ordenc=$ordenes->count();
            if($ordenc>0){
            ?>
            <a href="#"><td><strong class="titlebar"><i class="fas fa-calendar-check"></i> PENSIÓN MES DE AGOSTO - 2019</strong><br>
                <strong class="moneybar">$ 130.000,00 COP</strong>&nbsp;&nbsp;&nbsp;<small style="text-align: right;">Vencimiento: 05-agosto-2019</small>
            </td></a>
            <?php }else{ ?>

            <td><center><h4>No tienes Ordenes de Pago</h4></center>
            </td>
            <?php } ?>
            </tr>
            </tbody>
            </table>

            <a href="#"><span style="text-align: right;">Ver todas las ordenes de pago</span></a>
          </div>
        </div>
  </div>
   <div class="col-md-4">
     <div class="card mb-4 box-shadow">
          <div class="card-header redcolor">
            <h4 class="my-0 texttitlecolor">PENDIENTES</h4>
          </div>
          <div class="card-body">
<?php 
  foreach($diagnosticopend as $diagnosticoestudiante){
    $codigo=$diagnosticoestudiante->COD_DIAG;

    $conteodiag=coddiagnostico::where('NO_DIAG','=',$codigo)->first();

    if($conteodiag->FECHA_PUBLICACION<=$hoy){
      $activo="ACTIVO";
    }

  }

  if($activo=="ACTIVO"){
?>
            <a href="{{url('/consulta_diagnosticos')}}"><td><strong class="titlebar"><i class="fas fa-book"></i> TIENES DIAGNOSTICOS PENDIENTES POR VER</strong><br>
            </td></a>
<?php } ?>
          </div>
        </div>
  </div>
</div>
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