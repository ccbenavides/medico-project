<?php

require_once 'controller/class.inputfilter.php';
require_once 'model/clases/bioIH.php';
require_once 'model/clases/bioPQ.php';
require_once 'model/clases/biopsia-detalle.php';
require_once 'model/clases/biopsia.php';
require_once 'model/clases/marcador.php';
require_once 'model/clases/paciente.php';
require_once 'model/clases/dependencias.php';
require_once 'model/clases/usuariosant.php';
require_once 'model/clases/topografia.php';
require_once 'model/clases/institucion.php';
include 'controller/validar-sesion.php';


function _listarAction(){
	
	$tema="background: linear-gradient(rgb(190,123,69), white);";
	$empleado = new UsuarioAnat();
	$empleados = $empleado->usr_emp($_SESSION['idusuario']);

	if ($_SESSION['idperfil_anat']==1 or $_SESSION['idperfil_anat']==2 ) {
		$bioih = new biopsia();
		$biosih = $bioih->biopsiasIH();
		require 'view/IH/biopsiaIH-registro.php';
	} else if ($_SESSION['idperfil_anat']==5) {
		$bioih=new biopsia();
		$biosih=$bioih->biotecnIH();
		require 'view/IH/biopsiaIH-registro.php';
	}else if ($_SESSION['idperfil_anat']==3 or $_SESSION['idperfil_anat']==6){
		$bioih = new biopsia();
		$biosih = $bioih->bioihxpat($empleados);
		require 'view/IH/biopsiaIH-registro.php';
	}else if ($_SESSION['idperfil_anat']==4) {
		$bioih = new biopsia();
		$biosih = $bioih->bioregIH();
		require 'view/IH/biopsiaIH-informacion.php';
	}
		
	

}

function _finalizarAction(){
	$tema="background: linear-gradient(rgb(190,123,69), white);";
	if ($_SESSION['idperfil_anat']==1 or $_SESSION['idperfil_anat']==2) {
		$finih=new bioIH();
		$finalih=$finih->listarfinbioIH();
	} else {
		$empleado = new UsuarioAnat();
	 	$empleados = $empleado->usr_emp($_SESSION['idusuario']);

	 	$finih=new biopsia();
	 	$finalih=$finih->bioihfinxpat($empleados);
	}
	
	
	require 'view/IH/biopsiaIH-finalizada.php';
}

function _editarAction(){
	$id = $_GET['id'];
	$biopsiaih = new bioPQ($id);
    $biopsiaih->obtenerinfoih();
    $muestra=new bioPQ();
	$muestras=$muestra->obtmuestras($id);
	$marcad=new bioIH();
	$marcadores=$marcad->marcadoresxbiopsia($id);

    $bioq = new bioPQ();
	$pats = $bioq->listapatologos();
	$tecs=$bioq->listatecnologos();
	require 'view/IH/biopsiaIH-form.php';
}

function _actualizarAction(){
	$id = $_GET['id'];
    $biopsiap = new bioPQ($id);
    $biopsiap->obtenerinfoih();
	$topo=new Topografia();
    $topografias=$topo->topxih();
    $dep = new Dependencia();
    $deps=$dep->consultar();
    $inst = new Institucion();
    $insts=$inst->consultar();
    //$empleado=new Empleados();
    //$emps=$empleado->muestramed();
    $biop = new bioPQ();
    $biosp=$biop->listatipos();
    $pats = $biop->listapatologos();
    $tecs=$biop->listaproc();
    $biom=$biop->listamueih();
 
  require 'view/IH/biopsiaIH-update.php';
}

function _crearmarcAction(){
	$id = $_GET['id'];	
	$bioimh=new bioPQ($id);
	$bioimh->obtinfopqih();
	
	$otec=new bioPQ();
	$tecs=$otec->listatecnologos();
	$omar=new Marcador();
	$marcas=$omar->listmarcadores();
	$pruebas=new Biopsia();
	require 'view/IH/biopsiaIHMAR-form.php';
}

