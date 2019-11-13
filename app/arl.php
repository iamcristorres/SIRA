<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class arl extends Model
{
    protected $table='arl';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable=["id","NOMBRE"];
}
