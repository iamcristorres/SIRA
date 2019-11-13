<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\institucion;
use App\asignatura;
use App\logro;
use App\estudiante;
use App\historial_periodo;
use App\curso;
use App\coddiagnostico;
use App\diagnostico;
use Illuminate\Support\Facades\View;
class vistas_docentes extends Controller
{
    public function dashboard(){
    	$institucion=institucion::first();
    	$docenteid=auth('teachers')->user()->CODIGO;
    	$asignaturas=asignatura::where('id_docente', $docenteid)->get();
    	return View::make('teacher.dashboard.dashboard')->with('institucion', $institucion)->with('asignaturas', $asignaturas);
    }

    public function logros(){
    	$institucion=institucion::first();
    	$docenteid=auth('teachers')->user()->CODIGO;
    	$asignaturas=asignatura::where('id_docente', $docenteid)->get();
    	return View::make('teacher.logros.logros')->with('institucion', $institucion)->with('asignaturas', $asignaturas);
    }

        public function logros_asignatura($asignatura_id){
        $docenteid=auth('teachers')->user()->CODIGO;
        $asignatura=asignatura::where('id',$asignatura_id)->where('id_docente',$docenteid)->first();   
        $institucion=institucion::first();
        $logros=logro::where('id_asignatura',$asignatura_id)->orderBy('PUESTO', 'ASC')->get();
        return View::make('teacher.logrosxasig.logros_asignature')->with('institucion', $institucion)->with('asignatura', $asignatura)->with('logros', $logros);
    }

    public function carga_academica_c(){
        $institucion=institucion::first();
        $docenteid=auth('teachers')->user()->CODIGO;
        $asignaturas=asignatura::where('id_docente', $docenteid)->get();
        return View::make('teacher.calificaciones.vista_carga')->with('institucion', $institucion)->with('asignaturas', $asignaturas);
    }

    public function calificador($asignatura_id){
        $docenteid=auth('teachers')->user()->CODIGO;
        $asignatura=asignatura::where('id',$asignatura_id)->where('id_docente',$docenteid)->first();
        $institucion=institucion::first();
        $ano_activo=$institucion->ANO_ACTIVO;
        $periodo=historial_periodo::where('periodo_anual',$ano_activo)->first();
        $estudiantes=estudiante::where('CURSO',$asignatura->curso->CURSO)->where('ESTADO_DEL_ESTUDIANTE','ACTIVO')->orderBy('APELLIDO1', 'ASC')->orderBy('APELLIDO2', 'ASC')->orderBy('NOMBRES', 'ASC')->get(); 
        $logros=logro::where('id_asignatura',$asignatura_id)->orderBy('PUESTO', 'ASC')->get();
        return View::make('teacher.calificaciones.calificador')->with('institucion', $institucion)->with('asignatura', $asignatura)->with('estudiantes',$estudiantes)->with('periodo_anual',$periodo);
    }

    public function diagnoticos1(){
        $institucion=institucion::find(1);
        $docenteid=auth('teachers')->user()->CODIGO;
        $ano_act=$institucion->ANO_ACTIVO;
        $actualdate=date("Y-m-d");
        $cursos_teacher=curso::where('DIR_CURSO','=',$docenteid)->get();
        $codigo_diagnosticos=coddiagnostico::where('ANO_ACTIVO','=',$ano_act)->get();
        $diagnosticos_post=coddiagnostico::where('ANO_ACTIVO','=',$ano_act)->where('FECHA_CIERRE','<',$actualdate)->get();
        return View::make('teacher.diagnosticos.selectordiagnostico')->with('institucion', $institucion)->with('codigo_diagnosticos', $codigo_diagnosticos)->with('cursos',$cursos_teacher)->with('diagnosticos_post',$diagnosticos_post);

    }

    public function diagnosticos2busqueda(Request $request){
        $institucion=institucion::find(1);
        $ano_act=$institucion->ANO_ACTIVO;
        $actualdate=date("Y-m-d");
        $codigo_busqueda=$request->input('codigo');
        $codigo_diagnosticos=coddiagnostico::where('ANO_ACTIVO','=',$ano_act)->get();
        $diagnostico=coddiagnostico::where('ANO_ACTIVO','=',$ano_act)->where('NO_DIAG','=',$codigo_busqueda)->first();
        $diagnostico_conteo=coddiagnostico::where('ANO_ACTIVO','=',$ano_act)->where('NO_DIAG','=',$codigo_busqueda)->count();
        if($diagnostico_conteo!=0){
          return redirect('/diasgnostico_a_subir/'.$diagnostico->NO_DIAG);
        }else{
        $message="Error! Diagnostico no encontrado o no disponible";
        return View::make('teacher.diagnosticos.selectordiagnostico')->with('institucion', $institucion)->with('codigo_diagnosticos', $codigo_diagnosticos)->with('messagee1',$message);
        }
        
    }

