<?php

require_once 'controller/class.inputfilter.php';
require_once 'model/clases/bioCCV.php';
require_once 'model/clases/bioPQ.php';
require_once 'model/clases/biopsia.php';
require_once 'model/clases/paciente.php';
require_once 'model/clases/usuariosant.php';
require_once 'model/clases/dependencias.php';
require_once 'model/clases/institucion.php';
include 'controller/validar-sesion.php';


function _listarAction(){
	if ($_SESSION['idperfil_anat']==1 or $_SESSION['idperfil_anat']==2) {
		$bioccv = new biopsia();
		$biosccv = $bioccv->biopsiasCCV();
		require 'view/CCV/biopsiaCCV-registro.php';
	} else if($_SESSION['idperfil_anat']==3 or $_SESSION['idperfil_anat']==6 ) {
		$empleado = new UsuarioAnat();
	 	$empleados = $empleado->usr_emp($_SESSION['idusuario']);

		$bioccv = new biopsia();
		$biosccv = $bioccv->bioccvxpat($empleados);
		require 'view/CCV/biopsiaCCV-registro.php';
	}else if ($_SESSION['idperfil_anat']==4) {
		$bioccv = new biopsia();
		$biosccv = $bioccv->bioregCCV();
		require 'view/CCV/biopsiaCCV-informacion.php';
	}

}
function _finalizadaAction(){
	
	
	if ($_SESSION['idperfil_anat']==1 or $_SESSION['idperfil_anat']==2) {
		$bioc=new biopsia();
		$biocc=$bioc->biofinCCV();
	} else {
		$empleado = new UsuarioAnat();
	 	$empleados = $empleado->usr_emp($_SESSION['idusuario']);

	 	$bioc=new biopsia();
		$biocc=$bioc->bioccvfinxpat($empleados);
	}
	require 'view/CCV/biopsiaCCV-finalizada.php';
}

function _formAction(){
	
	$biocv = new bioCCV();
	$bioscv = $biocv->listarmuestras();
	$diagcv = $biocv->listardiagPPA();
	$codbcv = $biocv->listarcodbet();

	$biopq = new bioPQ();
	$tecs = $biopq->listatecnologos();
	$pats = $biopq->listapatologos();

	require 'view/CCV/biopsiaCCV-form.php';
}

function _editarAction(){
	$id = $_GET['id'];
	$biopsiaccv = new bioPQ($id);
    $biopsiaccv->obtinfoccv();

    $bio=new Biopsia();
    $bio_actual=$bio->getbiopsiaxid($id);


    $biocv = new bioCCV();
	$diagcv = $biocv->listardiagPPA();
	$codbcv = $biocv->listarcodbet();

	$biopq = new bioPQ();
	$tecs = $biopq->listatecnologos();
	$pats = $biopq->listapatologos();
    
    require_once 'view/CCV/biopsiaCCV-form.php';
}

function _actualizarAction(){
	$id = $_GET['id'];
    $biopsiap = new bioPQ($id);
    $biopsiap->obtinfoccv();
	$dep = new Dependencia();
    $deps=$dep->consultar();
    $inst = new Institucion();
    $insts=$inst->consultar();
    //$empleado=new Empleados();
    //$emps=$empleado->muestramed();
    $biop = new bioPQ();
    $pats = $biop->listapatologos();
    $tecs=$biop->listaproc();
    $biom=$biop->listamueccv();
    
    require 'view/CCV/biopsiaCCV-update.php';
}

function _ajaxAgregarDiagAction(){

	$filter = new InputFilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);
	$id_codigo=$filter->process($_POST['id_codigo']);
	$otro_codbet=$filter->process($_POST['otro_codbet']);
	$id_diagccv=$filter->process($_POST['id_diagccv']);
	$user=$_SESSION['idusuario'];
	$fecha='now()';

	if ($id_codigo==38) {
		$nuevo=$otro_codbet;
	} else {
		$nuevo='';
	}
	
	$odiag = new bioCCV();

	$actualizado=$odiag->actualizarDiagnostico($id_biopsia,$id_codigo,$nuevo,$id_diagccv,$user,$fecha);
	if ($id_biopsia>0) {
		$analisis=$odiag->actualizarestado($id_biopsia);
	}

	$response=array();

	$response['inserted']=$actualizado;

	header('Content-Type: application/json');

    echo json_encode($response);
}

function _ajaxGetDiagAction(){
	$id_biopsia=$_POST['id_biopsia'];
	$odiagnostico=new bioCCV();
	$diagnosticos=$odiagnostico->getdiag($id_biopsia);

	require_once "view/CCV/ajax-diagnosticoccv.php";
}

function _ajaxAgregarDesAction(){
	$filter = new InputFilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);
	$tecnologo=$filter->process($_POST['tecnologo']);
	$descripcion=$filter->process($_POST['descripcion']);
	//$fecha_informe=$filter->process($_POST['fecha_informe']);
	$usuario=$_SESSION['idusuario'];
	$fecha='now()';

	list($dia, $mes, $anio) = explode('/', $_POST['fecha_informe']);


	$fecha_informe=$anio.'-'.$mes.'-'.$dia;

	$odesc=new bioCCV();
	$actualizar=$odesc->actualizarDescripcion($id_biopsia,$tecnologo,$descripcion,$fecha_informe,$usuario,$fecha);
	
	$response=array();
	$response['inserted']=$actualizar;
	header('Content-Type: application/json');
	echo json_encode($response);
}
function _ajaxGetDesAction(){
	$id_biopsia=$_POST['id_biopsia'];
	$odescripcion=new bioCCV();
	$descripciones=$odescripcion->getdesc($id_biopsia);
	require_once "view/CCV/ajax-descripcion.php";
}

function _ajaxfinalizaccvAction(){
	$filter=new Inputfilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);
	$act=new bioCCV();
	$actualizado=$act->actualizaest3($id_biopsia);;
	$response=array();

	$response['inserted']=$actualizado;

	header('Content-Type: application/json');

    echo json_encode($response);
}


function _ajaxAgregarVerfAction(){
	$filter=new InputFilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);
	$valida_patologo=$filter->process($_POST['valida_patologo']);
	$fecha_informe=$filter->process($_POST['fecha_informe']);
	$usuario=$_SESSION['idusuario'];
	$fecha='now()';
	

		$overifica = new bioCCV();
		$insertado=$overifica->insertarVerificacion($id_biopsia,$valida_patologo,$fecha_informe,$usuario,$fecha);

		if ($valida_patologo==222 or $valida_patologo==532 or $valida_patologo==988 or $valida_patologo==1148) {
			$finalizado=$overifica->actualizarestado($id_biopsia);
		}
	$response=array();			
	$response['inserted']=$insertado;
	
header('Content-Type: application/json');

echo json_encode($response);  
	
}
function _ajaxGetVerAction(){
	$id_biopsia=$_POST['id_biopsia'];
	$overificacion=new bioCCV();
	$verificaciones=$overificacion->getVerf($id_biopsia);
	require_once "view/CCV/ajax-verificacion.php";
}
?>