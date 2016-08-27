<?php
require_once 'view/fpdf17/fpdf.php';

class PDF extends FPDF{
	protected $id;

	public function getBiopsia(){
    	return $this ->id;
	}

	public function setBiopsia($id){
    	$this->id = $id;
	}

	function Header(){
		$this->SetFont('Arial', 'B', 13);
	    $this->Image("view/img/log.png", null, 5, 22, 17);
	    $this->Image("view/img/logr.jpg", 120, 2, 20, 20);
	    $this->Image("view/img/log.png", 153, 5, 22, 17);
	    $this->Image("view/img/logr.jpg", 263, 2, 20, 20);
	    $this->SetXY(10,10);
	    $this->Cell(130,2, "HOSPITAL REGIONAL LAMBAYEQUE", 0, 0, 'C');
	    $this->SetXY(153,10);
	    $this->Cell(130,2, "HOSPITAL REGIONAL LAMBAYEQUE", 0, 0, 'C');
	    $this->Ln(7);
	    $this->SetFont('Arial', 'B', 11.5);
	    $this->SetXY(10,18);
	    $this->Cell(130,1, "SERVICIO DE ANATOMIA PATOLOGICA", 0, 0, 'C');
	    $this->SetXY(153,18);
	    $this->Cell(130,1, "SERVICIO DE ANATOMIA PATOLOGICA", 0, 0, 'C');
	    $this->Line(10,25,140,25);
	    $this->Line(153,25,283,25);	
	    $this->Line(148,8,148,200);
	    $this->SetXY(120,27);
	    $this->Cell(23,5,$this->getBiopsia(),1,0,'L');	
	    $this->SetXY(263,27);
	    $this->Cell(23,5,$this->getBiopsia(),1,0,'L');
	    $this->SetXY(10,30);
	    $this->Cell(130,1, "EXAMEN CITOLOGICO", 0, 0, 'C');
	    $this->Ln(5);
	    $this->SetXY(153,30);
	    $this->Cell(130,1, "EXAMEN CITOLOGICO", 0, 0, 'C');
	    $this->Ln(5);
	}
	function Footer(){
		$this->SetFont('Arial','',7.5);
		$this->SetXY(120,200);
		$this->Cell(10,5,'',0,0,'C');
		$this->Cell(10,5,utf8_decode("Pag ".$this->PageNo()),0,0,'C');
		$this->SetXY(265,200);
		$this->Cell(10,5,'',0,0,'C');
		$this->Cell(10,5,utf8_decode("Pag ".$this->PageNo()),0,0,'C');
	}
	var $tablewidths;
	var $footerset;

	function _beginpage($orientation, $size) {
		$this->page++;
		if(!isset($this->pages[$this->page])) // solves the problem of overwriting a page if it already exists
			$this->pages[$this->page] = '';
		$this->state  =2;
		$this->x = $this->lMargin;
		$this->y = $this->tMargin;
		$this->FontFamily = '';
		// Check page size and orientation
		if($orientation=='')
			$orientation = $this->DefOrientation;
		else
			$orientation = strtoupper($orientation[0]);
		if($size=='')
			$size = $this->DefPageSize;
		else
			$size = $this->_getpagesize($size);
		if($orientation!=$this->CurOrientation || $size[0]!=$this->CurPageSize[0] || $size[1]!=$this->CurPageSize[1])
		{
			// New size or orientation
			if($orientation=='P')
			{
				$this->w = $size[0];
				$this->h = $size[1];
			}
			else
			{
				$this->w = $size[1];
				$this->h = $size[0];
			}
			$this->wPt = $this->w*$this->k;
			$this->hPt = $this->h*$this->k;
			$this->PageBreakTrigger = $this->h-$this->bMargin;
			$this->CurOrientation = $orientation;
			$this->CurPageSize = $size;
		}
		if($orientation!=$this->DefOrientation || $size[0]!=$this->DefPageSize[0] || $size[1]!=$this->DefPageSize[1])
			$this->PageSizes[$this->page] = array($this->wPt, $this->hPt);
	}

