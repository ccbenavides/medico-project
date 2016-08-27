<?php
error_reporting(0);
require 'view/fpdf17/fpdf.php';
class PDF extends FPDF{
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
	    $this->Ln(10);
	   
	}

	function Footer(){
		$this->SetFont('Arial','',7.5);
		$this->SetXY(260,203);
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
$pdf=new PDF('L');
$pdf->AddPage();
if ($fecha1!=$fecha2) {
	$pdf->SetXY(10,30);
	$pdf->SetFont('Arial','B',10.5);
	$pdf->Cell(0,5,"REPORTE DE BIOPSIAS DEL ".$fecha1_dia."-".$fecha1_mes."-".$fecha1_anio." AL ".$fecha2_dia."-".$fecha2_mes."-".$fecha2_anio,0,0,'C');
} else {
	$pdf->SetXY(10,30);
	$pdf->SetFont('Arial','B',10.5);
	$pdf->Cell(0,5,"REPORTE DE BIOPSIAS DEL ".$fecha1_dia."-".$fecha1_mes."-".$fecha1_anio,0,0,'C');
}
$pdf->SetXY(11.9,40);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(0,5,"AREA: ",0,0,'L');
$pdf->SetXY(23,40);
$pdf->SetFont('Arial','',9);
$pdf->Cell(0,5,"PATOLOGIA QUIRURGICA",0,0,'L');
// $pdf->SetX(130);
// $pdf->SetFont('Arial','B',9);
// $pdf->Cell(0,5,"DESDE: ",0,0,'L');
// $pdf->SetX(143);
// $pdf->SetFont('Arial','',9);
// $pdf->Cell(0,5,$fecha1,0,0,'L');
// $pdf->SetX(220);
// $pdf->SetFont('Arial','B',9);
// $pdf->Cell(0,5,"HASTA: ",0,0,'L');
// $pdf->SetX(233);
// $pdf->SetFont('Arial','',9);
// $pdf->Cell(0,5,$fecha2,0,0,'L');
$pdf->Ln(8);
$pdf->SetFont('Arial','B',8.5);
$pdf->Cell(35,5,utf8_decode("FECHA DE INGRESO"),1,0,'C');
$pdf->Cell(20,5,utf8_decode("N° BIOPSIA"),1,0,'C');
$pdf->Cell(85,5,utf8_decode("PACIENTE"),1,0,'C');
$pdf->Cell(35,5,utf8_decode("FECHA DE INFORME"),1,0,'C');
$pdf->Cell(70,5,utf8_decode("SERVICIO"),1,0,'C');
$pdf->Cell(35,5,utf8_decode("ESTADO DE BIOPSIA"),1,0,'C');
$pdf->SetWidths(array(35,20,85,35,70,35));
$pdf->Ln(5);
for ($i=0; $i <count($bpq); $i++) { 
	$pdf->SetFont('Arial', '', 7.5);
	$pdf->Row(array($bpq[$i]->fecha_ingreso,$bpq[$i]->num_biopsia,utf8_decode($bpq[$i]->paciente),$bpq[$i]->fecha_informe,utf8_decode($bpq[$i]->servicio),$bpq[$i]->estado_biopsia));
}
$pdf->Ln(2);
$pdf->SetX(255);
$pdf->SetFont('Arial','B',8.5);
$pdf->Cell(10,5,utf8_decode("N° de biopsias:"),0,0,'L');
$pdf->SetX(280);
$pdf->SetFont('Arial','',8.5);
$pdf->Cell(10,5,count($bpq),1,0,'C');
$pdf->Ln(5);
$pdf->SetX(11.9);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(0,5,"AREA: ",0,0,'L');
$pdf->SetX(23);
$pdf->SetFont('Arial','',9);
$pdf->Cell(0,5,"CITOLOGIA ESPECIAL",0,0,'L');
// $pdf->SetX(130);
// $pdf->SetFont('Arial','B',9);
// $pdf->Cell(0,5,"DESDE: ",0,0,'L');
// $pdf->SetX(143);
// $pdf->SetFont('Arial','',9);
// $pdf->Cell(0,5,$fecha1,0,0,'L');
// $pdf->SetX(220);
// $pdf->SetFont('Arial','B',9);
// $pdf->Cell(0,5,"HASTA: ",0,0,'L');
// $pdf->SetX(233);
// $pdf->SetFont('Arial','',9);
// $pdf->Cell(0,5,$fecha2,0,0,'L');
$pdf->Ln(8);
$pdf->SetFont('Arial','B',8.5);
$pdf->Cell(35,5,utf8_decode("FECHA DE INGRESO"),1,0,'C');
$pdf->Cell(20,5,utf8_decode("N° BIOPSIA"),1,0,'C');
$pdf->Cell(85,5,utf8_decode("PACIENTE"),1,0,'C');
$pdf->Cell(35,5,utf8_decode("FECHA DE INFORME"),1,0,'C');
$pdf->Cell(70,5,utf8_decode("SERVICIO"),1,0,'C');
$pdf->Cell(35,5,utf8_decode("ESTADO DE BIOPSIA"),1,0,'C');
$pdf->SetWidths(array(35,20,85,35,70,35));
$pdf->Ln(5);
for ($i=0; $i <count($bce); $i++) { 
	$pdf->SetFont('Arial', '', 7.5);
	$pdf->Row(array($bce[$i]->fecha_ingreso,$bce[$i]->num_biopsia,utf8_decode($bce[$i]->paciente),$bce[$i]->fecha_informe,utf8_decode($bce[$i]->servicio),$bce[$i]->estado_biopsia));
}
$pdf->Ln(2);
$pdf->SetX(255);
$pdf->SetFont('Arial','B',8.5);
$pdf->Cell(10,5,utf8_decode("N° de biopsias:"),0,0,'L');
$pdf->SetX(280);
$pdf->SetFont('Arial','',8.5);
$pdf->Cell(10,5,count($bce),1,0,'C');
$pdf->Ln(5);
$pdf->SetX(11.9);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(0,5,"AREA: ",0,0,'L');
$pdf->SetX(23);
$pdf->SetFont('Arial','',9);
$pdf->Cell(0,5,"CITOLOGIA CERVICO VAGINAL",0,0,'L');
// $pdf->SetX(130);
// $pdf->SetFont('Arial','B',9);
// $pdf->Cell(0,5,"DESDE: ",0,0,'L');
// $pdf->SetX(143);
// $pdf->SetFont('Arial','',9);
// $pdf->Cell(0,5,$fecha1,0,0,'L');
// $pdf->SetX(220);
// $pdf->SetFont('Arial','B',9);
// $pdf->Cell(0,5,"HASTA: ",0,0,'L');
// $pdf->SetX(233);
// $pdf->SetFont('Arial','',9);
// $pdf->Cell(0,5,$fecha2,0,0,'L');
$pdf->Ln(8);
$pdf->SetFont('Arial','B',8.5);
$pdf->Cell(35,5,utf8_decode("FECHA DE INGRESO"),1,0,'C');
$pdf->Cell(20,5,utf8_decode("N° BIOPSIA"),1,0,'C');
$pdf->Cell(85,5,utf8_decode("PACIENTE"),1,0,'C');
$pdf->Cell(35,5,utf8_decode("FECHA DE INFORME"),1,0,'C');
$pdf->Cell(70,5,utf8_decode("SERVICIO"),1,0,'C');
$pdf->Cell(35,5,utf8_decode("ESTADO DE BIOPSIA"),1,0,'C');
$pdf->SetWidths(array(35,20,85,35,70,35));
$pdf->Ln(5);
for ($i=0; $i <count($bccv); $i++) { 
	$pdf->SetFont('Arial', '', 7.5);
	$pdf->Row(array($bccv[$i]->fecha_ingreso,$bccv[$i]->num_biopsia,utf8_decode($bccv[$i]->paciente),$bccv[$i]->fecha_informe,utf8_decode($bccv[$i]->servicio),$bccv[$i]->estado_biopsia));
}
$pdf->Ln(2);
$pdf->SetX(255);
$pdf->SetFont('Arial','B',8.5);
$pdf->Cell(10,5,utf8_decode("N° de biopsias:"),0,0,'L');
$pdf->SetX(280);
$pdf->SetFont('Arial','',8.5);
$pdf->Cell(10,5,count($bccv),1,0,'C');
$pdf->Ln(5);
$pdf->SetX(11.9);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(0,5,"AREA: ",0,0,'L');
$pdf->SetX(23);
$pdf->SetFont('Arial','',9);
$pdf->Cell(0,5,"INMUNOHISTOQUIMICA",0,0,'L');
// $pdf->SetX(130);
// $pdf->SetFont('Arial','B',9);
// $pdf->Cell(0,5,"DESDE: ",0,0,'L');
// $pdf->SetX(143);
// $pdf->SetFont('Arial','',9);
// $pdf->Cell(0,5,$fecha1,0,0,'L');
// $pdf->SetX(220);
// $pdf->SetFont('Arial','B',9);
// $pdf->Cell(0,5,"HASTA: ",0,0,'L');
// $pdf->SetX(233);
// $pdf->SetFont('Arial','',9);
// $pdf->Cell(0,5,$fecha2,0,0,'L');
$pdf->Ln(8);
$pdf->SetFont('Arial','B',8.5);
$pdf->Cell(35,5,utf8_decode("FECHA DE INGRESO"),1,0,'C');
$pdf->Cell(20,5,utf8_decode("N° BIOPSIA"),1,0,'C');
$pdf->Cell(85,5,utf8_decode("PACIENTE"),1,0,'C');
$pdf->Cell(35,5,utf8_decode("FECHA DE INFORME"),1,0,'C');
$pdf->Cell(70,5,utf8_decode("SERVICIO"),1,0,'C');
$pdf->Cell(35,5,utf8_decode("ESTADO DE BIOPSIA"),1,0,'C');
$pdf->SetWidths(array(35,20,85,35,70,35));
$pdf->Ln(5);
for ($i=0; $i <count($bih); $i++) { 
	$pdf->SetFont('Arial', '', 7.5);
	$pdf->Row(array($bih[$i]->fecha_ingreso,$bih[$i]->num_biopsia,utf8_decode($bih[$i]->paciente),$bih[$i]->fecha_informe,utf8_decode($bih[$i]->servicio),$bih[$i]->estado_biopsia));
}
$pdf->Ln(5);
$pdf->SetX(11.9);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(0,5,"BIOPSIAS DERIVADAS DE PATOLOGIA QUIRURGICA",0,0,'L');
$pdf->Ln(8);
$pdf->SetFont('Arial','B',8.5);
$pdf->Cell(35,5,utf8_decode("FECHA DE INGRESO"),1,0,'C');
$pdf->Cell(20,5,utf8_decode("N° BIOPSIA"),1,0,'C');
$pdf->Cell(85,5,utf8_decode("PACIENTE"),1,0,'C');
$pdf->Cell(35,5,utf8_decode("FECHA DE INFORME"),1,0,'C');
$pdf->Cell(70,5,utf8_decode("SERVICIO"),1,0,'C');
$pdf->Cell(35,5,utf8_decode("ESTADO DE BIOPSIA"),1,0,'C');
$pdf->SetWidths(array(35,20,85,35,70,35));
$pdf->Ln(5);
for ($i=0; $i <count($bpqih) ; $i++) { 
	$pdf->SetFont('Arial', '', 7.5);
	$pdf->Row(array($bpqih[$i]->fecha_ingreso,$bpqih[$i]->num_biopsia,utf8_decode($bpqih[$i]->paciente),$bpqih[$i]->fecha_informe,utf8_decode($bpqih[$i]->servicio),$bpqih[$i]->estado_biopsia));
}
$pdf->Ln(5);
$pdf->SetX(11.9);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(0,5,"BIOPSIAS DERIVADAS DE CITOLOGIA ESPECIAL",0,0,'L');
$pdf->Ln(8);
$pdf->SetFont('Arial','B',8.5);
$pdf->Cell(35,5,utf8_decode("FECHA DE INGRESO"),1,0,'C');
$pdf->Cell(20,5,utf8_decode("N° BIOPSIA"),1,0,'C');
$pdf->Cell(85,5,utf8_decode("PACIENTE"),1,0,'C');
$pdf->Cell(35,5,utf8_decode("FECHA DE INFORME"),1,0,'C');
$pdf->Cell(70,5,utf8_decode("SERVICIO"),1,0,'C');
$pdf->Cell(35,5,utf8_decode("ESTADO DE BIOPSIA"),1,0,'C');
$pdf->SetWidths(array(35,20,85,35,70,35));
$pdf->Ln(5);
for ($i=0; $i <count($bceih) ; $i++) { 
	$pdf->SetFont('Arial', '', 7.5);
	$pdf->Row(array($bceih[$i]->fecha_ingreso,$bceih[$i]->num_biopsia,utf8_decode($bceih[$i]->paciente),$bceih[$i]->fecha_informe,utf8_decode($bceih[$i]->servicio),$bceih[$i]->estado_biopsia));
}
$pdf->Ln(5);
$pdf->SetX(255);
$pdf->SetFont('Arial','B',8.5);
$pdf->Cell(10,5,utf8_decode("N° de biopsias:"),0,0,'L');
$pdf->SetX(280);
$pdf->SetFont('Arial','',8.5);
$pdf->Cell(10,5,(count($bih)+count($bpqih)+count($bceih)),1,0,'C');
$pdf->Ln(8);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(280,5,"TOTAL DE BIOPSIAS = ".(count($bpq)+count($bce)+count($bccv)+count($bih)+count($bpqih)+count($bceih)),0,0,'R');
$pdf->Output();

?>