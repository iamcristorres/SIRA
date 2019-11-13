<?php

namespace App\Http\Controllers;
use App\Encryption;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\institucion;
use App\estudiante;
use App\verificacion;
use App\gen_cert;
use App\cost_certificates;
use App\contabilidad;
use App\cpagos;
use Mail;
class subida_student extends Controller
{

    function verificador_correo1(Request $request){
        $institucion=institucion::first();

        $validatedData=$this->validate($request,[
            'correo'=>'required',
            'correoc'=>'required',
            ],[
            'correo.required'=>'Debe ingresar la información completa',
            'correoc.required'=>'Debe ingresar la información completa',
            ]);
        $codigo_estudiante=auth('student')->user()->CODIGO;
        $estudiante=estudiante::find($codigo_estudiante);
        $verificadorconteo=verificacion::where('CODIGO','=',$codigo_estudiante)->count();

        $correo1n=rtrim($request->input('correo'));
        $correo2n=rtrim($request->input('correoc'));

        $correo1=strtolower($correo1n);
        $correo2=strtolower($correo2n);

        if($correo1==$correo2){
        if($verificadorconteo<=0){
            $codever=rand (100000,999999);
            $verificador=new verificacion();
            $verificador->CODIGO=$codigo_estudiante;
            $verificador->VER1=1;
            $verificador->CODIGO_VERIFICACION_CORREO=$codever;
            $datetime = date_create()->format('Y-m-d H:i:s');
            $verificador->DATE_VERIFICACION=$datetime;
            $verificador->save();
            $estudiante->CORREO_ELECTRONICO=$correo1;
            $estudiante->save();
            try {
            $data=array(
                'codigover'=>$codever,
                'institucion'=>$institucion,
                );
            
            Mail::send('emails.codigoactivacion',$data,function($message) use ($correo1){
            $message->from('sira@ieliceosantateresita.edu.co');
            $message->to($correo1)->subject('Código de verificación, SIRA');
            });

            return redirect('/estudiante');
            }catch(\Exception $e){

                $verificador=verificacion::where('CODIGO','=',$codigo_estudiante)->first()->delete();
                return redirect('/estudiante')->with(array(
                'message1'=>'Error el correo diligenciado no cumple con la estructura básica de un correo. Intente con otro correo.'
                ));
            }

        }

        }else{
            return redirect('/estudiante')->with(array(
            'message1'=>'Error los correos no coinciden'
            ));
        }

    }


    function verificadorcodigo(Request $request){
      $institucion=institucion::first();  
      $validatedData=$this->validate($request,[
            'codigover'=>'required',
            ],[
            'codigover.required'=>'Debe ingresar el código de 6 digitos.',
            ]);
      $codigo_estudiante=auth('student')->user()->CODIGO;
      $verificador=verificacion::where('CODIGO','=',$codigo_estudiante)->first();
      $codigoingresado=rtrim($request->input('codigover'));
      $codigo_verificado=$verificador->CODIGO_VERIFICACION_CORREO;
      $fecha_i=$verificador->DATE_VERIFICACION;
      $fecha_f=strtotime ( '+30 minute' , strtotime ( $fecha_i ) ) ;
      $fecha_f = date ( 'Y-m-d H:i:s' ,  $fecha_f );
      $datetime = date_create()->format('Y-m-d H:i:s');
      if($codigoingresado==$codigo_verificado){
      if($datetime<=$fecha_f){
        $verificador->VER1=2;
        $verificador->save();
        return redirect('/estudiante')->with(array(
            'messageend'=>'La verificación del correo electronico se ha realizado de manera éxitosa.'
            ));

      }else{
        $verificador->delete();
        return redirect('/estudiante')->with(array(
            'message2'=>'El código ha vencido. Intente de nuevo.'
            ));
      }
      }else{
        return redirect('/estudiante')->with(array(
            'message3'=>'El código ingresado es erróneo. Verifiquelo e intente de nuevo.'
            ));
      }
    }


    public function reenviocorreoi(){
        $institucion=institucion::first();
        $codigo_estudiante=auth('student')->user()->CODIGO;
        $estudiante=estudiante::find($codigo_estudiante);
        $correo1=$estudiante->CORREO_ELECTRONICO;
        $codever=rand (100000,999999);
        $verificador=verificacion::where('CODIGO','=',$codigo_estudiante)->first();
        $verificador->CODIGO_VERIFICACION_CORREO=$codever;
        $datetime = date_create()->format('Y-m-d H:i:s');
        $verificador->DATE_VERIFICACION=$datetime;
        $verificador->save();
        $data=array(
                'codigover'=>$codever,
                'institucion'=>$institucion,
                );

            Mail::send('emails.codigoactivacion',$data,function($message) use ($correo1){
            $message->from('sira@ieliceosantateresita.edu.co');
            $message->to($correo1)->subject('Código de verificación, SIRA');
            });

        return redirect('/estudiante')->with(array(
            'messagereenvio'=>'Se ha reenviado un nuevo código al siguiente correo: '.$correo1
            ));


    }

