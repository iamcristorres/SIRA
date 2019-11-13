<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cpagos extends Model
{
    protected $table='configuracion_pagos';
    public $timestamps = false;
    protected $fillable=["ID","PAGOS_EN_LINEA","API_KEY","API_LOGIN","LLAVE_PUBLICA"];

}
