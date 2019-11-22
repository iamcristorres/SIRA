<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\institucion;
use App\asignatura;
use App\logro;
use App\estudiante;
use App\historial_periodo;
use App\verificacion;
use App\curso;
use App\calificacion;
use App\area;
use App\diagnostico;
use App\coddiagnostico;
use App\portal;
use App\gen_cert;
use App\pagosonline;
use App\orden;
use App\departamento;
use App\eps;
use App\historialCalificacion;
use App\visualizador_diagnostico;
use Illuminate\Support\Facades\View;
class vistas_estudiantes extends Controller
{
    public function dashboard(){
        $hoy=date("Y-m-d");
    	$institucion=institucion::first();
        $ano_act=$institucion->ANO_ACTIVO;
    	$estudiante=estudiante::find(auth('student')->user()->CODIGO);
    	$verificador=verificacion::where('CODIGO','=',auth('student')->user()->CODIGO)->first();
        $ordenes_pendientes=orden::where('DNI','=',auth('student')->user()->CODIGO)->where('ANO','=',$ano_act)->where('ESTADO','=','NO PAGO')->get();
        $diagnosticoest=visualizador_diagnostico::where('ESTUDIANTE','=',auth('student')->user()->CODIGO)->where('VISTO','=','No')->get();
    	return View::make('students.dashboard.dashboard')->with('institucion', $institucion)->with('estudiante',$estudiante)->with('verificador',$verificador)->with('ordenes',$ordenes_pendientes)->with('diagnosticopend',$diagnosticoest);
    }

    public function correop(){
    	$institucion=institucion::first();
    	$estudiante=estudiante::find(auth('student')->user()->CODIGO);
    	$verificador=verificacion::where('CODIGO','=',auth('student')->user()->CODIGO)->first();
    	return View::make('emails.codigoactivacion')->with('institucion', $institucion)->with('estudiante',$estudiante)->with('verificador',$verificador);
    }

    public function consulta_calificaciones(){
        $institucion=institucion::first();
        $portal=portal::first();
        $ano_act=$institucion->ANO_ACTIVO;
        $estudiante=estudiante::find(auth('student')->user()->CODIGO);
        $calificaciones=calificacion::where('CODIGO_ESTUDIANTE','=',auth('student')->user()->CODIGO)->get();
        $verificador=verificacion::where('CODIGO','=',auth('student')->user()->CODIGO)->first();
        $curso=curso::where('CURSO','=',$estudiante->CURSO)->first();
        $curso_id=$curso->id;
        $areas=area::orderBy('NOMBRE_AREA', 'ASC')->get();
        $ordenesVencidas=orden::where('DNI','=',auth('student')->user()->CODIGO)->where('ANO','=',$ano_act)->where('ESTADO','=','VENCIDO')->count();
        $asignaturas=asignatura::where('id_curso','=',$curso_id)->get();
        $diagnosticoest=visualizador_diagnostico::where('ESTUDIANTE','=',auth('student')->user()->CODIGO)->where('VISTO','=','No')->get();
        $ordenes_pendientes=orden::where('DNI','=',auth('student')->user()->CODIGO)->where('ANO','=',$ano_act)->where('ESTADO','=','NO PAGO')->get();
        if($ordenesVencidas==0){
        return View::make('students.calificaciones.calificaciones')->with('institucion', $institucion)->with('estudiante',$estudiante)->with('calificaciones',$calificaciones)->with('areas',$areas)->with('asignaturas',$asignaturas)->with('portal',$portal);
        }else{
        $error='Apreciado padre de familia y/o estudiante, no es posible realizar esta acción. Actualmente el estudiante presenta ordenes de pago VENCIDAS.';
        return redirect('/estudiante')->with('institucion', $institucion)->with('estudiante',$estudiante)->with('verificador',$verificador)->with('ordenes',$ordenes_pendientes)->with('diagnosticopend',$diagnosticoest)->with('error',$error);
        }
    }

    public function consulta_diagnosticos(){
        $institucion=institucion::first();
        $ano_act=$institucion->ANO_ACTIVO;
        $estudiante=estudiante::find(auth('student')->user()->CODIGO);
        $diagnosticos=diagnostico::distinct()->where('CODIGO_ESTUDIANTE','=',auth('student')->user()->CODIGO)->where('ANO','=',$ano_act)->get(['COD_DIAGNOSTICO']);;
       $info=array();
       foreach($diagnosticos as $diagnostico) {
       $consulta_info_diagnostico=coddiagnostico::where('NO_DIAG','=',$diagnostico->COD_DIAGNOSTICO)->where('ANO_ACTIVO','=',$ano_act)->first();
       $hoy=date("Y-m-d");
       $fecha_cierre=$consulta_info_diagnostico->FECHA_PUBLICACION;
       if($hoy>=$fecha_cierre){
        $info[]=$consulta_info_diagnostico;
        }
        }
        $curso=curso::where('CURSO','=',$estudiante->CURSO)->first();
        $curso_id=$curso->id;
        $asignaturas=asignatura::where('id_curso','=',$curso_id)->get();
        return View::make('students.diagnosticos.diagnosticos')->with('institucion', $institucion)->with('estudiante',$estudiante)->with('diagnosticos',$diagnosticos)->with('info',$info);
    }

    public function construction_page(){
        $institucion=institucion::first();
        $ano_act=$institucion->ANO_ACTIVO;
        $estudiante=estudiante::find(auth('student')->user()->CODIGO);
         return View::make('students.information_page.construction_page')->with('institucion', $institucion)->with('estudiante',$estudiante);
    }

    public function solicitudcertificados(){
        $institucion=institucion::first();
        $ano_act=$institucion->ANO_ACTIVO;
        $estudiante=estudiante::find(auth('student')->user()->CODIGO);
        $anosaca=historialCalificacion::where('CODIGO_ESTUDIANTE','=',auth('student')->user()->CODIGO)->distinct('PERIODO')->get('PERIODO');
        $infopago=pagosonline::first();
        $fecha_actual = date("Y-m-d");
        $certificados=gen_cert::where('CODIGO_ES','=',auth('student')->user()->CODIGO)->where('MAX_PAGO','>=',$fecha_actual)->get();
        $certcount=$certificados->count();
        return View::make('students.solicitud_cert.solicitud_certificados')->with('institucion', $institucion)->with('estudiante',$estudiante)->with('ano_act',$ano_act)->with('certificados',$certificados)->with('solicitudes',$certcount)->with('infopago',$infopago)->with('acayears',$anosaca);
    }

    public function perfil(){
        $institucion=institucion::first();
        $ano_act=$institucion->ANO_ACTIVO;
        $estudiante=estudiante::find(auth('student')->user()->CODIGO);
        $departamentos=departamento::orderBy('NOMBRE_DEPARTAMENTO', 'ASC')->get(); 
        $epss=eps::orderBy('NOMBRE', 'ASC')->get(); 
        return View::make('students.perfil.perfil')->with('institucion', $institucion)->with('estudiante',$estudiante)->with('ano_act',$ano_act)->with('departamentos',$departamentos)->with('epss',$epss);
    }

    public function h_calificaciones(){
        $institucion=institucion::first();
         $ano_act=$institucion->ANO_ACTIVO;
        $estudiante=estudiante::find(auth('student')->user()->CODIGO);
        $anosaca=historialCalificacion::where('CODIGO_ESTUDIANTE','=',auth('student')->user()->CODIGO)->distinct('PERIODO')->get('PERIODO');
        return View::make('students.calificaciones.historico_calificaciones')->with('institucion', $institucion)->with('estudiante',$estudiante)->with('acayears',$anosaca);;
    }
}
