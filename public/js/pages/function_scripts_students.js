$( document ).ready(function() {
	var tipo_certificado=$("#ticert").val();
	if(tipo_certificado==2){
			$("#ano_space").css("display","block");
		}else{
			$("#ano_space").css("display","none");
		}


	//SOLICITUD CERTIFICADOS
	
	$("#ticert").change(function() {
		var tipo_certificado=$("#ticert").val();
		if(tipo_certificado==2){
			$("#ano_space").css("display","block");
		}else{
			$("#ano_space").css("display","none");
		}
	});

	$("#ticert").click(function() {
		var tipo_certificado=$("#ticert").val();
		if(tipo_certificado==2){
			$("#ano_space").css("display","block");
		}else{
			$("#ano_space").css("display","none");
		}
	});




	// Busca Año Activo Certificado


	function queryAnoAct(idStudent){
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


});