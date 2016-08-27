<?php
require_once 'controller/class.inputfilter.php';
require_once 'model/clases/diagnosticoPAP.php';
require_once 'model/clases/area.php';
require_once 'model/clases/biopsia.php';
require_once 'model/clases/bioPQ.php';
require_once 'model/clases/guia.php';
require_once 'model/clases/bitacora.php';
require_once 'model/clases/muestra-remitida.php';
include 'controller/validar-sesion.php';

function _diagnosticoAction(){

	$lista=new Diagnostico();
	$diagnosticos =$lista->listardiag();
	require 'view/diagnostico/diagnostico-registro.php';
}

function _biopsiasAction(){
    $biop=new Biopsia();
    $listadod=$biop->listobio();
    require 'view/biopsia/biopsia-listado.php';
}


function _ajaxbajabAction(){
    $filter = new Inputfilter();
    $id_biopsia=$filter->process($_POST['id_biopsia']);
    $motivo=$filter->process($_POST['motivo']);
    $usr = $_SESSION['idusuario']; 
    $descripcion='DAR DE BAJA';    

    $omac=new Biopsia();
    $actualizado=$omac->actualizabaja($id_biopsia);

    $ret=new Biopsia();
    $ret->setIdBio($id_biopsia);
    $ret->setdescrmov($descripcion);
    $ret->setmotivo($motivo);
    $ret->setusuregmov($usr);
    $ret->actualizadetallemovbio();

    
    $response=array();

    $response['inserted']=$actualizado;

    header('Content-Type: application/json');

    echo json_encode($response);
}

function _ajaxaltabAction(){
    $filter = new Inputfilter();
    $id_biopsia=$filter->process($_POST['id_biopsia']);
    $motivo=$filter->process($_POST['motivo']);
    $usr = $_SESSION['idusuario']; 
    $descripcion='DAR DE ALTA';    

    $omac=new Biopsia();
    $actualizado=$omac->actualizaalta($id_biopsia);

    $ret=new Biopsia();
    $ret->setIdBio($id_biopsia);
    $ret->setdescrmov($descripcion);
    $ret->setmotivo($motivo);
    $ret->setusuregmov($usr);
    $ret->actualizadetallemovbio();

    
    $response=array();

    $response['inserted']=$actualizado;

    header('Content-Type: application/json');

    echo json_encode($response);
}


function _formAction(){
	$area=new Area();
	$areas=$area->listararea();
	require 'view/diagnostico/diagnostico-form.php';
}

function _insertardiagAction(){
	session_start();
	$filter = new InputFilter();
	$nombre = $filter->process($_POST["diagnostico"]);
	$user=$_SESSION['idusuario'];
	$fecha='now()';	
    $host=$_SERVER['REMOTE_ADDR'];
    $hostname=gethostbyaddr($host);

	try {
        if (!empty($_GET["id"])) {
            $id = $filter->process($_GET["id"]);
            $ndi=new Diagnostico();
            $nomdi=$ndi->buscardiag($id);
            $diag = new Diagnostico($id, $nombre);
            $diag->modificar();
            $accion = 'MODIFICAR';//akaaaaaaaaaaaaaaaaaaa
            if ($nomdi!=$nombre) {
                $bit=new bitacora();
                $bit->setUsr_id($user);
                $bit->setAccion($accion);
                $bit->setTabla('DIAGNOSTICO_CCV');
                $bit->setHost($host);
                $bit->setHostname($hostname);
                $bit->setCampo('DESCR_DIAGCCV');
                $bit->insertar();
            }
            
        } else {
            $diag = new Diagnostico(NULL,$nombre,true,$user,$fecha);
            $diag->insertar();
            $accion = 'INSERTAR';//akaaaaaaaaaaaaaaaaaaa
            $bit=new bitacora();
            $bit->setUsr_id($user);
            $bit->setAccion($accion);
            $bit->setTabla('DIAGNOSTICO_CCV');
            $bit->setHost($host);
            $bit->setHostname($hostname);
            $bit->setCampo('');
            $bit->insertar();
        }
        header("location: index.php?page=mantenimiento&accion=diagnostico");
    } catch (Exception $exc) {
        $error = urlencode($exc->getMessage());
        header("location: error.php?mssg=:$error");
        die;
    }
}

function _modificardiagAction(){
	$id = $_GET['id'];
    $diagnos = new Diagnostico($id);
    $diagnos->obtenerdiag();
    require 'view/diagnostico/diagnostico-form.php';
}

function _bajadiagAction(){
	$filter = new InputFilter(); 
    $host=$_SERVER['REMOTE_ADDR'];
    $hostname=gethostbyaddr($host);
    $user=$_SESSION['idusuario'];
    try{
        $id = $filter->process($_GET['id']); 
        $diag = new Diagnostico();
        $diag->debaja($id);
        $accion = 'DAR DE BAJA';
        $bit=new bitacora();
        $bit->setUsr_id($user);
        $bit->setAccion($accion);
        $bit->setTabla('DIAGNOSTICO_CCV');
        $bit->setHost($host);
        $bit->setHostname($hostname);
        $bit->setCampo('');
        $bit->insertar();
        header("location: index.php?page=mantenimiento&accion=diagnostico");
        die;
    } catch (Exception $exc) {
        $error = urlencode($exc->getMessage());
        header("location: error.php?mssg=:$error");
        die;
    }
}

