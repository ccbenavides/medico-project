<?php
error_reporting(0);
require_once 'view/PHPExcel_1.8.0/Classes/PHPExcel.php';
function nombremes($mes,$año){
 setlocale(LC_TIME, 'spanish');  
 $nombre=strftime("%B",mktime(0, 0, 0, $mes, 1, $año)); 
 return $nombre;
} 
$objPHPExcel = new PHPExcel();
$objPHPExcel->
	getProperties()
		->setCreator("Division de Tecnologias de Informacion")
		->setLastModifiedBy("")
		->setTitle("Reportes de Examenes y Procedimientos Realizados en Anatomia Patologica")
		->setSubject("")
		->setDescription("Reportes SIGBIO")
		->setKeywords("Usuarios SIGBIO")
		->setCategory("Informes");
$objPHPExcel->setActiveSheetIndex(0)->setTitle('"EXAMENES_'.strtoupper(nombremes($mes,$año)).'-'.$año.'"');

//$objPHPExcel->setActiveSheetIndex()->mergeCells('A1:C2');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('D1:L1');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:C1');
//colocando el texto en las celdas
$objPHPExcel->setActiveSheetIndex()->setCellValue('D1','EXAMENES Y PROCEDIMIENTOS REALIZADOS EN ANATOMIA PATOLOGICA '.strtoupper(nombremes($mes,$año)).' - '.$año);

$objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setName('Arial')->setSize(9)->setBold(true);
//asignando una alineacion justifcada a la celda
$objPHPExcel->getActiveSheet()->getStyle('D1:L1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('E3:H3');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E3','');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('I3:J3');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I3','TOTAL');
$objPHPExcel->getActiveSheet()->getStyle('I3')->getFont()->setName('Arial')->setSize(7.5)->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('I3:J3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('I'.$i.':J'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('E3:H3')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
		$objPHPExcel->getActiveSheet()->getStyle('E3:H3')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('E3:H3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('E3:H3')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('I3:J3')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
		$objPHPExcel->getActiveSheet()->getStyle('I3:J3')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('I3:J3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('I3:J3')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$ct=count($cantidades)+4;
	for ($i=4; $i <$ct; $i++) { 
		if ($i==4 or $i==5 or $i==8 or $i==14 or $i==15 or $i==16) {
			$objPHPExcel->getActiveSheet(0)->getStyle("E4")->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet(0)->getStyle("I4")->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet(0)->getStyle("E5")->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet(0)->getStyle("I5")->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet(0)->getStyle("E8")->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet(0)->getStyle("I8")->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet(0)->getStyle("E14")->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet(0)->getStyle("I14")->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet(0)->getStyle("E15")->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet(0)->getStyle("I15")->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet(0)->getStyle("E16")->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet(0)->getStyle("I16")->getFont()->setBold(true);
		} 
		
		$objPHPExcel->getActiveSheet(0)->getStyle('E'.$i.':H'.$i)->getFont()->setName('Arial')->setSize(7.5);
		$objPHPExcel->getActiveSheet(0)->getStyle('I'.$i.':J'.$i)->getFont()->setName('Arial')->setSize(7.5);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('E'.$i.':H'.$i);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('I'.$i.':J'.$i);
		$objPHPExcel->getActiveSheet()->getStyle('I'.$i.':J'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('E'.$i.':H'.$i)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
		$objPHPExcel->getActiveSheet()->getStyle('E'.$i.':H'.$i)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('E'.$i.':H'.$i)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('E'.$i.':H'.$i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('I'.$i.':J'.$i)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
		$objPHPExcel->getActiveSheet()->getStyle('I'.$i.':J'.$i)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('I'.$i.':J'.$i)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('I'.$i.':J'.$i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	}
for ($h=0; $h < count($cantidades); $h++) { 
	$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('E'.($h+4), $cantidades[$h]->examen)
            ->setCellValue('I'.($h+4), $cantidades[$h]->total);
          
}
$nct=$ct+1;
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('E'.$nct.':H'.$nct);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$nct,'PROCEDENCIA');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('I'.$nct.':J'.$nct);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$nct,'TOTAL');
$objPHPExcel->getActiveSheet()->getStyle('E'.$nct)->getFont()->setName('Arial')->setSize(7.5)->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('I'.$nct)->getFont()->setName('Arial')->setSize(7.5)->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('E'.$nct.':H'.$nct)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
$objPHPExcel->getActiveSheet()->getStyle('E'.$nct.':H'.$nct)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()->getStyle('E'.$nct.':H'.$nct)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()->getStyle('E'.$nct.':H'.$nct)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()->getStyle('I'.$nct.':J'.$nct)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
$objPHPExcel->getActiveSheet()->getStyle('I'.$nct.':J'.$nct)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()->getStyle('I'.$nct.':J'.$nct)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()->getStyle('I'.$nct.':J'.$nct)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$pt=$nct+1;
$cproc=count($procedencias)+$nct+1;
for ($i=$pt; $i <$cproc ; $i++) { 
		$objPHPExcel->getActiveSheet(0)->getStyle('E'.$i.':H'.$i)->getFont()->setName('Arial')->setSize(7.5);
		$objPHPExcel->getActiveSheet(0)->getStyle('I'.$i.':J'.$i)->getFont()->setName('Arial')->setSize(7.5);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('E'.$i.':H'.$i);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('I'.$i.':J'.$i);
		$objPHPExcel->getActiveSheet()->getStyle('I'.$i.':J'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('E'.$i.':H'.$i)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
		$objPHPExcel->getActiveSheet()->getStyle('E'.$i.':H'.$i)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('E'.$i.':H'.$i)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('E'.$i.':H'.$i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('I'.$i.':J'.$i)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
		$objPHPExcel->getActiveSheet()->getStyle('I'.$i.':J'.$i)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('I'.$i.':J'.$i)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('I'.$i.':J'.$i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
}

for ($m=0; $m < count($procedencias); $m++) { 
	$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('E'.($m+$pt), $procedencias[$m]->examen)
            ->setCellValue('I'.($m+$pt), $procedencias[$m]->total);
          
}


header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="EXAMENES_PROCEDIMIENTOS_'.strtoupper(nombremes($mes,$año)).'_'.$año.'.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;

?>