function _recuperarresultAction(){
	$id_marc_prueba=$_POST['id_marc_prueba'];
	$biopsiapq=new bioIH();

	if ($id_marc_prueba=="") {
        $nombre="";
    } else {
         $nombre=$biopsiapq->obtresmar($id_marc_prueba);
    }
     echo $nombre;
}

function _insertarmarcAction(){
	 $filter = new InputFilter();
    $prueba=$filter->process($_POST['prueba']);
    $numero=$filter->process($_POST['numbio']);
    $id_biopsia=$filter->process($_POST['id_biopsia']);
    $responsable=$filter->process($_POST['tecnologo']);
    $fecha=$filter->process($_POST['fecha_ingreso']);
    $usuario=$_SESSION['idusuario'];
    $fecha_registro='now()';
    $nuevo=new Biopsia();
    $nprueba=$nuevo->codprueba();

    for ($i=1; $i <21 ; $i++) { 
        $desmues[$i]=$_POST['desmues'.$i];
        $cantidad[$i]=$_POST['cantidad'.$i];
    }

    try{
        $pruebabio = new BiopsiaDetalle();
        $pruebabio->setprueba($prueba);
        $pruebabio->setIdBio($id_biopsia);
        $pruebabio->setresponsable($responsable);
        $pruebabio->setfecha($fecha);
        $pruebabio->setuserg($usuario);
        $pruebabio->setfecreg($fecha_registro);
        $pruebabio->setcodprueba($nprueba);
        $pruebabio->insertmarc();


         $marcadp = new Marcador();
         $idbiopsias = $marcadp->consultarxbio($id_biopsia);

         foreach ($idbiopsias as $marcadp) {
            $new_id = $marcadp->id_control;
         } 

         for ($i=1; $i <21 ; $i++) { 
                if ($desmues[$i]!=-1 and $cantidad[$i]!=0) {
                    $marcados = new BiopsiaDetalle();
                    $marcados->setprueba($new_id);
                    $marcados->setmarcador($desmues[$i]);
                    $marcados->setcantidad($cantidad[$i]);
                    $marcados->insertpruemarc();
             } 
      
       }

       header("location:index.php?page=biopsiaIH&accion=editar&id=".$id_biopsia);
    }catch(Exception $exc){
        echo $exc->getTraceAsString();
    }
}


function _ajaxAgregaMacroAction(){
	$filter=new Inputfilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);
	//$tecnologo=$filter->process($_POST['tecnologo']);
	$macroscopia=$filter->process($_POST['macroscopia']);
	$usr=$_SESSION['idusuario'];
	$fecha='now()';
	$tec=new bioPQ();
	$nuevotec=$tec->obttecbio($usr);
	$tecbio=$tec->buscartec($id_biopsia);
	$macros=new bioIH();
	if ($_SESSION['idperfil_anat']==1) {
		$modificado=$macros->modificarmacro($id_biopsia,$macroscopia,$tecbio,$usr,$fecha);
		$estado=new bioPQ();
		$analisis=$estado->actualizaest2($id_biopsia);
	} else {
		$modificado=$macros->modificarmacro($id_biopsia,$macroscopia,$nuevotec,$usr,$fecha);
	}
	
	$response=array();

	$response['inserted']=$modificado;

	header('Content-Type: application/json');

    echo json_encode($response);
}

function _ajaxGetMacroihAction(){
	
	$filter=new Inputfilter();

	$id_biopsia=$filter->process($_POST['id_biopsia']);
	$omacro=new bioIH();
	$macroscopia=$omacro->getmacroih($id_biopsia);

	require_once 'view/IH/ajax-macroscopia.php';
}

function _ajaxActualizado2Action(){
	$filter=new Inputfilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);
	$act=new bioPQ();
	$actualizado=$act->actualizaest2($id_biopsia);;
	$response=array();

	$response['inserted']=$actualizado;

	header('Content-Type: application/json');

    echo json_encode($response);
}

