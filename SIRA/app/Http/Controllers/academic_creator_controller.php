<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Response;
use App\Encryption;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\institucion;
use App\area;
use App\asignatura;
use App\docente;
use App\curso;
use App\estudiante;
use App\calificacion;
use App\coddiagnostico;
use App\logro;
class academic_creator_controller extends Controller
{
    function save_new_area(Request $request){
         $validatedData=$this->validate($request,[
            'nombre_area'=>'required',
            'periodo_aca'=>'required',
            ],[
            'nombre_area.required'=>'El nombre del área es obligatorio',
            'periodo_aca'=>'El periodo académico es requerido',
            ]);

    $areanew=new area();
    $areanew->NOMBRE_AREA=strtoupper($request->input('nombre_area'));
    $areanew->ANO=$request->input('periodo_aca');
    $areanew->save();

    return redirect('/adm_areas')->with(array(
            'message'=>'Creacion Realizada con Éxito'
            ));

    }

    function delete_area($id){
        $area=area::find($id);
        $area->delete();

        return redirect('/adm_areas')->with(array(
            'message'=>'Área Eliminada'
            ));

    }

    function delete_asignatura($id){
        $asignatura=asignatura::find($id);
        $asignatura->delete();

        return redirect('/adm_asignaturas')->with(array(
            'message'=>'Asignatura Eliminada.'
            ));

    }

    function edit_area($id){

        $area=area::find($id);
        return $area;
    }

        function save_edition_area(Request $request){
        $id=$request->input('id_area');
        $area=area::find($id);
        $area->NOMBRE_AREA=$request->input('nombre_areae');
        $area->ANO=$request->input('periodo_acae');
        $area->save();

        return redirect('/adm_areas')->with(array(
            'message'=>'Área Actualizada y/o Editada'
            ));
    }

    function save_edition_asignatura(Request $request){
        $id=$request->input('id_asignature');
        $asignatura=asignatura::find($id);
        $asignatura->id_area=$request->input('e_area');
        $asignatura->NOMBRE_ASIGNATURA=$request->input('asignatura_e');
        $asignatura->id_grado=$request->input('grado_asig_e');
        $asignatura->id_curso=$request->input('curso_e');
        $asignatura->id_docente=$request->input('docente_resp_e');
        $asignatura->IHS=$request->input('ihs_e');
        $asignatura->save();

        return redirect('/adm_asignaturas')->with(array(
            'message'=>'Asignatura Modificada.'
            ));
    }

     function save_new_asignature(Request $request){
         $validatedData=$this->validate($request,[
            'area'=>'required',
            'grado_asig'=>'required',
            'curso'=>'required',
            ],[
            'grado_asig.required'=>'Debe ingresar el grado',
            'curso.required'=>'Debe ingresar el nombre del curso',
            'area.required'=>'Debe ingresar el área',
            ]);

    $asignaturanew=new asignatura();
    $asignaturanew->id_area=$request->input('area');
    $asignaturanew->NOMBRE_ASIGNATURA=$request->input('asignatura');
    $asignaturanew->id_docente=$request->input('docente_resp');
    $asignaturanew->id_grado=$request->input('grado_asig');
    $asignaturanew->id_curso=$request->input('curso');
    $asignaturanew->IHS=$request->input('ihs');
    $asignaturanew->ANO=$request->input('periodo_aca');
    $asignaturanew->save();

    return redirect('/adm_asignaturas')->with(array(
            'message'=>'Asignatura Creada con éxito.'
            ));

    }

    function edit_asignatura($id){

        $asignatura=asignatura::find($id);
        return $asignatura;
    }

    function save_new_teacher(Request $request){
        $validatedData=$this->validate($request,[
            'USUARIO'=>'required',
            'pass'=>'required',
            'apellido1'=>'required',
            'nombres'=>'required',
            'eps'=>'required',
            'arl'=>'required',
            ],[
            'USUARIO.required'=>'Debe ingresar el Usuario',
            'pass.required'=>'Debe ingresar la contraseña',
            'apellido1.required'=>'Es necesario ingresar un apellido',
            'nombres.required'=>'Es necesario ingresar un nombre',
            ]);
        $codigo=trim($request->input('USUARIO'));
        $password=trim($request->input('pass'));
        $docenteant=docente::where('CODIGO',$codigo)->count();
        if($docenteant<1){
        $docentenew=new docente();
        $docentenew->CODIGO=$codigo;
        $docentenew->APELLIDO1=$request->input('apellido1');
        $docentenew->APELLIDO2=$request->input('apellido2');
        $docentenew->NOMBRES=$request->input('nombres');
        $docentenew->password=bcrypt($password);
        $docentenew->CORREO=$request->input('correo');
        $docentenew->EPS=$request->input('eps');
        $docentenew->ARL=$request->input('arl');
        $docentenew->ESCALAFON=$request->input('escalafon');
        $docentenew->RESOLUCION=$request->input('resolucion');
        $docentenew->CELULAR_TELEFONO=$request->input('tel');
        $docentenew->DIRECCION=$request->input('dir');
        $docentenew->save();

        return redirect('/teachers')->with(array(
            'message'=>'Docente Creado de Manera Exitosa.'
            ));

        }

        return redirect('/teachers')->with(array(
            'message'=>'Error, Docente con ese numero de usuario ya se encuentra Registrado.'
            ));
        
    }

