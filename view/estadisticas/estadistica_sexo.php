<?php
require 'view/fpdf17/fpdf.php';
require_once('view/jpgraph/jpgraph.php');
require_once('view/jpgraph/jpgraph_pie.php');
require_once ("view/jpgraph/jpgraph_pie3d.php");

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


	public function graficosestadistico($valores=array(),$titulo=NULL,$nombres=array(),$nomgrafico=NULL,$x){
  	$graph=new PieGraph(600,200,"auto");
  	$theme_class= new VividTheme;
	$graph->SetTheme($theme_class);
  	$graph->img->SetAntiAliasing(); 
  	$graph->SetMarginColor('white');
  	$graph->SetFrame(true,'black',3);
  	$graph->title->Set($titulo);
    $graph->title->SetColor("black");
  	$p1=new PiePlot3D($valores);
  	$p1->SetSize(0.5);
  	$p1->SetCenter(0.4);
  	$p1->value->SetFont(FF_FONT1,FS_BOLD); 
  	$p1->value->SetColor("black"); 
  	$p1->SetLabelPos(0.2); 
  	$p1->SetLegends($nombres);
  	$p1->ExplodeAll(); 
  	$graph->legend->SetFrameWeight(1);
    $graph->legend->SetColumns(1);
    $graph->legend->SetPos(0.8, 0.3,'center','right');
  	//$p1->ExplodeSlice(1);
  	$graph->Add($p1); 
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
	$pdf->Cell(0,5,"ESTADISTICAS DE BIOPSIAS POR GENERO DEL ".$fecha1_dia."-".$fecha1_mes."-".$fecha1_anio." AL ".$fecha2_dia."-".$fecha2_mes."-".$fecha2_anio,0,0,'C');
	$tit="ESTADISTICAS DE BIOPSIAS POR GENERO DEL ".$fecha1_dia."-".$fecha1_mes."-".$fecha1_anio." AL ".$fecha2_dia."-".$fecha2_mes."-".$fecha2_anio;
} else {
	$pdf->SetXY(10,30);
	$pdf->SetFont('Arial','B',10.5);
	$pdf->Cell(0,5,"ESTADISTICAS DE BIOPSIAS POR GENERO DEL ".$fecha1_dia."-".$fecha1_mes."-".$fecha1_anio,0,0,'C');
	$tit="ESTADISTICAS DE BIOPSIAS POR GENERO DEL ".$fecha1_dia."-".$fecha1_mes."-".$fecha1_anio;
}
$pdf->Ln(5);
$pdf->SetXY(15,39);
$pdf->SetFont('Arial','B',9.5);
$pdf->Cell(0,5,"AREA: ",0,0,'L');
$pdf->SetXY(27,39);
$pdf->SetFont('Arial','',9);
$pdf->Cell(0,5,$nombres,0,0,'L');
$pdf->Ln(8);
$pdf->SetX(60);
$pdf->SetFont('Arial','B',8.5);
$pdf->Cell(38,5,utf8_decode("GENERO"),1,0,'C');
$pdf->Cell(55,5,utf8_decode("CANTIDAD DE BIOPSIAS"),1,0,'C');
$pdf->Ln(5);
$cantidades=0;
for ($i=0; $i <count($numeros) ; $i++) { 
	$pdf->SetX(60);
	$pdf->SetFont('Arial','',8.5);
	$pdf->Cell(38,5,$numeros[$i]->genero,1,0,'C');
	$pdf->Cell(55,5,$numeros[$i]->total,1,0,'C');
	$pdf->Ln(5);
	$cantidades=$cantidades+$numeros[$i]->total;
}
$pdf->SetFont('Arial','B',9);
$pdf->SetX(60);
$pdf->Cell(38,5,"TOTAL",1,0,'C');
$pdf->Cell(55,5,$cantidades,1,0,'C');
$pdf->Ln(10);
if ($cantidades!=0) {
	$pdf->graficosestadistico($tcant,$tit,$generos,"graficos",23);
}

$pdf->Output();

?>