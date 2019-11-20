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


    public function cierrePeriodoAnual(){
        $institucion=institucion::find(1);
        $periodo=$institucion->ANO_ACTIVO;
        if($institucion->ACTIVO==1){

            $areas=area::where('ANO','=',$periodo)->get();
            $asignaturas=asignatura::where('ANO','=',$periodo)->get();

            foreach ($areas as $area) {
                $historicoArea=new historicoArea();
                $historicoArea->AREA=$area->NOMBRE_AREA;
                $historicoArea->PERIODO=$area->ANO;
                $historicoArea->save();
            }

            foreach($asignaturas as $asignatura){
                $historicoAsignatura=new historicoAsignatura();
                $historicoAsignatura->ID_AREA=$asignatura->id_area;
                $historicoAsignatura->NOMBRE_ASIGNATURA=$asignatura->NOMBRE_ASIGNATURA;
                $historicoAsignatura->ID_GRADO=$asignatura->id_grado;
                $historicoAsignatura->ID_CURSO=$asignatura->id_curso;
                $historicoAsignatura->IHS=$asignatura->IHS;
                $historicoAsignatura->PERIODO=$asignatura->ANO;
                $historicoAsignatura->save();
            }

            $estudiantes=estudiante::where('ESTADO_DEL_ESTUDIANTE','=',$periodo)->get();

            foreach ($estudiantes as $estudiante) {
                
            }

            $calificaciones=calificacion::where('ANO_ACT','=',$periodo)->get();

        }
    }

}