    function save_edit_teacher(Request $request){
        $validatedData=$this->validate($request,[
            'USUARIO'=>'required',
            'apellido1'=>'required',
            'nombres'=>'required',
            'eps'=>'required',
            'arl'=>'required',
            ],[
            'USUARIO.required'=>'Debe ingresar el Usuario',
            'apellido1.required'=>'Es necesario ingresar un apellido',
            'nombres.required'=>'Es necesario ingresar un nombre',
            ]);

            $codigo=trim($request->input('USUARIO'));
            $antiguocode=trim($request->input('antiguo_code'));

            $docente=docente::find($antiguocode);
            $docente->CODIGO=$codigo;
            $docente->APELLIDO1=$request->input('apellido1');
            $docente->APELLIDO2=$request->input('apellido2');
            $docente->NOMBRES=$request->input('nombres');
            $docente->CORREO=$request->input('correo');
            $docente->EPS=$request->input('eps');
            $docente->ARL=$request->input('arl');
            $docente->ESCALAFON=$request->input('escalafon');
            $docente->RESOLUCION=$request->input('resolucion');
            $docente->CELULAR_TELEFONO=$request->input('tel');
            $docente->DIRECCION=$request->input('dir');
            $docente->save();

            if($antiguocode!=$codigo){
                $asignaturas=asignatura::where('id_docente',$antiguocode)->get();
                $cursos=curso::where('DIR_CURSO',$antiguocode)->get();
                foreach($asignaturas as $asignatura){
                    $asignatura->id_docente=$codigo;
                    $asignatura->save();
                }
                foreach($cursos as $curso){
                    $curso->DIR_CURSO=$codigo;
                    $curso->save();
                }
            }

            return redirect('/view_teacher/'.$codigo)->with(array(
            'message'=>'Actualizacion Realizada.'
            ));

    }

    function update_pass_teacher(Request $request){
        $validatedData=$this->validate($request,[
            'user'=>'required',
            ],[
            'user.required'=>'Error',
            ]);
        $code=trim($request->input('user'));
        $docente=docente::find($code);
        $docentec=docente::find($code)->count();
        if($docentec==1){
            $docente->password=bcrypt($code);
            $docente->save();
            return redirect('/view_teacher/'.$code)->with(array(
            'message'=>'Contraseña Actualizada y Cambiada de Manera Exitosa'
            ));
        }else{
            return redirect('/view_teacher/'.$code)->with(array(
            'message'=>'Error. No fue posible aplicar los cambios'
            ));
        }
    }


    function save_new_students(Request $request){
        $validatedData=$this->validate($request,[
            'CODIGO'=>'required',
            'pass'=>'required',
            'apellido1'=>'required',
            'nombres'=>'required',
            'grado_ce'=>'required',
            'curso'=>'required',
            'estado_estudiante'=>'required',
            'tipo_estudiante'=>'required',
            'tipo_documento'=>'required',
            'numero_doc'=>'required',
            ],[
            'CODIGO.required'=>'Debe ingresar el Usuario',
            'pass.required'=>'Debe ingresar la contraseña',
            'apellido1.required'=>'Es necesario ingresar un apellido',
            'nombres.required'=>'Es necesario ingresar un nombre',
            ]);
        $codigo=trim($request->input('CODIGO'));
        $password=trim($request->input('pass'));
        $estudianteant=estudiante::where('CODIGO',$codigo)->count();
        if($estudianteant<1){
        $estudiantenew=new estudiante();
        $estudiantenew->CODIGO=$codigo;
        $estudiantenew->APELLIDO1=$request->input('apellido1');
        $estudiantenew->APELLIDO2=$request->input('apellido2');
        $estudiantenew->NOMBRES=$request->input('nombres');
        $estudiantenew->password=bcrypt($password);
        $estudiantenew->GRADO=$request->input('grado_ce');
        $estudiantenew->CURSO=$request->input('curso');
        $estudiantenew->ESTADO_DEL_ESTUDIANTE=$request->input('estado_estudiante');
        $estudiantenew->TIPO_DE_ESTUDIANTE=$request->input('tipo_estudiante');
        $estudiantenew->TIPO_DE_DOCUMENTO=$request->input('tipo_documento');
        $estudiantenew->NUMERO_DE_DOCUMENTO=trim($request->input('numero_doc'));
        $estudiantenew->save();

        return redirect('/students')->with(array(
            'message'=>'Estudiante Creado de Manera Exitosa.'
            ));

        }

        return redirect('/students')->with(array(
            'message'=>'Error, Estudiante con ese numero de usuario ya se encuentra Registrado.'
            ));
        
        }


