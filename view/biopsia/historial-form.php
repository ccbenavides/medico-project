<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        
        <title>Historial de Paciente</title>
        
         
        <link rel="shortcut icon" href="assets/img/micros.ico">

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
        <link rel="stylesheet" href="assets/css/personalizado.css" />
        <link rel="stylesheet" href="assets/css/font.css" />

        <link rel="stylesheet" href="assets/plugins/datatables/dataTables.responsive.css" /> 
               
        <link rel="stylesheet" href="assets/css/ace.min.css" />
        <link rel="stylesheet" href="assets/css/ace-responsive.min.css" />
        <link rel="stylesheet" href="assets/css/ace-skins.min.css" />

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
                                <i class="fa fa-user-plus"></i>
                                <a href="#">Paciente</a>

                                <span class="divider">
                                    <i class="icon-angle-right arrow-icon"></i>
                                </span>
                            </li>
                          
                            <li class="active">Historial</li>
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
                                <h2 class="header smaller lighter blue">Historial</h2>
                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h4><i class=" icon-user-md pink"></i>Buscar por:</h4>
                                        
                                    </div><!-- widget-header -->
                                    <div class="widget-body">
                                        <div class="widget-main">

                                        <div class="row-fluid">
                                          <form class=" form-horizontal " method="POST" name="historial-paciente" id="historial-paciente" enctype="multipart/form-data">

                                            <div class="control-group">
                                                <label for="" class="control-label span2"><strong>DNI:</strong></label>
                                                <div class="controls span10">
                                                    <input type="text" maxlength="8" onkeypress="return soloNumeros(event)" required="required" class=" form-control" name="dni" id="dni" autocomplete="off" autofocus>
                                                </div>

                                            </div><!--contrl-group2-->
                                          
                                            <!--<div class="row-fluid text-right">
                                                <a class="btn btn-default" href="index.php?page=biopsia&accion=historia">Cancelar <i class="icon-undo icon-on-right bigger-110"></i></a>
                                                      &nbsp; &nbsp; &nbsp;  
                                                 <button  id="btn_buscar_programacion" class="btn btn-info" type="submit">Buscar<i class="icon-arrow-right icon-on-right bigger-110"></i></button>
                                            </div>-->
                                             
                                         </form>  
                                        </div> <!--row-fluid-->
                          
                                    </div><!--widget-main-->
                                                                               
                                    </div><!-- widget-body -->

                                   
                                    
                                </div><!--widget-box-->
                                                           
                                     
                                <div class="widget-box" id="estructura_historial" style="display:none;">
                                    <div class="widget-header">
                                    <h4 ><i class=" icon-calendar pink"></i>Historial: <span class="green" id="dependenciaActualTXT"></span></h4>
                                   
                                    </div>
                                    <div class="widget-body"><!--datos de historial-->
                                        <div class="widget-main">
                                            <div class="row-fluid">
                                                
                                                    <div class="table-responsive">
                                                    <h3 class=" text-primary  blue">Paciente</h3>
                                                       <table class="table table-bordered table-striped table-condensed table-hover" style="border-collapse: collapse;">
                                                                <thead>
                                                                    <tr>
                                                                        <th>DNI</th>
                                                                        <th>Nombres y Apellidos</th>
                                                                        <th>Edad</th>
                                                                        <th>Sexo</th>
                                                                        
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="ajax_paciente"></tbody>
                                                       </table>
                                                </div> 
                                            
                                               <div class="row-fluid">
                                                <div class="span12">
                                                        <div class="span6">
                                                            <div class="table-responsive">
                                                                
                                                                <h3 class="text-primary  blue">Areas</h3>
                                                                
                                                                <table class="table table-bordered table-striped table-condensed table-hover" >
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Codigo</th>                                                                             
                                                                            <th>Area</th>
                                                                                                                                                
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="ajax_areas"></tbody>
                                                                </table>
                                                               
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="span6" >
                                                            <div class="table-responsive" >
                                                                <h3 class="text-primary  blue">Biopsias</h3>
                                                                <table id="prueba" class="table table-bordered table-striped table-condensed table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th hidden>Codigo</th>
                                                                        <th>Numero</th>
                                                                        <th>Fecha Ingreso</th>
                                                                        <th>Fecha Informe</th> 
                                                                        <th>Accion</th>                                                                       
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="ajax_biopsias"></tbody>
                                                            </table>                                                           
                                                          </div>
                                                          
                                                      </div>
                                                      
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            

                        
                        </div><!--span12-->
                    </div><!--row-fluid-->

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
        <script src="view/js/historial.js"></script>
        
    </body>
</html>