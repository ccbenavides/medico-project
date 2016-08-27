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
$pdf->SetXY(10,30);
$pdf->SetFont('Arial','B',10.5);
$pdf->Cell(0,5,"HISTORIAL DE PERFILES",0,0,'C');
$pdf->SetXY(10,40);
$pdf->SetFont('Arial','B',9.5);
$pdf->Cell(0,5,"EMPLEADO: ",0,0,'L');
$pdf->SetXY(33,40);
$pdf->SetFont('Arial','',9.5);
$pdf->Cell(0,5,utf8_decode($nombremp),0,0,'L');
$pdf->SetXY(50,48);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(50,5,utf8_decode("FECHA CAMBIO"),1,0,'C');
$pdf->SetXY(100,48);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(60,5,utf8_decode("PERFIL"),1,0,'C');
$pdf->Ln();
for ($i=0; $i <count($histperfiles) ; $i++) { 
	$pdf->SetFont('Arial', '', 8);
	$pdf->SetX(50);
	$pdf->Cell(50, 5, $histperfiles[$i]->fecha_historial, 1, 0, 'C');
	$pdf->Cell(60, 5, $histperfiles[$i]->descr_perfil, 1, 0, 'C');
	$pdf->Ln(5);
}
$pdf->Output();


?>