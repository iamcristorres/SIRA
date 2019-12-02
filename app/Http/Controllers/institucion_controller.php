<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\institucion;
use App\historial_periodo;
use App\Http\Controllers\Response;
use App\curso;
use App\docente;
use App\estudiante;
use App\grado;
use App\coddiagnostico;
use App\diagnostico;
use App\portal;
use App\municipio;
use App\calificacion;
use App\asignatura;
use App\area;
use App\historicoAreas;
use App\historicoAsignatura;
use App\historialCalificacion;
use App\estado_final_anual;
use App\historial_cursos;
class institucion_controller extends Controller
{
    function getDatos_Tu_Institucion(){
    	$institucion=institucion::get();
    	return view('prueba1')->with('institucion', $institucion);
    }

    function save_new_course(Request $request){
         $validatedData=$this->validate($request,[
            'grado'=>'required',
            'curso'=>'required',
            ],[
            'grado.required'=>'Debe ingresar el grado',
            'curso.required'=>'Debe ingresar el nombre del curso',
            ]);

    $cursonew=new curso();
    $cursonew->id_grado=$request->input('grado');
    $cursonew->CURSO=$request->input('curso');
    $cursonew->DIR_CURSO=$request->input('dircurso');
    $cursonew->save();

    return redirect('/adm_cursos')->with(array(
            'message'=>'Creacion Realizada con Éxito'
            ));

    }

    function edit_course($id){

        $curso=curso::find($id);
        return $curso;
    }

    function save_edition(Request $request){
        $id=$request->input('id_couse');
        $curso=curso::find($id);
        $curso->id_grado=$request->input('gradoe');
        $curso->CURSO=$request->input('cursoe');
        $curso->DIR_CURSO=$request->input('dircursoe');
        $curso->save();

        return redirect('/adm_cursos')->with(array(
            'message'=>'Curso Actualizado y/o Editado'
            ));
    }

    function detele_course($id){
        $curso=curso::find($id);
        $curso->delete();

        return redirect('/adm_cursos')->with(array(
            'message'=>'Curso Eliminado'
            ));

    }

    function save_new_period(Request $request){
        $validatedData=$this->validate($request,[
            'periodo_anual'=>'required',
            ],[
            'periodo_anual.required'=>'Debe ingresar el nombre del nuevo periodo.',
            ]);

        $institucion=institucion::find(1);
        $institucion->ANO_ACTIVO=$request->input('periodo_anual');
        $institucion->ACTIVO=1;
        $periodonew=new historial_periodo();

        $periodonew->periodo_anual=$request->input('periodo_anual');
        $periodonew->nota_min=$request->input('min');
        $periodonew->nota_max=$request->input('max');
        $periodonew->nota_min_a=$request->input('apro');
        $periodonew->periodos=$request->input('periodos');
        $periodonew->bj_min=$request->input('bjmin');
        $periodonew->bj_max=$request->input('bjmax');
        $periodonew->bs_min=$request->input('minbas');
        $periodonew->bs_max=$request->input('maxbas');
        $periodonew->al_min=$request->input('minal');
        $periodonew->al_max=$request->input('maxal');
        $periodonew->su_min=$request->input('minsu');
        $periodonew->su_max=$request->input('maxsu');
        $periodonew->save();
        $institucion->save();
        return redirect('/school')->with(array(
            'message'=>'Actualización Realizada con Exito'
            ));

    }

    function update_period(Request $request){

        $institucion=institucion::find(1);
        $periodonew=historial_periodo::where('periodo_anual',$institucion->ANO_ACTIVO)->first();
        $periodonew->nota_min=$request->input('min');
        $periodonew->nota_max=$request->input('max');
        $periodonew->nota_min_a=$request->input('apro');
        $periodonew->periodos=$request->input('periodos');
        $periodonew->bj_min=$request->input('bjmin');
        $periodonew->bj_max=$request->input('bjmax');
        $periodonew->bs_min=$request->input('minbas');
        $periodonew->bs_max=$request->input('maxbas');
        $periodonew->al_min=$request->input('minal');
        $periodonew->al_max=$request->input('maxal');
        $periodonew->su_min=$request->input('minsu');
        $periodonew->su_max=$request->input('maxsu');
        $periodonew->save();
        return redirect('/school')->with(array(
            'message'=>'Actualización Realizada con Exito'
            ));

    }

