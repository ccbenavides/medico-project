<?php

require_once 'conexion.php';

class Diagnostico{

	private $objPDO;
	private $id_diagccv;
	private $descr_diagccv;
	private $estado;
	private $usuario_registro;
	private $fecha_registro;

	function __construct($id_diagccv="",$descr_diagccv="",$estado="",$usuario_registro="",$fecha_registro=""){
		$this->id_diagccv = $id_diagccv;
        $this->descr_diagccv = $descr_diagccv;
        $this->estado=$estado;
        $this->usuario_registro=$usuario_registro;
        $this->fecha_registro=$fecha_registro;
        $this->objPDO = new Conexion();
	}
	//obtener lista de diagnostico de una biopsia CCV
	public function listardiag(){
		$stmt = $this->objPDO->prepare("SELECT id_diagccv,descr_diagccv,(CASE WHEN estado=true THEN 'Activo' ELSE 'Inactivo' END)as estado from sisanatom.diagnostico_ccv order by descr_diagccv asc");
		$stmt->execute();
		$diag = $stmt->fetchAll(PDO::FETCH_OBJ);
		return $diag;
	}

   public function buscardiag($id_diagccv){
        $stmt=$this->objPDO->prepare("SELECT descr_diagccv from sisanatom.diagnostico_ccv where id_diagccv=:id_diagccv");
        $stmt->execute(array('id_diagccv'=>$id_diagccv));
        $idiagnos=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $idiagnos;
   }
	public function insertar(){
		$stmt = $this->objPDO->prepare('INSERT INTO sisanatom.diagnostico_ccv(descr_diagccv,estado,usuario_registro,fecha_registro)
                                VALUES(:descr_diagccv,:estado,:usuario_registro,:fecha_registro);');
        $stmt->execute(array(
                             'descr_diagccv'=>$this->descr_diagccv,
                             'estado'=>$this->estado,
                             'usuario_registro'=>$this->usuario_registro,
                             'fecha_registro'=>$this->fecha_registro));
	}

    public function modificar(){
        $stmt = $this ->objPDO->prepare("UPDATE sisanatom.diagnostico_ccv
                                         SET descr_diagccv=:descr_diagccv 
                                         WHERE id_diagccv=:id_diagccv;");
        $rows = $stmt->execute(array('descr_diagccv' => $this->descr_diagccv,
                              'id_diagccv'=>$this->id_diagccv));
    }

    public function obtenerdiag(){
        $stmt = $this->objPDO->prepare("SELECT id_diagccv,descr_diagccv from sisanatom.diagnostico_ccv
                                        where id_diagccv='" . $this->id_diagccv . "';");
        $stmt->execute();
        $diagnosticos = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach ($diagnosticos as $diagnostico) {
            $this->setIdDiag($diagnostico->id_diagccv);
            $this->setDesDiag($diagnostico->descr_diagccv);                       
        }
        return $this;
    }

    public function debaja($id_diagccv){
        $stmt = $this->objPDO->prepare("UPDATE sisanatom.diagnostico_ccv set estado=FALSE where id_diagccv=:id_diagccv");
        $rows = $stmt->execute(array('id_diagccv' => $id_diagccv));
        return $rows;
    }

    public function dealta($id_diagccv){
        $stmt = $this->objPDO->prepare("UPDATE sisanatom.diagnostico_ccv set estado=TRUE where id_diagccv=:id_diagccv");
        $rows = $stmt->execute(array('id_diagccv' => $id_diagccv));
        return $rows;
    }

	public function getIdDiag() {
        return $this->id_diagccv;
    }

    public function getDesDiag() {
        return $this->descr_diagccv;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getUsuReg() {
        return $this->usuario_registro;
    }

    public function getFechReg() {
        return $this->fecha_registro;
    }

    public function setIdDiag($id_diagccv) {
        $this->id_diagccv= $id_diagccv;
    }

    public function setDesDiag($descr_diagccv) {
        $this->descr_diagccv = $descr_diagccv;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function setUsuReg($usuario_registro) {
        $this->usuario_registro = $usuario_registro;
    }

    public function setFechaReg($fecha_registro){
    	$this->fecha_registro=$fecha_registro;
    }

}
?>