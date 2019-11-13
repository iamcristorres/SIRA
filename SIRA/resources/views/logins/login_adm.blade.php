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
        border: 1px solid #0062cc;
    }
    </style>
    <title>Inicio Sesión --Docente--</title>
    </head>



    <body>


       <div class="container">

      
        <br><br>
        <center><h2 class="form-signin-heading">SIRA</h2></center>
        <center><h4 class="form-signin-heading">Administrativos</h4></center>
        <hr>
        <center><img src="{{ url('/logo/'.$institucion->LOGO) }}" width="100px" height="100px"></center>
        <br>
        <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
        <div class="card">
        <div class="card-header" style="background-color:#007bff">
        <center><h6 style="color:#fff;">Iniciar Sesión</h6></center>
         @if(Session::has('mensaje_error'))
            {{ Session::get('mensaje_error') }}
        @endif
        </div>
        <div class="card-body">   
        <form class="form-signin" method="POST" action="{{url('admin_login')}}">
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

    </div>

    </body>
    <!--   Core JS Files   -->
    {!!Html::script("theme/js/core/jquery.3.2.1.min.js")!!}
    {!!Html::script("theme/js/core/popper.min.js")!!}
    {!!Html::script("theme/css/bootstrap_default/js/bootstrap.min.js")!!}
   
    @yield("scripts")

    <script type="text/javascript">
    $(document).ready(function() {
        // the body of this function is in assets/js/now-ui-kit.js
        nowuiKit.initSliders();


    });

    function scrollToDownload() {

        if ($('.section-download').length != 0) {
            $("html, body").animate({
                scrollTop: $('.section-download').offset().top
            }, 2000);
        }
    }
</script>
</html>