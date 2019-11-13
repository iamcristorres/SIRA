<?php

namespace App\Http\Controllers\Reports_Generators\Teacher\Diagnosticos;

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
use App\coddiagnostico;
use App\diagnostico;
use App\visualizador_diagnostico;
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
    $ano_act=$institucion->ANO_ACTIVO;
    global $code;
    $estudiante=estudiante::find($code);
    $nombre_estudiante=$estudiante->APELLIDO1." ".$estudiante->APELLIDO2." ".$estudiante->NOMBRES;
    $this->SetFont('Arial','B',12);
    $url_logo=url('/logo/'.$institucion->LOGO);
    $this->cell(30,24,"",1,"","C");
    $this->Image("$url_logo",12,10,25,25);
    $this->SetX(40);
    $this->cell(160,6,utf8_decode("$institucion->NOMBRE_ESTABLECIMIENTO"),1,"","C");
 	$this->Ln();
 	$this->SetX(40);
 	$this->SetFont('Arial','B',7);
 	$textoencabezado=$institucion->RESOLUCION."\n".$institucion->PEI;
 	$this->MultiCell(160,4, utf8_decode("$textoencabezado"), 1 , "C" , false);
 	$this->SetFillColor(0,142,213);
 	$this->SetTextColor(255,255,255);
 	$this->SetFont('Arial','B',10);
 	global $n;
 	$this->cell(190,6,utf8_decode("DIAGNOSTICO $n"),1,"","C",1);
 	$this->Ln();
 	$this->SetFillColor(255,255,255);
 	$this->SetTextColor(0,0,0);
 	$this->SetFont('Arial','',7);
 	$this->cell(100,6,utf8_decode("ESTUDIANTE: $nombre_estudiante"),1,"","L");
 	$this->cell(50,6,utf8_decode("GRADO: $estudiante->GRADO"),1,"","L");
 	$this->cell(40,6,utf8_decode("CURSO: $estudiante->CURSO"),1,"","L");
 	$this->Ln();
 	$diagnosticoinfo=coddiagnostico::where('NO_DIAG','=',$n)->where('ANO_ACTIVO','=',$ano_act)->first();
 	$this->cell(40,6,utf8_decode("ANO LECTIVO: $ano_act"),1,"","L");
 	$this->cell(30,6,utf8_decode("PERIODO: $diagnosticoinfo->PERIODO"),1,"","L");
 	$fecha_publicacion=date("Y-m-d",strtotime($diagnosticoinfo->FECHA_CIERRE."+ 1 days")); 
 	$this->cell(60,6,utf8_decode("FECHA DE CORTE: $diagnosticoinfo->FECHA_CORTE"),1,"","L");
 	$this->cell(60,6,utf8_decode("FECHA DE PUBLICACION: $diagnosticoinfo->FECHA_PUBLICACION"),1,"","L");
 	$this->SetFont('Arial','B',8);
    }
}

class diagnosticos extends PDF
{
	

