<?php
require_once 'controller/class.inputfilter.php';
require_once 'model/clases/paciente.php';
require_once 'model/clases/ubigeo.php';
require_once 'model/clases/tipo_paciente.php';
require_once 'model/clases/departamentos.php';
require_once 'model/clases/area.php';
require_once 'model/clases/biopsia.php';
require_once 'model/clases/bioPQ.php';
require_once 'model/clases/empleado.php';
require_once 'model/clases/dependencias.php';
require_once 'model/clases/topografia.php';
require_once 'model/clases/institucion.php';
require_once 'model/clases/marcador.php';
require_once 'model/clases/bitacora.php';
require_once 'model/clases/biopsia-detalle.php';
require_once 'model/clases/muestra-remitida.php';
require_once 'model/clases/usuariosant.php';
include 'controller/validar-sesion.php';

function _listarAction() {

    $paciente = new Paciente();
    $pacientes = $paciente->listadopaciente();
    
    
    require 'view/biopsia/biopsia-registro.php';
}

function _historiaAction(){
    require 'view/biopsia/historial-form.php';
}

function _muestraavisoAction(){
    $perfiles=$_SESSION['idperfil_anat'];
    $user=$_SESSION['idusuario'];
    $bio=new Biopsia();
    if ($perfiles==1) {
        $bios=$bio->biopqporserpendiente();
        $bioscv=$bio->bioceporserpendiente();
        $biosccv=$bio->bioccvporserpendiente();
        $biosih=$bio->bioihposerpendiente();
    } else {
        $bios=$bio->bioxemppqspend($user);
        $bioscv=$bio->bioxempcespend($user);
        $biosccv=$bio->bioxempccvspend($user);
        $biosih=$bio->bioxempihspend($user);
    }
    
    
    
    require 'view/alertas/muestras-aviso.php';
}

function _muestracriticaAction(){
    $per_user=$_SESSION['idperfil_anat'];
    $nameuser=$_SESSION['idusuario'];
    $mcritica=new biopsia();

    if ($per_user==1 or $per_user==6) {
        $biosm=$mcritica->alertaparaadmin();
    }elseif ($per_user==3) {
        $biosm=$mcritica->alertapat($nameuser);
    }elseif ($per_user==5) {
        $biosm=$mcritica->alertaparatec($nameuser);
    }
    require 'view/alertas/muestras-criticas.php';
}


function _muespenAction(){
    $empleado = new UsuarioAnat();
    $empleados = $empleado->usr_emp($_SESSION['idusuario']);
    $bio = new biopsia();
    if ($_SESSION['idperfil_anat']==1 or $_SESSION['idperfil_anat']==6) {
        $bios = $bio->biopendpq();
    } else {
        $bios=$bio->biopqxemp($empleados);
    }
    $tema="background: linear-gradient(rgb(195,214,155), white);";   
    require 'view/muestras-pendientes.php';
}

function _muepend1Action(){
    $empleado = new UsuarioAnat();
    $empleados = $empleado->usr_emp($_SESSION['idusuario']);
    $bio = new biopsia();
    if ($_SESSION['idperfil_anat']==1 or $_SESSION['idperfil_anat']==6) {
        $bios = $bio->biopendce();
    } else {
        $bios =$bio->biocexemp($empleados);
    }
    $tema="background: linear-gradient(orange, white);";
    require 'view/muestras-pendientes.php';
}
function _muepend2Action(){
    $empleado = new UsuarioAnat();
    $empleados = $empleado->usr_emp($_SESSION['idusuario']);
    $bio = new biopsia();
    if ($_SESSION['idperfil_anat']==1 or $_SESSION['idperfil_anat']==6) {
        $bios = $bio->biopendccv();
    } else {
        $bios=$bio->bioccvxemp($empleados);
    }
    
    $tema="background: linear-gradient(rgb(207,122,120), white);";
    require 'view/muestras-pendientes.php'; 
}
function _muepend3Action(){
    $empleado = new UsuarioAnat();
    $empleados = $empleado->usr_emp($_SESSION['idusuario']);
    $bio = new biopsia();
    if ($_SESSION['idperfil_anat']==1 or $_SESSION['idperfil_anat']==6) {
         $bios = $bio->biopendih(); 
    } else {
        $bios = $bio->bioihporemp($empleados);
    }
   
    $tema="background: linear-gradient(rgb(190,123,69), white);";
    require 'view/muestras-pendientes.php';
}

