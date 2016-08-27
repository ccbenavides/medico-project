<?php

require_once 'conexion.php';

class UsuarioAnat {

    private $objPdo;
    private $id_usuario;
    private $emp_id;
    private $id_perfil;
    private $nom_usuario;
    private $clave_usuario;
    private $estado;
    private $id_usubaja;
    private $motivo;
    private $id_usuregistra;
    private $clave_temporal;

    public function __construct($id_usuario="",$emp_id="",$id_perfil="",$nom_usuario="",$clave_usuario="",$estado="",$clave_temporal="") {
        $this->id_usuario = $id_usuario;
        $this->emp_id = $emp_id;
        $this->id_perfil = $id_perfil;
        $this->nom_usuario = $nom_usuario;
        $this->clave_usuario = $clave_usuario;
        $this->estado = $estado;
        $this->clave_temporal=$clave_temporal;
        $this->objPdo = new Conexion();
    }

    public function passworaleatorio(){
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $cad = "";
        for($i=0;$i<10;$i++) {
        $cad .= substr($str,rand(0,62),1);
        }
        return $cad;
    }

      public function consultausuario($emp_id){
        $stmt=$this->objPdo->prepare("SELECT * FROM sisanatom.usuarios_anat where emp_id=:emp_id");
        $stmt->execute(array('emp_id' =>$emp_id));
        $dnixpac=$stmt->rowCount();
        return $dnixpac;
    }

