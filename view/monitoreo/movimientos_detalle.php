<?php
error_reporting(0);
require 'view/fpdf17/fpdf.php';
class PDF extends FPDF{
	
	function Header()
	{
		$this->SetFont('Arial', 'B', 13);
	    $this->Image("view/img/log.png", null, 5, 22, 17);
	    $this->Image("view/img/logr.jpg", 270, 5, 20, 20);
	    $this->SetXY(85,10);
	    $this->Cell(130,2, "HOSPITAL REGIONAL LAMBAYEQUE", 0, 0, 'C');
	    $this->SetXY(85,18);
	    $this->Cell(130,1, "SERVICIO DE ANATOMIA PATOLOGICA", 0, 0, 'C');
	    $this->Line(10,25,290,25);
	    $this->Ln(10);
	 }


	 function Footer(){
		$this->SetFont('Arial','',7.5);
		$this->SetXY(260,203);
		$this->Cell(10,5,'',0,0,'C');
		$this->Cell(10,5,date("d-m-Y H:i")."        "."Pag ".$this->PageNo(),0,0,'C'); 
	}
}
$pdf = new PDF('L');
$pdf->AddPage();
$pdf->SetXY(10,30);
$pdf->SetFont('Arial','B',10.5);
if ($fecha1!=$fecha2) {
	$pdf->SetXY(10,30);
	$pdf->SetFont('Arial','B',10.5);
	$pdf->Cell(0,5,"INFORME DETALLADO DE MOVIMIENTOS DEL ".$fecha1_dia."-".$fecha1_mes."-".$fecha1_anio." AL ".$fecha2_dia."-".$fecha2_mes."-".$fecha2_anio,0,0,'C');
} else {
	$pdf->SetXY(10,30);
	$pdf->SetFont('Arial','B',10.5);
	$pdf->Cell(0,5,"INFORME DETALLADO DE MOVIMIENTOS DEL ".$fecha1_dia."-".$fecha1_mes."-".$fecha1_anio,0,0,'C');
}
$pdf->Ln(10);
$pdf->SetX(10);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(75,5,utf8_decode("EMPLEADO"),1,0,'C');
$pdf->Cell(25,5,utf8_decode("FECHA"),1,0,'C');
$pdf->Cell(30,5,utf8_decode("TABLA"),1,0,'C');
$pdf->Cell(25,5,utf8_decode("ACCION"),1,0,'C');
$pdf->Cell(75,5,utf8_decode("CAMPO"),1,0,'C');
$pdf->Cell(25,5,utf8_decode("HOST"),1,0,'C');
$pdf->Cell(25,5,utf8_decode("HOSTNAME"),1,0,'C');
$pdf->Ln(3);

for ($i=0; $i <count($movtotal) ; $i++) { 
	$pdf->SetFont('Arial','',6); 
	if (($movtotal[$i-1]->usuario)==($movtotal[$i]->usuario)) {
		$pdf->Cell(75,5,'',0);
	} else {
		$pdf->SetFont('Arial','',7); 
        $pdf->Ln(5);
        $pdf->SetX(5);
        $pdf->Cell(75,5,utf8_decode($movtotal[$i]->usuario) ,0,0,'L');
	}
	   $pdf->Ln(3);
       $pdf->SetFont('Arial','',7);
       $pdf->Cell(75,5,'',0);
       $pdf->Cell(25,5,utf8_decode($movtotal[$i]->fecha) ,0,0,'R');
       $pdf->Cell(30,5,utf8_decode($movtotal[$i]->tabla) ,0,0,'C');
       $pdf->Cell(25,5,utf8_decode($movtotal[$i]->accion) ,0,0,'L');
       $pdf->Cell(75,5,utf8_decode($movtotal[$i]->campo) ,0,0,'L');
       $pdf->Cell(25,5,utf8_decode($movtotal[$i]->host) ,0,0,'L');
       $pdf->Cell(25,5,utf8_decode($movtotal[$i]->hostname) ,0,0,'L');
       $pdf->Ln(2);
	
}


$pdf->Output();

?>