    public function corregircorreo(){
        $codigo_estudiante=auth('student')->user()->CODIGO;
        $verificador=verificacion::where('CODIGO','=',$codigo_estudiante)->first()->delete();
        return redirect('/estudiante');
    }

    public function solicitudcertificado(Request $request){
        $institucion=institucion::first();
        $ano_act=$institucion->ANO_ACTIVO;
        $codigo_estudiante=auth('student')->user()->CODIGO;
        $validatedData=$this->validate($request,[
            'ticert'=>'required',
            ],[
            'ticert.required'=>'Debe ingresar la información completa',
            ]);
        $ano_sol="";
        $tipo_certificado=$request->input('ticert');
        if($tipo_certificado==1){
            $ano_sol=$ano_act;
        }else{
            $ano_sol=$request->input('ano_cert');
        }


        $info_certificado=cost_certificates::find($tipo_certificado);
        $valor=$info_certificado->COSTO;
        $dias_vencimiento=$info_certificado->DURACION_DIAS;
        $fecha_actual = date("Y-m-d");
        $referencia=$codigo_estudiante."".$ano_act."".date("zdmGis");

        $busquedasimilaresi=gen_cert::where('CODIGO_eS','=',$codigo_estudiante)->where('TIPO_CERT','=',$tipo_certificado)->where('ANO','=',$ano_sol)->count();
        
        if($busquedasimilaresi==0){
            
        $solicitud=new gen_cert();
        $solicitud->REFERENCIA=$referencia;
        $solicitud->CODIGO_ES=$codigo_estudiante;
        $solicitud->TIPO_CERT=$tipo_certificado;
        $solicitud->VALOR=$valor;
        $solicitud->ANO=$ano_sol;
        $solicitud->ESTADO="NO PAGO";
        $fecha_max_pago=date("Y-m-d",strtotime($fecha_actual."+ 4 days"));
        $solicitud->MAX_PAGO=$fecha_max_pago;
        $solicitud->save();


        }else{
            return redirect('/certsolicitud')->with(array(
            'error'=>'Anteriormente se ha realizado una solicitud de una constancia o certificado con caracteristicas similares verifique e intente de nuevo.'
            ));
        }

        return redirect('/certsolicitud')->with(array(
            'success'=>'Solicitud realizada con éxito.'
            ));

       
    }


    public function registro_certificate(Request $request){


        $referencia=$request->input('reference_sale');
        $merchant_id=$request->input('merchant_id');
        $estadofinal=$request->input('state_pol');
        $riesgo=$request->input('risk');
        $sign=$request->input('sign');
        $value=$request->input('value');
        $fecha=$request->input('transaction_date');
        $refer_online=$request->input('reference_pol');
        $description=$request->input('description');
        $medio_pago=$request->input('payment_method_id');
        $newDate = date("y-m-d H:i:s", strtotime($fecha));
        $fecha_max=date("Y-m-d",strtotime($newDate."+ 30 days"));
        $cpagos=cpagos::first();
        $apikey=$cpagos->API_KEY;
        $valornuevo=0;

        $decimaldos = substr($value, strpos($value, ".") + 2);
        if($decimaldos!=0){
            $valornuevo=$value;
        }else{
            $valornuevo=number_format(($value),1,".","");
        }

        echo $valornuevo."<br>";
        $firmav=$apikey."~".$merchant_id."~".$referencia."~".$valornuevo."~COP~4";
        $texto_codificado=md5($firmav);
        echo $texto_codificado;
        if($texto_codificado==$sign){

        if($estadofinal==4){
          $certificado=gen_cert::where('REFERENCIA','=',$referencia)->first();
          $certificado->ESTADO="PAGO";
          $certificado->FECHA_EXPEDICION=$newDate;
          $certificado->FECHA_FIN=$fecha_max;
          $certificado->save();

          $contable=new contabilidad();
          $contable->ESTUDIANTE=$certificado->CODIGO_ES;
          $contable->ANO=$certificado->ANO;
          $contable->VALOR=$value;
          $contable->TIPO_PAGO="VIRTUAL";
          $contable->ESTADO="PAGO";
          $contable->FECHA_PAGO=$newDate;
          $contable->REFERENCIA=$referencia;
          $contable->REFERENCIA_ONLINE=$refer_online;
          $contable->DESCRIPCION_VENTA=$description;
          $contable->MEDIO_PAGO=$medio_pago;
          $contable->save();

          
        }
    }



    }

