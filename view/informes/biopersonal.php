<?php
error_reporting(0);
require 'view/fpdf17/fpdf.php';

class PDF extends FPDF{

	
	function Header()
	{
		$this->SetFont('Arial', 'B', 13);
	    $this->Image("view/img/log.png", null, 5, 22, 17);
	    $this->Image("view/img/logr.jpg", 180, 5, 20, 20);
	    $this->SetXY(40,10);
	    $this->Cell(130,2, "HOSPITAL REGIONAL LAMBAYEQUE", 0, 0, 'C');
	    $this->SetXY(40,18);
	    $this->Cell(130,1, "SERVICIO DE ANATOMIA PATOLOGICA", 0, 0, 'C');
	    $this->Line(10,25,200,25);
	    $this->Ln(5);
	    $this->SetXY(10,30);
	    $this->SetFont('Arial', 'B', 12);
	    $this->Cell(0,5,"REPORTE DE PRODUCTIVIDAD ",0,0,'C');
	    $this->Ln(5);
	}

	function Footer(){
		$this->SetFont('Arial','',7.5);
		$this->SetXY(170,290);
		$this->Cell(10,5,'',0,0,'C');
		$this->Cell(10,5,date("d-m-Y H:i")."        "."Pag ".$this->PageNo(),0,0,'C'); 
	}


}   
function nombremes($mes,$año){
	 setlocale(LC_TIME, 'spanish');  
	 $nombre=strftime("%B",mktime(0, 0, 0, $mes, 1, $año)); 
	 return $nombre;
	}              
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetXY(10,40);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,5,"EMPLEADO: ",0,0,'L');
$pdf->SetXY(32,40);
$pdf->SetFont('Arial','',9);
$pdf->Cell(0,5,utf8_decode(strtoupper($nomper)),0,0,'L');
$pdf->SetXY(135,40);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,5,"MES: ",0,0,'L');
$pdf->SetXY(145,40);
$pdf->SetFont('Arial','',9);
$pdf->Cell(0,5, strtoupper(nombremes($mes,$año))." - ".$año, 0, 0, 'L');
$pdf->Ln(10);
$pdf->SetX(10);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(45,15,"AREA",1,0,'C');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(35,15,"BIOPSIAS ASIGNADAS",1,0,'C');
$pdf->Cell(45,5,"BIOPSIAS FINALIZADAS",1,0,'C');
$pdf->Cell(35,15,"BIOPSIAS PENDIENTES",1,0,'C');
$pdf->Cell(30,15,"% PRODUCTIVIDAD",1,0,'C');
$pdf->Ln(5);
$pdf->Cell(45,5,"",0);
$pdf->Cell(35,5,"",0);
$pdf->Cell(15,5,"B.FTE",1,0,'C');
$pdf->Cell(15,5,"B.FFTE",1,0,'C');
$pdf->Cell(15,5,"TOTAL",1,0,'C');
$pdf->Cell(30,5,"",0);
$pdf->Ln(5);
for ($i=0; $i <count($produccion) ; $i++) { 
	$pdf->SetFont('Arial','',8.5);
	$pdf->Cell(45,5,$produccion[$i]->area,1,0,'C');
	$pdf->Cell(35,5,$produccion[$i]->total_area,1,0,'C');
	$pdf->Cell(15,5,$produccion[$i]->total_atiempo,1,0,'C');
	$pdf->Cell(15,5,$produccion[$i]->total_destiempo,1,0,'C');
	$pdf->Cell(15,5,$produccion[$i]->total_finalizado,1,0,'C');
	$pdf->Cell(35,5,$produccion[$i]->total_pendiente,1,0,'C');
	$pdf->Cell(30,5,round(($produccion[$i]->total_finalizado/$produccion[$i]->total_area)*100),1,0,'C');
	$pdf->Ln(5);
}
$pdf->Ln(10);
$pdf->SetX(10);
$pdf->SetFont('Arial','',6);
$pdf->Cell(15,5,"ABREV.",1,0,'C');
$pdf->Cell(90,5,"DESCRIPCION",1,0,'C');
$pdf->Ln(5);
$pdf->SetX(10);
$pdf->Cell(15,5,"B.FTE",1,0,'C');
$pdf->Cell(90,5,"BIOPSIAS FINALIZADAS EN EL TIEMPO ESTABLECIDO",1,0,'L');
$pdf->Ln(5);
$pdf->SetX(10);
$pdf->Cell(15,5,"B.FFTE",1,0,'C');
$pdf->Cell(90,5,"BIOPSIAS FINALIZADAS FUERA DEL TIEMPO ESTABLECIDO",1,0,'L');
$pdf->Output();


?>