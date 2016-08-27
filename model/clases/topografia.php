<?php

require_once 'conexion.php';
 
 class Topografia{
 	
 	private $objPDO;
 	private $id_topografia;
 	private $descr_topografia;
    private $id_ar_top;
    private $id_area;
    private $id_top;
    private $descr_top;
    private $id_usuario;
    private $fecha_registro;
    private $estado;


 	function __construct($id_top="",$descr_top="",$id_area="",$id_usuario="",$fecha_registro="",$estado=""){
 		$this->id_top = $id_top;
        $this->descr_top = $descr_top;
        $this->id_area=$id_area;
        $this->id_usuario=$id_usuario;
        $this->fecha_registro=$fecha_registro;
        $this->estado=$estado;
        $this->objPDO = new Conexion();
 	}
 		
 	//obtener lista de topografias por area
 	public function topxarea($id_area){
 		$stmt = $this->objPDO->prepare("SELECT id_top,descr_top from sisanatom.topografia_area ta inner join sisanatom.area a on ta.id_area=a.id_area
                                        where a.id_area=:id_area order by descr_top asc ");
 		$stmt->execute(array('id_area'=>$id_area));
 		$atop=$stmt->fetchAll(PDO::FETCH_OBJ);
 		return $atop;
 	}

    //obtener topografias del area de patologia quirurgica
    public function topxpq(){
        $stmt=$this->objPDO->prepare("SELECT id_top,descr_top from sisanatom.topografia_area where id_area=1 order by descr_top asc");
        $stmt->execute();
        $toppq=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $toppq;
    }
    //obtener topografias del area de citologia especial
    public function topxce(){
        $stmt=$this->objPDO->prepare("SELECT id_top,descr_top from sisanatom.topografia_area where id_area=2 order by descr_top asc");
        $stmt->execute();
        $topce=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $topce;
    }
    //obtener topografias del area de inmunohistoquimica
     public function topxih(){
        $stmt=$this->objPDO->prepare("SELECT id_top,descr_top from sisanatom.topografia_area where id_area=4 order by descr_top asc");
        $stmt->execute();
        $topih=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $topih;
    }


    //obtener la lista de topografias del area de Inmunohistoquimica
    public function listatopih(){
        $stmt = $this->objPDO->prepare("SELECT id_top,descr_top from sisanatom.topografia_area ta inner join sisanatom.area a on ta.id_area=a.id_area
                                        where a.id_area=4");
        $stmt->execute();
        $topi=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $topi;
    }
    
    public function listasartop(){
        $stmt=$this->objPDO->prepare("SELECT ta.id_top,a.descr_area,ta.descr_top from sisanatom.topografia_area ta 
                                inner join sisanatom.area a on ta.id_area=a.id_area where ta.estado='0'");
        $stmt->execute();
        $listas=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $listas;
    }

    public function buscarnomtop($id_top){
        $stmt=$this->objPDO->prepare("SELECT descr_top FROM sisanatom.topografia_area where id_top=:id_top ");
        $stmt->execute(array('id_top'=>$id_top));
        $ntop=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $ntop[0]->descr_top;
    }

    public function buscararea($id_top){
        $stmt=$this->objPDO->prepare("SELECT id_area FROM sisanatom.topografia_area where id_top=:id_top");
        $stmt->execute(array('id_top'=>$id_top));
        $narea=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $narea[0]->id_area;
    }

    public function insertar(){
        $stmt=$this->objPDO->prepare("INSERT INTO sisanatom.topografia_area(descr_top,id_area,id_usuario,fecha_registro,estado)
                                        VALUES(:descr_top,:id_area,:id_usuario,:fecha_registro,:estado)");
        $stmt->execute(array('descr_top'=>$this->descr_top,
                             'id_area'=>$this->id_area,
                             'id_usuario'=>$this->id_usuario,
                             'fecha_registro'=>$this->fecha_registro,
                             'estado'=>$this->estado));
    }

    public function modificar(){
        $stmt=$this->objPDO->prepare("UPDATE sisanatom.topografia_area 
                                      SET descr_top=:descr_top,id_area=:id_area,id_usuario=:id_usuario,fecha_registro=:fecha_registro
                                      WHERE id_top=:id_top;");
        $stmt->execute(array('descr_top' => $this->descr_top,
                             'id_area'=>$this->id_area,
                             'id_usuario'=>$this->id_usuario,
                             'fecha_registro'=>$this->fecha_registro,
                             'id_top'=>$this->id_top));
    }

    public function obtenertopxid(){
        $stmt=$this->objPDO->prepare("SELECT id_top,descr_top,id_area FROM sisanatom.topografia_area
                                      where id_top = '" . $this->id_top . "';");
        $stmt->execute();
        $topids = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach ($topids as $topid) {
            $this->setIdTop($topid->id_top);
            $this->setDesTop($topid->descr_top);
            $this->setIdArea($topid->id_area);            
        }
        return $this;
    }

    public function eliminar($id_top){
        $stmt = $this->objPDO->prepare("UPDATE sisanatom.topografia_area set estado='1' where id_top=:id_top");
        $rows = $stmt->execute(array('id_top' => $id_top));
        return $rows;
    }
    
    public function getIdArTop() {
        return $this->id_ar_top;
    }

    public function setIdArTop($id_ar_top) {
        $this->id_ar_top = $id_ar_top;
    }

    public function getIdTop() {
        return $this->id_top;
    }

    public function getDesTop() {
        return $this->descr_top;
    }

    public function setIdTop($id_top) {
        $this->id_top = $id_top;
    }

    public function setDesTop($descr_top) {
        $this->descr_top = $descr_top;
    }

    public function getIdArea() {
        return $this->id_area;
    }

    public function setIdArea($id_area) {
        $this->id_area = $id_area;
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
    public function getestado() {
        return $this->estado;
    }

    public function setestado($estado) {
        $this->estado = $estado;
    }

 }

?>