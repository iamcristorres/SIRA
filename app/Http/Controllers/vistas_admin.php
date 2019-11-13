<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\institucion;
use App\docente;
use App\estudiante;
use App\calificacion;
use App\curso;
use App\eps;
use App\arl;
use App\asignatura;
use App\grado;
use App\historial_periodo;
use App\portal;
use App\logro;
class vistas_admin extends Controller
{
    function school(){
		$institucion=institucion::first();
		$portal=portal::first();
    	return view('administrative.School.school')->with('institucion', $institucion)->with('portal', $portal);
	}

	function v_docentes(){
		$institucion=institucion::first();
		$docentes=docente::all();
		$cursos=curso::all();
		$epss=eps::orderBy('NOMBRE', 'ASC')->get();
		$arls=arl::orderBy('NOMBRE', 'ASC')->get();
    	return view('administrative.Adm_teachers.adm_teachers')->with('institucion', $institucion)->with('docentes',$docentes)->with('epss',$epss)->with('arls',$arls);
	}

	function view_docente($id){
		$institucion=institucion::first();
		$docente=docente::where('CODIGO',$id)->first();
		$asignaturas=asignatura::where('id_docente',$id)->get();
		$epss=eps::orderBy('NOMBRE', 'ASC')->get();
		$arls=arl::orderBy('NOMBRE', 'ASC')->get();
		return view('administrative.Adm_teachers.view_teacher')->with('institucion', $institucion)->with('docente',$docente)->with('epss',$epss)->with('arls',$arls)->with('asignaturas',$asignaturas);
	}

	function view_courses($id){
		$institucion=institucion::first(); 
		$curso=curso::where('id',$id)->first(); 
		return view('administrative.Adm_cursos.view_courses')->with('institucion', $institucion)->with('curso',$curso);
	}

	function v_estudiantes(){
		$institucion=institucion::first();
		$epss=eps::orderBy('NOMBRE', 'ASC')->get();
		$estudiantes=estudiante::all();
		$grados=grado::all();
    	return view('administrative.Adm_students.adm_students')->with('institucion', $institucion)->with('estudiantes',$estudiantes)->with('epss',$epss)->with('grados',$grados);
	}

	function view_students($id){
		$institucion=institucion::first();
		$ano_activo=$institucion->ANO_ACTIVO;
        $periodo=historial_periodo::where('periodo_anual',$ano_activo)->first();
		$estudiante=estudiante::find($id);
		$calificaciones=calificacion::where('ANO_ACT','=',$institucion->ANO_ACTIVO)->where('CODIGO_ESTUDIANTE','=',$id)->get();
		return view('administrative.Adm_students.view_students')->with('estudiante', $estudiante)->with('institucion', $institucion)->with('calificaciones', $calificaciones)->with('periodo_anual',$periodo);
	}

	function view_asign($id){
		$institucion=institucion::first();
		$ano_activo=$institucion->ANO_ACTIVO;
		$asignatura=asignatura::find($id);
		$logros=logro::where('id_asignatura','=',$asignatura->id)->get();
		return view('administrative.Adm_asignatures.view_asignatures')->with('institucion', $institucion)->with('asignatura',$asignatura)->with('logros',$logros);
	}
    



}