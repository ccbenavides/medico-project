<?php
error_reporting(0);
require 'view/fpdf17/fpdf.php';
$meses = array('01' => 'ENERO','02' => 'FEBRERO','03' => 'MARZO','04' => 'ABRIL','05' => 'MAYO','06' => 'JUNIO'
                ,'07' => 'JULIO','08' => 'AGOSTO','09' => 'SEPTIEMBRE','10' => 'OCTUBRE','11' => 'NOVIEMBRE','12' => 'DICIEMBRE');
class PDF extends FPDF{
	protected $anio;
	protected $mes;

	public function setAnio($anio){
	    $this->anio = $anio;
	}

	public function getAnio(){
	    return $this ->anio;
	}

	public function setMes($mes){
	    $this->mes = $mes;
	}

	public function getMes(){
	    return $this ->mes;
	}

	function Header()
	{
		$this->SetFont('Arial', 'B', 13);
	    $this->Image("view/img/log.png", null, 5, 22, 17);
	    $this->Image("view/img/logr.jpg", 270, 5, 20, 20);
	    $this->SetXY(85,10);
	    $this->Cell(130,2, "HOSPITAL REGIONAL LAMBAYEQUE", 0, 0, 'C');
	    $this->SetXY(85,18);
	    $this->Cell(130,1, "SERVICIO DE ANATOMIA PATOLOGICA", 0, 0, 'C');
	    $this->Line(10,25,290,25);
	    $this->Ln(5);
	    $this->SetXY(10,30);
	    $this->SetFont('Arial', 'B', 12);
	    $this->Cell(0,5,"REPORTE DE BIOPSIAS  ".$this->getMes() . " - ". $this->getAnio(),0,0,'C');
	    $this->Ln(10);
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
$pdf=new PDF('L');
$pdf->setMes($meses[$mes]);
$pdf->setAnio($año);
$pdf->AddPage();
$pdf->SetXY(11.9,40);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(0,5,"AREA: ",0,0,'L');
$pdf->SetXY(23,40);
$pdf->SetFont('Arial','',9);
$pdf->Cell(0,5,$nombres,0,0,'L');
$pdf->Ln(8);
$pdf->SetFont('Arial','B',8.5);
$pdf->Cell(20,5,utf8_decode("N° BIOPSIA"),1,0,'C');
$pdf->Cell(85,5,utf8_decode("PACIENTE"),1,0,'C');
$pdf->Cell(35,5,utf8_decode("FECHA DE INGRESO"),1,0,'C');
$pdf->Cell(35,5,utf8_decode("FECHA DE INFORME"),1,0,'C');
$pdf->Cell(70,5,utf8_decode("SERVICIO"),1,0,'C');
$pdf->Cell(35,5,utf8_decode("ESTADO DE BIOPSIA"),1,0,'C');
$pdf->SetWidths(array(20,85,35,35,70,35));
$pdf->Ln(5);
for ($i=0; $i <count($total); $i++) { 
	$pdf->SetFont('Arial', '', 7.5);
	$pdf->Row(array($total[$i]->num_biopsia,utf8_decode($total[$i]->paciente),$total[$i]->fecha_ingreso,$total[$i]->fecha_informe,utf8_decode($total[$i]->servicio),$total[$i]->estado_biopsia));
}
$pdf->Ln(5);
$pdf->SetX(11.9);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(0,5,"BIOPSIAS DERIVADAS DE PATOLOGIA QUIRURGICA",0,0,'L');
$pdf->Ln(8);
$pdf->SetFont('Arial','B',8.5);
$pdf->Cell(20,5,utf8_decode("N° BIOPSIA"),1,0,'C');
$pdf->Cell(85,5,utf8_decode("PACIENTE"),1,0,'C');
$pdf->Cell(35,5,utf8_decode("FECHA DE INGRESO"),1,0,'C');
$pdf->Cell(35,5,utf8_decode("FECHA DE INFORME"),1,0,'C');
$pdf->Cell(70,5,utf8_decode("SERVICIO"),1,0,'C');
$pdf->Cell(35,5,utf8_decode("ESTADO DE BIOPSIA"),1,0,'C');
$pdf->SetWidths(array(20,85,35,35,70,35));
$pdf->Ln(5);
for ($i=0; $i <count($totalpq); $i++) { 
	$pdf->SetFont('Arial', '', 7.5);
	$pdf->Row(array($totalpq[$i]->num_biopsia,utf8_decode($totalpq[$i]->paciente),$totalpq[$i]->fecha_ingreso,$totalpq[$i]->fecha_informe,utf8_decode($totalpq[$i]->servicio),$totalpq[$i]->estado_biopsia));
}
$pdf->Ln(5);
$pdf->SetX(11.9);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(0,5,"BIOPSIAS DERIVADAS DE CITOLOGIA ESPECIAL",0,0,'L');
$pdf->Ln(8);
$pdf->SetFont('Arial','B',8.5);
$pdf->Cell(20,5,utf8_decode("N° BIOPSIA"),1,0,'C');
$pdf->Cell(85,5,utf8_decode("PACIENTE"),1,0,'C');
$pdf->Cell(35,5,utf8_decode("FECHA DE INGRESO"),1,0,'C');
$pdf->Cell(35,5,utf8_decode("FECHA DE INFORME"),1,0,'C');
$pdf->Cell(70,5,utf8_decode("SERVICIO"),1,0,'C');
$pdf->Cell(35,5,utf8_decode("ESTADO DE BIOPSIA"),1,0,'C');
$pdf->SetWidths(array(20,85,35,35,70,35));
$pdf->Ln(5);
for ($i=0; $i <count($totalce); $i++) { 
	$pdf->SetFont('Arial', '', 7.5);
	$pdf->Row(array($totalce[$i]->num_biopsia,utf8_decode($totalce[$i]->paciente),$totalce[$i]->fecha_ingreso,$totalce[$i]->fecha_informe,utf8_decode($totalce[$i]->servicio),$totalce[$i]->estado_biopsia));
}
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(280,5,"TOTAL DE BIOPSIAS = ".(count($total)+count($totalpq)+count($totalce)),0,0,'R');
$pdf->Output();
?>