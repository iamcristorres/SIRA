<?php

namespace App\Http\Controllers\Reports_Generators\Admin\Boletines;

use Illuminate\Http\Request;
use Anouar\Fpdf\Fpdf as baseFpdf;
use App\institucion;
use App\curso;
use App\grado;
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
			$this->AddPage("P","Letter");
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
    $this->cell(165,6,utf8_decode("$institucion->NOMBRE_ESTABLECIMIENTO"),1,"","C");
 	$this->Ln();
 	$this->SetX(40);
 	$this->SetFont('Arial','B',7);
 	$textoencabezado=$institucion->RESOLUCION."\n".$institucion->PEI;
 	$this->MultiCell(165,4, utf8_decode("$textoencabezado"), 1 , "C" , false);
 	$this->SetFillColor(0,142,213);
 	$this->SetTextColor(255,255,255);
 	$this->SetFont('Arial','B',10);
 	$this->cell(195,6,utf8_decode("INFORME EVALUATIVO FINAL $institucion->ANO_ACTIVO"),1,"","C",1);
 	$this->SetTextColor(0,0,0);
 	$this->SetFont('Arial','B',8);
 	$this->Ln();
 	global $nombre_estudiante;
 	global $grado;
 	global $curso;
 	global $promediototalperiodo1;
 	global $puesto;
 	$estudiantestotal=estudiante::where('CURSO',$curso)->where('ESTADO_DEL_ESTUDIANTE','ACTIVO')->count();
 	$fecha_actual = date('Y-m-d');
 	$this->cell(195,6,utf8_decode(""),1,"","L");
 	$this->SetXY(15,$this::GetY());
 	$this->cell(90,6,utf8_decode("ESTUDIANTE: $nombre_estudiante"),0,"","L");
 	$this->cell(50,6,utf8_decode("GRADO: $grado"),0,"","L");
 	$this->cell(45,6,utf8_decode("CURSO: $curso"),0,"","L");
 	$this->Ln();
 	$this->SetFillColor(131,140,251);
 	$this->cell(102,6,utf8_decode("ÁREAS / ASIGNATURAS"),1,"","C",1);
 	$this->cell(8,6,utf8_decode("IH-S"),1,"","C",1);
 	$this->cell(15,6,utf8_decode("PER. 1."),1,"","C",1);
 	$this->cell(15,6,utf8_decode("PER. 2."),1,"","C",1);
 	$this->cell(15,6,utf8_decode("PER. 3."),1,"","C",1);
 	$this->cell(15,6,utf8_decode("PER. 4."),1,"","C",1);
 	$this->SetFont("Arial", "b",6);
 	$this->cell(10,6,utf8_decode("FALLAS"),1,"","C",1);
 	$this->SetFont("Arial", "b",8);
 	$this->cell(15,6,utf8_decode("DEF."),1,"","C",1);
 	$this->Ln();
    }
    public function truncateFloat($number, $digitos)
	{
    $raiz = 10;
    $multiplicador = pow ($raiz,$digitos);
    $resultado = ((int)($number * $multiplicador)) / $multiplicador;
    return number_format($resultado, $digitos);
 	}

 	public function darpuesto($code,$curso_id){
 		$institucion=institucion::first();
 		$curso=curso::where('id',$curso_id)->first();
 		$promedios = array();
 		$estudiantes=estudiante::where('CURSO',$curso->CURSO)->where('ESTADO_DEL_ESTUDIANTE','ACTIVO')->orderBy('APELLIDO1', 'ASC')->orderBy('APELLIDO2', 'ASC')->orderBy('NOMBRES', 'ASC')->get();
 		$prom=0;
 		foreach($estudiantes as $estudiante){
 		$consultasumanot=calificacion::where('CODIGO_ESTUDIANTE',$estudiante->CODIGO)->where('ANO_ACT',$institucion->ANO_ACTIVO)->sum('P4');
 		$consultacantidad=calificacion::where('CODIGO_ESTUDIANTE',$estudiante->CODIGO)->where('ANO_ACT',$institucion->ANO_ACTIVO)->count();
 		$cantidadasignaturas=asignatura::where('ANO',$institucion->ANO_ACTIVO)->where('id_curso',$curso_id)->count();
 		$promediototalperiodo3=$this->truncateFloat($consultasumanot/$cantidadasignaturas,2);
 		$promedios[]=$promediototalperiodo3;
 		if($code==$estudiante->CODIGO){
 			$prom=$promediototalperiodo3;
 		}
 		}
 		rsort($promedios);
 		$clave = array_search($prom, $promedios);
 		return $clave+1;

 	}
}

