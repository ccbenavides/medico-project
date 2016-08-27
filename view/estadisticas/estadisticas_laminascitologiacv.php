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
	    $this->Cell(130,1, "SERVICIO DE CITOLOGIA CERVICO VAGINAL", 0, 0, 'C');//editado
	    $this->Line(10,25,200,25);
	    $this->Ln(5);
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
	    $graph->yaxis->HideLine(false);
	    $graph->yaxis->HideTicks(false,false);

	    // Create the bar plots
	    $b1plot = new BarPlot($datos1);
	    
	    // ...and add it to the graPH
	    $graph->Add($b1plot);

	    //$b1plot->value->Show(); //muestra valor de la barra
	    $b1plot->SetColor("white");
	    $b1plot->SetFillGradient("#378200","white",GRAD_LEFT_REFLECTION);
	    //$b1plot->SetWidth(45);
	    $graph->title->Set($titulo);
	    $graph->xaxis->title->Set('MES');
		$graph->yaxis->title->Set('CANTIDAD DE BIOPSIAS');
	    // Display the graph
	    @unlink("$nomgrafico.png");
	    $graph->Stroke("$nomgrafico.png"); 
	    $this->Image("$nomgrafico.png",$x);
  }


}
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetXY(10,30);
$pdf->SetFont('Arial','B',10.5);
$pdf->Cell(0,5,"CITOLOGIA CERVICO VAGINAL (LAMINAS POR MEDICOS)",0,0,'C');
$titu="CITOLOGIA CERVICO VAGINAL (LAMINAS POR MEDICOS)";
$pdf->Ln(10);
$pdf->SetX(40);
$pdf->SetFont('Arial','B',8.5);
$pdf->Cell(30,5,utf8_decode("N° LÁMINAS"),1,0,'C');
$pdf->Cell(100,5,utf8_decode("MEDICO ANATOMOPATOLOGO"),1,0,'C');
$pdf->Ln(5);
$numeros=0;
for ($i=0; $i < count($laminas); $i++) { 
	$pdf->SetX(40);
	$pdf->SetFont('Arial','',8.5);
	$pdf->Cell(30,5,$laminas[$i]->total_laminas,1,0,'C');
	$pdf->Cell(100,5,$laminas[$i]->nombres,1,0,'C');
	$pdf->Ln(5);
}
$pdf->SetFont('Arial','B',9);
$pdf->SetX(60);
$pdf->Ln(10);
// $pdf->grafico01($tot,$tiempos,$titu,"graficos",10);
$pdf->Output();


?>