<?php
//session_start();
require_once 'controller/class.inputfilter.php';
require_once 'model/clases/bioCE.php';
require_once 'model/clases/bioPQ.php';
require_once 'model/clases/bioIH.php';
require_once 'model/clases/biopsia.php';
require_once 'model/clases/paciente.php';
require_once 'model/clases/usuariosant.php';
require_once 'model/clases/dependencias.php';
require_once 'model/clases/institucion.php';
require_once 'model/clases/marcador.php';
require_once 'model/clases/bitacora.php';
require_once 'model/clases/biopsia-detalle.php';

include 'controller/validar-sesion.php';


function _listarAction(){
$tema="background: linear-gradient(orange, white);";
$empleado = new UsuarioAnat();
$empleados = $empleado->usr_emp($_SESSION['idusuario']);
	if ($_SESSION['idperfil_anat']==1 or $_SESSION['idperfil_anat']==2) {
		$biocv = new biopsia();
		$bioscv = $biocv->biopsiasCE();
	} else if ($_SESSION['idperfil_anat']==5) {
		$biocv = new biopsia();
		$bioscv = $biocv->biotecnCE();
	} else if ($_SESSION['idperfil_anat']==3 or $_SESSION['idperfil_anat']==6){
		$biocv = new biopsia();
		$bioscv = $biocv->biocexpat($empleados);
	}
require 'view/CE/biopsiaCE-registro.php';
}

function _finalizadaAction(){

	$tema="background: linear-gradient(orange, white);";	
	

	if ($_SESSION['idperfil_anat']==1 or $_SESSION['idperfil_anat']==2) {
		$biop = new bioCE();
		$biosp = $biop->listarbiofinCE();
	} else {
		$empleado = new UsuarioAnat();
	 	$empleados = $empleado->usr_emp($_SESSION['idusuario']);

	 	$biop = new biopsia();
		$biosp = $biop->biocefinxpat($empleados);
	}
	

	require 'view/CE/biopsiaCE-culminado.php';
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
	require 'view/CE/biopsiaCEIH-form.php';
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

    if($id_biopsia>0){
        $actualizar = new bioPQ();
        $actualizar->setIdBio($id_biopsia);
        $actualizar->setreqih('Si');
        $actualizar->modificarceih();
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

       header("location:index.php?page=biopsiaCE&accion=editar&id=".$id_biopsia);
    }catch(Exception $exc){
        echo $exc->getTraceAsString();
    }
}


function _formAction(){
	$pats = new bioPQ();
	$pat = $pats->listapatologos();
	require 'view/CE/biopsiaCE-form.php';
}

function _editarAction(){
	$id = $_GET['id'];
	$biopsiace = new bioPQ($id);
    $biopsiace->obtenerinfoce();
    $muestra=new bioPQ();
	$muestras=$muestra->obtmuestras($id);
	
    $bioq = new bioPQ();
	$pat = $bioq->listapatologos();
	$resultados = $bioq->listresultce();
	$marcad=new bioIH();
	$marcadores=$marcad->marcadoresxbiopsia($id);
    require 'view/CE/biopsiaCE-form.php';
}