class fin extends PDF
{
	public function exportpdf($curso_id) {
   	$institucion=institucion::first();
   	$h=historial_periodo::where('periodo_anual',$institucion->ANO_ACTIVO)->first();
 	$pdf=new PDF('P','mm','Legal');
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
 	global $puesto;
 	$puesto=$pdf::darpuesto($estudiante->CODIGO,$curso_id);
 	$nombre_estudiante=$estudiante->APELLIDO1." ".$estudiante->APELLIDO2." ".$estudiante->NOMBRES;
 	$grado=$estudiante->GRADO;
 	$curso=$estudiante->CURSO;
 	$consultasumanot=calificacion::where('CODIGO_ESTUDIANTE',$estudiante->CODIGO)->where('ANO_ACT',$institucion->ANO_ACTIVO)->sum('P4');
 	$consultacantidad=calificacion::where('CODIGO_ESTUDIANTE',$estudiante->CODIGO)->where('ANO_ACT',$institucion->ANO_ACTIVO)->count();
 	$cantidadasignaturas=asignatura::where('ANO',$institucion->ANO_ACTIVO)->where('id_curso',$curso_id)->count();
 	$promediototalperiodo1=$pdf::truncateFloat($consultasumanot/$cantidadasignaturas,2);



 	$pdf::AddPage('P','Legal');
	$pdf::AliasNbPages();
	$promedio=0;
	$asignaturascount=0;
	$total_areas_na=0;
 	foreach($areas as $area){
 		$asignaturasc=asignatura::where('id_area',$area->id)->where('id_curso',$curso_id)->count();
 		if($asignaturasc>0){
 		$pdf::SetFillColor(87,180,252);
 		$pdf::SetFont('Arial','b',9);
 		
 		$pdf::cell(180,6,utf8_decode("ÁREA:: $area->NOMBRE_AREA"),1,"","L",1);
 		$def_area=0;

 		$asignaturas=asignatura::where('id_area',$area->id)->where('id_curso',$curso_id)->get();
 			foreach($asignaturas as $asignatura){
 				$calificacion=calificacion::where('CODIGO_ESTUDIANTE',$estudiante->CODIGO)->where('ANO_ACT',$institucion->ANO_ACTIVO)->where('id_asignatura',$asignatura->id)->first();
 				$periodo1=$h->nota_min;
 				 $fallasp1=0;
 				 $periodo2=$h->nota_min;
 				 $fallasp2=0;
 				 $periodo3=$h->nota_min;
 				 $fallasp3=0;
 				 $periodo4=$h->nota_min;
 				 $fallasp4=0;
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
 				if(isset($calificacion->P3)){
 				 $periodo3=$calificacion->P3;
 				}
 				if(isset($calificacion->F3)){
 				 $fallasp3=$calificacion->F3;
 				}
 				if(isset($calificacion->P4)){
 				 $periodo4=$calificacion->P4;
 				}
 				if(isset($calificacion->F4)){
 				 $fallasp4=$calificacion->F4;
 				}
 				$defxasi=($periodo1+$periodo2+$periodo3+$periodo4)/4;
 				$def_area+=$defxasi;
 		}		

 		$def_area1=$def_area/$asignaturasc;
 		$definitiva_area=$pdf::truncateFloat($def_area1, 2);


 		$pdf::SetTextColor(255,255,255);
				if($definitiva_area<$h->nota_min_a){
 					$pdf::SetFillColor(178,6,24);
 					$total_areas_na++;
 				}else{
 					$pdf::SetFillColor(3,129,26);
 				}

 		$pdf::cell(15,6,utf8_decode("$definitiva_area"),1,"","C",1);
 		$pdf::SetTextColor(0,0,0);
 		$pdf::SetFont('Arial','',7);
 		$pdf::Ln();

 			foreach($asignaturas as $asignatura){
 				$pdf::SetFillColor(255,255,255);
 		        $nombre_asig=$asignatura->NOMBRE_ASIGNATURA;
 		        $defc=0;
 				$calificacion=calificacion::where('CODIGO_ESTUDIANTE',$estudiante->CODIGO)->where('ANO_ACT',$institucion->ANO_ACTIVO)->where('id_asignatura',$asignatura->id)->first();
 				 $periodo1=$h->nota_min;
 				 $fallasp1=0;
 				 $periodo2=$h->nota_min;
 				 $fallasp2=0;
 				 $periodo3=$h->nota_min;
 				 $fallasp3=0;
 				 $periodo4=$h->nota_min;
 				 $fallasp4=0;


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

 				if(isset($calificacion->P3)){
 				 $periodo3=$calificacion->P3;
 				}
 				if(isset($calificacion->F3)){
 				 $fallasp3=$calificacion->F3;
 				}

 				if(isset($calificacion->P4)){
 				 $periodo4=$calificacion->P4;
 				}
 				if(isset($calificacion->F4)){
 				 $fallasp4=$calificacion->F4;
 				}

 				$defc=($periodo1+$periodo2+$periodo3+$periodo4)/4;
 				$totalfallas=$fallasp1+$fallasp2+$fallasp3+$fallasp4;
 				$definitivad=$pdf::truncateFloat($defc, 2);
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
				$pdf::SetX(269);
				$pdf::SetTextColor(0,0,0);

				if($periodo2<$h->nota_min_a){
 					$pdf::SetTextColor(178,6,24);
 				}else{
 					$pdf::SetTextColor(0,0,0);
 				}
				$pdf::Cell(15, 4,"$periodo2", 0, 0, 'C', true);
 				$pdf::SetX(284);


 				if($periodo3<$h->nota_min_a){
 					$pdf::SetTextColor(178,6,24);
 				}else{
 					$pdf::SetTextColor(0,0,0);
 				}
				$pdf::Cell(15, 4,"$periodo3", 0, 0, 'C', true);
 				$pdf::SetX(299);




 				if($periodo4<$h->nota_min_a){
 					$pdf::SetFillColor(178,6,24);
 				}else{
 					$pdf::SetFillColor(3,129,26);
 				}
 				$pdf::SetTextColor(255,255,255);
 				$pdf::SetFont('Arial','B',11);
				$pdf::Cell(15, 4,"$periodo4", 1, 0, 'C', true);


				$pdf::SetX(314);
				$pdf::SetTextColor(0,0,0);
				$pdf::SetFillColor(255,255,255);
				$pdf::Cell(10, 4,"$definitivad", 0, 0, 'C', true);




				$promedio+=$periodo4;
				$pdf::SetFillColor(255,255,255);
				$pdf::SetTextColor(0,0,0);
				$pdf::SetX(10);
				$pdf::SetFont('Arial','',9);
				$pdf::cell(102,4,utf8_decode(" $nombre_asig"),1,"","L",1);
				$pdf::cell(8,4,utf8_decode("$asignatura->IHS"),1,"","C",1);

 				if($periodo1<$h->nota_min_a){
 					$pdf::SetTextColor(178,6,24);
 				}else{
 					$pdf::SetTextColor(0,0,0);
 				}
				$pdf::cell(15,4,utf8_decode("$periodo1"),1,"","C",1);
				$pdf::SetTextColor(0,0,0);

				if($periodo2<$h->nota_min_a){
 					$pdf::SetTextColor(178,6,24);
 				}else{
 					$pdf::SetTextColor(0,0,0);
 				}
				$pdf::cell(15,4,utf8_decode("$periodo2"),1,"","C",1);
				$pdf::SetTextColor(0,0,0);

				if($periodo3<$h->nota_min_a){
 					$pdf::SetTextColor(178,6,24);
 				}else{
 					$pdf::SetTextColor(0,0,0);
 				}
				$pdf::cell(15,4,utf8_decode("$periodo3"),1,"","C",1);
				$pdf::SetTextColor(0,0,0);

				if($periodo4<$h->nota_min_a){
 					$pdf::SetTextColor(178,6,24);
 				}else{
 					$pdf::SetTextColor(0,0,0);
 				}
				$pdf::cell(15,4,utf8_decode("$periodo4"),1,"","C",1);
				$pdf::SetTextColor(0,0,0);


				$pdf::cell(10,4,utf8_decode("$totalfallas"),1,"","C",1);
				$pdf::SetFont('Arial','B',9);
				$pdf::SetTextColor(255,255,255);
				if($definitivad<$h->nota_min_a){
 					$pdf::SetFillColor(178,6,24);
 				}else{
 					$pdf::SetFillColor(3,129,26);
 				}
				$pdf::cell(15,4,utf8_decode("$definitivad"),1,"","C",1);
				$pdf::SetTextColor(0,0,0);
				$pdf::SetFillColor(255,255,255);
				$pdf::SetFont('Arial','',9);
				$pdf::Ln();
 			}
 		}
 		
 	}
 	$cursoquery=curso::where('id',$curso_id)->first();
 	$grado_siguiente=grado::where('id','=',$cursoquery->id_grado)->first();
 	$text="";
 	if($total_areas_na>=1){
 		$text="AÑO LECTIVO $institucion->ANO_ACTIVO NO APROBADO. NO PROMOVIDO AL GRADO $grado_siguiente->GRADO_SIGUIENTE";
 	}else{
 		$text="¡FELICITACIONES! AÑO LECTIVO $institucion->ANO_ACTIVO APROBADO. PROMOVIDO AL GRADO $grado_siguiente->GRADO_SIGUIENTE";
 	}

 	$pdf::SetFont('Arial','b',8);
 	$pdf::Ln();
 	$pdf::Cell(195, 6,utf8_decode("ESCALA VALORATIVA: Desempeño Superior [$h->su_min - $h->su_max]   Desempeño Alto [$h->al_min - $h->al_max]   Desempeño Básico [$h->bs_min - $h->bs_max]  Desempeño Bajo [$h->bj_min - $h->bj_max]"), 1, 1, 'C', true);
 	$pdf::Ln();
 	$pdf::SetFont('Arial','b',10);
 	$pdf::MultiCell(195, 7,utf8_decode("OBSERVACIONES: $text"), 1, 'J', true);
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