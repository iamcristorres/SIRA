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
    <style>
    body{
        background-color: #F9F9F9;
            }
    .card {
        border: 2px solid #0062cc;
        -webkit-box-shadow: 0px 2px 16px 5px rgba(0,0,0,0.45);
        -moz-box-shadow: 0px 2px 16px 5px rgba(0,0,0,0.45);
        box-shadow: 0px 2px 16px 5px rgba(0,0,0,0.45);
    }

    .blurstyle {
    filter: blur(6px);
    }

    .blancotextmayor{
        color:#fff;
        font-size: 3em;
        text-shadow: #555 2px 2px 3px;
        text-rendering: geometricPrecision;
    }

    .page-bg {
        background: url('http://chacoadentro.com/wp-content/uploads/2017/08/522115082-alumno-de-primaria-pizarra-deberes-para-el-hogar-escolar.jpg');
        -webkit-filter: blur(5px);
        -moz-filter: blur(5px);
        -o-filter: blur(5px);
        -ms-filter: blur(5px);
        filter: blur(5px);
        background-repeat: no-repeat;
    background-size: cover;
    width: 100vw;
    height: 100vh;
    overflow: hidden;
    position: absolute;
    top: 0;
    left: 0;
    z-index: -1;
    }

    .textend{
        color:#fff;
        font-size: 1.2em;
        text-rendering: optimizeLegibility;
        font-weight: bold;
    }

    .loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('https://www.juntadeandalucia.es/salud/reveca/img/cargando.gif') 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;
}

    </style>
    </head>



    <body>

        <div class="loader"></div>

        <div class="page-bg">
        d
        </div>
       <div class="container">

      
        <br>
        <center><h2 class="form-signin-heading blancotextmayor">SIRA</h2></center>
        <hr>
        <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
        <div class="card">
        <div class="card-header" style="background-color:#007bff">
        <center><h6 style="color:#fff;"></h6></center>
        <center><img src="{{ url('/logo/'.$institucion->LOGO) }}" width="100px" height="100px" id="logotipo"></center>
         @if(Session::has('message'))
        <div class="card-header messagepost" style="background-color:#C20917;" id="error_logueo">
        <center><h6 style="color:#fff;"><i class="fas fa-exclamation-triangle"></i> {{ Session::get('message') }}</h6></center>
        </div>           
        @endif

        @if(Session::has('messageLOGGIN'))
        <div class="card-header messagepost" style="background-color:#026C18;" id="error_logueo">
        <center><h6 style="color:#fff;"><i class="fas fa-check-circle"></i> {{ Session::get('messageLOGGIN') }}</h6></center>
        </div>           
        @endif

        @if(Session::has('messageChange'))
        <div class="card-header messagepost" style="background-color:#026C18;" id="error_logueo">
        <center><h6 style="color:#fff;"><i class="fas fa-check-circle"></i> {{ Session::get('messageChange') }}</h6></center>
        </div>           
        @endif

        </div>

        <div class="card-body">   
        <form class="form-signin" method="POST" action="{{url('student_login')}}">
        {{csrf_field()}}
        <div class="row">
        <div class="col-md-12">
        <label for="inputdoc" class="textsm">Usuario:</label>
        <input type="text" id="inputdoc" name='inputdoc' class="form-control" placeholder="Usuario" required="" autofocus="">
        {!!$errors->first('inputdoc','<span class="help_block">:message</span>')!!}
        </div>
        </div>

        <br>

        <div class="row">
        <div class="col-md-12">
        <label for="contrasena" class="textsm">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" class="form-control" placeholder="Contraseña" required="" autofocus="">
        {!!$errors->first('contrasena','<span class="help_block">:message</span>')!!}
        </div>
        </div>

        <br><br>

        <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
        <button class="btn btn-lg btn-primary btn-block" type="submit" style="background-color:#007bff;">  
        Entrar</button>
        </div>
        <div class="col-md-4"></div></div>

        </form>

        </div>
        </div>
        </div>


        <div class="col-md-3"></div>
        </div>

        <br>
        <div class="row">
        <div class="col-md-12 textend">
            <center>SIRA: Sistema de Información y Registro Académico</center>
        </div>
        </div>

    </div>

    </body>
    <!--   Core JS Files   -->
    {!!Html::script("theme/js/core/popper.min.js")!!}
    {!!Html::script("https://www.ieliceosantateresita.edu.co/SIRA/public/js/bootstrap.min.js")!!}
   
    @yield("scripts")

    <script type="text/javascript">
    $(document).ready(function() {
        $(".loader").fadeOut("slow"); 
        $(".messagepost").delay(3000).fadeOut("slow");
    });
</script>
</html>