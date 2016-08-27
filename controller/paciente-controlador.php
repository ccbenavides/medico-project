<?php

require_once 'controller/class.inputfilter.php';
require_once 'model/clases/paciente.php';
require_once 'model/clases/ubigeo.php';
require_once 'model/clases/area.php';
require_once 'model/clases/tipo_paciente.php';
require_once 'model/clases/departamentos.php';
require_once 'model/clases/biopsia.php';
require_once 'model/clases/grupoocup.php';
require_once 'model/clases/bitacora.php';

include 'controller/validar-sesion.php';


function _paginacionAction() {
    
    $pagina = $_GET['pagina'];
    
    $objPaciente = new Paciente();
    $pacientes = $objPaciente->cargarPacientes_paginacion($pagina);

    $paciente_all = new Paciente();
    $pacientes_all = $paciente_all->cargarPacientes();
    include 'view/paciente/paciente-registro.php';
}

function _ajaxgetpacAction(){
    $filter = new Inputfilter();
    $dni=$filter->process($_POST['dni']);

    $pacientes = new Paciente();
    $paciente = $pacientes->buspac($dni);

    require_once 'view/biopsia/ajax_paciente.php';
}

function _ajaxareasAction(){

    $filter = new Inputfilter();
    $dni=$filter->process($_POST['dni']);

    $oArea = new Area();
    $oPaciente=new Paciente();

    $areas = $oArea->listararea();
    $areaspaciente = $oPaciente->buscarea($dni);

    require_once 'view/biopsia/ajax_areas.php';
}

function _ajaxbiopsiasAction(){
    $filter=new Inputfilter();
    $area_pac_id=$_POST['area_pac_id'];
    $area_dni_id=$_POST['area_dni_id'];

    $info=new Paciente();

    switch ($area_pac_id) {
        case 1:
            $infos=$info->areapq($area_dni_id);
            break;
        case 2:
            $infos=$info->areace($area_dni_id);
            break;
        case 3:
            $infos=$info->areaccv($area_dni_id);
            break;
        case 4:
            $infos=$info->areaih($area_dni_id);
            break;
        default:
            # code...
            break;
    }

    require_once 'view/biopsia/ajax_biopsias.php';
}

function _listarAction() {

    $paciente_all = new Paciente();
    $pacientes_all = $paciente_all->cargarPacientes();
    $pagina = 'paciente';
    
    require 'view/paciente/paciente-registro.php';
}

function _buscarAction() {

    $paciente_all = new Paciente();
    $pacientes_all = $paciente_all->cargarPacientes();
    $pagina = 'paciente';
    
    require 'view/paciente/paciente-listar.php';
}

function _eliminarAction() {
    $id = $_GET['id'];
    $objPaciente = new Paciente();
    try {
        $objPaciente->eliminar($id);
    } catch (Exception $exc) {
        echo "<script language='JavaScript'>console.log('No se puede eliminar');</script>";
    }
    header('location: index.php?page=paciente&accion=form');
}

function _etiquetaAction(){
    $area = new Area();
    $areas =$area->listararea();
    require 'view/biopsia/etiquetado-form.php';
}

function _cargarnumbioAction(){
        $html = "<div class='row-fluid'>";
        $html .= "<form class='form-horizontal'>";
        $html .= "<div class='control-group row-fluid'>";
        $html .= "<label class='control-label span2'>Numero de Biopsia</label>";
        $html .= "<div class='controls span6'>";
        $html .= "<input class='span3' onkeyup='this.value=this.value.toUpperCase()' maxlength='10' type='text' name='numbio' required>";
        $html .= "</div>";
        $html .= "</div>";
        echo $html;
}

function _cargarrangoAction(){
        $html = "<div class='row-fluid'>";
        $html .= "<form class='form-horizontal'>";
        $html .= "<div class='control-group row-fluid'>";
        $html .= "<label class='control-label span2'>Desde</label>";
        $html .= "<div class='controls span6'>";
        $html .= "<input class='span3' maxlength='10' onkeyup='this.value=this.value.toUpperCase()' type='text' name='numbio1' required>";
        $html .= "</div>";
        $html .= "</div>";
        $html .= "<div class='row-fluid'>";
        $html .= "<form class='form-horizontal'>";
        $html .= "<div class='control-group row-fluid'>";
        $html .= "<label class='control-label span2'>Hasta</label>";
        $html .= "<div class='controls span6'>";
        $html .= "<input class='span3' onkeyup='this.value=this.value.toUpperCase()' maxlength='10' type='text' name='numbio2' required>";
        $html .= "</div>";
        $html .= "</div>";
        echo $html;   
}