function _ajaxAgregaMatAction(){

	$filter= new Inputfilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);
	$num_tacos=$filter->process($_POST['num_tacos']);
	$num_laminas=$filter->process($_POST['num_laminas']);
	$fecha_entmat=$filter->process($_POST['fecha_entmat']);
	$usr=$_SESSION['idusuario'];
	$fecha_regmat='now()';
	$fecha_entrega='now()';
	$host=$_SERVER['REMOTE_ADDR'];
    $hostname=gethostbyaddr($host); 

    $otec=new bioPQ();
    $emp_bio=$otec->buscartec($id_biopsia);

    $busc=new UsuarioAnat();
	$tecusu=$busc->buscempusu($emp_bio);


	$omate=new bioCE();
	$lambio=$omate->obtlamce($id_biopsia);
	$tacbio=$omate->obttacce($id_biopsia);

	if ($_SESSION['idperfil_anat']==1 and $num_tacos!=0 and $num_laminas!=0) {
		
		$actualizar=$omate->actualizarmaterial($id_biopsia,$num_laminas,$num_tacos,$fecha_entrega,$tecusu,$fecha_regmat);
		if ($lambio!=$num_laminas and $tacbio==$num_tacos) {
				$accion = 'MODIFICAR';
		        $bit=new bitacora();
		        $bit->setUsr_id($usr);
		        $bit->setAccion($accion);
		        $bit->setTabla('DETALLE_BIOCE');
		        $bit->setHost($host);
		        $bit->setHostname($hostname);
		        $bit->setCampo('LAMINAS');
		        $bit->insertar();
		}elseif ($tacbio!=$num_tacos and $lambio==$num_laminas) {
				$accion = 'MODIFICAR';
		        $bit=new bitacora();
		        $bit->setUsr_id($usr);
		        $bit->setAccion($accion);
		        $bit->setTabla('DETALLE_BIOCE');
		        $bit->setHost($host);
		        $bit->setHostname($hostname);
		        $bit->setCampo('TACOS');
		        $bit->insertar();
		}elseif ($tacbio!=$num_tacos and $lambio!=$num_laminas) {
			    $accion = 'MODIFICAR';
		        $bit=new bitacora();
		        $bit->setUsr_id($usr);
		        $bit->setAccion($accion);
		        $bit->setTabla('DETALLE_BIOCE');
		        $bit->setHost($host);
		        $bit->setHostname($hostname);
		        $bit->setCampo('LAMINAS,TACOS');
		        $bit->insertar();
		}
	} else {
		
		if ($num_laminas!=0 and $num_tacos!=0) {
			
			$actualizar=$omate->actualizarmaterial($id_biopsia,$num_laminas,$num_tacos,$fecha_entrega,$usr,$fecha_regmat);

			if ($lambio!=$num_laminas and $tacbio==$num_tacos) {
				$accion = 'MODIFICAR';
		        $bit=new bitacora();
		        $bit->setUsr_id($usr);
		        $bit->setAccion($accion);
		        $bit->setTabla('DETALLE_BIOCE');
		        $bit->setHost($host);
		        $bit->setHostname($hostname);
		        $bit->setCampo('LAMINAS');
		        $bit->insertar();
			}elseif ($tacbio!=$num_tacos and $lambio==$num_laminas) {
				$accion = 'MODIFICAR';
		        $bit=new bitacora();
		        $bit->setUsr_id($usr);
		        $bit->setAccion($accion);
		        $bit->setTabla('DETALLE_BIOCE');
		        $bit->setHost($host);
		        $bit->setHostname($hostname);
		        $bit->setCampo('TACOS');
		        $bit->insertar();
			}elseif ($tacbio!=$num_tacos and $lambio!=$num_laminas) {
				$accion = 'MODIFICAR';
		        $bit=new bitacora();
		        $bit->setUsr_id($usr);
		        $bit->setAccion($accion);
		        $bit->setTabla('DETALLE_BIOCE');
		        $bit->setHost($host);
		        $bit->setHostname($hostname);
		        $bit->setCampo('LAMINAS,TACOS');
		        $bit->insertar();
			}

		}

	}
	
	$response=array();

	$response['inserted']=$actualizar;

	header('Content-Type: application/json');

    echo json_encode($response);
}

function _ajaxGetMatceAction(){

	$filter = new Inputfilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);

	$omates=new bioCE();

	$materialesce=$omates->getmateriales($id_biopsia);

	require_once 'view/CE/ajax_lamtaco.php';
}

function _ajaxAgregMacroAction(){
	$filter=new Inputfilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);
	$macroscopia=$filter->process($_POST['macroscopia']);
	$usr=$_SESSION['idusuario'];
	$fechareg_macro='now()';
	$host=$_SERVER['REMOTE_ADDR'];
    $hostname=gethostbyaddr($host); 

	$omacro=new bioCE();

	$macrobio=$omacro->obtmacroscopiace($id_biopsia);
	

	if ($_SESSION['idperfil_anat']==1 and $macroscopia!='') {
		$modificado=$omacro->actualizarmacro($id_biopsia,$macroscopia,$usr,$fechareg_macro);
		$act=new bioPQ();
		$actestado=$act->actualizaest2($id_biopsia);

		if ($macrobio!=$macroscopia) {
				$accion = 'MODIFICAR';
		        $bit=new bitacora();
		        $bit->setUsr_id($usr);
		        $bit->setAccion($accion);
		        $bit->setTabla('DETALLE_BIOCE');
		        $bit->setHost($host);
		        $bit->setHostname($hostname);
		        $bit->setCampo('MACROSCOPIA');
		        $bit->insertar();
		}

	}else{
		if($macroscopia!=''){
			$modificado=$omacro->actualizarmacro($id_biopsia,$macroscopia,$usr,$fechareg_macro);
			if ($macrobio!=$macroscopia) {
				
				$accion = 'MODIFICAR';
		        $bit=new bitacora();
		        $bit->setUsr_id($usr);
		        $bit->setAccion($accion);
		        $bit->setTabla('DETALLE_BIOCE');
		        $bit->setHost($host);
		        $bit->setHostname($hostname);
		        $bit->setCampo('MACROSCOPIA');
		        $bit->insertar();
			}

		}
	}

	$response=array();

	$response['inserted']=$modificado;

	header('Content-Type: application/json');

    echo json_encode($response);

}

