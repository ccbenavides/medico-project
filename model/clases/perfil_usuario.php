<?php
/**
* 
*/
require_once 'conexion.php';

class PerfilUsuario {
	private $id_perfil;
	private $descr_perfil;
	private $usr_id;

	public function __construct($id_perfil="",$descr_perfil=""){
		$this->id_perfil = $id_perfil;
		$this->descr_perfil=$descr_perfil;
		$this->objPdo = new Conexion();

	}

	public function listaperfiles(){
		$sql = "SELECT * from sisanatom.perfil_usuarios";
        $stmt=$this->objPdo->prepare($sql);
        $stmt->execute();
        $perf = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $perf;
	}

	public function getPerfiles(){

		$perfiles = array();

		$sql = "SELECT *
				FROM perfil_usuarios
				ORDER BY descr_perfil;";

		$stmt = $this->objPdo->prepare($sql);

		$stmt->execute();

		$perfiles = $stmt->fetchAll(PDO::FETCH_OBJ);
		return $perfiles;

	}

	public function getPerfilDescr($per_id){
		$perfil = array();
		$sql = "SELECT * FROM perfil_hosp
				WHERE per_id = :per_id
				ORDER BY per_descr;";
		$stmt = $this->objPdo->prepare($sql);
		$stmt->execute(array('per_id' => $per_id));
		$perfil = $stmt->fetchAll(PDO::FETCH_OBJ);
		return $perfil[0]->per_descr;
	}

}

?>