function _mostraretiquetaAction(){
    $opc = $_POST["cmbetiqueta"];

    if ($opc==1) {
        $area=$_POST["area"];
        $numero=$_POST["numbio"];
        $bio=new Biopsia();
        $busqueda1=$bio->consultnumbio($numero,$area);
        if ($busqueda1==1) {
           require 'view/biopsia/etiqueta-macro.php';
        } else {
             $html='<div id="Error">Esta biopsia no esta registrada</div>';
          echo $html;
        }
    }else if ($opc==2){
        $area=$_POST["area"];
        $numero1=$_POST["desde"];
        $numero2=$_POST["hasta"];
        $bio=new Biopsia();
        $busqueda1=$bio->consultnumbio($numero1,$area);
        $busqueda2=$bio->consultnumbio($numero2,$area);
        //$area1=$bio->codareabio(strtoupper($numero1));
        //$area2=$bio->codareabio(strtoupper($numero2));
        $cod1=$bio->codnumbio(strtoupper($numero1));
        $cod2=$bio->codnumbio(strtoupper($numero2));
        // if ($area1==$area2) {
        //     $area=$area1;
        // }else{
        //   $html='<div id="Error">Las biopsias pertenecen a diferentes areas , para imprimir tienen que ser de la misma area</div>';
        //   echo $html;
        // }
        if ($busqueda1==1 and $busqueda2==1) {
            $codigos=$bio->codcanastilla($area,$cod1,$cod2);
            require 'view/biopsia/etiqueta-canastilla.php';
        }else if ($busqueda1==1 and $busqueda2!=1) {
            $html='<div id="Error">Una de las biopsias no esta registrada</div>';
            echo $html;
        }
        
    }
}

function _mostrarnumbioAction(){
    $area=$_POST["area"];
    $nbio=new Biopsia();
    $f1=$nbio->obtmaxcodarea($area);
    $f2=$nbio->prefijoanio();
    switch ($area) {
        case 1:
            $formato=$f2.'PQ-'.$f1;
            break;
        case 2:
            $formato=$f2.'C-'.$f1;
            break;
        case 3:
            $formato=$f2.'C-'.$f1;
            break;
        case 4:
            $formato=$f2.'IH-'.$f1;
            break;
        default:
            # code...
            break;
    }
    echo $formato;
}

function _mostrarminnumbioAction(){
    $area=$_POST["area"];
    $mbio=new Biopsia();
    $f1=$mbio->obtminxcodarea($area);
    $f2=$mbio->prefijoanio();
    switch ($area) {
        case 1:
            $formato=$f2.'PQ-'.$f1;
            break;
        case 2:
            $formato=$f2.'C-'.$f1;
            break;
        case 3:
            $formato=$f2.'C-'.$f1;
            break;
        case 4:
            $formato=$f2.'IH-'.$f1;
            break;
        default:
            # code...
            break;
    }
    echo $formato;
}

function _validarDniAction() {
    $dni = $_POST['DNI'];
    $objPaciente = new Paciente();
    $objPaciente->setDni($dni);
    return $objPaciente->dni_existe();
}

function _formAction() {
   
    $ubi = new Ubigeo();
    $departamentos = $ubi->departamentos();

    $oocup = new Grupo();
    $grupos = $oocup->listadogrupos();

    $tipo = new tipo_paciente();
    $tipos = $tipo->listadotipos();
    
    if ($_POST['dnibusqueda']<>'') {
        $dnibusqueda = $_POST['dnibusqueda'];      
        $aniadir = 'add';
    }


    require 'view/paciente/paciente-form.php';
}

