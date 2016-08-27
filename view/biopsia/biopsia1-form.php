<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Creacion de Biopsia</title>

        <meta name="description" content="overview &amp; stats" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        
       
       <!-- BASIC-->
      
        <link rel="shortcut icon" href="assets/img/micros.ico">

        <!--basic styles--> 
        <!-- <link href="assets/css/reset.css" rel="stylesheet" /> -->
        <link href="assets/plugins/bootstrap/bootstrap.min.css" rel="stylesheet" />
     
        <link href="assets/plugins/bootstrap/bootstrap-responsive.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/css/style.min.css" />
        <link rel="stylesheet" href="assets/css/style-responsive.min.css" />
         <link rel="stylesheet" href="assets/css/personalizado.css" />

        <!--fonts&iconos-->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
        <link rel="stylesheet" href="assets/font-awesome-4.3.0/css/font-awesome.css">
        <!--[if IE 7]>
        <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
        <![endif]-->
    
        <link rel="stylesheet" href="assets/css/font.css" />

        <!--favicon-->
        <style type="text/css">
                    #img_logo{
                        max-width: 330px;
                        margin-left:  -70px;

                    }
        </style>

        <!-- 

        <link href="view/css/chosen.css" rel="stylesheet"> -->
       <!--  <link href="view/css/personalizado.css" rel="stylesheet"> -->
       <script type="text/javascript" charset="utf-8">
                $(document).ready(function() {
                    $('#listarpacientes').dataTable();
                } );
        </script>
    </head>
    <body>

        <?php
        // put your code here
        include 'barrasesion.php';
       
        ?>
       <div class="main-container container-fluid">
   
         <a class="menu-toggler" id="menu-toggler" href="#">
                <span class="menu-text"></span>
         </a>
     

        <?php
        // put your code here
        include 'nav-bar.php';
       
        ?>

                  
            <div class="main-content"> 
                    <div class="breadcrumbs" id="breadcrumbs">
                        <ul class="breadcrumb">
                            <li>
                                <i class=" icon-check-empty home-icon"></i>
                                <a href="#">Paciente</a>

                                <span class="divider">
                                    <i class="icon-angle-right arrow-icon"></i>
                                </span>
                            </li>
                            <li class="active">Crear Biopsia</li>
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
                            <h2 class="header smaller lighter blue">Registro de Biopsia</h2>


                            <div class="widget-box">
                                <div class="widget-header">

                                    <h4><i class=" icon-user-md pink"></i>Datos del paciente:</h4>
                                    
                                </div>
                                <div class="widget-body">
                                    <br>
                                    <div class="widget-main">

                                        <div class="row-fluid">
                                          <form class=" form-horizontal" id="buscar-paciente" action="index.php?page=biopsia&accion=buscar<?php if (!empty($_GET["id"])) : ?>&id=<?php echo $_GET["id"];endif;?>">  
                                           <div class="control-group row-fluid" >
                                              <label for ="" class="control-label span2"><strong>DNI</strong></label>
                                              <div class="controls span10">
                                                <input type="text" onkeypress="return soloNumeros(event)" maxlength="8" required="required" class=" form-control" name="dni" id ="dni" autocomplete="off" autofocus>
                                                 </div>
                                            </div>                     
                                       
                                            <div class="row-fluid text-center">
                                                <button type="submit" class="btn btn-primary">Buscar</button>
                                              
                                            </div>
                                             
                                         </form>  


                                        </div> <!--row-fluid-->
                          
                                    </div><!--widget-main-->
                                </div><!--widget-body-->
                            </div><!--widget-box-->
                                  
                         </div><!--span12--><!-- registros datos empleado-->


                      </div> <!--row-fluid-->


  
  
       
       

                </div> <!-- page-content-->  
             </div><!--main-content-->
        </div> <!-- main-container-->             

        <!-- / le javascript -->
        <script type='text/javascript' src='assets/plugins/calendar/resource-calendar/jquery/jquery-1.9.1.min.js'></script>
        <script type='text/javascript' src='assets/plugins/calendar/resource-calendar/jquery/jquery-ui-1.10.2.custom.min.js'></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/style-elements.min.js"></script>
        <script src="assets/js/style.min.js"></script>
        <script src="assets/js/date-time/bootstrap-timepicker.min.js"></script>
         <script src="assets/js/date-time/bootstrap-datepicker.min.js"></script>
        <script src="assets/js/date-time/daterangepicker.min.js"></script>
        <script src="assets/js/date-time/moment.min.js"></script>
        <script src="assets/js/jquery.dataTables.js"></script>
        <script src="assets/js/jquery.dataTables.bootstrap.js"></script>
        <script src="assets/js/dataTables.responsive.js"></script>       
        
        
        <script src="assets/js/bootbox.js"></script>

        <style>
            .personal {
                font-size: 13px;
            }
        </style>

    </body>
</html>