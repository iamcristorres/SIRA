<?php

namespace App\Http\Controllers\Reports_Generators\Students\Certificates;

use Illuminate\Http\Request;
use Anouar\Fpdf\Fpdf as baseFpdf;
use App\institucion;
use App\curso;
use App\grado;
use App\estudiante;
use App\gen_cert;
use App\asignatura;

use App\estado_final_anual;
use App\historial_periodo;
use App\historialCalificacion;
use App\historicoAreas;
use App\historicoAsignatura;
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
			$this->AddPage("L","Letter");
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
    $ciudad=$institucion->CIUDAD;
    global $ano_act;
    $this->SetFont('Arial','B',12);
    $url_logo=url('/logo/'.$institucion->LOGO);
    $this->cell(30,24,"",0,"","C");
    $this->Image("$url_logo",12,10,25,25);
    $this->SetX(40);
    $this->cell(160,6,utf8_decode("$institucion->NOMBRE_ESTABLECIMIENTO"),0,"","C");
 	$this->Ln();
 	$this->SetX(40);
 	$this->SetFont('Arial','B',9);
 	$textoencabezado=$institucion->RESOLUCION."\n".$institucion->PEI;
 	$this->MultiCell(160,4, utf8_decode("$textoencabezado"), 0 , "C" , false);
 	$this->Ln();
 	$this->Ln();
 	$this->SetFillColor(12,90,223);
    $this->Cell(165,2,utf8_decode(""),0,"","C",1);
 	$this->SetFillColor(0,142,213);
 	$this->SetTextColor(255,255,255);
 	$this->SetFont('Arial','B',10);
    }

    function Footer() 
    {
    $this->SetY(-30);
    $this->SetFont('Arial','B',12);
    $this->SetTextColor(0,0,0);
    $institucion=institucion::first();
    $telefono=$institucion->TELEFONO;
    $direccion=$institucion->DIRECCION;
    $paginaweb=$institucion->WEB;
    $this->SetFillColor(12,90,223);
    $this->Cell(165,3,utf8_decode(""),0,"","C",1);
    $this->Ln();
    $this->SetFont('Arial','B',11);
    $this->SetTextColor(0,0,0);
    $this->Cell(165,6,utf8_decode("$direccion"),0,"","C");
    $this->Ln();
    $this->Cell(165,6,utf8_decode("$telefono"),0,"","C");
    $this->Ln();
    $this->Cell(165,6,utf8_decode("$paginaweb"),0,"","C");

    }


    function fechareturn($dia,$mes,$ano){
    	$diasname="";
    	$mesname="";
    	if($dia==1){
    		$diasname="el primer (01) día del mes de ";
    	}
    	if($dia==2){
    		$diasname="a los dos (02) días del mes de ";
    	}
    	if($dia==3){
    		$diasname="a los tres (03) días del mes de ";
    	}
    	if($dia==4){
    		$diasname="a los cuatro (04) días del mes de ";
    	}
    	if($dia==5){
    		$diasname="a los cinco (05) días del mes de ";
    	}
    	if($dia==6){
    		$diasname="a los seis (06) días del mes de ";
    	}
    	if($dia==7){
    		$diasname="a los siete (07) días del mes de ";
    	}
    	if($dia==8){
    		$diasname="a los ocho (08) días del mes de ";
    	}
    	if($dia==9){
    		$diasname="a los nueve (09) días del mes de ";
    	}
    	if($dia==10){
    		$diasname="a los diez (10) días del mes de ";
    	}
    	if($dia==11){
    		$diasname="a los once (11) días del mes de ";
    	}
    	if($dia==12){
    		$diasname="a los doce (12) días del mes de ";
    	}
    	if($dia==13){
    		$diasname="a los trece (13) días del mes de ";
    	}
    	if($dia==14){
    		$diasname="a los catorce (14) días del mes de ";
    	}
    	if($dia==15){
    		$diasname="a los quince (15) días del mes de ";
    	}
    	if($dia==16){
    		$diasname="a los dieciseis (16) días del mes de ";
    	}
    	if($dia==17){
    		$diasname="a los diecisiete (17) días del mes de ";
    	}
    	if($dia==18){
    		$diasname="a los dieciocho (18) días del mes de ";
    	}
    	if($dia==19){
    		$diasname="a los diecinueve (19) días del mes de ";
    	}
    	if($dia==20){
    		$diasname="a los veinte (20) días del mes de ";
    	}
    	if($dia==21){
    		$diasname="a los veintiun (21) días del mes de ";
    	}
    	if($dia==22){
    		$diasname="a los veintidos (22) días del mes de ";
    	}
    	if($dia==23){
    		$diasname="a los veintitres (23) días del mes de ";
    	}
    	if($dia==24){
    		$diasname="a los veinticuatro (24) días del mes de ";
    	}
    	if($dia==25){
    		$diasname="a los veinticinco (25) días del mes de ";
    	}
    	if($dia==26){
    		$diasname="a los veinciseis (26) días del mes de ";
    	}
    	if($dia==27){
    		$diasname="a los veintisiete (27) días del mes de ";
    	}
    	if($dia==28){
    		$diasname="a los veintiocho (28) días del mes de ";
    	}
    	if($dia==29){
    		$diasname="a los veintinueve (29) días del mes de ";
    	}
    	if($dia==30){
    		$diasname="a los treinta (30) días del mes de ";
    	}
    	if($dia==31){
    		$diasname="a los treinta y un (31) días del mes de ";
    	}
    	

    	if($mes==1){
    		$mesname="Enero del año ";
    	}
    	if($mes==2){
    		$mesname="Febrero del año ";
    	}
    	if($mes==3){
    		$mesname="Marzo del año ";
    	}
    	if($mes==4){
    		$mesname="Abril del año ";
    	}
    	if($mes==5){
    		$mesname="Mayo del año ";
    	}
    	if($mes==6){
    		$mesname="Junio del año ";
    	}
    	if($mes==7){
    		$mesname="Julio del año ";
    	}
    	if($mes==8){
    		$mesname="Agosto del año ";
    	}
    	if($mes==9){
    		$mesname="Septiembre del año ";
    	}
    	if($mes==10){
    		$mesname="Octubre del año ";
    	}
    	if($mes==11){
    		$mesname="Noviembre del año ";
    	}
    	if($mes==12){
    		$mesname="Diciembre del año ";
    	}

    	$fechafinal=$diasname."".$mesname."".$ano;
    	return $fechafinal;

    }

    function estudios(){
    	global $estudiante_codigo;
    	global $cod_certifi;
    	global $ano_cert;
    	global $fecha_expedicion;

    	$institucion=institucion::first();
    	$ciudad=$institucion->CIUDAD;
    	$per1=$institucion->DIRECTOR_A;
    	$cargo1=$institucion->CARGO_D;
    	$per2=$institucion->SECRETARIO_A;
    	$cargo2=$institucion->CARGO_A;
    	$firma_persona1=url('/logo/'.$institucion->FIRMA1);
    	$firma_persona2=url('/logo/'.$institucion->FIRMA2);
    	$sello1=url('/logo/'.$institucion->SELLO_RECT);
        $sello2=url('/logo/'.$institucion->SELLO_2);
    	$this->Ln();
    	$this->Ln();
        $this->Ln();
    	$this->SetTextColor(0,0,0);
    	$this->Ln();
    	$this->SetFont('Arial','B',12);
    	$this->cell(165,6,utf8_decode("CERTIFICADO ESTUDIANTIL"),0,"","C");
    	$this->Ln();
        $this->Ln();
        $this->Ln();
    	$this->SetFont('Arial','B',12);
    	$estudiante=estudiante::find($estudiante_codigo);
    	$nombre_estudiante=mb_strtoupper($estudiante->NOMBRES." ".$estudiante->APELLIDO1." ".$estudiante->APELLIDO2, 'UTF-8');
    	$numero_de_documento=number_format($estudiante->NUMERO_DE_DOCUMENTO, 0, '', '.');
    	$grado=mb_strtoupper($estudiante->GRADO,'UTF-8');
    	$educacion=grado::where('GRADO','=',$grado)->first();
    	$educaciontype=$educacion->EDUCACION;
    	$curso=$estudiante->CURSO;
        $tidocumento=mb_strtoupper($estudiante->TIPO_DE_DOCUMENTO, 'UTF-8');
    	$cursoinfo=curso::where('CURSO','=',$curso)->first();
    	$id_curso=$cursoinfo->id;
    	$asignaturas=asignatura::where('id_curso','=',$id_curso)->get()->sum('IHS');
    	$jornada=$cursoinfo->JORNADA;
    	$horario=$cursoinfo->HORARIO;
    	$genero=$estudiante->GENERO;
    	$date = date_create($fecha_expedicion);
    	$dia=date_format($date, 'j');
    	$mes=date_format($date, 'n');
    	$ano=date_format($date, 'Y');
    	$fechaletter=$this->fechareturn($dia,$mes,$ano);
    	$this->Cell(165,6,utf8_decode("Certifico que"),0,"","C");
    	$this->Ln();
    	$this->Ln();
		$i1="El";
		$i2="identificado";
		$i3="MATRICULADO";
    	if($genero=="FEMENINO"){
    		$i1="La";
    		$i2="identificada";
    		$i3="MATRICULADA";
    	}
        $this->SetFont('Arial','',11);
    	$this->Multicell(165,6,utf8_decode("$i1 Estudiante $nombre_estudiante $i2 con $tidocumento número $numero_de_documento se encuentra $i3 en este establecimiento educativo cursando sus estudios correspondientes al grado $grado del nivel de $educaciontype cumpliendo un horario $horario de LUNES A VIERNES CALENDARIO A para el año lectivo $ano_cert."),0,"J");
    	$this->Ln();
    	$this->Multicell(165,6,utf8_decode("Esta constancia se expide a solicitud del interesado via web en la ciudad de $ciudad $fechaletter"),0,"J");
    	$this->Ln();
    	$this->Multicell(165,6,utf8_decode("Cordialmente,"),0,"J");
    	$this->Ln();
    	$this->Ln();
    	$this->Ln();
    	$this->Ln();
    	$this->Ln();
    	$this->SetX(23);
    	$posicionvert=$this->GetY()-27;
    	$this->Image("$firma_persona1",18,$posicionvert,55,35);
        $this->Image("$sello1",60,$posicionvert+4,40,40);
    	$this->Image("$firma_persona2",120,$posicionvert,55,35);
        $this->Image("$sello2",155,$posicionvert+4,40,40);
		$this->Cell(100,6,utf8_decode("$per1"),0,"","L");
		$this->Cell(100,6,utf8_decode("$per2"),0,"","L");
		$this->Ln();
		$this->Cell(100,6,utf8_decode("$cargo1"),0,"","L");
		$this->Cell(100,6,utf8_decode("$cargo2"),0,"","L");
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->cell(165,6,utf8_decode("Nro. de Confirmación: $cod_certifi"),0,"","R");
    }

    public function truncateFloat($number, $digitos)
    {
    $raiz = 10;
    $multiplicador = pow ($raiz,$digitos);
    $resultado = ((int)($number * $multiplicador)) / $multiplicador;
    return number_format($resultado, $digitos);
    }



        function academico(){
        global $estudiante_codigo;
        global $cod_certifi;
        global $ano_cert;
        global $fecha_expedicion;

        $institucion=institucion::first();
        $ciudad=$institucion->CIUDAD;
        $per1=$institucion->DIRECTOR_A;
        $cargo1=$institucion->CARGO_D;
        $per2=$institucion->SECRETARIO_A;
        $cargo2=$institucion->CARGO_A;
        $firma_persona1=url('/logo/'.$institucion->FIRMA1);
        $firma_persona2=url('/logo/'.$institucion->FIRMA2);
        $sello1=url('/logo/'.$institucion->SELLO_RECT);
        $sello2=url('/logo/'.$institucion->SELLO_2);
        $this->Ln();
        $this->SetTextColor(0,0,0);
        $this->Ln();
        $this->SetFont('Arial','B',12);
        $this->cell(165,6,utf8_decode("CERTIFICADO FINAL"),0,"","C");
        $this->Ln();
        $this->Ln();
        $this->SetFont('Arial','B',12);
        $estudiante=estudiante::find($estudiante_codigo);
        $nombre_estudiante=mb_strtoupper($estudiante->NOMBRES." ".$estudiante->APELLIDO1." ".$estudiante->APELLIDO2, 'UTF-8');
        $numero_de_documento=number_format($estudiante->NUMERO_DE_DOCUMENTO, 0, '', '.');
        
        $curso=$estudiante->CURSO;
        $tidocumento=mb_strtoupper($estudiante->TIPO_DE_DOCUMENTO, 'UTF-8');
        $cursoinfo=curso::where('CURSO','=',$curso)->first();
        $id_curso=$cursoinfo->id;
        $asignaturas=asignatura::where('id_curso','=',$id_curso)->get()->sum('IHS');
        $jornada=$cursoinfo->JORNADA;
        $horario=$cursoinfo->HORARIO;
        $genero=$estudiante->GENERO;
        $date = date_create($fecha_expedicion);
        $dia=date_format($date, 'j');
        $mes=date_format($date, 'n');
        $ano=date_format($date, 'Y');
        $fechaletter=$this->fechareturn($dia,$mes,$ano);
        $i1="El";
        $i2="identificado";
        $i3="MATRICULADO";
        if($genero=="FEMENINO"){
            $i1="La";
            $i2="identificada";
            $i3="MATRICULADA";
        }

        $estado=estado_final_anual::where('CODIGO','=',$estudiante_codigo)->where('PERIODO','=',$ano_cert)->first();
        $educacion=grado::where('GRADO','=',$estado->GRADO)->first();
        $educaciontype=$educacion->EDUCACION;
        if($estado->ESTADO=="APROBADO"){
            $estado_final="APROBÓ";
        }else{
            $estado_final="NO APROBÓ";
        }
        $this->SetFont('Arial','',9);
        $this->Multicell(165,6,utf8_decode("$i1 Estudiante $nombre_estudiante $i2 con $tidocumento número $numero_de_documento CURSÓ Y $estado_final en el año lectivo $ano_cert su estudios correspondientes al grado $estado->GRADO de $educaciontype en este establecimiento educativo, cuyas valoraciones e intensidad horaria se relaciona a continuación:"),0,"J");
        $this->Ln();
        $areas=historicoAreas::where('PERIODO','=',$ano_cert)->orderBy('AREA', 'ASC')->get();
        $this->SetFillColor(131,140,251);
        $this->SetFont('Arial','',7);
        $this->cell(102,4,utf8_decode("ÁREAS / ASIGNATURAS"),1,"","C",1);
        $this->cell(8,4,utf8_decode("IH-S"),1,"","C",1);
        $this->cell(20,4,utf8_decode("DEFINITIVA"),1,"","C",1);
        $this->cell(35,4,utf8_decode("ESCALA NACIONAL"),1,"","C",1);
        $this->Ln();
        foreach($areas as $area){
            $def_area=0;
            $asignaturasc=historicoAsignatura::where('ID_AREA','=',$area->ID_AREA)->where('ID_CURSO','=',$estado->COD_CURSO)->count();
            if($asignaturasc>0){
                $this->SetFillColor(87,180,252);
                $this->SetFont('Arial','b',7);       
                $this->cell(110,4,utf8_decode("ÁREA:: $area->AREA"),1,"","L",1);
                $this->cell(20,4,utf8_decode(""),1,"","L",1);
                $this->cell(35,4,utf8_decode(""),1,"","L",1);
                $this->Ln();
                $asignaturas=historicoAsignatura::where('ID_AREA','=',$area->ID_AREA)->where('ID_CURSO','=',$estado->COD_CURSO)->get();
                foreach($asignaturas as $asignatura){
                    $calificacion=historialCalificacion::where('CODIGO_ESTUDIANTE',$estudiante_codigo)->where('PERIODO',$ano_cert)->where('ID_ASIGNATURA',$asignatura->ID_ASIGNATURA)->first();
                    $def_area+=$calificacion->DEF;
                }
                $def_area=$def_area/$asignaturasc;
                
            }
        }




        $this->Multicell(165,6,utf8_decode("Esta constancia se expide a solicitud del interesado via web en la ciudad de $ciudad $fechaletter"),0,"J");
        $this->Ln();
        $this->Multicell(165,6,utf8_decode("Cordialmente,"),0,"J");
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->SetX(23);
        $posicionvert=$this->GetY()-27;
        $this->Image("$firma_persona1",18,$posicionvert,55,35);
        $this->Image("$sello1",60,$posicionvert+4,40,40);
        $this->Image("$firma_persona2",120,$posicionvert,55,35);
        $this->Image("$sello2",155,$posicionvert+4,40,40);
        $this->Cell(100,6,utf8_decode("$per1"),0,"","L");
        $this->Cell(100,6,utf8_decode("$per2"),0,"","L");
        $this->Ln();
        $this->Cell(100,6,utf8_decode("$cargo1"),0,"","L");
        $this->Cell(100,6,utf8_decode("$cargo2"),0,"","L");
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->cell(165,6,utf8_decode("Nro. de Confirmación: $cod_certifi"),0,"","R");
    }
}