function _formpacAction(){
    $ubi = new Ubigeo();
    $departamentos = $ubi->departamentos();

    $oocup = new Grupo();
    $grupos = $oocup->listadogrupos();

    $tipo = new tipo_paciente();
    $tipos = $tipo->listadotipos();
    
    if ($_POST['dnibusqueda']<>'') {
        $dnibusqueda = $_POST['dnibusqueda'];      
        $aniadir = 'add';
    }


    require 'view/paciente/paciente2-form.php'; 
}

function _form2Action(){
    
    require 'view/buscarpacienteForm1.php';
}

//obtener provincias de un departamento
function _ajaxGetProvinciaAction(){

    $dep = $_POST['departamento'];
    $list = new Ubigeo();
    $pxdep = $list->provincias($dep);

    if (count($pxdep)): ?>
        <option value=-1>Selecione una Provincia</option>
         <?php foreach ($pxdep as $pdep): ?>
            <option value="<?php echo $pdep->provincia ?>">
                <?php echo $pdep->provincia; ?>
            </option>
        <?php endforeach; ?>
    <?php else : ?>
        <? echo '<option value=-1> No existen registros </option>'; ?>
    <?php endif; ?>
<?php } ?>
<?php

function _modificarAction() {
    $id = $_GET['id'];
    $paciente = new Paciente($id);
    $paciente->obtener_pacientexid();
    $oocup = new Grupo();
    $grupos = $oocup->listadogrupos();
    $tipo = new tipo_paciente();
    $tipos = $tipo->listadotipos();
    $ubigeo = new Ubigeo();
        
    $departamentos = $ubigeo->departamentos();
 
    if ($paciente->getId_ubigeo() == !""):
        $ubigeo = new Ubigeo();
        
        $departamentos = $ubigeo->departamentos();

        $ubigeo->setId($paciente->getId_ubigeo());
        $u = $ubigeo->obtenerUbigeo();


    endif;
    require 'view/paciente/paciente-form.php';
}

function _mostrarAction(){
    $id = $_GET['id'];
    if (!empty($_GET["id"])) {
      $paciente = new Paciente($id);
      $paciente->obtener_pacientexid();  
    }   
    
}

//obtener distritos de una provincia
function _ajaxGetDistritoAction(){
   
    $dep = $_POST['provincia'];
    $listd = new Ubigeo();
    $dxprov = $listd->distritos($dep);

    if (count($dxprov)): ?>
         <?php foreach ($dxprov as $dprov): ?>
            <option value="<?php echo $dprov->distrito ?>">
                <?php echo $dprov->distrito; ?>
            </option>
        <?php endforeach; ?>
    <?php else : ?>
        <? echo '<option value=-1> No existen registros </option>'; ?>
    <?php endif; ?>
<?php } ?>
<?php

function _changeUbAction() {

    $tipo = $_GET['tipo'];

    $ubigeo = new Ubigeo();

    if ($tipo == "provincia") {
        $departamento = $_GET['departamento'];
        $p = $ubigeo->provincias($departamento);

        if (count($p)):
            echo '<option value="">Seleccione una Opcion</option>';
            foreach ($p as $ubigeo):
                echo "<option value='" . $ubigeo->provincia . "'>" . ($ubigeo->provincia) . "</option>";
            endforeach;
        endif;
    }elseif ($tipo == "distrito") {
        $provincia = $_GET['provincia'];
        $d = $ubigeo->distritos($provincia);

        if (count($d)) {
            echo '<option value="">Seleccione una Opcion</option>';
            foreach ($d as $ubigeo):

                echo "<option>" . ($ubigeo->distrito) . "</option>";
            endforeach;
        }
    }
}

