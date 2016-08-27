<?php

require_once  'conexion.php';

class tipo_paciente {

    private $id_tipo_paciente;
    private $descripcion;
    private $objPdo;

    function __construct($id_tipo_paciente="",$descripcion="") {
        $this->objPDO = new Conexion();
        $this->id_tipo_paciente=$id_tipo_paciente;
        $this->descripcion=$descripcion;
    }

   public function listadotipos(){
        
        $stmt = $this->objPDO->prepare("SELECT * from sisemer.tipo_paciente order by descripcion asc");
        $stmt->execute();
        $grupo=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $grupo;
    }
    //listar estado siempre y cuando sea SIS
    public function listarestado(){
        $stmt = $this->objPDO->prepare("SELECT 1 as codigo,'Si' as estado from sisemer.tipo_paciente
                                        UNION select 2 as codigo,'No' as estado from sisemer.tipo_paciente
                                        where descripcion='SIS'
                                        order by estado desc");
        $stmt->execute();
        $estado=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $estado;
    }

    public function getIdTipo() {
        return $this->id_tipo_paciente;
    }

    public function setId($id_tipo_paciente) {
        $this->id_tipo_paciente = $id_tipo_paciente;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

}

?>
