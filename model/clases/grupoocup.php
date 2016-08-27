<?php

require_once 'conexion.php';

class Grupo{
	private $objPDO;
	private $goc_id;
	private $goc_descripcion;
	private $goc_estado;
	private $usr_id;
	private $goc_fechareg;

	function __construct($goc_id="",$goc_descripcion="",$goc_estado="",$usr_id="",$goc_fechareg=""){
		$this->goc_id = $goc_id;
		$this->goc_descripcion = $goc_descripcion;
		$this->goc_estado = $goc_estado;
		$this->usr_id = $usr_id;
		$this->goc_fechareg = $goc_fechareg;
		$this->objPDO = new Conexion();
	}

	public function listadogrupos(){
        $stmt = $this->objPDO->prepare("SELECT * from grupoocup order by goc_descripcion asc");
        $stmt->execute();
        $grupo=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $grupo;
    }

     public function obtenergrupo() {
        $stmt = $this->objPDO->prepare("SELECT * from grupoocup where goc_id = ".$this->goc_id."");
        $stmt->execute();
        $grupo = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach ($grupo as $g) {
            $this->setDesGoc($g->goc_descripcion);
            
        }
        return $this;
    }

    public function getIdGoc() {
        return $this->goc_id;
    }
    public function setIdGoc($goc_id) {
        $this->goc_id = $goc_id;
    }
    public function getDesGoc() {
        return $this->goc_descripcion;
    }
    public function setDesGoc($goc_descripcion) {
        $this->goc_descripcion = $goc_descripcion;
    }
    public function getEstadoGoc() {
        return $this->goc_estado;
    }
    public function setEstadoGoc($goc_estado) {
        $this->goc_estado = $goc_estado;
    }
    public function getUserGoc() {
        return $this->usr_id;
    }
    public function setUserGoc($usr_id) {
        $this->usr_id = $usr_id;
    }
    public function getFechaGoc() {
        return $this->goc_fechareg;
    }
    public function setFechaGoc($goc_fechareg) {
        $this->goc_fechareg = $goc_fechareg;
    }

}

?>