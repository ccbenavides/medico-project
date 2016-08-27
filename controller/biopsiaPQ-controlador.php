<?php
//session_start();
require_once 'controller/class.inputfilter.php';
require_once 'model/clases/bioPQ.php';
require_once 'model/clases/bioIH.php';
require_once 'model/clases/biopsia.php';
require_once 'model/clases/paciente.php';
require_once 'model/clases/dependencias.php';
require_once 'model/clases/institucion.php';
require_once 'model/clases/usuariosant.php';
require_once 'model/clases/topografia.php';
require_once 'model/clases/area.php';
require_once 'model/clases/marcador.php';
require_once 'model/clases/bitacora.php';
require_once 'model/clases/muestra-remitida.php';
include 'controller/validar-sesion.php';

function _formAction(){
	$bioq = new bioPQ();
	$biosp = $bioq->listatipos();
	$resultados = $bioq->listaresultado();
	$ubica = $bioq->listaubicacion();
	$tecs = $bioq->listatecnologos();
	$pats = $bioq->listapatologos();
	require 'view/PQ/biopsiaPQ-form.php';
}

function _editarAction(){
	
	$id = $_GET['id'];
	$biopsiap = new bioPQ($id);
    $biopsiap->obtenerinfo();

    $bioq = new bioPQ();
	$biosp = $bioq->listatipos();
    $resultados = $bioq->listaresultado();
	$ubica = $bioq->listaubicacion();
	$tecs = $bioq->listatecnologos();
	$tecmat=$bioq->listecmat();
	$pats = $bioq->listapatologos();
	$marcad=new bioIH();
	$marcadores=$marcad->marcadoresxbiopsia($id);
	$muestra=new bioPQ();
	$muestras=$muestra->obtmuestras($id);
	
	require 'view/PQ/biopsiaPQ-form.php';
}

function _actualizarAction(){
	$id = $_GET['id'];
    $biopsiap = new bioPQ($id);
    $biopsiap->obtenerinfo();
	$topo=new Topografia();
    $topografias=$topo->topxpq();
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
    $biom=$biop->listamuepq();
    

    require 'view/PQ/biopsiaPQ-update.php';

}

function _crearihAction(){
	$id = $_GET['id'];	
	$bioimh=new bioPQ($id);
	$bioimh->obtinfopqih();
	
	$otec=new bioPQ();
	$tecs=$otec->listatecnologos();
	$omar=new Marcador();
	$marcas=$omar->listmarcadores();
	$pruebas=new Biopsia();
	require 'view/PQ/bioPQIH-form.php';
}

function _listarAction(){
 $tema="background: linear-gradient(rgb(195,214,155), white);";	
 $empleado = new UsuarioAnat();
 $empleados = $empleado->usr_emp($_SESSION['idusuario']);

	if ($_SESSION['idperfil_anat']==1 or $_SESSION['idperfil_anat']==2) {
		$bio = new biopsia();
		$bios = $bio->biopsiasPQ();	
		require 'view/PQ/biopsiaPQ-registro.php';
	}else if ($_SESSION['idperfil_anat']==5) {
		$bio = new biopsia();
		$bios=$bio->biotecPQ();
		require 'view/PQ/biopsiaPQ-registro.php';
	} else if ($_SESSION['idperfil_anat']==3 or $_SESSION['idperfil_anat']==6) {
		$bio = new biopsia();
		$bios = $bio->biopqxpat($empleados);
		require 'view/PQ/biopsiaPQ-registro.php';
	}else if ($_SESSION['idperfil_anat']==4) {
		$bio = new biopsia();
		$bios = $bio->bioregPQ();	
		require 'view/PQ/biopsiaPQ-informacion.php';
	}

}

function _finalizadoAction(){
	$tema="background: linear-gradient(rgb(195,214,155), white);";
	if ($_SESSION['idperfil_anat']==1 or $_SESSION['idperfil_anat']==2) {
		$biop = new bioPQ();
		$biosp = $biop->listarbiofinPQ();	
	} else {
		$empleado = new UsuarioAnat();
	 	$empleados = $empleado->usr_emp($_SESSION['idusuario']);

	 	$bio=new biopsia();
	 	$biosp=$bio->biopqfinxpat($empleados);
	}
	
	require 'view/PQ/biopsiaPQ-culminada.php';
}

