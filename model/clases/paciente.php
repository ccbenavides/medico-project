<?php

require_once 'conexion.php';

class Paciente {

    private $objPDO;
    private $id_paciente;
    private $hora_fecha_atencion;
    private $dni;
    private $a_paterno;
    private $a_materno;
    private $nombre;
    private $sexo;
    private $id_ubigeo;
    private $direccion;
    private $id_tipo_paciente;
    private $fecha_nacimiento;
    private $goc_id;
    private $sishrl_paciente;
    private $usuario_registro;
    private $nom_ape;
    private $edad;
    private $fecha_nac;
    private $tipo_pac;
    private $sishrl;
    private $fecha_registro;
    private $id_pac;
    private $departamento;
    private $provincia;
    private $distrito;

    function __construct($id_paciente = "", $hora_fecha_atencion = "now()", $dni = "", $a_paterno = "", $a_materno = "", $nombre = "", $sexo = "", $fecha_nacimiento = "", $id_ubigeo = "", $direccion = "", 
                        $id_tipo_paciente = "",$goc_id="",$sishrl_paciente="",$usuario_registro="",$nom_ape="",$edad="",$fecha_nac="",
                        $tipo_pac="",$sishrl="",$fecha_registro="now()",$id_pac="") {
        $this->id_paciente = $id_paciente;
        $this->hora_fecha_atencion = $hora_fecha_atencion;
        $this->dni = $dni;
        $this->a_paterno = $a_paterno;
        $this->a_materno = $a_materno;
        $this->nombre = $nombre;
        $this->sexo = $sexo;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->id_ubigeo = $id_ubigeo;
        $this->direccion = $direccion;
        $this->id_tipo_paciente = $id_tipo_paciente;
        $this->goc_id=$goc_id;
        $this->sishrl_paciente=$sishrl_paciente;
        $this->usuario_registro=$usuario_registro;
        $this->nom_ape=$nom_ape;
        $this->edad=$edad;
        $this->fecha_nac=$fecha_nac;
        $this->tipo_pac=$tipo_pac;
        $this->sishrl=$sishrl;
        $this->fecha_registro=$fecha_registro;
        $this->id_pac=$id_pac;
        $this->objPDO = new Conexion();
    }

