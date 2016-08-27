<?php

require_once 'conexion.php';
 
 class BiopsiaDetalle{
    
 	private $objPDO;
 	private $id_biopsia;
    private $gestante;
    private $gesta;
    private $para;
    private $mac;
    private $fur;
    private $pap_anterior;
    private $num_tacos;
    private $num_laminas;
    private $prueba;
    private $responsable;
    private $fecha;
    private $usuario_registro;
    private $fecha_registro;
    private $marcador;
    private $codigo_prueba;
    private $cantidad;
    
 	function __construct($id_biopsia=""){
 		$this->id_biopsia = $id_biopsia;
 		$this->objPDO = new Conexion();
 	}

 	public function insertar(){
 		$stmt=$this->objPDO->prepare("INSERT INTO sisanatom.detalle_bioce(id_biopsia,num_laminas,num_tacos)values(:id_biopsia,:num_laminas,:num_tacos)");
    	$stmt->execute(array('id_biopsia'=>$this->id_biopsia,
                             'num_laminas'=>$this->num_laminas,
                             'num_tacos'=>$this->num_tacos));                             
 	}

    public function insertar1(){
        $stmt=$this->objPDO->prepare("INSERT INTO sisanatom.detalle_bioccv(id_biopsia,gestante,gesta,para,mac,fur,pap_anterior)
                                    values(:id_biopsia,:gestante,:gesta,:para,:mac,:fur,:pap_anterior)");
        $stmt->execute(array('id_biopsia'=>$this->id_biopsia,
                             'gestante'=>$this->gestante,
                             'gesta'=>$this->gesta,
                             'para'=>$this->para,
                             'mac'=>$this->mac,
                             'fur'=>$this->fur,
                             'pap_anterior'=>$this->pap_anterior)); 
    }

    public function insertar2(){
        $stmt=$this->objPDO->prepare("INSERT INTO sisanatom.detalle_biopq(id_biopsia,num_laminas,num_tacos)values(:id_biopsia,:num_laminas,:num_tacos)");
        $stmt->execute(array('id_biopsia'=>$this->id_biopsia,
                             'num_laminas'=>$this->num_laminas,
                             'num_tacos'=>$this->num_tacos));                                                                                                                                                                             
    }
    public function insertar3(){
        $stmt=$this->objPDO->prepare("INSERT INTO sisanatom.detalle_bioih(id_biopsia)values(:id_biopsia)");
        $stmt->execute(array('id_biopsia'=>$this->id_biopsia));
    }
    //insertar en control de marcadores cuando PQ requiere IH
    public function insertmarc(){
        $stmt=$this->objPDO->prepare("INSERT INTO sisanatom.control_pruebasih(prueba,id_biopsia,responsable,fecha,usuario_registro,fecha_registro,codigo_prueba)
                                values(:prueba,:id_biopsia,:responsable,:fecha,:usuario_registro,:fecha_registro,:codigo_prueba)");
        $stmt->execute(array('prueba' => $this->prueba,
                             'id_biopsia'=>$this->id_biopsia,
                             'responsable'=>$this->responsable,
                             'fecha'=>$this->fecha,
                             'usuario_registro'=>$this->usuario_registro,
                             'fecha_registro'=>$this->fecha_registro,
                             'codigo_prueba'=>$this->codigo_prueba));
    }
    //insertar los marcadores de una prueba
    public function insertpruemarc(){
        $stmt=$this->objPDO->prepare("INSERT INTO sisanatom.marcador_prueba(prueba,marcador,cantidad)values(:prueba,:marcador,:cantidad)");
        $stmt->execute(array('prueba'=>$this->prueba,
                            'marcador'=>$this->marcador,
                            'cantidad'=>$this->cantidad));

    }

    

 	public function getIdBio() {
        return $this->id_biopsia;
    }
    public function setIdBio($id_biopsia) {
        $this->id_biopsia = $id_biopsia;
    }
    public function getgestante() {
        return $this->gestante;
    }
    public function setgestante($gestante) {
        $this->gestante = $gestante;
    }   
    public function getgesta() {
        return $this->gesta;
    }
    public function setgesta($gesta) {
        $this->gesta = $gesta;
    }
    public function getpara() {
        return $this->para;
    }
    public function setpara($para) {
        $this->para = $para;
    }
    public function getmac() {
        return $this->mac;
    }
    public function setmac($mac) {
        $this->mac = $mac;
    }
    public function getfur() {
        return $this->fur;
    }
    public function setfur($fur) {
        $this->fur = $fur;
    }
    public function getpap() {
        return $this->pap_anterior;
    }
    public function setpap($pap_anterior) {
        $this->pap_anterior = $pap_anterior;
    }
    public function getlamina() {
        return $this->num_laminas;
    }
    public function setlamina($num_laminas) {
        $this->num_laminas = $num_laminas;
    }
    public function gettaco() {
        return $this->num_tacos;
    }
    public function settaco($num_tacos) {
        $this->num_tacos = $num_tacos;
    }
    public function getfecha() {
        return $this->fecha;
    }
    public function setfecha($fecha) {
        $this->fecha = $fecha;
    }
    public function getresponsable() {
        return $this->responsable;
    }
    public function setresponsable($responsable) {
        $this->responsable = $responsable;
    }
    public function getprueba() {
        return $this->prueba;
    }
    public function setprueba($prueba) {
        $this->prueba = $prueba;
    }
    public function getuserg() {
        return $this->usuario_registro;
    }
    public function setuserg($usuario_registro) {
        $this->usuario_registro = $usuario_registro;
    }
    public function getfecreg() {
        return $this->fecha_registro;
    }
    public function setfecreg($fecha_registro) {
        $this->fecha_registro = $fecha_registro;
    }
    public function getmarcador() {
        return $this->marcador;
    }
    public function setmarcador($marcador) {
        $this->marcador = $marcador;
    }
    public function getcodprueba() {
        return $this->codigo_prueba;
    }
    public function setcodprueba($codigo_prueba) {
        $this->codigo_prueba = $codigo_prueba;
    }
    public function getcantidad() {
        return $this->cantidad;
    }
    public function setcantidad($cantidad) {
        $this->cantidad = $cantidad;
    }
}
?>