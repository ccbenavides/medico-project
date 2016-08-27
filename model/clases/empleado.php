<?php

require_once 'conexion.php';
// require_once 'dependencias.php';
// require_once 'niveles.php';
// require_once 'grupo-ocupacional.php';
// require_once 'tipo-trabajador.php';
// require_once 'validacion-programacion.php';
// require_once 'programacion.php';


//SE AGREGO EL CAMPO emp_colegiatura
class Empleados {

    private $emp_id;
    private $emp_dni;
    private $emp_nombres;
    private $emp_appaterno;
    private $emp_apmaterno;
    private $trab_id;
    private $emp_estado;
    private $sexo;
    private $direccion;
    private $usu_registra;
    private $fecha_registro;
    private $goc_id;
    private $emp_colegiatura;
    private $objPDO;
    private $count;

    public function __construct($emp_dni = '', $emp_nombres = '', $emp_appaterno = '', $emp_apmaterno = '', $trab_id = '', $dep_id = '', $niv_id = '', $goc_id = '', $emp_jefedep = '', $usr_id = '', $emp_id = NULL, $emp_fechareg = NULL, $emp_foto = '',$emp_colegiatura='') {
        $this->emp_id = $emp_id;
        $this->emp_dni = $emp_dni;
        $this->emp_nombres = $emp_nombres;
        $this->emp_appaterno = $emp_appaterno;
        $this->emp_apmaterno = $emp_apmaterno;
        $this->trab_id = $trab_id;
        $this->dep_id = $dep_id;
        $this->niv_id = $niv_id;
        $this->goc_id = $goc_id;
        $this->emp_jefedep = $emp_jefedep;
        $this->usr_id = $usr_id;
        $this->emp_fechareg = $emp_fechareg;
        $this->emp_foto = $emp_foto;
        $this->emp_colegiatura = $emp_colegiatura;
        $this->objPDO = new Conexion();
    }

   