function _ajaxAgregProcAction(){
	
	$filter=new Inputfilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);
	$id_muestrabio=$filter->process($_POST['id_muestrabio']);
	$procedimiento=$filter->process($_POST['procedimiento']);
	$usuario=$_SESSION['idusuario'];
	$fecha='now()';

	$oproc=new bioIH();
	$actualizado=$oproc->modificardiag($id_biopsia,$id_muestrabio,$procedimiento,$usuario,$fecha);

	$response=array();

	$response['inserted']=$actualizado;

	header('Content-Type: application/json');

    echo json_encode($response);

}

function _ajaxGetProcAction(){
	
	$filter=new Inputfilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);

	$proced=new bioIH();

	$procedimientos=$proced->getdiagih($id_biopsia);

	require_once 'view/IH/ajax-proc.php';
}

function _ajaxAgregResultAction(){

	$filter=new Inputfilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);
	$id_marc_prueba=$filter->process($_POST['id_marc_prueba']);
	$resultado=$filter->process($_POST['resultado']);

		$oreg=new bioIH();
	$actualizar=$oreg->actualizaresultado($id_marc_prueba,$resultado);

	$response=array();

	$response['inserted']=$actualizar;

	header('Content-Type: application/json');

    echo json_encode($response);
}
function _ajaxAgregResultGenAction(){

	$filter=new Inputfilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);
	// $id_marc_prueba=$filter->process($_POST['id_marc_prueba']);
	$res_general=$filter->process($_POST['res_general']);

		$oreg=new bioIH();
	// $actualizar=$oreg->actualizaresultado($id_marc_prueba,$resultado);
	$actualizar=$oreg->actualizaresultadoGen($id_biopsia,$res_general);

	$response=array();

	$response['inserted']=$actualizar;

	header('Content-Type: application/json');

    echo json_encode($response);
}

function _ajaxGetResGenAction(){

	$filter=new Inputfilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);
	$oresultgen=new bioIH();
	$resultadosgen=$oresultgen->getresultadogen($id_biopsia);

	require_once 'view/IH/ajax-resgenih.php';
}

function _ajaxGetResAction(){

	$filter=new Inputfilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);
	$ores=new bioIH();
	$resultados=$ores->getresultado($id_biopsia);

	require_once 'view/IH/ajax-resih.php';
}

function _ajaxfinalizaihAction(){
	$filter=new Inputfilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);
	$act=new bioPQ();
	$actualizado=$act->actualizaest3($id_biopsia);;
	$response=array();

	$response['inserted']=$actualizado;

	header('Content-Type: application/json');

    echo json_encode($response);
}


function _ajaxAgregConclusAction(){

	$filter=new Inputfilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);
	$conclusion=$filter->process($_POST['conclusion']);
	//$valida_patologo=$filter->process($_POST['valida_patologo']);
	//$fecha_informe=$filter->process($_POST['fecha_informe']);
	// $fecha_informe='now()';

	list($dia, $mes, $anio) = explode('/', $_POST['fecha_informe']);
	$fecha_informe = $anio.'-'.$mes.'-'.$dia;

	$usrs=$_SESSION['idusuario'];
	$fecha_reg='now()';

	$pato=new bioPQ();
	$valida_patologo=$pato->obtpatobio($id_biopsia);

	$oconclusion=new bioIH();

	$modificado=$oconclusion->actualizaconclusion($id_biopsia,$conclusion,$valida_patologo,$fecha_informe);
	$actual=$oconclusion->actualizaregconclu($id_biopsia,$usrs,$fecha_reg);

	$response=array();

	$response['inserted']=$modificado;

	header('Content-Type: application/json');

    echo json_encode($response);
}

function _ajaxGetConclusAction(){

	$filter = new Inputfilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);

	$ocl=new bioIH();
	$conclusiones=$ocl->getconclusion($id_biopsia);

	require_once 'view/IH/ajax-conclusion.php';

}


function _eliminarMarcAction(){

	$filter=new Inputfilter();

			$id_biopsia = $_POST['idbiopsia'];
			$id_marc_prueba=$_POST['idmarca'];
			$oreg=new bioIH();
			$resultado1=$oreg->eliminarM($id_marc_prueba);
			$resultados=$oreg->getresultado($id_biopsia);

	require_once 'view/IH/ajax-resih.php';
}

?>