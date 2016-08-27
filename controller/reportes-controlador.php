<?php

//session_start();
require_once 'controller/class.inputfilter.php';
require_once 'model/clases/empleado.php';
require_once 'model/clases/paciente.php';
require_once 'model/clases/bioPQ.php';
require_once 'model/clases/bioCE.php';
require_once 'model/clases/bioCCV.php';
require_once 'model/clases/bioIH.php';
require_once 'model/clases/departamentos.php';
require_once 'model/clases/dependencias.php';
require_once 'model/clases/area.php';
require_once 'model/clases/informes.php';
require_once 'model/clases/estadisticas.php';
include 'controller/validar-sesion.php';


function _formAction(){
  
    require 'view/generar-reporte.php';
}

function _informeAction(){
    $fechasis=date('Y-m-d'); 
    require 'view/informes/generar-informe.php';
}

function _cancerAction(){
    require 'view/reportes/generar-repcancer.php';
}

function _estadisticaAction(){
    require 'view/estadisticas/generar-estadistica.php';
}

function _infpacAction(){

	$filter = new InputFilter();
    $id = $_GET['id'];
    $verinfo = new bioPQ();
    $condicion=$verinfo->obtreqih($id);
    $biopsiasPQ = $verinfo->obtenerinfpac($id);
        foreach ($biopsiasPQ as $key) {
            $num_biopsia=$key->num_biopsia;
        }
    $minfo = new bioPQ();
        $muestrasPQ = $minfo->obtenermuestydiag($id);
        foreach ($muestrasPQ as $value) {
            $muestra_remitida=$value->muestra_remitida;
        }
        $cantidad = $minfo->cantidadmuestydiag($id);
        $macroPQ = $verinfo->obtenermacrobio($id);
        foreach ($macroPQ as $macro) {
            $macroscopia=$macro->macroscopia;
        }
    if ($condicion!='Si') {
        require 'view/reportes/informe-pac.php';
    } else {
        /*falta implementar este reporte para los que tienen inmunohistoquimica*/
        $marcadoresPQ=$verinfo->obtenermarcpq($id);
        foreach ($marcadoresPQ as $value1) {
            $descr_marcador=$value1->descr_marcador;
        }
        require 'view/reportes/informe-pqih.php';
    }
    
   

}

function _infpacceAction(){
    $filter = new InputFilter();
    $id=$_GET['id'];
    $verinfo = new bioCE();
    $condreq=$verinfo->obtrequiereih($id);
    $biopsiasCE = $verinfo->obtenerinfpace($id);
    foreach ($biopsiasCE as $key) {
        $num_biopsia=$key->num_biopsia;
    }
    $minfo = new bioPQ();
        $muestrasPQ = $minfo->obtenermuestydiag($id);
        foreach ($muestrasPQ as $value) {
            $muestra_remitida=$value->muestra_remitida;
        }
        $cantidad = $minfo->cantidadmuestydiag($id);
        $otracantidad = $verinfo->cantinfce($id);
        $macrosCE=$verinfo->obtmacroce($id);
        foreach ($macrosCE as $macro) {
            $macroscopia = $macro->macroscopia;
        }
    if ($condreq!='Si') {
             
        require 'view/reportes/informe-pac-ce.php';
    } else {
       /*falta implementar este reporte para los que tienen inmunohistoquimica*/
       $marcadoresCE=$minfo->obtenermarcpq($id);
        foreach ($marcadoresCE as $value1) {
            $descr_marcador=$value1->descr_marcador;
        }
        require 'view/reportes/informe-ceih.php'; 
    }
    
    
    
}

function _infpacccvAction(){
    $filter=new InputFilter();
    $id=$_GET['id'];
    $verinfo = new bioCCV();
    $biopsiasCCV = $verinfo->obtenerinfopaccv($id);
    foreach ($biopsiasCCV as $key) {
        $num_biopsia=$key->num_biopsia;
    }
    require 'view/reportes/informe-pac-ccv.php';
}

function _infpacihAction(){

     $filter=new InputFilter();
     $id=$_GET['id'];
     $verinfo = new bioIH();
     $biopsiasIH = $verinfo->obtenerinfpacih($id);
     foreach ($biopsiasIH as $key) {
        $num_biopsia=$key->num_biopsia;
     }
     $minfo = new bioPQ();
     $muestrasIH = $minfo->obtenermuestydiag($id);
        foreach ($muestrasIH as $value) {
            $muestra_remitida=$value->muestra_remitida;
        }
     $cantidad = $minfo->cantidadmuestydiag($id);
     $marcadoresIH=$minfo->obtenermarcpq($id);
        foreach ($marcadoresIH as $value1) {
            $descr_marcador=$value1->descr_marcador;
        }
     $macrosIH=$verinfo->obtenermacroih($id);
        foreach ($macrosIH as $macro) {
            $macroscopia = $macro->macroscopia;
        }
     $conclusionIH=$verinfo->obtenerconclusionih($id);
     $resgeneralIH=$verinfo->obtenerresgeneralih($id);
    
    require 'view/reportes/informe-pac-ih.php';
}

function _cargarareaAction(){
    $area = new Area();
    $areas = $area->listararea();  
    if ($areas) {
        $html  = "<div class='row-fluid'>";
        $html .= "<form class='form-horizontal'>";
        $html .= "<div class='control-group row-fluid'>";
        $html .= "<label class='control-label span2'><strong>Area<strong></label>";
        $html .= "<div class='controls span6'>";
        $html .= "<select required class='span6' name='area' >";
        $html .= '<option value="">Seleccione...</option>';
        foreach ($areas as $are) {
            $html .= "<option value='" . $are->id_area . "'>$are->descr_area</option>";
        }
        $html .= "</select>";
        $html .= "</div>";
        $html .= "</div>";
    }else{
        $html .= "<div class='alert alert-warning'>No se encontraron registros.</div>";
    }
    echo $html;
}