    public function formatusuario($id_usuario){
        $stmt=$this->objPdo->prepare("SELECT e.emp_id,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno)as empleado,
                                        ua.nom_usuario,ua.clave_usuario,ua.fecha_registro::date||' '||to_char(to_timestamp(((EXTRACT (HOUR FROM ua.fecha_registro))||':'||(EXTRACT (MINUTE from ua.fecha_registro))),'HH24:MI'),'HH:MI p.m.') as fecha_registro
                                        from sisanatom.usuarios_anat ua inner join empleados e on ua.emp_id=e.emp_id 
                                        where id_usuario=:id_usuario");
        $stmt->execute(array('id_usuario'=>$id_usuario));
        $infousuario=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $infousuario;
    }

    public function opcperfil($id_perfil){
        $stmt=$this->objPdo->prepare("SELECT menu0.id_menu_anat,menu0.menu_descr,menu1.descripcion FROM
                                    (SELECT id_menu_anat,menu_descr from sisanatom.menu_ant)menu0 inner join 
                                    (SELECT ma.id_padre,ma.menu_descr as descripcion FROM sisanatom.menu_perfil_anat mp inner join sisanatom.perfil_usuarios pu on mp.id_perfil=pu.id_perfil
                                    inner join sisanatom.menu_ant ma on mp.idmenu_anat=ma.id_menu_anat where mp.id_perfil=:id_perfil and ma.id_padre>0)menu1 on menu1.id_padre=menu0.id_menu_anat
                                    order by id_menu_anat asc ");
        $stmt->execute(array('id_perfil'=>$id_perfil));
        $infoperfil=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $infoperfil;
    }

    public function encuentraper($id_perfil){
        $stmt=$this->objPdo->prepare("SELECT descr_perfil from sisanatom.perfil_usuarios where id_perfil=:id_perfil");
        $stmt->execute(array('id_perfil'=>$id_perfil));
        $enper=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $enper[0]->descr_perfil;
    }

    public function nomuser($emp_id){
        $stmt=$this->objPdo->prepare("SELECT emp_dni as nick from empleados where emp_id=:emp_id ");
        $stmt->execute(array('emp_id'=>$emp_id));
        $nick=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $nick[0]->nick;
    }

     public function usr_emp($id_usuario){
        $stmt=$this->objPdo->prepare("SELECT e.emp_id from sisanatom.usuarios_anat ua inner join empleados e on ua.emp_id=e.emp_id where ua.id_usuario=:id_usuario");
        $stmt->execute(array('id_usuario'=>$id_usuario));
        $empusr=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $empusr[0]->emp_id;
    }
 
        public function validarID($user, $pass){
        $stmt=$this->objPdo->prepare('SELECT * from sisanatom.usuarios_anat ua inner join sisanatom.perfil_usuarios pu on
                        ua.id_perfil = pu.id_perfil where ua.estado=true and ua.nom_usuario=:user and ua.clave_usuario=:pass;');
        $stmt->execute(array('user' => $user,
                            'pass' => $pass));
        $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $usuarios;
    }

    public function listadousuarios(){
        $sql = "SELECT ua.id_usuario,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno)as nombre,ua.nom_usuario,ua.clave_usuario,pu.descr_perfil,
                (CASE WHEN ua.estado=true THEN 'Activo' ELSE 'Inactivo' END) as estado
                from sisanatom.usuarios_anat ua inner join empleados e on ua.emp_id = e.emp_id
                inner join sisanatom.perfil_usuarios pu on ua.id_perfil = pu.id_perfil ";
        $stmt=$this->objPdo->prepare($sql);
        $stmt->execute();
        $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $usuarios;
    }

    public function insertar(){
        $stmt =$this->objPdo->prepare("INSERT INTO sisanatom.usuarios_anat (emp_id,id_perfil,nom_usuario,clave_usuario,estado,clave_temporal)
                                       values(:emp_id,:id_perfil,:nom_usuario,:clave_usuario,:estado,:clave_temporal);");
        $stmt->execute(array('emp_id' => $this->emp_id,
                             'id_perfil'=>$this->id_perfil,
                             'nom_usuario'=>$this->nom_usuario,
                             'clave_usuario'=>$this->clave_usuario,
                             'estado'=>$this->estado,
                             'clave_temporal'=>$this->clave_temporal));
    }

    public function insertahistorial(){
        $stmt=$this->objPdo->prepare("INSERT INTO sisanatom.historial_perfil (id_usuario,id_perfil) values(:id_usuario,:id_perfil);");
        $stmt->execute(array('id_usuario'=>$this->id_usuario,
                              'id_perfil'=>$this->id_perfil));
    }

    public function buscarusu($nom_usuario){
        $stmt=$this->objPdo->prepare("SELECT * from sisanatom.usuarios_anat WHERE nom_usuario=:nom_usuario ");
        $stmt->execute(array('nom_usuario' => $nom_usuario));
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $users;
    }

    public function buscaremp($nom_usuario){
        $stmt=$this->objPdo->prepare("SELECT emp_id from empleados where emp_dni=:nom_usuario");
        $stmt->execute(array('nom_usuario'=>$nom_usuario));
        $empu=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $empu[0]->emp_id;
    }

    public function buscarper($nom_usuario){
        $stmt=$this->objPdo->prepare("SELECT id_perfil FROM sisanatom.usuarios_anat where nom_usuario=:nom_usuario");
        $stmt->execute(array('nom_usuario'=>$nom_usuario));
        $perfus=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $perfus[0]->id_perfil;
    }

    public function buscarclave($nom_usuario){
        $stmt=$this->objPdo->prepare("SELECT clave_usuario FROM sisanatom.usuarios_anat where nom_usuario=:nom_usuario");
        $stmt->execute(array('nom_usuario'=>$nom_usuario));
        $claus=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $claus[0]->clave_usuario;
    }

    public function buscempusu($emp_id){
        $stmt=$this->objPdo->prepare("SELECT id_usuario from sisanatom.usuarios_anat where emp_id=:emp_id");
        $stmt->execute(array('emp_id'=>$emp_id));
        $nempu=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $nempu[0]->id_usuario;
    }

    public function modificar(){
        $stmt = $this ->objPdo->prepare("UPDATE sisanatom.usuarios_anat
                                         SET emp_id=:emp_id,id_perfil=:id_perfil,nom_usuario=:nom_usuario,
                                         clave_usuario=:clave_usuario,estado=:estado 
                                         WHERE id_usuario=:id_usuario;");
        $rows = $stmt->execute(array('emp_id' => $this->emp_id,
                             'id_perfil'=>$this->id_perfil,
                             'nom_usuario'=>$this->nom_usuario,
                             'clave_usuario'=>$this->clave_usuario,
                             'estado'=>$this->estado,
                             'id_usuario'=>$this->id_usuario));
    }

    public function obtenerxid(){
        $stmt = $this->objPdo->prepare("SELECT id_usuario,emp_id,id_perfil,nom_usuario,clave_usuario,estado from sisanatom.usuarios_anat
                                        where id_usuario='" . $this->id_usuario . "';");
        $stmt->execute();
        $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach ($usuarios as $usuario) {
            $this->setIdUsuario($usuario->id_usuario);
            $this->setEmpId($usuario->emp_id);
            $this->setIdPerfil($usuario->id_perfil);
            $this->setNomUsuario($usuario->nom_usuario);
            $this->setClaveUsuario($usuario->clave_usuario);
            $this->setEstado($usuario->estado);
        }
        return $this;
    }

    public function debaja($id_usuario){
        $stmt = $this->objPdo->prepare("UPDATE sisanatom.usuarios_anat set estado=FALSE where id_usuario=:id_usuario");
        $rows = $stmt->execute(array('id_usuario' => $id_usuario));
        return $rows;
    }

    public function dealta($id_usuario){
        $stmt=$this->objPdo->prepare("UPDATE sisanatom.usuarios_anat set estado=TRUE where id_usuario=:id_usuario");
        $rows=$stmt->execute(array('id_usuario'=>$id_usuario));
    }


    public function actualizabaja($id_usuario){
       $sql = "UPDATE sisanatom.usuarios_anat set estado=FALSE
                where id_usuario=:id_usuario;";

        $stmt = $this->objPdo->prepare($sql);

            try{
                $stmt->execute(array('id_usuario'=> $id_usuario));
                return true;
            }catch(PDOExeception $e){
                return false;
            } 
    }

    public function actualizadetallebaja($id_usubaja,$motivo,$id_usuregistra){
        $stmt =$this->objPdo->prepare("INSERT INTO sisanatom.bajas_usuarios (id_usubaja,motivo,id_usuregistra)
                                       values(:id_usubaja,:motivo,:id_usuregistra);");
        $stmt->execute(array('id_usubaja' => $this->id_usubaja,
                             'motivo'=>$this->motivo,
                             'id_usuregistra'=>$this->id_usuregistra));
    }

    public function eliminar2($emp_id){
        $stmt = $this->objPdo->prepare("UPDATE sisanatom.usuarios_anat set estado=FALSE where emp_id=:emp_id");
        $rows = $stmt->execute(array('emp_id' => $emp_id));
        return $rows;
    }

     public function usuario_nombre($nom_usuario) {
        $stmt = $this->objPdo->prepare("SELECT u.id_usuario,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno)as fullname from sisanatom.usuarios_anat u
                                       INNER JOIN empleados e ON  e.emp_id = u.emp_id
                                       WHERE u.nom_usuario ='$nom_usuario'");
        $stmt->execute();
        $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $usuarios;
    }

     public function restaurar_contrasena($id_usuario, $clave_usuario) {
        $stmt = $this->objPdo->prepare(" UPDATE sisanatom.usuarios_anat SET  clave_usuario = '$clave_usuario'
                                        WHERE id_usuario =  $id_usuario ");
        $stmt->execute();
        $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $usuarios;
    }

    public function getIdPerfil() {
        return $this->id_perfil;
    }
    public function getIdUsuario() {
        return $this->id_usuario;
    }
    public function getEmpId() {
        return $this->emp_id;
    }
    public function getNomUsuario() {
        return $this->nom_usuario;
    }
    public function getClaveUsuario() {
        return $this->clave_usuario;
    }
    public function getEstado() {
        return $this->estado;
    }
    public function setIdPerfil($id_perfil){
        $this->id_perfil = $id_perfil;
    }
    public function setIdUsuario($id_usuario){
        $this->id_usuario = $id_usuario;
    }
    public function setEmpId($emp_id){
        $this->emp_id = $emp_id;
    }
    public function setNomUsuario($nom_usuario){
        $this->nom_usuario = $nom_usuario;
    }
    public function setClaveUsuario($clave_usuario){
        $this->clave_usuario = $clave_usuario;
    }
    public function setEstado($estado){
        $this->estado = $estado;
    }

    public function getIdusubaja() {
        return $this->id_usubaja;
    }
    public function setIdusubaja($id_usubaja){
        $this->id_usubaja = $id_usubaja;
    }

    public function getmotivo() {
        return $this->motivo;
    }
    public function setmotivo($motivo){
        $this->motivo = $motivo;
    }

    public function getIdusureg() {
        return $this->id_usuregistra;
    }
    public function setIdusureg($id_usuregistra){
        $this->id_usuregistra = $id_usuregistra;
    }

    public function getclavetemp() {
        return $this->clave_temporal;
    }

    public function setclavetemp($clave_temporal){
        $this->clave_temporal = $clave_temporal;
    }
}

?>