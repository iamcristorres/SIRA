<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\institucion;
use App\grado;
use App\docente;
use App\curso;
use App\area;
use App\asignatura;

Route::get('/logo/{filename}',array(
	'as'=>'escudoce',
	'uses'=>'institucion_controller@get_logo'
	));


// INICIAR SESIÓN DOCENTE
Route::get('/iniciar_sesion_docente','Docente_login@showLoginForm');
Route::post('/teacher_login','Docente_login@login');


// INICIAR SESIÓN ADMINISTRADOR
Route::get('/iniciar_sesion_admin','Admin_login@showLoginForm');
Route::post('/admin_login','Admin_login@login');




Route::group(['middleware' => 'mDocente'], function () {

    Route::get('/dashboard_docente','vistas_docentes@dashboard');
    Route::get('/logout','Docente_login@logout');
    // LOGROS Y DESEMPEÑOS
    Route::get('/logros','vistas_docentes@logros');
    Route::get('/logros_a/{asignatura_id}','vistas_docentes@logros_asignatura');
    Route::post('/save_new_logro',array(
	'as'=>'SaveNewLogro',
	'uses'=>'subida_docente@save_new_logro'
	));
	Route::get('/delete_logro/{id}/{idcurso}',array(
	'as'=>'DeleteLogro',
	'uses'=>'subida_docente@delete_logro'
	));
	Route::get('/edit_logro/{id}',array(
	'as'=>'EditLogro',
	'uses'=>'subida_docente@edit_logro'
	));
	Route::post('/save_edition_logro',array(
	'as'=>'SaveEditionLogro',
	'uses'=>'subida_docente@save_edition_logro'
	));
	//CALIFICACIONES
	Route::get('/carga_academica_c','vistas_docentes@carga_academica_c');
	Route::get('/calificador/{asignatura_id}','vistas_docentes@calificador');
	Route::post('/save_califications',array(
	'as'=>'Savecalifications',
	'uses'=>'subida_docente@save_califications'
	));

});