function _ajaxAgregarMaterialAction(){

	$filter = new Inputfilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);
	$num_tacos=$filter->process($_POST['num_tacos']);
	$num_laminas=$filter->process($_POST['num_laminas']);
	$tecnologo=$filter->process($_POST['tecnologo_res']);
	$fecha_entmat='now()';
	$usr=$_SESSION['idusuario'];
	$fecha_regmat='now()';
	$host=$_SERVER['REMOTE_ADDR'];
    $hostname=gethostbyaddr($host); 
		
	$omat = new bioPQ();
	$empbio=$omat->buscartec($id_biopsia);
	$estadobio=$omat->obtestbio($id_biopsia);
	$lambio=$omat->obtlampq($id_biopsia);
	$tacbio=$omat->obttacpq($id_biopsia);
	$busc=new UsuarioAnat();
	$tecusu=$busc->buscempusu($empbio);

	// if ($_SESSION['idperfil_anat']==1 and $num_tacos!=0 and $num_laminas!=0) {
	if ($_SESSION['idperfil_anat']==1 and $num_laminas!=0) {
		// $actualizado=$omat->actualizamaterial($id_biopsia,$num_laminas,$num_tacos,$fecha_entmat,$tecusu,$fecha_regmat);
		$actualizado=$omat->actualizamaterial($id_biopsia,$num_laminas,$num_tacos,$fecha_entmat,$usr,$fecha_regmat);
		if ($lambio!=$num_laminas and $tacbio==$num_tacos) {
				$accion = 'MODIFICAR';
		        $bit=new bitacora();
		        $bit->setUsr_id($usr);
		        $bit->setAccion($accion);
		        $bit->setTabla('DETALLE_BIOPQ');
		        $bit->setHost($host);
		        $bit->setHostname($hostname);
		        $bit->setCampo('LAMINAS');
		        $bit->insertar();
			}elseif ($tacbio!=$num_tacos and $lambio==$num_laminas) {
				$accion = 'MODIFICAR';
		        $bit=new bitacora();
		        $bit->setUsr_id($usr);
		        $bit->setAccion($accion);
		        $bit->setTabla('DETALLE_BIOPQ');
		        $bit->setHost($host);
		        $bit->setHostname($hostname);
		        $bit->setCampo('TACOS');
		        $bit->insertar();
			}elseif ($tacbio!=$num_tacos and $lambio!=$num_laminas) {
				$accion = 'MODIFICAR';
		        $bit=new bitacora();
		        $bit->setUsr_id($usr);
		        $bit->setAccion($accion);
		        $bit->setTabla('DETALLE_BIOPQ');
		        $bit->setHost($host);
		        $bit->setHostname($hostname);
		        $bit->setCampo('LAMINAS,TACOS');
		        $bit->insertar();
			}
	
		
	} else {
		if ($num_laminas!=0) {
		// if ($num_laminas!=0 and $num_tacos!=0) {
			$actualizado=$omat->actualizamaterial($id_biopsia,$num_laminas,$num_tacos,$fecha_entmat,$usr,$fecha_regmat);
			
			if ($lambio!=$num_laminas and $tacbio==$num_tacos) {
				$accion = 'MODIFICAR';
		        $bit=new bitacora();
		        $bit->setUsr_id($usr);
		        $bit->setAccion($accion);
		        $bit->setTabla('DETALLE_BIOPQ');
		        $bit->setHost($host);
		        $bit->setHostname($hostname);
		        $bit->setCampo('LAMINAS');
		        $bit->insertar();
			}elseif ($tacbio!=$num_tacos and $lambio==$num_laminas) {
				$accion = 'MODIFICAR';
		        $bit=new bitacora();
		        $bit->setUsr_id($usr);
		        $bit->setAccion($accion);
		        $bit->setTabla('DETALLE_BIOPQ');
		        $bit->setHost($host);
		        $bit->setHostname($hostname);
		        $bit->setCampo('TACOS');
		        $bit->insertar();
			}elseif ($tacbio!=$num_tacos and $lambio!=$num_laminas) {
				$accion = 'MODIFICAR';
		        $bit=new bitacora();
		        $bit->setUsr_id($usr);
		        $bit->setAccion($accion);
		        $bit->setTabla('DETALLE_BIOPQ');
		        $bit->setHost($host);
		        $bit->setHostname($hostname);
		        $bit->setCampo('LAMINAS,TACOS');
		        $bit->insertar();
			}
		
		}
		
	}
	
	$response=array();

	$response['inserted']=$actualizado;

	header('Content-Type: application/json');

    echo json_encode($response);
}