function _tacpen1Action(){
    $empleado = new UsuarioAnat();
    $empleados = $empleado->usr_emp($_SESSION['idusuario']);
    $bio=new Biopsia();
    if ($_SESSION['idperfil_anat']==1 or $_SESSION['idperfil_anat']==6 or $_SESSION['idperfil_anat']==5) {
       $bios=$bio->tacpendpq(); 
    } 
    
    $tema="background: linear-gradient(rgb(195,214,155), white);";    
    require 'view/tacos-pendientes.php';    
}

function _tacpen2Action(){
    $empleado = new UsuarioAnat();
    $empleados = $empleado->usr_emp($_SESSION['idusuario']);
    $bio=new Biopsia();
    if ($_SESSION['idperfil_anat']==1 or $_SESSION['idperfil_anat']==6 or $_SESSION['idperfil_anat']==5) {
        $bios=$bio->tacpendce();
    } 
    $tema="background: linear-gradient(orange, white);";
    require 'view/tacos-pendientes.php';
}

function _ajaxGetTopoAction(){
   
    $area = $_POST['area'];
    $top = new Topografia();
    $pxdep = $top->topxarea($area);

    if (count($pxdep)): ?>
        <option value="">Seleccione una Topografia</option>
        <?php foreach ($pxdep as $pdep): ?>
            <option value="<?php echo $pdep->id_top?>">
                <?php echo $pdep->descr_top; ?>
            </option>
        <?php endforeach; ?>
    <?php else : ?>
        <? echo '<option value=-1> No existen registros </option>'; ?>
    <?php endif; ?>
<?php } ?>
<?php

function _formAction(){
  
    $area = new Area();
	$areas =$area->listararea();
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
    $biom=$biop->listamuestra();
    $codigos=new Biopsia();
   
	require 'view/biopsia/biopsia-form.php';
}

function _editarAction(){
    $id = $_GET['id'];
    $paciente = new Paciente($id);
    $paciente->obtener_pacientexid();
    $area=new Area();
    $areas=$area->listararea();
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
    $biom=$biop->listamuestra();
    $codigos=new Biopsia();
    
    require 'view/biopsia/biopsia-form.php';
}

function _cargarmueAction(){
    $area = $_POST['area'];
    
    $lista = new Muestra();
    // carga el select de las muestras
       $muestras = $lista->muestrasxarea($area);
     
    
    if($muestras){
       $html .= '<option value="">Seleccione Muestra</option>';
        foreach ($muestras as $muestra) {
             
            $html .= "<option value=".$muestra->id_muestra.">".$muestra->descr_muestra ."</option>";
        }
        echo $html;
    }else{
        $html .= '<option value=-1>No existen registros</option>';
        echo $html;
    }
}

function _cargartopogAction(){
    $area = $_POST['area'];
    
    $lista = new Topografia();
    // carga el select de las muestras
       $topos = $lista->topxarea($area);
     
    
    if($topos){
       $html .= '<option value="">Seleccione Topografia</option>';
        foreach ($topos as $muestra) {
             
            $html .= "<option value=".$muestra->id_top.">".$muestra->descr_top ."</option>";
        }
        echo $html;
    }else{
        $html .= '<option value=-1>No existen registros</option>';
        echo $html;
    }
}