Route::group(['middleware' => 'mAdmin'], function () {

    Route::get('/school','vistas_admin@school');
    Route::get('/logouta','Admin_login@logout');
    Route::post('/save_basic_info',array(
	'as'=>'SaveBasicInfomation',
	'uses'=>'institucion_controller@save_basic_information'
));

Route::post('/save_new_period',array(
	'as'=>'NewPeriod',
	'uses'=>'institucion_controller@save_new_period'
));

Route::post('/update_period',array(
	'as'=>'Update_Periodo',
	'uses'=>'institucion_controller@update_period'
));
//ADMINISTRAR CURSOS

Route::get('/adm_cursos', function () {
	$institucion=institucion::first();
	$grados=grado::all();
	$docentes=docente::orderBy('APELLIDO1', 'asc')->orderBy('APELLIDO2', 'asc')->orderBy('NOMBRES', 'asc')->get();
	$cursos=curso::all();
    return view('administrative.Adm_cursos.adm_courses')->with('institucion', $institucion)->with('grados',$grados)->with('docentes',$docentes)->with('cursos',$cursos);
});

Route::post('/save_new_course',array(
	'as'=>'SaveNewCourse',
	'uses'=>'institucion_controller@save_new_course'
));

Route::get('/delete_course/{id}',array(
	'as'=>'DeleteCourse',
	'uses'=>'institucion_controller@detele_course'
));

Route::get('/edit_course/{id}',array(
	'as'=>'DeleteCourse',
	'uses'=>'institucion_controller@edit_course'
));

Route::post('/save_edition',array(
	'as'=>'SaveEdition',
	'uses'=>'institucion_controller@save_edition'
));

Route::get('/view_courses/{id}','vistas_admin@view_courses');

//ADMINISTRAR AREAS

Route::get('/adm_areas', function () {
	$institucion=institucion::first();
	$areas=area::all();
    return view('administrative.Adm_areas.adm_areas')->with('institucion', $institucion)->with('areas',$areas);
});

Route::post('/save_new_area',array(
	'as'=>'SaveNewArea',
	'uses'=>'academic_creator_controller@save_new_area'
));

Route::get('/delete_area/{id}',array(
	'as'=>'DeleteArea',
	'uses'=>'academic_creator_controller@delete_area'
));

Route::get('/edit_area/{id}',array(
	'as'=>'EditArea',
	'uses'=>'academic_creator_controller@edit_area'
));

Route::post('/save_edition_area',array(
	'as'=>'SaveEditionArea',
	'uses'=>'academic_creator_controller@save_edition_area'
));

//ADMINISTRAR ASIGNATURAS

Route::get('/adm_asignaturas', function () {
	$institucion=institucion::first();
	$areas=area::all();
	$grados=grado::all();
	$docentes=docente::orderBy('APELLIDO1', 'asc')->orderBy('APELLIDO2', 'asc')->orderBy('NOMBRES', 'asc')->get();
	$cursos=curso::all();
	$asignaturas=asignatura::all();
    return view('administrative.Adm_asignatures.adm_asignatures')->with('institucion', $institucion)->with('areas',$areas)->with('grados',$grados)->with('docentes',$docentes)->with('cursos',$cursos)->with('asignaturas',$asignaturas);
});

Route::get('/adm_diagnosticos', function () {
	$institucion=institucion::first();
    return view('administrative.Adm_diagnostico.adm_diag')->with('institucion', $institucion);
});

Route::post('/save_new_asignatura',array(
	'as'=>'SaveNewAsig',
	'uses'=>'academic_creator_controller@save_new_asignature'
));

Route::get('/edit_asignatura/{id}',array(
	'as'=>'EditAsignatura',
	'uses'=>'academic_creator_controller@edit_asignatura'
));

Route::post('/save_edition_asignature',array(
	'as'=>'SaveEditionAsignature',
	'uses'=>'academic_creator_controller@save_edition_asignatura'
));

Route::get('/detele_asignature/{id}',array(
	'as'=>'DeleteAsignatura',
	'uses'=>'academic_creator_controller@delete_asignatura'
));
//TEACHERS
Route::get('/teachers','vistas_admin@v_docentes');
Route::get('/delete_teacher/{id}',array(
	'as'=>'DeleteTeacher',
	'uses'=>'institucion_controller@DeleteTeacher'
	));
Route::post('/save_new_teacher',array(
	'as'=>'SaveNewTeacher',
	'uses'=>'academic_creator_controller@save_new_teacher'
));

Route::get('/view_teacher/{id}','vistas_admin@view_docente');
Route::post('/save_edit_teacher',array(
	'as'=>'SaveEditTeacher',
	'uses'=>'academic_creator_controller@save_edit_teacher'
));
Route::post('/update_password_teacher',array(
	'as'=>'UpPassTeacher',
	'uses'=>'academic_creator_controller@update_pass_teacher'
));
//STUDENTS
Route::get('/students','vistas_admin@v_estudiantes');
Route::post('/save_new_student',array(
	'as'=>'SaveNewStudent',
	'uses'=>'academic_creator_controller@save_new_students'
));

Route::get('/view_students/{id}','vistas_admin@view_students');

Route::post('/save_califications_estudiantes',array(
	'as'=>'Savecalifications_E',
	'uses'=>'academic_creator_controller@save_califications'
	));

Route::get('/delete_califications_estudiantes/{id}','academic_creator_controller@delete_califications_total');
//DOCUMENTS

Route::get('/exportpdf/{curso_id}', 'boletin_prueba@exportpdf');
Route::get('/consolids/{curso_id}', 'generador_consolidados@exportpdf');
Route::get('/p2/{curso_id}', 'Reports_Generators\Admin\Boletines\p2@exportpdf');
//OTHERS

Route::get("curso/{id}","institucion_controller@retornacursos");
Route::get("curso_n/{id}","institucion_controller@retornacursos_n");
});