<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class historial_periodo extends Model
{
    protected $table='historial_periodos_activos';
    public $timestamps = false;
    protected $fillable=["id","periodo_anual","periodos","nota_min","nota_max","nota_min_a","bj_min","bj_max","bs_min","bs_max","al_min","al_max","su_min","su_max"];
}
