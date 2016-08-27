<?php
require 'view/fpdf17/fpdf.php';
error_reporting(0);
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
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,"OPCIONES DE ACCESO AL SISTEMA",0,0,'C');
$pdf->SetXY(10,40);
$pdf->SetFont('Arial','',10.5);
$pdf->MultiCell(0,5,"EL USUARIO QUE TIENE EL PERFIL DE  ".$nomper."  DENTRO DEL SISTEMA DE GESTION DE BIOPSIAS TIENE ACCESO A LAS SIGUIENTES OPCIONES:",0,'L');
$pdf->Ln(5);
$pdf->SetX(40);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(65,5,utf8_decode("MENU"),1,0,'C');
$pdf->Cell(65,5,utf8_decode("SUB MENU"),1,0,'C');
$pdf->Ln(3);
for ($i=0; $i <count($menuser) ; $i++) { 
	$pdf->SetFont('Arial','',7);
	if (($menuser[$i-1]->menu_descr)==($menuser[$i]->menu_descr)) {
	 	$pdf->Cell(65,5,'',0);
	 } else {
	 	$pdf->SetFont('Arial','',10); 
        $pdf->Ln(5);
        $pdf->SetX(40);
        $pdf->Cell(65,5,utf8_decode($menuser[$i]->menu_descr) ,0,0,'C');
	 }
	   $pdf->Ln(3);
	   $pdf->SetFont('Arial','',10);
	   $pdf->SetX(40);
       $pdf->Cell(65,5,'',0);
       $pdf->Cell(65,5,utf8_decode($menuser[$i]->descripcion) ,0,0,'L');
       $pdf->Ln(2);  

}
$pdf->Output();



?>