    function save_basic_information(Request $request){
    	$validatedData=$this->validate($request,[
    		'namecenter'=>'required',
    		'pei'=>'required',
    		'director'=>'required',
    		'cargod'=>'required',
    		],[
    		'pei.required'=>'El PEI es Requerido',
    		'namecenter.required'=>'El nombre del Centro Educativo es Requerido',
    		'director.required'=>'El nombre del Director del Centro Educativo es Requerido',
    		'cargod.required'=>'Debe Ingresar el Cargo del Director del Centro Educativo',
    		]);

    	$institucion=institucion::find(1);
    	$institucion->NOMBRE_ESTABLECIMIENTO=$request->input('namecenter');
    	$institucion->PEI=$request->input('pei');
    	$institucion->RESOLUCION=$request->input('resolucion');
    	$institucion->DIRECTOR_A=$request->input('director');
    	$institucion->CARGO_D=$request->input('cargod');
    	$institucion->SECRETARIO_A=$request->input('secretario');
    	$institucion->CARGO_A=$request->input('cargos');

    	$logo=$request->file('escudo');
    	if($logo){
            $antiguoname=$request->input('antiguo_logo_rute');
    		$logo_path=$logo->getClientOriginalName();
    		\Storage::disk('images')->put($logo_path,\File::get($logo));
            \Storage::disk('images')->delete($antiguoname);
    		$institucion->LOGO=$logo_path;
    	}

        $firmaa1=$request->file('firma1');
        if($firmaa1){
            $antiguoname=$request->input('antiguo_firma1_rute');
            $logo_path=$firmaa1->getClientOriginalName();
            \Storage::disk('images')->put($logo_path,\File::get($firmaa1));
            \Storage::disk('images')->delete($antiguoname);
            $institucion->FIRMA1=$logo_path;
        }

        $firmaa2=$request->file('firma2');
        if($firmaa2){
            $antiguoname=$request->input('antiguo_firma2_rute');
            $logo_path=$firmaa2->getClientOriginalName();
            \Storage::disk('images')->put($logo_path,\File::get($firmaa2));
            \Storage::disk('images')->delete($antiguoname);
            $institucion->FIRMA2=$logo_path;
        }

        $sello1=$request->file('sello1');
        if($sello1){
            $antiguoname=$request->input('antiguo_sello1_rute');
            $logo_path=$sello1->getClientOriginalName();
            \Storage::disk('images')->put($logo_path,\File::get($sello1));
            \Storage::disk('images')->delete($antiguoname);
            $institucion->SELLO_RECT=$logo_path;
        }
         $sello2=$request->file('sello2');
        if($sello2){
            $antiguoname=$request->input('antiguo_sello2_rute');
            $logo_path=$sello2->getClientOriginalName();
            \Storage::disk('images')->put($logo_path,\File::get($sello2));
            \Storage::disk('images')->delete($antiguoname);
            $institucion->SELLO_2=$logo_path;
        }


    	$institucion->save();
    	return redirect('/school')->with(array(
    		'message'=>'Actualización Realizada con Exito'
    		));
    }

    function get_logo($filename){
    	$file=\Storage::disk('images')->get($filename);
    	return \Response($file,200);
    }


    public function retornacursos($id){
        $cursos=curso::where('id_grado',$id)->get();
        return response()->json(
            $cursos->toArray()  
            );
    }    

    public function DeleteTeacher($id){
        $docente=docente::find($id);
        $docente->delete();

        return redirect('/teachers')->with(array(
            'message'=>'Docente Eliminado'
            ));
    }


    public function retornacursos_n($id){
        $grado=grado::where('GRADO',$id)->first();
        $id_grado=$grado->id;
        $cursos=curso::where('id_grado',$id_grado)->get();
        return response()->json(
            $cursos->toArray()  
            );
    }

    public function edit_diagnostico($id){
        $diagnosticocod=coddiagnostico::find($id);
        return $diagnosticocod;
    }

    public function save_edition_diagnostico(Request $request){
        $institucion=institucion::find(1);
        $ano_act=$institucion->ANO_ACTIVO;

        $validatedData=$this->validate($request,[
        'fc'=>'required',
        'fa'=>'required',
        'fcc'=>'required',
        'fcp'=>'required',
        'periodo'=>'required'
            ]);
             $actualdate=date("dmHis"); 
             $periodo=$request->input('periodo');
             $numero_diagnotico=coddiagnostico::where('ANO_ACTIVO','=',$ano_act)->where('PERIODO','=',$periodo)->count()+1;
             $codigo_diagnostico=$ano_act."".$periodo."".$numero_diagnotico;
             $id_diagnostico_c=$request->input('id_diagnostico');
             
             if($request->input('fcc') >= $request->input('fa')){
            $diagnotico_new=coddiagnostico::find($id_diagnostico_c);
            $diagnotico_new->FECHA_APERTURA=$request->input('fa');
            $diagnotico_new->FECHA_CIERRE=$request->input('fcc');
            $diagnotico_new->FECHA_CORTE=$request->input('fc');
            $diagnotico_new->FECHA_PUBLICACION=$request->input('fcp');
            $diagnotico_new->PERIODO=$request->input('periodo');
            $diagnotico_new->save();

            return redirect('/adm_diagnosticos')->with(array(
            'message'=>'Codigo Actualizado.'
            ));

        }else{

            return redirect('/adm_diagnosticos')->with(array(
            'message'=>'Error. No se pudo actualizar el codigo del diagnotico.'
            ));
        }
    }


