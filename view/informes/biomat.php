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
$pdf->SetXY(15,39);
$pdf->SetFont('Arial','B',9.5);
$pdf->Cell(0,5,"AREA: ",0,0,'L');
$pdf->SetXY(27,39);
$pdf->SetFont('Arial','',9);
$pdf->Cell(0,5,$nombres,0,0,'L');
// $pdf->SetXY(95,39);
// $pdf->SetFont('Arial','B',9.5);
// $pdf->Cell(0,5,"DESDE: ",0,0,'L');
// $pdf->SetXY(110,39);
// $pdf->SetFont('Arial','',9);
// $pdf->Cell(0,5,$fecha1,0,0,'L');
// $pdf->SetXY(155,39);
// $pdf->SetFont('Arial','B',9.5);
// $pdf->Cell(0,5,"HASTA: ",0,0,'L');
// $pdf->SetXY(170,39);
// $pdf->SetFont('Arial','',9);
// $pdf->Cell(0,5,$fecha2,0,0,'L');
$pdf->Ln(8);
$pdf->SetFont('Arial','B',8.5);
$pdf->Cell(36,5,utf8_decode("FECHA DE INGRESO"),1,0,'C');
$pdf->Cell(34,5,utf8_decode("N° BIOPSIA"),1,0,'C');
$pdf->Cell(40,5,utf8_decode("N° DE LAMINAS"),1,0,'C');
$pdf->Cell(40,5,utf8_decode("N° DE TACOS"),1,0,'C');
$pdf->Cell(40,5,"ESTADO DE BIOPSIA",1,0,'C');
$pdf->Ln(5);
$laminas=0;
$tacos=0;
for ($i=0; $i <count($totalm) ; $i++) { 
	$pdf->SetFont('Arial','',8.5);
	$pdf->Cell(36,5,$totalm[$i]->fecha_ingreso,1,0,'C');
	$pdf->Cell(34,5,$totalm[$i]->num_biopsia,1,0,'C');
	$pdf->Cell(40,5,$totalm[$i]->num_laminas,1,0,'C');
	$pdf->Cell(40,5,$totalm[$i]->num_tacos,1,0,'C');
	$pdf->Cell(40,5,$totalm[$i]->estado_biopsia,1,0,'C');
	$pdf->Ln(5);
	$laminas=$laminas+$totalm[$i]->num_laminas;
	$tacos=$tacos+$totalm[$i]->num_tacos;
}
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(190,5,"TOTAL DE LAMINAS = ".$laminas,0,0,'R');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(190,5,"TOTAL DE TACOS = ".$tacos,0,0,'R');
$pdf->Output();
?>