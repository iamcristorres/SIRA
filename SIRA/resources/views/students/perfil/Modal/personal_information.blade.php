<div id="pinformation" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Información Personal</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="{{route('uppersonalinfo')}}" method="post" enctype="multipart/form-data">
      {!!csrf_field()!!}
      <div class="modal-body">

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
            <div class="col-md-3"> 
           {!!Form::label("GENERO",null,['class' => 'textsm'])!!}
              {!!Form::text("genero",mb_strtoupper ($estudiante->GENERO,'UTF-8'),["class"=>"form-control","placeholder"=>"GENERO",'readonly' => 'true','disabled' => 'true'])!!}
           </div>
           <div class="col-md-5"> 
           {!!Form::label("T. DOCUMENTO",null,['class' => 'textsm'])!!}
              {!!Form::text("tidoc",mb_strtoupper ($estudiante->TIPO_DE_DOCUMENTO,'UTF-8'),["class"=>"form-control","placeholder"=>"TIPO DE DOCUMENTO",'readonly' => 'true','disabled' => 'true'])!!}
           </div>
           <div class="col-md-4"> 
           {!!Form::label("NUMERO DE DOCUMENTO",null,['class' => 'textsm'])!!}
            {!!Form::text("nudoc",number_format($estudiante->NUMERO_DE_DOCUMENTO, 0, '', '.'),["class"=>"form-control","placeholder"=>"NUMERO DE DOCUMENTO",'readonly' => 'true','disabled' => 'true'])!!}
           </div>
        </div>
        <div class="row m-3">
          <div class="col-md-4"> 
          {!!Form::label("FECHA EXPEDICION",null,['class' => 'textsm'])!!}
            <input type="text" class="form-control datepicker" placeholder="Fecha Expedicion de Documento" name="dateexp" required value="{{$estudiante->FECHA_EXPEDICION_DE_DOCUMENTO}}">
          </div>
          <div class="col-md-4"> 
           {!!Form::label("DEPARTAMENTO",null,['class' => 'textsm'])!!}
           <select class="form-control input-sm" name="departamento" id="departamento"> 
               @foreach($departamentos as $departamento)
                  <?php
                  if($departamento->ID==$estudiante->DEPARTAMENTO_DE_EXPEDICION_DE_DOCUMENTO){ ?>
                    <option value="{{$departamento->ID}}" selected>{{$departamento->NOMBRE_DEPARTAMENTO}}</option>
                    <?php
                  }else{
                  ?>
                 <option value="{{$departamento->ID}}">{{$departamento->NOMBRE_DEPARTAMENTO}}</option>
                 <?php } ?>
               @endforeach
          </select>

          </div>
          <div class="col-md-4"> 
          {!!Form::label("MUNICIPIO EXP",null,['class' => 'textsm'])!!}
           <select class="form-control input-sm" name="municipio" id="municipio">
              <option value="{{$estudiante->MUNICIPIO_DE_EXPEDICION_DE_DOCUMENTO}}"></option>   
           </select>
          </div>
        </div>

        <div class="row m-3">
           <div class="col-md-4"> 
           {!!Form::label("FECHA DE NACIMIENTO",null,['class' => 'textsm'])!!}
            <input type="text" class="form-control datepicker" required placeholder="Fecha de Nacimiento" name="datenac" value="{{$estudiante->FECHA_DE_NACIMIENTO}}">
           </div>

           <div class="col-md-4"> 
           {!!Form::label("DEPARTAMENTO NAC.",null,['class' => 'textsm'])!!}
           <select class="form-control input-sm" name="departamento2" id="departamento2"> 
               @foreach($departamentos as $departamento)
                    <?php
                  if($departamento->ID==$estudiante->DEPARTAMENTO_DE_NACIMIENTO){ ?>
                    <option value="{{$departamento->ID}}" selected>{{$departamento->NOMBRE_DEPARTAMENTO}}</option>
                    <?php
                  }else{
                  ?>
                 <option value="{{$departamento->ID}}">{{$departamento->NOMBRE_DEPARTAMENTO}}</option>
                 <?php } ?>
               @endforeach
          </select>

          </div>
          <div class="col-md-4"> 
          {!!Form::label("MUNICIPIO NAC.",null,['class' => 'textsm'])!!}
           <select class="form-control input-sm" name="municipio2" id="municipio2">
            <option value="{{$estudiante->MUNICIPIO_DE_NACIMIENTO}}"></option>
           </select>
          </div>

        </div>

           <div class="row m-3">

           <div class="col-md-4"> 
           {!!Form::label("DEPTO RESIDENCIA",null,['class' => 'textsm'])!!}
           <select class="form-control input-sm" name="departamento3" id="departamento3"> 
               @foreach($departamentos as $departamento)
                <?php
                  if($departamento->ID==$estudiante->DEPARTAMENTO_DE_RESIDENCIA){ ?>
                    <option value="{{$departamento->ID}}" selected>{{$departamento->NOMBRE_DEPARTAMENTO}}</option>
                    <?php
                  }else{
                  ?>
                 <option value="{{$departamento->ID}}">{{$departamento->NOMBRE_DEPARTAMENTO}}</option>
                 <?php } ?>>
               @endforeach
          </select>

          </div>
          <div class="col-md-4"> 
          {!!Form::label("MUNICIPIO RESI.",null,['class' => 'textsm'])!!}
           <select class="form-control input-sm" name="municipio3" id="municipio3">
            <option value="{{$estudiante->MUNICIPIO_DE_RESIDENCIA}}"></option>
           </select>
          </div>
          <div class="col-md-4"> 
           {!!Form::label("BARRIO",null,['class' => 'textsm'])!!}
            {!!Form::text("barrio",$estudiante->BARRIO_DE_RESIDENCIA,["class"=>"form-control","placeholder"=>"BARRIO","required"])!!}
           </div>

        </div>


        <div class="row m-3">
          <div class="col-md-5">
            {!!Form::label("DIRECCIÓN",null,['class' => 'textsm'])!!}
            {!!Form::text("direccion",$estudiante->DIRECCION_DE_RESIDENCIA,["class"=>"form-control","placeholder"=>"DIRECCIÓN","required"])!!}
          </div>
          <div class="col-md-3">
            {!!Form::label("ESTRATO",null,['class' => 'textsm'])!!}
            {{ Form::select('estrato', ['NO APLICA',1, 2,3,4,5,6,7], $estudiante->ESTRATO, ['id' => 'estrato','class'=>'form-control input-sm']) }}
            </select> 
          </div>
          <div class="col-md-4">
            {!!Form::label("TELEFONO FIJO",null,['class' => 'textsm'])!!}
            {!!Form::text("telfijo",$estudiante->TELEFONO_DE_RESIDENCIA,["class"=>"form-control","placeholder"=>"TELEFONO FIJO"])!!}
          </div>
        </div>

          


        <div class="row m-3">
          <div class="col-md-4">
            {!!Form::label("CELULAR",null,['class' => 'textsm'])!!}
            {!!Form::text("celular",$estudiante->CELULAR_DE_RESIDENCIA,["class"=>"form-control","placeholder"=>"TELEFONO CELULAR"])!!}
          </div>
          <div class="col-md-4">
            {!!Form::label("TIENE SISBEN",null,['class' => 'textsm'])!!}
            {!! Form::select('sisbenti', [null => 'Escoja Opción'] + ['Si' => 'Si','No'=>'No'], $estudiante->SISBEN, ['id' => 'sisbenti','class'=>'form-control input-sm']) !!}
          </div>
          <div class="col-md-4" id="puntajed" style="display:none">
            {!!Form::label("PUNTAJE",null,['class' => 'textsm'])!!}
            {!!Form::text("puntaje",$estudiante->PUNTAJE_SISBEN,["class"=>"form-control","placeholder"=>"PUNTAJE"])!!} 
          </div>
        </div>

        <div class="row m-3">
          <div class="col-md-9">
            {!!Form::label("EPS",null,['class' => 'eps'])!!}
            <select class="form-control input-sm" name="eps" id="eps">
            @foreach($epss as $eps)
            <?php if($eps->NOMBRE==$estudiante->NOMBRE_EPS){ ?>
                 <option value="{{$eps->NOMBRE}}" selected>{{$eps->NOMBRE}}</option>
            <?php     }else{ ?>
                 <option value="{{$eps->NOMBRE}}">{{$eps->NOMBRE}}</option>
            <?php     } ?>
            @endforeach
            </select>
          </div>
          <div class="col-md-3">
            {!!Form::label("T. SANGRE",null,['class' => 'eps'])!!}
             {!! Form::select('tsangre', [null => 'Escoja Opción'] + ['O+' => 'O+','O-'=>'O-','A+'=>'A+','A-'=>'A-','B+'=>'B+','B-'=>'B-','AB+'=>'AB+','AB-'=>'AB-'], $estudiante->TIPO_DE_SANGRE, ['id' => 'tsangre','class'=>'form-control input-sm']) !!}
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