<?php
require_once 'controller/class.inputfilter.php';
require_once 'model/clases/bitacora.php';
require_once 'model/clases/biopsia.php';
require_once 'model/clases/empleado.php';
require_once 'model/clases/bioPQ.php';
require_once 'model/clases/area.php';
require_once 'model/clases/autoriza.php';
require_once 'model/clases/usuariosant.php';
require_once 'model/clases/informes.php';
include 'controller/validar-sesion.php';

function _bitacoraAction(){
	$bitacora = new bitacora();
    $bitacoras = $bitacora->consultar();
	require 'view/bitacora-registro.php';
}

function _monitoreoAction(){
    require 'view/monitoreo/mostrar-control.php';
}

function _asignarAction(){
	$listas=new Biopsia();
	$asignacion=$listas->listatecpat();
	require 'view/asignar-registro.php';
}

function _cargarempleadoAction(){
    $empleado = new Empleados();
    $empleados = $empleado->listaemppatologia();  

    if ($empleados) {
        $html  = "<div class='row-fluid'>";
        $html .= "<form class='form-horizontal'>";
        $html .= "<div class='control-group row-fluid'>";
        $html .= "<label class='control-label span2'><strong>Empleado<strong></label>";
        $html .= "<div class='controls span7'>";
        $html .= "<select required class='span6' name='empleado' >";
        $html .= '<option value="">Seleccione...</option>';
        $html .= '<option value="All">TODOS</option>';
        foreach ($empleados as $emp) {
            $html .= "<option value='" . $emp->emp_id . "'>$emp->nombre</option>";
        }
        $html .= "</select>";
        $html .= "</div>";
        $html .= "</div>";
    }else{
        $html .= "<div class='alert alert-warning'>No se encontraron registros.</div>";
    }
    echo $html;
}

function _cargaremp1Action(){
    $empleado1 = new Empleados();
    $empleados = $empleado1->listaemppatologia();  

    if ($empleados) {
        $html  = "<div class='row-fluid'>";
        $html .= "<form class='form-horizontal'>";
        $html .= "<div class='control-group row-fluid'>";
        $html .= "<label class='control-label span2'><strong>Empleado<strong></label>";
        $html .= "<div class='controls span7'>";
        $html .= "<select required class='span6' name='empleado1' >";
        $html .= '<option value="">Seleccione...</option>';
        foreach ($empleados as $emp) {
            $html .= "<option value='" . $emp->emp_id . "'>$emp->nombre</option>";
        }
        $html .= "</select>";
        $html .= "</div>";
        $html .= "</div>";
    }else{
        $html .= "<div class='alert alert-warning'>No se encontraron registros.</div>";
    }
    echo $html;
}

function _insertarAction(){
	$filter = new InputFilter();

     $emp = $filter->process($_POST["numbio"]);
     $per = $filter->process($_POST["tecnologo"]);
    
     $usr = $_SESSION['idusuario'];

     try {
        if (!empty($_GET["id"])) {
            $id = $filter->process($_GET["id"]);
            $asignar = new Biopsia();
            $asignar->setIdBio($id);
            $asignar->setTecR($per);
            $asignar->modificartec();
            $accion = 'MODIFICAR';//akaaaaaaaaaaaaaaaaaaa
            $bit = new bitacora(null,$usr,$accion,null,'BIOPSIA');//akaaaaaaaaaaaaaaa
            $bit->insertar();//akaaaaa
        } 
        header("location:index.php?page=movimiento&accion=asignar");
    } catch (Exception $exc) {
        $error = urlencode($exc->getMessage());
        header("location: error.php?mssg=:$error");
        die;
    }
}

function _mostrarmonitoreoAction(){
     $opc = $_POST["cmb02"];

     switch ($opc) {
         case 1:
                $emp = $_POST["empleado"];
                $fecha1 = $_POST["fecha1"]; 
                $fecha2 = $_POST["fecha2"];
                $fechas1 = explode("-", $fecha1);
                $fecha1_mes = $fechas1[1];
                $fecha1_anio = $fechas1[0];
                $fecha1_dia=$fechas1[2];
                $fechas2 = explode("-", $fecha2);
                $fecha2_mes = $fechas2[1];
                $fecha2_anio = $fechas2[0];
                $fecha2_dia=$fechas2[2];
                $infm=new Informes();
                if ($emp=='All') {
                    $movtotal=$infm->movimientotodos($fecha1,$fecha2);
                    require 'view/monitoreo/movimientos_detalle.php';
                } else {
                    $nombreemp=$infm->nomep($emp);
                    $movusu=$infm->movimientoxempleado($emp,$fecha1,$fecha2);
                    require 'view/monitoreo/movimientos_usuario.php';
                }
                
                
             break;
          case 2:
                $emp = $_POST["empleado1"];
                $fecha1 = $_POST["fecha1"]; 
                $fecha2 = $_POST["fecha2"];
                $fechas1 = explode("-", $fecha1);
                $fecha1_mes = $fechas1[1];
                $fecha1_anio = $fechas1[0];
                $fecha1_dia=$fechas1[2];
                $fechas2 = explode("-", $fecha2);
                $fecha2_mes = $fechas2[1];
                $fecha2_anio = $fechas2[0];
                $fecha2_dia=$fechas2[2];
                $infm=new Informes();
                $nombemp=$infm->nomep($emp);
                $totalconex=$infm->conexiones_user($emp,$fecha1,$fecha2);
                require 'view/monitoreo/conexiones_usuario.php';

             break;
          case 4:
                $emp = $_POST["empleado1"];
                $infm=new Informes();
                $nombremp=$infm->nomep($emp);
                $histperfiles=$infm->historial_perfuser($emp);
                require 'view/monitoreo/historial_perfil.php';
             break;
         default:
             # code...
             break;
     }
}