function _cargardivAction(){
    $html="<div class='row-fluid'>";
    $html .= "</div>";
    echo $html;
}

function _cargardiarioAction(){
    $area = new Area();
    $areas = $area->listararea();  
    if ($areas) {
        $html  = "<div class='row-fluid'>";
        $html .= "<form class='form-horizontal'>";
        $html .= "<div class='control-group row-fluid'>";
        $html .= "<label class='control-label span2'><strong>Area<strong></label>";
        $html .= "<div class='controls span6'>";
        $html .= "<select required class='span6' name='area' >";
        $html .= '<option value="">Seleccione...</option>';
        $html .= '<option value="All">TODAS</option>';
        foreach ($areas as $are) {
            $html .= "<option value='" . $are->id_area . "'>$are->descr_area</option>";
        }
        $html .= "</select>";
        $html .= "</div>";
        $html .= "</div>";
    }else{
        $html .= "<div class='alert alert-warning'>No se encontraron registros.</div>";
    }
        // $html .= "<div class='row-fluid'>";
        // $html .= "<form class='form-horizontal'>";
        // $html .= "<div class='control-group row-fluid'>";
        // $html .= "<label class='control-label span2'><strong>Fecha<strong></label>";
        // $html .= "<div class='controls span6'>";
        // $html .= "<input class='span6' type='date' name='mes' required>";
        // $html .= "</div>";
        // $html .= "</div>";

        echo $html;
}

function _cargarservicioAction(){
    $area = new Area();
    $areas = $area->listararea();  
    $dep=new Dependencia();
    $dependencias=$dep->consultarActivos();

    if ($areas) {
        $html  = "<div class='row-fluid'>";
        $html .= "<form class='form-horizontal'>";
        $html .= "<div class='control-group row-fluid'>";
        $html .= "<label class='control-label span2'><strong>Area<strong></label>";
        $html .= "<div class='controls span6'>";
        $html .= "<select class='span6' name='area' required>";
        $html .= '<option value="">Seleccione area</option>';
        foreach ($areas as $area) {
            $html .= "<option value='" . $area->id_area . "'>$area->descr_area</option>";
        }
        $html .= "</select>";
        $html .= "</div>";
        $html .= "</div>";
    }else{
        $html .= "<div class='alert alert-warning'>No se encontraron registros.</div>";
    }
    if ($dependencias) {
        $html .= "<div class='row-fluid'>";
        $html .= "<form class='form-horizontal'>";
        $html .= "<div class='control-group row-fluid'>";
        $html .= "<label class='control-label span2'><strong>Servicio<strong></label>";
        $html .= "<div class='controls span6'>";
        $html .= "<select class='span6' name='servicio' required>";
        $html .= '<option value="">Seleccione servicio</option>';
        foreach ($dependencias as $dependencia) {
            $html .= "<option value='" . $dependencia->dep_id . "'>$dependencia->dep_descr</option>";
        }
        $html .= "</select>";
        $html .= "</div>";
        $html .= "</div>";
    }else{
        $html .= "<div class='alert alert-warning'>No se encontraron registros.</div>";
    }
    
        // $html .= "<div class='row-fluid'>";
        // $html .= "<form class='form-horizontal'>";
        // $html .= "<div class='control-group row-fluid'>";
        // $html .= "<label class='control-label span2'><strong>Desde<strong></label>";
        // $html .= "<div class='controls span6'>";
        // $html .= "<input class='span6' type='date' name='fecha1' required>";
        // $html .= "</div>";
        // $html .= "</div>";
        // $html .= "<div class='row-fluid'>";
        // $html .= "<form class='form-horizontal'>";
        // $html .= "<div class='control-group row-fluid'>";
        // $html .= "<label class='control-label span2'><strong>Hasta<strong></label>";
        // $html .= "<div class='controls span6'>";
        // $html .= "<input class='span6' type='date' name='fecha2' required>";
        // $html .= "</div>";
        // $html .= "</div>";

        echo $html;
}

function _cargamuestraAction(){
    $area = new Area();
    $areas = $area->listararea();
    $html ="<form>";
    if ($areas) {
        $html .= "<div class='row-fluid'>";
        $html .= "<form class='form-horizontal'>";
        $html .= "<div class='control-group row-fluid'>";
        $html .= "<label class='control-label span2'><strong>Area<strong></label>";
        $html .= "<div class='controls span6'>";
        $html .= "<select class='span6' name='area' id='area' required>";
        $html .= '<option value="">Seleccione Area</option>';
        foreach ($areas as $area) {
            $html .= "<option value='" . $area->id_area . "'>$area->descr_area</option>";
        }
        $html .= "</select>";
        $html .= "</div>";
        $html .= "</div>";
    }else{
        $html .= "<div class='alert alert-warning'>No se encontraron registros.</div>";
    }
        $html .="<label class='control-label span2'><strong>Muestra</strong></label>";
        $html .= "<div class='controls span6'>";
        $html .="<select class='span6' name='muestra' id='muestra' disabled='disabled'  required>";
        $html .="<option value=''>Selecione una Muestra</option>";
        $html .="</select>";
        $html .= "</div>";
        $html .= "</div><br>";

        // $html .= "<div class='row-fluid'>";
        // $html .= "<form class='form-horizontal'>";
        // $html .= "<div class='control-group row-fluid'>";
        // $html .= "<label class='control-label span2'><strong>Desde<strong></label>";
        // $html .= "<div class='controls span6'>";
        // $html .= "<input class='span6' type='date' name='fecha1' required>";
        // $html .= "</div>";
        // $html .= "</div>";
        // $html .= "<div class='row-fluid'>";
        // $html .= "<form class='form-horizontal'>";
        // $html .= "<div class='control-group row-fluid'>";
        // $html .= "<label class='control-label span2'><strong>Hasta<strong></label>";
        // $html .= "<div class='controls span6'>";
        // $html .= "<input class='span6' type='date' name='fecha2' required>";
        // $html .= "</div>";
        // $html .= "</div>";
        // $html .= "</form>";

        echo $html;

}

