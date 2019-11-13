<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contabilidad extends Model
{
    protected $table='registro_contable_historial';
    public $timestamps = false;
    protected $fillable=["ID","ESTUDIANTE","ANO","VALOR","TIPO_PAGO","ESTADO","FECHA_PAGO","REFERENCIA","REFERENCIA_ONLINE","DESCRIPCION_VENTA","MEDIO_PAGO"];

}