function _modificarAction(){
    $id = $_GET['id'];
    $bio = new Biopsia($id);
    $bio->obtenertec();
    $empleado = new bioPQ();
    $empleados = $empleado->listatecnologos();

    require 'view/asignar-form.php';
}

function _autorizarAction(){
    $area = new Area();
    $areas =$area->listararea();

    require 'view/autorizacion/autorizacion.php';
}

function _tablaestadoAction(){
    $area=$_POST['area'];
    $fecha=$_POST['fecha'];

    $oestado=new Biopsia();
    if ($area==3) {
        $lestados=$oestado->bioxfechar1($fecha);
    } else {
        $lestados=$oestado->bioxfechar($area,$fecha);
    }
  require 'view/autorizacion/tablaest.php';  
}

function _ajaxautorizacionAction(){
    $id_biopsia=$_POST['id_biopsia'];
    $edicion=$_POST['edicion'];
    $motivo=$_POST['motivo'];
    $descr=$_POST['descr'];
    $usr = $_SESSION['idusuario'];
    $bres=new bioPQ();
    $emptec=$bres->buscartec($id_biopsia);
    $emppat=$bres->buscarpatologo($id_biopsia);
    $bioest=$bres->obtestbio($id_biopsia);
    $ures=new UsuarioAnat();
    $utec=$ures->buscempusu($emptec);
    $upat=$ures->buscempusu($emppat);

    if ($edicion==1) {

        $aut=new Autorizacion();
        $aut->setusuautoriza($usr);
        $aut->setbiopsia($id_biopsia);
        $aut->setestudio('MACROSCOPICO');
        $aut->setusuautorizado($utec);
        $aut->setmotivo($motivo);
        $aut->setestadobio($bioest);
        $aut->setopcion($descr);
        $aut->insertaraut();

        $omac=new Autorizacion();
        $actualizado=$omac->actualizaestado1($id_biopsia);

    } else {


        $aut=new Autorizacion();
        $aut->setusuautoriza($usr);
        $aut->setbiopsia($id_biopsia);
        $aut->setestudio('MICROSCOPICO');
        $aut->setusuautorizado($upat);
        $aut->setmotivo($motivo);
        $aut->setestadobio($bioest);
        $aut->setopcion($descr);
        $aut->insertaraut();

         $omac=new Autorizacion();
        $actualizado=$omac->actualizaestado2($id_biopsia);

    }
    
    $response=array();

    $response['inserted']=$actualizado;

    header('Content-Type: application/json');

    echo json_encode($response);

}

function _ajaxdesautorizaAction(){
    $id_biopsia1=$_POST['id_biopsia1'];
    $ediciones=$_POST['ediciones'];
    $motivodes=$_POST['motivodes']; 


    if ($ediciones==1) {
        $bt=new Autorizacion();
        $esto=$bt->obtestadoorigen($id_biopsia1,'MACROSCOPICO');
        $ida=$bt->obtidaut($id_biopsia1,'MACROSCOPICO');

        $omac=new Autorizacion();
        if ($esto>0) {
           $actualizado=$omac->actualizaestados($esto,$id_biopsia1);
        }
  
    } else {
        $bt=new Autorizacion();
        $esto=$bt->obtestadoorigen($id_biopsia1,'MICROSCOPICO');
        $ida=$bt->obtidaut($id_biopsia1,'MICROSCOPICO');

        $omac=new Autorizacion();
        if ($esto>0) {
            $actualizado=$omac->actualizaestados($esto,$id_biopsia1);
        }
   
    }

    $response=array();

    $response['inserted']=$actualizado;

    header('Content-Type: application/json');

    echo json_encode($response);    
}

?>