<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        
        <title>Registro de Pacientes</title>
        
         
        <link rel="shortcut icon" href="assets/img/favicon.ico">

        <!--basic styles--> 
              
        <link href="assets/plugins/bootstrap/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/plugins/bootstrap/bootstrap-responsive.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/css/style.min.css" />
        <link rel="stylesheet" href="assets/css/style-responsive.min.css" />
        <link rel="stylesheet" href="assets/css/bootstrap-timepicker.css" />
        <link rel="stylesheet" href="assets/css/datepicker.css" />
        
        <link href="assets/css/chosen.css" rel="stylesheet">

        <!--fonts&iconos-->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
        <link rel="stylesheet" href="assets/font-awesome-4.3.0/css/font-awesome.css">
        <!--[if IE 7]>
        <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
        <![endif]-->
    
        <link rel="stylesheet" href="assets/css/font.css" />


        <link rel="shortcut icon" href="assets/img/micros.ico">
        
    
        <script src="assets/js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript">
            $(document).on('ready', function() {
                $('#tipo').on('change', function() {
                   var dato=$('#tipo').val();
                   if (dato==6) {
                    $('#tiposeguro').show();
                    $('#codigo_sis').show();
                   }else{
                    $('#tiposeguro').hide();
                    $('#codigo_sis').hide();
                   };
                   
               });
              var seguros=$('#tipo').val();
              if (seguros==6) {
                $('#tiposeguro').show();
                $('#codigo_sis').show();
              } else{
                $('#tiposeguro').hide();
                $('#codigo_sis').hide();
              };
            });

        </script>

        <style type="text/css">
        .modalcarga {
                display:    none;
                position:   fixed;
                z-index:    1000;
                top:        0;
                left:       0;
                height:     100%;
                width:      100%;
                background: rgba( 255, 255, 255, .8 ) 
                            url('css/39.GIF') 
                            50% 50% 
                            no-repeat;
            }
        </style>

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
                          
                            <li class="active">Pacientes</li>
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
                                <h2 class="header smaller lighter blue">Registro del Paciente</h2>
                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h4><i class=" icon-user-md pink"></i>Datos del paciente.</h4>
                                        <input type="hidden" id="modoform" value="<?php echo (isset($aniadir)) ? $aniadir : '' ; ?>">
                                    </div><!-- widget-header -->
                                    <div class="widget-body">
                                        <widget class="main">
                                            <div class="row-fluid ">
                                                <div class="space-18"></div>
                                                
                                                    <form id="registropaciente" class="form-horizontal"  action="index.php?page=paciente&accion=insertarpac<?php if(!empty($_GET["id"])) :?>&id=<?php echo $_GET["id"]; endif; ?>" method="POST" enctype="multipart/form-data">
                                                       <div class="span12 ">
                                                           <div class="span6">
                                                               <div class="control-group " style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">DNI</label>
                                                                    <div class="controls">
                                                                        <input  type="text" maxlength="8" onkeypress="return soloNumeros(event)" required="required" class=" form-control" id="dni" name="dni" 
                                                                        
                                                                        value="<?php
                                                                        if (!empty($dnibusqueda)) {
                                                                            echo $dnibusqueda;
                                                                        }
                                                                        else if (!empty($_GET['id'])) {
                                                                            echo $paciente->getDni();
                                                                        } else {
                                                                            echo "";
                                                                        }
                                                                        
                                                                        ?>"
                                                                        autocomplete="off" autofocus <?php
                                                                        if (!empty($dnibusqueda)) {
                                                                            echo '';
                                                                        }
                                                                        else if (!empty($_GET['id'])) {
                                                                            echo 'disabled';
                                                                        } else {
                                                                            echo "";
                                                                        }
                                                                        
                                                                        ?>>
                                                                        <div id="resultado" style="margin-left:230px; margin-top:-30px;"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Nombres</label>
                                                                    
                                                                    <div class="controls">
                                                                        <input  type="text" onkeypress="return soloLetras(event)" onkeyup="this.value=this.value.toUpperCase()" required="required" class=" form-control data"
                                                                          id="nombres" name="nombres" <?php if(!empty($_GET["id"])) :?> value="<?php echo $paciente->getNombre(); ?>" <?php endif; ?> autocomplete="off">
                                                                    </div>
                                                                </div>
                                                               
                                                                
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Apellido Paterno</label>
                                                                    <div class="controls">
                                                                        <input  type="text" onkeypress="return soloLetras(event)" onkeyup="this.value=this.value.toUpperCase()" required="required" class=" form-control data"
                                                                          id="appaterno" name="appaterno" <?php if(!empty($_GET["id"])) :?> value="<?php echo $paciente->getA_paterno(); ?>" <?php endif; ?> autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Apellido Materno</label>
                                                                     <div class="controls">
                                                                          <input  type="text" onkeypress="return soloLetras(event)" onkeyup="this.value=this.value.toUpperCase()" required="required" class="  form-control data"
                                                                           id="apmaterno" name="apmaterno" <?php if(!empty($_GET["id"])) :?> value="<?php echo $paciente->getA_materno(); ?>" <?php endif; ?> autocomplete="off">
                                                                     </div>
                                                                </div>
                                                                 <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Fecha de Nacimiento</label>
                                                                    <div class="controls">
                                                                        <input  type="date" class="form-control data" id="fecha_nacimiento" name="fecha_nacimiento" id="edad" max="<?php echo date("Y-m-d"); ?>"

                                                                               <?php if (!empty($_GET["id"])): ?> value="<?php
                                                                                   echo $paciente->getFecha_nacimiento();
                                                                               endif;
                                                                               ?>">
                                                                    </div>   
                                                                </div>

                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Edad</label>
                                                                    <div class="controls">
                                                                        <input  type="number" onkeypress="return soloNumeros(event)" required="required " class="form-control data" id="edad" name="edad" min="0" max="100" <?php if(!empty($_GET["id"])) :?> value="<?php echo $paciente->getEdad(); ?>" <?php endif; ?> autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                 
                                                                 <div class="control-group" style="margin-right:20px; margin-left:20px;">
                                                                    <label class="control-label">Sexo</label>
                                                                      <div class="controls form-inline">
                                                                            <label for="">
                                                                                <input  name="optionsRadio" id="optionsRadios3" value="0" checked type="radio" style="opacity: 1">
                                                                                <span class="lbl">
                                                                                    Masculino
                                                                                </span>
                                                                            </label>
                                                                            <label for="">
                                                                                <input  name="optionsRadio" id="optionsRadios4" value="1" type="radio" style="opacity: 1" <?php if(!empty($_GET["id"])) : if($paciente->getSexo() == 1):?> checked <?php endif; endif; ?> >
                                                                                <span class="lbl">
                                                                                    Femenino
                                                                                </span>
                                                                            </label>
                                                                    </div>
                                                                 </div>

                                                                 <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Direccion</label>
                                                                       <div class="controls">
                                                                                <input  type="text"  onkeyup="this.value=this.value.toUpperCase()" class=" form-control data"
                                                                                   name="direccion" id="direccion"  <?php if(!empty($_GET["id"])) :?> value="<?php echo $paciente->getDireccion(); ?>" <?php endif; ?> autocomplete="off">
                                                                       </div> 
                                                                </div>
                                                                
                                                            </div><!-- span6 -->
                                                            <div class="span6">                                                              
                                                                
                                                                 <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Departamento</label>
                                                                    <div class="controls">
                                                                          <select class="form-control " name="departamento" id="departamento">
                                                                            <?php if (count($departamentos)): ?>
                                                                                <option value="">Selecione un Departamento</option>
                                                                                <?php foreach ($departamentos as $departamento): ?>
                                                                                    <option value="<?php echo $departamento->departamento ?>" <?php if(!empty($_GET["id"])):if($departamento->departamento == $paciente->getdepartamento()): ?> selected <?php endif; endif; ?>>
                                                                                        <?php echo $departamento->departamento; ?>
                                                                                    </option>
                                                                                <?php endforeach; ?>
                                                                            <?php else : ?>
                                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                            <?php endif; ?>
                                                                          </select>
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Provincia</label>
                                                                    <div class="controls">
                                                                        <select class="form-control " name="provincia" id="provincia">
                                                                         <option <?php if(!empty($_GET["id"])) :?> value="<?php echo $paciente->getprovincia(); ?>" <?php endif; ?> >
                                                                            <?php if(!empty($_GET["id"])) :?> <?php echo $paciente->getprovincia(); ?><?php else: ?> <?php echo "Seleccione una Provincia"; ?> <?php endif; ?>
                                                                         </option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Distrito</label>
                                                                    <div class="controls">
                                                                       <select class="form-control " name="distrito" id="distrito">
                                                                        <option <?php if(!empty($_GET["id"])) :?> value="<?php echo $paciente->getdistrito(); ?>" <?php endif; ?>>
                                                                           <?php if(!empty($_GET["id"])) :?> <?php echo $paciente->getdistrito(); ?><?php else: ?> <?php echo "Seleccione un Distrito"; ?> <?php endif; ?>
                                                                        </option>
                                                                       </select>
                                                                    </div>
                                                                </div>
                                                               <div class="control-group" style="margin-right:20px; margin-left:20px;">
                                                                <label class="control-label">Ocupacion</label>
                                                                   <div class="controls">
                                                                           <select class="form-control chosen-select" name="grupo" id="grupo">
                                                                                <?php if (count($grupos)): ?>
                                                                                    <option value="">Seleccione</option>
                                                                                    <?php foreach ($grupos as $grupo): ?>
                                                                                        <option value="<?php echo $grupo->goc_id ?>" <?php if(!empty($_GET["id"])):if($grupo->goc_id == $paciente->getGoc_id()): ?> selected <?php endif; endif; ?>>
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
                                                                    <label class="control-label">Tipo de seguro</label>
                                                                    <div class="controls">
                                                                           <select class="form-control " name="tipo" id="tipo" required>
                                                                                <?php if (count($tipos)): ?>
                                                                                    <option value="">Seleccione</option>
                                                                                    <?php foreach ($tipos as $tipo): ?>
                                                                                        <option value="<?php echo $tipo->id_tipo_paciente ?>" <?php if(!empty($_GET["id"])):if($tipo->id_tipo_paciente == $paciente->getId_tipo_paciente()): ?> selected <?php endif; endif; ?>>
                                                                                            <?php echo $tipo->descripcion; ?>
                                                                                        </option>
                                                                                    <?php endforeach; ?>
                                                                                <?php else : ?>
                                                                                    <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                                <?php endif; ?>
                                                                            </select>
                                                                    </div>
                                                                </div>
                                                                <div class="control-group" id="tiposeguro" hidden style="margin-right:20px; margin-left:20px;">
                                                                    <label class="control-label">¿SIS es del HRL?</label>
                                                                    <div class="controls">
                                                                        <select class="form-control " name="sishrl" id="sishrl">
                                                                            <option <?php if(!empty($_GET["id"])) :?> value="<?php echo $paciente->getsishrl_paciente(); ?>" <?php endif; ?>>
                                                                                <?php if(!empty($_GET["id"])) :?> <?php echo $paciente->getsishrl_paciente(); ?><?php else: ?> <?php echo "Seleccione"; ?> <?php endif; ?>
                                                                            </option>
                                                                       </select>
                                                                    </div>
                                                                </div>
                                                                <div class="control-group" id="codigo_sis" hidden style="margin-right:20px; margin-left:20px;">
                                                                    <label class="control-label">Codigo SIS</label>
                                                                    <div class="controls">
                                                                        <input  type="text"  onkeyup="this.value=this.value.toUpperCase()" class=" form-control data"
                                                                            name="codigosis" id="codigosis" <?php if(!empty($_GET["id"])) :?> value="<?php echo $paciente->getcodigosis(); ?>" <?php endif; ?>  autocomplete="off">
                                                                    </div>
                                                                </div>
                                                            </div><!-- span6 -->
                                                        
                                                       </div><!-- span12 -->
                                                       <div class="space-6"></div>

                                                      <div class="span12 text-center">
                                                        
                                                            
                                                            <button type="submit" class="btn btn-primary"> <i class="fa-floppy-o icon-on-left bigger-110"></i>Guardar</button>
                                                            <a href="index.php?page=paciente&accion=form2" class="btn btn-danger"><i class="fa-times-circle icon-on-left bigger-110"></i>Cancelar</a>
                                                        
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
<div class="modalcarga" id="modalcarga"></div>
       
       
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
        <script src="view/js/validaciones.js"></script>
        <script src="view/js/personalizamensaje.js"></script>
        <script src="assets/js/chosen.jquery.js"></script>
        <script src="view/js/validardni.js"></script>        
        <script >
            $(function() {
                $('#datepicker').datepicker();
            });
            var config = {
                '.chosen-select'           : {},
                '.chosen-select-deselect'  : {allow_single_deselect:true},
                '.chosen-select-no-single' : {disable_search_threshold:10},
                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                '.chosen-select-width'     : {width:"1255%"}
            }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }
         </script>


    </body>
</html>