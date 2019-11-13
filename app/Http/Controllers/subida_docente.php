<?php

namespace App\Http\Controllers;
use App\Encryption;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\logro;
use App\calificacion;
use App\institucion;
use App\coddiagnostico;
use App\diagnostico;
use App\visualizador_diagnostico;
class subida_docente extends Controller
{
    function save_new_logro(Request $request){
         $validatedData=$this->validate($request,[
            'periodo'=>'required',
            'tlogro'=>'required',
            'description'=>'required',
            'id_asignature'=>'required',
            ],[
            'periodo.required'=>'Hace Falta el periodo',
            'tlogro.required'=>'Debe ingresar que tipo de logro',
            'description.required'=>'Debe ingresar la descripcion del logro.',
            ]);

    $logronew=new logro();
    $logronew->id_asignatura=$request->input('id_asignature');
    $logronew->PERIODO=$request->input('periodo');
    $logronew->TIPO_LOGRO=$request->input('tlogro');
    $logronew->DESCRIPCION=trim($request->input('description'));
    if($request->input('tlogro')=='SABER'){
    $logronew->PUESTO=1;
    }else if($request->input('tlogro')=='HACER'){
	$logronew->PUESTO=2;
    }else if($request->input('tlogro')=='SER'){
    $logronew->PUESTO=3;	
    }else{
    $logronew->PUESTO=4;	
    }

    $logronew->save();

    return redirect('/logros_a/'.$request->input('id_asignature'))->with(array(
            'message'=>'Asignatura Creada con éxito.'
            ));

    }

    function delete_logro($id,$idcurso){
    	$logro=logro::find($id);
    	$logro->delete();

    	return redirect('/logros_a/'.$idcurso)->with(array(
            'message'=>'Logro Eliminado'
            ));
    }

    function edit_logro($id){
        $logro=logro::find($id);
        return $logro;
    }

    function save_edition_logro(Request $request){
        $validatedData=$this->validate($request,[
            'periodo_e'=>'required',
            'tlogro_e'=>'required',
            'description_e'=>'required',
            'id_asignature_e'=>'required',
            'id_logro_e'=>'required',
            ],[
            'periodo.required'=>'Hace Falta el periodo',
            'tlogro.required'=>'Debe ingresar que tipo de logro',
            'description.required'=>'Debe ingresar la descripcion del logro.',
            ]);
    $id=$request->input('id_logro_e');    
    $logroed=logro::find($id);
    $logroed->PERIODO=$request->input('periodo_e');
    $logroed->TIPO_LOGRO=$request->input('tlogro_e');
    $logroed->DESCRIPCION=trim($request->input('description_e'));
    if($request->input('tlogro_e')=='SABER'){
    $logroed->PUESTO=1;
    }else if($request->input('tlogro_e')=='HACER'){
    $logroed->PUESTO=2;
    }else if($request->input('tlogro_e')=='SER'){
    $logroed->PUESTO=3;    
    }else{
    $logroed->PUESTO=4;    
    }

    $logroed->save();

    return redirect('/logros_a/'.$request->input('id_asignature_e'))->with(array(
            'message'=>'Logro Modificado con éxito'
            ));

    }

    function save_califications(Request $request){
            $institucion=institucion::find(1);
            $ano_act=$institucion->ANO_ACTIVO;
            $codigo_asignatura="";
            $codigo_asignatura=$request->input('asignatura');
            foreach ($request->input('dni') as $key => $value){
            $countespace=calificacion::where('CODIGO_ESTUDIANTE','=',$request->input('dni')[$key])->where('id_asignatura','=',$codigo_asignatura)->where('ANO_ACT','=',$ano_act)->count();
            if($countespace==0){
            $calificacion=new calificacion();
            $calificacion->CODIGO_ESTUDIANTE=$request->input('dni')[$key];
            $calificacion->id_asignatura=$codigo_asignatura;
            $calificacion->ANO_ACT=$ano_act; 
            $calificacion->F1=$request->input('f1')[$key];
            $calificacion->P1=$request->input('p1')[$key];
            $calificacion->F2=$request->input('f2')[$key];
            $calificacion->P2=$request->input('p2')[$key];
            $calificacion->F3=$request->input('f3')[$key];
            $calificacion->P3=$request->input('p3')[$key];
            $calificacion->F4=$request->input('f4')[$key];
            $calificacion->P4=$request->input('p4')[$key];
            $calificacion->save();
            }else{
            $updateDetails = [ 'F1' => $request->input('f1')[$key], 'P1' => $request->input('p1')[$key], 'P2' => $request->input('p2')[$key], 'P3' => $request->input('p3')[$key], 'P4' => $request->input('p4')[$key], 'F2' => $request->input('f2')[$key], 'F3' => $request->input('f3')[$key], 'F4' => $request->input('f4')[$key] ]; 
            $calificacion2=calificacion::where('id_asignatura','=',$codigo_asignatura)->where('CODIGO_ESTUDIANTE','=',$request->input('dni')[$key])->where('ANO_ACT','=',$ano_act)->update($updateDetails);  
            }
            }
            return redirect('/carga_academica_c')->with(array(
            'message'=>'Calificaciones Enviadas con éxito.'
            ));
    }

