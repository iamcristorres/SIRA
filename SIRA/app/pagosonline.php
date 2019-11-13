<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pagosonline extends Model
{
    protected $table='configuracion_pagos';
    public $timestamps = false;
    protected $primaryKey = 'ID';
    protected $fillable=["ID","PAGOS_EN_LINEA","API_KEY","API_LOGIN","LLAVE_PUBLICA","merchantId","acountId"];
}
