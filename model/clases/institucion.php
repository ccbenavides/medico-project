<?php

require_once 'conexion.php';

class Institucion{

	private $objPdo;
	private $id_inst;
	private $descr_inst;


    public function __construct($id_institucion = "", $descr_institucion = '' ) {
        $this->id_institucion = $id_institucion;
        $this->descr_institucion = $descr_institucion;
        $this->objPdo = new Conexion();
    }

     public function consultar() {
        $stmt = $this->objPdo->prepare('SELECT * FROM sisanatom.institucion ORDER BY id_inst;');
        $stmt->execute();
        $dependencias = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $dependencias;
    }
    public function codigo($id_inst){
        $stmt = $this->objPdo->prepare("SELECT id_inst from sisanatom.institucion where id_inst=:id_inst");
        $stmt->execute(array('id_inst' => $id_inst ));
        $nompac = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $nompac[0]->id_inst;
    }
    //obtener nombre de institucion por codigo
     public function obtnomxId($id){
        $stmt = $this->objPDO->prepare("SELECT descr_institucion from sisanatom.institucion where id_institucion=:id_institucion");
        $stmt->execute(array('id_institucion' => $id ));
        $nompac = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $nompac;
    }

     public function getId_Inst() {
        return $this->id_institucion;
    }

    public function setId_Inst($id_institucion) {
        $this->id_institucion = $id_institucion;
    }

    public function getdescr_Inst() {
        return $this->descr_institucion;
    }

    public function setdescr_Inst($descr_institucion) {
        $this->descr_institucion = $descr_institucion;
    }

}


?>