    function save_diagnosticos(Request $request){
        $institucion=institucion::find(1);
        $ano_act=$institucion->ANO_ACTIVO;
        $codigo_asignatura=$request->input('asignatura');
        $codigo_diagnostico=Crypt::decrypt($request->input('codigodiag'));
        $vdiagnosticos=coddiagnostico::where('ANO_ACTIVO','=',$ano_act)->where('NO_DIAG','=',$codigo_diagnostico)->count();
        $diag=coddiagnostico::where('ANO_ACTIVO','=',$ano_act)->where('NO_DIAG','=',$codigo_diagnostico)->first();
        if($vdiagnosticos==1){
            foreach ($request->input('seguimiento') as $key => $value){
                $counterspace=diagnostico::where('CODIGO_ESTUDIANTE','=',$request->input('dni')[$key])->where('COD_DIAGNOSTICO','=',$codigo_diagnostico)->where('ANO','=',$ano_act)->where('ASIGNATURA','=',$codigo_asignatura)->count();
                $diagnosticovblanco=rtrim($request->input('diagnostico')[$key]);
                if(($diagnosticovblanco!='')||($diagnosticovblanco!=null)){
                if($counterspace==0){
                    $est_diag=new diagnostico();
                    $est_diag->CODIGO_ESTUDIANTE=$request->input('dni')[$key];
                    $est_diag->COD_DIAGNOSTICO=$codigo_diagnostico;
                    $est_diag->ANO=$ano_act;
                    $est_diag->PERIODO=$diag->PERIODO;
                    $est_diag->ASIGNATURA=$codigo_asignatura;
                    $est_diag->DIAGNOSTICO=rtrim($request->input('diagnostico')[$key]);
                    $est_diag->SEGUIMIENTO=$request->input('seguimiento')[$key];
                    $est_diag->save();
                }else{
                    $updateDetails = [ 'DIAGNOSTICO' => $request->input('diagnostico')[$key], 'SEGUIMIENTO' => $request->input('seguimiento')[$key]]; 
                    $calificacion2=diagnostico::where('ASIGNATURA','=',$codigo_asignatura)->where('CODIGO_ESTUDIANTE','=',$request->input('dni')[$key])->where('ANO','=',$ano_act)->where('COD_DIAGNOSTICO','=',$codigo_diagnostico)->update($updateDetails);  
                }
                }else{
                    $calificacion2=diagnostico::where('ASIGNATURA','=',$codigo_asignatura)->where('CODIGO_ESTUDIANTE','=',$request->input('dni')[$key])->where('ANO','=',$ano_act)->where('COD_DIAGNOSTICO','=',$codigo_diagnostico)->delete();
                }

            }

        return redirect('/diasgnostico_a_subir/'.$codigo_diagnostico)->with(array(
            'message'=>'Actualizaciones enviadas con éxito.'
            ));

        }else{
            return redirect('/diasgnostico_a_subir/'.$codigo_diagnostico)->with(array(
            'message'=>'Error. No se pudieron subir las actualizaciones.'
            ));
        }



    }

    public function save_diagnosticoscomm(Request $request){
        $institucion=institucion::find(1);
        $ano_act=$institucion->ANO_ACTIVO;
        $codigodiag=$request->input('coddiagn');
        $curso=$request->input('curso');
        foreach ($request->input('dni') as $key => $value){
        $codigo_estudiante=$request->input('dni')[$key];
        $createcount=visualizador_diagnostico::where('ESTUDIANTE','=',$codigo_estudiante)->where('COD_DIAG','=',$codigodiag)->count();
        if($createcount==0){
            $create=new visualizador_diagnostico();
            $create->ESTUDIANTE=$codigo_estudiante;
            $create->COD_DIAG=$codigodiag;
            $create->VISTO="No";
            $create->COMENTARIO_PADRE="";
            $create->COMENTARIO_ESTUDIANTE="";
            $create->COMENTARIO_DIRCURSO=rtrim($request->input('diagnostico')[$key]);
            $create->save();
        }else{
            $updateDetails = [ 'COMENTARIO_DIRCURSO' => rtrim($request->input('diagnostico')[$key])]; 
            $calificacion2=visualizador_diagnostico::where('ESTUDIANTE','=',$codigo_estudiante)->where('COD_DIAG','=',$codigodiag)->update($updateDetails);  
        }
        }

        return redirect('diagnosticos_curso/'.$codigodiag.'/'.$curso)->with(array(
            'success'=>'Actualizaciones enviadas con exito.'
            ));

    }

}
