<?php

require_once 'conexion.php';

class Departamento {

    private $depa_id;
    private $depa_descripcion;
    private $depa_estado;
    private $usr_id;
    private $depa_fecha_creacion;
    private $objPdo;

    public function __construct($depa_id = NULL, $depa_descripcion = '', $depa_estado = '', $usr_id = '', $depa_fecha_creacion = '') {
        $this->depa_id = $depa_id;
        $this->depa_descripcion = $depa_descripcion;
        $this->depa_estado = $depa_estado;
        $this->usr_id = $usr_id;
        $this->depa_fecha_creacion = $depa_fecha_creacion;
        $this->objPdo = new Conexion();
    }
//Mostrar los Departamentos por orden Alfabetico.
    public function consultar() {
        $stmt = $this->objPdo->prepare('SELECT depa_id, depa_descripcion, depa_estado, usr_id, depa_fecha_creacion FROM departamentos ORDER BY depa_descripcion;');
        $stmt->execute();
        $departamentos = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $departamentos;
    }
    
    public function consultarActivos() {
        $stmt = $this->objPdo->prepare("SELECT depa_id, depa_descripcion, depa_estado, usr_id, depa_fecha_creacion FROM departamentos WHERE depa_estado = '1' 
                                        ORDER BY depa_descripcion;");
        $stmt->execute();
        $departamentos = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $departamentos;
    }

    public function insertar() {
        $stmt = $this->objPdo->prepare('INSERT INTO departamentos (depa_descripcion, depa_estado, usr_id) 
                                        VALUES(:depa_descripcion,
                                               :depa_estado,
                                               :usr_id)');
        $rows = $stmt->execute(array('depa_descripcion' => $this->depa_descripcion,
                                     'depa_estado' => $this->depa_estado,
                                     'usr_id' => $this->usr_id));
    }

    public function eliminar($depa_id) {
        $stmt = $this->objPdo->prepare('DELETE FROM departamentos WHERE depa_id = :depa_id');
        $rows = $stmt->execute(array('depa_id' => $depa_id));
        return $rows;
    }
    
    public function obtenerxId($depa_id) {
        $stmt = $this->objPdo->prepare('SELECT * FROM departamentos WHERE depa_id = :depa_id');
        $stmt->execute(array('depa_id' => $depa_id));
        $departamentos = $stmt->fetchAll(PDO::FETCH_OBJ);
            foreach ($departamentos as $departamento) {
                $this->setdepa_id($departamento->depa_id);
                $this->setdepa_descripcion($departamento->depa_descripcion);
                $this->setdepa_estado($departamento->depa_estado);
                $this->setUsr_id($departamento->usr_id);
                $this->setdepa_fecha_creacion($departamento->depa_fecha_creacion);
            }
            return $this;
    }

    public function obtenerNombrexId($departamento){
        $stmt = $this->objPdo->prepare('SELECT depa_descripcion FROM departamentos WHERE depa_id = :depa_id');
        $stmt->execute(array('depa_id' => $dependencia));
        $departamentos = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $departamentos[0]->depa_descripcion;

    }
    
    public function modificar() {
        $stmt = $this->objPdo->prepare('UPDATE departamentos SET depa_descripcion=:depa_descripcion, depa_estado=:depa_estado, usr_id=:usr_id, depa_fecha_creacion=now()
                                        WHERE depa_id = :depa_id');
        $rows = $stmt->execute(array('depa_descripcion' => $this->depa_descripcion,
                                    'depa_estado' => $this->depa_estado,
                                    'usr_id' => $this->usr_id,
                                    'depa_id' => $this->depa_id));
    }


    public function getServicios($depa_id){
        $sql = "SELECT *
                FROM sishosp.servicios_procedencia serv
                INNER JOIN departamentos depa
                ON serv.depa_id = depa.depa_id
                WHERE serv.depa_id = :depa_id
                ORDER BY nom_servicio;";

        $stmt = $this->objPdo->prepare($sql);

        $stmt->execute(array('depa_id' => $depa_id));

        
           $servicios = $stmt->fetchAll(PDO::FETCH_OBJ);

           return $servicios;


    }
    
    public function getdepa_id() {
        return $this->depa_id;
    }

    public function setdepa_id($depa_id) {
        $this->depa_id = $depa_id;
    }

    public function getdepa_descripcion() {
        return $this->depa_descripcion;
    }

    public function setdepa_descripcion($depa_descripcion) {
        $this->depa_descripcion = $depa_descripcion;
    }

    public function getdepa_estado() {
        return $this->depa_estado;
    }

    public function setdepa_estado($depa_estado) {
        $this->depa_estado = $depa_estado;
    }

    public function getUsr_id() {
        return $this->usr_id;
    }

    public function setUsr_id($usr_id) {
        $this->usr_id = $usr_id;
    }

    public function getdepa_fecha_creacion() {
        return $this->depa_fecha_creacion;
    }

    public function setdepa_fecha_creacion($depa_fecha_creacion) {
        $this->depa_fecha_creacion = $depa_fecha_creacion;
    }

}

?>