function _ajaxGetMatAction(){
	
	$filter = new Inputfilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);

	$omateriales = new bioPQ();

	if ($_SESSION['idperfil_anat']==3) {
		$materiales=$omateriales->getmaterial1($id_biopsia);
	} else {
		$materiales = $omateriales->getmaterial($id_biopsia);
	}
	
	require_once 'view/PQ/ajax-laminastacos.php';
}
/*
function _actualizaestado2Action(){
   $filter = new InputFilter();    
    try{
        $id = $filter->process($_GET['id']); 
        $estado = new bioPQ();
        $estado->actest2($id);

        header("location: index.php?page=biopsiaPQ&accion=listar");
        die;
    } catch (Exception $exc) {
        $error = urlencode($exc->getMessage());
        header("location: error.php?mssg=:$error");
        die;
    }
}*/

function _ajaxAgregarMacroAction(){

	$filter = new Inputfilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);
	$macroscopia=$filter->process($_POST['macroscopia']);
	$usr=$_SESSION['idusuario'];
	$fecha_macro='now()';
	$host=$_SERVER['REMOTE_ADDR'];
    $hostname=gethostbyaddr($host); 
	
	$omac=new bioPQ();
	// $empbio=$omac->buscartec($id_biopsia);
	// $busc=new UsuarioAnat();
	// $tecusu=$busc->buscempusu($empbio);
	$obtmpq=$omac->obtmacropq($id_biopsia);

	if ($_SESSION['idperfil_anat']==1 and $macroscopia!='') {
		$actualizado=$omac->actualizamacro($id_biopsia,$macroscopia,$usr,$fecha_macro);
		$analisis=$omac->actualizaest2($id_biopsia);
		if ($obtmpq!=$macroscopia) {
				$accion = 'MODIFICAR';
		        $bit=new bitacora();
		        $bit->setUsr_id($usr);
		        $bit->setAccion($accion);
		        $bit->setTabla('DETALLE_BIOPQ');
		        $bit->setHost($host);
		        $bit->setHostname($hostname);
		        $bit->setCampo('MACROSCOPIA');
		        $bit->insertar();
		}
	}else{
		if ($macroscopia!='') {
			$actualizado=$omac->actualizamacro($id_biopsia,$macroscopia,$usr,$fecha_macro);
			if ($obtmpq!=$macroscopia) {
				$accion = 'MODIFICAR';
		        $bit=new bitacora();
		        $bit->setUsr_id($usr);
		        $bit->setAccion($accion);
		        $bit->setTabla('DETALLE_BIOPQ');
		        $bit->setHost($host);
		        $bit->setHostname($hostname);
		        $bit->setCampo('MACROSCOPIA');
		        $bit->insertar();
			}
		}
	}

	$response=array();

	$response['inserted']=$actualizado;

	header('Content-Type: application/json');

    echo json_encode($response);
}

function _ajaxActualizaMacroAction(){
	$filter=new Inputfilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);
	$act=new bioPQ();
	$actualizado=$act->actualizaest2($id_biopsia);;
	$response=array();

	$response['inserted']=$actualizado;

	header('Content-Type: application/json');

    echo json_encode($response);
}

