<?php

require 'view/fpdf17/fpdf.php';

class PDF extends FPDF{
	
	protected $id;
	
	public function getBiopsia(){
    	return $this ->id;
	}

	public function setBiopsia($id){
    	$this->id = $id;
	}

	function Footer(){
		$this->SetFont('Arial','',7.5);
		$this->SetXY(180,280);
		$this->Cell(10,5,'',0,0,'C');
		$this->Cell(10,5,utf8_decode("Pag ".$this->PageNo()),0,0,'C');    
	}
		
	function Header()
	  {
	    $this->SetFont('Arial', 'B', 15);
	    $this->Image("view/img/log.png", null, 5, 22, 17);
	    $this->Image("view/img/logr.jpg", 180, 2, 20, 20);
	    $this->Cell(190,2, "HOSPITAL REGIONAL LAMBAYEQUE", 0, 0, 'C');
	    $this->Ln(7);
	    $this->SetFont('Arial', 'B', 11.5);
	    $this->Cell(190,1, "SERVICIO DE ANATOMIA PATOLOGICA", 0, 0, 'C');
	    $this->Line(10,25,200,25);
	    $this->SetXY(177,28);
	    $this->Cell(25,5,$this->getBiopsia(),1,0,'J');
	    $this->Ln(5);
	    $this->Cell(190, 2, "EXAMEN ANATOMOPATOLOGICO", 0, 0, 'C');
	    $this->Ln(5);   
	  }

}

