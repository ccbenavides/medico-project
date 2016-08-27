<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        
        <title>Registro de Usuarios</title>
        
         
        <link rel="shortcut icon" href="assets/img/favicon.ico">

        <!--basic styles--> 
              
        <link href="assets/plugins/bootstrap/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/plugins/bootstrap/bootstrap-responsive.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/css/style.min.css" />
        <link rel="stylesheet" href="assets/css/style-responsive.min.css" />
        <link rel="stylesheet" href="assets/css/bootstrap-timepicker.css" />
        <link rel="stylesheet" href="assets/css/datepicker.css" />
        


        <!--fonts&iconos-->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
        <link rel="stylesheet" href="assets/font-awesome-4.3.0/css/font-awesome.css">
        <!--[if IE 7]>
        <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
        <![endif]-->
    
        <link rel="stylesheet" href="assets/css/font.css" />


        <link rel="shortcut icon" href="assets/img/micros.ico">
       
        
    </head>
    <body>
        <?php
        include 'barrasesion.php';
        ?>




        <div class="main-container container-fluid">
             

            
             <a class="menu-toggler" id="menu-toggler" href="#">
                <span class="menu-text"></span>
            </a>
            
            <?php
    
                    include 'nav-bar.php';
      
            ?>
            <div class="main-content">
                <div class="breadcrumbs" id="breadcrumbs">
                        <ul class="breadcrumb">
                              <li>
                                <i class="icon-wrench home-icon"></i>
                                <a href="#">Mantenimiento</a>

                                <span class="divider">
                                    <i class="icon-angle-right arrow-icon"></i>
                                </span>
                            </li>
                          
                            <li class="active">Usuario</li>
                        </ul><!--.breadcrumb-->
                        <!-- 
                        <div class="nav-search" id="nav-search">
                            <form class="form-search" />
                                <span class="input-icon">
                                    <input type="text" placeholder="Search ..." class="input-small nav-search-input" id="nav-search-input" autocomplete="off" />
                                    <i class="icon-search nav-search-icon"></i>
                                </span>
                            </form>
                        </div> --><!--#nav-search-->
                    </div>


               <div class="page-content">
                  
                      <div class="row-fluid">
                        <div class="span12">
                              
                         <h2 class="header smaller lighter blue">Registro de Usuarios</h2>



                         <div class="widget-box">
                             <div class="widget-header">
                                <h4><i class=" icon-user-md pink"></i>Datos del usuario.</h4>
                                
                             </div><!-- widget-header -->
                             <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row-fluid">
                                        <div class="space-18"></div>

                                        <form  class="form-horizontal " action="index.php?page=usuarios&accion=insertar<?php if(!empty($_GET["id"])) :?>&id=<?php echo $_GET["id"]; endif; ?>" method="POST">
                                            <div class="span10">
                                                    <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                        <label class="control-label">Empleado</label>
                                                        <div class="controls">
                                                            <select class="chosen-select span7 " name="empleado" id="empleado" required>
                                                            <?php if (count($empleados)): ?>
                                                                <option value="">Seleccione un Empleado</option>
                                                                <?php foreach ($empleados as $empleado): ?>
                                                                    <option value="<?php echo $empleado->emp_id ?>" <?php if(!empty($_GET["id"])):if($empleado->emp_id == $usuario->getEmpId()): ?> selected <?php endif; endif; ?>>
                                                                        <?php echo $empleado->nombre?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            <?php else : ?>
                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                            <?php endif; ?>
                                                        </select>         
                                                        </div>                    
                                                    </div><!-- control-group -->

                                                   <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                        <label class="control-label" >Nombre de usuario</label>
                                                       <div class="controls">
                                                            <input type="text" onkeyup="this.value=this.value.toUpperCase()" required="required" class="form-control" 
                                                               name="user" id="user" <?php if(!empty($_GET["id"])) :?> value="<?php echo $usuario->getNomUsuario(); ?>" <?php endif; ?> autocomplete="off" readonly="true">
                                                            <input type="hidden" name="identificador" id="identificador" <?php if(!empty($_GET["id"])) :?> value="<?php echo $usuario->getIdUsuario(); ?>" <?php endif; ?>>
                                                        </div>
                                                    </div><!-- control-group -->

                                                    <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                        <label class="control-label">Contraseña</label>
                                                        <div class="controls">
                                                            <input  maxlength="10" required="required" class="form-control"
                                                               name="clave" id="clave" <?php if(!empty($_GET["id"])) :?> type="password" value="<?php echo base64_decode($usuario->getClaveUsuario()); ?>" <?php else : ?> type="text" readonly="true" value="<?php echo $claves->passworaleatorio();?>" <?php endif; ?> autocomplete="off">
                                                
                                                        </div>
                                                    </div><!-- control-group -->
                                                    

                                                    <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                        <label class="control-label">Perfil de usuario</label>
                                                             <div class="controls">
                                                                          <select class="form-control " name="perfil" id="perfil" required>
                                                                            <?php if (count($operfiles)): ?>
                                                                                <option value="">Selecione un Perfil</option>
                                                                                <?php foreach ($operfiles as $operfil): ?>
                                                                                    <option value="<?php echo $operfil->id_perfil ?>" <?php if(!empty($_GET["id"])):if($operfil->id_perfil == $usuario->getIdPerfil()): ?> selected <?php endif; endif; ?>>
                                                                                        <?php echo $operfil->descr_perfil; ?>
                                                                                    </option>
                                                                                <?php endforeach; ?>
                                                                            <?php else : ?>
                                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                            <?php endif; ?>
                                                                          </select>
                                                             </div>
                                                    </div><!-- controlgroup -->
                                                    <!--
                                                    <div class="control-group" style="margin-right:20px; margin-left:20px;">
                                                                    <label class="control-label">Estado</label>
                                                                      <div class="controls form-inline">
                                                                            <label for="">
                                                                                <input name="optionsRadios" id="optionsRadios3" value="1" type="radio" style="opacity: 1" checked>
                                                                                <span class="lbl">
                                                                                    Activo
                                                                                </span>
                                                                            </label>
                                                                            <label for="">
                                                                                <input name="optionsRadios" id="optionsRadios4" value="0" type="radio" style="opacity: 1" <?php if(!empty($_GET["id"])) : if($usuario->getEstado() == 0):?> checked <?php endif; endif; ?> >
                                                                                <span class="lbl">
                                                                                    Inactivo
                                                                                </span>
                                                                            </label>
                                                                    </div>
                                                                 </div>-->
                                            </div> <!-- span10 -->
                                            <div class="space-6"></div>
                                            <div class="span12 text-center">
                                                <button type="submit" class="btn btn-primary"> <i class="fa-floppy-o icon-on-left bigger-110"></i>Guardar</button>
                                                 <a href="index.php?page=usuarios&accion=listar" class="btn btn-danger"><i class="fa-times-circle icon-on-left bigger-110"></i>Cancelar</a>
                                                
                                            </div>

                                        </form>


                                    </div><!-- row-fluid -->
                                    
                                </div><!-- widget-main -->
                                 
                             </div><!-- widget-body -->
                         </div><!-- widget-box -->
                            
            


                        </div><!-- span12 -->

                      </div><!-- row-fluid -->
                     
               </div> <!-- page-content -->


            </div><!-- main-content -->


        </div><!-- main-container -->

        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small ">
            <i class="icon-double-angle-up icon-only bigger-110"></i>
        </a>

       
       
        <script src="assets/js/jquery.min.js"></script>
        <script type="text/javascript">
            if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
        </script>
        <script src="assets/js/bootstrap.min.js"></script>

        <script src="assets/js/style-elements.min.js"></script>
        <script src="assets/js/style.min.js"></script>
        <script src="assets/js/jquery.gritter.min.js"></script>
        <script type="assets/js/bootstrap.datepicker.js"></script>
        <script src="assets/js/date-time/bootstrap-datepicker.min.js"></script>
        <script src="view/js/usuarios.js"></script>

    </body>
</html>
