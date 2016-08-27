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
	    $this->Ln(5);
	}

	function Footer(){
		$this->SetFont('Arial','',7.5);
		$this->SetXY(170,290);
		$this->Cell(10,5,'',0,0,'C');
		$this->Cell(10,5,date("d-m-Y H:i")."        "."Pag ".$this->PageNo(),0,0,'C'); 
	}

	var $widths;
	var $aligns;

	function SetWidths($w)
	{
	    //Set the array of column widths
	    $this->widths=$w;
	}

	function SetAligns($a)
	{
	    //Set the array of column alignments
	    $this->aligns=$a;
	}

	function Row($data)
	{
	    //Calculate the height of the row
	    $nb=0;
	    for($i=0;$i<count($data);$i++)
	        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
	    $h=5*$nb;
	    //Issue a page break first if needed
	    $this->CheckPageBreak($h);
	    //Draw the cells of the row
	    for($i=0;$i<count($data);$i++)
	    {
	        $w=$this->widths[$i];
	        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'J';
	        //Save the current position
	        $x=$this->GetX();
	        $y=$this->GetY();
	        //Draw the border
	        $this->Rect($x,$y,$w,$h);
	        //Print the text
	        $this->MultiCell($w,5,$data[$i],0,$a);
	        //Put the position to the right of the cell
	        $this->SetXY($x+$w,$y);
	    }
	    //Go to the next line
	    $this->Ln($h);
	}

	function CheckPageBreak($h)
	{
	    //If the height h would cause an overflow, add a new page immediately
	    if($this->GetY()+$h>$this->PageBreakTrigger)
	        $this->AddPage($this->CurOrientation);
	}

	function NbLines($w,$txt)
	{
	    //Computes the number of lines a MultiCell of width w will take
	    $cw=&$this->CurrentFont['cw'];
	    if($w==0)
	        $w=$this->w-$this->rMargin-$this->x;
	    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
	    $s=str_replace("\r",'',$txt);
	    $nb=strlen($s);
	    if($nb>0 and $s[$nb-1]=="\n")
	        $nb--;
	    $sep=-1;
	    $i=0;
	    $j=0;
	    $l=0;
	    $nl=1;
	    while($i<$nb)
	    {
	        $c=$s[$i];
	        if($c=="\n")
	        {
	            $i++;
	            $sep=-1;
	            $j=$i;
	            $l=0;
	            $nl++;
	            continue;
	        }
	        if($c==' ')
	            $sep=$i;
	        $l+=$cw[$c];
	        if($l>$wmax)
	        {
	            if($sep==-1)
	            {
	                if($i==$j)
	                    $i++;
	            }
	            else
	                $i=$sep+1;
	            $sep=-1;
	            $j=$i;
	            $l=0;
	            $nl++;
	        }
	        else
	            $i++;
	    }
	    return $nl;
	}

}

$pdf=new PDF();
$pdf->AddPage();
$pdf->SetXY(10,30);
$pdf->SetFont('Arial','B',10.5);
$pdf->Cell(0,5,"PARTE DIARIO DEL ".$fecha_dia." - ".$fecha_mes." - ".$fecha_anio,0,0,'C');
$pdf->Ln(10);
// $pdf->SetXY(8,35);
// $pdf->SetFont('Arial','B',11);
// $pdf->Cell(0,5,"FECHA: ".$fecha_dia." - ".$fecha_mes." - ".$fecha_anio,0,0,'L');
$pdf->SetX(10);
$pdf->SetFont('Arial','B',9.5);
$pdf->Cell(0,5,"AREA: ",0,0,'L');
$pdf->SetX(23);
$pdf->SetFont('Arial','',9.5);
$pdf->Cell(0,5,"PATOLOGIA QUIRURGICA",0,0,'L');
$pdf->SetX(163);
$pdf->SetFont('Arial','B',9.5);
$pdf->Cell(10,5,utf8_decode("N° de biopsias: "),0,0,'L');
$pdf->SetX(190);
$pdf->SetFont('Arial','',9.5);
$pdf->Cell(10,5,count($partepq),1,0,'C');
$pdf->Ln(10);
$pdf->SetX(10);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(30,5,utf8_decode("N° DE BIOPSIA"),1,0,'C');
$pdf->SetX(40);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(30,5,utf8_decode("N° MUESTRAS"),1,0,'C');
$pdf->SetX(70);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(100,5,utf8_decode("MUESTRAS"),1,0,'C');
$pdf->SetX(170);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(30,5,utf8_decode("ESTADO BIOPSIA"),1,0,'C');

