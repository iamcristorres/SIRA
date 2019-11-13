<!DOCTYPE html>
<html>

    <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    {!!Html::style("css/bootstrap.min.css")!!}
    <link rel="stylesheet" type="text/css" href="https://www.ieliceosantateresita.edu.co/SIRA/public/jquery-ui-1.12.1/jquery-ui.min.css"/>
    {!!Html::script("js/core/jquery.3.2.1.min.js")!!}
    {!!Html::script("js/bootstrap.min.js")!!}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>
 	<script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>
  <script type="text/javascript" src="https://www.ieliceosantateresita.edu.co/SIRA/public/jquery-ui-1.12.1/jquery-ui.min.js"></script>
 	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  {!!Html::style("css/student_style/style_student.css")!!}

    @yield("head")
    </head>
    <body>
      

      <!-- STAR MENU --> 
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">

      

      <div class="collapse navbar-collapse" id="navbarsExample07">
      <ul class="navbar-nav mr-auto">

      <img src="{{ url('/logo/'.$institucion->LOGO) }}" width="40px" height="40px">

      <li class="nav-item">
      <a class="nav-link" href="{{url('/estudiante')}}"><i class="fas fa-home"></i> Inicio <span class="sr-only">(current)</span></a>
      </li>

      <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="/Summary/Commercial" data-target="#gcademica" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-chalkboard-teacher"></i> Registro Académico
      </a>
      <div class="dropdown-menu" id="gcademica">
      <a class="dropdown-item" href="{{url('/consulta_calificaciones')}}">Consulta de Calificaciones</a>
      <a class="dropdown-item" href="{{url('/consulta_diagnosticos')}}">Consulta de Diagnosticos</a>
      <a class="dropdown-item" href="{{url('/certsolicitud')}}">Solicitud de Certificados Virtuales</a>
      </div>
	  </li>


    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="/Summary/Commercial" data-target="#historicoaca" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-book"></i> Registro Historico SIRA
      </a>
      <div class="dropdown-menu" id="historicoaca">
      <a class="dropdown-item" href="{{url('/historico_calificaciones')}}">Historico de Calificaciones</a>
      </div>
    </li>


     <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="/Summary/Commercial" data-target="#cartera" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-hand-holding-usd"></i> Cartera
      </a>
      <div class="dropdown-menu" id="cartera">
      <a class="dropdown-item" href="{{url('/construction_page')}}">Ordenes de Pago</a>
      <a class="dropdown-item" href="{{url('/construction_page')}}">Impresión de Paz y Salvo (Financiero)</a>
      </div>
    </li>

      <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="/Summary/Commercial" data-target="#matriculas" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-address-card"></i> Matriculas
      </a>
      <div class="dropdown-menu" id="matriculas">
      <a class="dropdown-item" href="{{url('/construction_page')}}">Portal de Matriculas</a>
      </div>
      </li>

      </ul>

        <ul class="navbar-nav float-md-right">
        <li class="nav-item dropdown">
    	<a class="nav-link dropdown-toggle" href="/Summary/Commercial" data-target="#useroption" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
        Hola:: {{auth('student')->user()->NOMBRES}}
    	</a>
    	<div class="dropdown-menu" id="useroption">
        <a class="dropdown-item" href="{{url('/perfil')}}"><i class="fas fa-user-circle"></i> Perfil</a>
        <a class="dropdown-item" href="{{url('/logoute')}}"><i class="fas fa-power-off"></i> Cerrar Sesión</a>
    	</div>
		</li>
        </ul>
        </div>
      </div>
    </nav>
    <!-- END MENU -->
<div class="container">
@yield("cuerpo")
</div>


<footer>
  PORTAL SIRA (Sistema de Información y Registro Académico) - {{$institucion->NOMBRE_ESTABLECIMIENTO}}
</footer>
    
    </body>
    @yield("space_scripts")

    {!!Html::script("js/pages/function_scripts_students.js")!!}
    <script type="text/javascript" charset="utf-8">
			$('#example').DataTable( {

				"dom": "<'container'<'row'<'col-md-3'l><'col-md-offset-3'><'col-md-6'f>>>"+
					   "<'container'<'row'<'col-md-12't>>>"+"<'container'<'row'<'col-md-12'p>>>"
				,
        		"lengthMenu": [[10, 20,35 -1], [10, 20,35, "All"]],
        		"language": {
    				"info": "Mostrando _PAGE_ of _PAGES_",
    				"lengthMenu": "Mostrando _MENU_ Registros",
    				"search":         "Buscar:",
  					}
    		} );


      $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '< Ant',
 nextText: 'Sig >',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'yy-mm-dd',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
$(function () {
$(".datepicker").datepicker({
  changeMonth: true,
changeYear: true,
yearRange: "1990:yy"
});
});

		</script>


    
    

</html>