<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gen_cert extends Model
{
    protected $table='generador_certificados';
    public $timestamps = false;
    protected $primaryKey = 'ID';
    protected $fillable=["ID","REFERENCIA","CODIGO_ES","TIPO_CERT","VALOR","ANO","ESTADO","MAX_PAGO","FECHA_EXPEDICION","FECHA_FIN"];

    public function cost_certificates(){
    	return $this->hasOne("App\cost_certificates","ID","TIPO_CERT");
    }
}