	function morepagestable($datas, $lineheight=4.5) {
		// some things to set and 'remember'
		$l = $this->lMargin;
		$startheight = $h = $this->GetY();
		$startpage = $currpage = $maxpage = $this->page;

		// calculate the whole width
		$fullwidth = 0;
		foreach($this->tablewidths AS $width) {
			$fullwidth += $width;
		}

		// Now let's start to write the table
		foreach($datas AS $row => $data) {
			$this->page = $currpage;
			// write the horizontal borders
			//$this->Line($l,$h,$fullwidth+$l,$h);
			// write the content and remember the height of the highest col
			foreach($data AS $col => $txt) {
				$this->page = $currpage;
				$this->SetXY($l,$h);
				if ($txt=='') {
					$lineheight=0;
				}else{
					$lineheight=4.5;
				}

				$this->MultiCell($this->tablewidths[$col],$lineheight,$txt);
				$l += $this->tablewidths[$col];

				if(!isset($tmpheight[$row.'-'.$this->page]))
					$tmpheight[$row.'-'.$this->page] = 0;
				if($tmpheight[$row.'-'.$this->page] < $this->GetY()) {
					$tmpheight[$row.'-'.$this->page] = $this->GetY();
				}
				if($this->page > $maxpage)
					$maxpage = $this->page;
			}

			// get the height we were in the last used page
			$h = $tmpheight[$row.'-'.$maxpage];
			// set the "pointer" to the left margin
			$l = $this->lMargin;
			// set the $currpage to the last page
			$currpage = $maxpage;
		}
		// draw the borders
		// we start adding a horizontal line on the last page
		$this->page = $maxpage;
		//$this->Line($l,$h,$fullwidth+$l,$h);
		// now we start at the top of the document and walk down
		for($i = $startpage; $i <= $maxpage; $i++) {
			$this->page = $i;
			$l = $this->lMargin;
			$t  = ($i == $startpage) ? $startheight : $this->tMargin;
			$lh = ($i == $maxpage)   ? $h : $this->h-$this->bMargin;
			//$this->Line($l,$t,$l,$lh);
			foreach($this->tablewidths AS $width) {
				$l += $width;
				//$this->Line($l,$t,$l,$lh);
			}
		}
		// set it to the last page, if not it'll cause some problems
		$this->page = $maxpage;
	}

}
$pdf = new PDF('L');
$pdf->setBiopsia($num_biopsia);
$pdf->AddPage();
$pdf->SetXY(10,37);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,1,utf8_decode("  Información del Paciente "),0,0,'L');
$pdf->SetXY(153,37);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,1,utf8_decode("  Información del Paciente "),0,0,'L');
$pdf->SetFont('Arial','',9);
$pdf->SetXY(36.6,43);
$pdf->Cell(10,1,"DNI : ",0,0,'L');
$pdf->SetXY(179.6,43);
$pdf->Cell(10,1,"DNI : ",0,0,'L');
$pdf->SetXY(13,48);
$pdf->Cell(10,1,"Apellidos y Nombres : ",0,0,'L');
$pdf->SetXY(156,48);
$pdf->Cell(10,1,"Apellidos y Nombres : ",0,0,'L');
$pdf->SetXY(34.7,53);
$pdf->Cell(10,1,"Edad : ",0,0,'L');
$pdf->SetXY(177.7,53);
$pdf->Cell(10,1,"Edad : ",0,0,'L');
$pdf->SetXY(97,53);
$pdf->Cell(10,1,"Sexo : ",0,0,'L');
$pdf->SetXY(240,53);
$pdf->Cell(10,1,"Sexo : ",0,0,'L');
$pdf->SetXY(24.5,58);
$pdf->Cell(10,1,"Procedencia : ",0,0,'L');
$pdf->SetXY(167.55,58);
$pdf->Cell(10,1,"Procedencia : ",0,0,'L');
$pdf->SetXY(30.8,63);
$pdf->Cell(10,1,"Servicio : ",0,0,'L');
$pdf->SetXY(174,63);
$pdf->Cell(10,1,"Servicio : ",0,0,'L');
$pdf->SetXY(17.2,68);
$pdf->Cell(10,1,"Muestra Remitida : ",0,0,'L');
$pdf->SetXY(160.5,68);
$pdf->Cell(10,1,"Muestra Remitida : ",0,0,'L');
$pdf->SetXY(33.5,73);
$pdf->Cell(10,1,"Gesta : ",0,0,'L');
$pdf->SetXY(177,73);
$pdf->Cell(10,1,"Gesta : ",0,0,'L');
$pdf->SetXY(97.5,73);
$pdf->Cell(10,1,"Para : ",0,0,'L');
$pdf->SetXY(240.7,73);
$pdf->Cell(10,1,"Para : ",0,0,'L');
$pdf->SetXY(36,78);
$pdf->Cell(10,1,"Mac : ",0,0,'L');
$pdf->SetXY(179.5,78);
$pdf->Cell(10,1,"Mac : ",0,0,'L');
$pdf->SetXY(99.3,78);
$pdf->Cell(10,1,"Fur : ",0,0,'L');
$pdf->SetXY(242.7,78);
$pdf->Cell(10,1,"Fur : ",0,0,'L');
$pdf->SetXY(23.5,83);
$pdf->Cell(10,1,"PAP Anterior : ",0,0,'L');
$pdf->SetXY(167.2,83);
$pdf->Cell(10,1,"PAP Anterior : ",0,0,'L');
$pdf->SetXY(14.8,88);
$pdf->Cell(10,1,"Diagnostico Clinico : ",0,0,'L');
$pdf->SetXY(158.5,88);
$pdf->Cell(10,1,"Diagnostico Clinico : ",0,0,'L');
$pdf->SetXY(24,93);
$pdf->Cell(10,1,"Observacion : ",0,0,'L');
$pdf->SetXY(167.7,93);
$pdf->Cell(10,1,"Observacion : ",0,0,'L');
$pdf->SetXY(19,98);
$pdf->Cell(10,1,"Medico Tratante : ",0,0,'L');
$pdf->SetXY(162.5,98);
$pdf->Cell(10,1,"Medico Tratante : ",0,0,'L');
$pdf->SetXY(17.5,103);
$pdf->Cell(10,1,"Fecha de Biopsia : ",0,0,'L');
$pdf->SetXY(161,103);
$pdf->Cell(10,1,"Fecha de Biopsia : ",0,0,'L');
$pdf->SetXY(79.5,103);
$pdf->Cell(10,1,"Fecha de Informe : ",0,0,'L');
$pdf->SetXY(223,103);
$pdf->Cell(10,1,"Fecha de Informe : ",0,0,'L');
$pdf->Line(10,108,140,108);
$pdf->Line(153,108,283,108);


