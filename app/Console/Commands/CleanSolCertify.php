<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\gen_cert;
class CleanSolCertify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CleanSolCertify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Limpieza (Eliminación) de Solicitud de certificados ya vencidos, y no procesados';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $fecha_actual = date("Y-m-d");  
      $certificados_vencidos_nopagos=gen_cert::where('ESTADO','=','NO PAGO')->where('MAX_PAGO','<',$fecha_actual)->get();

      foreach ($certificados_vencidos_nopagos as $certificado) {
         $certificado->delete();
      }
    }
}
