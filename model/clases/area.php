<?php

require_once 'conexion.php';

class Area{

	private $objPDO;
	private $id_area;
	private $descr_area;
	private $id_topografia;

	function __construct($id_area="",$descr_area=""){
		$this->id_area = $id_area;
        $this->descr_area = $descr_area;
        $this->objPDO = new Conexion();
	}

	public function listararea(){
		$stmt = $this->objPDO->prepare("SELECT * from sisanatom.area order by id_area;");
		$stmt->execute();
		$area = $stmt->fetchAll(PDO::FETCH_OBJ);
		return $area;
	}

	public function list2area(){
		$stmt=$this->objPDO->prepare("SELECT * from sisanatom.area where id_area<=2 order by id_area asc;");
		$stmt->execute();
		$area2=$stmt->fetchAll(PDO::FETCH_OBJ);
		return $area2;
	}

	public function insertar(){
		$stmt = $this->objPDO->prepare("INSERT INTO sisanatom.area_top(id_area,id_topografia)values(:id_area,:id_topografia)");
		$stmt->execute(array('id_area'=>$this->id_area,
							  'id_topografia'=>$this->id_topografia));
	}

	public function buscar_Areabio($id_biopsia){
		$stmt=$this->objPDO->prepare("SELECT a.id_area FROM sisanatom.biopsia b inner join sisanatom.topografia_area ta on b.id_top=ta.id_top 
							inner join sisanatom.area a on ta.id_area=a.id_area where b.id_biopsia=:id_biopsia");
		$stmt->execute(array('id_biopsia' => $id_biopsia));
        $abio=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $abio; 
	}
	
	private function getIdTopografia(){
		return $this->id_topografia;
	}

	private function setIdTopografia($id_topografia){
		$this->$id_topografia=$id_topografia;
	}

	public function getIdArea() {
        return $this->id_area;
    }

    public function getDesArea() {
        return $this->descr_area;
    }

    public function setIdArea($id_area) {
        $this->id_area = $id_area;
    }

    public function setDesArea($descr_area) {
        $this->descr_area = $descr_area;
    }

}

?>