function _modificarpqAction(){
    $filter = new InputFilter();
    $instituto = $_POST["institucion"];
    $dep = $filter->process($_POST["servicio"]);
    $med1=$filter->process($_POST["medicotr"]);
    $med2=$filter->process($_POST["medicot"]);
    $med3=$filter->process($_POST["medicoop"]);
    $fecha = $filter->process($_POST["fecha_bio"]);
    $fechaing = $filter->process($_POST["fecha_ingreso"]);
    $tipoestudio=$filter->process($_POST["tipo"]);
    $top = $filter->process($_POST["topografia"]);
    $biocong=$filter->process($_POST["optionsRadio"]);
    $tecnologo=$filter->process($_POST["tecnologo"]);
    $pato = $filter->process($_POST["patologo"]);
    $diagc=$filter->process($_POST["diagnosticoc"]);
    $obs=$filter->process($_POST["observacion"]);
    $pago = $filter->process($_POST["pago"]);
    $usr = $_SESSION['idusuario'];
    $fechareg='now()';

    for ($i=1; $i <21 ; $i++) { 
        $desmues[$i]=$_POST['desmues'.$i];
        $mues[$i]=$_POST['mues'.$i];
    }

    if ($tecnologo=='') {
        $tecnologo=null;
    }

    if ($instituto==29) {
        $medico=$med2;
    } else {
        $medico=$med1;
    }
   
    try {
        if (!empty($_GET["id"])) {
            
            $id = $filter->process($_GET["id"]);
            $biopsiapq = new bioPQ();
            $biopsiapq->setIdBio($id);
            $biopsiapq->setidinst($instituto);
            $biopsiapq->setdepid($dep);
            $biopsiapq->setMedicoT($medico);
            $biopsiapq->setFecha($fecha);
            $biopsiapq->settopg($top);
            $biopsiapq->setBioC($biocong);
            $biopsiapq->settipoest($tipoestudio);
            $biopsiapq->setidproc($tecnologo);
            $biopsiapq->setPatog($pato);
            $biopsiapq->setDiagClinico($diagc);
            $biopsiapq->setObs($obs);
            $biopsiapq->setPago($pago);
            $biopsiapq->setusrbio($usr);
            $biopsiapq->setfechabio($fechareg);
            $biopsiapq->setmedopc($med3);
            $biopsiapq->modificarbio();

            $obtm=new Muestra();
            $idb=$obtm->obtenermuestras($id); 
            foreach ($idb as $key) {
                    $muestras[]=$key->id_muestrarem;
            }

            for ($i=1; $i <21 ; $i++) { 
                
                if ($desmues[$i]!='' and ($desmues[$i-1]!=$desmues[$i])) {
                      if ($i<=count($muestras)) {
                        $muestra = new Muestra();
                        $muestra->setMuestraBio($mues[$i]);
                        $muestra->setIdMuestra($desmues[$i]);
                        $muestra->modificar();
                      }else if ($i>count($muestras)) {
                       
                            if ($muestras[$i]!=$desmues[$i]) {
                                $muestra = new Muestra();
                                $muestra->setIdBiopsia($id);
                                $muestra->setIdMuestra($desmues[$i]);
                                $muestra->insertar();
                            }
                        
                        
                      }
                        
                   } 

      
          }
            
        } 

        header("location: index.php?page=biopsiaPQ&accion=listar");
    } catch (Exception $exc) {
        $error = urlencode($exc->getMessage());
        header("location: error.php?mssg=:$error");
        die;
    }


}

function _modificarceAction(){
    $filter = new InputFilter();
    $instituto = $_POST["institucion"];
    $dep = $filter->process($_POST["servicio"]);
    $med1=$filter->process($_POST["medicotr"]);
    $med2=$filter->process($_POST["medicot"]);
    $med3=$filter->process($_POST["medicoop"]);
    $fecha = $filter->process($_POST["fecha_bio"]);
    $fechaing = $filter->process($_POST["fecha_ingreso"]);
    $top = $filter->process($_POST["topografia"]);
    $tecnologo=$filter->process($_POST["tecnologo"]);
    $pato = $filter->process($_POST["patologo"]);
    $diagc=$filter->process($_POST["diagnosticoc"]);
    $obs=$filter->process($_POST["observacion"]);
    $pago = $filter->process($_POST["pago"]);
    $usr = $_SESSION['idusuario'];
    $fechareg='now()'; 

    for ($i=1; $i <21 ; $i++) { 
        $desmues[$i]=$_POST['desmues'.$i];
        $mues[$i]=$_POST['mues'.$i];
    }

    if ($tecnologo=='') {
        $tecnologo=null;
    }

    if ($instituto==29) {
        $medico=$med2;
    } else {
        $medico=$med1;
    }

    try {
        if (!empty($_GET["id"])) {
            
            $id = $filter->process($_GET["id"]);
            $biopsiapq = new bioPQ();
            $biopsiapq->setIdBio($id);
            $biopsiapq->setidinst($instituto);
            $biopsiapq->setdepid($dep);
            $biopsiapq->setMedicoT($medico);
            $biopsiapq->setFecha($fecha);
            $biopsiapq->settopg($top);
            $biopsiapq->setidproc($tecnologo);
            $biopsiapq->setPatog($pato);
            $biopsiapq->setDiagClinico($diagc);
            $biopsiapq->setObs($obs);
            $biopsiapq->setPago($pago);
            $biopsiapq->setusrbio($usr);
            $biopsiapq->setfechabio($fechareg);
            $biopsiapq->setmedopc($med3);
            $biopsiapq->modificarbioce();

            $obtm=new Muestra();
            $idb=$obtm->obtenermuestras($id); 
            foreach ($idb as $key) {
                    $muestras[]=$key->id_muestrarem;
            }

            for ($i=1; $i <21 ; $i++) { 
                
                if ($desmues[$i]!='' and ($desmues[$i-1]!=$desmues[$i])) {
                      if ($i<=count($muestras)) {
                        $muestra = new Muestra();
                        $muestra->setMuestraBio($mues[$i]);
                        $muestra->setIdMuestra($desmues[$i]);
                        $muestra->modificar();
                      }else if ($i>count($muestras)) {
                       
                            if ($muestras[$i]!=$desmues[$i]) {
                                $muestra = new Muestra();
                                $muestra->setIdBiopsia($id);
                                $muestra->setIdMuestra($desmues[$i]);
                                $muestra->insertar();
                            }
                        
                        
                      }
                        
                   } 

      
          }
            
        } 

        header("location:index.php?page=biopsiaCE&accion=listar");
    } catch (Exception $exc) {
        $error = urlencode($exc->getMessage());
        header("location: error.php?mssg=:$error");
        die;
    }
}