function _insertarAction() {
    
    session_start();

    $filter = new InputFilter();

    $nombre = $filter->process($_POST["nombres"]);
    $a_paterno = $filter->process($_POST["appaterno"]);
    $a_materno = $filter->process($_POST["apmaterno"]);
    $sexo = $filter->process($_POST["optionsRadio"]);
    $dni = $filter->process($_POST["dni"]);
    $direccion = $filter->process($_POST["direccion"]);
    $fecha_nacimiento = $filter->process($_POST["fecha_nacimiento"]);
    $dep = $filter->process($_POST["departamento"]);
    $prov = $filter->process($_POST["provincia"]);
    $dist = $filter->process($_POST["distrito"]);
    $ocu = $filter->process($_POST["grupo"]);
    $tipo_seguro = $filter->process($_POST["tipo"]);
    $shrl=$filter->process($_POST["sishrl"]);
    $edad=$filter->process($_POST["edad"]);
    $codigos=$filter->process($_POST["codigosis"]);
    $fecha = 'now()';
    $user=$_SESSION['idusuario'];
    $host=$_SERVER['REMOTE_ADDR'];
    $hostname=gethostbyaddr($host);

    $obj_ubigeo = new Ubigeo();
    $buscar = $obj_ubigeo->buscarUbigeoId($dep, $prov, $dist);
    $id_ubigeo = $buscar->getId();

    if ($fecha_nacimiento=='') {
        $fecha_nacimiento=null;
    }
    if ($ocu=='') {
         $ocu=null;
    }

    try {
        if (!empty($_GET["id"])) {
            $id = $filter->process($_GET["id"]);
            $paciente = new Paciente();
            $paciente->setIdPaciente($id);
            $paciente->setHora_fecha_atencion($fecha);
            $paciente->setDni($dni);
            $paciente->setA_paterno(strtoupper($a_paterno));
            $paciente->setA_materno(strtoupper($a_materno));
            $paciente->setNombre(strtoupper($nombre));
            $paciente->setSexo($sexo);
            $paciente->setFecha_nacimiento($fecha_nacimiento);
            $paciente->setId_ubigeo($id_ubigeo);
            $paciente->setDireccion($direccion);
            $paciente->setId_tipo_paciente($tipo_seguro);
            $paciente->setGoc_id($ocu);
            $paciente->setsishrl_paciente($shrl);
            $paciente->setEdad($edad);
            $paciente->setcodigosis($codigos);
            $paciente->modificar();
            $accion = 'MODIFICAR';
            $bit=new bitacora();
            $bit->setUsr_id($user);
            $bit->setAccion($accion);
            $bit->setTabla('PACIENTE');
            $bit->setHost($host);
            $bit->setHostname($hostname);
            $bit->setCampo('');
            $bit->insertar();
        } else {
            $paciente = new Paciente();
            $paciente->setHora_fecha_atencion($fecha);
            $paciente->setDni($dni);
            $paciente->setA_paterno(strtoupper($a_paterno));
            $paciente->setA_materno(strtoupper($a_materno));
            $paciente->setNombre(strtoupper($nombre));
            $paciente->setSexo($sexo);
            $paciente->setFecha_nacimiento($fecha_nacimiento);
            $paciente->setId_ubigeo($id_ubigeo);
            $paciente->setDireccion($direccion);
            $paciente->setId_tipo_paciente($tipo_seguro);
            $paciente->setGoc_id($ocu);
            $paciente->setsishrl_paciente($shrl);
            $paciente->setEdad($edad);
            $paciente->setcodigosis($codigos);
            $paciente->insertar();
            $accion = 'INSERTAR';
            $bit=new bitacora();
            $bit->setUsr_id($user);
            $bit->setAccion($accion);
            $bit->setTabla('PACIENTE');
            $bit->setHost($host);
            $bit->setHostname($hostname);
            $bit->setCampo('');
            $bit->insertar();
        }

        header("location: index.php?page=paciente&accion=listar");
    } catch (Exception $exc) {
        $error = urlencode($exc->getMessage());
        header("location: error.php?mssg=:$error");
        die;
    }

   
}

