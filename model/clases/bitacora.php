<?php
require_once 'conexion.php';

class bitacora {

    private $bita_id;
    private $id_usuario;
    private $accion;
    private $fecha;
    private $tabla;
    private $host;
    private $hostname;
    private $objPdo;
    private $fecha_conexion;
    private $fecha_desconexion;
    private $id_registro;
    private $campo;

    function __construct($bita_id= null, $id_usuario='', $accion='', $fecha='', $tabla='', $host='', $hostname='',$fecha_conexion='',$fecha_desconexion='',$id_registro='',$campo='') {
        $this->bita_id = $bita_id;
        $this->id_usuario = $id_usuario;
        $this->accion = $accion;
        $this->fecha = $fecha;
        $this->tabla = $tabla;
        $this->host = $host;
        $this->hostname =$hostname ;
        $this->fecha_conexion=$fecha_conexion;
        $this->fecha_desconexion=$fecha_desconexion;
        $this->id_registro=$id_registro;
        $this->campo=$campo;
        $this->objPdo = new Conexion();
    }

    public function listarconexion_user($emp_id){
        $stmt=$this->objPdo->prepare("SELECT cu.fecha_conexion::date,to_char(cu.fecha_conexion,'HH24:MI:SS') as hora_conexion,
                                        cu.fecha_desconexion::date,to_char(cu.fecha_desconexion,'HH24:MI:SS')as hora_desconexion,cu.host,cu.hostname from sisanatom.conexion_usuario cu inner join sisanatom.usuarios_anat ua on cu.id_usuario=ua.id_usuario
                                        inner join empleados e on ua.emp_id=e.emp_id
                                        where e.emp_id=:emp_id ");
        $stmt->execute(array('emp_id'=>$emp_id));
        $conexiones=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $conexiones;
    }


    public function insertar() {
        $stmt = $this->objPdo->prepare('INSERT INTO sisanatom.bitacora_anat( id_usuario, accion , tabla, host, hostname,campo) 
            VALUES (:id_usuario, :accion,:tabla,:host,:hostname,:campo);');
        $rows = $stmt->execute(array('id_usuario' => $this->id_usuario,
            'accion' => $this->accion,
            'tabla' => $this->tabla,
            'host' => $this->host,
            'hostname' => $this->hostname,
            'campo'=>$this->campo));
    }

    public function buscabituser($id_usuario){
        $stmt=$this->objPdo->prepare("SELECT max(bita_id)as bita_id from sisanatom.bitacora_anat where id_usuario=:id_usuario and accion='MODIFICAR' and tabla='USUARIOS_ANAT'");
        $stmt->execute(array('id_usuario'=>$id_usuario));
        $busb=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $busb[0]->bita_id;
    }

    public function insertaconexion(){
        $stmt=$this->objPdo->prepare('INSERT INTO sisanatom.conexion_usuario(id_usuario,host,hostname) VALUES (:id_usuario,:host,:hostname);');
        $rows=$stmt->execute(array('id_usuario'=>$this->id_usuario,'host'=>$this->host,'hostname'=>$this->hostname));
    }

    public function busqueda($id_usuario){
        $stmt=$this->objPdo->prepare("SELECT max(cu.id_registro) from sisanatom.conexion_usuario cu inner join sisanatom.usuarios_anat ua on ua.id_usuario=cu.id_usuario
                                    where ua.nom_usuario=:id_usuario");
        $stmt->execute(array('id_usuario'=>$id_usuario));
        $codigo=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $codigo[0]->max;
    }

    public function modificarconexion(){
        $stmt=$this->objPdo->prepare("UPDATE sisanatom.conexion_usuario SET fecha_desconexion=(select now())   
                                        WHERE id_registro=:id_registro");
        $rows=$stmt->execute(array('id_registro'=>$this->id_registro));
    }

    public function consultar() {
        $stmt = $this->objPdo->prepare("SELECT  bit.bita_id,emp.emp_dni as dni, emp.emp_appaterno||' '||emp.emp_apmaterno||' '||emp.emp_nombres  as nombres , usua.nom_usuario as nick,bit.accion as accion , 
										(CASE WHEN EXTRACT(DOW FROM bit.fecha)=0 THEN 'DOMINGO'
											     WHEN EXTRACT(DOW FROM bit.fecha)=1 THEN 'LUNES'
											     WHEN EXTRACT(DOW FROM bit.fecha)=2 THEN 'MARTES'
											     WHEN EXTRACT(DOW FROM bit.fecha)=3 THEN 'MIERCOLES'
											     WHEN EXTRACT(DOW FROM bit.fecha)=4 THEN 'JUEVES'
											     WHEN EXTRACT(DOW FROM bit.fecha)=5 THEN 'VIERNES'
											     WHEN EXTRACT(DOW FROM bit.fecha)=6 THEN 'SABADO'
										END)||' '||(EXTRACT(DAY FROM bit.fecha)::text)||' DE '||(CASE WHEN EXTRACT(MONTH FROM bit.fecha)=1 THEN 'ENERO'
																 WHEN EXTRACT(MONTH FROM bit.fecha)=2 THEN 'FEBRERO'
																 WHEN EXTRACT(MONTH FROM bit.fecha)=3 THEN 'MARZO'
																 WHEN EXTRACT(MONTH FROM bit.fecha)=4 THEN 'ABRIL'
																 WHEN EXTRACT(MONTH FROM bit.fecha)=5 THEN 'MAYO'
																 WHEN EXTRACT(MONTH FROM bit.fecha)=6 THEN 'JUNIO'
																 WHEN EXTRACT(MONTH FROM bit.fecha)=7 THEN 'JULIO'	
																 WHEN EXTRACT(MONTH FROM bit.fecha)=8 THEN 'AGOSTO'
																 WHEN EXTRACT(MONTH FROM bit.fecha)=9 THEN 'SETIEMBRE'
																 WHEN EXTRACT(MONTH FROM bit.fecha)=10 THEN 'OCTUBRE'
																 WHEN EXTRACT(MONTH FROM bit.fecha)=11 THEN 'NOVIEMBRE'
																 WHEN EXTRACT(MONTH FROM bit.fecha)=12 THEN 'DICIEMBRE'
										END)||' DEL '||EXTRACT(YEAR FROM fecha)||' A LAS '||to_char(fecha, 'HH:MI p.m.') AS fecha , bit.tabla as tabla, bit.host as host, bit.hostname as hostname
										                                        from sisanatom.bitacora_anat  bit
										                                        inner join sisanatom.usuarios_anat usua on usua.id_usuario = bit.id_usuario
										                                        inner join empleados emp on emp.emp_id = usua.emp_id
										                                        order by bita_id DESC");
        $stmt->execute();
        $empleados = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $empleados;
    }

    public function getObjPdo() {
        return $this->objPdo;
    }

    public function setObjPdo($objPdo) {
        $this->objPdo = $objPdo;
    }

    public function getBita_id() {
        return $this->bita_id;
    }

    public function getUsr_id() {
        return $this->id_usuario;
    }

    public function getTabla() {
        return $this->tabla;
    }

    public function getAccion() {
        return $this->accion;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getHost() {
        return $this->host;
    }

    public function getHostname() {
        return $this->hostname;
    }

    public function setBita_id($bita_id) {
        $this->bita_id = $bita_id;
    }

    public function setUsr_id($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function setTabla($tabla) {
        $this->tabla = $tabla;
    }

    public function setAccion($accion) {
        $this->accion = $accion;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function setHost($host) {
        $this->host = $host;
    }

    public function setHostname($hostname) {
        $this->hostname = $hostname;
    }

    public function setRegistro($id_registro) {
        $this->id_registro = $id_registro;
    }

    public function getRegistro() {
        return $this->id_registro;
    }

    public function setCampo($campo) {
        $this->campo = $campo;
    }

    public function getCampo() {
        return $this->campo;
    }


}

?>