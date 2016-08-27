<?php
require_once 'view/fpdf17/fpdf.php';

class PDF extends FPDF{
	
}
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetXY(5,20);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(0,10, "ETIQUETA PARA MACROSCOPIA", 0, 0, 'C');
$pdf->Ln(5);
$pdf->SetXY(25,45);
$pdf->SetFont('Arial','B',23);
$pdf->Cell(70,13,strtoupper($numero),1,0,'C');
$pdf->SetXY(110,45);
$pdf->SetFont('Arial','B',23);
$pdf->Cell(70,13,strtoupper($numero),1,0,'C');
$pdf->SetXY(25,67);
$pdf->SetFont('Arial','B',23);
$pdf->Cell(70,13,strtoupper($numero),1,0,'C');
$pdf->SetXY(110,67);
$pdf->SetFont('Arial','B',23);
$pdf->Cell(70,13,strtoupper($numero),1,0,'C');
$pdf->SetXY(25,89);
$pdf->SetFont('Arial','B',23);
$pdf->Cell(70,13,strtoupper($numero),1,0,'C');
$pdf->SetXY(110,89);
$pdf->SetFont('Arial','B',23);
$pdf->Cell(70,13,strtoupper($numero),1,0,'C');
$pdf->SetXY(25,111);
$pdf->SetFont('Arial','B',23);
$pdf->Cell(70,13,strtoupper($numero),1,0,'C');
$pdf->SetXY(110,111);
$pdf->SetFont('Arial','B',23);
$pdf->Cell(70,13,strtoupper($numero),1,0,'C');
$pdf->SetXY(70,133);
$pdf->SetFont('Arial','B',23);
$pdf->Cell(70,13,strtoupper($numero),1,0,'C');
$pdf->Output();	



?>