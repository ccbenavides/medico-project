<?php
require_once 'conexion.php';

class Muestra{
	
	private $objPDO;
	private $id_muestra;
	private $id_biopsia;
	private $muestra_remitida;
    private $descr_muestra;
    private $id_area;
    private $usuario_registro;
    private $fecha_registro;
    private $id_muestrarem;
    private $tiempo_estudio;
    private $id_muestrabio;

	function __construct($id_muestrabio="",$id_biopsia="",$muestra_remitida="",$id_area="",$usuario_registro="",$fecha_registro="",$id_muestrarem="",$id_muestra=""){
		$this->id_muestrabio=$id_muestrabio;
		$this->id_biopsia=$id_biopsia;
		$this->muestra_remitida=$muestra_remitida;
        $this->id_area=$id_area;
        $this->usuario_registro=$usuario_registro;
        $this->fecha_registro=$fecha_registro;
        $this->id_muestrarem=$id_muestrarem;
        $this->id_muestra=$id_muestra;
        $this->objPDO = new Conexion();
	}
	
	public function insertar(){
		$stmt=$this->objPDO->prepare("INSERT INTO sisanatom.muestras_biopsia(id_biopsia,id_muestrarem)values(:id_biopsia,:id_muestrarem)");
		$stmt->execute(array('id_biopsia'=>$this->id_biopsia,
                             'id_muestrarem'=>$this->id_muestrarem));
	}

    public function modificar(){
        $stmt=$this->objPDO->prepare('UPDATE sisanatom.muestras_biopsia SET id_muestrarem=:id_muestrarem where id_muestrabio=:id_muestrabio');
        $rows = $stmt->execute(array('id_muestrarem' => $this->id_muestrarem,
                                     'id_muestrabio'=> $this->id_muestrabio));

    }

    public function obtidmbio($id_biopsia,$id_muestrarem){
        $stmt=$this->objPDO->prepare("SELECT id_muestrabio from sisanatom.muestras_biopsia where id_biopsia=:id_biopsia and id_muestrarem=:id_muestrarem ");
        $stmt->execute(array('id_biopsia'=>$id_biopsia,'id_muestrarem'=>$id_muestrarem));
        $obtbio=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $obtbio;
    }

    public function obtenermuestras($id_biopsia){
        $stmt=$this->objPDO->prepare("SELECT id_muestrarem from sisanatom.muestras_biopsia where id_biopsia=:id_biopsia");
        $stmt->execute(array('id_biopsia'=>$id_biopsia));
        $mbio=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $mbio;
    }
	
    public function listarguia(){
        $stmt=$this->objPDO->prepare("SELECT * FROM sisanatom.guia_medico");
        $stmt->execute();
        $guias=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $guias;
    }

    public function muestrasxarea($id_area){
        $stmt = $this->objPDO->prepare("SELECT id_muestra,descr_muestra from sisanatom.muestra mue inner join sisanatom.area a on mue.id_area=a.id_area
                                        where a.id_area=:id_area order by descr_muestra asc");
        $stmt->execute(array('id_area'=>$id_area));
        $atop=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $atop;
    }

    public function listarmuestras(){
        $stmt=$this->objPDO->prepare("SELECT id_muestra,descr_muestra,a.descr_area,tiempo_estudio from sisanatom.muestra m inner join 
                                    sisanatom.area a on m.id_area=a.id_area order by id_muestra asc  ");
        $stmt->execute();
        $listarm=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $listarm;
    }

    public function insertarmuearea(){
        $stmt=$this->objPDO->prepare("INSERT INTO sisanatom.muestra(descr_muestra,id_area,usuario_registro,tiempo_estudio)values(:descr_muestra,:id_area,:usuario_registro,:tiempo_estudio) ");
        $stmt->execute(array('descr_muestra'=>$this->descr_muestra,
                             'id_area'=>$this->id_area,
                             'usuario_registro'=>$this->usuario_registro,
                             'tiempo_estudio'=>$this->tiempo_estudio));
    }

    function obtenermuearea($id_muestra){
        $stmt = $this->objPDO->prepare("SELECT id_muestra,descr_muestra,id_area,tiempo_estudio from sisanatom.muestra 
                                        where id_muestra=:id_muestra");
        $stmt->execute(array('id_muestra'=>$id_muestra));
        $muestrasr = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach ($muestrasr as $muestra) {
            $this->setIdMue($muestra->id_muestra);
            $this->setDescrMue($muestra->descr_muestra);
            $this->setAreaMue($muestra->id_area);
            $this->setTiempoMue($muestra->tiempo_estudio);                         
        }
        return $this;
    }

    public function modificarmue(){
        $stmt = $this ->objPDO->prepare("UPDATE sisanatom.muestra
                                         SET descr_muestra=:descr_muestra,id_area=:id_area,tiempo_estudio=:tiempo_estudio 
                                         WHERE id_muestra=:id_muestra;");
        $rows = $stmt->execute(array('descr_muestra' => $this->descr_muestra,
                                     'id_area'=>$this->id_area,
                              'tiempo_estudio'=>$this->tiempo_estudio,
                              'id_muestra'=>$this->id_muestra));
    }

    public function obtid($id_muestra){
        $stmt=$this->objPDO->prepare("SELECT descr_muestra from sisanatom.muestra where id_muestra=:id_muestra");
        $stmt->execute(array('id_muestra'=>$id_muestra));
        $am=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $am[0]->descr_muestra;
    }

 	public function getMuestra() {
        return $this->muestra_remitida;
    }

    public function getIdBiopsia() {
        return $this->id_biopsia;
    }

    public function setMuestra($muestra_remitida) {
        $this->muestra_remitida = $muestra_remitida;
    }

    public function setIdBiopsia($id_biopsia) {
        $this->id_biopsia = $id_biopsia;
    }

    public function getIdMuestraBio() {
        return $this->id_muestrabio;
    }

    public function setMuestraBio($id_muestrabio) {
        $this->id_muestrabio = $id_muestrabio;
    }

    public function getIdMuestra() {
        return $this->id_muestrarem;
    }

    public function setIdMuestra($id_muestrarem) {
        $this->id_muestrarem = $id_muestrarem;
    }

    public function getDescrMue() {
        return $this->descr_muestra;
    }

    public function setDescrMue($descr_muestra) {
        $this->descr_muestra = $descr_muestra;
    }

    public function getAreaMue() {
        return $this->id_area;
    }

    public function setAreaMue($id_area) {
        $this->id_area = $id_area;
    }

    public function getUsuMue() {
        return $this->usuario_registro;
    }

    public function setUsuMue($usuario_registro) {
        $this->usuario_registro = $usuario_registro;
    }

    public function getTiempoMue() {
        return $this->tiempo_estudio;
    }

    public function setTiempoMue($tiempo_estudio) {
        $this->tiempo_estudio = $tiempo_estudio;
    }

    public function getIdMue() {
        return $this->id_muestra;
    }

    public function setIdMue($id_muestra) {
        $this->id_muestra = $id_muestra;
    }
}


?>