    public function DeleteDiagnostico($id){
        $diagnotico_c=coddiagnostico::find($id);
        $diagnosticos=diagnostico::where('COD_DIAGNOSTICO','=',$diagnotico_c->NO_DIAG)->where('ANO','=',$diagnotico_c->ANO_ACTIVO)->where('PERIODO','=',$diagnotico_c->PERIODO)->count();
        if($diagnosticos<=0){
         $diagnotico_c->delete();
          return redirect('/adm_diagnosticos')->with(array(
            'message'=>'Operación Realizada con exito.'
            ));   
        }else{
            return redirect('/adm_diagnosticos')->with(array(
            'message'=>'No es posible eliminar el codigo de diagnostico. Ya se han realizado '.$diagnosticos. ' registros correspondiente al código '.$diagnotico_c->NO_DIAG
            ));
        }

    }


    public function update_portals(Request $request){
        $portal=portal::find(1)->first();
        $portal->A_P1=$request->input('fa1');
        $portal->C_P1=$request->input('fc1');
        $portal->A_P2=$request->input('fa2');
        $portal->C_P2=$request->input('fc2');
        $portal->A_P3=$request->input('fa3');
        $portal->C_P3=$request->input('fc3');
        $portal->A_P4=$request->input('fa4');
        $portal->C_P4=$request->input('fc4');
        $portal->EP_PER1=$request->input('pubp1');
        $portal->EP_PER2=$request->input('pubp2');
        $portal->EP_PER3=$request->input('pubp3');
        $portal->EP_PER4=$request->input('pubp4');
        $portal->save();
        return redirect('/school')->with(array(
            'message'=>'Operación Realizada con exito.'
            ));

    }


    public function retornamunicipios($id){
        $municipios=municipio::where('ID_DEPARTAMENTO',$id)->get();
        return response()->json(
            $municipios->toArray()  
            );
    }

    public function truncateFloat($number, $digitos)
    {
    $raiz = 10;
    $multiplicador = pow ($raiz,$digitos);
    $resultado = ((int)($number * $multiplicador)) / $multiplicador;
    return number_format($resultado, $digitos);
    }

