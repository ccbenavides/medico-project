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

             var nummue=document.getElementById('numerom').value;
             
             if (nummue==1) {
                $('#divmuestra1').show();
             }else if (nummue==2) {
                $('#divmuestra1').show();
                $('#divmuestra2').show();
             }else if (nummue==3) {
                $('#divmuestra1').show();
                $('#divmuestra2').show();
                $('#divmuestra3').show();
             }else if (nummue==4) {
                $('#divmuestra1').show();
                $('#divmuestra2').show();
                $('#divmuestra3').show();
                $('#divmuestra4').show();
             }else if (nummue==5) {
                $('#divmuestra1').show();
                $('#divmuestra2').show();
                $('#divmuestra3').show();
                $('#divmuestra4').show();
                $('#divmuestra5').show();
             }else if (nummue==6) {
                $('#divmuestra1').show();
                $('#divmuestra2').show();
                $('#divmuestra3').show();
                $('#divmuestra4').show();
                $('#divmuestra5').show();
                $('#divmuestra6').show();
             }else if (nummue==7) {
                $('#divmuestra1').show();
                $('#divmuestra2').show();
                $('#divmuestra3').show();
                $('#divmuestra4').show();
                $('#divmuestra5').show();
                $('#divmuestra6').show();
                $('#divmuestra7').show();
             }else if (nummue==8) {
                $('#divmuestra1').show();
                $('#divmuestra2').show();
                $('#divmuestra3').show();
                $('#divmuestra4').show();
                $('#divmuestra5').show();
                $('#divmuestra6').show();
                $('#divmuestra7').show();
                $('#divmuestra8').show();
             }else if (nummue==9) {
                $('#divmuestra1').show();
                $('#divmuestra2').show();
                $('#divmuestra3').show();
                $('#divmuestra4').show();
                $('#divmuestra5').show();
                $('#divmuestra6').show();
                $('#divmuestra7').show();
                $('#divmuestra8').show();
                $('#divmuestra9').show();
             }else if (nummue==10) {
                $('#divmuestra1').show();
                $('#divmuestra2').show();
                $('#divmuestra3').show();
                $('#divmuestra4').show();
                $('#divmuestra5').show();
                $('#divmuestra6').show();
                $('#divmuestra7').show();
                $('#divmuestra8').show();
                $('#divmuestra9').show();
                $('#divmuestra10').show();
             }else if (nummue==11) {
                $('#divmuestra1').show();
                $('#divmuestra2').show();
                $('#divmuestra3').show();
                $('#divmuestra4').show();
                $('#divmuestra5').show();
                $('#divmuestra6').show();
                $('#divmuestra7').show();
                $('#divmuestra8').show();
                $('#divmuestra9').show();
                $('#divmuestra10').show();
                $('#divmuestra11').show();
             }else if (nummue==12) {
                $('#divmuestra1').show();
                $('#divmuestra2').show();
                $('#divmuestra3').show();
                $('#divmuestra4').show();
                $('#divmuestra5').show();
                $('#divmuestra6').show();
                $('#divmuestra7').show();
                $('#divmuestra8').show();
                $('#divmuestra9').show();
                $('#divmuestra10').show();
                $('#divmuestra11').show();
                $('#divmuestra12').show();
             }else if (nummue==13) {
                $('#divmuestra1').show();
                $('#divmuestra2').show();
                $('#divmuestra3').show();
                $('#divmuestra4').show();
                $('#divmuestra5').show();
                $('#divmuestra6').show();
                $('#divmuestra7').show();
                $('#divmuestra8').show();
                $('#divmuestra9').show();
                $('#divmuestra10').show();
                $('#divmuestra11').show();
                $('#divmuestra12').show();
                $('#divmuestra13').show();                
             }else if (nummue==14) {
                $('#divmuestra1').show();
                $('#divmuestra2').show();
                $('#divmuestra3').show();
                $('#divmuestra4').show();
                $('#divmuestra5').show();
                $('#divmuestra6').show();
                $('#divmuestra7').show();
                $('#divmuestra8').show();
                $('#divmuestra9').show();
                $('#divmuestra10').show();
                $('#divmuestra11').show();
                $('#divmuestra12').show();
                $('#divmuestra13').show(); 
                $('#divmuestra14').show();                
             }else if (nummue==15) {
                $('#divmuestra1').show();
                $('#divmuestra2').show();
                $('#divmuestra3').show();
                $('#divmuestra4').show();
                $('#divmuestra5').show();
                $('#divmuestra6').show();
                $('#divmuestra7').show();
                $('#divmuestra8').show();
                $('#divmuestra9').show();
                $('#divmuestra10').show();
                $('#divmuestra11').show();
                $('#divmuestra12').show();
                $('#divmuestra13').show(); 
                $('#divmuestra14').show(); 
                $('#divmuestra15').show();                
             }else if (nummue==16) {
                $('#divmuestra1').show();
                $('#divmuestra2').show();
                $('#divmuestra3').show();
                $('#divmuestra4').show();
                $('#divmuestra5').show();
                $('#divmuestra6').show();
                $('#divmuestra7').show();
                $('#divmuestra8').show();
                $('#divmuestra9').show();
                $('#divmuestra10').show();
                $('#divmuestra11').show();
                $('#divmuestra12').show();
                $('#divmuestra13').show(); 
                $('#divmuestra14').show(); 
                $('#divmuestra15').show();
                $('#divmuestra16').show();                
             }else if (nummue==17) {
                $('#divmuestra1').show();
                $('#divmuestra2').show();
                $('#divmuestra3').show();
                $('#divmuestra4').show();
                $('#divmuestra5').show();
                $('#divmuestra6').show();
                $('#divmuestra7').show();
                $('#divmuestra8').show();
                $('#divmuestra9').show();
                $('#divmuestra10').show();
                $('#divmuestra11').show();
                $('#divmuestra12').show();
                $('#divmuestra13').show(); 
                $('#divmuestra14').show(); 
                $('#divmuestra15').show();
                $('#divmuestra16').show();
                $('#divmuestra17').show();                 
             }else if (nummue==18) {
                $('#divmuestra1').show();
                $('#divmuestra2').show();
                $('#divmuestra3').show();
                $('#divmuestra4').show();
                $('#divmuestra5').show();
                $('#divmuestra6').show();
                $('#divmuestra7').show();
                $('#divmuestra8').show();
                $('#divmuestra9').show();
                $('#divmuestra10').show();
                $('#divmuestra11').show();
                $('#divmuestra12').show();
                $('#divmuestra13').show(); 
                $('#divmuestra14').show(); 
                $('#divmuestra15').show();
                $('#divmuestra16').show();
                $('#divmuestra17').show();  
                $('#divmuestra18').show();                
             }else if (nummue==19) {
                $('#divmuestra1').show();
                $('#divmuestra2').show();
                $('#divmuestra3').show();
                $('#divmuestra4').show();
                $('#divmuestra5').show();
                $('#divmuestra6').show();
                $('#divmuestra7').show();
                $('#divmuestra8').show();
                $('#divmuestra9').show();
                $('#divmuestra10').show();
                $('#divmuestra11').show();
                $('#divmuestra12').show();
                $('#divmuestra13').show(); 
                $('#divmuestra14').show(); 
                $('#divmuestra15').show();
                $('#divmuestra16').show();
                $('#divmuestra17').show();  
                $('#divmuestra18').show();  
                $('#divmuestra19').show();               
             }else if (nummue==20) {
                $('#divmuestra1').show();
                $('#divmuestra2').show();
                $('#divmuestra3').show();
                $('#divmuestra4').show();
                $('#divmuestra5').show();
                $('#divmuestra6').show();
                $('#divmuestra7').show();
                $('#divmuestra8').show();
                $('#divmuestra9').show();
                $('#divmuestra10').show();
                $('#divmuestra11').show();
                $('#divmuestra12').show();
                $('#divmuestra13').show(); 
                $('#divmuestra14').show(); 
                $('#divmuestra15').show();
                $('#divmuestra16').show();
                $('#divmuestra17').show();  
                $('#divmuestra18').show();  
                $('#divmuestra19').show(); 
                $('#divmuestra20').show();               
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
                                <a href="#">Patologia Quirurgica</a>

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
                                                
                                                    <form class="form-horizontal"  action="index.php?page=biopsia&accion=modificarpq<?php if(!empty($_GET["id"])) :?>&id=<?php echo $_GET["id"]; endif; ?>" method="POST" enctype="multipart/form-data">
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

                                                               <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Topografia</label>
                                                                    <div class="controls">
                                                                          <select class="form-control chosen-select" style="width:250px;" name="topografia" id="topografia"  required>
                                                                            <?php if (count($topografias)): ?>
                                                                                <option value="">Seleccione una Topografia</option>
                                                                                <?php foreach ($topografias as $topo): ?>
                                                                            <option value="<?php echo $topo->id_top ?>" <?php if(!empty($_GET["id"])):if($topo->id_top == $biopsiap->gettopg()): ?> selected <?php endif; endif; ?>>
                                                                                        <?php echo $topo->descr_top; ?>
                                                                                    </option>
                                                                                <?php endforeach; ?>
                                                                            <?php else : ?>
                                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                            <?php endif; ?>
                                                                        </select>
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
                                                                            <input type="text" style="width:235px;" onkeyup="this.value=this.value.toUpperCase()" onkeypress="return soloLetras(event)"  name="medicotr" id="medicotr" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap-> getMedicoT(); ?>" <?php endif; ?> class="form-control" />
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
                                                                                                                      
                                                                <div class="control-group" id="divmuestra1" style="margin-right: 20px; margin-left: 20px;">
                                                                        <label class="control-label" for="form-field-2">Muestra 1 </label>
                                                                            <div class="controls">
                                                                                <select  class="form-control chosen-select" name="desmues1" id="desmues1" data-nmuestra="1" >
                                                                                    <?php if (count($biom)): ?>
                                                                                <option value="">Seleccione una Muestra</option>
                                                                                        <?php foreach ($biom as $muestra): ?>
                                                                                    <option value="<?php echo $muestra->codigo; ?>" <?php if(!empty($_GET["id"])):if($muestra->codigo == $biopsiap->getmuestra1()): ?> selected <?php endif; endif; ?>>
                                                                                        <?php echo $muestra->descr_muestra; ?>
                                                                                    </option>
                                                                                    <?php endforeach; ?>
                                                                                <?php else : ?>
                                                                                    <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                                <?php endif; ?>
                                                                                </select>
                                                                                </span>
                                                                                <input type="hidden" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap-> getidmue1(); ?>" <?php endif; ?> name="mues1" id="mues1" class="span7" >
                                                                                <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="1" id="add1" >+</button>
                                                                                <!-- <button class="btn btn-minier btn-purple cie" data-type="remove" id="removercie2" >-</button> -->
                                                                            </div>
                                                                </div>
                                                                        <div class="control-group" id="divmuestra3" hidden style="margin-right:20px; margin-left:20px;" >
                                                                            <label class="control-label" form="form-field-2">Muestra 3 </label>
                                                                            <div class="controls">
                                                                                    <select class="form-control chosen-select" style="width:100px;" name="desmues3" id="desmues3" data-nmuestra="3">
                                                                                        <?php if (count($biom)): ?>
                                                                                <option value="">Seleccione una Muestra</option>
                                                                                        <?php foreach ($biom as $muestra): ?>
                                                                                    <option value="<?php echo $muestra->codigo; ?>" <?php if(!empty($_GET["id"])):if($muestra->codigo == $biopsiap->getmuestra3()): ?> selected <?php endif; endif; ?>>
                                                                                        <?php echo $muestra->descr_muestra; ?>
                                                                                    </option>
                                                                                    <?php endforeach; ?>
                                                                                <?php else : ?>
                                                                                    <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                                <?php endif; ?>
                                                                                    </select>
                                                                                    <input type="hidden" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap-> getidmue3(); ?>" <?php endif; ?> name="mues3" id="mues3" class="span7" >
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="3" id="add3" >+</button>
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="3" id="remove3">-</button>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="control-group" id="divmuestra5" hidden style="margin-right:20px; margin-left:20px;" >
                                                                            <label class="control-label" form="form-field-2">Muestra 5 </label>
                                                                            <div class="controls">
                                                                                     <select class="form-control chosen-select" style="width:100px;" name="desmues5" id="desmues5" data-nmuestra="5">
                                                                                        <?php if (count($biom)): ?>
                                                                                <option value="">Seleccione una Muestra</option>
                                                                                        <?php foreach ($biom as $muestra): ?>
                                                                                    <option value="<?php echo $muestra->codigo; ?>" <?php if(!empty($_GET["id"])):if($muestra->codigo == $biopsiap->getmuestra5()): ?> selected <?php endif; endif; ?>> 
                                                                                        <?php echo $muestra->descr_muestra; ?>
                                                                                    </option>
                                                                                    <?php endforeach; ?>
                                                                                <?php else : ?>
                                                                                    <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                                <?php endif; ?>
                                                                                    </select>
                                                                                    <input type="hidden" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap-> getidmue5(); ?>" <?php endif; ?> name="mues5" id="mues5" class="span7" >
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="5" id="add5" >+</button>
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="5" id="remove5">-</button>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="control-group" id="divmuestra7" hidden style="margin-right:20px; margin-left:20px;" >
                                                                            <label class="control-label" form="form-field-2">Muestra 7 </label>
                                                                            <div class="controls">
                                                                                    <select class="form-control chosen-select" style="width:100px;" name="desmues7" id="desmues7" data-nmuestra="7">
                                                                                        <?php if (count($biom)): ?>
                                                                                <option value="">Seleccione una Muestra</option>
                                                                                        <?php foreach ($biom as $muestra): ?>
                                                                                    <option value="<?php echo $muestra->codigo; ?>" <?php if(!empty($_GET["id"])):if($muestra->codigo == $biopsiap->getmuestra7()): ?> selected <?php endif; endif; ?>>
                                                                                        <?php echo $muestra->descr_muestra; ?>
                                                                                    </option>
                                                                                    <?php endforeach; ?>
                                                                                <?php else : ?>
                                                                                    <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                                <?php endif; ?>
                                                                                    </select>
                                                                                    <input type="hidden" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap-> getidmue7(); ?>" <?php endif; ?> name="mues7" id="mues7" class="span7" >
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="7" id="add7" >+</button>
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="7" id="remove7">-</button>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="control-group" id="divmuestra9" hidden style="margin-right:20px; margin-left:20px;" >
                                                                            <label class="control-label" form="form-field-2">Muestra 9 </label>
                                                                            <div class="controls">
                                                                                    <select class="form-control chosen-select" style="width:100px;" name="desmues9" id="desmues9" data-nmuestra="9">
                                                                                        <?php if (count($biom)): ?>
                                                                                <option value="">Seleccione una Muestra</option>
                                                                                        <?php foreach ($biom as $muestra): ?>
                                                                                    <option value="<?php echo $muestra->codigo; ?>" <?php if(!empty($_GET["id"])):if($muestra->codigo == $biopsiap->getmuestra9()): ?> selected <?php endif; endif; ?>>
                                                                                        <?php echo $muestra->descr_muestra; ?>
                                                                                    </option>
                                                                                    <?php endforeach; ?>
                                                                                <?php else : ?>
                                                                                    <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                                <?php endif; ?>
                                                                                    </select>
                                                                                    <input type="hidden" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap-> getidmue9(); ?>" <?php endif; ?> name="mues9" id="mues9" class="span7" >
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="9" id="add9" >+</button>
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="9" id="remove9">-</button>
                                                                            </div>
                                                                        </div>
                                                                         <div class="control-group" id="divmuestra11" hidden style=" margin-top:20px; margin-right:20px; margin-left:20px;" >
                                                                            <label class="control-label" form="form-field-2">Muestra 11 </label>
                                                                            <div class="controls">
                                                                                    <select class="form-control chosen-select" style="width:100px;" name="desmues11" id="desmues11" data-nmuestra="11">
                                                                                        <?php if (count($biom)): ?>
                                                                                <option value="">Seleccione una Muestra</option>
                                                                                        <?php foreach ($biom as $muestra): ?>
                                                                                    <option value="<?php echo $muestra->codigo; ?>" <?php if(!empty($_GET["id"])):if($muestra->codigo == $biopsiap->getmuestra11()): ?> selected <?php endif; endif; ?>>
                                                                                        <?php echo $muestra->descr_muestra; ?>
                                                                                    </option>
                                                                                    <?php endforeach; ?>
                                                                                <?php else : ?>
                                                                                    <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                                <?php endif; ?>
                                                                                    </select>
                                                                                    <input type="hidden" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap-> getidmue11(); ?>" <?php endif; ?> name="mues11" id="mues11" class="span7" >
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="11" id="add11" >+</button>
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="11" id="remove11">-</button>
                                                                            </div>
                                                                        </div>
                                                                         <div class="control-group" id="divmuestra13" hidden style="margin-right:20px; margin-left:20px;" >
                                                                            <label class="control-label" form="form-field-2">Muestra 13 </label>
                                                                            <div class="controls">
                                                                                    <select class="form-control chosen-select" style="width:100px;" name="desmues13" id="desmues13" data-nmuestra="13">
                                                                                        <?php if (count($biom)): ?>
                                                                                <option value="">Seleccione una Muestra</option>
                                                                                        <?php foreach ($biom as $muestra): ?>
                                                                                    <option value="<?php echo $muestra->codigo; ?>" <?php if(!empty($_GET["id"])):if($muestra->codigo == $biopsiap->getmuestra13()): ?> selected <?php endif; endif; ?>>
                                                                                        <?php echo $muestra->descr_muestra; ?>
                                                                                    </option>
                                                                                    <?php endforeach; ?>
                                                                                <?php else : ?>
                                                                                    <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                                <?php endif; ?>
                                                                                    </select>
                                                                                    <input type="hidden" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap-> getidmue13(); ?>" <?php endif; ?> name="mues13" id="mues13" class="span7" >
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="13" id="add13" >+</button>
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="13" id="remove13">-</button>
                                                                            </div>
                                                                        </div>
                                                                        <div class="control-group" id="divmuestra15" hidden style="margin-right:20px; margin-left:20px;" >
                                                                            <label class="control-label" form="form-field-2">Muestra 15 </label>
                                                                            <div class="controls">
                                                                                    <select class="form-control chosen-select" style="width:100px;" name="desmues15" id="desmues15" data-nmuestra="15">
                                                                                        <?php if (count($biom)): ?>
                                                                                <option value="">Seleccione una Muestra</option>
                                                                                        <?php foreach ($biom as $muestra): ?>
                                                                                    <option value="<?php echo $muestra->codigo; ?>" <?php if(!empty($_GET["id"])):if($muestra->codigo == $biopsiap->getmuestra15()): ?> selected <?php endif; endif; ?>>
                                                                                        <?php echo $muestra->descr_muestra; ?>
                                                                                    </option>
                                                                                    <?php endforeach; ?>
                                                                                <?php else : ?>
                                                                                    <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                                <?php endif; ?>
                                                                                    </select>
                                                                                    <input type="hidden" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap-> getidmue15(); ?>" <?php endif; ?> name="mues15" id="mues15" class="span7" >
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="15" id="add15" >+</button>
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="15" id="remove15">-</button>
                                                                            </div>
                                                                        </div>
                                                                        <div class="control-group" id="divmuestra17" hidden style="margin-right:20px; margin-left:20px;" >
                                                                            <label class="control-label" form="form-field-2">Muestra 17 </label>
                                                                            <div class="controls">
                                                                                    <select class="form-control chosen-select" style="width:100px;" name="desmues17" id="desmues17" data-nmuestra="17">
                                                                                        <?php if (count($biom)): ?>
                                                                                <option value="">Seleccione una Muestra</option>
                                                                                        <?php foreach ($biom as $muestra): ?>
                                                                                    <option value="<?php echo $muestra->codigo; ?>" <?php if(!empty($_GET["id"])):if($muestra->codigo == $biopsiap->getmuestra17()): ?> selected <?php endif; endif; ?>>
                                                                                        <?php echo $muestra->descr_muestra; ?>
                                                                                    </option>
                                                                                    <?php endforeach; ?>
                                                                                <?php else : ?>
                                                                                    <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                                <?php endif; ?>
                                                                                    </select>
                                                                                   <input type="hidden" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap-> getidmue17(); ?>" <?php endif; ?> name="mues17" id="mues17" class="span7" >
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="17" id="add17" >+</button>
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="17" id="remove17">-</button>
                                                                            </div>
                                                                        </div>
                                                                        <div class="control-group" id="divmuestra19" hidden style="margin-right:20px; margin-left:20px;" >
                                                                            <label class="control-label" form="form-field-2">Muestra 19 </label>
                                                                            <div class="controls">
                                                                                    <select class="form-control chosen-select" style="width:100px;" name="desmues19" id="desmues19" data-nmuestra="19">
                                                                                        <?php if (count($biom)): ?>
                                                                                <option value="">Seleccione una Muestra</option>
                                                                                        <?php foreach ($biom as $muestra): ?>
                                                                                    <option value="<?php echo $muestra->codigo; ?>" <?php if(!empty($_GET["id"])):if($muestra->codigo == $biopsiap->getmuestra19()): ?> selected <?php endif; endif; ?>>
                                                                                        <?php echo $muestra->descr_muestra; ?>
                                                                                    </option>
                                                                                    <?php endforeach; ?>
                                                                                <?php else : ?>
                                                                                    <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                                <?php endif; ?>
                                                                                    </select>
                                                                                    <input type="hidden" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap-> getidmue19(); ?>" <?php endif; ?> name="mues19" id="mues19" class="span7" >
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="19" id="add19" >+</button>
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="19" id="remove19">-</button>
                                                                            </div>
                                                                        </div>                                                                      
                                                                
                                                            </div><!-- span6 -->

                                                            <div class="span6">
                                                               
                                                               
                                                               <div class="control-group" id="tipoestudio" style="margin-right:20px; margin-left:20px;">
                                                                    <label class="control-label">Tipo de Estudio</label>
                                                                        <div class="controls">
                                                                           <select class="form-control " name="tipo" id="tipo" >
                                                                                <?php if (count($biosp)): ?>
                                                                                    <option value="">Seleccione...</option>
                                                                                    <?php foreach ($biosp as $biop): ?>
                                                                                        <option value="<?php echo $biop->codigo?>" <?php if(!empty($_GET["id"])):if($biop->codigo == $biopsiap->gettipoest()): ?> selected <?php endif; endif; ?>>
                                                                                            <?php echo $biop->tipo; ?>
                                                                                        </option>
                                                                                    <?php endforeach; ?>
                                                                                <?php else : ?>
                                                                                    <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                                <?php endif; ?>
                                                                            </select>
                                                                        </div>
                                                               </div>                                                              
                                                                
                                                                <div class="control-group" id="bioxcong" style="margin-right: 20px; margin-left: 20px;" >
                                                                        <label class="control-label">Biopsia por Congelacion</label>
                                                                          <div class="controls form-inline">
                                                                                <label for="">
                                                                                    <input name="optionsRadio" id="optionsRadios3" value="0"  checked type="radio" style="opacity: 1">
                                                                                    <span class="lbl">
                                                                                        Si
                                                                                    </span>
                                                                                </label>
                                                                                <label for="">
                                                                                    <input name="optionsRadio" id="optionsRadios4" value="1" type="radio" style="opacity: 1" <?php if(!empty($_GET["id"])) : if($biopsiap->getBioC() == 1):?> checked <?php endif; endif; ?>>
                                                                                    <span class="lbl">
                                                                                        No
                                                                                    </span>
                                                                                </label>
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
                                                                        <input type="number" style="width:235px;" min="0" max="500" onkeypress="return soloNumeros(event)" class=" form-control" name="pago" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap-> getPago(); ?>" <?php endif; ?> autocomplete="off">
                                                                        </span>
                                                                    </div>
                                                               </div>
                                                                 <div class="control-group" id="divmuestra2" hidden style="margin-right:20px; margin-left:20px;margin-top:65px;" >
                                                                        <label class="control-label" for="form-field-2">Muestra 2 </label>

                                                                            <div class="controls">
                                                                                <select class="form-control chosen-select" style="width:100px;" name="desmues2" id="desmues2" data-nmuestra="2">
                                                                                        <?php if (count($biom)): ?>
                                                                                <option value="">Seleccione una Muestra</option>
                                                                                        <?php foreach ($biom as $muestra): ?>
                                                                                    <option value="<?php echo $muestra->codigo; ?>" <?php if(!empty($_GET["id"])):if($muestra->codigo == $biopsiap->getmuestra2()): ?> selected <?php endif; endif; ?>>
                                                                                        <?php echo $muestra->descr_muestra; ?>
                                                                                    </option>
                                                                                    <?php endforeach; ?>
                                                                                <?php else : ?>
                                                                                    <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                                <?php endif; ?>
                                                                                </select>
                                                                                <input type="hidden" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap-> getidmue2(); ?>" <?php endif; ?> name="mues2" id="mues2" class="span7" >
                                                                                <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="2" id="add2" >+</button>
                                                                                <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="2" id="remove2">-</button>
                                                                            </div>
                                                                </div>
                                                                <div class="control-group" id="divmuestra4" hidden style="margin-right:20px; margin-left:20px;" >
                                                                            <label class="control-label" form="form-field-2">Muestra 4 </label>
                                                                            <div class="controls">
                                                                                    <select class="form-control chosen-select" style="width:100px;" name="desmues4" id="desmues4" data-nmuestra="4">
                                                                                        <?php if (count($biom)): ?>
                                                                                <option value="">Seleccione una Muestra</option>
                                                                                        <?php foreach ($biom as $muestra): ?>
                                                                                    <option value="<?php echo $muestra->codigo; ?>" <?php if(!empty($_GET["id"])):if($muestra->codigo == $biopsiap->getmuestra4()): ?> selected <?php endif; endif; ?>>
                                                                                        <?php echo $muestra->descr_muestra; ?>
                                                                                    </option>
                                                                                    <?php endforeach; ?>
                                                                                <?php else : ?>
                                                                                    <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                                <?php endif; ?>
                                                                                    </select>
                                                                                   <input type="hidden" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap-> getidmue4(); ?>" <?php endif; ?> name="mues4" id="mues4" class="span7" >
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="4" id="add4" >+</button>
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="4" id="remove4">-</button>
                                                                            </div>
                                                                </div>
                                                                <div class="control-group" id="divmuestra6" hidden style="margin-right:20px; margin-left:20px;" >
                                                                            <label class="control-label" form="form-field-2">Muestra 6 </label>
                                                                            <div class="controls">
                                                                                <select class="form-control chosen-select" style="width:100px;" name="desmues6" id="desmues6" data-nmuestra="6">
                                                                                        <?php if (count($biom)): ?>
                                                                                <option value="">Seleccione una Muestra</option>
                                                                                        <?php foreach ($biom as $muestra): ?>
                                                                                    <option value="<?php echo $muestra->codigo; ?>" <?php if(!empty($_GET["id"])):if($muestra->codigo == $biopsiap->getmuestra6()): ?> selected <?php endif; endif; ?>>
                                                                                        <?php echo $muestra->descr_muestra; ?>
                                                                                    </option>
                                                                                    <?php endforeach; ?>
                                                                                <?php else : ?>
                                                                                    <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                                <?php endif; ?>
                                                                                </select>
                                                                                   <input type="hidden" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap-> getidmue6(); ?>" <?php endif; ?> name="mues6" id="mues6" class="span7" >
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="6" id="add6" >+</button>
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="6" id="remove6">-</button>
                                                                            </div>
                                                                </div>
                                                                <div class="control-group" id="divmuestra8" hidden style="margin-right:20px; margin-left:20px;" >
                                                                            <label class="control-label" form="form-field-2">Muestra 8 </label>
                                                                            <div class="controls">
                                                                                    <select class="form-control chosen-select" style="width:100px;" name="desmues8" id="desmues8" data-nmuestra="8">
                                                                                        <?php if (count($biom)): ?>
                                                                                <option value="">Seleccione una Muestra</option>
                                                                                        <?php foreach ($biom as $muestra): ?>
                                                                                    <option value="<?php echo $muestra->codigo; ?>" <?php if(!empty($_GET["id"])):if($muestra->codigo == $biopsiap->getmuestra8()): ?> selected <?php endif; endif; ?>>
                                                                                        <?php echo $muestra->descr_muestra; ?>
                                                                                    </option>
                                                                                    <?php endforeach; ?>
                                                                                <?php else : ?>
                                                                                    <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                                <?php endif; ?>
                                                                                    </select>
                                                                                    <input type="hidden" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap-> getidmue8(); ?>" <?php endif; ?> name="mues8" id="mues8" class="span7" >
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="8" id="add8" >+</button>
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="8" id="remove8">-</button>
                                                                            </div>
                                                                </div>
                                                                 <div class="control-group" id="divmuestra10" hidden style="margin-right:20px; margin-left:20px;" >
                                                                            <label class="control-label" form="form-field-2">Muestra 10 </label>
                                                                            <div class="controls">
                                                                                    <select class="form-control chosen-select" style="width:100px;" name="desmues10" id="desmues10" data-nmuestra="10">
                                                                                        <?php if (count($biom)): ?>
                                                                                <option value="">Seleccione una Muestra</option>
                                                                                        <?php foreach ($biom as $muestra): ?>
                                                                                    <option value="<?php echo $muestra->codigo; ?>" <?php if(!empty($_GET["id"])):if($muestra->codigo == $biopsiap->getmuestra10()): ?> selected <?php endif; endif; ?>>
                                                                                        <?php echo $muestra->descr_muestra; ?>
                                                                                    </option>
                                                                                    <?php endforeach; ?>
                                                                                <?php else : ?>
                                                                                    <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                                <?php endif; ?>
                                                                                    </select>
                                                                                    <input type="hidden" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap-> getidmue10(); ?>" <?php endif; ?> name="mues10" id="mues10" class="span7" >
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="10" id="add10" >+</button>
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="10" id="remove10">-</button>
                                                                            </div>
                                                                </div>
                                                               
                                                                        <div class="control-group" id="divmuestra12" hidden style="margin-right:20px; margin-left:20px;" >
                                                                            <label class="control-label" form="form-field-2">Muestra 12 </label>
                                                                            <div class="controls">
                                                                                    <select class="form-control chosen-select" style="width:100px;" name="desmues12" id="desmues12" data-nmuestra="12">
                                                                                        <?php if (count($biom)): ?>
                                                                                <option value="">Seleccione una Muestra</option>
                                                                                        <?php foreach ($biom as $muestra): ?>
                                                                                    <option value="<?php echo $muestra->codigo; ?>" <?php if(!empty($_GET["id"])):if($muestra->codigo == $biopsiap->getmuestra12()): ?> selected <?php endif; endif; ?>>
                                                                                        <?php echo $muestra->descr_muestra; ?>
                                                                                    </option>
                                                                                    <?php endforeach; ?>
                                                                                <?php else : ?>
                                                                                    <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                                <?php endif; ?>
                                                                                    </select>
                                                                                   <input type="hidden" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap-> getidmue12(); ?>" <?php endif; ?> name="mues12" id="mues12" class="span7" >
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="12" id="add12" >+</button>
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="12" id="remove12">-</button>
                                                                            </div>
                                                                        </div>
                                                                       
                                                                        <div class="control-group" id="divmuestra14" hidden style="margin-right:20px; margin-left:20px;" >
                                                                            <label class="control-label" form="form-field-2">Muestra 14 </label>
                                                                            <div class="controls">
                                                                                    <select class="form-control chosen-select" style="width:100px;" name="desmues14" id="desmues14" data-nmuestra="14">
                                                                                            <?php if (count($biom)): ?>
                                                                                <option value="">Seleccione una Muestra</option>
                                                                                        <?php foreach ($biom as $muestra): ?>
                                                                                    <option value="<?php echo $muestra->codigo; ?>" <?php if(!empty($_GET["id"])):if($muestra->codigo == $biopsiap->getmuestra14()): ?> selected <?php endif; endif; ?>>
                                                                                        <?php echo $muestra->descr_muestra; ?>
                                                                                    </option>
                                                                                    <?php endforeach; ?>
                                                                                <?php else : ?>
                                                                                    <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                                <?php endif; ?>
                                                                                    </select>
                                                                                    <input type="hidden" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap-> getidmue14(); ?>" <?php endif; ?> name="mues14" id="mues14" class="span7" >
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="14" id="add14" >+</button>
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="14" id="remove14">-</button>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="control-group" id="divmuestra16" hidden style="margin-right:20px; margin-left:20px;" >
                                                                            <label class="control-label" form="form-field-2">Muestra 16 </label>
                                                                            <div class="controls">
                                                                                    <select class="form-control chosen-select" style="width:100px;" name="desmues16" id="desmues16" data-nmuestra="16">
                                                                                        <?php if (count($biom)): ?>
                                                                                <option value="">Seleccione una Muestra</option>
                                                                                        <?php foreach ($biom as $muestra): ?>
                                                                                    <option value="<?php echo $muestra->codigo; ?>" <?php if(!empty($_GET["id"])):if($muestra->codigo == $biopsiap->getmuestra16()): ?> selected <?php endif; endif; ?>>
                                                                                        <?php echo $muestra->descr_muestra; ?>
                                                                                    </option>
                                                                                    <?php endforeach; ?>
                                                                                <?php else : ?>
                                                                                    <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                                <?php endif; ?>
                                                                                    </select>
                                                                                    <input type="hidden" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap-> getidmue16(); ?>" <?php endif; ?> name="mues16" id="mues16" class="span7" >
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="16" id="add16" >+</button>
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="16" id="remove16">-</button>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="control-group" id="divmuestra18" hidden style="margin-right:20px; margin-left:20px;" >
                                                                            <label class="control-label" form="form-field-2">Muestra 18 </label>
                                                                            <div class="controls">
                                                                                    <select class="form-control chosen-select" style="width:100px;" name="desmues18" id="desmues18" data-nmuestra="18">
                                                                                        <?php if (count($biom)): ?>
                                                                                <option value="">Seleccione una Muestra</option>
                                                                                        <?php foreach ($biom as $muestra): ?>
                                                                                    <option value="<?php echo $muestra->codigo; ?>" <?php if(!empty($_GET["id"])):if($muestra->codigo == $biopsiap->getmuestra18()): ?> selected <?php endif; endif; ?>>
                                                                                        <?php echo $muestra->descr_muestra; ?>
                                                                                    </option>
                                                                                    <?php endforeach; ?>
                                                                                <?php else : ?>
                                                                                    <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                                <?php endif; ?>
                                                                                    </select>
                                                                                    <input type="hidden" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap-> getidmue18(); ?>" <?php endif; ?> name="mues18" id="mues18" class="span7" >
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="18" id="add18" >+</button>
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="18" id="remove18">-</button>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                         <div class="control-group" id="divmuestra20" hidden style="margin-right:20px; margin-left:20px;" >
                                                                            <label class="control-label" form="form-field-2">Muestra 20 </label>
                                                                            <div class="controls">
                                                                                    <select class="form-control chosen-select" style="width:100px;" name="desmues20" id="desmues20" data-nmuestra="20">
                                                                                        <?php if (count($biom)): ?>
                                                                                <option value="">Seleccione una Muestra</option>
                                                                                        <?php foreach ($biom as $muestra): ?>
                                                                                    <option value="<?php echo $muestra->codigo; ?>" <?php if(!empty($_GET["id"])):if($muestra->codigo == $biopsiap->getmuestra20()): ?> selected <?php endif; endif; ?>>
                                                                                        <?php echo $muestra->descr_muestra; ?>
                                                                                    </option>
                                                                                    <?php endforeach; ?>
                                                                                <?php else : ?>
                                                                                    <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                                <?php endif; ?>
                                                                                    </select>
                                                                                    <input type="hidden" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiap-> getidmue20(); ?>" <?php endif; ?> name="mues20" id="mues20" class="span7" >
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="20" id="add20" >+</button>
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="20" id="remove20">-</button>
                                                                            </div>
                                                                        </div>                                                                                                                     
                                                               
                                                                
                                                            </div><!-- span6 -->
                                                            
                                                       </div><!-- span12 -->
                                                       <div class="space-6"></div>

                                                      <div id="botones" class="span12 text-center">
                                                        
                                                            <button type="submit" class="btn btn-primary"> <i class="fa-floppy-o icon-on-left bigger-130"></i>Guardar</button>
                                                            <a href="index.php?page=biopsiaPQ&accion=listar" class="btn btn-danger"><i class="fa-times-circle icon-on-left bigger-130"></i>Cancelar</a>
                                                        
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