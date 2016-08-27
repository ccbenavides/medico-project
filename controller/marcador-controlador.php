<?php

//session_start();

require_once 'controller/class.inputfilter.php';
require_once 'model/clases/marcador.php';
require_once 'model/clases/bitacora.php';
include 'controller/validar-sesion.php';

function _listarAction(){
	
	$marca = new Marcador();
	$marcas = $marca->listamarc();

	require 'view/marcador/marcador-registro.php';
}

function _formAction(){
	
	require 'view/marcador/marcador-form.php';
}

function _insertarAction(){
	session_start();
	$filter = new InputFilter();
	$nombre = $filter->process($_POST["nombre"]);
	$lote = $filter->process($_POST["lote"]);
	$fecha_venc = $filter->process($_POST["fecha_venc"]);	
    $usr = $_SESSION['idusuario'];
    $host=$_SERVER['REMOTE_ADDR'];
    $hostname=gethostbyaddr($host);

	try {
        if (!empty($_GET["id"])) {
            $id = $filter->process($_GET["id"]);
            $bmar=new Marcador();
            $nomar=$bmar->buscarnommar($id);
            $lmarc=$bmar->buscarlote($id);
            $fmarc=$bmar->buscarfecha($id);
            $usuarios = new Marcador($id, $nombre,$lote,$fecha_venc);
            $usuarios->modificar();
            $accion = 'MODIFICAR';//akaaaaaaaaaaa
            if ($nomar!=$nombre and $lmarc==$lote and $fmarc==$fecha_venc) {
                $bit=new bitacora();
                $bit->setUsr_id($usr);
                $bit->setAccion($accion);
                $bit->setTabla('MARCADOR');
                $bit->setHost($host);
                $bit->setHostname($hostname);
                $bit->setCampo('DESCR_MARCADOR');
                $bit->insertar();
            }elseif ($lmarc!=$lote and $nomar==$nombre and $fmarc==$fecha_venc) {
                $bit=new bitacora();
                $bit->setUsr_id($usr);
                $bit->setAccion($accion);
                $bit->setTabla('MARCADOR');
                $bit->setHost($host);
                $bit->setHostname($hostname);
                $bit->setCampo('LOTE');
                $bit->insertar();
            }elseif ($fmarc!=$fecha_venc and $lmarc==$lote and $nomar==$nombre) {
                $bit=new bitacora();
                $bit->setUsr_id($usr);
                $bit->setAccion($accion);
                $bit->setTabla('MARCADOR');
                $bit->setHost($host);
                $bit->setHostname($hostname);
                $bit->setCampo('FECHA_VENC');
                $bit->insertar();
            }elseif ($nomar!=$nombre and $lmarc!=$lote and $fmarc==$fecha_venc) {
                $bit=new bitacora();
                $bit->setUsr_id($usr);
                $bit->setAccion($accion);
                $bit->setTabla('MARCADOR');
                $bit->setHost($host);
                $bit->setHostname($hostname);
                $bit->setCampo('DESCR_MARCADOR,LOTE');
                $bit->insertar();
            }elseif ($nomar!=$nombre and $fmarc!=$fecha_venc and $lmarc==$lote) {
                $bit=new bitacora();
                $bit->setUsr_id($usr);
                $bit->setAccion($accion);
                $bit->setTabla('MARCADOR');
                $bit->setHost($host);
                $bit->setHostname($hostname);
                $bit->setCampo('DESCR_MARCADOR,FECHA_VENC');
                $bit->insertar();
            }elseif ($fmarc!=$fecha_venc and $lmarc!=$lote and $nomar==$nombre) {
                $bit=new bitacora();
                $bit->setUsr_id($usr);
                $bit->setAccion($accion);
                $bit->setTabla('MARCADOR');
                $bit->setHost($host);
                $bit->setHostname($hostname);
                $bit->setCampo('LOTE,FECHA_VENC');
                $bit->insertar();
            }elseif ($nomar!=$nombre and $lmarc!=$lote and $fmarc!=$fecha_venc) {
                $bit=new bitacora();
                $bit->setUsr_id($usr);
                $bit->setAccion($accion);
                $bit->setTabla('MARCADOR');
                $bit->setHost($host);
                $bit->setHostname($hostname);
                $bit->setCampo('DESCR_MARCADOR,LOTE,FECHA_VENC');
                $bit->insertar();
            }
        } else {
            $usuarios = new Marcador(NULL,$nombre,$lote,$fecha_venc,'Nuevo','0');
            $usuarios->insertar();
            $accion = 'INSERTAR';//akaaaaaaaaaaa
            $bit=new bitacora();
            $bit->setUsr_id($usr);
            $bit->setAccion($accion);
            $bit->setTabla('MARCADOR');
            $bit->setHost($host);
            $bit->setHostname($hostname);
            $bit->setCampo('');
            $bit->insertar();
        }
        header("location: index.php?page=marcador&accion=listar");
    } catch (Exception $exc) {
        $error = urlencode($exc->getMessage());
        header("location: error.php?mssg=:$error");
        die;
    }

}

function _modificarAction(){
	
	$id = $_GET['id'];
    $marcador = new Marcador($id);
    $marcador->obtenermarcid();

    $condiciones = $marcador->listarcondic();

     require 'view/marcador/marcador-form.php';
}

function _bajaAction(){
    $filter = new InputFilter();
    $usr = $_SESSION['idusuario']; 
    $host=$_SERVER['REMOTE_ADDR'];
    $hostname=gethostbyaddr($host);
    try{
        $id = $filter->process($_GET['id']); 
        $marcador = new Marcador();
        $marcador->baja($id);
        $accion = 'DAR DE BAJA';//akaaaaaaaaaaa
            $bit=new bitacora();
            $bit->setUsr_id($usr);
            $bit->setAccion($accion);
            $bit->setTabla('MARCADOR');
            $bit->setHost($host);
            $bit->setHostname($hostname);
            $bit->setCampo('');
            $bit->insertar();
        header("location: index.php?page=marcador&accion=listar");
        die;
    } catch (Exception $exc) {
        $error = urlencode($exc->getMessage());
        header("location: error.php?mssg=:$error");
        die;
    }
}

function _altaAction(){
    $filter = new InputFilter(); 
    $usr = $_SESSION['idusuario'];  
    $host=$_SERVER['REMOTE_ADDR'];
    $hostname=gethostbyaddr($host); 
    try{
        $id = $filter->process($_GET['id']); 
        $marcador = new Marcador();
        $marcador->alta($id);
        $accion = 'DAR DE ALTA';//akaaaaaaaaaaa
            $bit=new bitacora();
            $bit->setUsr_id($usr);
            $bit->setAccion($accion);
            $bit->setTabla('MARCADOR');
            $bit->setHost($host);
            $bit->setHostname($hostname);
            $bit->setCampo('');
            $bit->insertar();
        header("location: index.php?page=marcador&accion=listar");
        die;
    } catch (Exception $exc) {
        $error = urlencode($exc->getMessage());
        header("location: error.php?mssg=:$error");
        die;
    }
}


?>