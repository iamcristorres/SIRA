<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class usuario extends Authenticatable
{

	use Notifiable;
    protected $table='usuarios';
    protected $primaryKey = 'DNI';
    public $timestamps = false;
    protected $fillable=["DNI","APELLIDO1","APELLIDO2","NOMBRES","password","CORREO","TOKEN_REMEBER"];

	protected $hidden = array('password');
public function setPasswordAttribute($value)
    {
        if( \Hash::needsRehash($value) ) {
            $value = \Hash::make($value);
        }
        $this->attributes['password'] = $value;
    }


    
}
