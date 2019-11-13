
@extends("layouts.studens")

@section('head')
<title>Perfil</title>
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
        <center><h6 style="color:#fff;"><i class="fas fa-times-circle"></i> {{ Session::get('errors') }}</h6></center>
        </div>  
        </div>
        </div>
<br>
@endif

@if (count($errors) > 0)
<div class="row">
        <div class="col-md-12">
        <div class="card-header messagepost" style="background-color:#AB001F;" id="error_logueo">
        <center><h6 style="color:#fff;">ERROR no se actualizo la información. Hace falta la siguiente información por registrar:</br>
        @foreach ($errors->all() as $message)
        		<br>
                <center><i class="fas fa-times-circle"></i> {{ $message }}</center>
            @endforeach
        </h6></center>
        </div>  
        </div>
        </div>
<br>
@endif

<br>
<center><h4>Perfil</h4></center>

<div class="row">
	<div class="col-md-3 bg-white border">
		<br>
		<br>
		<center><button type="button" class="btn btn-green" data-toggle="modal" data-target="#pinformation">Editar Información Personal</button></center>
		<br>
		<br>
		<center><button type="button" class="btn btn-green" data-toggle="modal" data-target="#finformation">Editar Información Familiar</button></center>
		<br>
		<br>
		<center><button type="button" class="btn btn-green" data-toggle="modal" data-target="#asira">Ver Ficha Académica SIRA</button></center>
		<br>
		<br>
	</div>
	<div class="col-md-offset-1 col-md-8 border">
		<div class="row m-3">
			<div class="col-md-3">
			 {!!Form::label("CÓDIGO",null,['class' => 'textsm'])!!}
             {!!Form::text("code",$estudiante->CODIGO,["class"=>"form-control","placeholder"=>"CÓDIGO DEL ESTUDIANTE",'readonly' => 'true','disabled' => 'true'])!!}
             </div>
			<div class="col-md-5">
			{!!Form::label("APELLIDOS",null,['class' => 'textsm'])!!}
            {!!Form::text("apellidos",mb_strtoupper ($estudiante->APELLIDO1.' '.$estudiante->APELLIDO2,'UTF-8'),["class"=>"form-control","placeholder"=>"APELLIDOS",'readonly' => 'true','disabled' => 'true'])!!}
            </div>
			<div class="col-md-4">
			{!!Form::label("NOMBRES",null,['class' => 'textsm'])!!}
            {!!Form::text("nombres",mb_strtoupper ($estudiante->NOMBRES,'UTF-8'),["class"=>"form-control","placeholder"=>"NOMBRES",'readonly' => 'true','disabled' => 'true'])!!}
			</div>
		</div>
		<div class="row m-3">
			<div class="col-md-4">
			 {!!Form::label("TIPO DE DOCUMENTO",null,['class' => 'textsm'])!!}
             {!!Form::text("tipodoc",$estudiante->TIPO_DE_DOCUMENTO,["class"=>"form-control","placeholder"=>"TIPO DE DOCUMENTO",'readonly' => 'true','disabled' => 'true'])!!}
             </div>
			<div class="col-md-4">
			{!!Form::label("NUMERO DE DOCUMENTO",null,['class' => 'textsm'])!!}
            {!!Form::text("nudoc",number_format($estudiante->NUMERO_DE_DOCUMENTO, 0, '', '.'),["class"=>"form-control","placeholder"=>"NUMERO DE DOCUMENTO",'readonly' => 'true','disabled' => 'true'])!!}
            </div>
			<div class="col-md-4">
			{!!Form::label("M. EXPEDICION",null,['class' => 'textsm'])!!}
            {!!Form::text("m_expedicion",null,["class"=>"form-control","placeholder"=>"M. EXPEDICION",'readonly' => 'true','disabled' => 'true'])!!}
			</div>
		</div>
		<div class="row m-3">
			<div class="col-md-6">
			 {!!Form::label("CORREO ELECTRONICO",null,['class' => 'textsm'])!!}
             {!!Form::text("correo",$estudiante->CORREO_ELECTRONICO,["class"=>"form-control","placeholder"=>"CORREO ELECTRONICO",'readonly' => 'true','disabled' => 'true'])!!}
             </div>
			<div class="col-md-3">
			{!!Form::label("ESTADO ACTUAL",null,['class' => 'textsm'])!!}
            {!!Form::text("estado",$estudiante->ESTADO_DEL_ESTUDIANTE,["class"=>"form-control","placeholder"=>"ESTADO ACTUAL",'readonly' => 'true','disabled' => 'true'])!!}
            </div>
            <div class="col-md-3">
			{!!Form::label("T. DE ESTUDIANTE",null,['class' => 'textsm'])!!}
            {!!Form::text("tipoest",$estudiante->TIPO_DE_ESTUDIANTE,["class"=>"form-control","placeholder"=>"TIPO DE ESTUDIANTE",'readonly' => 'true','disabled' => 'true'])!!}
            </div>
		</div>
		<br>
		<div class="row m-3">
			<div class="col-md-12">
				<center><button type="button" class="btn btn-red" data-toggle="modal" data-target="#pass"><i class="fa fa-key" aria-hidden="true"></i> Cambiar Contraseña</button></center>
			</div>
		</div>
	</div>