class certificates extends PDF
{
	

	public function exportpdf($cert,$cod_certificate) {
   	$institucion=institucion::first();
   	$ano_act=$institucion->ANO_ACTIVO;
   	$certificadodates=gen_cert::where('REFERENCIA','=',$cod_certificate)->first();
   	global $estudiante_codigo,$ano_cert,$fecha_expedicion;
   	global $cod_certifi;
   	$estudiante_codigo=$certificadodates->CODIGO_ES;
   	$ano_cert=$certificadodates->ANO;
   	$fecha_expedicion=$certificadodates->FECHA_EXPEDICION;
   	$cod_certifi=$certificadodates->REFERENCIA;
 	$pdf=new PDF('P','mm','Letter');
    $pdf::SetLeftMargin(25);
 	$pdf::AddPage('P','Letter');
 	$pdf::SetAutoPageBreak(true,2); 
 	$pdf::SetFont('Arial','B',9);
 	$pdf::SetTextColor(0,0,0);
 	$pdf::Ln();
 	$pdf::Ln();
 	$pdf::SetFillColor(0,142,213);
 	$pdf::SetTextColor(255,255,255);
    $url_logo=url('/logo/'.$institucion->LOGO);

 	if($cert==1){
 		$pdf::estudios();
 	}

    if($cert==2){
        $pdf::academico();
    }
 	
 	$pdf::Output();
	}

 	

}