function _ajaxActualiza2Action(){
	$filter=new Inputfilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);
	$act=new bioPQ();
	$actualizado=$act->actualizaest2($id_biopsia);;
	$response=array();

	$response['inserted']=$actualizado;

	header('Content-Type: application/json');

    echo json_encode($response);
}

function _ajaxGetMacrosAction(){
	$filter=new Inputfilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);

	$macros=new bioCE();
	if ($_SESSION['idperfil_anat']==3) {
		$macroscopias=$macros->getmacro1($id_biopsia);
	} else {
		$macroscopias=$macros->getmacro($id_biopsia);
	}
	require_once 'view/CE/ajax-macro.php';
}

function _ajaxAgregDiadesAction(){
	$filter=new Inputfilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);
	$id_muestrabio=$filter->process($_POST['id_muestrabio']);
	$diag_final=$filter->process($_POST['diag_final']);
	//$descrip_muestce=$filter->process($_POST['descrip_muestce']);
	$user=$_SESSION['idusuario'];
	$fecha_diagfinal='now()';

	$odiades=new bioCE();

	$actualizado=$odiades->actualizadiag($id_biopsia,$id_muestrabio,$diag_final,$user,$fecha_diagfinal);

	$response=array();

	$response['inserted']=$actualizado;

	header('Content-Type: application/json');

    echo json_encode($response);
}

function _ajaxGetDiagdesAction(){
	
	$filter=new Inputfilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);

	$diags=new bioCE();

	$diagnosticos=$diags->getdiag($id_biopsia);

	require_once 'view/CE/ajax-diagdes.php';
}

function _ajaxAgregResulAction(){
	
	$filter=new Inputfilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);
	$resultado=$filter->process($_POST['resultado']);
	//$valida_patologo=$filter->process($_POST['valida_patologo']);
	//$fecha_informe=$filter->process($_POST['fecha_informe']);
	$fecha_informe='now()';
	$fecha_regresultce='now()';
	$pato=new bioPQ();
	$valida_patologo=$pato->obtpatobio($id_biopsia);

	$ores=new bioCE();
	$modificar=$ores->actualizaresultado($id_biopsia,$resultado,$valida_patologo,$fecha_informe);
	$actfecha=$ores->actualizaregres($id_biopsia,$fecha_regresultce);
	
	// if ($valida_patologo>0) {
	// 	$oest=new bioPQ();
	// 	$finalizar=$oest->actualizaest3($id_biopsia);
	// }

	$response=array();

	$response['inserted']=$modificar;

	header('Content-Type: application/json');

    echo json_encode($response);
}

function _ajaxfinalizaceAction(){
	$filter=new Inputfilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);
	$act=new bioPQ();
	$actualizado=$act->actualizaest3($id_biopsia);;
	$response=array();

	$response['inserted']=$actualizado;

	header('Content-Type: application/json');

    echo json_encode($response);
}

function _ajaxGetResultAction(){
	$filter=new Inputfilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);

	$oresult=new bioCE();
	$resultados=$oresult->getresultado($id_biopsia);

	require_once 'view/CE/ajax_resce.php';
}

function _ajaxAgregarIHAction(){
	$filter=new Inputfilter();
	$id_biopsia=$filter->process($_POST['id_biopsia']);
	$id_marc_prueba=$filter->process($_POST['id_marc_prueba']);
	$resulih=$filter->process($_POST['resulih']);

	$oreg=new bioIH();
	$actualizar=$oreg->actualizaresultado($id_marc_prueba,$resulih);

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

	require_once 'view/CE/ajax-marcadoresce.php';
}

?>