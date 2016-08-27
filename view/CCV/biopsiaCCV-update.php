<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        
        <title>Informacion de Biopsia</title>
        
        <link rel="shortcut icon" href="assets/img/micros.ico">

        <link href="assets/plugins/bootstrap/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/plugins/bootstrap/bootstrap-responsive.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/css/style.min.css" />
        <link rel="stylesheet" href="assets/css/style-responsive.min.css" />
        <link rel="stylesheet" href="assets/css/bootstrap-timepicker.css" />
        <link rel="stylesheet" href="assets/css/datepicker.css" />
        <link rel="stylesheet" type="text/css" href="assets/css/estiloscss.css">

        <link href="assets/css/chosen.css" rel="stylesheet">
        <!--fonts&iconos-->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
        <link rel="stylesheet" href="assets/font-awesome-4.3.0/css/font-awesome.css">
        <!--[if IE 7]>
        <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
        <![endif]-->
    
        <link rel="stylesheet" href="assets/css/font.css" />

        <script src="assets/js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript">
            $(document).on('ready', function() {
              $('#institucion').on('change', function() {
                  var dato=$('#institucion').val();
                    if (dato==29) {
                        $('#medicost').show(); 
                        $('#medicostr').hide();
                        $('#medicotr').removeAttr('required')               
                        
                    } else{
                        $('#medicostr').show(); 
                        $('#medicost').hide();   
                        document.getElementById('medicotr').value="";                        
                    }; 
              });

             var insts=$('#institucion').val();
             if (insts==29) {
                $('#medicost').show(); 
                $('#medicostr').hide();
             } else{
                $('#medicostr').show(); 
                $('#medicost').hide(); 
             };
             var medicotrat=$('#medicoop').val();
             if (medicotrat!='') {
                $('#medicosop').show();
                $('#admed').hide();
            } else{
                $('#medicosop').hide();
            };
             var estado=document.getElementById('estbio').value;
             if (estado==3) {
                $('#botones').hide();
             };

            });

        </script>

        <script>
            function mostrarmed(){
               $('#medicosop').show(); 
               $('#admed').hide();
            }
            function ocultarmed(){
               $('#medicosop').hide(); 
               document.getElementById('medicoop').value="";
               $('#admed').show();  

            }
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
                                <i class="fa fa-user-plus"></i>
                                <a href="#">Citologia Especial</a>

                                <span class="divider">
                                    <i class="icon-angle-right arrow-icon"></i>
                                </span>
                            </li>
                          
                            <li class="active">Informacion de Biopsia</li>
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
                                <h2 class="header smaller lighter blue">Informacion de Biopsia</h2>
                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h4><i class=" icon-user-md pink"></i>Datos de la Biopsia.</h4>                                        
                                    </div><!-- widget-header -->
                                    <div class="widget-body" id="registro" name="registro">
                                        <widget class="main">
                                            <div class="row-fluid ">
                                                <div class="space-18"></div>
                                                
                                                    <form class="form-horizontal"  action="index.php?page=biopsia&accion=modificarccv<?php if(!empty($_GET["id"])) :?>&id=<?php echo $_GET["id"]; endif; ?>" method="POST" enctype="multipart/form-data">
                                                       <div class="span12 ">
                                                           <div class="span6">
                                                               <div class="control-group " style="margin-right: 20px; margin-left: 20px;">
                                                                   <label class="control-label">DNI</label>
                                                                    <div class="controls">
                                                                        <input type="text"  readonly="true" required="required" style="width:80px;" class=" form-control" name="dni" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap->getDni(); ?>" <?php endif; ?> autocomplete="off" autofocus>
                                                                    </div>
                                                               </div>

                                                               <div class="control-group " style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Numero de Biopsia</label>
                                                                    <div class="controls">
                                                                        <input type="text" readonly="true" style="width:80px;" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap-> getNumBio(); ?>" <?php endif; ?> class=" form-control" name="numbio1" id="numbio1" autocomplete="off">
                                                                        <input type="hidden" class=" form-control" name="numerom" id="numerom" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap->getdiag(); ?>" <?php endif; ?> >

                                                                         <input type="hidden" class=" form-control" name="estbio" id="estbio" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap->getestadobiopsia(); ?>" <?php endif; ?> >                                                                        
                                                                    </div>
                                                                </div>
                                                                                                                  
                                                                <div class="control-group"  style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Institucion donde se opero</label>
                                                                     <div class="controls">
                                                                          <select required class="form-control chosen-select" style="width:250px;" name="institucion" id="institucion">
                                                                            <?php if (count($insts)): ?>
                                                                                <option value="">Seleccione una Institucion</option>
                                                                                <?php foreach ($insts as $inst): ?>
                                                                            <option value="<?php echo $inst->id_inst; ?>" <?php if(!empty($_GET["id"])):if($inst->id_inst == $biopsiap->getidinst()): ?> selected <?php endif; endif; ?>>
                                                                                        <?php echo $inst->descr_inst; ?>
                                                                                    </option>
                                                                                <?php endforeach; ?>
                                                                            <?php else : ?>
                                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                            <?php endif; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Servicio</label>
                                                                    <div class="controls">
                                                                          <select class="form-control chosen-select" style="width:250px;" name="servicio" id="servicio">
                                                                            <?php if (count($deps)): ?>
                                                                                <option value="">Seleccione un Servicio</option>
                                                                                <?php foreach ($deps as $dep): ?>
                                                                            <option value="<?php echo $dep->dep_id ?>" <?php if(!empty($_GET["id"])):if($dep->dep_id == $biopsiap->getdepid()): ?> selected <?php endif; endif; ?>>
                                                                                        <?php echo $dep->dep_descr; ?>
                                                                                    </option>
                                                                                <?php endforeach; ?>
                                                                            <?php else : ?>
                                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                            <?php endif; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="control-group" id="medicost" hidden style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Medico Tratante</label>
                                                                       <div class="controls">
                                                                          <select  class="form-control" style="width:250px;" name="medicot" id="medicot">
                                                                               <option <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap->getMedicoT(); ?>" <?php endif; ?>>
                                                                                <?php if(!empty($_GET["id"])) :?> <?php echo $biopsiap->getMedicoT(); ?><?php else: ?> <?php echo "Seleccione un Medico"; ?> <?php endif; ?>
                                                                               </option>
                                                                          </select>
                                                                          <button onclick="mostrarmed();" class="btn btn-minier btn-danger muestra" data-toggle="tooltip" title="Agregar otro medico" data-type="add" id="admed" name="admed" >+</button>
                                                                    </div>
                                                                </div>
                                                                <div class="control-group"  id="medicosop" hidden style="margin-right: 20px; margin-left: 20px;">
                                                                        <label class="control-label"></label>
                                                                        <div class="controls">
                                                                            <input type="text" style="width:235px;" onkeyup="this.value=this.value.toUpperCase()" onkeypress="return soloLetras(event)"  name="medicoop" id="medicoop" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap->getmedopc(); ?>" <?php endif; ?> class="form-control"/>
                                                                            <button onclick="ocultarmed();" class="btn btn-minier btn-danger muestra" data-type="remove" id="oculmed" name="oculmed">-</button>
                                                                        </div>
                                                                </div>                                                                
                                                                <div class="control-group"  id="medicostr" hidden style="margin-right: 20px; margin-left: 20px;">
                                                                        <label class="control-label">Medico Tratante:</label>
                                                                        <div class="controls">
                                                                            <input type="text" style="width:235px;" onkeyup="this.value=this.value.toUpperCase()" onkeypress="return soloLetras(event)"  name="medicotr" id="medicotr" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap-> getMedicoT(); ?>" <?php endif; ?> class="form-control" required />
                                                                        </div>
                                                                </div>
                                                                <div class="control-group" id="fechabio1" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Fecha de Biopsia </label>
                                                                    <div class="controls">
                                                                        <input  type="date" class="form-control" id="fecha_bio" style="width:235px;" name="fecha_bio"  max="<?php echo date("Y-m-d"); ?>" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap-> getFecha(); ?>" <?php endif; ?>>
                                                                        </span>
                                                                    </div>   
                                                                </div>

                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Fecha de Ingreso al Servicio</label>
                                                                    <div class="controls">
                                                                        <input type="date" class="form-control" readonly id="fecha_ingreso" name="fecha_ingreso" style="width:235px;" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap-> getFechaI(); ?>" <?php endif; ?>>
                                                                    </div>   
                                                                </div>

                                                                 <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Gestante</label>
                                                                    <div class="controls form-inline">
                                                                                <label for="">
                                                                                    <input name="gestante" id="optionsRadios3" value="0" checked type="radio" style="opacity: 1">
                                                                                    <span class="lbl">
                                                                                        Si
                                                                                    </span>
                                                                                </label>
                                                                                <label for="">
                                                                                    <input name="gestante" id="optionsRadios4" value="1" type="radio" style="opacity: 1" <?php if(!empty($_GET["id"])) : if($biopsiap->getestgesta() == 1):?> checked <?php endif; endif; ?>>
                                                                                    <span class="lbl">
                                                                                        No
                                                                                    </span>
                                                                                </label>
                                                                    </div>
                                                                </div>
                                                                 <div class="control-group"  style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Gesta</label>
                                                                    <div class="controls">
                                                                        <input type="text" class=" form-control" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap->getgesta(); ?>" <?php endif; ?> style="width:235px;" onkeypress="return soloNumeros(event)" name="gesta" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="control-group"  style="margin-right:20px; margin-left:20px;">
                                                                    <label class="control-label">Para</label>
                                                                   <div class="controls">
                                                                        <input type="text" maxlength="4" class=" form-control" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap->getpara(); ?>" <?php endif; ?> style="width:235px;" onkeypress="return soloNumeros(event)" name="para" autocomplete="off">
                                                                    </div> 
                                                                </div>

                                                            </div><!-- span6 -->

                                                            <div class="span6">
                                                               
                                                                
                                                                <div class="control-group" style="margin-right:20px; margin-left:20px;">
                                                                   <label class="control-label">Mac</label>
                                                                   <div class="controls">
                                                                        <input  type="text" onkeyup="this.value=this.value.toUpperCase()" class=" form-control" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap->getmac(); ?>" <?php endif; ?>  name="mac" style="width:235px;" autocomplete="off">
                                                                    </div> 
                                                                </div>

                                                                <div class="control-group" style="margin-right:20px; margin-left:20px;">
                                                                    <label class="control-label">Fur</label>
                                                                    <div class="controls">
                                                                        <input type="text" class=" form-control" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap->getfur(); ?>" <?php endif; ?>  onkeyup="this.value=this.value.toUpperCase()" name="fur" style="width:235px;" autocomplete="off">
                                                                    </div>
                                                               </div>

                                                               <div class="control-group" style="margin-right:20px; margin-left:20px;">
                                                                  <label class="control-label">PAP Anterior</label>
                                                                  <div class="controls">
                                                                      <input type="text" class=" form-control" onkeyup="this.value=this.value.toUpperCase()" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap->getpap(); ?>" <?php endif; ?>  name="pap" style="width:235px;" autocomplete="off">
                                                                  </div>  
                                                               </div>

                                                               <div class="control-group" style="margin-right:20px; margin-left:20px;">
                                                                    <label class="control-label">Muestra Remitida</label>
                                                                    <div class="controls">
                                                                       <select class="form-control " style="width:250px;" name="mremitida" id="mremitida">
                                                                                <?php if (count($biom)): ?>
                                                                                    <option value=-1>Seleccione...</option>
                                                                                    <?php foreach ($biom as $biopm): ?>
                                                                                        <option value="<?php echo $biopm->codigo;?>" <?php if(!empty($_GET["id"])):if($biopm->codigo == $biopsiap->getmuestra1()): ?> selected <?php endif; endif; ?>>
                                                                                            <?php echo $biopm->descr_muestra; ?>
                                                                                        </option>
                                                                                    <?php endforeach; ?>
                                                                                <?php else : ?>
                                                                                    <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                                <?php endif; ?>
                                                                       </select>
                                                                       <input type="hidden" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap->getidmue1(); ?>" <?php endif; ?> name="mues1" id="mues1" class="span7" >
                                                                    </div>
                                                               </div>

                                                               <div class="control-group" id="ltecs" style="margin-right:20px; margin-left:20px;">
                                                                    <label class="control-label">Procedencia de la Muestra</label>
                                                                        <div class="controls">
                                                                           <select data-toggle="tooltip" title="Seleccione procedencia de la muestra" class="form-control " style="width:250px;" name="tecnologo" id="tecnologo">
                                                                                <?php if (count($tecs)): ?>
                                                                                    <option value="">Seleccione</option>
                                                                                    <?php foreach ($tecs as $tecno): ?>
                                                                                        <option value="<?php echo $tecno->id_proc ?>" <?php if(!empty($_GET["id"])):if($tecno->id_proc == $biopsiap->getidproc()): ?> selected <?php endif; endif; ?> >
                                                                                            <?php echo $tecno->descr_proc; ?>
                                                                                        </option>
                                                                                    <?php endforeach; ?>
                                                                                <?php else : ?>
                                                                                    <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                                <?php endif; ?>
                                                                            </select>
                                                                        </div>
                                                                </div>

                                                                <div class="control-group" style="margin-right:20px; margin-left:20px;">
                                                                    <label class="control-label">Patologo Responsable</label>
                                                                        <div class="controls">
                                                                           <select class="form-control " style="width:250px;" name="patologo" id="patologo" required>
                                                                                <?php if (count($pats)): ?>
                                                                                    <option value="">Seleccione</option>
                                                                                    <?php foreach ($pats as $pat): ?>
                                                                                        <option value="<?php echo $pat->emp_id ?>" <?php if(!empty($_GET["id"])):if($pat->emp_id == $biopsiap->getPatog()): ?> selected <?php endif; endif; ?> >
                                                                                            <?php echo $pat->nombre; ?>
                                                                                        </option>
                                                                                    <?php endforeach; ?>
                                                                                <?php else : ?>
                                                                                    <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                                <?php endif; ?>
                                                                            </select>
                                                                        </div>
                                                                </div>
                                                                <div class="control-group" style="margin-right:20px; margin-left:20px;">
                                                                        <label class="control-label">Diagnostico Clinico</label>
                                                                            <div class="controls">
                                                                                  <textarea class="span12" style="width:250px;" onkeyup="this.value=this.value.toUpperCase()" id="form-field-8" name="diagnosticoc" ><?php if(!empty($_GET["id"])) :?><?php echo $biopsiap->getDiagClinico() ?><?php endif; ?></textarea>  
                                                                            </div>
                                                                </div>
                                                                <div class="control-group" style="margin-right:20px; margin-left:20px;">
                                                                        <label class="control-label">Observacion</label>
                                                                            <div class="controls">
                                                                                  <textarea class="span12" style="width:250px;" onkeyup="this.value=this.value.toUpperCase()" id="form-field-8" name="observacion"><?php if(!empty($_GET["id"])) :?><?php echo $biopsiap->getObs() ?><?php endif; ?></textarea>  
                                                                            </div>
                                                                </div>

                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                   <label class="control-label">Pago del paciente</label>
                                                                    <div class="controls">
                                                                        <input type="number" style="width:235px;" min="0" max="500" onkeypress="return soloNumeros(event)" class=" form-control" name="pago" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap->getPago(); ?>" <?php endif; ?> autocomplete="off">
                                                                        </span>
                                                                    </div>
                                                               </div>
                                                                                                                                                                                      
                                                               
                                                                
                                                            </div><!-- span6 -->
                                                            
                                                       </div><!-- span12 -->
                                                       <div class="space-6"></div>

                                                      <div id="botones" class="span12 text-center">
                                                        
                                                            <button type="submit" class="btn btn-primary"> <i class="fa-floppy-o icon-on-left bigger-130"></i>Guardar</button>
                                                            <a href="index.php?page=biopsiaCCV&accion=listar" class="btn btn-danger"><i class="fa-times-circle icon-on-left bigger-130"></i>Cancelar</a>
                                                        
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

        <!--ace scripts-->

        <script src="assets/js/style-elements.min.js"></script>
        <script src="assets/js/style.min.js"></script>
        <script src="assets/js/jquery.gritter.min.js"></script>
        <script type="assets/js/bootstrap.datepicker.js"></script>
        <script src="assets/js/date-time/bootstrap-datepicker.min.js"></script>
        <script src="view/js/toparea.js"></script>
        <script src="view/js/validaciones.js"></script>
        <script src="assets/js/chosen.jquery.js"></script>
        <script src="view/js/mensajebiopsia.js"></script>
        <!--inline scripts related to this page-->
        
        <script type="text/javascript">
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