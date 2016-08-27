<?php

require_once 'conexion.php';

class Ubigeo {

    private $objPdo;
    private $departamento;
    private $provincia;
    private $distrito;
    private $id;

    function __construct() {
        $this->objPdo = new Conexion();
    }

    public function departamentos() {
        $stmt = $this->objPdo->prepare('SELECT distinct departamento from sisemer.ubigeo order by departamento');
        $stmt->execute();
        $ubigeo = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $ubigeo;
    }
   
    public function provincias($departamento) {
        $stmt = $this->objPdo->prepare("SELECT distinct provincia from sisemer.ubigeo WHERE departamento = :departamento order by provincia");
        $stmt->execute(array('departamento'=>$departamento));
        $ubigeo = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $ubigeo;
    }

     public function distritos($provincia) {
        $stmt = $this->objPdo->prepare("SELECT distinct distrito from sisemer.ubigeo WHERE provincia = :provincia order by distrito");
        $stmt->execute(array('provincia'=>$provincia));
        $ubigeo = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $ubigeo;
    }

    function buscarUbigeoId($dep, $prov, $dist) {
        $stmt = $this->objPdo->prepare("SELECT id_ubigeo FROM sisemer.ubigeo where departamento = '" . $dep . "'
                                       and provincia ='" . $prov . "' and distrito = '" . $dist . "';");
        $stmt->execute();
        $id_ubigeo = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (count($id_ubigeo)) {
            foreach ($id_ubigeo as $ubigeo) {
                $this->setId($ubigeo->id_ubigeo);
            }
        }
        return $this;
    }

   

    public function obtenerUbigeo() {
        $stmt = $this->objPdo->prepare("SELECT * from sisemer.ubigeo where id_ubigeo = ".$this->id."");
        $stmt->execute();
        $ubigeo = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach ($ubigeo as $u) {
            $this->setDepartamento($u->departamento);
            $this->setProvincia($u->provincia);
            $this->setDistrito($u->distrito);
        }
        return $this;
    }

    public function getDepartamento() {
        return $this->departamento;
    }

    public function getProvincia() {
        return $this->provincia;
    }

    public function getDistrito() {
        return $this->distrito;
    }

    public function getId() {
        return $this->id;
    }

    public function setDepartamento($departamento) {
        $this->departamento = $departamento;
    }

    public function setProvincia($provincia) {
        $this->provincia = $provincia;
    }

    public function setDistrito($distrito) {
        $this->distrito = $distrito;
    }

    public function setId($id) {
        $this->id = $id;
    }

}

?>
