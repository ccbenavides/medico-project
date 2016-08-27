<?php

require_once 'conexion.php';

class Marcador{

	private $id_marcador;
	private $descr_marcador;
	private $lote;
	private $fecha_venc;
	private $condicion;
    private $estado;
	private $objPDO;

	function __construct($id_marcador="",$descr_marcador="",$lote="",$fecha_venc="",$condicion="",$estado=""){
		$this->id_marcador = $id_marcador;
		$this->descr_marcador=$descr_marcador;
		$this->lote=$lote;
		$this->fecha_venc=$fecha_venc;
		$this->condicion=$condicion;
        $this->estado=$estado;
		$this->objPDO = new Conexion();
	}
	//listar los marcadores 
	public function listamarc(){
		$stmt = $this->objPDO->prepare("SELECT id_marcador,descr_marcador,lote,fecha_venc,(fecha_venc::date - (select now())::date) as dias,
                                          (CASE WHEN ((fecha_venc::date - (select now())::date)<0)THEN condicion||'-'||'Vencido'
                                          WHEN lote=0 THEN 'Agotado' 
                                          WHEN ((fecha_venc::date - (select now())::date)>0) THEN condicion END) as condicion,
                                          (CASE WHEN estado='0' THEN 'Activo' ELSE 'Inactivo' END) as estado from sisanatom.marcador 
                                          order by id_marcador asc");
        $stmt->execute();
        $marca = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $marca;
	}

    public function listarcondic(){
        $stmt = $this->objPDO->prepare("SELECT 1 as codigo,'En Uso' as condicion from sisanatom.marcador
                                UNION select 2 as codigo,'Nuevo' as condicion from sisanatom.marcador");
        $stmt->execute();
        $condicion = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $condicion;
    }

    public function buscarnommar($id_marcador){
        $stmt=$this->objPDO->prepare("SELECT descr_marcador from sisanatom.marcador where id_marcador=:id_marcador");
        $stmt->execute(array('id_marcador'=>$id_marcador));
        $bnmar=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $bnmar[0]->descr_marcador;
    }

    public function buscarlote($id_marcador){
        $stmt=$this->objPDO->prepare("SELECT lote from sisanatom.marcador where id_marcador=:id_marcador");
        $stmt->execute(array('id_marcador'=>$id_marcador));
        $lomarc=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $lomarc[0]->lote;
    }

    public function buscarfecha($id_marcador){
        $stmt=$this->objPDO->prepare("SELECT fecha_venc from sisanatom.marcador where id_marcador=:id_marcador");
        $stmt->execute(array('id_marcador'=>$id_marcador));
        $fmarc=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $fmarc[0]->fecha_venc;
    }

    public function insertar(){
        $stmt = $this->objPDO->prepare('INSERT INTO sisanatom.marcador(descr_marcador,lote,fecha_venc,condicion,estado)
                                VALUES(:descr_marcador,:lote,:fecha_venc,:condicion,:estado);');
        $stmt->execute(array('descr_marcador' => $this->descr_marcador,
                             'lote'=>$this->lote,
                             'fecha_venc'=>$this->fecha_venc,
                             'condicion'=>$this->condicion,
                             'estado'=>$this->estado));
    }

    public function modificar(){
        $stmt = $this->objPDO->prepare('UPDATE sisanatom.marcador set descr_marcador=:descr_marcador,
                                        lote=:lote,fecha_venc=:fecha_venc
                                        WHERE id_marcador=:id_marcador;');
        $stmt->execute(array('id_marcador' =>$this->id_marcador,
                             'descr_marcador'=>$this->descr_marcador,
                             'lote'=>$this->lote,
                             'fecha_venc'=>$this->fecha_venc));
    }

    public function obtenermarcid(){
        $stmt = $this->objPDO->prepare("SELECT id_marcador,descr_marcador,lote,fecha_venc from sisanatom.marcador
                                        where id_marcador='" . $this->id_marcador . "';");
        $stmt->execute();
        $marcadores = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach ($marcadores as $marcador) {
            $this->setIdMarc($marcador->id_marcador);
            $this->setNomMarc($marcador->descr_marcador);
            $this->setLote($marcador->lote);
            $this->setFechaVenc($marcador->fecha_venc);           
            
        }
        return $this;
    }

    public function baja($id_marcador){
        $stmt = $this->objPDO->prepare("UPDATE sisanatom.marcador set estado='1' where id_marcador=:id_marcador");
        $rows = $stmt->execute(array('id_marcador' => $id_marcador));
        return $rows;
    }

    public function alta($id_marcador){
        $stmt = $this->objPDO->prepare("UPDATE sisanatom.marcador set estado='0' where id_marcador=:id_marcador");
        $rows = $stmt->execute(array('id_marcador' => $id_marcador));
        return $rows;
    }

    //listar marcadores para inmunohistoquimica
    public function listmarcadores(){
        $stmt=$this->objPDO->prepare("SELECT id_marcador,descr_marcador from sisanatom.marcador where estado='0' order by descr_marcador");
        $stmt->execute();
        $marcadores = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $marcadores;
    }

    public function consultarxbio($id_biopsia){
        $stmt = $this->objPDO->prepare("SELECT * from sisanatom.control_pruebasih where id_biopsia=:id_biopsia");
        $stmt->execute(array('id_biopsia' => $id_biopsia));
        $biopsias = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $biopsias;
    }

	public function getIdMarc() {
        return $this->id_marcador;
    }
    public function getNomMarc() {
        return $this->descr_marcador;
    }
    public function getLote() {
        return $this->lote;
    }
    public function getFechaVenc() {
        return $this->fecha_venc;
    }
    public function getCondicion() {
        return $this->condicion;
    }
    public function setIdMarc($id_marcador) {
        $this->id_marcador=$id_marcador;
    }
    public function setNomMarc($descr_marcador) {
        $this->descr_marcador=$descr_marcador;
    }
    public function setLote($lote) {
        $this->lote=$lote;
    }
    public function setFechaVenc($fecha_venc) {
        $this->fecha_venc=$fecha_venc;
    }
    public function setCondicion($condicion) {
        $this->condicion=$condicion;
    }
    public function getestado() {
        return $this->estado;
    }
    public function setestado($estado) {
        $this->estado=$estado;
    }
}


?>