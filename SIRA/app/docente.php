<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class docente extends Authenticatable
{
    protected $table='docentes';
    public $timestamps = false;
    protected $primaryKey = 'CODIGO';
    protected $fillable=["CODIGO","APELLIDO1","APELLIDO2","NOMBRES","password","DIRECTOR_DE_CURSO","CORREO","EPS","ARL","ESCALAFON","RESOLUCION","CELULAR_TELEFONO","DIRECCION","ULT_ACCESO"];
    protected $hidden = array('password');

    public function setPasswordAttribute($value)
    {
        if( \Hash::needsRehash($value) ) {
            $value = \Hash::make($value);
        }
        $this->attributes['password'] = $value;
    }
}