function _modificarihAction(){
    $filter = new InputFilter();
    $instituto = $_POST["institucion"];
    $dep = $filter->process($_POST["servicio"]);
    $med1=$filter->process($_POST["medicotr"]);
    $med2=$filter->process($_POST["medicot"]);
    $med3=$filter->process($_POST["medicoop"]);
    $fecha = $filter->process($_POST["fecha_bio"]);
    $fechaing = $filter->process($_POST["fecha_ingreso"]);
    $top = $filter->process($_POST["topografia"]);
    $tecnologo=$filter->process($_POST["tecnologo"]);
    $pato = $filter->process($_POST["patologo"]);
    $diagc=$filter->process($_POST["diagnosticoc"]);
    $obs=$filter->process($_POST["observacion"]);
    $pago = $filter->process($_POST["pago"]);
    $usr = $_SESSION['idusuario'];
    $fechareg='now()'; 

    for ($i=1; $i <21 ; $i++) { 
        $desmues[$i]=$_POST['desmues'.$i];
        $mues[$i]=$_POST['mues'.$i];
    }

    if ($tecnologo=='') {
        $tecnologo=null;
    }

    if ($instituto==29) {
        $medico=$med2;
    } else {
        $medico=$med1;
    }

    try {
        if (!empty($_GET["id"])) {
            
            $id = $filter->process($_GET["id"]);
            $biopsiaIH = new bioPQ();
            $biopsiaIH->setIdBio($id);
            $biopsiaIH->setidinst($instituto);
            $biopsiaIH->setdepid($dep);
            $biopsiaIH->setMedicoT($medico);
            $biopsiaIH->setFecha($fecha);
            $biopsiaIH->settopg($top);
            $biopsiaIH->setidproc($tecnologo);
            $biopsiaIH->setPatog($pato);
            $biopsiaIH->setDiagClinico($diagc);
            $biopsiaIH->setObs($obs);
            $biopsiaIH->setPago($pago);
            $biopsiaIH->setusrbio($usr);
            $biopsiaIH->setfechabio($fechareg);
            $biopsiaIH->setmedopc($med3);
            $biopsiaIH->modificarbioce();

            $obtm=new Muestra();
            $idb=$obtm->obtenermuestras($id); 
            foreach ($idb as $key) {
                    $muestras[]=$key->id_muestrarem;
            }

            for ($i=1; $i <21 ; $i++) { 
                
                if ($desmues[$i]!='' and ($desmues[$i-1]!=$desmues[$i])) {
                      if ($i<=count($muestras)) {
                        $muestra = new Muestra();
                        $muestra->setMuestraBio($mues[$i]);
                        $muestra->setIdMuestra($desmues[$i]);
                        $muestra->modificar();
                      }else if ($i>count($muestras)) {
                       
                            if ($muestras[$i]!=$desmues[$i]) {
                                $muestra = new Muestra();
                                $muestra->setIdBiopsia($id);
                                $muestra->setIdMuestra($desmues[$i]);
                                $muestra->insertar();
                            }
                        
                        
                      }
                        
                   } 

      
          }
            
        } 

        header("location:index.php?page=biopsiaIH&accion=listar");
    } catch (Exception $exc) {
        $error = urlencode($exc->getMessage());
        header("location: error.php?mssg=:$error");
        die;
    }
}

