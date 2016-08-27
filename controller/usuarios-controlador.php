<?php

//session_start();

require_once 'model/clases/usuariosant.php';
require_once 'controller/class.inputfilter.php';
require_once 'model/clases/empleado.php';
require_once 'model/clases/perfil_usuario.php';
require_once 'model/clases/bitacora.php';

include 'controller/validar-sesion.php';

function _listarAction(){
    
	$lusuario = new UsuarioAnat();
	$lusuarios = $lusuario->listadousuarios();

    require 'view/usuarios-registro.php';
    // require 'view/usuarios-registros.php';
}

function _formAction(){
      
    $empleado = new Empleados();
    $empleados = $empleado->listaemppatologia();

     $perfil = new PerfilUsuario();
     $operfiles = $perfil->listaperfiles();

     $claves=new UsuarioAnat();

    require 'view/usuarios-form.php';
}

function _insertarAction(){

     $filter = new InputFilter();

     $emp = $filter->process($_POST["empleado"]);
     $per = $filter->process($_POST["perfil"]);
     $usuario = $filter->process($_POST["user"]);
     $pass = $filter->process($_POST["clave"]);
     //$est = $filter->process($_POST["optionsRadios"]);
     $usr = $_SESSION['idusuario'];
     $nusu=new UsuarioAnat();
     $nome=$nusu->buscaremp($usuario);
     $nper=$nusu->buscarper($usuario);
     $clusu=base64_decode($nusu->buscarclave($usuario));
     $busquedau=$nusu->consultausuario($emp);
     $host=$_SERVER['REMOTE_ADDR'];
     $hostname=gethostbyaddr($host);

     try {
        if (!empty($_GET["id"])) {
            $id = $filter->process($_GET["id"]);
            $usuarios = new UsuarioAnat($id, $nome,$per,$usuario,base64_encode($pass),true);
            $usuarios->modificar();
            $accion = 'MODIFICAR';
            if ($nper!=$per and $clusu==$pass){
                $detalles=new UsuarioAnat();
                $detalles->setIdUsuario($id);
                $detalles->setIdPerfil($per);
                $detalles->insertahistorial();

                //$bit = new bitacora(null,$usr,$accion,null,'USUARIOS_ANAT');
                //$bit->insertar();
                $bit=new bitacora();
                $bit->setUsr_id($usr);
                $bit->setAccion($accion);
                $bit->setTabla('USUARIOS_ANAT');
                $bit->setHost($host);
                $bit->setHostname($hostname);
                $bit->setCampo('ID_PERFIL');
                $bit->insertar();
            }elseif ($nper==$per and $clusu!=$pass) {
                $bit=new bitacora();
                $bit->setUsr_id($usr);
                $bit->setAccion($accion);
                $bit->setTabla('USUARIOS_ANAT');
                $bit->setHost($host);
                $bit->setHostname($hostname);
                $bit->setCampo('CLAVE_USUARIO');
                $bit->insertar();
            }elseif($nper!=$per and $clusu!=$pass){
                $detalles=new UsuarioAnat();
                $detalles->setIdUsuario($id);
                $detalles->setIdPerfil($per);
                $detalles->insertahistorial();

                $bit=new bitacora();
                $bit->setUsr_id($usr);
                $bit->setAccion($accion);
                $bit->setTabla('USUARIOS_ANAT');
                $bit->setHost($host);
                $bit->setHostname($hostname);
                $bit->setCampo('ID_PERFIL,CLAVE_USUARIO');
                $bit->insertar();
            }

        } else {
            if ($busquedau==0) {
                $usuarios = new UsuarioAnat();
                $usuarios->setEmpId($emp);
                $usuarios->setIdPerfil($per);
                $usuarios->setNomUsuario($usuario);
                $usuarios->setClaveUsuario(base64_encode($pass));
                $usuarios->setEstado(true);
                $usuarios->setclavetemp($pass);
                $usuarios->insertar();

                $accion = 'INSERTAR';//akaaaaaaaaaaa
                    $bit=new bitacora();
                    $bit->setUsr_id($usr);
                    $bit->setAccion($accion);
                    $bit->setTabla('USUARIOS_ANAT');
                    $bit->setHost($host);
                    $bit->setHostname($hostname);
                    $bit->setCampo('');
                    $bit->insertar();
                $nuevou=new UsuarioAnat();
                $idnuevou=$nuevou->buscarusu($usuario);

                foreach ($idnuevou as $nuevou) {
                    $new_u=$nuevou->id_usuario;
                    $per_u=$nuevou->id_perfil;
                }
                $detallep=new UsuarioAnat();
                $detallep->setIdUsuario($new_u);
                $detallep->setIdPerfil($per_u);
                $detallep->insertahistorial();
                }
            
        }

        header("location:index.php?page=usuarios&accion=listar");
    } catch (Exception $exc) {
        $error = urlencode($exc->getMessage());
        header("location: error.php?mssg=:$error");
        die;
    }
}