if ($biopsiasCCV) {
	foreach ($biopsiasCCV as $key) {
		$pdf->SetFont('Arial','',8.5);
		$pdf->SetXY(46,43);
		$pdf->Cell(10,1,$key->dni,0,0,'L');
		$pdf->SetXY(189,43);
		$pdf->Cell(10,1,$key->dni,0,0,'L');
		$pdf->SetXY(46,48);
		$pdf->Cell(10,1,utf8_decode($key->paciente),0,0,'L');
		$pdf->SetXY(189,48);
		$pdf->Cell(10,1,utf8_decode($key->paciente),0,0,'L');
		$pdf->SetXY(46,53);
		$pdf->Cell(10,1,utf8_decode($key->edad),0,0,'L');
		$pdf->SetXY(189,53);
		$pdf->Cell(10,1,utf8_decode($key->edad),0,0,'L');
		$pdf->SetXY(107,53);
		$pdf->Cell(10,1,utf8_decode($key->sexo),0,0,'L');
		$pdf->SetXY(250,53);
		$pdf->Cell(10,1,utf8_decode($key->sexo),0,0,'L');
		$pdf->SetXY(46,58);
		$pdf->Cell(10,1,utf8_decode($key->procedencia),0,0,'L');
		$pdf->SetXY(189,58);
		$pdf->Cell(10,1,utf8_decode($key->procedencia),0,0,'L');
		$pdf->SetXY(46,63);
		$pdf->Cell(10,1,utf8_decode($key->servicio),0,0,'L');
		$pdf->SetXY(189,63);
		$pdf->Cell(10,1,utf8_decode($key->servicio),0,0,'L');
		$pdf->SetXY(46,68);
		$pdf->Cell(10,1,utf8_decode($key->muestra_remitida),0,0,'L');
		$pdf->SetXY(189,68);
		$pdf->Cell(10,1,utf8_decode($key->muestra_remitida),0,0,'L');
		$pdf->SetXY(46,73);
		$pdf->Cell(10,1,utf8_decode($key->gesta),0,0,'L');
		$pdf->SetXY(189,73);
		$pdf->Cell(10,1,utf8_decode($key->gesta),0,0,'L');
		$pdf->SetXY(107,73);
		$pdf->Cell(10,1,utf8_decode($key->para),0,0,'L');
		$pdf->SetXY(250,73);
		$pdf->Cell(10,1,utf8_decode($key->para),0,0,'L');
		$pdf->SetXY(46,78);
		$pdf->Cell(10,1,utf8_decode($key->mac),0,0,'L');
		$pdf->SetXY(189,78);
		$pdf->Cell(10,1,utf8_decode($key->mac),0,0,'L');
		$pdf->SetXY(107,78);
		$pdf->Cell(10,1,utf8_decode($key->fur),0,0,'L');
		$pdf->SetXY(250,78);
		$pdf->Cell(10,1,utf8_decode($key->fur),0,0,'L');
		$pdf->SetXY(46,83);
		$pdf->Cell(10,1,utf8_decode($key->pap_anterior),0,0,'L');
		$pdf->SetXY(189,83);
		$pdf->Cell(10,1,utf8_decode($key->pap_anterior),0,0,'L');
		$pdf->SetXY(46,88);
		$pdf->Cell(10,1,utf8_decode($key->diagnostico),0,0,'L');
		$pdf->SetXY(189,88);
		$pdf->Cell(10,1,utf8_decode($key->diagnostico),0,0,'L');
		$pdf->SetXY(46,93);
		$pdf->Cell(10,1,utf8_decode($key->observacion),0,0,'L');
		$pdf->SetXY(189,93);
		$pdf->Cell(10,1,utf8_decode($key->observacion),0,0,'L');
		$pdf->SetXY(46,98);

		$med = $key->medico_tratante;
		if ($med =='OTRO') {
			$pdf->Cell(10,1,utf8_decode($key->medico_opcional),0,0,'L');
		} else {
			$pdf->Cell(10,1,utf8_decode($key->medico_tratante),0,0,'L');
		}
		// $pdf->Cell(10,1,utf8_decode($key->medico_tratante),0,0,'L');
		
		$pdf->SetXY(189,98);

		if ($med =='OTRO') {
			$pdf->Cell(10,1,utf8_decode($key->medico_opcional),0,0,'L');
		} else {
			$pdf->Cell(10,1,utf8_decode($key->medico_tratante),0,0,'L');
		}
		// $pdf->Cell(10,1,utf8_decode($key->medico_tratante),0,0,'L');
		
		$pdf->SetXY(46,103);
		$pdf->Cell(10,1,utf8_decode($key->fecha_biopsia),0,0,'L');
		$pdf->SetXY(189,103);
		$pdf->Cell(10,1,utf8_decode($key->fecha_biopsia),0,0,'L');
		$pdf->SetXY(108,103);
		$pdf->Cell(10,1,utf8_decode($key->fecha_informe),0,0,'L');
		$pdf->SetXY(251,103);
		$pdf->Cell(10,1,utf8_decode($key->fecha_informe),0,0,'L');
	}

}
$pdf->SetXY(14,112);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,1,chr(149).utf8_decode(" DIAGNOSTICO CITOLOGICO "),0,0,'L');
$pdf->SetXY(156,112);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,1,chr(149).utf8_decode(" DIAGNOSTICO CITOLOGICO "),0,0,'L');
$pdf->Ln(5);
$pdf->tablewidths=array(7,123,20,123);
	for ($a=0; $a < count($biopsiasCCV) ; $a++) { 
		$pdf->SetFont('Arial', '',8.5);
		$datos[]=array('',utf8_decode($biopsiasCCV[$a]->descr_diagccv),'',utf8_decode($biopsiasCCV[$a]->descr_diagccv));
	}
