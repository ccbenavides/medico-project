<!DOCTYPE html>
<html>
     <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

        <title>Reportes</title>
        <!--basic styles-->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
        <link rel="stylesheet" href="assets/font-awesome-4.3.0/css/font-awesome.css" />

        <!--fonts-->

        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

        <!--page specific plugin styles-->

        <link rel="stylesheet" href="assets/css/jquery-ui-1.10.3.custom.min.css" />
        <link rel="stylesheet" href="assets/css/jquery.gritter.css" />

        <script src="view/js/jquery-1.11.1.min.js"></script>
        <script src="view/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css" /> 
        <link rel="stylesheet" href="assets/plugins/datatables/dataTables.responsive.css" /> 
        <!--ace styles-->

        <link rel="stylesheet" href="assets/css/ace.min.css" />
        <link rel="stylesheet" href="assets/css/ace-responsive.min.css" />
        <link rel="stylesheet" href="assets/css/ace-skins.min.css" />

       
        <!--inline styles related to this page-->
        <script src="view/js/jquery-1.11.1.min.js"></script>
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


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
                            <li class="active">Impresión de Reportes</li>
                        </ul><!--.breadcrumb-->
                        
                        <div class="nav-search" id="nav-search">
                            <form class="form-search" />
                                <span class="input-icon">
                                    <input type="text" placeholder="Search ..." class="input-small nav-search-input" id="nav-search-input" autocomplete="off" />
                                    <i class="icon-search nav-search-icon"></i>
                                </span>
                            </form>
                        </div>
                        <!--#nav-search-->
                    </div>


                <div class="page-content">

                      <div class="row-fluid">
                        
                         <div class="span12">
                            <h2 class="header smaller lighter blue">Impresión de Reportes</h2>


                            <div class="widget-box">
                                <div class="widget-header">

                                    <h4><i class="icon-bar-chart"></i>Tipo de Reporte:</h4>
                                    
                                </div>
                                <div class="widget-body">
                                    <br>
                                    <div class="widget-main">

                                        <div class="row-fluid">


                                          <form  action="index.php?page=reportes&accion=mostrarreporte" class="form-horizontal" method="POST" target="_blank">

                                            <div class="control-group row-fluid">

                                            <label for="" class="control-label span2"><strong>Seleccione Opción</strong></label> 
                                            <div class="controls span10">
                                                <select class="span6" id="cmbselect" name="cmbselect" onchange="cargarcomboreporte();">
                                                     <!-- <option value="2">FICHA DE GUARDIAS ROL NO MEDICO</option> -->
                                                        <optgroup label="HOSPITALIZACION">
                                                        <option value="4">CENSO DIARIO</option>
                                                       <!--  <option value="6">ROL DE HRS COMPLEMENTARIAS</option>
                                                        <option value="9">ROL C/ACTIVIDADES</option>
                                                        <optgroup label="ROL PROFESIONALES DE LA SALUD M&Eacute;DICO">
                                                        <option value="4">PROGRAMACION DE ROL DE ASISTENCIA</option>
                                                        <option value="8">ROL DE ASISTENCIA DE HRS COMPLEMENTARIAS</option>
                                                        <option value="10">ROL DE RESIDENTES</option>
                                                        <optgroup label="ROL DE RETENES">
                                                        <option value="7">ROL DE RETENES</option> -->
                                                        <!-- <optgroup label="NUTRICIÓN - PROGRAMACIONES">
                                                        <option value="reporte-raciones-programadas">POR DEPENDENCIA</option>
                                                        <option value="reporte-raciones-programadas-grupo-ocupacional">POR GRUPO OCUPACIONAL</option>
                                                        <option value="reporte-raciones-marcadas-dia">CONSUMO DE RACIONES POR DIA</option>
                                                        <option value="reporte-raciones-marcadas-mes">CONSUMO DE RACIONES POR MES</option>
                                                        <option value="reporte-consolidado-mensual"> CONSOLIDADO DE COMEDOR</option> -->
                                                       <!--  <optgroup label="OTROS">
                                                        <option value="11">ROL DE TÉCNICOS</option>
                                                        <option value="12">ROL DE INTERNOS DE MEDICINA</option>   
                                                        <option value="1">INFORME DE LIQUIDACION</option>
                                                        <option value="3">VER RESOLUCI&Oacute;N</option> 
                                                        </optgroup>
                                                        <optgroup label="HORAS NORMALES - COMPLEMENTARIAS">
                                                        <option value="13">CONSOLIDADO</option>  -->
                                                        </optgroup>
                                                </select>
                                            </div>
                                            </div><!--control-group1-->

                                            <div class="col-lg-3">
                                            <div id="cmbreporte"></div>
                                            </div>
                                            </div><!--control-group3-->

                                            <br>
                                            
                                          
                                            <div class="row-fluid text-right">
                                               <!--  <a class="btn btn-default" href="index.php?page=rolmedicos&accion=form">Cancelar <i class="icon-undo icon-on-right bigger-110"></i></a>
                                                      &nbsp; &nbsp; &nbsp;  
 -->                                                 <button  id="btn_buscar_programacion" class="btn btn-info" type="submit" onclick=""> Mostrar<i class="icon-arrow-right icon-on-right bigger-110"></i></button>
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
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        
       
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/chosen.jquery.js"></script>
       
        <script src="view/js/reportes.js"></script>
        <script src="view/js/dependencias.js"></script>

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