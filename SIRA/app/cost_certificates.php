<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cost_certificates extends Model
{
    protected $table='valor_certificados';
    public $timestamps = false;
    protected $primaryKey = 'ID';
    protected $fillable=["ID","TIPO_CERTIFICADO","DURACION_DIAS","COSTO"];
}