function _ajaxGetMacroAction(){
	$filter=new Inputfilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);

	$macros=new bioPQ();

	if ($_SESSION['idperfil_anat']==3) {
		$omacros=$macros->getmacros1($id_biopsia);
	} else {
		$omacros=$macros->getmacros($id_biopsia);
	}	

	require_once 'view/PQ/ajax-macroscopia.php';
}

function _recuperardiagAction(){
	$id_muestrabio=$_POST['id_muestrabio'];
	$biopsiapq=new bioPQ();

	if ($id_muestrabio=="") {
        $nombre="";
    } else {
         $nombre=$biopsiapq->obtdiagmue($id_muestrabio);
    }
     echo $nombre;
}

function _contardiagAction(){
	$id_biopsia=$_POST['id_biopsia'];
	$bipqui=new bioPQ();
	$numeros=$bipqui´->diagvacios($id_biopsia);
	echo $numeros;
}


function _ajaxAgregarDiagAction(){
	
	$filter=new Inputfilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);
	$id_muestrabio=$filter->process($_POST['id_muestrabio']);
	$diag_final=$filter->process($_POST['diag_final']);
	$user=$_SESSION['idusuario'];
	$fecha_diagfinal='now()';

	$odiag=new bioPQ();
	$actualizado=$odiag->actualizadiag($id_biopsia,$id_muestrabio,$diag_final,$user,$fecha_diagfinal);

	$response=array();

	$response['inserted']=$actualizado;

	header('Content-Type: application/json');

    echo json_encode($response);
}

function _ajaxGetDiagAction(){
	$filter=new Inputfilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);

	$odfinal=new bioPQ();

	$diagnosticos=$odfinal->getdiagnostico($id_biopsia);

	require_once 'view/PQ/ajax-diagnostico.php';
}

function _ajaxAgregarResAction(){
	$filter=new Inputfilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);
	$id_res=$filter->process($_POST['id_res']);
	$id_ubicacion=$filter->process($_POST['id_ubicacion']);
	//$valida_patologo=$filter->process($_POST['valida_patologo']);
	//$fecha_informe=$filter->process($_POST['fecha_informe']);

	list($dia, $mes, $anio) = explode('/', $_POST['fecha_informe']);

	$fecha_informe=$anio.'-'.$mes.'-'.$dia;

	$fecha_regresult='now()';

	$ores=new bioPQ();
	$valida_patologo=$ores->obtpatobio($id_biopsia);

	$actualizado=$ores->actualizares($id_biopsia,$id_res,$id_ubicacion,$valida_patologo,$fecha_informe);
	$actfecha=$ores->actualizaregres($id_biopsia,$fecha_regresult);
	

	$response=array();

	$response['inserted']=$actualizado;

	header('Content-Type: application/json');

    echo json_encode($response);
}

function _ajaxfinalizaAction(){
	$filter=new Inputfilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);
	$act=new bioPQ();
	$actualizado=$act->actualizaest3($id_biopsia);
	$response=array();

	$response['inserted']=$actualizado;

	header('Content-Type: application/json');

    echo json_encode($response);
}
function _ajaxGetResAction(){
	$filter=new Inputfilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);
	$oresult=new bioPQ();
	$resultados=$oresult->getresultado($id_biopsia);

	require_once 'view/PQ/ajax-resultado.php';
}

function _ajaxAgregarIHAction(){
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
function _ajaxGetMarcAction(){
	$filter=new Inputfilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);
	$ores=new bioIH();
	$resultados=$ores->getresultado($id_biopsia);

	require_once 'view/PQ/ajax-marcadores.php';
}




function _cambiarstatusAction(){
	$user=$_SESSION['usuario'];
	$id_biopsia = $_POST['idbiopsia'];
	$contra = base64_encode($_POST['contra']);
	$estado = 1;
	$response = array();

	$biospq = new bioPQ();
	$usuariosanato = new UsuarioAnat();

	$validar = $usuariosanato->validarID($user, $contra);

	if ($validar) {
		$uptstatusbiopsia = $biospq->actualizarbiosiaPQ($estado, $id_biopsia);
		$response['update'] = true;
		$response['msj'] = '<b style="color: #2283C5;font-size: 20px;"><i class="fa fa-check"></i> Biopsia actualizada</b>';
	} else {
		$response['update'] = false;
		$response['msj'] = '<b style="color: #D15B47;font-size: 20px;"> <i class="fa fa-warning"></i> Contraseña incorrecta</b>';
	}
	

	header('Content-Type: application/json');

    echo json_encode($response);
}