function _altadiagAction(){
	$filter = new InputFilter(); 
    $host=$_SERVER['REMOTE_ADDR'];   
    $hostname=gethostbyaddr($host);
    $user=$_SESSION['idusuario'];
    try{
        $id = $filter->process($_GET['id']); 
        $diag = new Diagnostico();
        $diag->dealta($id);
        $accion = 'DAR DE ALTA';
        $bit=new bitacora();
        $bit->setUsr_id($user);
        $bit->setAccion($accion);
        $bit->setTabla('DIAGNOSTICO_CCV');
        $bit->setHost($host);
        $bit->setHostname($hostname);
        $bit->setCampo('');
        $bit->insertar();
        header("location: index.php?page=mantenimiento&accion=diagnostico");
        die;
    } catch (Exception $exc) {
        $error = urlencode($exc->getMessage());
        header("location: error.php?mssg=:$error");
        die;
    }
}

function _muestraAction(){
	$listam=new Muestra();
	$lmuestra =$listam->listarmuestras();
	
	require 'view/muestras/muestras-registro.php';
}

function _formuestraAction(){
	$area=new Area();
	$areas=$area->listararea();
	require 'view/muestras/muestras-form.php';
}

function _insertarmueAction(){
    error_reporting(0);
	session_start();
	$filter = new InputFilter();
	$nom_ar= $filter->process($_POST["larea"]);
	$mue=$filter->process($_POST["muestras"]);
	$user=$_SESSION['idusuario'];
    $tiempo=$filter->process($_POST["tiempo"]);
	

	try {
        if (!empty($_GET["id"])) {
            $id = $filter->process($_GET["id"]);
            $muestrasd = new Muestra();
            $muestrasd->setIdMue($id);
            $muestrasd->setDescrMue($mue);
            $muestrasd->setAreaMue($nom_ar);
            $muestrasd->setTiempoMue($tiempo);
            $muestrasd->modificarmue();
        } else {
            $must = new Muestra();
            $must->setDescrMue($mue);
            $must->setAreaMue($nom_ar);
            $must->setUsuMue($user);
            $must->setTiempoMue($tiempo);
            $must->insertarmuearea();
        }
        header("location: index.php?page=mantenimiento&accion=muestra");
    } catch (Exception $exc) {
        $error = urlencode($exc->getMessage());
        header("location: error.php?mssg=:$error");
        die;
    }
}

function _modificarmueAction(){
    $id = $_GET['id'];
    $obtener=new Muestra();
    $obt=$obtener->obtid($id);

    $muestra = new Muestra();
    //$mues->setIdMue($id);
    //$mues->setAreaMue(1);
    $mues=$muestra->obtenermuearea($id);
    $area=new Area();
    $areas=$area->listararea();

    require 'view/muestras/muestras-form.php';
}

function _guiamedicoAction(){
    $listado=new Guia();
    $lguia=$listado->listar();
    require 'view/guia/guia-registro.php';
}

function _protocolosAction(){
    $listado=new Guia();
    $lguia=$listado->listarprot();
    require 'view/guia/guia-protocolos.php';
}

function _interpretAction(){
    $listado=new Guia();
    $lguia=$listado->listarinter();
    require 'view/guia/guia-inter.php';
}

function _citologiaAction(){
    $listado=new Guia();
    $lguia=$listado->listarcito();
    require 'view/guia/guia-cito.php';
}

function _wanatAction(){
    $listado=new Guia();
    $lguia=$listado->listarwanat();
    require 'view/guia/guia-wanat.php';
}

function _whistAction(){
    $listado=new Guia();
    $lguia=$listado->listarwhist();
    require 'view/guia/guia-whist.php';
}

function _librosAction(){
    $listado=new Guia();
    $lguia=$listado->listarlibros();
    require 'view/guia/guia-libros.php';
}

function _formlibrosAction(){
    $tipo=new Guia();
    $tipos=$tipo->listatipo();
    require 'view/guia/guia-form-libros.php';
}


function _formguiaAction(){
    $tipo=new Guia();
    $tipos=$tipo->listatipo();
    require 'view/guia/guia-form.php';
}