function _insertarpacAction(){
    session_start();

    $filter = new InputFilter();

    $nombre = $filter->process($_POST["nombres"]);
    $a_paterno = $filter->process($_POST["appaterno"]);
    $a_materno = $filter->process($_POST["apmaterno"]);
    $sexo = $filter->process($_POST["optionsRadio"]);
    $dni = $filter->process($_POST["dni"]);
    $direccion = $filter->process($_POST["direccion"]);
    $fecha_nacimiento = $filter->process($_POST["fecha_nacimiento"]);
    $dep = $filter->process($_POST["departamento"]);
    $prov = $filter->process($_POST["provincia"]);
    $dist = $filter->process($_POST["distrito"]);
    $ocu = $filter->process($_POST["grupo"]);
    $tipo_seguro = $filter->process($_POST["tipo"]);
    $shrl=$filter->process($_POST["sishrl"]);
    $edad=$filter->process($_POST["edad"]);
    $codigos=$filter->process($_POST["codigosis"]);
    $fecha = 'now()';
    $user=$_SESSION['idusuario'];
    $host=$_SERVER['REMOTE_ADDR'];
    $hostname=gethostbyaddr($host);

    $obj_ubigeo = new Ubigeo();
    $buscar = $obj_ubigeo->buscarUbigeoId($dep, $prov, $dist);
    $id_ubigeo = $buscar->getId();

    if ($fecha_nacimiento=='') {
        $fecha_nacimiento=null;
    }
    if ($ocu=='') {
         $ocu=null;
    }

    $paciente = new Paciente();


    $paciente_previo=$paciente->cargar_busqueda_dni(strtoupper($dni));


    if ($paciente_previo) {

        $codigo=$paciente_previo[0]->id_paciente;
        header("location: index.php?page=biopsia&accion=editar&id=".$codigo);
        // echo $codigo;
    } else {

        try {
                
                $paciente->setHora_fecha_atencion($fecha);
                $paciente->setDni($dni);
                $paciente->setA_paterno(strtoupper($a_paterno));
                $paciente->setA_materno(strtoupper($a_materno));
                $paciente->setNombre(strtoupper($nombre));
                $paciente->setSexo($sexo);
                $paciente->setFecha_nacimiento($fecha_nacimiento);
                $paciente->setId_ubigeo($id_ubigeo);
                $paciente->setDireccion($direccion);
                $paciente->setId_tipo_paciente($tipo_seguro);
                $paciente->setGoc_id($ocu);
                $paciente->setsishrl_paciente($shrl);
                $paciente->setEdad($edad);
                $paciente->setcodigosis($codigos);
                $paciente->insertar();
                $accion = 'INSERTAR';
                $bit=new bitacora();
                $bit->setUsr_id($user);
                $bit->setAccion($accion);
                $bit->setTabla('PACIENTE');
                $bit->setHost($host);
                $bit->setHostname($hostname);
                $bit->setCampo('');
                $bit->insertar();

                $nuevop=new Paciente();
                $idnuevop=$nuevop->busquedapac($dni);

                foreach ($idnuevop as $nuevop) {
                        $new_p=$nuevop->id_paciente;
                        
                }
                $codigo=$new_p;

           header("location: index.php?page=biopsia&accion=editar&id=".$codigo);
        } catch (Exception $exc) {
            $error = urlencode($exc->getMessage());
            header("location: error.php?mssg=:$error");
            die;
        }
    }
}


function _ajaxGetEstadoAction(){

    $est = $_POST['tipo'];    

    $oest = new tipo_paciente();

    $estados = $oest->listarestado($est);

    if (count($estados)): ?>
        <option value=-1>Selecione</option>
        <?php foreach ($estados as $esta): ?>
            <option value="<?php echo $esta->estado ?>">
                <?php echo $esta->estado; ?>
            </option>
        <?php endforeach; ?>
    <?php else : ?>
        <? echo '<option value=-1> No existen registros </option>'; ?>
    <?php endif; ?>
<?php } ?>
<?php


function _ajaxgetpacienteAction(){
    $despaciente = strtoupper($_POST['paciente']);
    $newdespac = '%'.$despaciente.'%';
    $Paciente = new Paciente();
    $listadopaciente = $Paciente->listarpacientexdesc($newdespac);

    $response = array();

    $response = $listadopaciente;

    header('Content-Type: application/json');
    echo json_encode($response);
}



// function _buscarxdnipacAction(){
 
//     $dni= $_POST["dni"];

    
//     $buscarpac=new Paciente();
//     $busqueda=$buscarpac->consultpacidni($dni);

    
//     if ($busqueda==1) {
        
//         $html='<div id="Error">DNI ya existe</div>';
//         echo $html;
//     }else{
        
//         $html='<div id="Success">DNI no registrado</div>';
//         echo $html;
//     }

// }

