<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Support\Facades\View;
use App\institucion;
use App\estudiante;
class Student_login extends Controller
{
	use AuthenticatesUsers;


    public function showLoginForm(){
    	$institucion=institucion::first();
        return View::make('logins.login_student')->with('institucion', $institucion);
    }

    public function login(){
    	$DNI = Input::get('inputdoc');
        $password = Input::get('contrasena');
        // Validamos los datos y además mandamos como un segundo parámetro la opción de recordar el usuario.
        if(Auth::guard('student')->attempt(['CODIGO' => $DNI, 'password' => $password]))
        {
            // De ser datos válidos nos mandara a la bienvenida
            // return auth('teachers')->user()->NOMBRES;
            $estudiante=estudiante::find($DNI);           
            return redirect('/estudiante');
        }
            return redirect('/iniciar_sesion_estudiante')->with(array(
            'message'=>'Usuario o Contraseña Incorrectos'
            ));
    }

    public function logout($cod=0)
    {
        Auth::guard('student')->logout();
        if(isset($cod)){
            if($cod==1){
              return redirect('/iniciar_sesion_estudiante')->with(array(
            'messageChange'=>'Contraseña actualizada de manera exitosa. Inicie sesión con su nueva contraseña.'
            ));  
            }else{
               return redirect('/iniciar_sesion_estudiante')->with(array(
            'messageLOGGIN'=>'Sesión Cerrada'
            )); 
            }
        }else{
        return redirect('/iniciar_sesion_estudiante')->with(array(
            'messageLOGGIN'=>'Sesión Cerrada'
            ));
        }
    }

}
