<?php

session_start();

require 'model/clases/usuariosant.php';
require 'model/clases/bitacora.php';
require_once 'class.inputfilter.php';

//include 'controller/validar-sesion.php';

function _formAction(){
    
    require 'login.php';
}



function _loginAction() {
    $filter = new InputFilter();

    $user = $filter->process($_POST["user"]);
    $pass = $filter->process($_POST["pass"]);

     $host=$_SERVER['REMOTE_ADDR'];
     $hostname=gethostbyaddr($host);
     
    $usuario = new UsuarioAnat();
    $validar = $usuario->validarID($user, base64_encode($pass));

    if ($validar) {

         foreach ($validar as $usuario) {

                $_SESSION['usuario'] = $usuario->nom_usuario; // Guarda nombre de usuario
                $_SESSION['idusuario'] = $usuario->id_usuario; // Guarda nombre de usuario
                $_SESSION['idperfil_anat'] = $usuario->id_perfil ;
                $_SESSION['perfil'] = $usuario->descr_perfil ;
                $nuevo=$_SESSION['idusuario'];
                // $_SESSION['idusuario'] = $usuario->codUsu;
                // $_SESSION['apeUsu']  = $usuario->apellidos;
                // $_SESSION['nomUsu'] = $usuario->nombres ;
                // $_SESSION['codTipEmp'] = $usuario->codTipEmp ;
                
             }
        $bit = new bitacora();
        $bit->setUsr_id($nuevo);
        $bit->setHost($host);
        $bit->setHostname($hostname);
        $bit->insertaconexion();
        
        header("location: index.php");
    } else {
        header("location: index.php?page=login&accion=form");
    }
}

function _cerrarAction() {
    if (isset($_SESSION['usuario'])) {
        $fecha='now()';
        $nue=new Bitacora();
        $registro=$nue->busqueda($_SESSION['usuario']);
        $bit=new Bitacora();
        $bit->SetRegistro($registro);
        $bit->modificarconexion();
        unset($_SESSION['usuario']); // Elimina usuario
        unset($_SESSION['idperfil_anat']); // Elimina idusuario
        unset($_SESSION['modusuario']); // Elimina modo

        header("location: index.php?page=login&accion=form");
        die;
    }
}

?>