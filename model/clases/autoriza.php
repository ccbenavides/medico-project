<?php
require_once 'conexion.php';

class Autorizacion{

	private $objPdo;
    private $usuario_autoriza;
    private $id_biopsia;
    private $estudio;
    private $usuario_autorizado;
    private $motivo;
    private $estadobio_origen;
    private $opcionmotivo;
    private $autoriz_estado;
    private $motivo_desautoriza;
    private $id_autorizacion;

    public function __construct($usuario_autoriza="",$id_biopsia="",$estudio="",$usuario_autorizado="",$motivo="",$estadobio_origen="",$opcionmotivo="",$motivo_desautoriza="",$id_autorizacion="",$autoriz_estado=""){

    	$this->usuario_autoriza=$usuario_autoriza;
    	$this->id_biopsia=$id_biopsia;
    	$this->estudio=$estudio;
    	$this->usuario_autorizado=$usuario_autorizado;
    	$this->motivo=$motivo;
        $this->estadobio_origen=$estadobio_origen;
        $this->opcionmotivo=$opcionmotivo;
        $this->motivo_desautoriza=$motivo_desautoriza;
        $this->id_autorizacion=$id_autorizacion;
        $this->autoriz_estado=$autoriz_estado;
        $this->objPdo = new Conexion();
    }

    public function insertaraut(){
        $stmt =$this->objPdo->prepare("INSERT INTO sisanatom.autorizaciones_biopsias (usuario_autoriza,id_biopsia,estudio,usuario_autorizado,motivo,estadobio_origen,opcionmotivo)
                                       values(:usuario_autoriza,:id_biopsia,:estudio,:usuario_autorizado,:motivo,:estadobio_origen,:opcionmotivo);");
        $stmt->execute(array('usuario_autoriza' => $this->usuario_autoriza,
                             'id_biopsia'=>$this->id_biopsia,
                             'estudio'=>$this->estudio,
                             'usuario_autorizado'=>$this->usuario_autorizado,
                             'motivo'=>$this->motivo,
                             'estadobio_origen'=>$this->estadobio_origen,
                             'opcionmotivo'=>$this->opcionmotivo));
    }


    public function obtestadoorigen($id_biopsia,$estudio){
        $stmt=$this->objPdo->prepare("SELECT max(estadobio_origen)as estadobio_origen from sisanatom.autorizaciones_biopsias
                                        where id_biopsia=:id_biopsia and estudio=:estudio ");
        $stmt->execute(array('id_biopsia'=>$id_biopsia,'estudio'=>$estudio));
        $est=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $est[0]->estadobio_origen;
    }

    public function obtidaut($id_biopsia,$estudio){
        $stmt=$this->objPdo->prepare("SELECT max(id_autorizacion)as id_autorizacion from sisanatom.autorizaciones_biopsias
                                    where id_biopsia=:id_biopsia and estudio=:estudio ");
        $stmt->execute(array('id_biopsia'=>$id_biopsia,'estudio'=>$estudio));
        $idaut=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $idaut[0]->id_autorizacion;
    }

    public function modificarautorizacion(){
        $stmt=$this->objPdo->prepare("UPDATE sisanatom.autorizaciones_biopsias SET autoriz_estado=:autoriz_estado,motivo_desautoriza=:motivo_desautoriza
                                        WHERE id_autorizacion=:id_autorizacion");
        $rows=$stmt->execute(array('id_autorizacion'=>$this->id_autorizacion,
                                    'motivo_desautoriza'=>$this->motivo_desautoriza,
                                    'autoriz_estado'=>$this->autoriz_estado));
    }

    public function actualizaestado1($id_biopsia){
    $sql = "UPDATE sisanatom.biopsia set estado_biopsia='1' where id_biopsia =:id_biopsia;";

    $stmt = $this->objPdo->prepare($sql);

        try{
            $stmt->execute(array('id_biopsia' => $id_biopsia));
            return true;
        }catch(PDOExeception $e){
            return false;
        }
	}

	public function actualizaestado2($id_biopsia){
    $sql = "UPDATE sisanatom.biopsia set estado_biopsia='2' where id_biopsia =:id_biopsia;";

    $stmt = $this->objPdo->prepare($sql);

        try{
            $stmt->execute(array('id_biopsia' => $id_biopsia));
            return true;
        }catch(PDOExeception $e){
            return false;
    	}
	}

	public function actualizaestado3($id_biopsia){
    $sql = "UPDATE sisanatom.biopsia set estado_biopsia='3' where id_biopsia =:id_biopsia;";

    $stmt = $this->objPdo->prepare($sql);

        try{
            $stmt->execute(array('id_biopsia' => $id_biopsia));
            return true;
        }catch(PDOExeception $e){
            return false;
    	}
	}

    public function actualizaestados($estado_biopsia,$id_biopsia){
    $sql = "UPDATE sisanatom.biopsia set estado_biopsia=:estado_biopsia where id_biopsia =:id_biopsia;";

    $stmt = $this->objPdo->prepare($sql);

        try{
            $stmt->execute(array('id_biopsia' => $id_biopsia,'estado_biopsia'=>$estado_biopsia));
            return true;
        }catch(PDOExeception $e){
            return false;
        }
    }

    public function getusuautoriza() {
        return $this->usuario_autoriza;
    }

    public function setusuautoriza($usuario_autoriza){
        $this->usuario_autoriza = $usuario_autoriza;
    }

    public function getbiopsia() {
        return $this->id_biopsia;
    }

    public function setbiopsia($id_biopsia){
        $this->id_biopsia = $id_biopsia;
    }

    public function getestudio() {
        return $this->estudio;
    }

    public function setestudio($estudio){
        $this->estudio = $estudio;
    }

    public function getusuautorizado() {
        return $this->usuario_autorizado;
    }

    public function setusuautorizado($usuario_autorizado){
        $this->usuario_autorizado = $usuario_autorizado;
    }

    public function getmotivo() {
        return $this->motivo;
    }

    public function setmotivo($motivo){
        $this->motivo = $motivo;
    }

    public function getestadobio() {
        return $this->estadobio_origen;
    }

    public function setestadobio($estadobio_origen){
        $this->estadobio_origen = $estadobio_origen;
    }

    public function getopcion() {
        return $this->opcionmotivo;
    }

    public function setopcion($opcionmotivo){
        $this->opcionmotivo = $opcionmotivo;
    }

    public function getestadoaut() {
        return $this->autoriz_estado;
    }

    public function setestadoaut($autoriz_estado){
        $this->autoriz_estado = $autoriz_estado;
    }

    public function getmotivodesaut() {
        return $this->motivo_desautoriza;
    }

    public function setmotivodesaut($motivo_desautoriza){
        $this->motivo_desautoriza = $motivo_desautoriza;
    }

    public function getidaut() {
        return $this->id_autorizacion;
    }

    public function setidaut($id_autorizacion){
        $this->id_autorizacion = $id_autorizacion;
    }

}



?>