function _modificarccvAction(){
    $filter = new InputFilter();
    $instituto = $_POST["institucion"];
    $dep = $filter->process($_POST["servicio"]);
    $med1=$filter->process($_POST["medicotr"]);
    $med2=$filter->process($_POST["medicot"]);
    $med3=$filter->process($_POST["medicoop"]);
    $fecha = $filter->process($_POST["fecha_bio"]);//fecha de biopsia pq
    $fechaing = $filter->process($_POST["fecha_ingreso"]);
    $pato = $filter->process($_POST["patologo"]);
    $diagc=$filter->process($_POST["diagnosticoc"]);
    $obs=$filter->process($_POST["observacion"]);
    $pago = $filter->process($_POST["pago"]);
    $gestant=$filter->process($_POST["gestante"]);
    $gt=$filter->process($_POST["gesta"]); 
    $par=$filter->process($_POST["para"]);
    $mc=$filter->process($_POST["mac"]); 
    $fr=$filter->process($_POST["fur"]);
    $ppa=$filter->process($_POST["pap"]);
    $mrem=$filter->process($_POST["mremitida"]); 
    $m1=$filter->process($_POST["mues1"]);
    $usr = $_SESSION['idusuario'];
    $tecnologo=$filter->process($_POST["tecnologo"]);
    $fechareg='now()'; 

    if ($tecnologo=='') {
        $tecnologo=null;
    }
    if ($gt=='') {
        $gt=null;
    }
    if ($par=='') {
        $par='';
    }
    if ($instituto==29) {
        $medico=$med2;
    } else {
        $medico=$med1;
    }

    try {
        if (!empty($_GET["id"])) {
            
            $id = $filter->process($_GET["id"]);
            $biopsiapq = new bioPQ();
            $biopsiapq->setIdBio($id);
            $biopsiapq->setidinst($instituto);
            $biopsiapq->setdepid($dep);
            $biopsiapq->setMedicoT($medico);
            $biopsiapq->setFecha($fecha);
            $biopsiapq->setidproc($tecnologo);
            $biopsiapq->setPatog($pato);
            $biopsiapq->setDiagClinico($diagc);
            $biopsiapq->setObs($obs);
            $biopsiapq->setPago($pago);
            $biopsiapq->setusrbio($usr);
            $biopsiapq->setfechabio($fechareg);
            $biopsiapq->setmedopc($med3);
            $biopsiapq->modificarbioccv();

            $detalleccv=new bioPQ();
            $detalleccv->setIdBio($id);
            $detalleccv->setgestante($gestant);
            $detalleccv->setgesta($gt);
            $detalleccv->setpara($par);
            $detalleccv->setmac($mc);
            $detalleccv->setfur($fr);
            $detalleccv->setpap($ppa);
            $detalleccv->modificardetalleccv();

            $muestra=new Muestra();
            $muestra->setMuestraBio($m1);
            $muestra->setIdMuestra($mrem);
            $muestra->modificar();

        } 

        header("location:index.php?page=biopsiaCCV&accion=listar");
    } catch (Exception $exc) {
        $error = urlencode($exc->getMessage());
        header("location: error.php?mssg=:$error");
        die;
    }
}


