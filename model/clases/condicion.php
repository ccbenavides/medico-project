<?php

require_once 'conexion.php';

class Condicion {

    private $objPdo;

    public function __construct() {

        $this->objPdo = new Conexion();
    }

    public function condiciones(){
    $stmt=$this->objPdo->prepare('SELECT * from sishosp.condicion_egreso');
    $stmt->execute();
    $lcondiciones = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $lcondiciones;
    }


    public function condicionxestado($idestadoe1, $idestadoe2){
    $stmt=$this->objPdo->prepare('SELECT * from sishosp.condicion_egreso ce where ce.idcondicionegreso=:idestadoe1 or ce.idcondicionegreso= :idestadoe2');
    $stmt->execute(array('idestadoe1' => $idestadoe1, 
                        'idestadoe2' => $idestadoe2, ));
    $condiciones = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $condiciones;
    }

    public function lservicios(){
    $stmt=$this->objPdo->prepare('SELECT * from sishosp.servicios_procedencia');
    $stmt->execute();
    $lservicios = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $lservicios;
    }

    public function lespecxidserv($idserv){
    $stmt=$this->objPdo->prepare('SELECT * from sishosp.especialidad e where e.idservicio = :idserv');
    $stmt->execute(array('idserv' => $idserv ));
    $lespecs = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $lespecs;
    }


}