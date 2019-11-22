
<div id="solcert" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Solicitud de Certificados</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="{{route('gcert')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
      <div class="modal-body">
        <div class="row">
            <div class="col-md-8">
               <label for="ticert">Tipo de Certificado</label>
               <select class="form-control" id="ticert" name="ticert">
               @if($institucion->ACTIVO!=0)
               <option value="1">Constancia de estudio año {{$ano_act}}</option>
               @endif
               <option value="2">Constancia de Notas</option>
               @if($institucion->ACTIVO!=0)
               <option value="3">Constancia Financiera año {{$ano_act}}</option>
               @endif
               </select>
            </div>

            <div class="col-md-3" id="ano_space" style="display:none;">
               <label for="ano">año</label>
               <select class="form-control" id="ano_cert" name="ano_cert">
                @foreach($acayears as $years)
                  <option value="{{$years->PERIODO}}">{{$years->PERIODO}}</option>
                @endforeach
               </select>
            </div>
        </div>
        <br>
        <hr>
        <br>
        <div class="row">
            <div class="col-md-12">
            <center><h5>VERIFIQUE LA INFORMACIÓN PERSONAL DEL ESTUDIANTE</h5></center>
            <h6>Apellidos: {{auth('student')->user()->APELLIDO1." ".auth('student')->user()->APELLIDO2}}</h6>
            <h6>Nombres: {{auth('student')->user()->NOMBRES}}</h6>
            <h6>Tipo Documento: {{auth('student')->user()->TIPO_DE_DOCUMENTO}}</h6>
            <h6>Número de Documento: {{auth('student')->user()->NUMERO_DE_DOCUMENTO}}</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
            <center><h5>INFORMACIÓN DE INTERES CREACION DE CERTIFICADOS ONLINE</h5></center>
            <h6>Nota: La fecha de expedicion del certificado será la que toma el sistema una vez se registra del pago de el, la disponibilidad del certificado en la plataforma SIRA para su descarga e impresion sera de treinta (30) días calendario una vez se halla registrado el pago, pasados los treinta días ya no será disponible su descarga e impresión.</h6>
            </div>
        </div>


      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success">Crear Solicitud</button>
        </form>
      </div>
    </div>

  </div>
</div>