$pdf->morepagestable($datos);
$pdf->tablewidths=array(85,70,70,123);
	for ($i=0; $i < count($biopsiasCCV) ; $i++) { 
		$pdf->SetFont('Arial', 'B',8.5);
		$codigos[]=array('',utf8_decode($biopsiasCCV[$i]->codigo),'',utf8_decode($biopsiasCCV[$i]->codigo));
	}
$pdf->morepagestable($codigos);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(39,5,chr(149).utf8_decode(" DESCRIPCION : "),0,0,'C');
$pdf->Cell(139,5,chr(149).utf8_decode(" DESCRIPCION : "),0,0,'R');
$pdf->Ln(6);
$pdf->tablewidths=array(7,123,20,123);
	for ($b=0; $b < count($biopsiasCCV) ; $b++) { 
		$pdf->SetFont('Arial', '',7.5);
		$descripciones[]=array('',utf8_decode($biopsiasCCV[$b]->descripcion),'',utf8_decode($biopsiasCCV[$b]->descripcion));
	}
$pdf->morepagestable($descripciones);

/*

$pdf->Ln(5);
$pdf->Cell(130,5,"-------------------------------------------------------------------------",0,0,'R');
$pdf->Cell(143,5,"-------------------------------------------------------------------------",0,0,'R');
$pdf->Ln(4);
$pdf->tablewidths=array(65,100,43,100);
	for ($r=0; $r < count($biopsiasCCV) ; $r++) { 
		$pdf->SetFont('Arial', 'B',7.5);
		$patologos[]=array('',"Dr. ".utf8_decode($biopsiasCCV[$r]->patologo),'',"Dr. ".utf8_decode($biopsiasCCV[$r]->patologo));
	}
$pdf->morepagestable($patologos);
$pdf->Ln(-1);
$pdf->SetFont('Arial', 'B',7.5);
$pdf->Cell(110,5,utf8_decode("Médico Anatomo Patologo"),0,0,'R');
$pdf->Cell(145,5,utf8_decode("Médico Anatomo Patologo"),0,0,'R');
$pdf->Ln(3.2);
$pdf->tablewidths=array(72,100,48,100);
	for ($j=0; $j < count($biopsiasCCV) ; $j++) { 
		$pdf->SetFont('Arial', 'B',7.5);
		$colegiaturas[]=array('',''.chr(32).chr(32).chr(32)."C.M.P.".' '.utf8_decode($biopsiasCCV[$j]->emp_colegiatura).chr(32).chr(32).chr(32)."R.N.E.".' '.$biopsiasCCV[$j]->emp_rne,'',"C.M.P.".' '.utf8_decode($biopsiasCCV[$j]->emp_colegiatura).chr(32).chr(32).chr(32)."R.N.E.".' '.$biopsiasCCV[$j]->emp_rne);
	}
$pdf->morepagestable($colegiaturas);

*/