$pdf->SetWidths(array(30,30,100,30));
$pdf->Ln(5);
for ($i=0; $i <count($partepq) ; $i++) { 
	$pdf->SetFont('Arial', '', 7.5);
	$pdf->Row(array($partepq[$i]->num_biopsia,$partepq[$i]->numero_muestras,utf8_decode($partepq[$i]->muestras),$partepq[$i]->estado_biopsia));
}
$pdf->Ln(5);
$pdf->SetFont('Arial','B',9.5);
$pdf->Cell(10,5,"AREA: ",0,0,'L');
$pdf->SetFont('Arial','',9.5);
$pdf->SetX(23);
$pdf->Cell(25,5,"CITOLOGIA ESPECIAL",0,0,'L');
$pdf->SetX(163);
$pdf->SetFont('Arial','B',9.5);
$pdf->Cell(10,5,utf8_decode("N° de biopsias: "),0,0,'L');
$pdf->SetX(190);
$pdf->SetFont('Arial','',9.5);
$pdf->Cell(10,5,count($partece),1,0,'C');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(30,5,utf8_decode("N° DE BIOPSIA"),1,0,'C');
$pdf->Cell(30,5,utf8_decode("N° MUESTRAS"),1,0,'C');
$pdf->Cell(100,5,utf8_decode("MUESTRAS"),1,0,'C');
$pdf->Cell(30,5,utf8_decode("ESTADO BIOPSIA"),1,0,'C');
$pdf->SetWidths(array(30,30,100,30));
$pdf->Ln(5);
for ($i=0; $i <count($partece) ; $i++) { 
	$pdf->SetFont('Arial', '', 7.5);
	$pdf->Row(array($partece[$i]->num_biopsia,$partece[$i]->numero_muestras,utf8_decode($partece[$i]->muestras),$partece[$i]->estado_biopsia));
}
$pdf->Ln(5);
$pdf->SetFont('Arial','B',9.5);
$pdf->Cell(10,5,"AREA: ",0,0,'L');
$pdf->SetFont('Arial','',9.5);
$pdf->SetX(23);
$pdf->Cell(25,5,"CITOLOGIA CERVICO VAGINAL",0,0,'L');
$pdf->SetX(163);
$pdf->SetFont('Arial','B',9.5);
$pdf->Cell(10,5,utf8_decode("N° de biopsias: "),0,0,'L');
$pdf->SetX(190);
$pdf->SetFont('Arial','',9.5);
$pdf->Cell(10,5,count($parteccv),1,0,'C');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(30,5,utf8_decode("N° DE BIOPSIA"),1,0,'C');
$pdf->Cell(30,5,utf8_decode("N° MUESTRAS"),1,0,'C');
$pdf->Cell(100,5,utf8_decode("MUESTRAS"),1,0,'C');
$pdf->Cell(30,5,utf8_decode("ESTADO BIOPSIA"),1,0,'C');
$pdf->SetWidths(array(30,30,100,30));
$pdf->Ln(5);
for ($i=0; $i <count($parteccv) ; $i++) { 
	$pdf->SetFont('Arial', '', 7.5);
	$pdf->Row(array($parteccv[$i]->num_biopsia,$parteccv[$i]->numero_muestras,utf8_decode($parteccv[$i]->muestras),$parteccv[$i]->estado_biopsia));
}
$pdf->Ln(5);
$pdf->SetFont('Arial','B',9.5);
$pdf->Cell(10,5,"AREA: ",0,0,'L');
$pdf->SetFont('Arial','',9.5);
$pdf->SetX(23);
$pdf->Cell(25,5,"INMUNOHISTOQUIMICA",0,0,'L');
$pdf->SetX(163);
$pdf->SetFont('Arial','B',9.5);
$pdf->Cell(10,5,utf8_decode("N° de biopsias: "),0,0,'L');
$pdf->SetX(190);
$pdf->SetFont('Arial','',9.5);
$pdf->Cell(10,5,count($parteih),1,0,'C');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(30,5,utf8_decode("N° DE BIOPSIA"),1,0,'C');
$pdf->Cell(30,5,utf8_decode("N° MUESTRAS"),1,0,'C');
$pdf->Cell(100,5,utf8_decode("MUESTRAS"),1,0,'C');
$pdf->Cell(30,5,utf8_decode("ESTADO BIOPSIA"),1,0,'C');
$pdf->SetWidths(array(30,30,100,30));
$pdf->Ln(5);
for ($i=0; $i <count($parteih) ; $i++) { 
	$pdf->SetFont('Arial', '', 7.5);
	$pdf->Row(array($parteih[$i]->num_biopsia,$parteih[$i]->numero_muestras,utf8_decode($parteih[$i]->muestras),$parteih[$i]->estado_biopsia));
}
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(190,5,"TOTAL DE BIOPSIAS = ".(count($partepq)+count($partece)+count($parteccv)+count($parteih)),0,0,'R');
$pdf->Output();

?>