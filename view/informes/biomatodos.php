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
	    $this->Ln(10);
	    
	}

	function Footer(){
		$this->SetFont('Arial','',7.5);
		$this->SetXY(170,290);
		$this->Cell(10,5,'',0,0,'C');
		$this->Cell(10,5,date("d-m-Y H:i")."        "."Pag ".$this->PageNo(),0,0,'C'); 
	}
}
$pdf = new PDF();
$pdf->AddPage();
if ($fecha1!=$fecha2) {
	$pdf->SetXY(10,30);
	$pdf->SetFont('Arial','B',10.5);
	$pdf->Cell(0,5,"REPORTE DE MATERIALES DEL ".$fecha1_dia."-".$fecha1_mes."-".$fecha1_anio." AL ".$fecha2_dia."-".$fecha2_mes."-".$fecha2_anio,0,0,'C');
} else {
	$pdf->SetXY(10,30);
	$pdf->SetFont('Arial','B',10.5);
	$pdf->Cell(0,5,"REPORTE DE MATERIALES DEL ".$fecha1_dia."-".$fecha1_mes."-".$fecha1_anio,0,0,'C');
}
$pdf->Ln(10);
$pdf->SetFont('Arial','B',8.5);
$pdf->SetX(40);
$pdf->Cell(40,5,utf8_decode("AREA"),1,0,'C');
$pdf->Cell(40,5,utf8_decode("N° DE LAMINAS"),1,0,'C');
$pdf->Cell(40,5,utf8_decode("N° DE TACOS"),1,0,'C');
$pdf->Ln(5);
$laminas=0;
$tacos=0;
for ($i=0; $i <count($totaltodos) ; $i++) { 
	$pdf->SetX(40);
	$pdf->SetFont('Arial','',8.5);
	$pdf->Cell(40,5,$totaltodos[$i]->descr_area,1,0,'C');
	$pdf->Cell(40,5,$totaltodos[$i]->laminas,1,0,'C');
	$pdf->Cell(40,5,$totaltodos[$i]->tacos,1,0,'C');
	$pdf->Ln(5);
	$laminas=$laminas+$totaltodos[$i]->laminas;
	$tacos=$tacos+$totaltodos[$i]->tacos;
}
$pdf->SetFont('Arial','B',9);
$pdf->SetX(40);
$pdf->Cell(40,5,"TOTAL",1,0,'C');
$pdf->Cell(40,5,$laminas,1,0,'C');
$pdf->Cell(40,5,$tacos,1,0,'C');
$pdf->Output();

?>