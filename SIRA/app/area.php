<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class area extends Model
{
    protected $table='areas';
    public $timestamps = false;
    protected $fillable=["id","NOMBRE_AREA","ANO"];

}
