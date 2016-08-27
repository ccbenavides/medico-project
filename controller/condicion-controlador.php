<?php 

require 'model/clases/condicion.php';

session_start();

function _ajaxcondicionAction(){
    $idestadoe = $_POST['idestadoe'];
    $condicion = new Condicion();
    if ($idestadoe == 1) {
        $listadocondicion = $condicion->condiciones(); 
    } else {
        $idestadoe1 = 1;
        $idestadoe2 = 3;
        $listadocondicion = $condicion->condicionxestado($idestadoe1, $idestadoe2);  
    }
        $html = '<option value="-1">- - Condicion Egreso - -</option>'; 
    foreach ($listadocondicion as $lcondicion) {
        $html .= '<option value='.$lcondicion->idcondicionegreso.'>'.$lcondicion->desc_condicionegreso.'</option>';    
    }
echo $html;
    
}

function _ajaxtransferidoAction(){
    $idcondicion = $_POST['idcondicion'];
    $condicion = new Condicion();

    if ($idcondicion == 2) {
        
        $lservicios = $condicion->lservicios(); 
        $html = '<option value="-1">- - Servicios - -</option>'; 
        foreach ($lservicios as $lservicio) {
        $html .= '<option value='.$lservicio->idservicio.'>'.$lservicio->nom_servicio.'</option>';    
        }
    }

    echo $html;

}

function _ajaxespecialidadAction(){
    $idservtransf = $_POST['idservtransf'];
    $condicion = new Condicion();
        
        $lespecialidades = $condicion->lespecxidserv($idservtransf); 
        $html = '<option value="-1">- - Especialidades - -</option>'; 
        foreach ($lespecialidades as $lespecialidad) {
        $html .= '<option value='.$lespecialidad->id_especialidad.'>'.$lespecialidad->descripcion.'</option>';    
        }
    echo $html;

}
