<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        
        <title>Registro de Empleados</title>
        
         
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


        <link rel="shortcut icon" href="assets/img/favicon.ico">
        
    
        <script src="assets/js/jquery-1.10.2.min.js"></script>
        
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
                          
                            <li class="active">Empleados</li>
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
                                <h2 class="header smaller lighter blue">Registro del Empleado</h2>
                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h4><i class=" icon-user-md pink"></i>Datos del empleado</h4>
                                        
                                    </div><!-- widget-header -->
                                    <div class="widget-body">
                                        <widget class="main">
                                            <div class="row-fluid ">
                                                <div class="space-18"></div>
                                                
                                                    <form id="registropaciente" class="form-horizontal"  action="index.php?page=empleado&accion=insertar<?php if(!empty($_GET["id"])) :?>&id=<?php echo $_GET["id"]; endif; ?>" method="POST" enctype="multipart/form-data">
                                                       <div class="span12 ">
                                                           <div class="span6">
                                                               <div class="control-group " style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">DNI</label>
                                                                    <div class="controls">
                                                                        <input type="text" maxlength="8" onkeypress="return soloNumeros(event)" required="required" class=" form-control" id="dni" name="dni" <?php if(!empty($_GET["id"])) :?> value="<?php echo $empleado->getEmp_dni(); ?>" <?php endif; ?> autocomplete="off" autofocus>
                                                                    </div>
                                                                </div>
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Nombres</label>
                                                                    
                                                                    <div class="controls">
                                                                        <input type="text" onkeypress="return soloLetras(event)" onkeyup="this.value=this.value.toUpperCase()" required="required" class=" form-control"
                                                                          id="nombres" name="nombres" <?php if(!empty($_GET["id"])) :?> value="<?php echo $empleado->getEmp_nombres(); ?>" <?php endif; ?> autocomplete="off">
                                                                    </div>
                                                                </div>
                                                               
                                                                
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Apellido Paterno</label>
                                                                    <div class="controls">
                                                                        <input type="text" onkeypress="return soloLetras(event)" onkeyup="this.value=this.value.toUpperCase()" required="required" class=" form-control"
                                                                          id="appaterno" name="appaterno" <?php if(!empty($_GET["id"])) :?> value="<?php echo $empleado->getEmp_appaterno(); ?>" <?php endif; ?> autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Apellido Materno</label>
                                                                     <div class="controls">
                                                                          <input type="text" onkeypress="return soloLetras(event)" onkeyup="this.value=this.value.toUpperCase()" required="required" class="  form-control"
                                                                           id="apmaterno" name="apmaterno" <?php if(!empty($_GET["id"])) :?> value="<?php echo $empleado->getEmp_apmaterno(); ?>" <?php endif; ?> autocomplete="off">
                                                                     </div>
                                                                </div>
                                                                                                                                  
                                                                 <div class="control-group" style="margin-right:20px; margin-left:20px;">
                                                                    <label class="control-label">Sexo</label>
                                                                      <div class="controls form-inline">
                                                                            <label for="">
                                                                                <input name="optionsRadio" id="optionsRadios3" value="0" checked="" type="radio" style="opacity: 1">
                                                                                <span class="lbl">
                                                                                    Masculino
                                                                                </span>
                                                                            </label>
                                                                            <label for="">
                                                                                <input name="optionsRadio" id="optionsRadios4" value="1" type="radio" style="opacity: 1">
                                                                                <span class="lbl">
                                                                                    Femenino
                                                                                </span>
                                                                            </label>
                                                                    </div>
                                                                 </div>

                                                                 
                                                                
                                                            </div><!-- span6 -->
                                                            <div class="span6">                                                              
                                                                                                                         
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Direccion</label>
                                                                       <div class="controls">
                                                                                <input type="text" onkeypress="return soloLetras(event)" onkeyup="this.value=this.value.toUpperCase()" required="required" class=" form-control"
                                                                                   name="direccion" <?php if(!empty($_GET["id"])) :?> value="<?php echo $empleado->getdireccion(); ?>" <?php endif; ?> autocomplete="off">
                                                                       </div> 
                                                                </div>

                                                                 <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Modalidad</label>
                                                                    <div class="controls">
                                                                          <select class="form-control " name="trabajo" id="trabajo">
                                                                            <?php if (count($trabajos)): ?>
                                                                                <option value=-1>Seleccione</option>
                                                                                <?php foreach ($trabajos as $trabajo): ?>
                                                                                    <option value="<?php echo $trabajo->trab_id ?>" <?php if(!empty($_GET["id"])):if($trabajo->trab_id == $empleado->getTrab_id()): ?> selected <?php endif; endif; ?> >
                                                                                        <?php echo $trabajo->trab_descripcion; ?>
                                                                                    </option>
                                                                                <?php endforeach; ?>
                                                                            <?php else : ?>
                                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                            <?php endif; ?>
                                                                          </select>
                                                                    </div>
                                                                </div>
    
                                                               <div class="control-group" style="margin-right:20px; margin-left:20px;">
                                                                <label class="control-label">Ocupacion</label>
                                                                   <div class="controls">
                                                                           <select class="form-control " name="grupo" id="grupo">
                                                                                <?php if (count($grupos)): ?>
                                                                                  <option value=-1>Seleccione</option>
                                                                                    <?php foreach ($grupos as $grupo): ?>
                                                                                        <option value="<?php echo $grupo->goc_id ?>" <?php if(!empty($_GET["id"])):if($grupo->goc_id == $empleado->getGoc_id()): ?> selected <?php endif; endif; ?>>
                                                                                            <?php echo $grupo->goc_descripcion; ?>
                                                                                        </option>
                                                                                    <?php endforeach; ?>
                                                                                <?php else : ?>
                                                                                    <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                                <?php endif; ?>
                                                                            </select>
                                                                    </div>
                                                               </div>
                                                                
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Colegiatura</label>
                                                                     <div class="controls">
                                                                          <input type="text" onkeypress="return soloLetras(event)" onkeyup="this.value=this.value.toUpperCase()"  class="  form-control"
                                                                           id="colegiatura" name="colegiatura" <?php if(!empty($_GET["id"])) :?> value="<?php echo $empleado->getEmp_colegiatura(); ?>" <?php endif; ?> autocomplete="off">
                                                                     </div>
                                                                </div>


                                                            </div><!-- span6 -->
                                                        
                                                       </div><!-- span12 -->
                                                       <div class="space-6"></div>

                                                      <div class="span12 text-center">
                                                        
                                                            
                                                            <button type="submit" class="btn btn-success"> <i class="icon-ok icon-on-left bigger-110"></i>Guardar</button>
                                                            <a href="index.php?page=empleado&accion=listar" class="btn btn-default">Cancelar</a>
                                                        
                                                    </div>


                                                    </form><!-- form -->
        
                                                                                                                   
                                               
                                            </div><!-- row-fluid -->
                                            
                                        </widget><!--widget-main-->

                                        <div class="space-10"></div>
                                        
                                    </div><!-- widget-body -->

                                   
                                    
                                </div><!--widget-box-->
                                    
                                                        
                          
             
                             
                            </div><!-- span12 -->
                        </div><!-- row-fluid -->
                    </div><!-- page-content -->
            </div> <!-- main content -->
        </div><!-- main container -->
        
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
        <script src="view/js/ubigeo.js"></script>
        


    </body>
</html>