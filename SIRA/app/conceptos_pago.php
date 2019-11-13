<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class area extends Model
{
    protected $table='conceptos_pago';
    public $timestamps = false;
    protected $fillable=["ID_CONCEPTO","CONCEPTO"];

}
