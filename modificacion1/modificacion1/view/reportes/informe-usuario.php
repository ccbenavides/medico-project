<?php
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
		$this->SetXY(180,280);
		$this->Cell(10,5,'',0,0,'C');
		$this->Cell(10,5,utf8_decode("Pag ".$this->PageNo()),0,0,'C');    
	}

	
}
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetXY(10,30);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,"REGISTRO DE USUARIO",0,0,'C');
$pdf->SetXY(10,40);
$pdf->SetFont('Arial','B',10.5);
$pdf->Cell(0,5,"I. INFORMACION ",0,0,'L');
$pdf->Ln(10);
$pdf->SetXY(15,48);
$pdf->SetFont('Arial','B',9.5);
$pdf->Cell(0,5,"                   EMPLEADO: ",0,0,'L');
$pdf->SetXY(15,56);
$pdf->SetFont('Arial','B',9.5);
$pdf->Cell(0,5,"                       USUARIO: ",0,0,'L');
$pdf->SetXY(15,64);
$pdf->SetFont('Arial','B',9.5);
$pdf->Cell(0,5,"                           CLAVE: ",0,0,'L');
$pdf->SetXY(15,72);
$pdf->SetFont('Arial','B',9.5);
$pdf->Cell(0,5," FECHA DE CREACION: ",0,0,'L');

if ($informaciones) {
	foreach ($informaciones as $key) {
		$pdf->SetFont('Arial','',9.5);
		$pdf->SetXY(56,48);
		$pdf->Cell(0,5,utf8_decode($key->empleado),0,0,'L');
		$pdf->SetXY(56,56);
		$pdf->Cell(0,5,utf8_decode($key->nom_usuario),0,0,'L');
		$pdf->SetXY(56,64);
		$pdf->Cell(0,5,base64_decode($key->clave_usuario),0,0,'L');
		$pdf->SetXY(56,72);
		$pdf->Cell(0,5,utf8_decode($key->fecha_registro),0,0,'L');
	}
}
$pdf->SetXY(10,82);
$pdf->SetFont('Arial','B',10.5);
$pdf->Cell(0,5,utf8_decode("II. RECOMENDACIONES - USO DE CONTRASEÑA"),0,0,'L');
$pdf->Ln(10);	
$pdf->SetX(15);
$pdf->SetFont('Arial','',9.5);
$pdf->Cell(0,5,chr(149).utf8_decode("  MANTENER LA CONFIDENCIALIDAD DE SU CONTRASEÑA"),0,0,'L');
$pdf->Ln(8);
$pdf->SetX(15);
$pdf->SetFont('Arial','',9.5);
$pdf->MultiCell(0,5,chr(149).utf8_decode("  CAMBIAR LA CONTRASEÑA TEMPORAL ASIGNADA EN EL REGISTRO DE USUARIO, LA PRIMERA VEZ QUE INGRESE AL SISTEMA."),0,'L');
$pdf->Ln(3);
$pdf->SetX(15);
$pdf->SetFont('Arial','',9.5);
$pdf->MultiCell(0,5,chr(149).utf8_decode("  SELECCIONAR CONTRASEÑA DE BUENA CALIDAD, CON UNA LONGITUD MÁXIMA DE 10 CARACTERES Y FÁCILES DE RECORDAR"),0,'L');
$pdf->Ln(3);
$pdf->SetX(15);
$pdf->SetFont('Arial','',9.5);
$pdf->Cell(0,5,chr(149).utf8_decode(" CAMBIAR SU CONTRASEÑA SI SE TIENE ALGÚN INDICIO DE SU VULNERABILIDAD "),0,0,'L');
$pdf->Ln(8);
$pdf->SetX(15);
$pdf->SetFont('Arial','',9.5);
$pdf->Cell(0,5,chr(149).utf8_decode(" NO COMPARTIR SU CONTRASEÑA CON OTRAS PERSONAS."),0,0,'L');
$pdf->Ln(8);
$pdf->SetX(15);
$pdf->SetFont('Arial','',9.5);
$pdf->Cell(0,5,chr(149).utf8_decode(" NO UTILIZAR LA OPCIÓN DE ALMACENAR CONTRASEÑA EN LOS NAVEGADORES DE INTERNET"),0,0,'L');

$pdf->Output();


?>