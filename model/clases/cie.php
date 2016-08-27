<?php

require_once 'conexion.php';

class Cie {

    private $objPdo;

    public function __construct() {

        $this->objPdo = new Conexion();
    }

    public function listarciexdesc($newdesc){
        $stmt = $this->objPdo->prepare("SELECT descripcion as label, ( id_cie||'|'||codigo) as value  FROM sishosp.cie where descripcion like  :newdesc ");
        $stmt->execute(array('newdesc' => $newdesc ));
        $listcie = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $listcie;
    }

    public function listarciexcod($newicod){
        $stmt = $this->objPdo->prepare("SELECT codigo as label, ( id_cie||'|'||descripcion) as value   FROM sishosp.cie where codigo like  :newicod ");
        $stmt->execute(array('newicod' => $newicod ));
        $listciexcod = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $listciexcod;
    }

    public function listarhosprefxdesc($newdeschosp){
        $stmt = $this->objPdo->prepare("SELECT rh.nom_hospital as label, rh.idrefhospital as value from sishosp.refhospital rh where rh.nom_hospital like :newdeschosp ");
        $stmt->execute(array('newdeschosp' => $newdeschosp ));
        $listhospref = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $listhospref;
    }

}