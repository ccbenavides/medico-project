<?php
error_reporting(0);
require 'view/fpdf17/fpdf.php';
$meses = array('01' => 'ENERO','02' => 'FEBRERO','03' => 'MARZO','04' => 'ABRIL','05' => 'MAYO','06' => 'JUNIO'
                ,'07' => 'JULIO','08' => 'AGOSTO','09' => 'SEPTIEMBRE','10' => 'OCTUBRE','11' => 'NOVIEMBRE','12' => 'DICIEMBRE');

class PDF extends FPDF{

	protected $anio;
	protected $mes;

	public function setAnio($anio){
	    $this->anio = $anio;
	}

	public function getAnio(){
	    return $this ->anio;
	}

	public function setMes($mes){
	    $this->mes = $mes;
	}

	public function getMes(){
	    return $this ->mes;
	}

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
	    $this->Cell(0,5,"EXAMENES Y PROCEDIMIENTOS REALIZADOS EN ".$this->getMes() . " - ". $this->getAnio(),0,0,'C');
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
$pdf->setMes($meses[$mes]);
$pdf->setAnio($año);
$pdf->AddPage();
$pdf->SetFont('Arial','B',8);
$pdf->SetX(55);

$pdf->Cell(75,5,utf8_decode(""),1,0,'C');
$pdf->Cell(20,5,utf8_decode("TOTAL"),1,0,'C');
$pdf->Ln(5);
for ($i=0; $i <count($cantidades) ; $i++) { 
	$pdf->SetX(55);
	
	if ($i==0 or $i==1 or $i==4 or $i==10 or $i==11 or $i==12) {
		$pdf->SetFillColor(201,201,201);
		$pdf->SetFont('Arial','B',8);
	} else {
		$pdf->SetFillColor(255,255,255);
		$pdf->SetFont('Arial','',8);
	}
	
	$pdf->Cell(75,5,$cantidades[$i]->examen,1,0,'L','true');
	$pdf->Cell(20,5,$cantidades[$i]->total,1,0,'C','true');
	$pdf->Ln(5);
}
$pdf->Ln(5);
$pdf->SetFont('Arial','B',8);
$pdf->SetX(55);
$pdf->Cell(75,5,utf8_decode("PROCEDENCIA"),1,0,'C');
$pdf->Cell(20,5,utf8_decode("TOTAL"),1,0,'C');
$pdf->Ln(5);
for ($i=0; $i <count($procedencias) ; $i++) { 
	$pdf->SetX(55);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(75,5,$procedencias[$i]->examen,1,0,'L');
	$pdf->Cell(20,5,$procedencias[$i]->total,1,0,'C');
	$pdf->Ln(5);
}
$pdf->Output();



?>