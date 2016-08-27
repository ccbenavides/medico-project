<?php

require_once 'conexion.php';

class CodBethesda{
	private $objPDO;
	private $id_codigo;
	private $descr_codigo;

	function __construct($id_codigo="",$descr_codigo=""){
		$this->id_codigo=$id_codigo;
		$this->descr_codigo=$descr_codigo;
		$this->objPDO = new Conexion();
	}
	//obtener lista de codigo BETHESDA 
	public function listarcodigo(){
		$stmt = $this->objPDO->prepare("SELECT * from sisanatom.codigo_bethesda order by descr_codigo");
		$stmt->execute();
		$cod = $stmt->fetchAll(PDO::FETCH_OBJ);
		return $cod;
	}

	public function getIdCod() {
        return $this->id_codigo;
    }

    public function getDesCod() {
        return $this->descr_codigo;
    }

    public function setIdCod($id_codigo) {
        $this->id_codigo= $id_codigo;
    }

    public function setDesCod($descr_codigo) {
        $this->descr_codigo = $descr_codigo;
    }

}

?>