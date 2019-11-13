<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class verificacion extends Model
{
    protected $table='verificaciones';
    public $timestamps = false;
    protected $primaryKey = 'ID';
    protected $fillable=["ID","CODIGO","VER1","VER2","VER3","VER4","VER5","VER6","CODIGO_VERIFICACION_CORREO","DATE_VERIFICACION"];

}
