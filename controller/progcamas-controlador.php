<?php 

require 'model/clases/camas.php';
require 'model/clases/servicios.php';

session_start();


function _formAction(){


    require 'view/camas/form.php';

}

function _ajaxgetladoAction(){
	$idpiso = $_POST['idpiso'];
	$camas = new Camas();
	$lados = $camas->listarladoxpiso($idpiso);
	
	$html .=  '<option value="-1">- - Selecciona un lado - -</option>';
	foreach ($lados as $lado) {
		$html .=  '<option value='.$lado->idlado.'>'. $lado->ladodesc .'</option>';
	}
	echo $html;
	
	
}

function _ajaxcamasAction(){
	
	$idlado = $_POST['idlado'];
	$camas = new Camas();
	$lhabitaciones = $camas->listarhabitaciones($idlado);
	

	require 'view/camas/tablacamas.php';
}


function _ajaxgetinfocamaAction(){
	
	$idcama = $_POST['codcama'];
	$camas = new Camas();

	$ocamas = $camas->oinfocamas($idcama);

	$estadounitario = $ocamas->estado_cama;


	switch ($estadounitario) {
		case '1':
			$estadosec = 4;
			$estadoter = 4;
			break;

		case '2':
			$estadosec = 4;
			$estadoter =4;
			break;	

		case '3':
			$estadosec = 2;
			$estadoter = 2;
			break;

		case '4':
			$estadosec = 2;
			$estadoter = 3;
			break;		
		default:
			# code...
			break;
	}
	

	$estados = $camas->estadoscamas($estadounitario, $estadosec, $estadoter);
	
	$oprogcamas = $camas->oprogcama($idcama);

	$idprog = $oprogcamas->idprog_cama;

	$oprogcamasdet = $camas->oprogcamadetalle($idprog);

	$servicios = new Servicios();
	$listadoserv = $servicios->listarservicios();

	$idladoserv = $ocamas->idlado;

	switch ($idladoserv) {
		case '1':
			$idserv =10;
			break;		
		case '2':
			$idserv =11;
			break;
		case '3':
			$idserv = 8;
			break;

		case '4':
			$idserv = 9;
			break;

		
		// default:
		// 	$idserv = 1;
		// 	break;
	}

	$lespecatiende = $servicios->listarespecatiende($idserv);



	require 'view/camas/infocamas.php';
}

function _ajaxinsertprogcamasAction(){
	
	$estadocama = $_POST['idestado'];
	$idlado = $_POST['idlado'];
	$idcama = $_POST['idcama'];
	$idpaciente = $_POST['idpaciente'];
	$fecha_ingreso = $_POST['fechaingreso'];
	// $fecha_ingreso = '2015-04-08';
	$hora_ingreso = $_POST['horaingreso'];
	$idservicio = $_POST['idservicio'];
	$cie1 = $_POST['cie1'];
	$cie2 = $_POST['cie2'];
	$cie3 = $_POST['cie3'];
	$observacion = $_POST['observacion'];
	$usuarioreg = $_SESSION['idusuario'] ;
	$estadoprog = f;
	//$estadocama = 2;
	$inpespec = $_POST['inpespec'];
	$tipocie = 1;

	$response = array();

	$camas = new Camas();
	$icamas = $camas->insertarprogcama($idpaciente, $hora_ingreso, $fecha_ingreso, $idcama, $usuarioreg ,$idservicio, $estadoprog ,$observacion, $inpespec);
	$uptcama = $camas->updatecama($estadocama, $idcama); 

	$ocamainserted = $camas->ocamaisertada($idpaciente, $hora_ingreso, $fecha_ingreso, $idcama, $usuarioreg ,$idservicio, $estadoprog );
	$idprog_cama = $ocamainserted->idprog_cama;

		for ($i=1; $i <4 ; $i++) { 
			$ncie = $_POST['cie'.$i.''];
			if ($ncie != '') {

				$iprogcama_det = $camas->idetalle_camaprog($idprog_cama, $ncie, $tipocie, $usuarioreg);
			}
		}

	$response['inserted'] = true;
	$response['idlado'] = $idlado;

	header('Content-Type: application/json');
    echo json_encode($response);
}


function _ajaxupdateprogcamasAction(){$estadocama = $_POST['idestado'];
	//idprog, fechasalida, horasalida, ciesal1, ciesal2, ciesal3, observacionsalida
	$estadocama = $_POST['idestadoupt'];
	$idprog = $_POST['idprog'];
	$idlado = $_POST['idlado'];
	$idcama = $_POST['idcamaegreso'];
	$fecha_salida = $_POST['fechasalida'];
	// $fecha_ingreso = '2015-04-08';
	$hora_salida = $_POST['horasalida'];
	$idservicio = $_POST['idservicio'];
	$cie1 = $_POST['ciesal1'];
	$cie2 = $_POST['ciesal2'];
	$cie3 = $_POST['ciesal3'];
	$observacion_salida = $_POST['observacionsalida'];
	$usuarioreg = $_SESSION['idusuario'];

//scondicion, s_esptransf, ref_contra 

	$scondicion = $_POST['scondicion'];
	switch ($scondicion) {
		case '1':
			$id_destino = null;
			break;
		case '2':
			$id_destino = $_POST['s_esptransf'];
			break;
		case '3':
			$id_destino = null;
			break;		
		case '4':
			$id_destino = $_POST['ref_contra'];
			break;
		case '5':
			$id_destino = $_POST['ref_contra'];
			break;
		case '6':
			$id_destino = null;
			break;			
	}


	$response = array();
	$camas = new Camas();

	switch ($estadocama) {
		case '1':
			$estadoprog = t;
			$tipocie = 2;
			$funcionactualizar = 'actualizarprogcama';

			break;
		case '2':
			$estadoprog = f;
			$tipocie = 1;
			$funcionactualizar = 'actualizarprogcamaingreso';

			break;	
		case '3':
			$estadoprog = f;
			$tipocie = 1;
			$funcionactualizar = 'actualizarprogcamaingreso';

			break;	
		case '4':
			$estadoprog = f;
			$tipocie = 2;
			$funcionactualizar = 'actualizarprogcama';

			break;				
		default:
			# code...
			break;
	}

		//$estadoprog = t;
		//$estadocama = 1;

		// $tipocie = 2;
		// $estadoprog = t;
		// $tipocie = 2;
	$ucamas = $camas->$funcionactualizar($hora_salida, $fecha_salida, $usuarioreg ,$estadoprog ,$observacion_salida, $scondicion, $id_destino, $idprog);
	$uptcama = $camas->updatecama($estadocama, $idcama); 

	//$idprog_cama = $ocamainserted->idprog_cama;

		for ($i=1; $i <4 ; $i++) { 
			$ncie = $_POST['ciesal'.$i.''];
			if ($ncie != '') {

				$iprogcama_det = $camas->idetalle_camaprog($idprog, $ncie, $tipocie, $usuarioreg);
			}
		}

	$response['updated'] = true;
	$response['idlado'] = $idlado;

	header('Content-Type: application/json');
    echo json_encode($response);
}
