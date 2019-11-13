<?php

namespace App\Http\Controllers;

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
 	$this->cell(334,6,utf8_decode("CONSOLIDADOS POR ASIGNATURA $institucion->ANO_ACTIVO"),1,"","C",1);
 	$this->SetTextColor(0,0,0);
 	$this->SetFont('Arial','B',8);
 	$this->Ln();
 	$this->SetFillColor(255,255,255);
 	$this->cell(8,6,utf8_decode("No"),1,"","C",1);
 	$this->cell(80,6,utf8_decode("Apellidos y Nombres"),1,"","C",1);
 	$this->cell(10,6,utf8_decode("Per."),1,"","C",1);
 	global $curso_ida;
 	$asignaturas=asignatura::where('id_curso','=',$curso_ida)->where('ANO','=',$institucion->ANO_ACTIVO)->orderBy('NOMBRE_ASIGNATURA', 'ASC')->get();
 		foreach ($asignaturas as $asignatura) {
 			$name=substr($asignatura->NOMBRE_ASIGNATURA, 0, 4);
 			$this->cell(10,6,utf8_decode($name.".."),1,"","C",1);
 		}
 		$this->cell(10,6,utf8_decode("Prom."),1,"","C",1);
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

class generador_consolidados extends PDF
{
	
	public function exportpdf($curso_id) {
	global $curso_ida;
	$curso_ida=$curso_id;
   	$institucion=institucion::first();
   	$h=historial_periodo::where('periodo_anual',$institucion->ANO_ACTIVO)->first();
 	$pdf=new PDF('L','mm','Legal');

 	$pdf::AddPage('L','Legal');
	$pdf::AliasNbPages();
	$curso=curso::where('id',$curso_id)->first();
	$pdf::SetTitle("Consolidados $curso->CURSO",1);
	$estudiantes=estudiante::where('CURSO',$curso->CURSO)->where('ESTADO_DEL_ESTUDIANTE','ACTIVO')->orderBy('APELLIDO1', 'ASC')->orderBy('APELLIDO2', 'ASC')->orderBy('NOMBRES', 'ASC')->get();
	$contador=1;
	$promediocursototal=0;
	$promediocursototal2=0;
	$promediocursototal3=0;
	$promediocursototal4=0;
	$contadorestudiantes=0;
	foreach ($estudiantes as $estudiante) {
	$contadorestudiantes+=1;
	$nombre_estudiante=$estudiante->APELLIDO1." ".$estudiante->APELLIDO2." ".$estudiante->NOMBRES;
	$consultasumanot1=calificacion::where('CODIGO_ESTUDIANTE',$estudiante->CODIGO)->where('ANO_ACT',$institucion->ANO_ACTIVO)->sum('P1');
	$consultasumanot2=calificacion::where('CODIGO_ESTUDIANTE',$estudiante->CODIGO)->where('ANO_ACT',$institucion->ANO_ACTIVO)->sum('P2');
	$consultasumanot3=calificacion::where('CODIGO_ESTUDIANTE',$estudiante->CODIGO)->where('ANO_ACT',$institucion->ANO_ACTIVO)->sum('P3');
	$consultasumanot3=calificacion::where('CODIGO_ESTUDIANTE',$estudiante->CODIGO)->where('ANO_ACT',$institucion->ANO_ACTIVO)->sum('P4');
 	$consultacantidad=calificacion::where('CODIGO_ESTUDIANTE',$estudiante->CODIGO)->where('ANO_ACT',$institucion->ANO_ACTIVO)->count();
	$pdf::cell(8,6,utf8_decode($contador),1,0,"C",0);
	$pdf::cell(80,6,utf8_decode($nombre_estudiante),1,0,"L",0);
	$pdf::cell(10,6,utf8_decode("1."),1,0,"C",0);
	$asignaturas=asignatura::where('id_curso','=',$curso_ida)->where('ANO','=',$institucion->ANO_ACTIVO)->orderBy('NOMBRE_ASIGNATURA', 'ASC')->get();
		foreach($asignaturas as $asignatura){
			$calificacion=calificacion::where('CODIGO_ESTUDIANTE','=',$estudiante->CODIGO)->where('ANO_ACT','=',$institucion->ANO_ACTIVO)->where('id_asignatura','=',$asignatura->id)->first();
			$periodo1=$h->nota_min;
 			$periodo2=$h->nota_min;
 			$periodo3=$h->nota_min;
 			$periodo4=$h->nota_min;

			if(isset($calificacion->P1)){
 				 $periodo1=$calificacion->P1;
 				}

			if($periodo1<$h->nota_min_a){
			$pdf::SetFillColor(178,6,24);
			$pdf::SetTextColor(255,255,255);
			}else{
			$pdf::SetTextColor(0,0,0);
			$pdf::SetFillColor(255,255,255);
			}

			$pdf::cell(10,6,utf8_decode($periodo1),1,0,"C",1);
			$pdf::SetTextColor(0,0,0);
			$pdf::SetFillColor(255,255,255);
			
		}

	$promediototalperiodo1=$pdf::truncateFloat($consultasumanot1/$consultacantidad,2);
	$promediocursototal+=$promediototalperiodo1;
	$pdf::cell(10,6,utf8_decode($promediototalperiodo1),1,0,"C",1);
	$pdf::Ln();

	//PERIODO 2
	$pdf::cell(8,6,"",1,0,"C",0);
	$pdf::cell(80,6,"",1,0,"L",0);
	$pdf::cell(10,6,utf8_decode("2."),1,0,"C",0);
	$asignaturas=asignatura::where('id_curso','=',$curso_ida)->where('ANO','=',$institucion->ANO_ACTIVO)->orderBy('NOMBRE_ASIGNATURA', 'ASC')->get();
		foreach($asignaturas as $asignatura){
			$calificacion=calificacion::where('CODIGO_ESTUDIANTE','=',$estudiante->CODIGO)->where('ANO_ACT','=',$institucion->ANO_ACTIVO)->where('id_asignatura','=',$asignatura->id)->first();
			$periodo1=$h->nota_min;
 			$periodo2=$h->nota_min;
 			$periodo3=$h->nota_min;
 			$periodo4=$h->nota_min;

			if(isset($calificacion->P1)){
 				 $periodo2=$calificacion->P2;
 				}

			if($periodo2<$h->nota_min_a){
			$pdf::SetFillColor(178,6,24);
			$pdf::SetTextColor(255,255,255);
			}else{
			$pdf::SetTextColor(0,0,0);
			$pdf::SetFillColor(255,255,255);
			}

			$pdf::cell(10,6,utf8_decode($periodo2),1,0,"C",1);
			$pdf::SetTextColor(0,0,0);
			$pdf::SetFillColor(255,255,255);
			
		}

	$promediototalperiodo2=$pdf::truncateFloat($consultasumanot2/$consultacantidad,2);
	$promediocursototal2+=$promediototalperiodo2;
	$pdf::cell(10,6,utf8_decode($promediototalperiodo2),1,0,"C",1);
	$pdf::Ln();


		//PERIODO 3
	$pdf::cell(8,6,"",1,0,"C",0);
	$pdf::cell(80,6,"",1,0,"L",0);
	$pdf::cell(10,6,utf8_decode("3."),1,0,"C",0);
	$asignaturas=asignatura::where('id_curso','=',$curso_ida)->where('ANO','=',$institucion->ANO_ACTIVO)->orderBy('NOMBRE_ASIGNATURA', 'ASC')->get();
		foreach($asignaturas as $asignatura){
			$calificacion=calificacion::where('CODIGO_ESTUDIANTE','=',$estudiante->CODIGO)->where('ANO_ACT','=',$institucion->ANO_ACTIVO)->where('id_asignatura','=',$asignatura->id)->first();
			$periodo1=$h->nota_min;
 			$periodo2=$h->nota_min;
 			$periodo3=$h->nota_min;
 			$periodo4=$h->nota_min;

			if(isset($calificacion->P3)){
 				 $periodo3=$calificacion->P3;
 				}

			if($periodo3<$h->nota_min_a){
			$pdf::SetFillColor(178,6,24);
			$pdf::SetTextColor(255,255,255);
			}else{
			$pdf::SetTextColor(0,0,0);
			$pdf::SetFillColor(255,255,255);
			}

			$pdf::cell(10,6,utf8_decode($periodo3),1,0,"C",1);
			$pdf::SetTextColor(0,0,0);
			$pdf::SetFillColor(255,255,255);
			
		}

	$promediototalperiodo3=$pdf::truncateFloat($consultasumanot3/$consultacantidad,2);
	$promediocursototal3+=$promediototalperiodo3;
	$pdf::cell(10,6,utf8_decode($promediototalperiodo3),1,0,"C",1);
	$pdf::Ln();


		//PERIODO 4
	$pdf::cell(8,6,"",1,0,"C",0);
	$pdf::cell(80,6,"",1,0,"L",0);
	$pdf::cell(10,6,utf8_decode("4."),1,0,"C",0);
	$asignaturas=asignatura::where('id_curso','=',$curso_ida)->where('ANO','=',$institucion->ANO_ACTIVO)->orderBy('NOMBRE_ASIGNATURA', 'ASC')->get();
		foreach($asignaturas as $asignatura){
			$calificacion=calificacion::where('CODIGO_ESTUDIANTE','=',$estudiante->CODIGO)->where('ANO_ACT','=',$institucion->ANO_ACTIVO)->where('id_asignatura','=',$asignatura->id)->first();
			$periodo1=$h->nota_min;
 			$periodo2=$h->nota_min;
 			$periodo3=$h->nota_min;
 			$periodo4=$h->nota_min;

			if(isset($calificacion->P4)){
 				 $periodo4=$calificacion->P4;
 				}

			if($periodo4<$h->nota_min_a){
			$pdf::SetFillColor(178,6,24);
			$pdf::SetTextColor(255,255,255);
			}else{
			$pdf::SetTextColor(0,0,0);
			$pdf::SetFillColor(255,255,255);
			}

			$pdf::cell(10,6,utf8_decode($periodo4),1,0,"C",1);
			$pdf::SetTextColor(0,0,0);
			$pdf::SetFillColor(255,255,255);
			
		}

	$promediototalperiodo3=$pdf::truncateFloat($consultasumanot3/$consultacantidad,2);
	$promediocursototal3+=$promediototalperiodo3;
	$pdf::cell(10,6,utf8_decode($promediototalperiodo3),1,0,"C",1);
	$pdf::Ln();



	$contador++;
	}

	$promediocursototal=$pdf::truncateFloat($promediocursototal3/$contadorestudiantes,2);
	$pdf::cell(60,6,utf8_decode("Promedio del curso P4: $promediocursototal"),1,0,"C",1);
	$pdf::Ln();
	$pdf::Ln();
	$pdf::cell(150,4,utf8_decode("CONVERSIONES DE ASIGNATURA"),1,1,"C",1);
	$asignaturas=asignatura::where('id_curso','=',$curso_ida)->where('ANO','=',$institucion->ANO_ACTIVO)->orderBy('NOMBRE_ASIGNATURA', 'ASC')->get();
	foreach($asignaturas as $asignatura){
	$namecort=substr($asignatura->NOMBRE_ASIGNATURA, 0, 4);
	$pdf::cell(50,4,utf8_decode($namecort),1,0,"C",1);
	$pdf::cell(100,4,utf8_decode($asignatura->NOMBRE_ASIGNATURA),1,1,"L",1);		
	}
	ob_clean();
 	$pdf::output();
	}

 	

}