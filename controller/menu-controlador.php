<?php

session_start();
/*
 * Script para validar el inicio de sesion
 * 
 */
require_once 'model/clases/usuariosant.php';
require_once 'class.inputfilter.php';
require_once 'model/clases/menunav.php';

//include 'controller/validar-sesion.php';

function _formAction(){

    $licono = new MenuNav();
    $liconos = $licono->listadoiconos();
    require 'view/menu/menu-form.php';

}

function _ajaxmenuAction(){
    
	$lmenu = new MenuNav();
	$lmenus = $lmenu->listadomenus();

    require 'view/menu/menu.php';
}

function _ajaxGetIconosAction(){
    
    $cod = $_POST['codicono'];

    $oicono = new MenuNav();
    $oiconos = $oicono->obtenericono($cod);

    //require 'view/menu/submenus.php';

    $html = '<label><i class="'.$oiconos.' fa-5x"></i></label>';
    echo $html;
}


function _ajaxGetsubmenusAction(){
    
    $cod = $_POST['codmenu'];

	$lsubmenu = new MenuNav();
	$lsubmenus = $lsubmenu->listadosubmenus($cod);

    require 'view/menu/submenus.php';
}

function _ajaxSetmenusAction(){
    
    $menunom = $_POST['menunom'];
    $link = $_POST['link'];
    $sicono = $_POST['sicono'];

	$imenu = new MenuNav();
	$imenus = $imenu->insertarmenu($menunom, $link, $sicono);


    header('Content-Type: application/json');
    echo json_encode($response);
    
}