	public function exportpdf($cod_diagnostico,$curso) {
		$institucion=institucion::first();
   	$ano_act=$institucion->ANO_ACTIVO;
	$estudiantes=estudiante::where('CURSO','=',$curso)->where('ESTADO_DEL_ESTUDIANTE','=','ACTIVO')->get();
	$ests=array();
	foreach ($estudiantes as $estudiante) {
		$estudiante_diag=diagnostico::where('CODIGO_ESTUDIANTE','=',$estudiante->CODIGO)->where('COD_DIAGNOSTICO','=',$cod_diagnostico)->where('ANO','=',$ano_act)->count();
            if($estudiante_diag>0){
                $estudiante_dia=diagnostico::where('CODIGO_ESTUDIANTE','=',$estudiante->CODIGO)->where('COD_DIAGNOSTICO','=',$cod_diagnostico)->where('ANO','=',$ano_act)->first();
                $ests[]=estudiante::where('CODIGO','=',$estudiante_dia->CODIGO_ESTUDIANTE)->where('ESTADO_DEL_ESTUDIANTE','=','ACTIVO')->where('CURSO','=',$curso)->first();
            }
	}
	global $n;
 	$n=$cod_diagnostico;
   	
   	$pdf=new PDF('P','mm','Legal');
   	foreach ($ests as $estudiante) {
   	global $code;
   	$code=$estudiante->CODIGO;
   	$diagnosticos=diagnostico::where('CODIGO_ESTUDIANTE','=',$estudiante->CODIGO)->where('ANO','=',$ano_act)->where('COD_DIAGNOSTICO','=',$n)->get();
 	$pdf::AddPage('P','Legal');
 	$pdf::SetAutoPageBreak(true,2); 
 	$pdf::SetFont('Arial','B',9);
 	$pdf::SetTextColor(0,0,0);
 	$pdf::Ln();
 	$pdf::Ln();
 	$pdf::SetFillColor(0,142,213);
 	$pdf::SetTextColor(255,255,255);
 	$pdf::Cell(75, 5,"ASIGNATURA", 1, 0, 'L', true);
 	$pdf::Cell(100, 5,"OBSERVACIONES", 1, 0, 'L', true);
 	$pdf::SetFont('Arial','B',7);
 	$pdf::Cell(15, 5,"REQ. SEG.", 1, 0, 'L', true);
 	$pdf::Ln();
 	$pdf::SetFillColor(255,255,255);
 	$pdf::SetTextColor(0,0,0);

 	foreach($diagnosticos as $diagnostico){
 	$pdf::SetWidths(array(75,100,15));
 	$positionx_current=$pdf::GetX();
	$positiony_current=$pdf::GetY();
 	$nombre_Asignatura=utf8_decode($diagnostico->asignatura->NOMBRE_ASIGNATURA);
 	$diagnostico_text=utf8_decode($diagnostico->DIAGNOSTICO);
 	$posy=$pdf::GetY();
 	$pdf::SetFillColor(255,255,255);
 	$pdf::SetFont('Arial','B',10);
 	$pdf::SetX(10);
 	$pdf::Cell(75, 5,"$nombre_Asignatura", 0, 0, 'L', true);
 	$pdf::SetFont('Arial','',9);
 	$pdf::SetX(10);
 	$pdf::Row(array("","$diagnostico_text","$diagnostico->SEGUIMIENTO"));
 	}

 	$comm=visualizador_diagnostico::where('ESTUDIANTE','=',$estudiante->CODIGO)->where('COD_DIAG','=',$cod_diagnostico)->first();
				$comentario_dircurso="";
				$comentario_padre="";
				$comentario_estudiante="";
			if(isset($comm)){
				$comentario_dircurso=$comm->COMENTARIO_DIRCURSO;
				$comentario_padre=$comm->COMENTARIO_PADRE;
				$comentario_estudiante=$comm->COMENTARIO_ESTUDIANTE;
			}
 	$pdf::SetFillColor(0,142,213);
 	$pdf::SetTextColor(255,255,255);
 	$pdf::SetFont('Arial','B',9);
 	$pdf::Ln();
 	$pdf::Cell(190, 5,"COMENTARIO DIRECTOR DE CURSO", 1, 0, 'C', true);
 	$pdf::Ln();
 	$pdf::SetFont('Arial','',9);
 	$pdf::SetTextColor(0,0,0);
 	$pdf::SetFillColor(255,255,255);
 	$pdf::Multicell(190, 5,utf8_decode($comentario_dircurso), 1, 'J', true);
 	$pdf::Ln();
 	$pdf::SetFillColor(0,142,213);
 	$pdf::SetTextColor(255,255,255);
 	$pdf::SetFont('Arial','B',9);
 	$pdf::Cell(190, 5,"COMPROMISO DEL PADRE", 1, 0, 'C', true);
 	$pdf::Ln();
 	$pdf::SetFont('Arial','',9);
 	$pdf::SetTextColor(0,0,0);
 	$pdf::SetFillColor(255,255,255);
 	$pdf::Multicell(190, 5,"", 1, 'J', true);
 	$pdf::Multicell(190, 5,"", 1, 'J', true);
 	$pdf::Multicell(190, 5,"", 1, 'J', true);
 	$pdf::Multicell(190, 5,"", 1, 'J', true);
 	$pdf::Multicell(190, 5,"", 1, 'J', true);
 	$pdf::Multicell(190, 5,"", 1, 'J', true);
 	$pdf::Ln();
 	$pdf::SetFillColor(0,142,213);
 	$pdf::SetTextColor(255,255,255);
 	$pdf::SetFont('Arial','B',9);
 	$pdf::Cell(190, 5,"COMPROMISO DEL ESTUDIANTE", 1, 0, 'C', true);
 	$pdf::Ln();
 	$pdf::SetFont('Arial','',9);
 	$pdf::SetTextColor(0,0,0);
 	$pdf::SetFillColor(255,255,255);
 	$pdf::Multicell(190, 5,"", 1, 'J', true);
 	$pdf::Multicell(190, 5,"", 1, 'J', true);
 	$pdf::Multicell(190, 5,"", 1, 'J', true);
 	$pdf::Multicell(190, 5,"", 1, 'J', true);
 	$pdf::Multicell(190, 5,"", 1, 'J', true);
 	$pdf::Multicell(190, 5,"", 1, 'J', true);
 	$pdf::Ln();
 	$pdf::Ln();
 	$pdf::Ln();
 	$pdf::Ln();
 	$pdf::Cell(55, 5,"_________________________________", 0, 0, 'C', true);
 	$pdf::SetX(78);
 	$pdf::Cell(55, 5,"_________________________________", 0, 0, 'C', true);
 	$pdf::SetX(145);
 	$pdf::Cell(55, 5,"_________________________________", 0, 0, 'C', true);
 	$pdf::Ln();
 	$pdf::Cell(55, 5,"Director(a) Curso", 0, 0, 'C', true);
 	$pdf::SetX(78);
 	$pdf::Cell(55, 5,"Padre y/o Acudiente", 0, 0, 'C', true);
 	$pdf::SetX(145);
 	$pdf::Cell(55, 5,"Estudiante", 0, 0, 'C', true);
 	$pdf::Ln();
 	$pdf::Cell(55, 5,"Fecha:", 0, 0, 'L', true);
 	$pdf::SetX(78);
 	$pdf::Cell(55, 5,"Fecha:", 0, 0, 'L', true);
 	$pdf::SetX(145);
 	$pdf::Cell(55, 5,"Fecha:", 0, 0, 'L', true);
 	}

 	$pdf::Output();
	}

 	

}