    public function consultar() {
        $stmt = $this->objPDO->prepare("SELECT e.emp_id,e.emp_dni,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno)as nombres ,g.goc_descripcion,e.emp_colegiatura
                            from sisanatom.emp_anat e inner join grupoocup g on e.goc_id=g.goc_id where e.emp_id>1 and e.emp_estado='0'");
        $stmt->execute();
        $empleados = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $empleados;
    }

    public function listartrab(){
        $stmt = $this->objPDO->prepare("SELECT * from tipotrab order by trab_id;");
        $stmt->execute();
        $trab = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $trab;
    }

    public function listargoc(){
        $stmt = $this->objPDO->prepare("SELECT * from grupoocup order by goc_id;");
        $stmt->execute();
        $goc = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $goc;
    }

    public function consultarparametro($buscarnombre) {
        $stmt = $this->objPDO->prepare("SELECT e.emp_id, e.emp_dni, e.emp_nombres, e.emp_appaterno, e.emp_apmaterno, e.trab_id, depa.depa_descripcion as departamento, dep.dep_id, e.niv_id, e.goc_id, e.emp_jefedep, e.usr_id, e.emp_fechareg, e.emp_foto FROM empleados e  left join dependencias dep on
            e.dep_id=dep.dep_id left join departamentos depa on
            dep.depa_id=depa.depa_id  where UPPER(e.emp_nombres) LIKE '%'||UPPER('$buscarnombre')||'%'  ORDER BY emp_appaterno, emp_apmaterno;");
        $stmt->execute();
        $empleados = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $empleados;
    }
    public function consultarpaginado($buscarnombre,$offset,$rowsPerPage) {
        $stmt = $this->objPDO->prepare("SELECT e.emp_id, e.emp_dni, e.emp_nombres, e.emp_appaterno, e.emp_apmaterno, e.trab_id, depa.depa_descripcion as departamento, dep.dep_id, e.niv_id, e.goc_id, e.emp_jefedep, e.usr_id, e.emp_fechareg, e.emp_foto FROM empleados e  left join dependencias dep on
            e.dep_id=dep.dep_id left join departamentos depa on
            dep.depa_id=depa.depa_id  where UPPER(e.emp_nombres) LIKE '%'||UPPER('$buscarnombre')||'%'  ORDER BY emp_appaterno, emp_apmaterno LIMIT $rowsPerPage offset $offset;");
        $stmt->execute();
        $empleados = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $empleados;
    }

    

    public function insertar() {
        $stmt = $this->objPDO->prepare('INSERT INTO sisanatom.emp_anat (emp_dni,emp_nombres,emp_appaterno,emp_apmaterno,trab_id,goc_id,emp_colegiatura,emp_estado,usu_registra,fecha_registro,sexo,direccion) 
                                        VALUES(:emp_dni,:emp_nombres,:emp_appaterno,:emp_apmaterno,:trab_id,:goc_id,:emp_colegiatura,:emp_estado,:usu_registra,:fecha_registro,:sexo,:direccion)');
        $stmt->execute(array('emp_dni' => $this->emp_dni,
                                    'emp_nombres' => $this->emp_nombres,
                                    'emp_appaterno' => $this->emp_appaterno,
                                    'emp_apmaterno' => $this->emp_apmaterno,
                                    'trab_id' => $this->trab_id,
                                    'goc_id' => $this->goc_id,
                                    'emp_colegiatura'=> $this->emp_colegiatura,
                                    'emp_estado' => $this->emp_estado,
                                    'usu_registra' => $this->usu_registra,
                                    'fecha_registro'=>$this->fecha_registro,
                                    'sexo' => $this->sexo,
                                    'direccion'=>$this->direccion));
    }

    public function eliminar($emp_id) {
        $stmt = $this->objPDO->prepare("UPDATE sisanatom.emp_anat set emp_estado='1' where emp_id=:emp_id");
        $rows = $stmt->execute(array('emp_id' => $emp_id));
        return $rows;
    }

    public function modificar() {
        $stmt = $this->objPDO->prepare('UPDATE sisanatom.emp_anat SET emp_dni=:emp_dni, emp_nombres=:emp_nombres, emp_appaterno=:emp_appaterno, emp_apmaterno=:emp_apmaterno, 
                                        trab_id=:trab_id, goc_id=:goc_id, emp_colegiatura=:emp_colegiatura,emp_estado=:emp_estado,usu_registra=:usu_registra,fecha_registro=:fecha_registro,sexo=:sexo,direccion=:direccion
                                        WHERE emp_id = :emp_id');
        $stmt->execute(array('emp_dni' => $this->emp_dni,
                                    'emp_nombres' => $this->emp_nombres,
                                    'emp_appaterno' => $this->emp_appaterno,
                                    'emp_apmaterno' => $this->emp_apmaterno,
                                    'trab_id' => $this->trab_id,
                                    'goc_id' => $this->goc_id,
                                    'emp_colegiatura'=> $this->emp_colegiatura,
                                    'emp_estado' => $this->emp_estado,
                                    'usu_registra' => $this->usu_registra,
                                    'fecha_registro'=>$this->fecha_registro,
                                    'sexo' => $this->sexo,
                                    'direccion'=>$this->direccion,
                                    'emp_id'=>$this->emp_id));
    }
    
    public function obtener_empxid($emp_id) {
        $stmt = $this->objPDO->prepare("SELECT emp_id,emp_dni,emp_nombres,emp_appaterno,emp_apmaterno,trab_id,goc_id,emp_colegiatura,sexo,direccion
                                        FROM sisanatom.emp_anat where emp_id=:emp_id");
        $stmt->execute(array('emp_id'=>$emp_id));
        $emps = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach ($emps as $empss) {
            $this->setEmp_id($empss->emp_id);
            $this->setEmp_dni($empss->emp_dni);
            $this->setEmp_nombres($empss->emp_nombres);
            $this->setEmp_appaterno($empss->emp_appaterno);
            $this->setEmp_apmaterno($empss->emp_apmaterno);
            $this->setTrab_id($empss->trab_id);
            $this->setGoc_id($empss->goc_id);
            $this->setEmp_colegiatura($empss->emp_colegiatura);
            $this->setsexo($empss->sexo);
            $this->setdireccion($empss->direccion);
        }
        return $this;
    }

    
    /*
     * devuelve la lista de empleados filtrados por turno
     */
    
    
    public function buscarxNombre($nombre) {
        $nombrec = "%".$nombre."%";
        $stmt = $this->objPDO->prepare("SELECT * FROM empleados WHERE emp_nombres LIKE :nombrec OR emp_appaterno LIKE :nombrec OR emp_apmaterno LIKE :nombrec");
        $stmt->execute(array('nombrec' => $nombrec));
        $empleados = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $empleados;
    }
   
     //muestra la lista de medicos
    public function muestramed($dep){
        $stm = $this->objPDO->prepare("SELECT '1'::integer as numero,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno)as nombre FROM empleados e inner join grupoocup goc on e.goc_id=goc.goc_id
                                        where (goc.goc_id=1 or goc.goc_id=34 or goc.goc_id=36 or goc.goc_id=37 or goc.goc_id=57 or goc.goc_id=7 
                                        or goc.goc_id=27) and e.emp_jefedep='1' and e.dep_id=:dep
                                    UNION
                                    SELECT '2'::integer as numero,'OTRO'::text as nombre
                                    order by numero asc ;");
        $stm->execute(array('dep'=>$dep));
        $area = $stm->fetchAll(PDO::FETCH_OBJ);
        return $area;
    }

    public function obtenerempleado($id_empleado){
        $stmt=$this->objPDO->prepare("SELECT emp_id from empleados where emp_id=:id_empleado");
        $stmt->execute(array('id_empleado' => $id_empleado ));
        $listpaciente = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $listpaciente[0]->emp_id;
    }

    //lista todos los empleados de anatomia patologica
    public function listaemppatologia(){
        $stm = $this ->objPDO->prepare("SELECT emp_id,(emp_appaterno||' '||emp_apmaterno||' '||emp_nombres)as nombre from empleados where dep_id=27 or dep_id=24 or dep_id=156 or dep_id=165 or dep_id=235
                                        UNION
                                        select emp_id,(emp_appaterno||' '||emp_apmaterno||' '||emp_nombres)as nombre from empleados where emp_id=9
                                        order by nombre asc");
        $stm->execute();
        $empleado = $stm->fetchAll(PDO::FETCH_OBJ);
        return $empleado;
    }

    
  ///////////////----------------------FIN---------------------///////////////////


    public function getEmp_id() {
        return $this->emp_id;
    }

    public function setEmp_id($emp_id) {
        $this->emp_id = $emp_id;
    }

    public function getEmp_dni() {
        return $this->emp_dni;
    }

    public function setEmp_dni($emp_dni) {
        $this->emp_dni = $emp_dni;
    }

    public function getEmp_nombres() {
        return $this->emp_nombres;
    }

    public function setEmp_nombres($emp_nombres) {
        $this->emp_nombres = $emp_nombres;
    }

    public function getEmp_appaterno() {
        return $this->emp_appaterno;
    }

    public function setEmp_appaterno($emp_appaterno) {
        $this->emp_appaterno = $emp_appaterno;
    }

    public function getEmp_apmaterno() {
        return $this->emp_apmaterno;
    }

    public function setEmp_apmaterno($emp_apmaterno) {
        $this->emp_apmaterno = $emp_apmaterno;
    }

    public function getTrab_id() {
        return $this->trab_id;
    }

    public function setTrab_id($trab_id) {
        $this->trab_id = $trab_id;
    }

    public function getestado() {
        return $this->emp_estado;
    }

    public function setestado($emp_estado) {
        $this->emp_estado = $emp_estado;
    }

    public function getusureg() {
        return $this->usu_registra;
    }

    public function setusureg($usu_registra) {
        $this->usu_registra = $usu_registra;
    }

    public function getGoc_id() {
        return $this->goc_id;
    }

    public function setGoc_id($goc_id) {
        $this->goc_id = $goc_id;
    }

    public function getfecha() {
        return $this->fecha_registro;
    }

    public function setfecha($fecha_registro) {
        $this->fecha_registro = $fecha_registro;
    }

    public function getsexo() {
        return $this->sexo;
    }

    public function setsexo($sexo) {
        $this->sexo = $sexo;
    }

    public function getdireccion() {
        return $this->direccion;
    }

    public function setdireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function getNombreCompleto() {
        return $this->emp_appaterno . " " . $this->emp_apmaterno . " " . $this->emp_nombres;
    }

    public function getCount() {
        return $this->count;
    }

    public function setCount($count) {
        $this->count = $count;
    }
    
    public function getEmp_colegiatura() {
        return $this->emp_colegiatura;
    }

    public function setEmp_colegiatura($emp_colegiatura) {
        $this->emp_colegiatura = $emp_colegiatura;
    }


}

?>