function _carga2fechasAction(){
    $area = new Area();
    $areas = $area->listararea();
    $html ="<form>";
    if ($areas) {
        $html .= "<div class='row-fluid'>";
        $html .= "<form class='form-horizontal'>";
        $html .= "<div class='control-group row-fluid'>";
        $html .= "<label class='control-label span2'><strong>Area<strong></label>";
        $html .= "<div class='controls span6'>";
        $html .= "<select class='span6' name='area' id='area' required>";
        $html .= '<option value="">Seleccione Area</option>';
        $html .= '<option value="All">TODAS</option>';
        foreach ($areas as $area) {
            $html .= "<option value='" . $area->id_area . "'>$area->descr_area</option>";
        }
        $html .= "</select>";
        $html .= "</div>";
        $html .= "</div>";
    }else{
        $html .= "<div class='alert alert-warning'>No se encontraron registros.</div>";
    }
        // $html .= "<div class='row-fluid'>";
        // $html .= "<form class='form-horizontal'>";
        // $html .= "<div class='control-group row-fluid'>";
        // $html .= "<label class='control-label span2'><strong>Desde<strong></label>";
        // $html .= "<div class='controls span6'>";
        // $html .= "<input class='span6' type='date' name='fecha1' required>";
        // $html .= "</div>";
        // $html .= "</div>";
        // $html .= "<div class='row-fluid'>";
        // $html .= "<form class='form-horizontal'>";
        // $html .= "<div class='control-group row-fluid'>";
        // $html .= "<label class='control-label span2'><strong>Hasta<strong></label>";
        // $html .= "<div class='controls span6'>";
        // $html .= "<input class='span6' type='date' name='fecha2' required>";
        // $html .= "</div>";
        // $html .= "</div>";
        // $html .= "</form>";  

        echo $html;
}

function _cargamesAction(){
        $html .= "<div class='row-fluid'>";
        $html .= "<form class='form-horizontal'>";
        $html .= "<div class='control-group row-fluid'>";
        $html .= "<label class='control-label span2'><strong>Fecha<strong></label>";
        $html .= "<div class='controls span6'>";
        $html .= "<input class='span6' type='month' name='nombremes' required>";
        $html .= "</div>";
        $html .= "</div>";
        $html .= "<div class='control-group row-fluid'>";
        $html .= "<label class='control-label span2'><strong>Formato</strong></label>";
        $html .= "<div class='controls span6'>";
        $html .= "<select class='span6' name='formato' required>
                 <option value='1'>PDF</option>
                 <option value='2'>EXCEL</option>
                 </select>";
        $html .= "</div>";

        echo $html;

}

function _cargamaterialAction(){
    $area = new Area();
    $areas = $area->list2area();  
    $html ="<form>";
    if ($areas) {
        $html .= "<div class='row-fluid'>";
        $html .= "<form class='form-horizontal'>";
        $html .= "<div class='control-group row-fluid'>";
        $html .= "<label class='control-label span2'><strong>Area<strong></label>";
        $html .= "<div class='controls span6'>";
        $html .= "<select class='span6' name='area' id='area' required>";
        $html .= '<option value="">Seleccione Area</option>';
        $html .= '<option value="All">TODAS</option>';
        foreach ($areas as $area) {
            $html .= "<option value='" . $area->id_area . "'>$area->descr_area</option>";
        }
        $html .= "</select>";
        $html .= "</div>";
        $html .= "</div>";
    }else{
        $html .= "<div class='alert alert-warning'>No se encontraron registros.</div>";
    }
        // $html .= "<div class='row-fluid'>";
        // $html .= "<form class='form-horizontal'>";
        // $html .= "<div class='control-group row-fluid'>";
        // $html .= "<label class='control-label span2'><strong>Desde<strong></label>";
        // $html .= "<div class='controls span6'>";
        // $html .= "<input class='span6' type='date' name='fecha1' required>";
        // $html .= "</div>";
        // $html .= "</div>";
        // $html .= "<div class='row-fluid'>";
        // $html .= "<form class='form-horizontal'>";
        // $html .= "<div class='control-group row-fluid'>";
        // $html .= "<label class='control-label span2'><strong>Hasta<strong></label>";
        // $html .= "<div class='controls span6'>";
        // $html .= "<input class='span6' type='date' name='fecha2' required>";
        // $html .= "</div>";
        // $html .= "</div>";
        // $html .= "</form>";  

        echo $html;
}