    public function carga_diagnostico($id){
        $institucion=institucion::find(1);
        $ano_act=$institucion->ANO_ACTIVO;
        $docenteid=auth('teachers')->user()->CODIGO;
        $asignaturas=asignatura::where('id_docente', $docenteid)->get();
        $actualdate=date("Y-m-d");
        $diagnostico=coddiagnostico::where('ANO_ACTIVO','=',$ano_act)->where('NO_DIAG','=',$id)->first();
        $estado=0;
        $fi=$diagnostico->FECHA_APERTURA;
        $ff=$diagnostico->FECHA_CIERRE;
        if(($actualdate>=$fi)&&($actualdate<=$ff)){
        $estado=1;
        }

        if($estado==1){
            return View::make('teacher.diagnosticos.vista_carga_diagnosticos')->with('institucion', $institucion)->with('asignaturas', $asignaturas)->with('diagnostico',$diagnostico);
        }else{
           $message="Error! Diagnostico no encontrado o no disponible";
           return View::make('teacher.diagnosticos.selectordiagnostico')->with('institucion', $institucion)->with('codigo_diagnosticos', $codigo_diagnosticos)->with('messagee1',$message); 
        }

    }

    public function diagnosticador($asignatura_id,$cod){
        $docenteid=auth('teachers')->user()->CODIGO;
        $asignatura=asignatura::where('id',$asignatura_id)->where('id_docente',$docenteid)->first();
        $institucion=institucion::first();
        $ano_activo=$institucion->ANO_ACTIVO;
        $periodo=historial_periodo::where('periodo_anual',$ano_activo)->first();
        $estudiantes=estudiante::where('CURSO',$asignatura->curso->CURSO)->where('ESTADO_DEL_ESTUDIANTE','ACTIVO')->orderBy('APELLIDO1', 'ASC')->orderBy('APELLIDO2', 'ASC')->orderBy('NOMBRES', 'ASC')->get(); 
        return View::make('teacher.diagnosticos.diagnosticador')->with('institucion', $institucion)->with('asignatura', $asignatura)->with('estudiantes',$estudiantes)->with('periodo_anual',$periodo)->with('diagnosticoc',$cod);
    }

    public function diagnosticocurso($diagnostico_cod,$curso){
        $institucion=institucion::find(1);
        $ano_act=$institucion->ANO_ACTIVO;
          $diagnostico=coddiagnostico::where('ANO_ACTIVO','=',$ano_act)->where('NO_DIAG','=',$diagnostico_cod)->first();
          $actualdate=date("Y-m-d");
          $estudiantes=estudiante::where('ESTADO_DEL_ESTUDIANTE','=','ACTIVO')->where('CURSO','=',$curso)->get();
          $ests=array();
          foreach ($estudiantes as $estudiante) {
            $estudiante_diag=diagnostico::where('CODIGO_ESTUDIANTE','=',$estudiante->CODIGO)->where('COD_DIAGNOSTICO','=',$diagnostico_cod)->where('ANO','=',$ano_act)->count();
            if($estudiante_diag>0){
                $estudiante_dia=diagnostico::where('CODIGO_ESTUDIANTE','=',$estudiante->CODIGO)->where('COD_DIAGNOSTICO','=',$diagnostico_cod)->where('ANO','=',$ano_act)->first();
                 $ests[]=estudiante::where('CODIGO','=',$estudiante_dia->CODIGO_ESTUDIANTE)->where('ESTADO_DEL_ESTUDIANTE','=','ACTIVO')->where('CURSO','=',$curso)->first();
            }
          }


          return View::make('teacher.diagnosticos.diagnosticador_curso')->with('institucion', $institucion)->with('cod_diagnostico',$diagnostico_cod)->with('estudiantes',$ests)->with('curso',$curso);

    }
}