        function save_califications(Request $request){
            $institucion=institucion::find(1);
            $ano_act=$institucion->ANO_ACTIVO;
            $codigo_estudiante=$request->input('codigo_estudiante');
            foreach ($request->input('p1') as $key => $value){
            $updateDetails = ['P1' => $request->input('p1')[$key], 'P2' => $request->input('p2')[$key], 'P3' => $request->input('p3')[$key], 'P4' => $request->input('p4')[$key]];
            $calificacion2=calificacion::where('id_asignatura','=',$request->input('idasi')[$key])->where('CODIGO_ESTUDIANTE','=',$codigo_estudiante)->where('ANO_ACT','=',$ano_act)->update($updateDetails);  
            }
            return redirect('view_students/'.$codigo_estudiante)->with(array(
            'message'=>'Actualizacion realizada con exito.'
            ));
        }

        function delete_califications_total($id){
            $institucion=institucion::find(1);
            $ano_act=$institucion->ANO_ACTIVO;
            $idd=Crypt::decrypt($id);
            $calificaciones=calificacion::where('CODIGO_ESTUDIANTE','=',$idd)->where('ANO_ACT','=',$ano_act)->get();
            $calificaciones->each->delete();
            return redirect('view_students/'.$idd)->with(array(
            'message'=>'Registro de calificaciones eliminado con éxito.'
            ));
        }

        function create_space_califications($id){
            $institucion=institucion::find(1);
            $ano_act=$institucion->ANO_ACTIVO;
            $idd=Crypt::decrypt($id);
            $estudiante=estudiante::where('CODIGO','=',$idd)->first();
            $curso_nombre=$estudiante->CURSO;
            $curso_B=curso::where('CURSO','=',$curso_nombre)->first();
            $curso_id=$curso_B->id;

      $asignaturas=asignatura::where('id_curso','=',$curso_id)->where('ANO','=',$ano_act)->get();

            foreach ($asignaturas as $asignatura) {
                $conteo_verificado=calificacion::where('id_asignatura','=',$asignatura->id)->where('CODIGO_ESTUDIANTE','=',$idd)->where('ANO_ACT','=',$ano_act)->count();
                if($conteo_verificado==0){
                    $calificacionc=new calificacion();
                    $calificacionc->CODIGO_ESTUDIANTE=$idd;
                    $calificacionc->id_asignatura=$asignatura->id;
                    $calificacionc->ANO_ACT=$ano_act;
                    $calificacionc->save();
                }
            }

            return redirect('view_students/'.$idd)->with(array(
            'message'=>'Registro de Calificaciones Creado.'
            ));
        }

        function save_new_diagnoticof(Request $request){
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

             
             if($request->input('fcc') >= $request->input('fa')){
            $diagnotico_new=new coddiagnostico();
            $diagnotico_new->NO_DIAG=$codigo_diagnostico;
            $diagnotico_new->FECHA_APERTURA=$request->input('fa');
            $diagnotico_new->FECHA_CIERRE=$request->input('fcc');
            $diagnotico_new->FECHA_CORTE=$request->input('fc');
            $diagnotico_new->FECHA_PUBLICACION=$request->input('fcp');
            $diagnotico_new->ANO_ACTIVO=$ano_act;
            $diagnotico_new->PERIODO=$request->input('periodo');
            $diagnotico_new->save();

            return redirect('/adm_diagnosticos')->with(array(
            'message'=>'Codigo Creado.'
            ));

        }else{

            return redirect('/adm_diagnosticos')->with(array(
            'message'=>'Error. No se pudo crear el codigo del diagnotico. Compruebe las fechas de apertura y cierre.'
            ));
        }

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
    $logroed->DESCRIPCION=$request->input('description_e');
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

    return redirect('/view_asignatura/'.$request->input('id_asignature_e'))->with(array(
            'message'=>'Logro Modificado con éxito'
            ));

    }

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

    return redirect('/view_asignatura/'.$request->input('id_asignature'))->with(array(
            'message'=>'Asignatura Creada con éxito.'
            ));

    }

        function delete_logro($id,$idcurso){
        $logro=logro::find($id);
        $logro->delete();

        return redirect('/view_asignatura/'.$idcurso)->with(array(
            'message'=>'Logro Eliminado'
            ));
    }

}
