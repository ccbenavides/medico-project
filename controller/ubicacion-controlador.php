<?php
require_once 'controller/class.inputfilter.php';
require_once 'model/clases/ubicacion.php';
require_once 'model/clases/area.php';
require_once 'model/clases/bitacora.php';
include 'controller/validar-sesion.php';

function _listarAction(){
	$ubic=new ubicacion();
	$ubicacion=$ubic->listaubicacion();

	require 'view/ubicacion/ubicacion-registro.php';
}

function _formAction(){
	$area=new Area();
	$areas=$area->listararea();

	require 'view/ubicacion/ubicacion-form.php';
}

function _insertarAction(){
	session_start();
	$filter = new InputFilter();
	$ubic=$filter->process($_POST["nombreubic"]);
	// $ars=$filter->process($_POST["area"]);
	$usr = $_SESSION['idusuario'];
	$fecha = 'now()';
    $estado=$filter->process($_POST["optionsRadios"]);;
    $host=$_SERVER['REMOTE_ADDR'];
    $hostname=gethostbyaddr($host);

	try {
        if (!empty($_GET["id"])) {
            $id = $filter->process($_GET["id"]);
            $ubi=new ubicacion();
            $nubi=$ubi->buscarnomubic($id);
            // $nar=$top->buscararea($id);
            $ubics= new ubicacion($id, $ubic, $usr, $fecha, $estado);
            $ubics->modificar();
            $accion = 'MODIFICAR';//akaaaaaaaaaaaaaaaaaaa
            if ($nubi!=$ubic) {
                $bit=new bitacora();
                $bit->setUsr_id($usr);
                $bit->setAccion($accion);
                $bit->setTabla('UBICACION_BIO');
                $bit->setHost($host);
                $bit->setHostname($hostname);
                $bit->setCampo('DESCR_UBICACION');
                $bit->insertar();
            
            }
            
        } else {
            $ubics = new ubicacion(NULL,$ubic,$usr,$fecha,$estado);
            $ubics->insertar();
            $accion = 'INSERTAR';//akaaaaaaaaaaaaaaaaaaa
            $bit=new bitacora();
            $bit->setUsr_id($usr);
            $bit->setAccion($accion);
            $bit->setTabla('UBICACION_BIO');
            $bit->setHost($host);
            $bit->setHostname($hostname);
            $bit->setCampo('');
            $bit->insertar();
        }
        header("location:index.php?page=ubicacion&accion=listar");
    } catch (Exception $exc) {
        $error = urlencode($exc->getMessage());
        header("location: error.php?mssg=:$error");
        die;
    }
}

function _modificarAction(){
     $id = $_GET['id'];
     $ubicacion = new Ubicacion($id);
     $ubicacion->obtenerubicxid();
     // $area=new Area();
     // $areas=$area->listararea();

    require 'view/ubicacion/ubicacion-form.php';
}

function _eliminarAction(){
    $filter = new InputFilter();    
    try{
        $id = $filter->process($_GET['id']); 
        $topografia = new Topografia();
        $topografia->eliminar($id);

        header("location: index.php?page=topografia&accion=listar");
        die;
    } catch (Exception $exc) {
        $error = urlencode($exc->getMessage());
        header("location: error.php?mssg=:$error");
        die;
    }
}


?>