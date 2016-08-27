<?php
require 'model/clases/pendientes.php';
$perfil_usr = $_SESSION['idperfil_anat'];
$user=$_SESSION['idusuario'];
$tacos = new Pendiente();
if ($perfil_usr==1 or $perfil_usr==6) {
    $nuevos=$tacos->totaltacpq();
    $otros=$tacos->totaltacce();
    $pq=$tacos->muependpq();
    $ce=$tacos->muependce();
    $ccv=$tacos->muependccv();
    $ih=$tacos->muependih();
} else {
    $nuevos=$tacos->totaltacpq();
    $otros=$tacos->totaltacce();
    $pq=$tacos->emppq($user);
    $ce=$tacos->empce($user);
    $ccv=$tacos->empccv($user);
    $ih=$tacos->empih($user);
}

?>

<div class="navbar">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a href="index.php" class="brand">
                        <small>
                            
                            <img src="assets/img/microscopio.png" style="height:24px;">
                              <span class="white"><strong>SISTEMA DE GESTION DE BIOPSIAS</strong></span>
                              <!-- <span class="white">Application</span> -->
                        </small>

                    </a><!--/.LOGO-->

                    <ul class="nav ace-nav pull-right">
                    <?php if($perfil_usr==1 or $perfil_usr==6 or $perfil_usr==5):?>
                        <li class="purple" data-position="bottom" data-intro="Alertas de Tacos Pendientes" data-step="3">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="fa fa-tag icon-animated-bell"></i>
                                <span class="badge badge-import"><?php echo count($nuevos)+count($otros) ;?></span>
                            </a>
                            <ul class="pull-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-closer">
                                <li class="nav-header">
                                    <i class="icon-warning-sign"></i><?php echo count($nuevos)+count($otros)." "."Tacos Pendientes"; ?>
                                </li>
                                <li>
                                    <a href="index.php?page=biopsia&accion=tacpen1">
                                        <div class="clearfix">
                                            <span class="pull-left" style="color:black;">
                                                <i class="btn btn-mini no-hover btn-success fa fa-tag "></i>
                                                Patologia Quirurgica
                                            </span>
                                            <span class="pull-right badge badge-success"><?php echo "".count($nuevos)?></span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="index.php?page=biopsia&accion=tacpen2">
                                        <div class="clearfix">
                                            <span class="pull-left" style="color:black;">
                                                <i class="btn btn-mini no-hover btn-warning fa fa-tag "></i>
                                                Citologia Especial
                                            </span>
                                            <span class="pull-right badge badge-warning"><?php echo "".count($otros)?></span>
                                        </div>
                                    </a>
                                </li>
                               
                            </ul>

                        </li>
                    <?php endif?>
                    <?php if($perfil_usr==1 or $perfil_usr==6 or $perfil_usr==3): ?>
                        <li class="green" data-position="bottom" data-intro="Alertas de Muestras Pendientes" data-step="4">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                              <i class="icon-tasks icon-animated-bell"></i>
                              <span class="badge badge-important"><?php echo count($pq)+count($ce)+count($ccv)+count($ih) ;?></span>
                            </a>
                            <ul class="pull-right dropdown-navbar navbar-green dropdown-menu dropdown-caret dropdown-closer">
                                <li class="nav-header">
                                   <i class="icon-warning-sign"></i><?php echo count($pq)+count($ce)+count($ccv)+count($ih)." "."Muestras Pendientes"; ?> 
                                </li>
                                <li>
                                    <a href="index.php?page=biopsia&accion=muespen">
                                        <div class="clearfix">
                                            <span class="pull-left" style="color:black;">
                                                <i class="btn btn-mini no-hover btn-success fa fa-list-alt"></i>
                                                Patologia Quirurgica
                                            </span>
                                            <span class="pull-right badge badge-success"><?php echo "".count($pq)?></span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                   <a href="index.php?page=biopsia&accion=muepend1">
                                        <div class="clearfix">
                                            <span class="pull-left" style="color:black;">
                                                <i class="btn btn-mini no-hover btn-warning fa fa-list-alt"></i>
                                                Citologia Especial
                                            </span>
                                            <span class="pull-right badge badge-warning"><?php echo "".count($ce)?></span>
                                        </div>
                                    </a> 
                                </li>
                                <li>
                                  <a href="index.php?page=biopsia&accion=muepend2">
                                        <div class="clearfix">
                                            <span class="pull-left" style="color:black;">
                                                <i class="btn btn-mini no-hover btn-pink fa fa-list-alt"></i>
                                                Citologia Cervico Vaginal
                                            </span>
                                            <span class="pull-right badge badge-pink"><?php echo "".count($ccv)?></span>
                                        </div>
                                  </a>
                                </li>
                                <li>
                                    <a href="index.php?page=biopsia&accion=muepend3">
                                        <div class="clearfix">
                                            <span class="pull-left" style="color:black;">
                                                <i class="btn btn-mini no-hover btn-inverse fa fa-list-alt"></i>
                                                Inmunohistoquimica
                                            </span>
                                            <span class="pull-right badge badge-info"><?php echo "".count($ih)?></span>
                                        </div>
                                  </a>
                                </li>
                            </ul>
                        </li>
                        <?php endif ?>
                        <li class="light-blue" data-position="left" data-intro="Informacion del Usuario" data-step="5">
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                               <img class="nav-user-photo" src="assets/avatars/user.jpg" alt="Jason's Photo">
                                <span class="user-info">
                                    <small>Bienvenido,</small>
                                    <?php echo $_SESSION['usuario'] ?> 
                                </span>

                                <i class="icon-caret-down"></i>
                            </a>

                            <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
                                <li>
                                    <a href="index.php?page=usuarios&accion=cambioclave">
                                        <i class="icon-cog"></i>
                                        Cambio Clave
                                    </a>
                                </li>
                                <!--    
                                <li>
                                    <a href="#">
                                        <i class="icon-user"></i>
                                        Mi Perfil
                                    </a>
                                </li>
                                -->
                                <li class="divider"></li>

                                <li>
                                    <a href="index.php?page=login&accion=cerrar">
                                        <i class="icon-off"></i>
                                        Salir
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul><!--/.ace-nav-->
                </div><!--/.container-fluid-->
            </div><!--/.navbar-inner-->
  </div>
