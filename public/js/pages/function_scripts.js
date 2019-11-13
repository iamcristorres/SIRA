// administrative scripts

function nuevo_periodo(){

	$("#min").change(function() {
	var nota_minima=$("#min").val();
	$("#bjmin").val(nota_minima);
	$("#bjmax").attr("min",nota_minima);
	$("#max").attr("min",nota_minima);
	$("#max").attr("disabled",false);
	});

	$("#max").change(function() {
	var nota_maxima=$("#max").val();
	var nota_minima=$("#min").val();
	$("#maxsu").val(nota_maxima);
	$("#minsu").attr("max",nota_maxima-0.1);
	$("#apro").attr("disabled",false);
	$("#apro").attr("min",nota_minima);
	$("#apro").attr("max",nota_maxima);
	});

	$("#apro").change(function() {
	var aprobatoria=$("#apro").val();
	$("#minbas").val(aprobatoria);
	$("#bjmax").attr("max",aprobatoria-0.1);
	$("#maxbas").attr("min",aprobatoria);
	$("#bjmax").val(aprobatoria-0.1);
	$("#minsu").attr("disabled",false);
	});

	$("#minsu").change(function() {
	var valormax=$("#minsu").val();
	$("#maxal").attr("max",valormax-0.1);
	$("#minal").attr("disabled",false);
	$("#maxal").val(valormax-0.1);
	});

	$("#minal").change(function() {
	var valormax=$("#minal").val();
	$("#maxbas").val(valormax-0.1);
	});
	
}

function edit_course(id_curso,ruta){
	var i_grado_editar=$("#gradoe");
	var i_curso_editar=$("#cursoe");
	var i_docente_editar=$("#dircursoe");
	var i_id_course=$("#id_couse");
	var route=ruta+'/'+id_curso;
	$.get(route,function(res){
	$(res).each(function(key,value){
		i_grado_editar.val(value.id_grado);
		i_curso_editar.val(value.CURSO);
		i_docente_editar.val(value.DIR_CURSO);
		i_id_course.val(id_curso);
	});
	});	

	$("#edit_course").modal('toggle');
}

function edit_logro(id_logro,ruta){
	var periodo=$("#periodo_e");
	var tlogro=$("#tlogro_e");
	var description=$("#description_e");
	var id_asignature=$("#id_asignature_e");
	var id_logro_e=$("#id_logro_e");
	var route=ruta+'/'+id_logro;
	$.get(route,function(res){
	$(res).each(function(key,value){
		periodo.val(value.PERIODO);
		tlogro.val(value.TIPO_LOGRO);
		description.val(value.DESCRIPCION);
		id_asignature.val(value.id_asignatura);
		id_logro_e.val(id_logro);
	});
	});	

	$("#logros_edit").modal('toggle');
}

function edit_area(id_area,ruta){
	var i_nombre_editar=$("#nombre_areae");
	var i_periodo_editar=$("#periodo_acae");
	var i_id_area=$("#id_area");
	var route=ruta+'/'+id_area;
	$.get(route,function(res){
	$(res).each(function(key,value){
		i_nombre_editar.val(value.NOMBRE_AREA);
		i_periodo_editar.val(value.ANO);
		i_id_area.val(id_area);
	});
	});	

	$("#edit_area").modal('toggle');
}

function edit_asignatura(id_asignatura,ruta){
	var i_id_area=$("#e_area");
	var i_periodo_editar=$("#periodo_aca_e");
	var i_nombre_asignatura=$("#asignatura_e");
	var i_id_grado=$("#grado_asig_e");
	var i_id_curso=$("#curso_e");
	var i_id_docente=$("#docente_resp_e");
	var i_ihs=$("#ihs_e");
	var i_id_asignatura=$("#id_asignature");
	var route=ruta+'/'+id_asignatura;
	$.get(route,function(res){
	$(res).each(function(key,value){
		i_ihs.val(value.IHS);
		i_nombre_asignatura.val(value.NOMBRE_ASIGNATURA);
		i_id_area.val(value.id_area);
		i_periodo_editar.val(value.ANO);
		i_id_docente.val(value.id_docente);
		i_id_grado.val(value.id_grado);
		i_id_asignatura.val(id_asignatura);
	});
	});	

	$("#edit_asignatura").modal('toggle');
}

function mostrar_cursos(){

	$("#grado_asig").change(function() {
	var grado_id=$("#grado_asig").val();
	var route='curso/'+grado_id;
	var inputCursos=$("#curso");
	$.get(route,function(res){
		inputCursos.empty();
	$(res).each(function(key,value){
		inputCursos.append("<option value='"+value.id+"'>"+value.CURSO+"</option>");
	});
	});	

	});
}

function mostrar_cursos_e(){

	$("#grado_asig_e").change(function() {
	var grado_id=$("#grado_asig_e").val();
	var route='curso/'+grado_id;
	var inputCursos=$("#curso_e");
	$.get(route,function(res){
		inputCursos.empty();
	$(res).each(function(key,value){
		inputCursos.append("<option value='"+value.id+"'>"+value.CURSO+"</option>");
	});
	});	

	});
}


function mostrar_cursos_estudiante_i(){

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
}

function verificar_fecha_admin(){

	$("#fa").change(function() {
		var fecha_minima=$("#fa").val();
		$("#fcc").removeAttr("disabled");
		$("#fcc").attr("min",fecha_minima);
	});
}

function verificar_fecha_admind(){

	$("#fa_e").change(function() {
		var fecha_minima=$("#fa_e").val();
		$("#fcc_e").removeAttr("disabled");
		$("#fcc_e").attr("min",fecha_minima);
	});
}

function edit_diagnostico(id_diagnostico,ruta){
	var periodo=$("#periodo_e");
	var fecha_corte=$("#fc_e");
	var fecha_apertura=$("#fa_e");
	var fecha_cierre=$("#fcc_e");
	var id_diagnosticoi=$("#id_diagnostico");
	var fecha_publicacion=$("#fcp_e");
	var route=ruta+'/'+id_diagnostico;
	$.get(route,function(res){
	$(res).each(function(key,value){
		periodo.val(value.PERIODO);
		fecha_corte.val(value.FECHA_CORTE);
		fecha_apertura.val(value.FECHA_APERTURA);
		fecha_cierre.val(value.FECHA_CIERRE);
		id_diagnosticoi.val(id_diagnostico);
		fecha_publicacion.val(value.FECHA_PUBLICACION);
	});
	});	

	$("#edit_diagnostico").modal('toggle');
}