function _buscarxdnipacAction(){
 
    $dni= $_POST["dni"];

    
    $buscarpac=new Paciente();
    $busqueda=$buscarpac->consultpacidni($dni);

    
    $response = array();

    if ($busqueda==1) {
        
        $response['msj']='<div id="Error"><span class="label label-important arrowed" >DNI ya existe</span></div>';
        $response['exist'] = true;
        // echo $html;
    }else{
        
        $response['msj']='<div id="Success"><span class="label label-success arrowed" >DNI no registrado</span></div>';
        $response['exist'] = false;
        // echo $html;
    }


    header('Content-Type: application/json');
    echo json_encode($response);


}

function _reniecwsAction(){
 
    $dni= $_POST["dni"];

    require_once 'assets/nusoap/lib/nusoap.php';
        

    $client = new nusoap_client("http://wsminsa.minsa.gob.pe/WSRENIEC_DNI/SerDNI.asmx?wsdl", 'wsdl');

    // $resultado = $client->call("GetReniec", array('ZIP' => ''.$dni.'' ));

    $resultado = $client->call("GetReniec", array('strDNIAuto' => "", 'strDNICon' => ''.$dni.'' ));

    // print_r($resultado);


    $response = array();
    $pais = utf8_encode($resultado['GetReniecResult']['string']['11']);
    $existe = $resultado['GetReniecResult']['string']['0'];

    if ($existe == '0000') {
        $response['existe'] = true;

    $response['apepa'] = utf8_encode($resultado['GetReniecResult']['string']['1']);
    $response['apema'] = utf8_encode($resultado['GetReniecResult']['string']['2']);
    $response['nombres'] = utf8_encode($resultado['GetReniecResult']['string']['3']);
    $fechanac = $resultado['GetReniecResult']['string']['18'];

    $anionac =  substr($fechanac, 0, -4);
    $mesnac =  substr($fechanac, 4, -2);
    $dianac =  substr($fechanac, -2);

    // $response['fechanac'] = "2014-02-08";
    $response['fechanac'] = "".$anionac.'-'.$mesnac.'-'.$dianac."";

    $fecha = time() - strtotime($response['fechanac']);
    $response['edad'] = floor((($fecha / 3600) / 24) / 360);
    $response['sexo'] = $resultado['GetReniecResult']['string']['17'];
    $response['direccion'] = utf8_encode($resultado['GetReniecResult']['string']['16']);
    $response['departamento'] = utf8_encode($resultado['GetReniecResult']['string']['12']);
    $response['provincia'] = utf8_encode($resultado['GetReniecResult']['string']['13']);
    $response['distrito'] = utf8_encode($resultado['GetReniecResult']['string']['14']);


    if ($pais == 'PERU') {

        $ubigeo = new Ubigeo();

        // $response['arrayprovincias'] = $ubigeo->provincias('LAMBAYEQUE');

        $provincias = $ubigeo->provincias($response['departamento']);
        if ($response['provincia'] == 'CALLAO') {
            $provincias = $ubigeo->provincias('CALLAO');
            $response['departamento'] = $response['provincia'];
        }

        foreach ($provincias as $prov) {
            $provincia[] = $prov->provincia;
        }

        $response['arrayprovincias'] = $provincia;

        $distritos = $ubigeo->distritos($response['provincia']);

        foreach ($distritos as $dist) {
            $distrito[] = $dist->distrito;
        }

        $response['arraydistritos'] = $distrito;  

    } else {
        $response['arrayprovincias'] = '';
        $response['arraydistritos'] = '';
    }
    





    } else {
        $response['existe'] = false;
        $response['msj']='<div id="Error"><span class="label label-important arrowed" >Ha ocurrido un error - Ingrese nuevamente</span></div>';
    }
    


    header('Content-Type: application/json');

    echo json_encode($response);

}


function _ajaxGetServiciosAction(){

    $depa_id = $_POST['departamento'];    

    $oDepartamento = new Departamento();

    $servicios = $oDepartamento->getServicios($depa_id);

    if (count($servicios)): ?>
        <option value=-1>Selecione un Servicio</option>
        <?php foreach ($servicios as $servicio): ?>
            <option value="<?php echo $servicio->idservicio ?>">
                <?php echo $servicio->nom_servicio; ?>
            </option>
        <?php endforeach; ?>
    <?php else : ?>
        <? echo '<option value=-1> No existen registros </option>'; ?>
    <?php endif; ?>
<?php } ?>
<?php
