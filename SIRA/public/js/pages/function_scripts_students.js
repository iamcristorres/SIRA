$( document ).ready(function() {




	//SOLICITUD CERTIFICADOS

	$("#ticert").change(function() {
		var tipo_certificado=$("#ticert").val();
		if(tipo_certificado==2){
			$("#ano_space").css("display","block");
		}else{
			$("#ano_space").css("display","none");
		}
	});
});