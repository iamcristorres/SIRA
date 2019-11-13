<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orden extends Model
{
    protected $table='ordenes_pago';
    public $timestamps = false;
    protected $fillable=["ID","DNI","ID_CONCEPTO","CONCEPTO_PAGO","FECHA_CREACION","FECHA_VENCIMIENTO_1","MULTA_1","FECHA_VENCIMIENTO_2","MULTA_2","ESTADO","VALOR_PAGADO","ANO"];

}
