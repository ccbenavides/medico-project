<?php
require 'view/fpdf17/fpdf.php';
require_once('view/jpgraph/jpgraph.php');
require_once('view/jpgraph/jpgraph_bar.php');

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
	    // $this->SetXY(10,30);
	    // $this->SetFont('Arial', 'B', 12);
	    // $this->Cell(0,5,"REPORTE",0,0,'C');
	    // $this->Ln(5);
	}

	function Footer(){
		$this->SetFont('Arial','',7.5);
		$this->SetXY(170,290);
		$this->Cell(10,5,'',0,0,'C');
		$this->Cell(10,5,date("d-m-Y H:i")."        "."Pag ".$this->PageNo(),0,0,'C'); 
	}

	public function grafico01($datos1=array(),$meses=array(),$titulo=NULL,$nomgrafico=NULL,$x){
        // Create the graph. These two calls are always required
	    $graph = new Graph(700,320,'auto');
	    $graph->SetScale("textlin");

	    //$theme_class="DefaultTheme";
	    //$graph->SetTheme(new $theme_class());

	    // set major and minor tick positions manually
	    //$graph->yaxis->SetTickPositions(array(0,30,60,90,120,150), array(15,45,75,105,135));
	    $graph->SetBox(false);

	    //$graph->ygrid->SetColor('gray');
	    $graph->ygrid->SetFill(false);
	    $graph->xaxis->SetTickLabels($meses);
	    $graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,8);
	    //$graph->xaxis->SetLabelAngle(15);
	    $graph->yaxis->HideLine(false);
	    $graph->yaxis->HideTicks(false,false);

	    // Create the bar plots
	    $b1plot = new BarPlot($datos1);
	    
	    // ...and add it to the graPH
	    $graph->Add($b1plot);

	    //$b1plot->value->Show(); //muestra valor de la barra
	    $b1plot->SetColor("white");
	    $b1plot->SetFillGradient("#074692","white",GRAD_LEFT_REFLECTION);
	    //$b1plot->SetWidth(45);
	    $graph->title->Set($titulo);
	    $graph->xaxis->title->Set('CODIGO DE MUESTRA');
		$graph->yaxis->title->Set('CANTIDAD DE BIOPSIAS');
	    // Display the graph
	    @unlink("$nomgrafico.png");
	    $graph->Stroke("$nomgrafico.png"); 
	    $this->Image("$nomgrafico.png",$x);
  }


}
$pdf = new PDF();
$pdf->AddPage();
if ($fecha1!=$fecha2) {
	$pdf->SetXY(10,30);
	$pdf->SetFont('Arial','B',10.5);
	$pdf->Cell(0,5,"ESTADISTICAS DE BIOPSIAS DIFERENTES DE CROMATINA SEXUAL DEL ".$fecha1_dia."-".$fecha1_mes."-".$fecha1_anio." AL ".$fecha2_dia."-".$fecha2_mes."-".$fecha2_anio,0,0,'C');
	$titu="ESTADISTICAS DE BIOPSIAS DIFERENTES DE CROMATINA SEXUAL DEL ".$fecha1_dia."-".$fecha1_mes."-".$fecha1_anio." AL ".$fecha2_dia."-".$fecha2_mes."-".$fecha2_anio;
} else {
	$pdf->SetXY(10,30);
	$pdf->SetFont('Arial','B',10.5);
	$pdf->Cell(0,5,"ESTADISTICAS DE BIOPSIAS DIFERENTES DE CROMATINA SEXUAL DEL ".$fecha1_dia."-".$fecha1_mes."-".$fecha1_anio,0,0,'C');
	$titu="ESTADISTICAS DE BIOPSIAS DIFERENTES DE CROMATINA SEXUAL DEL ".$fecha1_dia."-".$fecha1_mes."-".$fecha1_anio;
}
$pdf->Ln(10);
$pdf->SetX(25);
$pdf->SetFont('Arial','B',8.5);
$pdf->Cell(20,5,utf8_decode("CODIGO"),1,0,'C');
$pdf->Cell(95,5,utf8_decode("MUESTRA"),1,0,'C');
$pdf->Cell(45,5,utf8_decode("CANTIDAD DE BIOPSIAS"),1,0,'C');
$pdf->Ln(5);
$numeros=0;
for ($i=0; $i < count($diferentes); $i++) { 
	$pdf->SetX(25);
	$pdf->SetFont('Arial','',8.5);
	$pdf->Cell(20,5,$diferentes[$i]->codigo,1,0,'C');
	$pdf->Cell(95,5,utf8_decode($diferentes[$i]->descr_muestra),1,0,'L');
	$pdf->Cell(45,5,$diferentes[$i]->total,1,0,'C');
	$pdf->Ln(5);
	$numeros=$numeros+$diferentes[$i]->total;
}
$pdf->SetFont('Arial','B',9);
$pdf->SetX(25);
$pdf->Cell(115,5,"TOTAL",1,0,'C');
$pdf->Cell(45,5,$numeros,1,0,'C');
/*falta colocar dibujo*/
$pdf->Ln(10);
if (count($diferentes)>0) {
	$pdf->grafico01($ct,$ncroma,$titu,"graficos",10);
}

$pdf->Output();

?>