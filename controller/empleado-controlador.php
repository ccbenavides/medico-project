<?php
require_once 'controller/class.inputfilter.php';
require_once 'model/clases/empleado.php';
require_once 'model/clases/usuariosant.php';
include 'controller/validar-sesion.php';

function _listarAction(){
	$empleado= new Empleados();
	$empleados=$empleado->consultar();

	require 'view/empleado/empleado-registro.php';
}

function _formAction(){
	$trab=new Empleados();
	$trabajos=$trab->listartrab();
	$grupos=$trab->listargoc();
	require 'view/empleado/empleado-form.php';
}

function _modificarAction(){
	
	$id = $_GET['id'];
    $empleados = new Empleados();
    $empleado=$empleados->obtener_empxid($id);
    
    $trab=new Empleados();
	$trabajos=$trab->listartrab();
	$grupos=$trab->listargoc();
	require 'view/empleado/empleado-form.php';
}

function _eliminarAction(){
	$filter = new InputFilter();	
	try{
        $id = $filter->process($_GET['id']); 
        $empleado = new Empleados();
        $empleado->eliminar($id);
        $usuario=new UsuarioAnat();
        $usuario->eliminar2($id);
        header("location: index.php?page=empleado&accion=listar");
        die;
    } catch (Exception $exc) {
        $error = urlencode($exc->getMessage());
        header("location: error.php?mssg=:$error");
        die;
    }
}

function _insertarAction(){
	session_start();
	$filter = new InputFilter();
	$dni=$_POST['dni'];
	$nombres=$_POST['nombres'];
	$appaterno=$_POST['appaterno'];
	$apmaterno=$_POST['apmaterno'];
	$sexo=$_POST['optionsRadio'];
	$direccion=$_POST['direccion'];
	$trabajo=$_POST['trabajo'];
	$ocupacion=$_POST['grupo'];
	$colegiatura=$_POST['colegiatura'];
	$usr = $_SESSION['idusuario'];
	$fecha='now()';
	
	try {
        if (!empty($_GET["id"])) {
            $id = $filter->process($_GET["id"]);
            $empleado = new Empleados();
            $empleado->setEmp_id($id);
            $empleado->setEmp_dni($dni);
            $empleado->setEmp_nombres($nombres);
            $empleado->setEmp_appaterno($appaterno);
            $empleado->setEmp_apmaterno($apmaterno);
            $empleado->setTrab_id($trabajo);
            $empleado->setGoc_id($ocupacion);
            $empleado->setEmp_colegiatura($colegiatura);
            $empleado->setestado('0');
            $empleado->setusureg($usr);
            $empleado->setfecha($fecha);
            $empleado->setsexo($sexo);
            $empleado->setdireccion($direccion);
            $empleado->modificar();
            
        } else {
            $empleado = new Empleados();
            $empleado->setEmp_dni($dni);
            $empleado->setEmp_nombres($nombres);
            $empleado->setEmp_appaterno($appaterno);
            $empleado->setEmp_apmaterno($apmaterno);
            $empleado->setTrab_id($trabajo);
            $empleado->setGoc_id($ocupacion);
            $empleado->setEmp_colegiatura($colegiatura);
            $empleado->setestado('0');
            $empleado->setusureg($usr);
            $empleado->setfecha($fecha);
            $empleado->setsexo($sexo);
            $empleado->setdireccion($direccion);
            $empleado->insertar();            
        }

        header("location: index.php?page=empleado&accion=listar");
    } catch (Exception $exc) {
        $error = urlencode($exc->getMessage());
        header("location: error.php?mssg=:$error");
        die;
    }

}



?>