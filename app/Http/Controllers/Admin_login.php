<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Support\Facades\View;
use App\usuario;
use App\institucion;
class Admin_login extends Controller
{
	use AuthenticatesUsers;


    public function showLoginForm(){
    	$institucion=institucion::first();
        return View::make('logins.login_adm')->with('institucion', $institucion);
    }
    public function login(){
    	$DNI = Input::get('inputdoc');
        $password = Input::get('contrasena');
        // Validamos los datos y además mandamos como un segundo parámetro la opción de recordar el usuario.
        if(Auth::guard('admin')->attempt(['DNI' => $DNI, 'password' => $password]))
        {
            // De ser datos válidos nos mandara a la bienvenida
            // return auth('teachers')->user()->NOMBRES;
            return redirect('/school');
        }
        return "fallo";
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/iniciar_sesion_admin');
    }

}
