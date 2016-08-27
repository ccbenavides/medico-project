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

	function Header()
	{
		$this->SetFont('Arial', 'B', 13);
	    $this->Image("view/img/log.png", null, 5, 22, 17);
	    $this->Image("view/img/logr.jpg", 120, 5, 20, 20);
	    $this->Image("view/img/log.png", 153, 5, 22, 17);
	    $this->Image("view/img/logr.jpg", 263, 5, 20, 20);
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
$pdf->SetXY(100,53);
$pdf->Cell(10,1,"Sexo : ",0,0,'L');
$pdf->SetXY(245,53);
$pdf->Cell(10,1,"Sexo : ",0,0,'L');
$pdf->SetXY(24.5,58);
$pdf->Cell(10,1,"Procedencia : ",0,0,'L');
$pdf->SetXY(167.55,58);
$pdf->Cell(10,1,"Procedencia : ",0,0,'L');
$pdf->SetXY(30.8,63);
$pdf->Cell(10,1,"Servicio : ",0,0,'L');
$pdf->SetXY(174,63);
$pdf->Cell(10,1,"Servicio : ",0,0,'L');
$pdf->SetXY(19.2,68);
$pdf->Cell(10,1,"Medico Tratante : ",0,0,'L');
$pdf->SetXY(162.5,68);
$pdf->Cell(10,1,"Medico Tratante : ",0,0,'L');
// $pdf->SetXY(17.6,73);
// $pdf->Cell(10,1,"Fecha de Biopsia : ",0,0,'L');
// $pdf->SetXY(161,73);
// $pdf->Cell(10,1,"Fecha de Biopsia : ",0,0,'L');
// $pdf->SetXY(82.5,73);
// $pdf->Cell(10,1,"Fecha de Informe : ",0,0,'L');
// $pdf->SetXY(227.5,73);
// $pdf->Cell(10,1,"Fecha de Informe : ",0,0,'L');
// $pdf->Line(10,78,140,78);
// $pdf->Line(153,78,283,78);	
// $pdf->SetXY(10,81);
// $pdf->SetFont('Arial','B',10);
// $pdf->Cell(10,1,utf8_decode("II. Información Citologica "),0,0,'L');
// $pdf->SetXY(153,81);
// $pdf->SetFont('Arial','B',10);
// $pdf->Cell(10,1,utf8_decode("II. Información Citologica "),0,0,'L');
$pdf->SetXY(14,73);
$pdf->SetFont('Arial','',9);
$pdf->Cell(10,1,utf8_decode("Muestras Remitidas : "),0,0,'L');
$pdf->SetXY(157,73);
$pdf->SetFont('Arial','',9);
$pdf->Cell(10,1,utf8_decode("Muestras Remitidas : "),0,0,'L');
$pdf->SetFont('Arial','',8.5);
if ($biopsiasCE) {
	foreach ($biopsiasCE as $key) {
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
		$pdf->SetXY(110,53);
		$pdf->Cell(10,1,utf8_decode($key->sexo),0,0,'L');
		$pdf->SetXY(255,53);
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

		$med = $key->medico_tratante;
		if ($med =='OTRO') {
			$pdf->Cell(10,1,utf8_decode($key->medico_opcional),0,0,'L');
		} else {
			$pdf->Cell(10,1,utf8_decode($key->medico_tratante),0,0,'L');
		}
		// $pdf->Cell(10,1,utf8_decode($key->medico_tratante),0,0,'L');
		
		$pdf->SetXY(189,68);

		if ($med =='OTRO') {
			$pdf->Cell(10,1,utf8_decode($key->medico_opcional),0,0,'L');
		} else {
			$pdf->Cell(10,1,utf8_decode($key->medico_tratante),0,0,'L');
		}

		// $pdf->Cell(10,1,utf8_decode($key->medico_tratante),0,0,'L');
		// $pdf->SetXY(189,68);
		// $pdf->Cell(10,1,utf8_decode($key->medico_tratante),0,0,'L');
		// $pdf->SetXY(46,73);
		// $pdf->Cell(10,1,utf8_decode($key->fecha_biopsia),0,0,'L');
		// $pdf->SetXY(189,73);
		// $pdf->Cell(10,1,utf8_decode($key->fecha_biopsia),0,0,'L');
		// $pdf->SetXY(110,73);
		// $pdf->Cell(10,1,utf8_decode($key->fecha_informe),0,0,'L');
		// $pdf->SetXY(255,73);
		// $pdf->Cell(10,1,utf8_decode($key->fecha_informe),0,0,'L');
	}
}
if ($cantidad>0) {
	$pdf->Ln(3);
	$pdf->tablewidths=array(35,123,20,123);
	for ($i=0; $i <$cantidad ; $i++) { 	
	$pdf->SetFont('Arial', '',8.5);
	$columna[]=array('',($i+1).". ".utf8_decode($muestrasPQ[$i]->muestra_remitida),'',($i+1).". ".utf8_decode($muestrasPQ[$i]->muestra_remitida));
	}
	$pdf->morepagestable($columna);
	// $pdf->SetFont('Arial','B',8);
	// $pdf->Cell(45,5,'Ver Descripcion',0,0,'C');
	// $pdf->Cell(132,5,'Ver Descripcion',0,0,'R');
	$pdf->Ln(0);
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(41,5,"Diagnostico Clinico : ",0,0,'C');
	$pdf->Cell(139,5,"Diagnostico Clinico : ",0,0,'R');
	$pdf->Ln(0);
	$pdf->tablewidths=array(35,100,44,100);
	for ($a=0; $a < $otracantidad ; $a++) { 
		$pdf->SetFont('Arial', '',8.5);
		if (($biopsiasCE[$a]->diagnostico)!='') {
			$datos[]=array('',utf8_decode($biopsiasCE[$a]->diagnostico),'',utf8_decode($biopsiasCE[$a]->diagnostico));
		} else {
			$datos[]=array('',utf8_decode($biopsiasCE[$a]->diagnostico),'',utf8_decode($biopsiasCE[$a]->diagnostico));
			$pdf->Ln(5);
		}
	}
	$pdf->morepagestable($datos);

	$pdf->SetFont('Arial','',9);
	$pdf->Cell(50,5,utf8_decode("Observación : "),0,0,'C');
	$pdf->Cell(130,5,utf8_decode("Observación : "),0,0,'R');
	$pdf->Ln(0);
	$pdf->tablewidths=array(35,100,44,100);
	for ($c=0; $c < $otracantidad ; $c++) { 
		$pdf->SetFont('Arial', '',8.5);
		if (($biopsiasCE[$c]->observacion)!='') {
			$obs[]=array('',utf8_decode($biopsiasCE[$c]->observacion),'',utf8_decode($biopsiasCE[$c]->observacion));
		} else {
			$obs[]=array('',utf8_decode($biopsiasCE[$c]->observacion),'',utf8_decode($biopsiasCE[$c]->observacion));
			$pdf->Ln(5);
		}
	}
	$pdf->morepagestable($obs);
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(43,5,utf8_decode("Fecha de Biopsia : "),0,0,'C');
	$pdf->Cell(90,5,utf8_decode("Fecha de Informe : "),0,0,'C');
	$pdf->Cell(47,5,utf8_decode("Fecha de Biopsia : "),0,0,'R');
	$pdf->Cell(69,5,utf8_decode("Fecha de Informe : "),0,0,'R');
	$pdf->Ln(0);
	$pdf->tablewidths=array(35,66,78,68,100);
	for ($cc=0; $cc < $otracantidad ; $cc++) { 
		$pdf->SetFont('Arial','',8.5);
		$fechs[]=array('',utf8_decode($biopsiasCE[$cc]->fecha_biopsia),utf8_decode($biopsiasCE[$cc]->fecha_informe),utf8_decode($biopsiasCE[$cc]->fecha_biopsia),utf8_decode($biopsiasCE[$cc]->fecha_informe));
	}
	$pdf->morepagestable($fechs);
	$pdf->Cell(20,5,"______________________________________________________________________________",0,0,'L');
	$pdf->Cell(0,5,"_______________________________________________________________________________",0,0,'R');
	$pdf->Ln(5);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(39,5,chr(149).utf8_decode(" DIAGNOSTICO : "),0,0,'C');
	$pdf->Cell(139,5,chr(149).utf8_decode(" DIAGNOSTICO : "),0,0,'R');
	$pdf->Ln(7);
	$pdf->tablewidths=array(7,123,20,123);
	for ($m=0; $m <$cantidad ; $m++) { 	
	$pdf->SetFont('Arial', '',8);
	$diag[]=array('',($m+1).". ".utf8_decode($muestrasPQ[$m]->muestra_remitida).chr(10).utf8_decode($muestrasPQ[$m]->diag_final),'',($m+1).". ".utf8_decode($muestrasPQ[$m]->muestra_remitida).chr(10).utf8_decode($muestrasPQ[$m]->diag_final));
	}
	$pdf->morepagestable($diag);
	// $pdf->SetFont('Arial','B',9);
	// $pdf->Cell(30,5,utf8_decode("E) Descripción"),0,0,'C');
	// $pdf->Cell(140,5,utf8_decode("E) Descripción"),0,0,'R');
	// $pdf->Ln(5);
	// $pdf->tablewidths=array(7,123,20,123);
	// for ($d=0; $d <$cantidad ; $d++) { 	
	// $pdf->SetFont('Arial', '',8.5);
	// $descripcion[]=array('',($d+1).". ".utf8_decode($muestrasPQ[$d]->descrip_muestce),'',($d+1).". ".utf8_decode($muestrasPQ[$d]->descrip_muestce));
	// }
	// $pdf->morepagestable($descripcion);
	$pdf->Ln(3);
	$pdf->SetFont('Arial','B',7);
	$pdf->Cell(31,5,chr(149).utf8_decode(" MACROSCOPIA : "),0,0,'C');
	$pdf->Cell(139,5,chr(149).utf8_decode(" MACROSCOPIA : "),0,0,'R');
	$pdf->Ln(5);
	$pdf->tablewidths=array(7,123,20,123);
	for ($n=0; $n < count($macrosCE) ; $n++) { 
		$pdf->SetFont('Arial', '',7.5);
		$filas[]=array('',chr(149).' '.utf8_decode($macrosCE[$n]->macroscopia),'',chr(149).' '.utf8_decode($macrosCE[$n]->macroscopia));
	}
	$pdf->morepagestable($filas);
	$pdf->Ln(3);
	$pdf->Cell(130,5,"-------------------------------------------------------------------------",0,0,'R');
	$pdf->Cell(143,5,"-------------------------------------------------------------------------",0,0,'R');
	$pdf->Ln(2.5);
	$pdf->tablewidths=array(65,100,43,100);
	for ($r=0; $r < count($biopsiasCE) ; $r++) { 
		$pdf->SetFont('Arial', 'B',8);
		$patologos[]=array('',"     ".utf8_decode($biopsiasCE[$r]->patologo),'',"     ".utf8_decode($biopsiasCE[$r]->patologo));
	}
	$pdf->morepagestable($patologos);
	$pdf->Ln(-1.5);
	$pdf->SetFont('Arial', 'B',8);
	$pdf->Cell(113,5,utf8_decode("Médico Anátomo Patólogo"),0,0,'R');
	$pdf->Cell(145,5,utf8_decode("Médico Anátomo Patólogo"),0,0,'R');
	$pdf->Ln(4);
	$pdf->tablewidths=array(74,100,48,100);
	for ($j=0; $j < count($biopsiasCE) ; $j++) { 
		$pdf->SetFont('Arial', 'B',8);
		$colegiaturas[]=array('',''.chr(32).chr(32).chr(32).chr(32).utf8_decode("C.M.P."." ".$biopsiasCE[$j]->emp_colegiatura).chr(32).chr(32).chr(32)."R.N.E.".' '.$biopsiasCE[$j]->emp_rne,'',utf8_decode("C.M.P."." ".$biopsiasCE[$j]->emp_colegiatura).chr(32).chr(32).chr(32)."R.N.E.".' '.$biopsiasCE[$j]->emp_rne);
	}
	$pdf->morepagestable($colegiaturas);
}

$pdf->Output();

?>