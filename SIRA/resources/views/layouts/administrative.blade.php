<!DOCTYPE html>
<html>

    <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    
    {!!Html::style("css/bootstrap.min.css")!!}
    
    {!!Html::script("js/core/jquery.3.2.1.min.js")!!}

    {!!Html::script("js/bootstrap.min.js")!!}

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>
 	<script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.min.js"></script>
   <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css"/>
 	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
 	{!!Html::style("css/style.css")!!}	
    @yield("head")
    </head>
    <body>
      

      <!-- STAR MENU --> 
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">

      

      <ul class="navbar-nav mr-auto">

      <img src="{{ url('/logo/'.$institucion->LOGO) }}" width="40px" height="40px">

      <li class="nav-item">
      <a class="nav-link" href=""><i class="fas fa-home"></i> Inicio <span class="sr-only">(current)</span></a>
      </li>

      <li class="nav-item">
      <a class="nav-link" href="{{url('/school')}}"><i class="fas fa-school"></i> Su Institución</a>
      </li>

      <li class="nav-item dropdown">
   	  <a class="nav-link dropdown-toggle" href="/Summary/Commercial" data-target="#registrom" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-book"></i> Registro
      </a>
      <div class="dropdown-menu" id="registrom">
        <a class="dropdown-item" href="{{url('/teachers')}}">Docentes</a>
        <a class="dropdown-item" href="{{url('/students')}}">Estudiantes</a>
      </div>
	  </li>

      <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="/Summary/Commercial" data-target="#gcademica" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-chalkboard-teacher"></i> Gestion Académica
      </a>
      <div class="dropdown-menu" id="gcademica">
      <a class="dropdown-item" href="{{url('/adm_cursos')}}">Administrar Cursos</a>
      <a class="dropdown-item" href="{{url('/adm_areas')}}">Admnistrar Áreas</a>
      <a class="dropdown-item" href="{{url('/adm_asignaturas')}}">Admnistrar Asignaturas</a>
      <a class="dropdown-item" href="{{url('/adm_diagnosticos')}}">Admnistrar Diagnoticos</a>
      </div>
	  </li>

	  <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="/Summary/Commercial" data-target="#navToggleCommercial" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
      Registro Financiero
      </a>
      <div class="dropdown-menu" id="navToggleCommercial">
      <a class="dropdown-item" href="/Summary/Dashboard">Registro de Pagos</a>
      <a class="dropdown-item" href="/Summary/Dashboard">Ver informes de pagos</a>
      <a class="dropdown-item" href="/Summary/Dashboard">Configuracion</a>
      </div>
	  </li>

      </ul>

        <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
    	<a class="nav-link dropdown-toggle" href="/Summary/Commercial" data-target="#useroption" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
        {{auth('admin')->user()->NOMBRES}}
    	</a>
    	<div class="dropdown-menu" id="useroption">
        <a class="dropdown-item" href="/Summary/Dashboard"><i class="fas fa-user-circle"></i> Perfil</a>
        <a class="dropdown-item" href="{{url('/logouta')}}"><i class="fas fa-power-off"></i> Cerrar Sesión</a>
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


    
    {!!Html::script("js/core/popper.min.js")!!}
    
    </body>
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
		</script>



    {!!Html::script("js/pages/function_scripts.js")!!}

        <script>
        $( document ).ready(function() {
            $('#fecha').datepicker();
        });
    </script>

    @yield("space_scripts")

</html>