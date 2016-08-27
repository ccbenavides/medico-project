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
	$pdf->Cell(0,5,"INDICE DE PRECISION DE EFECTIVIDAD DEL ESTUDIO DE LAS BIOPSIAS  DEL ".$fecha1_dia."-".$fecha1_mes."-".$fecha1_anio." AL ".$fecha2_dia."-".$fecha2_mes."-".$fecha2_anio,0,0,'C');
} else {
	$pdf->SetXY(10,30);
	$pdf->SetFont('Arial','B',10.5);
	$pdf->Cell(0,5,"INDICE DE PRECISION DE EFECTIVIDAD DEL ESTUDIO DE LAS BIOPSIAS DEL ".$fecha1_dia."-".$fecha1_mes."-".$fecha1_anio,0,0,'C');
}
$pdf->Ln(10);
$pdf->SetX(30);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(60,5,utf8_decode("AREA"),1,0,'C');
$pdf->Cell(20,5,utf8_decode("C.B.F."),1,0,'C');
$pdf->Cell(20,5,utf8_decode("C.B.A.M."),1,0,'C');
$pdf->Cell(40,5,utf8_decode("INDICE DE PRECISION (%)"),1,0,'C');
$pdf->Ln(5);
$total1=0;
$total2=0;
for ($i=0; $i <count($indicesp) ; $i++) { 
	$pdf->SetX(30);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(60,5,$indicesp[$i]->area,1,0,'C');
	$pdf->Cell(20,5,$indicesp[$i]->cantidad_finalizadas,1,0,'C');
	$pdf->Cell(20,5,$indicesp[$i]->cantidad_autorizadas,1,0,'C');
	$pdf->Cell(40,5,round(($indicesp[$i]->diferencia/$indicesp[$i]->cantidad_finalizadas)*100),1,0,'C');
	$pdf->Ln(5);
	$total1=$total1+$indicesp[$i]->cantidad_finalizadas;
	$total2=$total2+$indicesp[$i]->cantidad_autorizadas;

}
$pdf->SetX(30);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(60,5,utf8_decode("TOTAL"),1,0,'C');
$pdf->Cell(20,5,$total1,1,0,'C');
$pdf->Cell(20,5,$total2,1,0,'C');
$pdf->Cell(40,5,round((($total1-$total2)/$total1)*100),1,0,'C');
$pdf->Ln(10);
$pdf->SetX(10);
$pdf->SetFont('Arial','',6);
$pdf->Cell(15,5,"ABREV.",1,0,'C');
$pdf->Cell(70,5,"DESCRIPCION",1,0,'C');
$pdf->Ln(5);
$pdf->SetX(10);
$pdf->Cell(15,5,"C.B.F",1,0,'C');
$pdf->Cell(70,5,"CANTIDAD DE BIOPSIAS FINALIZADAS",1,0,'L');
$pdf->Ln(5);
$pdf->SetX(10);
$pdf->Cell(15,5,"C.B.A.M",1,0,'C');
$pdf->Cell(70,5,"CANTIDAD DE BIOPSIAS AUTORIZADAS PARA MODIFICACION",1,0,'L');
$pdf->Output();








?>