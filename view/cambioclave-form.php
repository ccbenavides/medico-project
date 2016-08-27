<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        

        <title>Cambio de Clave</title>
        
         <!-- BASIC-->
           
        <link rel="shortcut icon" href="assets/img/micros.ico">

        <!--basic styles--> 
              
        <link href="assets/plugins/bootstrap/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/plugins/bootstrap/bootstrap-responsive.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/css/ace.min.css" />
        <link rel="stylesheet" href="assets/css/ace-responsive.min.css" />
        <link rel="stylesheet" href="assets/css/ace-skins.min.css" />
        <link rel="stylesheet" href="assets/css/bootstrap-timepicker.css" />
        <link rel="stylesheet" href="assets/css/datepicker.css" />
        


        <!--fonts&iconos-->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
        <link rel="stylesheet" href="assets/font-awesome-4.3.0/css/font-awesome.css">
        <!--[if IE 7]>
        <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
        <![endif]-->
    
        <link rel="stylesheet" href="assets/css/font.css" />

        <script src="view/js/jquery.js" type="text/javascript"></script>
        <script src="assets/js/jquery-1.10.2.min.js"></script>
        <script src="view/js/jquery.validate.js" type="text/javascript"></script>

        </head>
        
        <script type="text/javascript">

             $(document).on('ready', function() {
                
                $.validator.addMethod("contrasena",
                        function(contraseña) {
                            var x = document.getElementById("pass1").value;
                            if (x === contraseña) {
                                return true;
                            } else {
                                return false;
                            }
                        },
                        "Las contraseñas no coinciden"
                        );
                $("#form4").validate({
                    rules: {                        
                        pass1: {required: true, minlength: 5, maxlength: 30},
                        pass2: {required: true, minlength: 5, maxlength: 30,
                            contrasena: true}

                    },
                    messages: {
                        pass1: {minlength: "CONTRASEÑA DEBIL"},
                        pass2: {minlength: "CONTRASEÑA DEBIL"}
                    }
                });
            });
        </script>

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
                                <i class="icon-group  home-icon"></i>
                                <a href="#">Perfil Usuario</a>

                                <span class="divider">
                                    <i class="icon-angle-right arrow-icon"></i>
                                </span>
                            </li>
                          
                            <li class="active">Cambio de Clave</li>
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
                                <h2 class="header smaller lighter blue">Cambio de Clave</h2>
                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h4><i class=" icon-user-md pink"></i>Datos del Trabajador.</h4>
                                        
                                    </div><!-- widget-header -->
                                    <div class="widget-body">
                                        <widget class="main">
                                            <div class="row-fluid ">
                                                <div class="position-relative">
                                                <div class="space-18"></div>
                                                
                                                    <form id="form4" class="form-horizontal"  action="index.php?page=usuarios&accion=userresspass" role="form" method="POST">
                                                       <div class="span10">
                                                           <div class="form-group">
                                                             <div class="control-group " style="margin-right: 20px; margin-left: 20px;">
                                                                  <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['idusuario'] ?>"/>
                                                                  <label class="control-label">Nombre de Usuario</label>
                                                                  
                                                                  <div class="controls">

                                                                    <!-- <span class="block input-icon input-icon-right"> -->
                                                                      <input readonly="true" value="<?php echo $_SESSION['usuario'];?>" type="text" id="usuario" autocomplete="off" placeholder="" name="usuario_name" class="form-control">
                                                                      <!-- <i class="icon-user"></i> -->
                                                                    <!-- </span> -->

                                                                  </div>
                                                              </div>
                                                            </div>

                                                            <div class="form-group">
                                                              <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                  <label class="control-label">Contraseña Nueva</label>
                                                                  
                                                                  <div class="controls">
                                                                      <input type="password" id="pass1" name="pass1" required="required" class="form-control" autocomplete="off" placeholder="Password"/>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                           
                                                            <div class="form-group">
                                                              <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                  <label class="control-label">Confirme su Contraseña</label>
                                                                  <div class="controls">
                                                                      <input type="password" id="pass2" name="pass2" required="required" class="form-control" autocomplete="off" placeholder="Repeat password" />
                                                                  </div>
                                                              </div>
                                                            </div>

                                                        </div><!-- control-group -->
                                                            
                                                       <!-- span10 -->
                                                       <!-- <div class="space-6"></div> -->
                                                      <div class="form-group">
                                                        <label for="" class="col-sm-4 control-label"></label>
                                                        <div class="col-sm-8" >
                                                        <div class="row">
                                                        <div class="col-sm-8"></div>

                                                      <div class="span12 text-center">
                                                        
                                                        <button id="guardar" type="submit" class="btn btn-primary "><i class="fa-floppy-o icon-on-left bigger-110"></i>Guardar</button>
                                                        <a href="index.php" class="btn btn-danger"><i class="fa-times-circle icon-on-left bigger-110"></i>Cancelar</a>
                                                        
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
        
        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
            <i class="icon-double-angle-up icon-only bigger-110"></i>
        </a>
       <script src="view/js/jquery-2.0.3.min.js"></script>
        <!-- // <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script> -->
        <script type="text/javascript">
            // if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
        </script>

        <script src="assets/js/bootstrap.min.js"></script>

        <!--ace scripts-->

        <script src="assets/js/style-elements.min.js"></script>
        <script src="assets/js/style.min.js"></script>
        <script src="assets/js/jquery.gritter.min.js"></script>
        <script type="assets/js/bootstrap.datepicker.js"></script>
        <script src="assets/js/date-time/bootstrap-datepicker.min.js"></script>
        <script src="view/js/bioih.js"></script>
        <script src="assets/js/bootbox.js"></script>
        
        <!--inline scripts related to this page-->


    </body>
</html>