    public function cpass(Request $request){
        $codigo_estudiante=auth('student')->user()->CODIGO;
        $estudiante=estudiante::find($codigo_estudiante);
        $validatedData=$this->validate($request,[
            'con_ant'=>'required',
            'con_n1'=>'required',
            'con_n2'=>'required',
            ],[
            'con_ant.required'=>'Debe ingresar la contraseña antigua',
            'con_n1.required'=>'Debe ingresar la contraseña nueva',
            'con_n2.required'=>'Debe confirmar la contraseña nueva',
            ]);

        $contrasena_antigua=$request->input('con_ant');
        $contrasena_nueva=$request->input('con_n1');
        $contrasena_nuevac=$request->input('con_n2');

        if (Hash::check($contrasena_antigua, auth('student')->user()->password))
        {
         
            if($contrasena_nueva==$contrasena_nuevac){
                $estudiante->password=bcrypt($contrasena_nueva);
                $estudiante->save();

                return redirect('/logoute/1');

            }else{
                return redirect('/perfil')->with(array(
            'error'=>'La confirmacion de las contraseñas no se pudo realizar intente de nuevo.'
            ));
            }

        }else
        {
          return redirect('/perfil')->with(array(
            'error'=>'La contraseña antigua no concide. Por favor intente de nuevo.'
            ));
        }


    }

    public function uppersonalinfo(Request $request){
         $codigo_estudiante=auth('student')->user()->CODIGO;
        $estudiante=estudiante::find($codigo_estudiante);
        $validatedData=$this->validate($request,[
            'dateexp'=>'required',
            'departamento'=>'required',
            'municipio'=>'required',
            'datenac'=>'required',
            'departamento2'=>'required',
            'municipio2'=>'required',
            'departamento3'=>'required',
            'municipio3'=>'required',
            'barrio'=>'required',
            'direccion'=>'required',
            'estrato'=>'required',
            'telfijo'=>'required',
            'celular'=>'required',
            'sisbenti'=>'required',
            'eps'=>'required',
            'tsangre'=>'required'
            ],[
            'dateexp.required'=>'Fecha de Expedicion',
            'departamento.required'=>'Departamento de Expedicion del Documento',
            'municipio.required'=>'Municipio de Expedicion del Documento',
            'datenac.required'=>'Fecha de Nacimiento',
            'departamento2.required'=>'Departamento de Nacimiento',
            'municipio2.required'=>'Muncipio de Nacimiento',
            'departamento3.required'=>'Departamento de Nacimiento',
            'municipio3.required'=>'Muncipio de Nacimiento',
            'barrio.required'=>'Barrio de Residencia',
            'direccion.required'=>'Direccion de Residencia',
            'estrato.required'=>'Estrato de la Residencia',
            'telfijo.required'=>'Telefono Fijo',
            'celular.required'=>'Número de Celular',
            'sisbenti.required'=>'Si tiene sisben o no',
            'eps.required'=>'EPS',
            'tsangre.required'=>'Tipo de Sangre'
            ]);

        $estudiante->FECHA_EXPEDICION_DE_DOCUMENTO=$request->input('dateexp');
        $estudiante->DEPARTAMENTO_DE_EXPEDICION_DE_DOCUMENTO=$request->input('departamento');
        $estudiante->MUNICIPIO_DE_EXPEDICION_DE_DOCUMENTO=$request->input('municipio');
        $estudiante->FECHA_DE_NACIMIENTO=$request->input('datenac');
        $estudiante->DEPARTAMENTO_DE_NACIMIENTO=$request->input('departamento2');
        $estudiante->MUNICIPIO_DE_NACIMIENTO=$request->input('municipio2');
        $estudiante->DEPARTAMENTO_DE_RESIDENCIA=$request->input('departamento3');
        $estudiante->MUNICIPIO_DE_RESIDENCIA=$request->input('municipio3');
        $estudiante->BARRIO_DE_RESIDENCIA=mb_strtoupper ($request->input('barrio'),'UTF-8');
        $estudiante->DIRECCION_DE_RESIDENCIA=mb_strtoupper ($request->input('direccion'),'UTF-8');
        $estudiante->ESTRATO=$request->input('estrato');
        $estudiante->TELEFONO_DE_RESIDENCIA=$request->input('telfijo');
        $estudiante->CELULAR_DE_RESIDENCIA=$request->input('celular');
        $estudiante->SISBEN=$request->input('sisbenti');
        $estudiante->PUNTAJE_SISBEN=$request->input('puntaje');
        $estudiante->NOMBRE_EPS=$request->input('eps');
        $estudiante->TIPO_DE_SANGRE=$request->input('tsangre');
        $estudiante->save();
        return redirect('/perfil')->with(array(
            'success'=>'Información Actualizada de manera exitosa.'
            ));
    }

}
