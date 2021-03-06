<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        
        <title>Monitoreo</title>
        
         
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
                                <i class="icon-eye-open home-icon"></i>
                                <a href="#">Monitoreo</a>

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
                            <li class="active">Inf.Controles</li>
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
                            <h2 class="header smaller lighter blue">Monitoreo</h2>


                            <div class="widget-box">
                                <div class="widget-header">

                                    <h4><i class="icon-bar-chart"></i>Tipo de Informe</h4>
                                    
                                </div>
                                <div class="widget-body">
                                    <br>
                                    <div class="widget-main">

                                        <div class="row-fluid">


                                          <form  action="index.php?page=movimiento&accion=mostrarmonitoreo" class="form-horizontal" method="POST" target="_blank">

                                            <div class="control-group row-fluid">

                                            <label for="" class="control-label span2"><strong>Seleccione Opción</strong></label> 
                                            <div class="controls span10">
                                                <select class="span6" id="cmb02" name="cmb02" onchange="cargacombo3();">
                                                     <optgroup label="REGISTRO DE AUDITORIA">
                                                         <option value="1">REGISTRO DE MOVIMIENTOS DEL USUARIO</option>
                                                         <option value="2">REGISTRO DE CONEXIONES DEL USUARIO</option>
                                                         <!--<option value="3">REGISTRO CON FALTAS</option>-->
                                                     </optgroup>
                                                     <optgroup label="GESTION DE ACCESO DE USUARIOS">
                                                         <option value="4">HISTORIAL DE PERFILES DE USUARIO</option>
                                                     </optgroup>                                                 
                                                </select>
                                            </div>
                                            </div><!--control-group1-->
                                           
                                            
                                            <div class="col-lg-3">
                                                <div id="cmbmonitoreo"></div>
                                            </div> 

                                            <div class="control-group row-fluid" id="desde" >
                                               <div class="span12 row-fluid input-append">
                                                <label for="" class="control-label span2"><strong>Desde</strong></label>
                                                <div class="controls span5">
                                                    <input type="text" class="span6 from_date" id="fechadesde" name="fecha1" placeholder="Seleccione fecha inicial" data-date-format="yyyy-mm-dd" contenteditable="false" hidden>
                                                        <span class="add-on">
                                                            <i class="icon-calendar"></i>
                                                        </span>

                                                </div>                                                
                                             </div>
                                            </div>

                                             <div class="control-group row-fluid" id="hasta" >
                                               <div class="span12 row-fluid input-append">
                                                <label for="" class="control-label span2"><strong>Hasta</strong></label>
                                                <div class="controls span5">
                                                    <input type="text" class="span6 to_date" id="fechahasta" name="fecha2" placeholder="Seleccione fecha final" data-date-format="yyyy-mm-dd" contenteditable="false" hidden>
                                                        <span class="add-on">
                                                            <i class="icon-calendar"></i>
                                                        </span>

                                                </div>                                                
                                             </div>
                                            </div>


                                            </div><!--control-group3-->

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
       
        <script src="view/js/monitoreo.js"></script>
        <script src="assets/js/date-time/bootstrap-timepicker.min.js"></script>
        <script src="assets/js/date-time/bootstrap-datepicker.min.js"></script>

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

        <script type="text/javascript">
            $(document).ready(function(){
            var startDate = new Date('01/01/2012');
            var FromEndDate = new Date();
            var ToEndDate = new Date();

            ToEndDate.setDate(ToEndDate.getDate()+365);

            $('.from_date').datepicker({
                
                weekStart: 1,
                startDate: '01/01/2012',
                endDate: FromEndDate, 
                autoclose: true
            })
                .on('changeDate', function(selected){
                    startDate = new Date(selected.date.valueOf());
                    startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
                    $('.to_date').datepicker('setStartDate', startDate);
                }); 
            $('.to_date')
                .datepicker({
                    
                    weekStart: 1,
                    startDate: startDate,
                    endDate: ToEndDate,
                    autoclose: true
                })
                .on('changeDate', function(selected){
                    FromEndDate = new Date(selected.date.valueOf());
                    FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
                    $('.from_date').datepicker('setEndDate', FromEndDate);
                });
            });
        </script>

    </body>

    </body>
</html>