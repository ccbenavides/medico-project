<?php

require_once 'conexion.php';
 
 class Ubicacion{
 	
 	private $objPDO;
 	private $id_ubicacion;
 	private $descr_ubicacion;
    private $estado;
    private $id_usuario;
    private $fecha_registro;
    


 	function __construct($id_ubicacion="",$descr_ubicacion="",$id_usuario="",$fecha_registro="",$estado=""){
 		$this->id_ubicacion = $id_ubicacion;
        $this->descr_ubicacion = $descr_ubicacion;
        $this->id_usuario=$id_usuario;
        $this->fecha_registro=$fecha_registro;
        $this->estado=$estado;
        $this->objPDO = new Conexion();
 	}
   
    public function listaubicacion(){
        $stmt=$this->objPDO->prepare("SELECT id_ubicacion, descr_ubicacion,
                (CASE WHEN estado='0' THEN 'Activo' ELSE 'Inactivo' END) as estado  from sisanatom.ubicacion_bio");
        $stmt->execute();
        $listas=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $listas;
    }

    public function insertar(){
        $stmt=$this->objPDO->prepare("INSERT INTO sisanatom.ubicacion_bio(descr_ubicacion,id_usuario,fecha_registro,estado)
                                        VALUES(:descr_ubicacion,:id_usuario,:fecha_registro,:estado)");
        $stmt->execute(array('descr_ubicacion'=>$this->descr_ubicacion,
                             'id_usuario'=>$this->id_usuario,
                             'fecha_registro'=>$this->fecha_registro,
                             'estado'=>$this->estado));
    }

    public function buscarnomubic($id_ubicacion){
        $stmt=$this->objPDO->prepare("SELECT descr_ubicacion, estado FROM sisanatom.ubicacion_bio where id_ubicacion=:id_ubicacion");
        $stmt->execute(array('id_ubicacion'=>$id_ubicacion));
        $nubi=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $nubi[0]->descr_ubicacion;
    }

    public function modificar(){
        $stmt=$this->objPDO->prepare("UPDATE sisanatom.ubicacion_bio 
                                      SET descr_ubicacion=:descr_ubicacion,estado=:estado,id_usuario=:id_usuario,fecha_registro=:fecha_registro
                                      WHERE id_ubicacion=:id_ubicacion;");
        $stmt->execute(array('descr_ubicacion' => $this->descr_ubicacion,
                             'id_usuario'=>$this->id_usuario,
                             'estado'=>$this->estado,
                             'fecha_registro'=>$this->fecha_registro,
                             'id_ubicacion'=>$this->id_ubicacion));
    }

    public function obtenerubicxid(){
        $stmt=$this->objPDO->prepare("SELECT id_ubicacion, descr_ubicacion, estado FROM sisanatom.ubicacion_bio
                                      where id_ubicacion = '" . $this->id_ubicacion . "';");
        $stmt->execute();
        $ubidcid = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach ($ubidcid as $ubid) {
            $this->setIdUbi($ubid->id_ubicacion);
            $this->setDesUbi($ubid->descr_ubicacion);
            $this->setEstado($ubid->estado);            
        }
        return $this;
    }

    public function eliminar($id_top){
        $stmt = $this->objPDO->prepare("UPDATE sisanatom.topografia_area set estado='1' where id_top=:id_top");
        $rows = $stmt->execute(array('id_top' => $id_top));
        return $rows;
    }
    
    public function getIdUbi() {
        return $this->id_ubicacion;
    }

    public function setIdUbi($id_ubicacion) {
        $this->id_ubicacion = $id_ubicacion;
    }

    public function getDesUbi() {
        return $this->descr_ubicacion;
    }
    
    public function setDesUbi($descr_ubicacion) {
        $this->descr_ubicacion = $descr_ubicacion;
    }

    public function getIdUsuario() {
        return $this->id_usuario;
    }

    public function setIdUsuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function getFecha() {
        return $this->fecha_registro;
    }

    public function setFecha($fecha_registro) {
        $this->fecha_registro = $fecha_registro;
    }
    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

 }

?>