function _registroAction(){
    $filter = new InputFilter();
    $id = $_GET['id'];
    $infu=new UsuarioAnat();
    $informaciones=$infu->formatusuario($id);

    require 'view/reportes/informe-usuario.php';

}

function _opcionesAction(){
    $perusu=$_SESSION['idperfil_anat'];

    $opcu=new UsuarioAnat();
    $nomper=$opcu->encuentraper($perusu);
    $menuser=$opcu->opcperfil($perusu);
    
    require 'view/reportes/opciones-usuario.php';
}

function _modificarAction(){
    $id = $_GET['id'];
    $usuario = new UsuarioAnat($id);
    $usuario->obtenerxid();
    $empleado = new Empleados();
    $empleados = $empleado->listaemppatologia();

     $perfil = new PerfilUsuario();
     $operfiles = $perfil->listaperfiles();
    require 'view/usuarios-form.php';
}

function _bajaAction(){
    $filter = new InputFilter();
    $usr = $_SESSION['idusuario'];  
    $host=$_SERVER['REMOTE_ADDR'];
    $hostname=gethostbyaddr($host);
  
    try{
        $id = $filter->process($_GET['id']); 
        $usuario = new UsuarioAnat();
        $usuario->debaja($id);
        $accion = 'DAR DE BAJA';
        $bit=new bitacora();
        $bit->setUsr_id($usr);
        $bit->setAccion($accion);
        $bit->setTabla('USUARIOS_ANAT');
        $bit->setHost($host);
        $bit->setHostname($hostname);
        $bit->setCampo('');
        $bit->insertar();
        header("location: index.php?page=usuarios&accion=listar");
        die;
    } catch (Exception $exc) {
        $error = urlencode($exc->getMessage());
        header("location: error.php?mssg=:$error");
        die;
    }
}

function _ajaxbajarAction(){
    $filter = new Inputfilter();
    $id_usuario=$filter->process($_POST['id_usuario']);
    $motivo=$filter->process($_POST['motivo']);
    $usr = $_SESSION['idusuario']; 
    $host=$_SERVER['REMOTE_ADDR'];
    $hostname=gethostbyaddr($host); 
    
    $omac=new UsuarioAnat();
    $actualizado=$omac->actualizabaja($id_usuario);

    $detac=new UsuarioAnat();
    $detac->setIdusubaja($id_usuario);
    $detac->setmotivo($motivo);
    $detac->setIdusureg($usr);
    $detac->actualizadetallebaja();

        $accion = 'DAR DE BAJA';
        $bit=new bitacora();
        $bit->setUsr_id($usr);
        $bit->setAccion($accion);
        $bit->setTabla('USUARIOS_ANAT');
        $bit->setHost($host);
        $bit->setHostname($hostname);
        $bit->setCampo('');
        $bit->insertar();

    $response=array();

    $response['inserted']=$actualizado;

    header('Content-Type: application/json');

    echo json_encode($response);
}


function _altaAction(){
    $filter = new InputFilter(); 
    $usr = $_SESSION['idusuario'];  
    $host=$_SERVER['REMOTE_ADDR'];
    $hostname=gethostbyaddr($host); 
    try{
        $id = $filter->process($_GET['id']); 
        $usuario = new UsuarioAnat();
        $usuario->dealta($id);
        $accion = 'DAR DE ALTA';
        $bit=new bitacora();
        $bit->setUsr_id($usr);
        $bit->setAccion($accion);
        $bit->setTabla('USUARIOS_ANAT');
        $bit->setHost($host);
        $bit->setHostname($hostname);
        $bit->setCampo('');
        $bit->insertar();
        header("location: index.php?page=usuarios&accion=listar");
        die;
    } catch (Exception $exc) {
        $error = urlencode($exc->getMessage());
        header("location: error.php?mssg=:$error");
        die;
    }
}

function _cambioclaveAction() {

    // funcion para hacer cambio de clave

    $usuario = new UsuarioAnat();
    $u = $usuario->usuario_nombre($_SESSION['usuario']);
    if(count($u)){
        foreach ($u as $value) {
            $user = $value->id_usuario;
            $nombre = $value->fullname;
        }
    }
   require 'view/cambioclave-Form.php';
}

function _userresspassAction() {
    $id_usuario = $_POST['id_usuario'];
    $clave = $_POST['pass1'];
    $usu = new UsuarioAnat();
    $usu->restaurar_contrasena($id_usuario, base64_encode($clave));
    header("Location: index.php");
}

function _nickAction(){
    $empleado=$_POST['empleado'];
    $usuario=new UsuarioAnat();

    if ($empleado=="") {
        $nombre="";
    } else {
         $nombre=$usuario->nomuser($empleado);
    }
     echo $nombre;
}



?>