    public function cierrePeriodoAnual(){
        $institucion=institucion::find(1);
        $periodo=$institucion->ANO_ACTIVO;
        $h=historial_periodo::where('periodo_anual',$institucion->ANO_ACTIVO)->first();
        if($institucion->ACTIVO==1){

            $areas=area::where('ANO','=',$periodo)->get();
            $asignaturas=asignatura::where('ANO','=',$periodo)->get();
            $cursos=curso::where('PERIODO','=',$periodo)->get();
            foreach ($areas as $area) {
                $historicoArea=new historicoAreas();
                $historicoArea->ID_AREA=$area->id;
                $historicoArea->AREA=$area->NOMBRE_AREA;
                $historicoArea->PERIODO=$area->ANO;
                $historicoArea->save();
            }

            foreach ($cursos as $curso) {
                $historicoCursos=new historial_cursos();
                $historicoCursos->ID_CURSO=$curso->id;
                $historicoCursos->ID_GRADO=$curso->id_grado;
                $historicoCursos->PERIODO=$curso->PERIODO;
                $historicoCursos->CURSO=$curso->CURSO;
                $historicoCursos->save();
            }

            foreach($asignaturas as $asignatura){
                $historicoAsignatura=new historicoAsignatura();
                $historicoAsignatura->ID_AREA=$asignatura->id_area;
                $historicoAsignatura->ID_ASIGNATURA=$asignatura->id;
                $historicoAsignatura->NOMBRE_ASIGNATURA=$asignatura->NOMBRE_ASIGNATURA;
                $historicoAsignatura->ID_GRADO=$asignatura->id_grado;
                $historicoAsignatura->ID_CURSO=$asignatura->id_curso;
                $historicoAsignatura->IHS=$asignatura->IHS;
                $historicoAsignatura->PERIODO=$asignatura->ANO;
                $historicoAsignatura->save();
            }

            $estudiantes=estudiante::where('ESTADO_DEL_ESTUDIANTE','=','ACTIVO')->get();

            foreach ($estudiantes as $estudiante) {
                $calificaciones=calificacion::where('CODIGO_ESTUDIANTE','=',$estudiante->CODIGO)->where('ANO_ACT','=',$periodo)->get();
                foreach ($calificaciones as $calificacion) {
                    $def=($calificacion->P1+$calificacion->P2+$calificacion->P3+$calificacion->P4)/4;
                    $definitiva=$this->truncateFloat($def,1);
                    $fallas=$calificacion->F1+$calificacion->F2+$calificacion->F3+$calificacion->F4;
                    $cal=new historialCalificacion();
                    $cal->CODIGO_ESTUDIANTE=$calificacion->CODIGO_ESTUDIANTE;
                    $cal->ID_ASIGNATURA=$calificacion->id_asignatura;
                    $cal->PERIODO=$calificacion->ANO_ACT;
                    $cal->DEF=$definitiva;
                    $cal->TF=$fallas; 
                    $cal->save();   
                }

                $curso=curso::where('CURSO',$estudiante->CURSO)->first();
                $curso_id=$curso->id;
                //CONSULTA ANO APROBADO O NO
                $total_areas_na=0;
                foreach ($areas as $area) {
                   
                   $asignaturasc=asignatura::where('id_area',$area->id)->where('id_curso',$curso_id)->count();
                   if($asignaturasc>0){
                        $def_area=0;
                        $asignaturass=asignatura::where('id_area',$area->id)->where('id_curso',$curso_id)->get();
                        foreach($asignaturass as $asignaturau){
                            $calificacion=calificacion::where('CODIGO_ESTUDIANTE',$estudiante->CODIGO)->where('ANO_ACT',$institucion->ANO_ACTIVO)->where('id_asignatura',$asignaturau->id)->first();
                            $periodo1=$h->nota_min;
                 $fallasp1=0;
                 $periodo2=$h->nota_min;
                 $fallasp2=0;
                 $periodo3=$h->nota_min;
                 $fallasp3=0;
                 $periodo4=$h->nota_min;
                 $fallasp4=0;
                if(isset($calificacion->P1)){
                 $periodo1=$calificacion->P1;
                }
                if(isset($calificacion->F1)){
                 $fallasp1=$calificacion->F1;
                }
                if(isset($calificacion->P2)){
                 $periodo2=$calificacion->P2;
                }
                if(isset($calificacion->F2)){
                 $fallasp2=$calificacion->F2;
                }
                if(isset($calificacion->P3)){
                 $periodo3=$calificacion->P3;
                }
                if(isset($calificacion->F3)){
                 $fallasp3=$calificacion->F3;
                }
                if(isset($calificacion->P4)){
                 $periodo4=$calificacion->P4;
                }
                if(isset($calificacion->F4)){
                 $fallasp4=$calificacion->F4;
                }
                $defxasi=($periodo1+$periodo2+$periodo3+$periodo4)/4;
                $def_area+=$defxasi;
                        }
                $def_area1=$def_area/$asignaturasc;
                $definitiva_area=$this->truncateFloat($def_area1, 2);
                if($definitiva_area<$h->nota_min_a){
                    $total_areas_na++;
                }
                   }

                }
                $estado="";
                $grado_sig="";
                $grado=grado::where('id','=',$curso->id_grado)->first();
                $curso_c=curso::where('CURSO','=',$estudiante->CURSO)->first();
                if($total_areas_na!=0){
                $estado="NO APROBADO";
                $grado_sig=$estudiante->GRADO;
                }else{
                $estado="APROBADO";
                $grado_sig=$grado->GRADO_SIGUIENTE;         
                }

                //CIERRE CONSULTA AÑO APROBADO O NO

                $esfin=new estado_final_anual();
                $esfin->CODIGO=$estudiante->CODIGO;
                $esfin->PERIODO=$periodo;
                $esfin->COD_GRADO=$curso->id_grado;
                
                $esfin->GRADO=$estudiante->GRADO;
                $esfin->COD_CURSO=$curso_c->id;
                $esfin->ESTADO=$estado;
                $esfin->GRADO_SIGUIENTE=$grado_sig;
                $esfin->save();
            }




            $institucion->ACTIVO=0;
            $institucion->save();

            return redirect('/school')->with(array(
            'message'=>'Operación Realizada con exito.'
            ));
      
        }
    }




}
