<?php 

require 'model/clases/cie.php';

session_start();


function _ajaxgetcieAction(){
    $desc = strtoupper($_POST['desc']);
    $newdesc = '%'.$desc.'%';
    $Cie = new Cie();
    $listadocie = $Cie->listarciexdesc($newdesc);

    $response = array();

    $response = $listadocie;

    header('Content-Type: application/json');
    echo json_encode($response);
}

function _ajaxgetciexcodAction(){
    $icod = strtoupper($_POST['icod']);
    $newicod = '%'.$icod.'%';
    $Cie = new Cie();
    $listadocie = $Cie->listarciexcod($newicod);

    $response = array();

    $response = $listadocie;

    header('Content-Type: application/json');
    echo json_encode($response);
}


function _ajaxgethosprefAction(){
    $deschosp = strtoupper($_POST['deschosp']);
    $newdeschosp = '%'.$deschosp.'%';
    $Cie = new Cie();
    $listadohospref = $Cie->listarhosprefxdesc($newdeschosp);

    $response = array();

    $response = $listadohospref;

    header('Content-Type: application/json');
    echo json_encode($response);
}