function _eliminarMarcAction(){

	$filter=new Inputfilter();

			$id_biopsia = $_POST['idbiopsia'];
			$id_marc_prueba=$_POST['idmarca'];
			$oreg=new bioPQ();
			$resultado1=$oreg->eliminarM($id_marc_prueba);
			$resultados=$oreg->obtenermarcpq($id_biopsia);

	require_once 'view/PQ/ajax-marcadores.php';

}
/* Functions for Revision View */

function _ajaxgetinfopacienteAction(){
	$fecha_inicial = $_POST['fecha_inicial'];
	$fecha_final = $_POST['fecha_final'];
	$position = isset($_POST['position']);
	if(empty($position)){
		$position=0;
	}else{
		$position = $_POST['position'];
	}
	if ($_SESSION['idperfil_anat']==1 or $_SESSION['idperfil_anat']==2) {
		$biop = new bioPQ();
		if(empty($fecha_inicial) and empty($fecha_final)){
			$biosp = $biop->listardatesbio();
			$pats = $biop->listapatologos();
			$topografias = $biop->listarTopografia();
			$muestras = $biop->listamuepq();
			$servicios = $biop->listarServicio();
			$resultados = $biop->listaresultado();
			$ubica = $biop->listaubicacion();
		}else{
			$biosp = $biop->listarbioRevisionFecha($fecha_inicial,$fecha_final);
			$pats = $biop->listapatologos();
			$topografias = $biop->listarTopografia();
			$muestras = $biop->listamuepq();
			$servicios = $biop->listarServicio();
			$resultados = $biop->listaresultado();
			$ubica = $biop->listaubicacion();
		}
	}
	// require 'view/PQ/biopsiaPQ-datospaciente.php';
		$data = array(
			'biosp' => $biosp
		);
		echo json_encode($data);
}

function _revisionAction(){

	$position = isset($_POST['position']);
	if(empty($position)){
		$position=0;
	}else{
		$position = isset($_POST['position']);
	}
	$tema="background: linear-gradient(rgb(195,214,155), white);";
	if ($_SESSION['idperfil_anat']==1 or $_SESSION['idperfil_anat']==2) {
		$biop = new bioPQ();

			$biosp = $biop->listardatesbio();
			$pats = $biop->listapatologos();
			$topografias = $biop->listarTopografia();
			$muestras = $biop->listamuepq();
			$servicios = $biop->listarServicio();
			$resultados = $biop->listaresultado();
			$ubica = $biop->listaubicacion();

	}
	require 'view/PQ/biopsiaPQ-revision.php';
}




function _revisionFechaAction(){

	$fecha_inicial = $_POST['fecha_inicial'];
	$fecha_final = $_POST['fecha_final'];
	$position = isset($_POST['position']);
	if(empty($position)){
		$position=0;
	}else{
		$position = isset($_POST['position']);
	}
	$tema="background: linear-gradient(rgb(195,214,155), white);";
	if ($_SESSION['idperfil_anat']==1 or $_SESSION['idperfil_anat']==2) {
		$biop = new bioPQ();
			//die($fecha_inicial . "-" . $fecha_final);
			$biosp = $biop->listarbioRevisionFecha($fecha_inicial,$fecha_final);
			$pats = $biop->listapatologos();
			$topografias = $biop->listarTopografia();
			$muestras = $biop->listamuepq();
			$servicios = $biop->listarServicio();
			$resultados = $biop->listaresultado();
			$ubica = $biop->listaubicacion();

	}
	$data = array(
			'biosp' => $biosp,
			'pats' => $pats,
			'topografias' => $topografias,
			'muestras' => $muestras,
			'resultados' => $resultados,
			'ubica' => $ubica,
			'tacama' => "vino"
		);
	echo json_encode($data);
}




?>