function _cargapersonalAction(){
    $grupo = new Informes();
    $grupos = $grupo->listagrupos();

        $html ="<form>";
        if ($grupos) {
            $html .= "<div class='row-fluid'>";
            $html .= "<form class='form-horizontal'>";
            $html .= "<div class='control-group row-fluid'>";
            $html .= "<label class='control-label span2'><strong>Grupo Ocupacional<strong></label>";
            $html .= "<div class='controls span10'>";
            $html .= "<select class='span6' name='grupos' id='grupos' required '>";

            
            if (count($grupos)){
                                    $html .="<option value=''>Selecione un Grupo</option>";
                                    foreach ($grupos as $grupo){
                                        $html .="<option value='". $grupo->goc_id ."'>$grupo->goc_descripcion</option>";
                                    }
                                }else { 
                                    $html .="<option value=-1> No existen registros </option>"; 
                                
                            }

            $html .= "</select>";
            $html .= "</div>";
            $html .= "</div>";
        } else {
            $html .= "<div class='alert alert-warning'>No se encontraron registros.</div>";
                        
            // echo $html;
        }

        $html .="<label class='control-label span2'><strong>Empleado</strong></label>";
        $html .= "<div class='controls span10'>";
        $html .="<select class='span6' name='empleado' id='empleado' disabled='disabled'  required>";
        $html .="<option value=''>Selecione un empleado</option>";
        $html .="</select>";
        $html .= "</div>";
        $html .= "</div><br>";

        $html .= "<div class='row-fluid'>";
        $html .= "<form class='form-horizontal'>";
        $html .= "<div class='control-group row-fluid'>";
        $html .= "<label class='control-label span2'><strong>Fecha</strong></label>";
        $html .= "<div class='controls span6'>";
        $html .= "<input class='span6' type='month' name='nommes' required>";
        $html .= "</div>";
        $html .= "</div>";
        $html .= "</form>";
        //$html.="<script type='text/javascript' src='view/js/dependencias.js'></script>";
        echo $html;
}