function _insertarAction(){
    error_reporting(0);
    session_start();
    $filter = new InputFilter();
    $dni = $filter->process($_POST["dni"]);
    $pac = new Paciente();
    $opac =$pac->obtenerpac($dni);//obtiene codigo de paciente
    $numero1 = $filter->process($_POST["numbio1"]);
    //$numero2= $filter->process($_POST["numbio2"]);
    $instituto = $_POST["institucion"];
    $dep = $filter->process($_POST["servicio"]);
    $med1=$filter->process($_POST["medicotr"]);
    $med2=$filter->process($_POST["medicot"]);
    $med3=$filter->process($_POST["medicoop"]);
    $fecha = $filter->process($_POST["fecha_bio"]);//fecha de biopsia pq
    $fecha1=$filter->process($_POST["fecha_bio2"]);//fecha de biopsia para ce,ccv,ih
    $fechaing = $filter->process($_POST["fecha_ingreso"]);
    $tipoestudio=$filter->process($_POST["tipo"]);
    $area = $filter->process($_POST["area"]);
    $top = $filter->process($_POST["topografia"]);
    $biocong=$filter->process($_POST["optionsRadio"]);
    $pato = $filter->process($_POST["patologo"]);
    $diagc=$filter->process($_POST["diagnosticoc"]);
    $obs=$filter->process($_POST["observacion"]);
    $pago = $filter->process($_POST["pago"]);
    $gestant=$filter->process($_POST["gestante"]);
    $gt=$filter->process($_POST["gesta"]); 
    $par=$filter->process($_POST["para"]);
    $mc=$filter->process($_POST["mac"]); 
    $fr=$filter->process($_POST["fur"]);
    $ppa=$filter->process($_POST["pap"]);
    $mrem=$filter->process($_POST["mremitida"]); 
    $usr = $_SESSION['idusuario'];
    $numpq=$filter->process($_POST["numbiopq"]);
    $numce=$filter->process($_POST["numbioce"]);
    $numccv=$filter->process($_POST["numbioccv"]);
    $numih=$filter->process($_POST["numbioih"]);
    $tecnologo=$filter->process($_POST["tecnologo"]);
    $nuevo=new Biopsia();
    $nuevopq=$nuevo->codpq();
    // $nuevoce=$nuevo->codce();
    $nuevoce= intval($numce);
    // $nuevoccv=$nuevo->codccv();
    $nuevoccv = intval($numccv);
    $nuevoih=$nuevo->codih();
    $nanio=$nuevo->prefijoanio();
    $anio=$nuevo->codigoanio($nanio);
    $host=$_SERVER['REMOTE_ADDR'];
    $hostname=gethostbyaddr($host);


    for ($i=1; $i <21 ; $i++) { 
        $desmues[$i]=$_POST['desmues'.$i];
    }

    if ($tecnologo=='') {
        $tecnologo=null;
    }
    if ($gt=='') {
        $gt=null;
    }
    if ($par=='') {
        $par='';
    }
    if ($instituto==29) {
        $medico=$med2;
    } else {
        $medico=$med1;
    }
    switch ($area) {
        case 1:
              $numero2=$numpq;
              $nuevos=$nuevopq;
              $nuevoanio=$anio;
            break;
        case 2:
              $numero2=$numce;
              $nuevos=$nuevoce;
              $nuevoanio=$anio;
            break;
        case 3:
             $numero2=$numccv;
             $nuevos=$nuevoccv;
             $nuevoanio=$anio;
            break;
        case 4:
            $numero2=$numih;
            $nuevos=$nuevoih;
            $nuevoanio=$anio;
        default:
            # code...
            break;
    }
    if ($area==3) {
       $nuevatop=25;
       
    } else {
       $nuevatop=$top;
       
    }
    $numero=$numero1.$numero2;
    $consultabio=new Biopsia();
    $existebio=$consultabio->consultnumbiopsia($numero,$area);

    try {
            if ($existebio==0) {
               if ($area==1) {
                $biopsia = new Biopsia();
                $biopsia->setIdInst($instituto);
                $biopsia->setIdPac($opac);
                $biopsia->setNumBio($numero);
                $biopsia->setIdDep($dep);
                $biopsia->setMedico($medico);
                $biopsia->setFecha($fecha);
                $biopsia->setFechaIng($fechaing);
                $biopsia->setIdTop($nuevatop);
                $biopsia->setBioC($biocong);
                $biopsia->setPatR($pato);
                $biopsia->setDiagInicial($diagc);
                $biopsia->setObs($obs);
                $biopsia->setPago($pago);
                $biopsia->setIdUser($usr);
                $biopsia->setEstado('1');
                $biopsia->setIdT($tipoestudio);
                $biopsia->setCodigo($nuevos);
                $biopsia->setAnio($nuevoanio);
                $biopsia->setProc($tecnologo);
                $biopsia->setMopcional($med3);
                $biopsia->insertar();

                $accion = 'INSERTAR';
                $bit=new bitacora();
                $bit->setUsr_id($usr);
                $bit->setAccion($accion);
                $bit->setTabla('BIOPSIA');
                $bit->setHost($host);
                $bit->setHostname($hostname);
                $bit->setCampo('');
                $bit->insertar();

            } else {
                $biopsia = new Biopsia();
                $biopsia->setIdInst($instituto);
                $biopsia->setIdPac($opac);
                $biopsia->setNumBio($numero);
                $biopsia->setIdDep($dep);
                $biopsia->setMedico($medico);
                $biopsia->setFecha($fecha1);
                $biopsia->setFechaIng($fechaing);
                $biopsia->setIdTop($nuevatop);
                $biopsia->setPatR($pato);
                $biopsia->setDiagInicial($diagc);
                $biopsia->setObs($obs);
                $biopsia->setPago($pago);
                $biopsia->setIdUser($usr);
                $biopsia->setEstado('1');
                $biopsia->setCodigo($nuevos);
                $biopsia->setAnio($nuevoanio);
                $biopsia->setProc($tecnologo);
                $biopsia->setMopcional($med3);
                $biopsia->insertarbio();

                $accion = 'INSERTAR';
                $bit=new bitacora();
                $bit->setUsr_id($usr);
                $bit->setAccion($accion);
                $bit->setTabla('BIOPSIA');
                $bit->setHost($host);
                $bit->setHostname($hostname);
                $bit->setCampo('');
                $bit->insertar();
            }         

            }           
            
                $biopsiasp = new Biopsia();
                $idbiopsias = $biopsiasp->consultarxpac($numero,$area);

                foreach ($idbiopsias as $biopsiasp) {
                    $new_id = $biopsiasp->id_biopsia;
                } 

                switch ($area) {
                    case 1:
                        $detallebiopq = new BiopsiaDetalle();
                        $detallebiopq->setIdBio($new_id);
                        $detallebiopq->setlamina('0');
                        $detallebiopq->settaco('0');
                        $detallebiopq->insertar2();
                        break;
                    case 2:
                        $detallebioce = new BiopsiaDetalle();
                        $detallebioce->setIdBio($new_id);
                        $detallebioce->setlamina('0');
                        $detallebioce->settaco('0');
                        $detallebioce->insertar();
                        break;
                    case 3:
                        $detallebioccv = new BiopsiaDetalle();
                        $detallebioccv->setIdBio($new_id);
                        $detallebioccv->setgestante($gestant);
                        $detallebioccv->setgesta($gt);
                        $detallebioccv->setpara($par);
                        $detallebioccv->setmac($mc);
                        $detallebioccv->setfur($fr);
                        $detallebioccv->setpap($ppa);
                        $detallebioccv->insertar1();

                        $mremit=new Muestra();
                        $mremit->setIdBiopsia($new_id);
                        $mremit->setIdMuestra($mrem);
                        $mremit->insertar();
                        break;
                    case 4:
                        $detallebioih = new BiopsiaDetalle($new_id);
                        $detallebioih->insertar3();
                        break;
                    default:
                        # code...
                        break;
                }
             
                for ($i=1; $i <21 ; $i++) { 
                   if ($desmues[$i]!="" and ($desmues[$i-1]!=$desmues[$i])) {
                        $muestra = new Muestra();
                        $muestra->setIdBiopsia($new_id);
                        $muestra->setIdMuestra($desmues[$i]);
                        $muestra->insertar();
                   } 
      
                }

                    
  
        //}

        header("location: index.php?page=paciente&accion=form2");
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
        // $error = urlencode($exc->getMessage());
        // header("location: error.php?mssg=:$error");
        // die;
    }


}

