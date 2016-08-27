<?php

require_once 'conexion.php';

class Dependencia {

    private $dep_id;
    private $dep_descr;
    private $dep_estado;
    private $usr_id;
    private $depa_id;
    private $dep_fechareg;
    private $objPdo;

    public function __construct($dep_id = NULL, $dep_descr = '', $dep_estado = '', $usr_id = '', $dep_fechareg = '', $depa_id = '' ) {
        $this->dep_id = $dep_id;
        $this->dep_descr = $dep_descr;
        $this->dep_estado = $dep_estado;
        $this->usr_id = $usr_id;
        $this->dep_fechareg = $dep_fechareg;
        $this->depa_id = $depa_id;
        $this->objPdo = new Conexion();
    }
//Mostrar los Servicios por orden Alfabetico.
    public function consultar() {
        $stmt = $this->objPdo->prepare('SELECT dep_id, dep_descr, dep_estado, usr_id, dep_fechareg FROM dependencias ORDER BY dep_descr;');
        $stmt->execute();
        $dependencias = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $dependencias;
    }
    
    public function consultarActivos() {
        $stmt = $this->objPdo->prepare("SELECT dep_id, dep_descr, dep_estado, usr_id, dep_fechareg FROM dependencias WHERE dep_estado = '1' 
                                        ORDER BY dep_descr;");
        $stmt->execute();
        $dependencias = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $dependencias;
    }

    public function insertar() {
        $stmt = $this->objPdo->prepare('INSERT INTO dependencias (dep_descr, dep_estado, usr_id, dep_fechareg, depa_id) 
                                        VALUES(:dep_descr,
                                               :dep_estado,
                                               :usr_id,
                                               :dep_fechareg,
                                               :depa_id)');
        $rows = $stmt->execute(array('dep_descr' => $this->dep_descr,
                                     'dep_estado' => $this->dep_estado,
                                     'usr_id' => $this->usr_id,
                                     'dep_fechareg'=> $this->dep_fechareg,
                                     'depa_id' => $this->depa_id));
    }

    public function eliminar($dep_id) {
        $stmt = $this->objPdo->prepare('DELETE FROM dependencias WHERE dep_id = :dep_id');
        $rows = $stmt->execute(array('dep_id' => $dep_id));
        return $rows;
    }
    
    public function obtenerxId($dep_id) {
        $stmt = $this->objPdo->prepare('SELECT * FROM dependencias WHERE dep_id = :dep_id');
        $stmt->execute(array('dep_id' => $dep_id));
        $dependencias = $stmt->fetchAll(PDO::FETCH_OBJ);
            foreach ($dependencias as $dependencia) {
                $this->setDep_id($dependencia->dep_id);
                $this->setDep_descr($dependencia->dep_descr);
                $this->setDep_estado($dependencia->dep_estado);
                $this->setUsr_id($dependencia->usr_id);
                $this->setDepa_id($dependencia->depa_id);
                $this->setDep_fechareg($dependencia->dep_fechareg);
            }
            return $this;
    }

    public function obtenerNombrexId($dependencia){
        $stmt = $this->objPdo->prepare('SELECT dep_descr FROM dependencias WHERE dep_id = :dep_id');
        $stmt->execute(array('dep_id' => $dependencia));
        $dependencias = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $dependencias[0]->dep_descr;

    }
    
    public function modificar() {
        $stmt = $this->objPdo->prepare('UPDATE dependencias SET dep_descr=:dep_descr, dep_estado=:dep_estado, usr_id=:usr_id, dep_fechareg=now(), depa_id=:depa_id
                                        WHERE dep_id = :dep_id');
        $rows = $stmt->execute(array('dep_descr' => $this->dep_descr,
                                    'dep_estado' => $this->dep_estado,
                                    'usr_id' => $this->usr_id,
                                    'depa_id' => $this->depa_id,
                                    'dep_id' => $this->dep_id));
    }
 //muestra la lista de medicos de acuerdo a una dependencia
    public function muestramedxdep($dep){
        $stmt = $this->objPdo->prepare('SELECT emp_id FROM empleados e inner join grupoocup goc on e.goc_id=goc.goc_id
                                where (goc.goc_descripcion like "%MED." or goc.goc_descripcion like "%MEDICOS") and e.dep_id=:dep');
        $stmt->execute(array('dep'=>$dep));
        $medxdep=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $medxdep;
    }
   
    public function getDep_id() {
        return $this->dep_id;
    }

    public function setDep_id($dep_id) {
        $this->dep_id = $dep_id;
    }

    public function getDep_descr() {
        return $this->dep_descr;
    }

    public function setDep_descr($dep_descr) {
        $this->dep_descr = $dep_descr;
    }

    public function getDep_estado() {
        return $this->dep_estado;
    }

    public function setDep_estado($dep_estado) {
        $this->dep_estado = $dep_estado;
    }

    public function getUsr_id() {
        return $this->usr_id;
    }

    public function setUsr_id($usr_id) {
        $this->usr_id = $usr_id;
    }

    public function getDepa_id() {
        return $this->depa_id;
    }

    public function setDepa_id($depa_id) {
        $this->depa_id = $depa_id;
    }    

    public function getDep_fechareg() {
        return $this->dep_fechareg;
    }

    public function setDep_fechareg($dep_fechareg) {
        $this->dep_fechareg = $dep_fechareg;
    }

}

?>