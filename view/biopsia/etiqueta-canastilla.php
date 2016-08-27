<?php
require_once 'view/fpdf17/fpdf.php';
class PDF extends FPDF{
	
}
$pdf = new PDF('L');
$pdf->AddPage();
$pdf->SetXY(18,10);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(0,10, "CODIGO DE CANASTILLAS", 0, 0, 'C');
$pdf->Ln(15);
if ($codigos) {
	foreach ($codigos as $key) {
		$pdf->SetX(9);
		$pdf->SetFont('Arial','B',8.5);
		$pdf->Cell(28,10,$key->num_biopsia,1,0,'L');
		$pdf->Cell(28,10,$key->num_biopsia,1,0,'L');
		$pdf->Cell(28,10,$key->num_biopsia,1,0,'L');
		$pdf->Cell(28,10,$key->num_biopsia,1,0,'L');
		$pdf->Cell(28,10,$key->num_biopsia,1,0,'L');
		$pdf->Cell(28,10,$key->num_biopsia,1,0,'L');
		$pdf->Cell(28,10,$key->num_biopsia,1,0,'L');
		$pdf->Cell(28,10,$key->num_biopsia,1,0,'L');
		$pdf->Cell(28,10,$key->num_biopsia,1,0,'L');
		$pdf->Cell(28,10,$key->num_biopsia,1,0,'L');
		$pdf->Ln(10);
	}
}
$pdf->Output();

?>