function _mostrarinformeAction(){
    
    $opc = $_POST["cmbselect"];

    switch ($opc) {
        case 1:
            $area = $_POST["area"];
            $fecha = $_POST["mes"];

            $fecha = explode("-", $fecha);
            $fecha_mes = $fecha[1];
            $fecha_anio = $fecha[0];
            $fecha_dia = $fecha[2];
            $inf=new Informes();
            if ($area=='All') {
              $partepq=$inf->partedpq($fecha_dia,$fecha_mes,$fecha_anio);
              $partece=$inf->partedce($fecha_dia,$fecha_mes,$fecha_anio);
              $parteccv=$inf->partedccv($fecha_dia,$fecha_mes,$fecha_anio);
              $parteih=$inf->partedih($fecha_dia,$fecha_mes,$fecha_anio);
              require 'view/informes/parte-general.php';
            } else {
              $nombres=$inf->nomarea($area);  
              $parte=$inf->partediario($area,$fecha_dia,$fecha_mes,$fecha_anio);
              require 'view/informes/parte-diario.php';  
            }
            break;
        case 2:
            $area = $_POST["area"];
            $servicio=$_POST["servicio"];
            $inf=new Informes();
            $nombres=$inf->nomarea($area);
            $ser=$inf->nomser($servicio); 
            $fecha1 = $_POST["fecha1"]; 
            $fecha2 = $_POST["fecha2"];
            $fechas1 = explode("-", $fecha1);
            $fecha1_mes = $fechas1[1];
            $fecha1_anio = $fechas1[0];
            $fecha1_dia=$fechas1[2];
            $fechas2 = explode("-", $fecha2);
            $fecha2_mes = $fechas2[1];
            $fecha2_anio = $fechas2[0];
            $fecha2_dia=$fechas2[2];
            $nbservicio=$inf->bioservicio($servicio,$area,$fecha1,$fecha2);
            require 'view/informes/bioservicio.php';
            break;
        case 3:
            $area = $_POST["area"];
            $muestra=$_POST["muestra"];
            $obt=new Informes();
            $nombres=$obt->nomarea($area);
            $nombrem=$obt->nommue($muestra);
            $fecha1 = $_POST["fecha1"]; 
            $fecha2 = $_POST["fecha2"];
            $fechas1 = explode("-", $fecha1);
            $fecha1_mes = $fechas1[1];
            $fecha1_anio = $fechas1[0];
            $fecha1_dia=$fechas1[2];
            $fechas2 = explode("-", $fecha2);
            $fecha2_mes = $fechas2[1];
            $fecha2_anio = $fechas2[0];
            $fecha2_dia=$fechas2[2];
            if ($area!=3) {
                $nbmuestra=$obt->biomuestra($area,$fecha1,$fecha2,$muestra);
            } else {
                $nbmuestra=$obt->biocvmuestra($area,$fecha1,$fecha2,$muestra);
            }
            
            require 'view/informes/biomuestra.php';
            break;
        case 5:
            $area = $_POST["area"];
            $obt=new Informes();
            $fecha1 = $_POST["fecha1"]; 
            $fecha2 = $_POST["fecha2"];
            $fecha1 = $_POST["fecha1"]; 
            $fecha2 = $_POST["fecha2"];
            $fechas1 = explode("-", $fecha1);
            $fecha1_mes = $fechas1[1];
            $fecha1_anio = $fechas1[0];
            $fecha1_dia=$fechas1[2];
            $fechas2 = explode("-", $fecha2);
            $fecha2_mes = $fechas2[1];
            $fecha2_anio = $fechas2[0];
            $fecha2_dia=$fechas2[2];
            switch ($area) {
                case 1:
                    $nombres=$obt->nomarea($area);
                    $b2=$obt->bio2pq($area,$fecha1,$fecha2);
                    require 'view/informes/bio2fechas.php';
                    break;
                case 2:
                    $nombres=$obt->nomarea($area);
                    $b2=$obt->bio2ce($area,$fecha1,$fecha2);
                    require 'view/informes/bio2fechas.php';
                    break;
                case 3:
                    $nombres=$obt->nomarea($area);
                    $b2=$obt->bio2ccv($area,$fecha1,$fecha2);
                    require 'view/informes/bio2fechas.php';
                    break;
                case 4:
                    $nombres=$obt->nomarea($area);
                    $b2=$obt->bio2ih($area,$fecha1,$fecha2);
                    //falta colocar las derivadas por PQ y CE
                    require 'view/informes/bio2fechas.php';
                    break;
                case 'All':
                    $bpq=$obt->biopsia2pq($fecha1,$fecha2);
                    $bce=$obt->biopsia2ce($fecha1,$fecha2);
                    $bccv=$obt->biopsia2ccv($fecha1,$fecha2);
                    $bih=$obt->biopsia2ih($fecha1,$fecha2);
                    $bpqih=$obt->biomqih2($fecha1,$fecha2);
                    $bceih=$obt->bioceih2($fecha1,$fecha2);
                    require 'view/informes/bio2todos.php';
                    break;
            }
            break;
        case 6:
            //$area = $_POST["area"];
            $obt=new Informes();
            //$nombres=$obt->nomarea($area);
            $fecha=$_POST["nombremes"];
            $frt=$_POST["formato"];
            list($año, $mes) = explode("-",$fecha);

            /*switch ($area) {
                case 1:
                    $total=$obt->biompq($mes,$año);
                    require 'view/informes/biomensual.php';
                    break;
                case 2:
                    $total=$obt->biomce($mes,$año);
                    require 'view/informes/biomensual.php';
                    break;
                case 3:
                    $total=$obt->biomccv($mes,$año);
                    require 'view/informes/biomensual.php';
                    break;
                case 4:
                    $total=$obt->biomih($mes,$año);
                    $totalpq=$obt->biompqih($mes,$año);
                    $totalce=$obt->biomceih($mes,$año);
                    require 'view/informes/bioihmensual.php';
                    break;
                default:
                    # code...
                    break;
            }*/
              $cantidades=$obt->reporte_calidad($mes,$año);
              $procedencias=$obt->reporte_calidad_procedencia($mes,$año);
            if ($frt==1) {
               require 'view/informes/reporte-examenesproced.php';
            } else {
               require 'view/informes/reporte-examenesexcel.php';
            }
           
            break;
        case 7:
            $area = $_POST["area"];
            $obt=new Informes();
            $fecha1 = $_POST["fecha1"]; 
            $fecha2 = $_POST["fecha2"];
            $fechas1 = explode("-", $fecha1);
            $fecha1_mes = $fechas1[1];
            $fecha1_anio = $fechas1[0];
            $fecha1_dia=$fechas1[2];
            $fechas2 = explode("-", $fecha2);
            $fecha2_mes = $fechas2[1];
            $fecha2_anio = $fechas2[0];
            $fecha2_dia=$fechas2[2];
            switch ($area) {
                case 1:
                    $nombres=$obt->nomarea($area);
                    $totalm=$obt->matpq($fecha1,$fecha2);
                    require 'view/informes/biomat.php';
                    break;
                case 2:
                    $nombres=$obt->nomarea($area);
                    $totalm=$obt->matce($fecha1,$fecha2);
                    require 'view/informes/biomat.php';
                    break;
                case 'All':
                    $totaltodos=$obt->matodos($fecha1,$fecha2);
                    require 'view/informes/biomatodos.php';
                    break;
                
            }

            break;
        case 8:
            $grupos=$_POST["grupos"];
            $empleado=$_POST["empleado"];
            $obt=new Informes();
            $nomper=$obt->nomep($empleado);
            $fecha=$_POST["nommes"];
            list($año, $mes) = explode("-",$fecha);
            if ($grupos==1) {
                $produccion=$obt->producpat($empleado,$mes,$año);
            } else {
                $produccion=$obt->productec($empleado,$mes,$año);
            }
                       
            require 'view/informes/biopersonal.php';
            break;
        case 9:
            $obt=new Informes();
            $fecha1 = $_POST["fecha1"]; 
            $fecha2 = $_POST["fecha2"];
            $fechas1 = explode("-", $fecha1);
            $fecha1_mes = $fechas1[1];
            $fecha1_anio = $fechas1[0];
            $fecha1_dia=$fechas1[2];
            $fechas2 = explode("-", $fecha2);
            $fecha2_mes = $fechas2[1];
            $fecha2_anio = $fechas2[0];
            $fecha2_dia=$fechas2[2];
            $infototcancer=$obt->infocanceroncologia($fecha1,$fecha2);

            require 'view/informes/infocanceronco.php';
            break;
        case 10:
            $obt=new Informes();
            $fecha1 = $_POST["fecha1"]; 
            $fecha2 = $_POST["fecha2"];
            $fechas1 = explode("-", $fecha1);
            $fecha1_mes = $fechas1[1];
            $fecha1_anio = $fechas1[0];
            $fecha1_dia=$fechas1[2];
            $fechas2 = explode("-", $fecha2);
            $fecha2_mes = $fechas2[1];
            $fecha2_anio = $fechas2[0];
            $fecha2_dia=$fechas2[2];
            $infoneopla=$obt->infodisplaoncologia($fecha1,$fecha2);
            require 'view/informes/infodisplaonco.php';
            break;
        case 11:
            $obt=new Informes();
            $fecha1 = $_POST["fecha1"]; 
            $fecha2 = $_POST["fecha2"];
            $fechas1 = explode("-", $fecha1);
            $fecha1_mes = $fechas1[1];
            $fecha1_anio = $fechas1[0];
            $fecha1_dia=$fechas1[2];
            $fechas2 = explode("-", $fecha2);
            $fecha2_mes = $fechas2[1];
            $fecha2_anio = $fechas2[0];
            $fecha2_dia=$fechas2[2];
            $ponderados=$obt->promediotiempo($fecha1,$fecha2);
            require 'view/informes/ponderado.php';
            break;
        case 12:
            $obt=new Informes();
            $fecha1 = $_POST["fecha1"]; 
            $fecha2 = $_POST["fecha2"];
            $fechas1 = explode("-", $fecha1);
            $fecha1_mes = $fechas1[1];
            $fecha1_anio = $fechas1[0];
            $fecha1_dia=$fechas1[2];
            $fechas2 = explode("-", $fecha2);
            $fecha2_mes = $fechas2[1];
            $fecha2_anio = $fechas2[0];
            $fecha2_dia=$fechas2[2];

            $indicesp=$obt->indice_precision($fecha1,$fecha2);

            require 'view/informes/indiceprecision.php';
            break;
        default:
            # code...
            break;
    }
   
}