function _insertar2Action(){
    session_start();
    $filter = new InputFilter();
    $descr=$filter->process($_POST["descripcion"]);
    $tipo=$filter->process($_POST["tipo_guia"]);
    $nombre=$filter->process($_POST["url"]);
    $usuario=$_SESSION['idusuario'];
    $fecha='now()'; 
    $host=$_SERVER['REMOTE_ADDR'];   
    $hostname=gethostbyaddr($host);
    
    try {
        if (!empty($_GET["id"])) {
            $id = $filter->process($_GET["id"]);
            $bguia=new Guia();
            $nomguia=$bguia->buscarnomguia($id);
            $urlguia=$bguia->buscarurlguia($id);
            $tipguia=$bguia->buscartguia($id);
            $guia = new Guia($id,$descr,$nombre,$tipo);
            $guia->modificar();
            $accion = 'MODIFICAR';//akaaaaaaaaaaaaaaaaaaa
            if ($nomguia!=$descr and $urlguia==$nombre and $tipguia==$tipo) {
                $bit=new bitacora();
                $bit->setUsr_id($usuario);
                $bit->setAccion($accion);
                $bit->setTabla('GUIA_MEDICO');
                $bit->setHost($host);
                $bit->setHostname($hostname);
                $bit->setCampo('DESCRIPCION');
                $bit->insertar(); 
            }elseif ($urlguia!=$nombre and $nomguia==$descr and $tipguia==$tipo) {
                $bit=new bitacora();
                $bit->setUsr_id($usuario);
                $bit->setAccion($accion);
                $bit->setTabla('GUIA_MEDICO');
                $bit->setHost($host);
                $bit->setHostname($hostname);
                $bit->setCampo('URL');
                $bit->insertar(); 
            }elseif ($tipguia!=$tipo and $nomguia==$descr and $urlguia==$nombre) {
                $bit=new bitacora();
                $bit->setUsr_id($usuario);
                $bit->setAccion($accion);
                $bit->setTabla('GUIA_MEDICO');
                $bit->setHost($host);
                $bit->setHostname($hostname);
                $bit->setCampo('ID_TIPO');
                $bit->insertar(); 
            }elseif ($nomguia!=$descr and $urlguia!=$nombre and $tipguia==$tipo) {
                $bit=new bitacora();
                $bit->setUsr_id($usuario);
                $bit->setAccion($accion);
                $bit->setTabla('GUIA_MEDICO');
                $bit->setHost($host);
                $bit->setHostname($hostname);
                $bit->setCampo('DESCRIPCION,URL');
                $bit->insertar(); 
            }elseif ($nomguia!=$descr and $tipguia!=$tipo and $urlguia==$nombre) {
                $bit=new bitacora();
                $bit->setUsr_id($usuario);
                $bit->setAccion($accion);
                $bit->setTabla('GUIA_MEDICO');
                $bit->setHost($host);
                $bit->setHostname($hostname);
                $bit->setCampo('DESCRIPCION,ID_TIPO');
                $bit->insertar(); 
            }elseif ($tipguia!=$tipo and $urlguia!=$nombre and $nomguia==$descr) {
                $bit=new bitacora();
                $bit->setUsr_id($usuario);
                $bit->setAccion($accion);
                $bit->setTabla('GUIA_MEDICO');
                $bit->setHost($host);
                $bit->setHostname($hostname);
                $bit->setCampo('URL,ID_TIPO');
                $bit->insertar(); 
            }elseif ($nomguia!=$descr and $urlguia!=$nombre and $tipguia!=$tipo) {
                $bit=new bitacora();
                $bit->setUsr_id($usuario);
                $bit->setAccion($accion);
                $bit->setTabla('GUIA_MEDICO');
                $bit->setHost($host);
                $bit->setHostname($hostname);
                $bit->setCampo('DESCRIPCION,URL,ID_TIPO');
                $bit->insertar(); 
            }
            
        } else {
            $guia = new Guia(NULL,$descr,$nombre,$tipo,$usuario,$fecha);
            $guia->insertar();
            $accion = 'INSERTAR';//akaaaaaaaaaaaaaaaaaaa
            $bit=new bitacora();
            $bit->setUsr_id($usuario);
            $bit->setAccion($accion);
            $bit->setTabla('GUIA_MEDICO');
            $bit->setHost($host);
            $bit->setHostname($hostname);
            $bit->setCampo('');
            $bit->insertar();
        }
        header("location:index.php?page=mantenimiento&accion=guiamedico");
    } catch (Exception $exc) {
        $error = urlencode($exc->getMessage());
        header("location: error.php?mssg=:$error");
        die;
    }

}

function _modificar2Action(){
    $id = $_GET['id'];
    $guia = new Guia($id);
    $guia->obtenerinf();
    $tipo=new Guia();
    $tipos=$tipo->listatipo();
    require 'view/guia/guia-form.php';
}

function _eliminarguiaAction(){
    $filter = new InputFilter(); 
    $usuario=$_SESSION['idusuario'];   
    $host=$_SERVER['REMOTE_ADDR'];   
    $hostname=gethostbyaddr($host);
    try{
        $id = $filter->process($_GET['id']); 
        $guiam = new Guia();
        $guiam->eliminar($id);
            $accion = 'ELIMINAR';//akaaaaaaaaaaaaaaaaaaa
            $bit=new bitacora();
            $bit->setUsr_id($usuario);
            $bit->setAccion($accion);
            $bit->setTabla('GUIA_MEDICO');
            $bit->setHost($host);
            $bit->setHostname($hostname);
            $bit->setCampo('');
            $bit->insertar();
        header("location: index.php?page=mantenimiento&accion=guiamedico");
        die;
    } catch (Exception $exc) {
        $error = urlencode($exc->getMessage());
        header("location: error.php?mssg=:$error");
        die;
    }
}

?>