$pdf->Ln(5);
$pdf->Cell(55,5,"",0,0,'C');
	$pdf->Cell(75,5,"-------------------------------------------------------------------------",0,0,'C');
$pdf->Cell(65,5,"",0,0,'C');
$pdf->Cell(75,5,"-------------------------------------------------------------------------",0,0,'C');

$pdf->Ln(4);
$pdf->tablewidths=array(65,100,43,100);
	for ($r=0; $r < count($biopsiasCCV) ; $r++) { 
		$pdf->SetFont('Arial', 'B',7.5);
		$pdf->Cell(55,5,"",0,0,'C');
		$pdf->Cell(75,5,utf8_decode($biopsiasCCV[$r]->patologo),0,0,'C');
		$pdf->Cell(65,5,"",0,0,'C');
		$pdf->Cell(75,5,utf8_decode($biopsiasCCV[$r]->patologo),0,0,'C');		
	}



$pdf->Ln(4);
	$pdf->SetFont('Arial', 'B',8);
	$pdf->Cell(55,5,"",0,0,'C');

	if ($key->emp_colegiatura=="37989") {
		$pdf->Cell(75,5,utf8_decode("Médico Hematólogo Clínico"),0,0,'C');
	} else {
		$pdf->Cell(75,5,utf8_decode("Médico Anátomo Patólogo"),0,0,'C');
	}

	// $pdf->Cell(75,5,utf8_decode("Médico Anátomo Patólogo"),0,0,'C');
	$pdf->Cell(65,5,"",0,0,'C');

	if ($key->emp_colegiatura=="37989") {
		$pdf->Cell(75,5,utf8_decode("Médico Hematólogo Clínico"),0,0,'C');
	} else {
		$pdf->Cell(75,5,utf8_decode("Médico Anátomo Patólogo"),0,0,'C');
	}
	
	// $pdf->Cell(75,5,utf8_decode("Médico Anátomo Patólogo"),0,0,'C');

$pdf->Ln(4);
$pdf->tablewidths=array(72,100,48,100);
	for ($j=0; $j < count($biopsiasCCV) ; $j++) { 
	$pdf->SetFont('Arial', 'B',7.5);
	$pdf->Cell(55,5,"",0,0,'C');
	$pdf->Cell(75,5,utf8_decode("C.M.P."." ".$biopsiasCCV[$j]->emp_colegiatura).chr(32).chr(32).chr(32)."R.N.E.".' '.$biopsiasCCV[$j]->emp_rne,0,0,'C');
	$pdf->Cell(65,5,"",0,0,'C');
	$pdf->Cell(75,5,utf8_decode("C.M.P."." ".$biopsiasCCV[$j]->emp_colegiatura).chr(32).chr(32).chr(32)."R.N.E.".' '.$biopsiasCCV[$j]->emp_rne,0,0,'C');
	$pdf->Cell(65,5,"",0,0,'C');

	}



$pdf->Output();


?>