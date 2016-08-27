<?php
require_once 'controller/class.inputfilter.php';
require_once 'model/clases/topografia.php';
require_once 'model/clases/area.php';
require_once 'model/clases/bitacora.php';
include 'controller/validar-sesion.php';

function _listarAction(){
	$tarea=new Topografia();
	$topareas=$tarea->listasartop();

	require 'view/topografia/topografia-registro.php';
}

function _formAction(){
	$area=new Area();
	$areas=$area->listararea();

	require 'view/topografia/topografia-form.php';
}

function _insertarAction(){
	session_start();
	$filter = new InputFilter();
	$topo=$filter->process($_POST["nombretop"]);
	$ars=$filter->process($_POST["area"]);
	$usr = $_SESSION['idusuario'];
	$fecha = 'now()';
    $estado='0';
    $host=$_SERVER['REMOTE_ADDR'];
    $hostname=gethostbyaddr($host);

	try {
        if (!empty($_GET["id"])) {
            $id = $filter->process($_GET["id"]);
            $top=new Topografia();
            $ntop=$top->buscarnomtop($id);
            $nar=$top->buscararea($id);
            $topos= new Topografia($id, $topo,$ars,$usr,$fecha);
            $topos->modificar();
            $accion = 'MODIFICAR';//akaaaaaaaaaaaaaaaaaaa
            if ($ntop!=$topo and $nar==$ars) {
                $bit=new bitacora();
                $bit->setUsr_id($usr);
                $bit->setAccion($accion);
                $bit->setTabla('TOPOGRAFIA_AREA');
                $bit->setHost($host);
                $bit->setHostname($hostname);
                $bit->setCampo('DESCR_TOP');
                $bit->insertar();
            }elseif ($nar!=$ars and $ntop==$topo) {
                $bit=new bitacora();
                $bit->setUsr_id($usr);
                $bit->setAccion($accion);
                $bit->setTabla('TOPOGRAFIA_AREA');
                $bit->setHost($host);
                $bit->setHostname($hostname);
                $bit->setCampo('ID_AREA');
                $bit->insertar();
            }elseif ($nar!=$ars and $ntop!=$topo) {
                $bit=new bitacora();
                $bit->setUsr_id($usr);
                $bit->setAccion($accion);
                $bit->setTabla('TOPOGRAFIA_AREA');
                $bit->setHost($host);
                $bit->setHostname($hostname);
                $bit->setCampo('DESCR_TOP,ID_AREA');
                $bit->insertar();
            }
            
        } else {
            $topos = new Topografia(NULL,$topo,$ars,$usr,$fecha,$estado);
            $topos->insertar();
            $accion = 'INSERTAR';//akaaaaaaaaaaaaaaaaaaa
            $bit=new bitacora();
            $bit->setUsr_id($usr);
            $bit->setAccion($accion);
            $bit->setTabla('TOPOGRAFIA_AREA');
            $bit->setHost($host);
            $bit->setHostname($hostname);
            $bit->setCampo('');
            $bit->insertar();
        }
        header("location:index.php?page=topografia&accion=listar");
    } catch (Exception $exc) {
        $error = urlencode($exc->getMessage());
        header("location: error.php?mssg=:$error");
        die;
    }
}

function _modificarAction(){
     $id = $_GET['id'];
     $topografia = new Topografia($id);
     $topografia->obtenertopxid();
     $area=new Area();
     $areas=$area->listararea();

    require 'view/topografia/topografia-form.php';
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