// function _buscarNumAction(){
    
   
//     $num_biopsia= $_POST["num_biopsia"];

    
//     $buscarbio=new Biopsia();
//     $busqueda=$buscarbio->consultnumbio($num_biopsia);

    
//     if ($busqueda==1) {
        
//         $html='<div id="Error">La biopsia ya existe</div>';
//         echo $html;
//     }else{
        
//         $html='<div id="Success">Disponible</div>';
//         echo $html;
//     }

// }

function _insertar2Action(){
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
        $actualizar->modificarih();
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

       header("location:index.php?page=biopsiaPQ&accion=editar&id=".$id_biopsia);
    }catch(Exception $exc){
        echo $exc->getTraceAsString();
    }
}


function _ajaxGetMedicoAction(){
	 $serv = $_POST['servicio'];
   	 $top = new Empleados();
     $pxdep = $top->muestramed($serv);

    if (count($pxdep)): ?>
        <option value="">Seleccione un Medico</option>      
        <?php foreach ($pxdep as $pdep): ?>
            <option value="<?php echo $pdep->nombre ?>" >
                <?php echo $pdep->nombre; ?>
            </option>
        <?php endforeach; ?>
    <?php else : ?>
        <? echo '<option value=-1> No existen registros </option>'; ?>
    <?php endif; ?>
<?php } ?>
<?php


?>