<?php 
if (!isset($_GET['archivo']) || empty($_GET['archivo'])) {
   exit();
}
$archivo = basename($_GET['archivo']);
header('Content-type: application/pdf');
header('Content-Disposition: inline; filename="'.$archivo.'"');
//readfile($mi_pdf);
readfile($archivo);
?>