function _mostrarestadisticaAction(){
    $opc = $_POST["cmb01"];

    switch ($opc) {
        case 1:
            $area = $_POST["area"]; //recibe el id_area q esta en el combo
            $esta=new Estadistica();
            $fecha1 = $_POST["fecha1"]; 
            $fecha2 = $_POST["fecha2"];
            $fechas1 = explode("-", $fecha1);
            $fecha1_mes = $fechas1[1];
            $fecha1_anio = $fechas1[0];
            $fecha1_dia=$fechas1[2];
            $fechas2 = explode("-", $fecha2);
            $fecha2_mes = $fechas2[1];
            $fecha2_anio = $fechas2[0];
            $fecha2_dia=$fechas2[2];
            $obt=new Informes();
            $nombres=$obt->nomarea($area);
            if ($fecha1_anio<$fecha2_anio) {
                $pacientes=$esta->biomescaso1($area,$fecha1,$fecha2,$fecha1_mes,$fecha2_mes);
            } else {
                $pacientes=$esta->biomescaso2($area,$fecha1,$fecha2,$fecha1_mes,$fecha2_mes);
            }
            foreach ($pacientes as $key) {
                $numpac[]=$key->num_pac_atend;
                $meses[]=$key->abr;
                $numexa[]=$key->total_examenes;
            }
            
            require 'view/estadisticas/estadistica_mes.php';
            break;
        case 2:
            $area = $_POST["area"];
            $esta=new Estadistica();
            $fecha1 = $_POST["fecha1"]; 
            $fecha2 = $_POST["fecha2"];
            $fechas1 = explode("-", $fecha1);
            $fecha1_mes = $fechas1[1];
            $fecha1_anio = $fechas1[0];
            $fecha1_dia=$fechas1[2];
            $fechas2 = explode("-", $fecha2);
            $fecha2_mes = $fechas2[1];
            $fecha2_anio = $fechas2[0];
            $fecha2_dia=$fechas2[2];
            $obt=new Informes();
            $nombres=$obt->nomarea($area);
             $edades=$esta->edadarea($area,$fecha1,$fecha2);
             foreach ($edades as $key) {
                $edads[]=$key->edad;
                $totaled[]=$key->total;
             }
            require 'view/estadisticas/estadistica_edad.php';
            break;
        case 3:
            $area = $_POST["area"];
            $esta=new Estadistica();
            $fecha1 = $_POST["fecha1"]; 
            $fecha2 = $_POST["fecha2"];
            $fechas1 = explode("-", $fecha1);
            $fecha1_mes = $fechas1[1];
            $fecha1_anio = $fechas1[0];
            $fecha1_dia=$fechas1[2];
            $fechas2 = explode("-", $fecha2);
            $fecha2_mes = $fechas2[1];
            $fecha2_anio = $fechas2[0];
            $fecha2_dia=$fechas2[2];
            $obt=new Informes();
            $nombres=$obt->nomarea($area);
            $numeros=$esta->generoarea($area,$fecha1,$fecha2);
            foreach ($numeros as $key) {
                $generos[]=$key->genero;
                $tcant[]=$key->total;
            }
            require 'view/estadisticas/estadistica_sexo.php';
            break;
        case 4:
            $area = $_POST["area"];
            $esta=new Estadistica();
            $fecha1 = $_POST["fecha1"]; 
            $fecha2 = $_POST["fecha2"];
            $fechas1 = explode("-", $fecha1);
            $fecha1_mes = $fechas1[1];
            $fecha1_anio = $fechas1[0];
            $fecha1_dia=$fechas1[2];
            $fechas2 = explode("-", $fecha2);
            $fecha2_mes = $fechas2[1];
            $fecha2_anio = $fechas2[0];
            $fecha2_dia=$fechas2[2];
            $obt=new Informes();
            $nombres=$obt->nomarea($area);
            $servicios=$esta->serviciohrl($area,$fecha1,$fecha2);
            foreach ($servicios as $key) {
               $dependencias[]=$key->dep_id;
               $cant[]=$key->total_bio;
            }
            require 'view/estadisticas/estadistica_servicio.php';
            break;
        case 5:
            $area = $_POST["area"];
            $esta=new Estadistica();
            $fecha1 = $_POST["fecha1"]; 
            $fecha2 = $_POST["fecha2"];
            $fechas1 = explode("-", $fecha1);
            $fecha1_mes = $fechas1[1];
            $fecha1_anio = $fechas1[0];
            $fecha1_dia=$fechas1[2];
            $fechas2 = explode("-", $fecha2);
            $fecha2_mes = $fechas2[1];
            $fecha2_anio = $fechas2[0];
            $fecha2_dia=$fechas2[2];
            $obt=new Informes();
            $nombres=$obt->nomarea($area);
            $instituciones=$esta->institucion($area,$fecha1,$fecha2);
            foreach ($instituciones as $key ) {
                $inst[]=$key->id_inst;
                $cont[]=$key->total_bio;
            }
            require 'view/estadisticas/estadistica_institucion.php';
            break;
        case 6:
            $esta=new Estadistica();
            $fecha1 = $_POST["fecha1"]; 
            $fecha2 = $_POST["fecha2"];
            $fechas1 = explode("-", $fecha1);
            $fecha1_mes = $fechas1[1];
            $fecha1_anio = $fechas1[0];
            $fecha1_dia=$fechas1[2];
            $fechas2 = explode("-", $fecha2);
            $fecha2_mes = $fechas2[1];
            $fecha2_anio = $fechas2[0];
            $fecha2_dia=$fechas2[2];
            $ubicaciones=$esta->cancerporubicacion($fecha1,$fecha2);
            foreach ($ubicaciones as $key) {
                $descripcion[]=$key->abr;
                $totales[]=$key->total;
            }
            require 'view/estadisticas/estadistica_ubicacion.php';
            break;
        case 7:
            $esta=new Estadistica();
            $fecha1 = $_POST["fecha1"]; 
            $fecha2 = $_POST["fecha2"];
            $fechas1 = explode("-", $fecha1);
            $fecha1_mes = $fechas1[1];
            $fecha1_anio = $fechas1[0];
            $fecha1_dia=$fechas1[2];
            $fechas2 = explode("-", $fecha2);
            $fecha2_mes = $fechas2[1];
            $fecha2_anio = $fechas2[0];
            $fecha2_dia=$fechas2[2];
            $displasias=$esta->displasiaporubicacion($fecha1,$fecha2);
            foreach ($displasias as $key) {
                $descripciones[]=$key->abr;
                $totald[]=$key->total;
            }
            require 'view/estadisticas/displasia_ubicacion.php';
            break;
        case 8:
            $esta=new Estadistica();
            $fecha1 = $_POST["fecha1"]; 
            $fecha2 = $_POST["fecha2"];
            $fechas1 = explode("-", $fecha1);
            $fecha1_mes = $fechas1[1];
            $fecha1_anio = $fechas1[0];
            $fecha1_dia=$fechas1[2];
            $fechas2 = explode("-", $fecha2);
            $fecha2_mes = $fechas2[1];
            $fecha2_anio = $fechas2[0];
            $fecha2_dia=$fechas2[2];
            $tipos=$esta->tipoestudio($fecha1,$fecha2);
            foreach ($tipos as $key ) {
                $tipose[]=$key->tipo;
                $tot[]=$key->total;
            }
            require 'view/estadisticas/estadistica_tipoestudio.php';
            break;
        case 9:
            $esta=new Estadistica();
            $fecha1 = $_POST["fecha1"]; 
            $fecha2 = $_POST["fecha2"];
            $fechas1 = explode("-", $fecha1);
            $fecha1_mes = $fechas1[1];
            $fecha1_anio = $fechas1[0];
            $fecha1_dia=$fechas1[2];
            $fechas2 = explode("-", $fecha2);
            $fecha2_mes = $fechas2[1];
            $fecha2_anio = $fechas2[0];
            $fecha2_dia=$fechas2[2];
            $biocongela=$esta->congelacion($fecha1,$fecha2);
            foreach ($biocongela as $key ) {
                $congelacion[]=$key->estado;
                $ntot[]=$key->total;
            }

            require 'view/estadisticas/estadistica_congelacion.php';
            break;
//hecho
        case 10:
            $esta=new Estadistica();
            $fecha1 = $_POST["fecha1"]; 
            $fecha2 = $_POST["fecha2"];
            $fechas1 = explode("-", $fecha1);
            $fecha1_mes = $fechas1[1];
            $fecha1_anio = $fechas1[0];
            $fecha1_dia=$fechas1[2];
            $fechas2 = explode("-", $fecha2);
            $fecha2_mes = $fechas2[1];
            $fecha2_anio = $fechas2[0];
            $fecha2_dia=$fechas2[2];
            $laminastacos=$esta->laminastacospatologia($fecha1_anio."-".$fecha1_mes."-".$fecha1_dia,$fecha2_anio."-".$fecha2_mes."-".$fecha2_dia);
            require 'view/estadisticas/estadisticas_laminastacospatologia.php';


            break;
        case 11:
            $esta=new Estadistica();
            $fecha1 = $_POST["fecha1"]; 
            $fecha2 = $_POST["fecha2"];
            $fechas1 = explode("-", $fecha1);
            $fecha1_mes = $fechas1[1];
            $fecha1_anio = $fechas1[0];
            $fecha1_dia=$fechas1[2];
            $fechas2 = explode("-", $fecha2);
            $fecha2_mes = $fechas2[1];
            $fecha2_anio = $fechas2[0];
            $fecha2_dia=$fechas2[2];
            if ($fecha1_anio<$fecha2_anio) {
                $cromatinas=$esta->cromacaso1($fecha1,$fecha2,$fecha1_mes,$fecha2_mes);
            } else {
                $cromatinas=$esta->cromacaso2($fecha1,$fecha2,$fecha1_mes,$fecha2_mes);
            }
            foreach ($cromatinas as $key) {
                $tiempos[]=$key->abr_mes;
                $tot[]=$key->total;
            }
            require 'view/estadisticas/estadisticas_cromatina.php';

            break;
        case 12:
            $esta=new Estadistica();
            $fecha1 = $_POST["fecha1"]; 
            $fecha2 = $_POST["fecha2"];
            $fechas1 = explode("-", $fecha1);
            $fecha1_mes = $fechas1[1];
            $fecha1_anio = $fechas1[0];
            $fecha1_dia=$fechas1[2];
            $fechas2 = explode("-", $fecha2);
            $fecha2_mes = $fechas2[1];
            $fecha2_anio = $fechas2[0];
            $fecha2_dia=$fechas2[2];
            $diferentes=$esta->diferentecroma($fecha1,$fecha2);
            foreach ($diferentes as $key ) {
                $ct[]=$key->total;
                $ncroma[]=$key->codigo;
            }
            require 'view/estadisticas/estadistica_difcroma.php';
            break;
// hecho
        case 13:
            $esta=new Estadistica();
            $fecha1 = $_POST["fecha1"]; 
            $fecha2 = $_POST["fecha2"];
            $fechas1 = explode("-", $fecha1);
            $fecha1_mes = $fechas1[1];
            $fecha1_anio = $fechas1[0];
            $fecha1_dia=$fechas1[2];
            $fechas2 = explode("-", $fecha2);
            $fecha2_mes = $fechas2[1];
            $fecha2_anio = $fechas2[0];
            $fecha2_dia=$fechas2[2];
            $laminastacos=$esta->laminastacoscitologia($fecha1_anio."-".$fecha1_mes."-".$fecha1_dia,$fecha2_anio."-".$fecha2_mes."-".$fecha2_dia);
            require 'view/estadisticas/estadisticas_laminastacoscitologia.php';

            break;
        case 14:
            $esta=new Estadistica();
            $fecha1 = $_POST["fecha1"]; 
            $fecha2 = $_POST["fecha2"];
            $fechas1 = explode("-", $fecha1);
            $fecha1_mes = $fechas1[1];
            $fecha1_anio = $fechas1[0];
            $fecha1_dia=$fechas1[2];
            $fechas2 = explode("-", $fecha2);
            $fecha2_mes = $fechas2[1];
            $fecha2_anio = $fechas2[0];
            $fecha2_dia=$fechas2[2];
            $diagnosticos=$esta->diagnosticoccv($fecha1,$fecha2);
            foreach ($diagnosticos as $key) {
                $ncant[]=$key->total;
                $nombres[]=$key->abr;
            }

            require 'view/estadisticas/estadistica_diag.php';
            break;
// hecho
        case 15:
            $esta=new Estadistica();
            $fecha1 = $_POST["fecha1"]; 
            $fecha2 = $_POST["fecha2"];
            $fechas1 = explode("-", $fecha1);
            $fecha1_mes = $fechas1[1];
            $fecha1_anio = $fechas1[0];
            $fecha1_dia=$fechas1[2];
            $fechas2 = explode("-", $fecha2);
            $fecha2_mes = $fechas2[1];
            $fecha2_anio = $fechas2[0];
            $fecha2_dia=$fechas2[2];
            $laminas=$esta->laminascitologiacv($fecha1_anio."-".$fecha1_mes."-".$fecha1_dia,$fecha2_anio."-".$fecha2_mes."-".$fecha2_dia);
            require 'view/estadisticas/estadisticas_laminascitologiacv.php';
            break;
        case 16:
            $esta=new Estadistica();
            $fecha1 = $_POST["fecha1"]; 
            $fecha2 = $_POST["fecha2"];
            $fechas1 = explode("-", $fecha1);
            $fecha1_mes = $fechas1[1];
            $fecha1_anio = $fechas1[0];
            $fecha1_dia=$fechas1[2];
            $fechas2 = explode("-", $fecha2);
            $fecha2_mes = $fechas2[1];
            $fecha2_anio = $fechas2[0];
            $fecha2_dia=$fechas2[2];
            $marcadores=$esta->marcadores($fecha1,$fecha2);
            foreach ($marcadores as $key) {
                $nome[]=$key->codigo;
                $tm[]=$key->total;
            }
            require 'view/estadisticas/estadisticas_marcador.php';

            break; 

// editar
        case 17:
            $esta=new Estadistica();
            $fecha1 = $_POST["fecha1"]; 
            $fecha2 = $_POST["fecha2"];
            $fechas1 = explode("-", $fecha1);
            $fecha1_mes = $fechas1[1];
            $fecha1_anio = $fechas1[0];
            $fecha1_dia=$fechas1[2];
            $fechas2 = explode("-", $fecha2);
            $fecha2_mes = $fechas2[1];
            $fecha2_anio = $fechas2[0];
            $fecha2_dia=$fechas2[2];
            $nmarcadores=$esta->numeromarcadores($fecha1_anio."-".$fecha1_mes."-".$fecha1_dia,$fecha2_anio."-".$fecha2_mes."-".$fecha2_dia);
            require 'view/estadisticas/estadisticas_nmarcadores.php';
            break;

        case 18:
            $esta=new Estadistica();
            $fecha1 = $_POST["fecha1"]; 
            $fecha2 = $_POST["fecha2"];
            $fechas1 = explode("-", $fecha1);
            $fecha1_mes = $fechas1[1];
            $fecha1_anio = $fechas1[0];
            $fecha1_dia=$fechas1[2];
            $fechas2 = explode("-", $fecha2);
            $fecha2_mes = $fechas2[1];
            $fecha2_anio = $fechas2[0];
            $fecha2_dia=$fechas2[2];
            $tipos=$esta->tipoestudio($fecha1,$fecha2);
            foreach ($tipos as $key ) {
                $tipose[]=$key->tipo;
                $tot[]=$key->total;
            }
            require 'view/estadisticas/estadistica_procedencia.php';
            break;
            
        default:
            # code...
            break;
    }
}

function _ajaxGetEmpleadoAction(){
    $grupo = $_POST['grupos'];    

    $ogrupo = new Informes();

    $empleados = $ogrupo->listaempleados($grupo);

    if (count($empleados)): ?>
        <option value=''>Selecione un empleado</option>
        <?php foreach ($empleados as $empl): ?>
            <option value="<?php echo $empl->emp_id ?>">
                <?php echo $empl->empleado; ?>
            </option>
        <?php endforeach; ?>
    <?php else : ?>
        <? echo '<option value=-1> No existen registros </option>'; ?>
    <?php endif; ?>
<?php } ?>
<?php   


function _ajaxGetMuestraAction(){

    $area = $_POST['area'];    

    $oMuestra = new Informes();

    $muestras = $oMuestra->obtmuestra($area);

    if (count($muestras)): ?>
        <option value=''>Selecione una Muestra</option>
        <?php foreach ($muestras as $muestra): ?>
            <option value="<?php echo $muestra->id_muestra ?>">
                <?php echo $muestra->muestra; ?>
            </option>
        <?php endforeach; ?>
    <?php else : ?>
        <? echo '<option value=-1> No existen registros </option>'; ?>
    <?php endif; ?>
<?php } ?>
<?php


?>