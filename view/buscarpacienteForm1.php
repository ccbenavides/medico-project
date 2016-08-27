<!DOCTYPE html>
<html lang="es"><head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Recepcionar Biopsia</title>
        <meta name="description" content="overview &amp; stats" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- BASIC-->
      
        <link rel="shortcut icon" href="assets/img/micros.ico">

        <!--basic styles-->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
        <link rel="stylesheet" href="assets/font-awesome-4.3.0/css/font-awesome.css" />

        <!--fonts-->

        <link rel="stylesheet" href="assets/css/font.css" />
        <link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css" /> 
        <link rel="stylesheet" href="assets/plugins/datatables/dataTables.responsive.css" /> 

        <!--page specific plugin styles-->

        <link rel="stylesheet" href="assets/css/jquery-ui-1.10.3.custom.min.css" />
        <link rel="stylesheet" href="assets/css/jquery.gritter.css" />

        

        <!--ace styles-->

        <link rel="stylesheet" href="assets/css/ace.min.css" />
        <link rel="stylesheet" href="assets/css/ace-responsive.min.css" />
        <link rel="stylesheet" href="assets/css/ace-skins.min.css" />
        <script type="text/javascript" src="view/js/buscador.js"></script>
        <script type="text/javascript">
        function aMays(e, elemento) {
        tecla=(document.all) ? e.keyCode : e.which; 
         elemento.value = elemento.value.toUpperCase();
        }
        </script>
        
    </head>

    <body>
        
        <?php include 'barrasesion.php' ?>
        
        <div class="main-container container-fluid">
            <a class="menu-toggler" id="menu-toggler" href="#">
                <span class="menu-text"></span>
            </a>

            <?php include 'nav-bar.php' ?>

            <div class="main-content">
                <div class="breadcrumbs" id="breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <i class="fa fa-user-plus"></i>
                            <a href="index.php">Paciente</a>

                            <span class="divider">
                            <i class="icon-angle-right arrow-icon"></i>
                            </span>
                        </li>
                        <li class="active">Recepcionar Biopsia</li>
                    </ul><!--.breadcrumb-->
                </div>                               
                <div class="page-content">
                    <div class="row-fluid">
                        <div class="span12">
                            <h2 class="header smaller lighter blue">Recepcionar Biopsia</h2>
                            <div class="widget-box">
                                <div class="widget-header">
                                    <h4>Buscar:</h4>
                                </div>
                                <div class="widget-body">                                        
                                    <div class="widget-main">
                                        <div class="form-horizontal" >
                                            <div class="control-group">        
                                                <div class="form-group">
                                                    <div class="col-sm-8">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <select class='hidden' id="tipo" name="tipo" class="form-control"  onchange="(this)">
                                                                    <option value='DNI'>DNI</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="row">
                                                            <label  class="control-label"><strong>Paciente: </strong></label>        
                                                            <div class="controls">
                                                                <input data-toggle="tooltip" title="Ingrese el DNI o los apellidos y nombres del paciente" type="text" class="form-control"  maxlength="50" name="valor" id="DNI"  autocomplete="off" onfocusout="this.value=this.value.toUpperCase()" onkeyup="BuscaPaciente()" required> 
                                                            </div>   
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>   
                                            <!--BOTON ACEPTAR-->
                                            <!-- <div class="form-group">
                                                <label for="" class="col-sm-4 control-label"></label>
                                                <div class="col-sm-8" >
                                                    <div class="row">
                                                        <div class="col-lg-5 ">
                                                            <button type="submit" class="btn btn-primary">Buscar</button>
                                                            <a class="btn btn-default" href="index.php?page=paciente&accion=form">Cancelar</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                        </div> <br>  
                                        <div class="table-responsive" id="table-responsive"></div> 
                                    </div><!--widget-body-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                                
    </body>
    <script src="assets/js/jquery.dataTables.js"></script>
    <script src="assets/js/jquery.dataTables.bootstrap.js"></script>
    <script src="assets/js/dataTables.responsive.js"></script>                        
    <script src="assets/js/jquery-2.0.3.min.js"></script>
    <script src="assets/js/ace-elements.min.js"></script>
    <script src="assets/js/ace.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/chosen.jquery.js"></script>
    <!--<script src="view/js/jquery-1.11.1.min.js"></script>-->
    <!--<script src="view/js/bootstrap.min.js"></script>-->
    <!--<script src="view/js/reportes.js"></script>-->
    <script src="assets/js/bootbox.js"></script>
    <script src="assets/js/bootstrap-colorpicker.min.js"></script>
    <script src="assets/js/jquery.knob.min.js"></script>
    <script src="assets/js/jquery.autosize-min.js"></script>
    <script src="assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
    <script src="assets/js/jquery.maskedinput.min.js"></script>
    <script src="assets/js/bootstrap-tag.min.js"></script>
    <script src="view/js/ayudas.js"></script>
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
    <script>
        
        function soloNumeros(e) {
            key = e.keyCode || e.which;
            tecla = String.fromCharCode(key).toUpperCase();
            letras = "1234567890";
            especiales = "8-37-39-46";
            tecla_especial = false
            for (var i in especiales) {
                if (key == especiales[i]) {
                    tecla_especial = true;
                    break;
                }
            }

            if (letras.indexOf(tecla) == -1 && !tecla_especial) {
                return false;
            }
        }
        
    </script>


    
</html>

