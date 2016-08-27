<?php
require 'view/fpdf17/fpdf.php';
require_once('view/jpgraph/jpgraph.php');
require_once('view/jpgraph/jpgraph_bar.php');
//require_once ("view/jpgraph/jpgraph_pie3d.php");

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

	public function grafico01($datos1=array(),$datos2=array(),$meses=array(),$titulo=NULL,$nomgrafico=NULL,$x){
      
      $graph = new Graph(750,320,'auto');
      $graph->SetScale("textlin");
    
      $theme_class = new UniversalTheme;
      $graph->SetTheme($theme_class);

      
      $meses = array_merge(array_slice($meses,0,count($meses)));
      $graph->SetBox(false);

      $graph->ygrid->SetFill(false);
      $graph->yaxis->HideTicks(false,false);
      // Setup month as labels on the X-axis
      $graph->xaxis->SetTickLabels($meses);

      // Create the bar plots
      $b1plot = new BarPlot($datos1);
      $b2plot = new BarPlot($datos2);

      
      $gbplot = new GroupBarPlot(array($b1plot,$b2plot));

      // ...and add it to the graPH
      $graph->Add($gbplot);
      
      $b1plot->SetColor("#0000CD");
      $b1plot->SetFillColor("#0000CD");
      $b1plot->SetLegend("N° de Pacientes Atendidos");
      //$b1plot->value->Show(); //asigna valor a barra

      $b2plot->SetColor("#B0C4DE");
      $b2plot->SetFillColor("#B0C4DE");
      $b2plot->SetLegend("N° de Examenes Realizados");
      //$b2plot->value->Show(); //asigna valor a barra
     

      $graph->legend->SetFrameWeight(1);
      $graph->legend->SetColumns(2);
      $graph->legend->SetColor('#4E4E4E','#00A78A');

     
      $graph->title->Set($titulo);

      // Dibuja el grafico
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
	$pdf->Cell(0,5,$area." -ESTADISTICAS DE BIOPSIAS REALIZADAS DEL ".$fecha1_dia."-".$fecha1_mes."-".$fecha1_anio." AL ".$fecha2_dia."-".$fecha2_mes."-".$fecha2_anio,0,0,'C');
	$tit="ESTADISTICAS DE BIOPSIAS REALIZADAS DEL ".$fecha1_dia."-".$fecha1_mes."-".$fecha1_anio." AL ".$fecha2_dia."-".$fecha2_mes."-".$fecha2_anio;
} else {
	$pdf->SetXY(10,30);
	$pdf->SetFont('Arial','B',10.5);
	$pdf->Cell(0,5,"ESTADISTICAS DE BIOPSIAS REALIZADAS DEL ".$fecha1_dia."-".$fecha1_mes."-".$fecha1_anio,0,0,'C');
	$tit="ESTADISTICAS DE BIOPSIAS REALIZADAS DEL ".$fecha1_dia."-".$fecha1_mes."-".$fecha1_anio;
}
$pdf->Ln(5);
$pdf->SetXY(15,39);
$pdf->SetFont('Arial','B',9.5);
$pdf->Cell(0,5,"AREA: ",0,0,'L');
$pdf->SetXY(27,39);
$pdf->SetFont('Arial','',9);
$pdf->Cell(0,5,$nombres,0,0,'L');
$pdf->Ln(8);
$pdf->SetX(30);
$pdf->SetFont('Arial','B',8.5);
$pdf->Cell(38,5,utf8_decode("MES"),1,0,'C');
$pdf->Cell(55,5,utf8_decode("N° DE PACIENTES ATENDIDOS"),1,0,'C');
$pdf->Cell(55,5,utf8_decode("N° DE EXAMENES REALIZADOS"),1,0,'C');
$pdf->Ln(5);
$totalpac=0;
$totalexa=0;
for ($i=0; $i <count($pacientes) ; $i++) { 
	$pdf->SetFont('Arial','',8.5);
	$pdf->SetX(30);
	$pdf->Cell(38,5,$pacientes[$i]->descr_mes,1,0,'C');
	$pdf->Cell(55,5,$pacientes[$i]->num_pac_atend,1,0,'C');
	$pdf->Cell(55,5,$pacientes[$i]->total_examenes,1,0,'C');
	$pdf->Ln(5);
	$totalpac=$totalpac+$pacientes[$i]->num_pac_atend;
	$totalexa=$totalexa+$pacientes[$i]->total_examenes;
}
$pdf->SetFont('Arial','B',9);
$pdf->SetX(30);
$pdf->Cell(38,5,"TOTAL",1,0,'C');
$pdf->Cell(55,5,$totalpac,1,0,'C');
$pdf->Cell(55,5,$totalexa,1,0,'C');
$pdf->Ln(15);
$pdf->SetX(2);
$pdf->grafico01($numpac,$numexa,$meses,$tit,"graficos",10);

$pdf->Output();

?>