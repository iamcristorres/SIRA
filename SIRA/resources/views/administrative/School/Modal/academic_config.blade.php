<?php 
$historial_periodo=App\historial_periodo::where('periodo_anual',$institucion->ANO_ACTIVO)->first();
?>
<div id="academic_config" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Configuración Académica</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="{{route('Update_Periodo')}}" method="post" enctype="multipart/form-data">
      {!!csrf_field()!!}
      <div class="modal-body">
        <div class="row">
            <div class="col-md-offset-4 col-md-4 col-md-offset-4">
                {!!Form::label("PERIODO ACTIVO",null,['class' => 'textsm'])!!}
                {!!Form::text("periodo_activo",$institucion->ANO_ACTIVO,["class"=>"form-control","placeholder"=>"EJEMPLO 2015-1 O 2015","id"=>"periodo",'disabled' => 'true'])!!}
            </div> 
        </div>

        <div class="row my-3">
            <div class="col-md-offset-2 col-md-2">
                {!!Form::label("NOTA MINIMA",null,['class' => 'textsm'])!!}
                {!!Form::number("min",$historial_periodo->nota_min,["class"=>"form-control","placeholder"=>"MIN","id"=>"min",'step' => '0.1'])!!}
            </div>
            <div class="col-md-2">
                {!!Form::label("NOTA MÁXIMA",null,['class' => 'textsm'])!!}
                {!!Form::number("max",$historial_periodo->nota_max,["class"=>"form-control","placeholder"=>"MÁXIMA","id"=>"max",'step' => '0.1'])!!}
            </div>
            <div class="col-md-2">
                {!!Form::label("MIN APRO.",null,['class' => 'textsm'])!!}
                {!!Form::number("apro",$historial_periodo->nota_min_a,["class"=>"form-control","placeholder"=>"APROBATORIA","id"=>"apro",'step' => '0.1'])!!}
            </div>
            <div class="col-md-2">
                {!!Form::label("N° PERIODOS",null,['class' => 'textsm'])!!}
                {!! Form::select('periodos', [null => 'Seleccione Periodos'] + ['1' => '1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6'], $historial_periodo->periodos, ['class' => 'form-control']) !!}
            </div>
        </div>
        <hr>
        <div class="row my-4">
            <div class="col-md-offset-3 col-md-2 vertical-align">
                <center><h5>DESEMPEÑO SUPERIOR</h5></center>
            </div>
            <div class="col-md-2">
                {!!Form::label("MINIMA",null,['class' => 'textsm'])!!}
                {!!Form::number("minsu",$historial_periodo->su_min,["class"=>"form-control","placeholder"=>"MIN","id"=>"minsu",'step' => '0.1'])!!}
            </div>
            <div class="col-md-2">
                {!!Form::label("MAXIMA",null,['class' => 'textsm'])!!}
                {!!Form::number("maxsu",$historial_periodo->su_max,["class"=>"form-control","placeholder"=>"MIN","id"=>"maxsu",'step' => '0.1'])!!}
            </div>
        </div>

        <hr>
        <div class="row my-4">
            <div class="col-md-offset-3 col-md-2 vertical-align">
                <center><h5>DESEMPEÑO ALTO</h5></center>
            </div>
            <div class="col-md-2">
                {!!Form::label("MINIMA",null,['class' => 'textsm'])!!}
                {!!Form::number("minal",$historial_periodo->al_min,["class"=>"form-control","placeholder"=>"MIN","id"=>"minal",'step' => '0.1'])!!}
            </div>
            <div class="col-md-2">
                {!!Form::label("MAXIMA",null,['class' => 'textsm'])!!}
                {!!Form::number("maxal",$historial_periodo->al_max,["class"=>"form-control","placeholder"=>"MIN","id"=>"maxal",'step' => '0.1'])!!}
            </div>
        </div>
        <hr>
        <div class="row my-4">
            <div class="col-md-offset-3 col-md-2 vertical-align">
                <center><h5>DESEMPEÑO BÁSICO</h5></center>
            </div>
            <div class="col-md-2">
                {!!Form::label("MINIMA",null,['class' => 'textsm'])!!}
                {!!Form::number("minbas",$historial_periodo->bs_min,["class"=>"form-control","placeholder"=>"MIN","id"=>"minbas",'step' => '0.1'])!!}
            </div>
            <div class="col-md-2">
                {!!Form::label("MAXIMA",null,['class' => 'textsm'])!!}
                {!!Form::number("maxbas",$historial_periodo->bs_max,["class"=>"form-control","placeholder"=>"MIN","id"=>"maxbas",'step' => '0.1'])!!}
            </div>
        </div>
        <hr>
        <div class="row my-4">
            <div class="col-md-offset-3 col-md-2 vertical-align">
                <center><h5>DESEMPEÑO BAJO</h5></center>
            </div>
            <div class="col-md-2">
                {!!Form::label("MINIMA",null,['class' => 'textsm'])!!}
                {!!Form::number("bjmin",$historial_periodo->bj_min,["class"=>"form-control","placeholder"=>"MIN","id"=>"bjmin",'step' => '0.1'])!!}
            </div>
            <div class="col-md-2">
                {!!Form::label("MAXIMA",null,['class' => 'textsm'])!!}
                {!!Form::number("bjmax",$historial_periodo->bj_max,["class"=>"form-control","placeholder"=>"MIN","id"=>"bjmax",'step' => '0.1'])!!}
            </div>
        </div>


      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Guardar</button>
        </form>
      </div>
    </div>

  </div>
</div>