</div>
@include("students.perfil.Modal.pass")
@include("students.perfil.Modal.personal_information")
@include("students.perfil.Modal.familiar_information")
@include("students.perfil.Modal.academic_sira")
<br>
@endsection
@section('space_scripts')

<script>
	function departamento1(jQuery){
	var dep_id=$("#departamento").val();
	var route='municipio/'+dep_id;
	var inputMunicipio=$("#municipio");
	var vMunicipio=$("#municipio").val();
	$.get(route,function(res){
		inputMunicipio.empty();
	$(res).each(function(key,value){
		if(vMunicipio!=value.ID){
		inputMunicipio.append("<option value='"+value.ID+"'>"+value.NOMBRE_MUNICIPIO+"</option>");
	}else{
		inputMunicipio.append("<option value='"+value.ID+"' selected>"+value.NOMBRE_MUNICIPIO+"</option>");
	}
	});
	});
	}
	function departamento2(jQuery){
	var dep_id=$("#departamento2").val();
	var route='municipio/'+dep_id;
	var inputMunicipio=$("#municipio2");
	var vMunicipio=$("#municipio2").val();
	$.get(route,function(res){
		inputMunicipio.empty();
	$(res).each(function(key,value){
		if(vMunicipio!=value.ID){
		inputMunicipio.append("<option value='"+value.ID+"'>"+value.NOMBRE_MUNICIPIO+"</option>");
	}else{
		inputMunicipio.append("<option value='"+value.ID+"' selected>"+value.NOMBRE_MUNICIPIO+"</option>");
	}
	});
	});
	}
	function departamento3(jQuery){
	var dep_id=$("#departamento3").val();
	var route='municipio/'+dep_id;
	var inputMunicipio=$("#municipio3");
	var vMunicipio=$("#municipio3").val();
	$.get(route,function(res){
		inputMunicipio.empty();
	$(res).each(function(key,value){
		if(vMunicipio!=value.ID){
		inputMunicipio.append("<option value='"+value.ID+"'>"+value.NOMBRE_MUNICIPIO+"</option>");
	}else{
		inputMunicipio.append("<option value='"+value.ID+"' selected>"+value.NOMBRE_MUNICIPIO+"</option>");
	}
	});
	});
	}

	function sisbenpuntaje(){
		var tiene_sisben=$("#sisbenti").val();
		if(tiene_sisben=="Si"){
			$("#puntajed").css("display","block");
		}else{
			$("#puntajed").css("display","none");
		}

	}

	$( document ).ready(function() {
	$(document).ready(departamento1);
	$(document).ready(departamento2);
	$(document).ready(departamento3);
	$(document).ready(sisbenpuntaje);
	$("#departamento").bind('load change',function(){
	var dep_id=$("#departamento").val();
	var route='municipio/'+dep_id;
	var inputMunicipio=$("#municipio");
	$.get(route,function(res){
		inputMunicipio.empty();
	$(res).each(function(key,value){
		inputMunicipio.append("<option value='"+value.ID+"'>"+value.NOMBRE_MUNICIPIO+"</option>");
	});
	});	
	});

	$("#departamento2").change(function(){
	var dep_id=$("#departamento2").val();
	var route='municipio/'+dep_id;
	var inputMunicipio=$("#municipio2");
	$.get(route,function(res){
		inputMunicipio.empty();
	$(res).each(function(key,value){
		inputMunicipio.append("<option value='"+value.ID+"'>"+value.NOMBRE_MUNICIPIO+"</option>");
	});
	});	
	});

	$("#departamento3").change(function(){
	var dep_id=$("#departamento3").val();
	var route='municipio/'+dep_id;
	var inputMunicipio=$("#municipio3");
	$.get(route,function(res){
		inputMunicipio.empty();
	$(res).each(function(key,value){
		inputMunicipio.append("<option value='"+value.ID+"'>"+value.NOMBRE_MUNICIPIO+"</option>");
	});
	});	
	});

	$("#sisbenti").change(function(){
		var tiene_sisben=$("#sisbenti").val();
		if(tiene_sisben=="Si"){
			$("#puntajed").css("display","block");
		}else{
			$("#puntajed").css("display","none");
		}
	});


	});
</script>

@endsection