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
if ($fecha1!=$fecha2) {
	$pdf->SetXY(10,30);
	$pdf->SetFont('Arial','B',10.5);
	$pdf->Cell(0,5,"INFORME DE LOS PACIENTES CON PRENEOPLASICA DEL ".$fecha1_dia."-".$fecha1_mes."-".$fecha1_anio." AL ".$fecha2_dia."-".$fecha2_mes."-".$fecha2_anio,0,0,'C');
} else {
	$pdf->SetXY(10,30);
	$pdf->SetFont('Arial','B',10.5);
	$pdf->Cell(0,5,"INFORME DE LOS PACIENTES CON PRENEOPLASICA DEL ".$fecha1_dia."-".$fecha1_mes."-".$fecha1_anio,0,0,'C');
}
$pdf->Ln(10);
$pdf->SetX(10);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(40,5,utf8_decode("UBICACION"),1,0,'C');
$pdf->Cell(20,5,utf8_decode("N° BIOPSIA"),1,0,'C');
$pdf->Cell(20,5,utf8_decode("DNI"),1,0,'C');
$pdf->Cell(80,5,utf8_decode("PACIENTE"),1,0,'C');
$pdf->Cell(30,5,utf8_decode("FECHA DE INGRESO"),1,0,'C');
$pdf->Ln(3);
for ($i=0; $i <count($infoneopla) ; $i++) { 
	$pdf->SetFont('Arial','',7);
	if (($infoneopla[$i-1]->descr_ubicacion)==($infoneopla[$i]->descr_ubicacion)) {
	 	$pdf->Cell(40,5,'',0);
	 } else {
	 	$pdf->SetFont('Arial','B',8); 
        $pdf->Ln(5);
        $pdf->SetX(10);
        $pdf->Cell(40,5,utf8_decode($infoneopla[$i]->descr_ubicacion) ,0,0,'L');
	 }
	   $pdf->Ln(3);
       $pdf->SetFont('Arial','',8);
       $pdf->Cell(40,5,'',0);
       $pdf->Cell(20,5,utf8_decode($infoneopla[$i]->num_biopsia) ,0,0,'L');
       $pdf->Cell(20,5,utf8_decode($infoneopla[$i]->dni) ,0,0,'L');
       $pdf->Cell(80,5,utf8_decode($infoneopla[$i]->paciente) ,0,0,'L');
       $pdf->Cell(30,5,utf8_decode($infoneopla[$i]->fecha_ingreso) ,0,0,'L');
       $pdf->Ln(2); 
}
$pdf->Output();




?>