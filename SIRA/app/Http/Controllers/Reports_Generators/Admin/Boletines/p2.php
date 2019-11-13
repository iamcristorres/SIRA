<?php

namespace App\Http\Controllers\Reports_Generators\Admin\Boletines;

use Illuminate\Http\Request;
use Anouar\Fpdf\Fpdf as baseFpdf;
use App\institucion;
use App\curso;
use App\estudiante;
use App\area;
use App\asignatura;
use App\logro;
use App\calificacion;
use App\historial_periodo;
$nombre_estudiante="";
class PDF extends baseFpdf{

	var $widths;
	var $aligns;

	function SetWidths($w)
	{
//Set the array of column widths
		$this->widths=$w;
	}

	function SetAligns($a)
	{
//Set the array of column alignments
		$this->aligns=$a;
	}

	function Row($data)
	{
//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		$h=4*$nb;
//Issue a page break first if needed
		$this->CheckPageBreak($h);
//Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'J';
	//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
	//Draw the border
			$this->Rect($x,$y,$w,$h);
	//Print the text
			$this->MultiCell($w,4,$data[$i],0,$a);
	//Put the position to the right of the cell
			$this->SetXY($x+$w,$y);
		}
//Go to the next line
		$this->Ln($h);
	}

	function CheckPageBreak($h)
	{
//If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger)
			$this->AddPage("L","Legal");
	}

	function NbLines($w,$txt)
	{
//Computes the number of lines a MultiCell of width w will take
		$cw=&$this->CurrentFont['cw'];
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
		$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
		$s=str_replace("\r",'',$txt);
		$nb=strlen($s);
		if($nb>0 and $s[$nb-1]=="\n")
			$nb--;
		$sep=-1;
		$i=0;
		$j=0;
		$l=0;
		$nl=1;
		while($i<$nb)
		{
			$c=$s[$i];
			if($c=="\n")
			{
				$i++;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
				continue;
			}
			if($c==' ')
				$sep=$i;
			$l+=$cw[$c];
			if($l>$wmax)
			{
				if($sep==-1)
				{
					if($i==$j)
						$i++;
				}
				else
					$i=$sep+1;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
			}
			else
				$i++;
		}
		return $nl;
	}




	function Header() 
    {
    $this->SetTextColor(0,0,0);
    $institucion=institucion::first();
    $this->SetFont('Arial','B',12);
    $url_logo=url('/logo/'.$institucion->LOGO);
    $this->cell(30,24,"",1,"","C");
    $this->Image("$url_logo",12,10,25,25);
    $this->SetX(40);
    $this->cell(304,6,utf8_decode("$institucion->NOMBRE_ESTABLECIMIENTO"),1,"","C");
 	$this->Ln();
 	$this->SetX(40);
 	$this->SetFont('Arial','B',7);
 	$textoencabezado=$institucion->RESOLUCION."\n".$institucion->PEI;
 	$this->MultiCell(304,4, utf8_decode("$textoencabezado"), 1 , "C" , false);
 	$this->SetFillColor(0,142,213);
 	$this->SetTextColor(255,255,255);
 	$this->SetFont('Arial','B',10);
 	$this->cell(334,6,utf8_decode("INFORME EVALUATIVO PERIODICO AÑO $institucion->ANO_ACTIVO"),1,"","C",1);
 	$this->SetTextColor(0,0,0);
 	$this->SetFont('Arial','B',8);
 	$this->Ln();
 	global $nombre_estudiante;
 	global $grado;
 	global $curso;
 	global $promediototalperiodo1;


 	$fecha_actual = date('Y-m-d');
 	$this->cell(334,6,utf8_decode(""),1,"","L");
 	$this->SetXY(15,$this::GetY());
 	$this->cell(100,6,utf8_decode("ESTUDIANTE: $nombre_estudiante"),0,"","L");
 	$this->cell(50,6,utf8_decode("GRADO: $grado"),0,"","L");
 	$this->cell(50,6,utf8_decode("CURSO: $curso"),0,"","L");
 	$this->cell(25,6,utf8_decode("PERIODO: II"),0,"","L");
 	$this->cell(60,6,utf8_decode("PROMEDIO DEL PERIODO: $promediototalperiodo1"),0,"","L");
 	$this->cell(25,6,utf8_decode("FECHA: $fecha_actual"),0,"","L");
 	$this->Ln();
 	$this->SetFillColor(131,140,251);
 	$this->cell(64,6,utf8_decode("ÁREAS DE FORMACIÓN"),1,"","C",1);
 	$this->cell(60,6,utf8_decode("LOGROS DEL SABER"),1,"","C",1);
 	$this->cell(60,6,utf8_decode("LOGROS DEL HACER"),1,"","C",1);
 	$this->cell(60,6,utf8_decode("LOGROS DEL SER"),1,"","C",1);
 	$this->cell(60,3,utf8_decode("VALORACIÓN DEL PERIODO"),1,"","C",1);
 	$this->cell(10,6,utf8_decode("DEF"),1,"","C",1);
 	$this->SetFont("Arial", "b",6);
 	$this->cell(10,6,utf8_decode("FALLAS"),1,"","C",1);
 	$this->SetFont('Arial','B',8);
 	$this->cell(10,6,utf8_decode("IHS"),1,"","C",1);
 	$this->SetXY(254,47);
 	$this->SetFillColor(251,131,198);
 	$this->cell(15,3,utf8_decode("PER. 1"),1,"","C",1);
 	$this->cell(15,3,utf8_decode("PER. 2"),1,"","C",1);
 	$this->cell(15,3,utf8_decode("PER. 3"),1,"","C",1);
 	$this->cell(15,3,utf8_decode("PER. 4"),1,"","C",1);
 	$this->SetY(50);
 	$this->Ln();
    }
    public function truncateFloat($number, $digitos)
	{
    $raiz = 10;
    $multiplicador = pow ($raiz,$digitos);
    $resultado = ((int)($number * $multiplicador)) / $multiplicador;
    return number_format($resultado, $digitos);
 	}
}

