<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Ubicaciones</title>

        <meta name="description" content="Common UI Features &amp; Elements" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!--basic styles-->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
        <link rel="stylesheet" href="assets/font-awesome-4.3.0/css/font-awesome.css" />

        <!--[if IE 7]>
          <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
        <![endif]-->

        <!--page specific plugin styles-->

        <link rel="stylesheet" href="assets/css/jquery-ui-1.10.3.custom.min.css" />
        <link rel="stylesheet" href="assets/css/jquery.gritter.css" />

        <!--fonts-->

         <link rel="stylesheet" href="assets/css/font.css" />

        <!--ace styles-->
        <link rel="stylesheet" href="assets/css/ace.min.css" />
        <link rel="stylesheet" href="assets/css/ace-responsive.min.css" />
        <link rel="stylesheet" href="assets/css/ace-skins.min.css" />

        <!--DATATABLES-->  
        <link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css" /> 
        <link rel="stylesheet" href="assets/plugins/datatables/dataTables.responsive.css" /> 

        <link rel="shortcut icon" href="assets/img/micros.ico">

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
                          
                            <li class="active">Ubicación</li>
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
                              
                         <h2 class="header smaller lighter blue">Registro de Ubicacion</h2>



                         <div class="widget-box">
                             <div class="widget-header">
                                <h4><i class=" icon-user-md pink"></i>Datos de la Ubicacion.</h4>
                                
                             </div><!-- widget-header -->
                             <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row-fluid">
                                        <div class="space-18"></div>

                                        <form  class="form-horizontal " action="index.php?page=ubicacion&accion=insertar<?php if(!empty($_GET["id"])) :?>&id=<?php echo $_GET["id"]; endif; ?>" method="POST">
                                            <div class="span10">
                                                   <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                        <label class="control-label" >Nombre de la ubicacion</label>
                                                       <div class="controls">
                                                            <input data-toggle="tooltip" title="Ingresar solo letras" type="text" onkeyup="this.value=this.value.toUpperCase()" required="required" class=" form-control" onkeypress="return soloLetras(event)"
                                                               name="nombreubic" id="nombreubic" <?php if(!empty($_GET["id"])) :?> value="<?php echo $ubicacion->getDesUbi(); ?>" <?php endif; ?> autocomplete="off">
                                                        </div>
                                                    </div><!-- control-group -->
                                                    
                                                    <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                    <label for="" class="control-label"> <strong>Estado</strong></label>
                                                        <div class="controls form-inline">

                                                            <label for="">
                                                                <input type="radio" name="optionsRadios" id="optionsRadios1" value="0"  style="opacity: 1" checked>
                                                                <span class="lbl">Activo</span>
                                                            </label>
                                                            <label for="">
                                                                <input type="radio" name="optionsRadios" id="optionsRadios2" value="1" <?php if(!empty($_GET["id"])) : if($ubicacion->getEstado() == 1):?> checked <?php endif; endif; ?>>
                                                                <span class="lbl">Inactivo</span>
                                                            </label>
                                                        </div>
                                                    </div> <!-- control-group -->
                                                    
                                            </div> <!-- span10 -->
                                            <div class="space-6"></div>
                                            <div class="span12 text-center">
                                                <button type="submit" class="btn btn-primary"> <i class="fa-floppy-o icon-on-left bigger-110"></i>Guardar</button>
                                                 <a href="index.php?page=ubicacion&accion=listar" class="btn btn-danger"><i class="fa-times-circle icon-on-left bigger-110"></i>Cancelar</a>
                                                
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
        
        <script src="assets/js/bootstrap.min.js"></script>
        
     <!--<![endif]-->

        <!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

        <!--[if !IE]>-->

        <script type="text/javascript">
            window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
        </script>

        <!--<![endif]-->

        <!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
        <script src="assets/js/jquery-1.10.2.min.js"></script> 
        <script type="text/javascript">
            if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
        </script>
        <script src="assets/js/bootstrap.min.js"></script>

        <!--page specific plugin scripts-->

        <!--[if lte IE 8]>
          <script src="assets/js/excanvas.min.js"></script>
        <![endif]-->

        <script src="assets/js/jquery-ui-1.10.3.custom.min.js"></script>
        <script src="assets/js/jquery.ui.touch-punch.min.js"></script>
        <script src="assets/js/bootbox.min.js"></script>
        <script src="assets/js/jquery.easy-pie-chart.min.js"></script>
        <script src="assets/js/jquery.gritter.min.js"></script>
        <script src="assets/js/spin.min.js"></script>

        <!--ace scripts-->

        <script src="assets/js/ace-elements.min.js"></script>
        <script src="assets/js/ace.min.js"></script>
        <!--datatables js-->

        <script src="assets/js/jquery.dataTables.js"></script>
        <script src="assets/js/jquery.dataTables.bootstrap.js"></script>
        <script src="assets/js/dataTables.responsive.js"></script>

        <script src="view/js/validaciones.js"></script>

        <script src="view/js/personalizamensaje.js"></script>
        <!--inline scripts related to this page-->


    </body>
</html>