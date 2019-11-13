<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class eps extends Model
{
    protected $table='eps';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable=["id","NOMBRE"];
}

