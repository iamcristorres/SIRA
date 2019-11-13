<div id="basic_information_s" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Configuración Básica</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="{{route('SaveBasicInfomation')}}" method="post" enctype="multipart/form-data">
      {!!csrf_field()!!}
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                {!!Form::label("NOMBRE DEL CENTRO EDUCATIVO",null,['class' => 'textsm'])!!}
                {!!Form::text("namecenter",$institucion->NOMBRE_ESTABLECIMIENTO,["class"=>"form-control","placeholder"=>"Nombre del Centro Educativo","id"=>"userone"])!!}
            </div>                
        </div>

        <div class="row my-3">
            <div class="col-md-12">
                {!!Form::label("PEI",null,['class' => 'textsm'])!!}
                {!!Form::text("pei",$institucion->PEI,["class"=>"form-control","placeholder"=>"PEI","id"=>"userone"])!!}
            </div>                
        </div>

        <div class="row my-3">
            <div class="col-md-12">
                {!!Form::label("RESOLUCIÓN APROBACIÓN, CODIGO ICFES, DANE",null,['class' => 'textsm'])!!}
                {!! Form::textarea('resolucion', $institucion->RESOLUCION, ['class'=>'form-control','rows' => 3,'style' => 'text-align:center']) !!}
            </div>                
        </div>

        <div class="row my-3">
            <div class="col-md-8">
                {!!Form::label("NOMBRE COMPLETO (GERENTE, DIRECTOR(A), RECTOR(A))",null,['class' => 'textsm'])!!}
                {!!Form::text("director",$institucion->DIRECTOR_A,["class"=>"form-control","placeholder"=>"NOMBRE COMPLETO (GERENTE, DIRECTOR(A), RECTOR(A))","id"=>"userone"])!!}
            </div>
            <div class="col-md-4">
                {!!Form::label("CARGO",null,['class' => 'textsm'])!!}
                {!!Form::text("cargod",$institucion->CARGO_D,["class"=>"form-control","placeholder"=>"CARGO","id"=>"userone"])!!}
            </div>                
        </div>

        <div class="row my-3">
            <div class="col-md-8">
                {!!Form::label("NOMBRE COMPLETO (SECRERARIO, AUX ADMINISTRATIVO)",null,['class' => 'textsm'])!!}
                {!!Form::text("secretario",$institucion->SECRETARIO_A,["class"=>"form-control","placeholder"=>"NOMBRE COMPLETO (SECRERARIO, AUX ADMINISTRATIVO)","id"=>"userone"])!!}
            </div>
            <div class="col-md-4">
                {!!Form::label("CARGO",null,['class' => 'textsm'])!!}
                {!!Form::text("cargos",$institucion->CARGO_A,["class"=>"form-control","placeholder"=>"CARGO","id"=>"userone"])!!}
            </div>                
        </div>

        <div class="row my-3">
            <div class="col-md-6">
                {!!Form::label("ESCUDO DEL CENTRO EDUCATIVO",null,['class' => 'textsm'])!!}
                {!!Form::file('escudo');!!}
            </div>
            <div class="col-md-6">
                <input type="hidden" value="{{$institucion->LOGO}}" name="antiguo_logo_rute">
                <img class="mr-3" src="{{url('/logo/'.$institucion->LOGO)}}" alt="" width="48" height="48">
            </div>                
        </div>

        <div class="row my-3">
            <div class="col-md-6">
                {!!Form::label("FIRMA DIGITAL (DIRECTOR O RECTOR)",null,['class' => 'textsm'])!!}
                {!!Form::file('firma1');!!}
            </div>
            <div class="col-md-6">
            <input type="hidden" value="{{$institucion->FIRMA1}}" name="antiguo_firma1_rute">
            <img class="mr-3" src="{{url('/logo/'.$institucion->FIRMA1)}}" alt="" width="48" height="48">
            </div>                
        </div>

        <div class="row my-3">
            <div class="col-md-6">
                {!!Form::label("FIRMA DIGITAL (SECRERARIO, AUX ADMINISTRATIVO)",null,['class' => 'textsm'])!!}
                {!!Form::file('firma2');!!}
            </div>
            <div class="col-md-6">
            <input type="hidden" value="{{$institucion->FIRMA2}}" name="antiguo_firma2_rute">
            <img class="mr-3" src="{{url('/logo/'.$institucion->FIRMA2)}}" alt="" width="48" height="48">
            </div>                
        </div>

        <div class="row my-3">
            <div class="col-md-6">
                {!!Form::label("SELLO RECTORIA",null,['class' => 'textsm'])!!}
                {!!Form::file('sello1');!!}
            </div>
            <div class="col-md-6">
            <input type="hidden" value="{{$institucion->SELLO_RECT}}" name="antiguo_sello1_rute">
            <img class="mr-3" src="{{url('/logo/'.$institucion->SELLO_RECT)}}" alt="" width="48" height="48">
            </div>                
        </div>

        <div class="row my-3">
            <div class="col-md-6">
                {!!Form::label("SELLO DOS",null,['class' => 'textsm'])!!}
                {!!Form::file('sello2');!!}
            </div>
            <div class="col-md-6">
            <input type="hidden" value="{{$institucion->SELLO_2}}" name="antiguo_sello2_rute">
            <img class="mr-3" src="{{url('/logo/'.$institucion->SELLO_2)}}" alt="" width="48" height="48">
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