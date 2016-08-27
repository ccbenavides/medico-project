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
	    $this->Cell(0,5,$this->getBiopsia(),1,0,'J');
	    $this->Ln(5);
	    $this->Cell(190, 2, "EXAMEN INMUNOHISTOQUIMICO", 0, 0, 'C');
	    $this->Ln(5);   
	  }

}

$pdf = new PDF();
$pdf->setBiopsia($num_biopsia);
$pdf->AddPage();
$pdf->SetXY(15,38);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,5,utf8_decode("  Información del Paciente"),0,0,'L');
$pdf->Ln();
if ($biopsiasIH) {
	foreach ($biopsiasIH as $key) {
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
		$pdf->Cell(20,34,$key->procedencia,0,0,'L');
		$pdf->SetFont('Arial', '',9);
		$pdf->Cell(75,34, "Sexo : ", 0, 0, 'R');
		$pdf->SetFont('Arial', '',8.5);
		$pdf->Cell(0,34,$key->sexo,0,0,'L');
		$pdf->SetFont('Arial', '',9);
		$pdf->Cell(-150,46, "Servicio : ", 0, 0, 'R');
		$pdf->SetFont('Arial', '',8.5);
		$pdf->Cell(0,46,$key->servicio,0,0,'L');
		$pdf->SetFont('Arial', '',9);
		$pdf->Cell(-150,58,"Medico Tratante : ",0,0,'R');
		$pdf->SetFont('Arial', '',8.5);

		$med = $key->medico_tratante;
		if ($med =='OTRO') {
			$pdf->Cell(0,58,utf8_decode($key->medico_opcional),0,0,'L');
		} else {
			$pdf->Cell(0,58,utf8_decode($key->medico_tratante),0,0,'L');
		}
		// $pdf->Cell(10,1,utf8_decode($key->medico_tratante),0,0,'L');
		
		// $pdf->SetXY(189,68);

		// $pdf->Cell(0,58,utf8_decode($key->medico_tratante),0,0,'L');
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
// $pdf->Line(10,83,200,83);
// $pdf->SetFont('Arial','B',10);
// $pdf->SetXY(15,86);
// $pdf->Cell(0,5,utf8_decode("II. Información de Inmunohistoquimica"),0,0,'L');
$pdf->Ln(7);
$pdf->SetFont('Arial', '',9);
$pdf->SetXY(19,76);
$pdf->Cell(30,5,"Muestras Remitidas : ",0,0,'C');
if ($cantidad>0) {
  $pdf->Ln(0);
  for ($i=0; $i <$cantidad ; $i++) { 	
	$pdf->SetFont('Arial', '',8.5);
	$pdf->Cell(45,5,($i+1).". ",0,0,'R');
	$pdf->Cell(95,5,utf8_decode($muestrasIH[$i]->muestra_remitida),0,1,'L');
	}
	$pdf->Ln(1);
  	$pdf->SetFont('Arial','',9);
	$pdf->Cell(48,5,"Diagnostico Clinico : ",0,0,'C');
	$pdf->Ln(0);
	if ($biopsiasIH) {
		foreach ($biopsiasIH as $key) {
			$pdf->SetFont('Arial','',8.5);
			$pdf->Cell(40,5,'',0,0,'C');
			$pdf->MultiCell(150,5,utf8_decode($key->diagnostico),0,'J');
		}
	}$pdf->Ln(1);
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(57,5,utf8_decode("Observación : "),0,0,'C');
	$pdf->Ln(0);
	if ($biopsiasIH) {
		foreach ($biopsiasIH as $key) {
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
	if ($biopsiasIH) {
		foreach ($biopsiasIH as $key) {
			$pdf->SetFont('Arial','',8.5);
			$pdf->Cell(95,5,$key->fecha_biopsia,0,0,'C');
			$pdf->Cell(95,5,$key->fecha_informe,0,0,'C');
		}
	}$pdf->Ln(3);
	$pdf->Cell(20,5,"__________________________________________________________________________________________________________________",0,0,'L');
	$pdf->Ln(6);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(48,5,chr(149)." DIAGNOSTICO : ",0,0,'C');
	$pdf->Ln(5);
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(72,5,"Estudio de Inmunohistoquimica: ",0,0,'C');
	$pdf->Ln(5);
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(49,5,chr(149)." "."Procedimiento ",0,0,'C');
	$pdf->Ln(6);
	for ($i=0; $i <count($muestrasIH) ; $i++) { 	
		$pdf->SetFont('Arial', '',8);
		$pdf->Cell(18,5,($i+1).". ",0,0,'R');
		$pdf->Cell(83,5,utf8_decode($muestrasIH[$i]->muestra_remitida),0,0,'L');
		$pdf->Ln(4);
		$pdf->Cell(18,5,'',0,0,'C');
		$pdf->MultiCell(173,5,utf8_decode($muestrasIH[$i]->diag_final),0,'J');
		$pdf->Ln(3);
	}$pdf->Ln(-2);
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(43,5,chr(149)." "."Resultado  ",0,0,'C');
	$pdf->Ln(7);

	if ($resgeneralIH) {
		foreach ($resgeneralIH as $resgen) {
			$pdf->SetFont('Arial','',8.5);
			$pdf->Cell(13,5,'',0,0,'C');
			$pdf->MultiCell(180,5,utf8_decode($resgen->res_general),0,'J');
		}
	}
	$pdf->Ln(1);
	
	for ($i=0; $i <count($marcadoresIH) ; $i++) { 
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(18,5,($i+1).".",0,0,'R');
		$pdf->Cell(83,5,utf8_decode($marcadoresIH[$i]->descr_marcador." : ".$marcadoresIH[$i]->resultado),0,0,'L');
		$pdf->Ln(5);
	}$pdf->Ln(1);
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(44,5,chr(149)." "."Conclusion  ",0,0,'C');
	$pdf->Ln(7);
	if ($conclusionIH) {
		foreach ($conclusionIH as $conc) {
			$pdf->SetFont('Arial','',8.5);
			$pdf->Cell(12,5,'',0,0,'C');
			$pdf->MultiCell(180,5,utf8_decode($conc->conclusion),0,'J');
		}
	}$pdf->Ln(1);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(50,5,chr(149)." MACROSCOPIA : ",0,0,'C');
	$pdf->Ln(5);
	if ($macrosIH) {
		foreach ($macrosIH as $macro) {
			$pdf->SetFont('Arial','',7.5);
			$pdf->Cell(10,5,'',0,0,'C');
			$pdf->MultiCell(180,5,utf8_decode($macro->macroscopia),0,'J');
		}
	}
	/*

$pdf->Ln(10);
	$pdf->Cell(270,5,"------------------------------------------------------------------------------------------------",0,0,'C');
	$pdf->Ln(5);
	if ($biopsiasIH) {
		foreach ($biopsiasIH as $key) {
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(10,5,'',0,0,'C');
			$pat=$key->patologo;
			$pdf->Cell(160,5," ".utf8_decode($pat),0,0,'R');
			$pdf->Ln(5);
			$pdf->Cell(155,5,utf8_decode("Médico Anatomo Patologo"),0,0,'R');
			$pdf->Ln(5);
			$pdf->Cell(134,5,"C.M.P."." ".$key->emp_colegiatura,0,0,'R');
			$pdf->Ln(0);
			$pdf->Cell(158,5,"R.N.E."." ".$key->emp_rne,0,0,'R');
		}
	}

	*/

	$pdf->Ln(10);
	$pdf->Cell(270,5,"------------------------------------------------------------------------------------------------",0,0,'C');
	$pdf->Ln(5);
	if ($biopsiasIH) {
		foreach ($biopsiasIH as $key) {
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
			
			$pdf->Ln(5);
			$pdf->Cell(90,5,'',0,0,'C');
			$pdf->Cell(90,5,"C.M.P."." ".$key->emp_colegiatura.chr(32).chr(32).chr(32)."R.N.E"." ".$key->emp_rne,0,0,'C');
		}
	}
}
$pdf->Output();

?>