    /*FUNCIONES PARA HISTORIAL*/
    public function buspac($dni){
        $stmt=$this->objPDO->prepare("SELECT dni,(nombre||' '||a_paterno||' '||a_materno) as nombres,date_part('year',age(fecha_nacimiento)) AS edad,(CASE WHEN sexo='1' THEN 'FEMENINO' ELSE 'MASCULINO' END)as sexo
                                        from sisemer.paciente where dni=:dni ");
        $stmt->execute(array('dni'=>$dni));
        $pacdni=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $pacdni;
    }

     public function consultpacidni($dni){
        $stmt=$this->objPDO->prepare("SELECT * FROM sisemer.paciente where dni=:dni");
        $stmt->execute(array('dni' =>$dni));
        $dnixpac=$stmt->rowCount();
        return $dnixpac;
    }

    //buscar paciente por dni
    public function busquedapac($dni){
        $stmt=$this->objPDO->prepare("SELECT * from sisemer.paciente  WHERE dni=:dni ");
        $stmt->execute(array('dni' => $dni));
        $pacs = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $pacs;
    }

    public function buscarea($dni){
        $stmt=$this->objPDO->prepare("SELECT a.id_area,a.descr_area,pac.dni from sisanatom.biopsia b inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on a.id_area=ta.id_area
                                        inner join sisemer.paciente pac on b.id_paciente=pac.id_paciente
                                        where pac.dni=:dni 
                                        group by a.id_area,a.descr_area,pac.dni
                                        order by a.id_area asc ");
        $stmt->execute(array('dni'=>$dni));
        $areasdni=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $areasdni;
    }

    public function areapq($dni){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,pq.fecha_informe,a.id_area from sisanatom.biopsia b inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a 
                                    on a.id_area=ta.id_area inner join sisanatom.detalle_biopq pq on b.id_biopsia=pq.id_biopsia
                                    inner join sisemer.paciente pac on b.id_paciente=pac.id_paciente
                                    where pac.dni=:dni and a.id_area=1 
                                    order by b.id_biopsia asc ");
        $stmt->execute(array('dni'=>$dni));
        $pqdni=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $pqdni;
    }

    public function areaih($dni){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,pq.fecha_informe,a.id_area from sisanatom.biopsia b inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a 
                                    on a.id_area=ta.id_area inner join sisanatom.detalle_bioih pq on b.id_biopsia=pq.id_biopsia
                                    inner join sisemer.paciente pac on b.id_paciente=pac.id_paciente
                                    where pac.dni=:dni and a.id_area=4
                                    order by b.id_biopsia asc ");
        $stmt->execute(array('dni'=>$dni));
        $ihdni=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $ihdni;
    }

    public function areace($dni){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,pq.fecha_informe,a.id_area from sisanatom.biopsia b inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a 
                                    on a.id_area=ta.id_area inner join sisanatom.detalle_bioce pq on b.id_biopsia=pq.id_biopsia
                                    inner join sisemer.paciente pac on b.id_paciente=pac.id_paciente
                                    where pac.dni=:dni and a.id_area=2
                                    order by b.id_biopsia asc  ");
        $stmt->execute(array('dni'=>$dni));
        $cedni=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $cedni;

    }

    public function areaccv($dni){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,pq.fecha_informe,a.id_area from sisanatom.biopsia b inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a 
                                    on a.id_area=ta.id_area inner join sisanatom.detalle_bioccv pq on b.id_biopsia=pq.id_biopsia
                                    inner join sisemer.paciente pac on b.id_paciente=pac.id_paciente
                                    where pac.dni=:dni and a.id_area=3
                                    order by b.id_biopsia asc");
        $stmt->execute(array('dni'=>$dni));
        $ccvdni=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $ccvdni;
    }

    //listado de pacientes para mantenimiento
    public function cargarPacientes() {

        $stmt = $this->objPDO->prepare("SELECT pac.id_paciente,pac.dni,(pac.a_paterno||(' ')||pac.a_materno||(' ')||pac.nombre) as nombres,gp.goc_descripcion,tp.descripcion from sisemer.paciente pac left join grupoocup gp on pac.goc_id=gp.goc_id 
                                        inner join sisemer.tipo_paciente tp on tp.id_tipo_paciente=pac.id_tipo_paciente
                                        order by nombres asc  ");
        $stmt->execute();
        $pacientes = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $pacientes;
    }
    //listado de pacientes para crear biopsia
    public function listadopaciente(){
        $stmt = $this->objPDO->prepare("SELECT pac.id_paciente,pac.dni,(pac.a_paterno||(' ')||pac.a_materno||(' ')||pac.nombre) as nombres,u.distrito,tp.descripcion from sisemer.paciente pac inner join 
                    sisemer.ubigeo u on pac.id_ubigeo=u.id_ubigeo inner join sisemer.tipo_paciente tp on pac.id_tipo_paciente = tp.id_tipo_paciente");
        $stmt->execute();
        $lpac=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $lpac;
    }
   
    public function cargarPacientes_paginacion($numero) {
        $n = ($numero * 12);
        $stmt = $this->objPDO->prepare("SELECT  ROW_NUMBER() OVER(order by id_paciente desc) AS fila ,id_paciente,dni,(pac.a_paterno||(' ')||pac.a_materno||(' ')||pac.nombre)  as nombres,gp.goc_descripcion,tp.descripcion
                                        from sisemer.paciente pac inner join grupoocup gp on pac.goc_id=gp.goc_id 
                                        inner join sisemer.tipo_paciente tp on tp.id_tipo_paciente=pac.id_tipo_paciente order by id_paciente desc
                                        LIMIT 12 OFFSET $n ");
        $stmt->execute();
        $pacientes = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $pacientes;
    }

    public function eliminar($id) {
        $stmt = $this->objPDO->prepare('DELETE FROM sisemer.paciente WHERE id_paciente = :emp_id');
        $rows = $stmt->execute(array('emp_id' => $id));
        return $rows;
    }

    
    public function modificar() {
        $stmt = $this->objPDO->prepare('UPDATE sisemer.paciente
                                                 SET hora_fecha_atencion=:hora_fecha_atencion, 
                                                     a_paterno=:a_paterno, a_materno=:a_materno, 
                                                     nombre=:nombre, sexo=:sexo, fecha_nacimiento=:fecha_nacimiento, id_ubigeo=:id_ubigeo, direccion=:direccion, 
                                                     id_tipo_paciente=:id_tipo_paciente,goc_id=:goc_id,sishrl_paciente=:sishrl_paciente,edad=:edad,codigosis=:codigosis
                                                     WHERE id_paciente= :id_paciente;');
        $rows = $stmt->execute(array('hora_fecha_atencion' => $this->hora_fecha_atencion,
            'a_paterno' => trim($this->borrarEspacios($this->a_paterno)),
            'a_materno' => trim($this->borrarEspacios($this->a_materno)),
            'nombre' => trim($this->borrarEspacios($this->nombre)),
            'sexo' => $this->sexo,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'id_ubigeo' => $this->id_ubigeo,
            'direccion' => trim($this->borrarEspacios($this->direccion)),
            'id_tipo_paciente' => $this->id_tipo_paciente,
            'goc_id'=>$this->goc_id,
            'sishrl_paciente'=>$this->sishrl_paciente,
            'edad'=>$this->edad,
            'codigosis'=>$this->codigosis,
            'id_paciente' => $this->id_paciente));
    }

     public function insertar() {
        $stmt = $this->objPDO->prepare('INSERT INTO sisemer.paciente(
                                        hora_fecha_atencion, dni, a_paterno, a_materno, 
                                        nombre, sexo, fecha_nacimiento, id_ubigeo, direccion, id_tipo_paciente,goc_id,sishrl_paciente,edad,codigosis)
                                        VALUES (:hora_fecha_atencion,
                                                 :dni,:a_paterno, :a_materno, :nombre, 
                                                :sexo, :fecha_nacimiento, :id_ubigeo, :direccion, :id_tipo_paciente,:goc_id,:sishrl_paciente,:edad,:codigosis);');
        $stmt->execute(array('hora_fecha_atencion' => $this->hora_fecha_atencion,
            'dni' => $this->dni,
            'a_paterno' => trim($this->borrarEspacios($this->a_paterno)),
            'a_materno' => trim($this->borrarEspacios($this->a_materno)),
            'nombre' => trim($this->borrarEspacios($this->nombre)),
            'sexo' => $this->sexo,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'id_ubigeo' => $this->id_ubigeo,
            'direccion' => trim($this->borrarEspacios($this->direccion)),
            'id_tipo_paciente' => $this->id_tipo_paciente,
            'goc_id'=>$this->goc_id,
            'sishrl_paciente'=>$this->sishrl_paciente,
            'edad'=>$this->edad,
            'codigosis'=>$this->codigosis));
    }                     
    

    function obtener_pacientexid() {
        $stmt = $this->objPDO->prepare("SELECT id_paciente, hora_fecha_atencion, dni, a_paterno, a_materno, 
                                        nombre, sexo,fecha_nacimiento,departamento,provincia,distrito, direccion, id_tipo_paciente,goc_id,sishrl_paciente,edad,codigosis
                                        FROM sisemer.paciente left join sisemer.ubigeo on sisemer.paciente.id_ubigeo=sisemer.ubigeo.id_ubigeo
                                        where id_paciente = '" . $this->id_paciente . "';");
        $stmt->execute();
        $pacientes = $stmt->fetchAll(PDO::FETCH_OBJ);

        foreach ($pacientes as $paciente) {
            $this->setIdPaciente($paciente->id_paciente);
            $this->setNombre($paciente->nombre);
            $this->setA_paterno($paciente->a_paterno);
            $this->setA_materno($paciente->a_materno);
            $this->setDni($paciente->dni);
            $this->setSexo($paciente->sexo);
            $this->setFecha_nacimiento($paciente->fecha_nacimiento);
            $this->setdepartamento($paciente->departamento);
            $this->setprovincia($paciente->provincia);
            $this->setdistrito($paciente->distrito);
            $this->setDireccion($paciente->direccion);
            $this->setId_tipo_paciente($paciente->id_tipo_paciente);
            $this->setGoc_id($paciente->goc_id);
            $this->setsishrl_paciente($paciente->sishrl_paciente);
            $this->setEdad($paciente->edad);
            $this->setcodigosis($paciente->codigosis);
        }
        return $this;
    }

    function obtenerpacxid(){
        $stmt = $this->objPDO->prepare("SELECT id_paciente, dni FROM sisemer.paciente 
                                where id_paciente = '" . $this->id_paciente . "';");
        $stmt->execute();
        $pacientes = $stmt->fetchAll(PDO::FETCH_OBJ);

        foreach ($pacientes as $paciente) {
            $this->setIdPaciente($paciente->id_paciente);
            $this->setDni($paciente->dni);            
        }
        return $this;
    }
    
    public function obtenerxcod($dni){
        $stmt=$this->objPDO->prepare("SELECT pa.id_paciente,pa.dni,(pa.nombre||' '||pa.a_paterno||' '||pa.a_materno)as nombres,u.departamento,tp.descripcion
                                        from sisemer.paciente pa inner join sisemer.ubigeo u on pa.id_ubigeo=u.id_ubigeo inner join sisemer.tipo_paciente tp 
                                        on pa.id_tipo_paciente=tp.id_tipo_paciente where pa.dni=:dni");
        $stmt->execute(array('dni'=>$dni));
        $dnipac=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $dnipac;
    }

    public function obtenerxid($dni){
        $stmt = $this->objPDO->prepare("SELECT id_paciente,dni from sisemer.paciente where dni=:dni");
        $stmt->execute(array('dni'=>$dni));
        $bpac = $stmt->rowCount();
          return $bpac;
    }

    public function cargar_busqueda_nombre($valor) {

        $stmt = $this->objPDO->prepare("SELECT pa.id_paciente,pa.dni,(pa.a_paterno||' '||pa.a_materno||' '||pa.nombre)as nombres,u.departamento,tp.descripcion
                                        from sisemer.paciente pa inner join sisemer.ubigeo u on pa.id_ubigeo=u.id_ubigeo inner join sisemer.tipo_paciente tp 
                                        on pa.id_tipo_paciente=tp.id_tipo_paciente where (pa.a_paterno||' '||pa.a_materno||' '||pa.nombre) like '%$valor%'");
        $stmt->execute();
        $pacientes = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $pacientes;
    }

    public function cargar_busqueda_dni($valor) {

        $stmt = $this->objPDO->prepare("SELECT pa.id_paciente,pa.dni,(pa.a_paterno||' '||pa.a_materno||' '||pa.nombre)as nombres,u.goc_descripcion,tp.descripcion
                                        from sisemer.paciente pa inner join grupoocup u on pa.goc_id =u.goc_id inner join sisemer.tipo_paciente tp 
                                        on pa.id_tipo_paciente=tp.id_tipo_paciente 
                                        where pa.dni like '$valor%' or (pa.a_paterno||(' ')||pa.a_materno||(' ')||pa.nombre) like '$valor%'");
        $stmt->execute();
        $pacientes = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $pacientes;
    }   

    public function obtenerpac($dni){
        $stmt=$this->objPDO->prepare("SELECT id_paciente from sisemer.paciente where dni=:dni");
        $stmt->execute(array('dni' => $dni ));
        $listpaciente = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $listpaciente[0]->id_paciente;
    }

    public function listarpacientexdesc($descpaciente) {
        $stmt = $this->objPDO->prepare("SELECT  (a_paterno||(' ')||a_materno||(' ')||nombre||('|')||id_paciente) as value , dni as label FROM sisemer.paciente where dni like :descpaciente");
        $stmt->execute(array('descpaciente' => $descpaciente ));
        $listpacientes = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $listpacientes;
    }

    
    public function getFullName() {
        return $this->getNombre() . " " . $this->getA_paterno() . " " . $this->getA_materno();
    }

    public function getFecha_nacimiento() {
        return $this->fecha_nacimiento;
    }

    public function setFecha_nacimiento($fecha_nacimiento) {
        $this->fecha_nacimiento = $fecha_nacimiento;
    }

    public function getIdPaciente() {
        return $this->id_paciente;
    }

    public function getHora_fecha_atencion() {
        return $this->hora_fecha_atencion;
    }

    public function getDni() {
        return $this->dni;
    }

    public function getA_paterno() {
        return $this->a_paterno;
    }

    public function getA_materno() {
        return $this->a_materno;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getSexo() {
        return $this->sexo;
    }

    public function getId_ubigeo() {
        return $this->id_ubigeo;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getId_tipo_paciente() {
        return $this->id_tipo_paciente;
    }

    public function getGoc_id(){
        return $this->goc_id;
    }
    public function getsishrl_paciente(){
        return $this->sishrl_paciente;
    }
    public function getEdad(){
        return $this->edad;
    }
    public function setEdad($edad) {
        $this->edad = $edad;
    }
    public function getcodigosis(){
        return $this->codigosis;
    }
    public function setcodigosis($codigosis){
        $this->codigosis=$codigosis;
    }
    public function getdepartamento(){
        return $this->departamento;
    }
    public function setdepartamento($departamento){
        $this->departamento=$departamento;
    }
    public function getprovincia(){
        return $this->provincia;
    }
    public function setprovincia($provincia){
        $this->provincia=$provincia;
    }
    public function getdistrito(){
        return $this->distrito;
    }
    public function setdistrito($distrito){
        $this->distrito=$distrito;
    }
    public function getNomApe(){
        return $this->nom_ape;
    }
    public function setNomApe($nom_ape) {
        $this->nom_ape = $nom_ape;
    }

    public function setIdPaciente($id_paciente) {
        $this->id_paciente = $id_paciente;
    }

    public function setHora_fecha_atencion($hora_fecha_atencion) {
        $this->hora_fecha_atencion = $hora_fecha_atencion;
    }

    public function setDni($dni) {
        $this->dni = $dni;
    }

    public function setA_paterno($a_paterno) {
        $this->a_paterno = $a_paterno;
    }

    public function setA_materno($a_materno) {
        $this->a_materno = $a_materno;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    public function setId_ubigeo($id_ubigeo) {
        $this->id_ubigeo = $id_ubigeo;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function setId_tipo_paciente($id_tipo_paciente) {
        $this->id_tipo_paciente = $id_tipo_paciente;
    }

    public function setGoc_id($goc_id){
        $this->goc_id=$goc_id;
    }
    public function setsishrl_paciente($sishrl_paciente){
        $this->sishrl_paciente=$sishrl_paciente;
    }

    public function borrarEspacios($cadena) {
        $trozos = explode(" ", $cadena);
        $cadena_nueva = "";
        foreach ($trozos as $value) {
            if ($value != "") {
                $cadena_nueva .= ($value) . " ";
            }
        }
        return $cadena_nueva;
    }

}

?>
