<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class institucion extends Model
{
    protected $table='colegio';
    public $timestamps = false;
    protected $fillable=["NIT","NOMBRE_ESTABLECIMIENTO","PEI","RESOLUCION","LOGO","DIRECTOR_A","CARGO_D","SECRETARIO_A","CARGO_A","ANO_ACTIVO","ACTIVO","FIRMA1","FIRMA2","DIRECCION","TELEFONO","WEB","CIUDAD","SELLO_RECT","SELLO_2"];
}
