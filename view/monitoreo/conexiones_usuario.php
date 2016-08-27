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
	$pdf->Cell(0,5,"INFORME DE CONEXIONES DEL ".$fecha1_dia."-".$fecha1_mes."-".$fecha1_anio." AL ".$fecha2_dia."-".$fecha2_mes."-".$fecha2_anio,0,0,'C');
} else {
	$pdf->SetXY(10,30);
	$pdf->SetFont('Arial','B',10.5);
	$pdf->Cell(0,5,"INFORMES DE CONEXIONES DEL ".$fecha1_dia."-".$fecha1_mes."-".$fecha1_anio,0,0,'C');
}
$pdf->SetXY(15,40);
$pdf->SetFont('Arial','B',9.5);
$pdf->Cell(0,5,"EMPLEADO: ",0,0,'L');
$pdf->SetXY(37,40);
$pdf->SetFont('Arial','',9.5);
$pdf->Cell(0,5,utf8_decode($nombemp),0,0,'L');
$pdf->Ln(10);
$pdf->SetX(10);
$pdf->Cell(15, 15, "", 0, 0, 'C');
$pdf->Cell(80, 5, utf8_decode("INGRESO AL SISTEMA"), 1, 0, 'C');
$pdf->Cell(80, 5, utf8_decode("SALIDA DEL SISTEMA"), 1, 0, 'C');
$pdf->Ln(5);
$pdf->Cell(15, 5, "", 0);
$pdf->Cell(40, 5, "FECHA", 1, 0, 'C');
$pdf->Cell(40, 5, "HORA", 1, 0, 'C');
$pdf->Cell(40, 5, "FECHA", 1, 0, 'C');
$pdf->Cell(40, 5, "HORA", 1, 0, 'C');
$pdf->Ln();
for ($i=0; $i <count($totalconex) ; $i++) { 
	$pdf->SetFont('Arial', '', 7);
	$pdf->Cell(15, 15, "", 0, 0, 'C');
	$pdf->Cell(40, 5, $totalconex[$i]->fecha_conexion, 1, 0, 'C');
	$pdf->Cell(40, 5, $totalconex[$i]->hora_conexion, 1, 0, 'C');
	$pdf->Cell(40, 5, $totalconex[$i]->fecha_desconexion, 1, 0, 'C');
	$pdf->Cell(40, 5, $totalconex[$i]->hora_desconexion, 1, 0, 'C');
	$pdf->Ln(5);
}


$pdf->Output();




?>