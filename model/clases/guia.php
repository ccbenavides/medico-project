<?php
require_once 'conexion.php';

class Guia{
	
	private $objPDO;
	private $id_url;
	private $descripcion;
	private $url;
	private $id_tipo;
	private $usuario_registro;
	private $fecha_registro;

	function __construct($id_url="",$descripcion="",$url="",$id_tipo="",$usuario_registro="",$fecha_registro=""){
		$this->id_url=$id_url;
		$this->descripcion=$descripcion;
		$this->url=$url;
		$this->id_tipo=$id_tipo;
		$this->usuario_registro=$usuario_registro;
		$this->fecha_registro=$fecha_registro;
		$this->objPDO = new Conexion();
	}

	public function listar(){
		$stmt=$this->objPDO->prepare("SELECT gm.id_url,tg.tipo_descr,gm.descripcion,gm.url from sisanatom.guia_medico gm inner join sisanatom.tipo_guia tg on gm.id_tipo=tg.id_tipo");
		$stmt->execute();
        $guias=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $guias;
	}

    public function listarprot(){
        $stmt=$this->objPDO->prepare("SELECT gm.id_url,tg.tipo_descr,gm.descripcion,gm.url,gm.id_tipo from sisanatom.guia_medico gm inner join sisanatom.tipo_guia tg on gm.id_tipo=tg.id_tipo WHERE gm.id_tipo=1");
        $stmt->execute();
        $guias=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $guias;
    }

    public function listarinter(){
        $stmt=$this->objPDO->prepare("SELECT gm.id_url,tg.tipo_descr,gm.descripcion,gm.url,gm.id_tipo from sisanatom.guia_medico gm inner join sisanatom.tipo_guia tg on gm.id_tipo=tg.id_tipo WHERE gm.id_tipo=2");
        $stmt->execute();
        $guias=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $guias;
    }

    public function listarcito(){
        $stmt=$this->objPDO->prepare("SELECT gm.id_url,tg.tipo_descr,gm.descripcion,gm.url,gm.id_tipo from sisanatom.guia_medico gm inner join sisanatom.tipo_guia tg on gm.id_tipo=tg.id_tipo WHERE gm.id_tipo=3");
        $stmt->execute();
        $guias=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $guias;
    }

    public function listarwanat(){
        $stmt=$this->objPDO->prepare("SELECT gm.id_url,tg.tipo_descr,gm.descripcion,gm.url,gm.id_tipo from sisanatom.guia_medico gm inner join sisanatom.tipo_guia tg on gm.id_tipo=tg.id_tipo WHERE gm.id_tipo=4");
        $stmt->execute();
        $guias=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $guias;
    }

    public function listarwhist(){
        $stmt=$this->objPDO->prepare("SELECT gm.id_url,tg.tipo_descr,gm.descripcion,gm.url,gm.id_tipo from sisanatom.guia_medico gm inner join sisanatom.tipo_guia tg on gm.id_tipo=tg.id_tipo WHERE gm.id_tipo=5");
        $stmt->execute();
        $guias=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $guias;
    }

    public function listarlibros(){
        $stmt=$this->objPDO->prepare("SELECT gm.id_url,tg.tipo_descr,gm.descripcion,gm.url,gm.id_tipo from sisanatom.guia_medico gm inner join sisanatom.tipo_guia tg on gm.id_tipo=tg.id_tipo WHERE gm.id_tipo=6");
        $stmt->execute();
        $guias=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $guias;
    }
    
	public function listatipo(){
		$stmt=$this->objPDO->prepare("SELECT * from sisanatom.tipo_guia");
		$stmt->execute();
		$tipos=$stmt->fetchAll(PDO::FETCH_OBJ);
		return $tipos;
	}

    public function buscarnomguia($id_url){
        $stmt=$this->objPDO->prepare("SELECT descripcion from sisanatom.guia_medico where id_url=:id_url");
        $stmt->execute(array('id_url'=>$id_url));
        $guias=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $guias[0]->descripcion;
    }

    public function buscarurlguia($id_url){
        $stmt=$this->objPDO->prepare("SELECT url from sisanatom.guia_medico where id_url=:id_url");
        $stmt->execute(array('id_url'=>$id_url));
        $uguia=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $uguia[0]->url;
    }

    public function buscartguia($id_url){
        $stmt=$this->objPDO->prepare("SELECT id_tipo from sisanatom.guia_medico where id_url=:id_url");
        $stmt->execute(array('id_url'=>$id_url));
        $tguia=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $tguia[0]->id_tipo;
    }

	public function insertar(){
		$stmt = $this->objPDO->prepare('INSERT INTO sisanatom.guia_medico(descripcion,url,usuario_registro,id_tipo,fecha_registro)
                                VALUES(:descripcion,:url,:usuario_registro,:id_tipo,:fecha_registro);');
        $stmt->execute(array('descripcion'=>$this->descripcion,
                             'url'=>$this->url,
                             'usuario_registro'=>$this->usuario_registro,
                             'id_tipo'=>$this->id_tipo,
                             'fecha_registro'=>$this->fecha_registro));
	}

	public function obtenerinf(){
        $stmt = $this->objPDO->prepare("SELECT id_url,descripcion,url,id_tipo from sisanatom.guia_medico
                                        where id_url='" . $this->id_url . "';");
        $stmt->execute();
        $mguias = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach ($mguias as $listag) {
            $this->setIdUrl($listag->id_url);
            $this->setDesc($listag->descripcion);
            $this->setUrl($listag->url);
            $this->setTipoGuia($listag->id_tipo);
        }
        return $this;
    }

    public function modificar(){
    	$stmt = $this->objPDO->prepare('UPDATE sisanatom.guia_medico set descripcion=:descripcion,url=:url,id_tipo=:id_tipo
                                        WHERE id_url=:id_url;');
        $stmt->execute(array('id_url'=>$this->id_url,
                             'descripcion'=>$this->descripcion,
                             'url'=>$this->url,
                             'id_tipo'=>$this->id_tipo));
    }

    public function eliminar($id_url){
        $stmt = $this->objPDO->prepare("DELETE FROM sisanatom.guia_medico where id_url=:id_url");
        $rows = $stmt->execute(array('id_url' => $id_url));
        return $rows;
    }

	public function getIdUrl() {
        return $this->id_url;
    }

    public function setIdUrl($id_url) {
        $this->id_url=$id_url;
    }

    public function getDesc() {
        return $this->descripcion;
    }

    public function setDesc($descripcion) {
        $this->descripcion=$descripcion;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setUrl($url) {
        $this->url=$url;
    }

    public function getTipoGuia() {
        return $this->id_tipo;
    }

    public function setTipoGuia($id_tipo) {
        $this->id_tipo=$id_tipo;
    }
    
}

?>