$pdf = new PDF();
$pdf->setBiopsia($num_biopsia);
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->SetXY(15,38);
$pdf->Cell(0,5,utf8_decode("  Información del Paciente"),0,0,'L');
$pdf->Ln();
if ($biopsiasPQ) {
	foreach ($biopsiasPQ as $key) {
		$pdf->SetFont('Arial', '',9);
		$pdf->Cell(40, 10, "DNI : ", 0, 0, 'R');
		$pdf->SetFont('Arial','',8.5);
		$pdf->Cell(25,10,$key->dni,0,0,'L');
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(-25, 22, "Apellidos y Nombres : ", 0, 0, 'R');
		$pdf->SetFont('Arial','',8.5);
		$pdf->Cell(45,22,utf8_decode($key->paciente),0,0,'L');
		$pdf->SetFont('Arial', '',9);
		$pdf->Cell(50,22,"Edad : ",0,0,'R');
		$pdf->SetFont('Arial', '',8.5);
		$pdf->Cell(70,22,utf8_decode($key->edad),0,0,'L');
		$pdf->SetFont('Arial', '',9);
		$pdf->Cell(-165,34,"Procedencia : ",0,0,'R');
		$pdf->SetFont('Arial', '',8.5);
		$pdf->Cell(20,34,utf8_decode($key->procedencia),0,0,'L');
		$pdf->SetFont('Arial', '',9);
		$pdf->Cell(75,34, "Sexo : ", 0, 0, 'R');
		$pdf->SetFont('Arial', '',8.5);
		$pdf->Cell(0,34,$key->sexo,0,0,'L');
		$pdf->SetFont('Arial', '',9);
		$pdf->Cell(-150,46, "Servicio : ", 0, 0, 'R');
		$pdf->SetFont('Arial', '',8.5);
		$pdf->Cell(0,46,utf8_decode($key->servicio),0,0,'L');
		$pdf->SetFont('Arial', '',9);
		$pdf->Cell(-150,58,"Medico Tratante : ",0,0,'R');
		$pdf->SetFont('Arial', '',8.5);
		$med = $key->medico_tratante;
		if ($med =='OTRO') {
			$pdf->Cell(0,58,utf8_decode($key->medico_opcional),0,0,'L');
		} else {
			$pdf->Cell(0,58,utf8_decode($key->medico_tratante),0,0,'L');
		}
		// $pdf->SetFont('Arial', '',9);
		// $pdf->Cell(-150,70,"Fecha de Biopsia : ",0,0,'R');
		// $pdf->SetFont('Arial', '',8.5);
		// $pdf->Cell(0,70,$key->fecha_biopsia,0,0,'L');
		// $pdf->SetFont('Arial', '',9);
		// $pdf->Cell(-55,70,"Fecha de Informe : ",0,0,'R');
		// $pdf->SetFont('Arial', '',8.5);
		// $pdf->Cell(0,70,$key->fecha_informe,0,0,'L');
		$pdf->Ln(5);
	}
}
//$pdf->Line(10,85,200,85);
//$pdf->SetFont('Arial','B',10);
//$pdf->SetXY(15,88);
//$pdf->Cell(0,5,utf8_decode("II. Información Anatomopatologica"),0,0,'L');
//$pdf->Ln(7);
$pdf->SetFont('Arial', '',9);
$pdf->SetXY(19,76);
$pdf->Cell(30,5,"Muestras Remitidas : ",0,0,'C');
if ($cantidad>0) {
	$pdf->Ln(0);
	for ($i=0; $i <$cantidad ; $i++) { 	
	$pdf->SetFont('Arial', '',8.5);
	$pdf->Cell(45,5,($i+1).". ",0,0,'R');
	$pdf->Cell(95,5,utf8_decode($muestrasPQ[$i]->muestra_remitida),0,1,'L');
	}
	$pdf->Ln(1);
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(48,5,"Diagnostico Clinico : ",0,0,'C');
	$pdf->Ln(0);
	if ($biopsiasPQ) {
		foreach ($biopsiasPQ as $key) {
			$pdf->SetFont('Arial','',8.5);
			$pdf->Cell(40,5,'',0,0,'C');
			$pdf->MultiCell(150,5,utf8_decode($key->diagnostico),0,'J');
		}
	}$pdf->Ln(1);
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(57,5,utf8_decode("Observación : "),0,0,'C');
	$pdf->Ln(0);
	if ($biopsiasPQ) {
		foreach ($biopsiasPQ as $key) {
			$pdf->SetFont('Arial','',8.5);
			$pdf->Cell(40,5,'',0,0,'C');
			$nombre=$key->observacion;
			$pdf->MultiCell(150,5,utf8_decode($nombre),0,'J');
		
		}
	}$pdf->Ln(1);
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(50,5,utf8_decode("Fecha de Biopsia : "),0,0,'C');
	$pdf->Cell(140,5,utf8_decode("Fecha de Informe : "),0,0,'C');
	$pdf->Ln(0);
	if ($biopsiasPQ) {
		foreach ($biopsiasPQ as $key) {
			$pdf->SetFont('Arial','',8.5);
			$pdf->Cell(95,5,$key->fecha_biopsia,0,0,'C');
			$pdf->Cell(95,5,$key->fecha_informe,0,0,'C');
		}
	}

	$pdf->Ln(3);
	$pdf->Cell(20,5,"__________________________________________________________________________________________________________________",0,0,'L');
	$pdf->Ln(6);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(48,5,chr(149)."  DIAGNOSTICO : ",0,0,'C');
	$pdf->Ln(7);
	for ($i=0; $i <count($muestrasPQ) ; $i++) { 	
		$pdf->SetFont('Arial', '',9);
		// $pdf->Cell(15,5,($i+1).". ",0,0,'R');
		// $pdf->Cell(80,5,utf8_decode($muestrasPQ[$i]->muestra_remitida),0,0,'L');
		// $pdf->Ln(5);
		// $pdf->Cell(15,5,'',0,0,'C');

		if (count($muestrasPQ)<2) {
			$pdf->Cell(15,5,("")." ",0,0,'R');
		} else {
			$pdf->Cell(15,5,($i+1).". ",0,0,'R');
		}
		
		$pdf->Cell(1,5,'',0,0,'C');
		$pdf->MultiCell(170,5,utf8_decode($muestrasPQ[$i]->diag_final),0,'J');
		$pdf->Ln(3);
	}$pdf->Ln(-2);
	$pdf->SetFont('Arial','B',7);
	$pdf->Cell(40,5,chr(149)."  MACROSCOPIA : ",0,0,'C');
	$pdf->Ln(5);
	if ($macroPQ) {
		foreach ($macroPQ as $macro) {
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(10,5,'',0,0,'C');
			$pdf->MultiCell(180,5,utf8_decode($macro->macroscopia),0,'J');
		}
	}
	$pdf->Ln(15);
	$pdf->Cell(90,5,'',0,0,'C');
	$pdf->Cell(90,5,"------------------------------------------------------------------------------------------------",0,0,'C');
	$pdf->Ln(5);
	if ($biopsiasPQ) {
		foreach ($biopsiasPQ as $key) {
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(90,5,'',0,0,'C');
			$pat=$key->patologo;
			$pdf->Cell(90,5," ".utf8_decode($pat),0,0,'C');
			
			$pdf->Ln(5);
			$pdf->Cell(90,5,'',0,0,'C');

			if ($key->emp_colegiatura=="37989") {
				$pdf->Cell(90,5,utf8_decode("Médico Hematólogo Clínico"),0,0,'C');
			} else {
				$pdf->Cell(90,5,utf8_decode("Médico Anátomo Patólogo"),0,0,'C');
			}
			
			// $pdf->Cell(90,5,utf8_decode("Médico Anátomo Patólogo"),0,0,'C');
			
			/*
			$pdf->Ln(5);
			$pdf->Cell(90,5,'',1,0,'C');
			$pdf->Cell(46,5,"C.M.P."." ".$key->emp_colegiatura,1,0,'R');
			$pdf->Cell(44,5,"R.N.E"." ".$key->emp_rne,1,0,'L');
			*/

			$pdf->Ln(5);
			$pdf->Cell(90,5,'',0,0,'C');
			$pdf->Cell(90,5,"C.M.P."." ".$key->emp_colegiatura.chr(32).chr(32).chr(32)."R.N.E"." ".$key->emp_rne,0,0,'C');
	
		}
	}
}

$pdf->Output();

?>