class p2 extends PDF
{
	

	public function exportpdf($curso_id) {
   	$institucion=institucion::first();
   	$h=historial_periodo::where('periodo_anual',$institucion->ANO_ACTIVO)->first();
 	$pdf=new PDF('L','mm','Legal');
 	$pdf::SetAutoPageBreak(true,2); 
 	$curso=curso::where('id',$curso_id)->first();
 	$director_de_curso=$curso->docente->NOMBRES." ".$curso->docente->APELLIDO1." ".$curso->docente->APELLIDO2;
 	$estudiantes=estudiante::where('CURSO',$curso->CURSO)->where('ESTADO_DEL_ESTUDIANTE','ACTIVO')->orderBy('APELLIDO1', 'ASC')->orderBy('APELLIDO2', 'ASC')->orderBy('NOMBRES', 'ASC')->get();
 	$areas=area::orderBy('NOMBRE_AREA', 'ASC')->get();
 	foreach($estudiantes as $estudiante){
 	global $nombre_estudiante;
 	global $grado;
 	global $curso;
 	global $promediototalperiodo1;
 	$nombre_estudiante=$estudiante->APELLIDO1." ".$estudiante->APELLIDO2." ".$estudiante->NOMBRES;
 	$grado=$estudiante->GRADO;
 	$curso=$estudiante->CURSO;
 	$consultasumanot=calificacion::where('CODIGO_ESTUDIANTE',$estudiante->CODIGO)->where('ANO_ACT',$institucion->ANO_ACTIVO)->sum('P2');
 	$consultacantidad=calificacion::where('CODIGO_ESTUDIANTE',$estudiante->CODIGO)->where('ANO_ACT',$institucion->ANO_ACTIVO)->count();
 	$cantidadasignaturas=asignatura::where('ANO',$institucion->ANO_ACTIVO)->where('id_curso',$curso_id)->count();
 	$promediototalperiodo1=$pdf::truncateFloat($consultasumanot/$cantidadasignaturas,2);



 	$pdf::AddPage('L','Legal');
	$pdf::AliasNbPages();
	$promedio=0;
	$asignaturascount=0;
 	foreach($areas as $area){
 		$asignaturasc=asignatura::where('id_area',$area->id)->where('id_curso',$curso_id)->count();
 		if($asignaturasc>0){
 		$pdf::SetFillColor(87,180,252);
 		$pdf::SetFont('Arial','b',9);
 		
 		$pdf::cell(334,6,utf8_decode("ÁREA:: $area->NOMBRE_AREA"),1,"","L",1);
 		$pdf::SetFont('Arial','',7);
 		$pdf::Ln();
 		$asignaturas=asignatura::where('id_area',$area->id)->where('id_curso',$curso_id)->get();
 			foreach($asignaturas as $asignatura){
 				$pdf::SetFillColor(255,255,255);
 		        $nombre_asig=utf8_decode($asignatura->NOMBRE_ASIGNATURA);
 		        $logro_saberx="";
 		        $logro_hacerx="";
 		        $logro_serx="";
 				$logros_saber=logro::where('id_asignatura',$asignatura->id)->where('PERIODO','2')->where('TIPO_LOGRO','SABER')->get();
 				$logros_hacer=logro::where('id_asignatura',$asignatura->id)->where('PERIODO','2')->where('TIPO_LOGRO','HACER')->get();
 				$logros_ser=logro::where('id_asignatura',$asignatura->id)->where('PERIODO','2')->where('TIPO_LOGRO','SER')->get();
 				$calificacion=calificacion::where('CODIGO_ESTUDIANTE',$estudiante->CODIGO)->where('ANO_ACT',$institucion->ANO_ACTIVO)->where('id_asignatura',$asignatura->id)->first();
 				foreach($logros_saber as $logro_saber){
 				$logro_saberx=$logro_saberx.utf8_decode($logro_saber->DESCRIPCION."\n");
 				}
 				foreach($logros_hacer as $logro_hacer){
 				$logro_hacerx=$logro_hacerx.utf8_decode($logro_hacer->DESCRIPCION."\n");
 				}
 				foreach($logros_ser as $logro_ser){
 				$logro_serx=$logro_serx.utf8_decode($logro_ser->DESCRIPCION."\n");
 				}
 				
 				$positionx_current=$pdf::GetX();
				$positiony_current=$pdf::GetY();
 				$pdf::SetWidths(array(64,60,60,60,15,15,15,15,10,10,10));
 				 $periodo1=$h->nota_min;
 				 $fallasp1=0;
 				 $periodo2=$h->nota_min;
 				 $fallasp2=0;
 				 $periodo3=$h->nota_min;
 				 $periodo4=$h->nota_min;
 				if(isset($calificacion->P1)){
 				 $periodo1=$calificacion->P1;
 				}
 				if(isset($calificacion->F1)){
 				 $fallasp1=$calificacion->F1;
 				}

 				if(isset($calificacion->P2)){
 				 $periodo2=$calificacion->P2;
 				}
 				if(isset($calificacion->F2)){
 				 $fallasp2=$calificacion->F2;
 				}

 				$posy=$pdf::GetY();
 				$pdf::SetX(10);
 				$pdf::SetFillColor(255,255,255);
 				$pdf::SetFont('Arial','B',9);
 				$pdf::Cell(64, 5,"$nombre_asig", 0, 0, 'L', true);

 				$pdf::SetX(254);

 				if($periodo1<$h->nota_min_a){
 					$pdf::SetTextColor(178,6,24);
 				}else{
 					$pdf::SetTextColor(0,0,0);
 				}
 				$pdf::Cell(15, 4,"$periodo1", 0, 0, 'C', true);
				$pdf::SetTextColor(0,0,0);

 				$pdf::SetX(269);

 				if($periodo2<$h->nota_min_a){
 					$pdf::SetFillColor(178,6,24);
 				}else{
 					$pdf::SetFillColor(3,129,26);
 				}
 				$pdf::SetTextColor(255,255,255);
 				$pdf::SetFont('Arial','B',11);
				$pdf::Cell(15, 4,"$periodo2", 1, 0, 'C', true);
				$promedio+=$periodo1;
				$pdf::SetFillColor(255,255,255);
				$pdf::SetTextColor(0,0,0);
				$pdf::SetFont('Arial','',7);


				$pdf::SetX(10);
				$pdf::Row(array("","$logro_saberx","$logro_hacerx","$logro_serx","","","","","","   $fallasp2","   $asignatura->IHS"));
				
				
 			}
 		}
 		
 	}
 	$pdf::SetFont('Arial','b',9);
 	$pdf::Cell(334, 6,utf8_decode("ESCALA VALORATIVA: Desempeño Superior [$h->su_min - $h->su_max]   Desempeño Alto [$h->al_min - $h->al_max]   Desempeño Básico [$h->bs_min - $h->bs_max]  Desempeño Bajo [$h->bj_min - $h->bj_max]"), 1, 1, 'C', true);
 	$pdf::Cell(334, 5,utf8_decode("OBSERVACIONES"), 1, 1, 'J', true);
 	$pdf::Cell(334, 5,utf8_decode(""), 1, 1, 'C', true);
 	$pdf::Cell(334, 5,utf8_decode(""), 1, 1, 'C', true);
 	$pdf::Cell(334, 5,utf8_decode(""), 1, 1, 'C', true);
 	$pdf::Cell(334, 5,utf8_decode(""), 1, 1, 'C', true);
 	$pdf::Ln();
 	$pdf::SetY($pdf::GetY()+15);
 	$url_firma_director=url('/logo/'.$institucion->FIRMA1);
 	
 	$pdf::Cell(167, 5,utf8_decode("____________________________________"), 0, 0, 'C', true);
 	$pdf::Cell(167, 5,utf8_decode("____________________________________"), 0, 1, 'C', true);
 	$pdf::Cell(167, 5,utf8_decode("$institucion->DIRECTOR_A"), 0, 0, 'C', true);
 	$pdf::Cell(167, 5,utf8_decode("$director_de_curso"), 0, 1, 'C', true);
 	$pdf::Cell(167, 5,utf8_decode("$institucion->CARGO_D"), 0, 0, 'C', true);
 	$pdf::Cell(167, 5,utf8_decode("Director(a) de Curso"), 0, 1, 'C', true);
 	$pdf::Image("$url_firma_director",63,$pdf::getY()-30,50,22);
 	}


 	$pdf::Output();
	}

 	

}