<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        
        <title>Reporte de Cancer</title>
        
         
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
       
    
        <script src="assets/js/jquery-1.10.2.min.js"></script>

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
                                <i class="icon-bar-chart home-icon"></i>
                                <a href="#">Reportes</a>

                                <span class="divider">
                                    <i class="icon-angle-right arrow-icon"></i>
                                </span>
                            </li>
                            <!-- <li >
                                <a href="#">Impresión de Roles</a>
                                <span class="divider">
                                <i class="icon-angle-right arrow-icon"></i>
                                </span>
                            </li> -->
                            <li class="active">Reporte de Cancer</li>
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
                            <h2 class="header smaller lighter blue">Reporte de Cancer</h2>


                            <div class="widget-box">
                                <div class="widget-header">

                                    <h4><i class="icon-bar-chart"></i>Datos de Reporte</h4>
                                    
                                </div>
                                <div class="widget-body">
                                    <br>
                                    <div class="widget-main">

                                        <div class="row-fluid">


                                          <form  action="index.php?page=informes&accion=mostrarinforme" class="form-horizontal" method="POST" target="_blank">

                                            <div class="control-group row-fluid">

                                            <label for="" class="control-label span2"><strong>Seleccione Fecha</strong></label> 
                                            <div class="controls span10">
                                                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha" id="fecha">
                                            </div>
                                            </div><!--control-group1-->
                                           
                                            
                                            <div class="col-lg-3">
                                                <div id="cmbinforme"></div>
                                            </div> 
                                            </div><!--control-group3-->

                                            <br>
                                            
                                          
                                            <div class="row-fluid text-right">
                                               <!--  <a class="btn btn-default" href="index.php?page=rolmedicos&accion=form">Cancelar <i class="icon-undo icon-on-right bigger-110"></i></a>
                                                      &nbsp; &nbsp; &nbsp;  
 -->                                                 <button  id="btn_buscar_programacion" class="btn btn-primary" type="submit" onclick=""> Mostrar<i class="icon-arrow-right icon-on-right bigger-130"></i></button> 
                                            </div>
                                             
                                         </form>  






                                        </div> <!--row-fluid-->
                          
                                    </div><!--widget-main-->
                                </div><!--widget-body-->
                            </div><!--widget-box-->
                                  
                         </div><!--span12--><!-- registros datos empleado-->


                      </div> <!--row-fluid-->


                      

                     </div><!--row-fluid estructura rol-->
     

        <!-- / le javascript -->
        <!-- // <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script> -->
        <script src="view/js/jquery-2.0.3.min.js"></script>
        
       
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/style-elements.min.js"></script>
        <script src="assets/js/style.min.js"></script>

        <script src="assets/js/chosen.jquery.js"></script>
       
        <script src="view/js/informes.js"></script>
        

        <script src="assets/js/bootbox.js"></script>

        <style>
            .personal {
                font-size: 13px;
            }
        </style>

        <script src="assets/js/chosen.jquery.js"></script>
        <script type="text/javascript">
            var config = {
                '.chosen-select'           : {},
                '.chosen-select-deselect'  : {allow_single_deselect:true},
                '.chosen-select-no-single' : {disable_search_threshold:10},
                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                '.chosen-select-width'     : {width:"95%"}
            }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }
        </script>
    </body>

    </body>
</html>