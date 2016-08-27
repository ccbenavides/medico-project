<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        
        <title>Registro de Biopsia</title>
        
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
                        $('#medicosop').hide();                       
                    }; 
              });
              $('#medicot').on('change',function(){
                var medicotrat=$('#medicot').val();
                  if (medicotrat!="OTRO") {
                    $('#medicosop').hide(); 
                    document.getElementById('medicoop').value="";  
                  } else{
                    $('#medicosop').show(); 

                  };
              });
              
             $('#area').on('change',function() {
                 var dato2=$('#area').val();
                 var fondo=document.getElementById('registro');
                 var numero=document.getElementById('numbio1');
                 var fecha2=new Date();
                 var fecha=fecha2.getFullYear();
                 var formato=fecha.toString().substring(fecha.toString().length-2,fecha.toString().length);
                 if (dato2==1) {
                    $('#topografias').show();
                    $('#fechabio1').show();
                    $('#fechabio2').hide();
                    $('#tipoestudio').show();
                    $('#bioxcong').show();
                    $('#ltecs').show();
                    $('#divmuestra1').show();
                    $('#gestantes').hide();
                    $('#gestas').hide();
                    $('#paras').hide();
                    $('#macs').hide();
                    $('#macs').removeAttr('required');
                    $('#furs').hide();
                    $('#paps').hide();
                    $('#muestrem').hide();
                    $('#codigopq').show();
                    $('#codigoce').hide();
                    $('#codigoccv').hide();
                    $('#codigoih').hide();
                    fondo.style.backgroundColor="rgb(197,216,158)";
                    //<?php echo $codigos->codigoccv();?>//
                    numero.value=<?php echo $codigos->prefijoanio();?>+'PQ'+'-';
                 }else if(dato2==2){
                    $('#topografias').show();
                    $('#fechabio1').hide();
                    $('#fechabio2').show();
                    $('#tipoestudio').hide();
                    $('#bioxcong').hide();
                    $('#ltecs').show();
                    $('#divmuestra1').show();
                    $('#gestantes').hide();
                    $('#gestas').hide();
                    $('#paras').hide();
                    $('#macs').hide();
                    $('#macs').removeAttr('required');
                    $('#furs').hide();
                    $('#paps').hide();
                    $('#muestrem').hide();
                    $('#codigopq').hide();
                    $('#codigoce').show();
                    $('#codigoccv').hide();
                    $('#codigoih').hide();
                    fondo.style.backgroundColor="rgb(255,167,7)";
                    numero.value=<?php echo $codigos->prefijoanio();?>+'C'+'-';
                 }else if(dato2==3){
                    $('#topografias').hide();
                    $('#fechabio1').hide();
                    $('#fechabio2').show();
                    $('#tipoestudio').hide();
                    $('#bioxcong').hide();
                    $('#ltecs').show();
                    $('#divmuestra1').hide();
                    $('#desmues1').removeAttr('required');
                    $('#divmuestra2').hide();
                    $('#gestantes').show();
                    $('#gestas').show();
                    $('#paras').show();
                    $('#macs').show();
                    $('#macs').attr("required");
                    $('#furs').show();
                    $('#paps').show();
                    $('#muestrem').show();
                    $('#codigopq').hide();
                    $('#codigoce').hide();
                    $('#codigoccv').show();
                    $('#codigoih').hide();
                    fondo.style.backgroundColor="rgb(214,141,139)";
                    numero.value=<?php echo $codigos->prefijoanio();?>+'C'+'-';
                 }else{
                    $('#topografias').show();
                    $('#fechabio1').hide();
                    $('#fechabio2').show();
                    $('#tipoestudio').hide();
                    $('#bioxcong').hide();
                    $('#ltecs').show();
                    $('#divmuestra1').show();
                    $('#gestantes').hide();
                    $('#gestas').hide();
                    $('#paras').hide();
                    $('#macs').hide();
                    $('#macs').removeAttr('required');
                    $('#furs').hide();
                    $('#paps').hide();
                    $('#muestrem').hide();
                    $('#codigopq').hide();
                    $('#codigoce').hide();
                    $('#codigoccv').hide();
                    $('#codigoih').show();
                    fondo.style.backgroundColor="rgb(199,141,95)";
                    numero.value=<?php echo $codigos->prefijoanio();?>+'IH'+'-';
                 }
              });

            });

        </script>
        <script>
          $(document).ready(function() {    
                $('#numbio2').blur(function(){
                    
                    $('#resultado').html('<img src="assets/img/loader.gif" alt="" />').fadeOut(1000);
                    var bio1=$('#numbio1').val();
                    var bio2 = $(this).val();  
                    var num_biopsia=bio1+bio2;
                    
                    $.ajax({
                        type:"POST",
                        url: "index.php?page=biopsia&accion=buscarNum",
                        data: {
                            'num_biopsia':num_biopsia,
                        },
                        success: function(data) {
                            $('#resultado').fadeIn(1000).html(data);
                            
                        }
                    });                 

                });              
            });    


        </script>
        <script>
            function mostrarmed(){
               $('#medicosop').show(); 
            }
            function ocultarmed(){
               $('#medicosop').hide();  
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
                                <a href="#">Paciente</a>

                                <span class="divider">
                                    <i class="icon-angle-right arrow-icon"></i>
                                </span>
                            </li>
                          
                            <li class="active">Recepcionar Biopsia</li>
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
                                        <h4><i class=" icon-user-md pink"></i>Datos de la Biopsia.</h4>                                        
                                    </div><!-- widget-header -->
                                    <div class="widget-body" id="registro" name="registro">
                                        <widget class="main">
                                            <div class="row-fluid ">
                                                <div class="space-18"></div>
                                                
                                                    <form class="form-horizontal"  action="index.php?page=biopsia&accion=insertar<?php if(!empty($_GET["id"])) :?>&id=<?php echo $_GET["id"]; endif; ?>" method="POST" enctype="multipart/form-data">
                                                       <div class="span12 ">
                                                           <div class="span6">
                                                               <div class="control-group " style="margin-right: 20px; margin-left: 20px;">
                                                                   <label class="control-label">DNI</label>
                                                                    <div class="controls">
                                                                        <input type="text"  readonly="true" required="required" style="width:235px;" class=" form-control" name="dni" <?php if(!empty($_GET["id"])) :?> value="<?php echo $paciente->getDni(); ?>" <?php endif; ?> autocomplete="off" autofocus>
                                                                    </div>
                                                               </div>
                                                               <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Area</label>
                                                                    <div class="controls">
                                                                          <select data-toggle="tooltip" title="Seleccione area donde se estudiará la biopsia" class="form-control" style="width:250px;" name="area" id="area" onchange="cargarmuexarea();cargartopo();" required>
                                                                            <?php if (count($areas)): ?>
                                                                                <option value="">Seleccione una Area</option>
                                                                                <?php foreach ($areas as $area): ?>
                                                                            <option value="<?php echo $area->id_area ?>" >
                                                                                        <?php echo $area->descr_area; ?>
                                                                                    </option>
                                                                                <?php endforeach; ?>
                                                                            <?php else : ?>
                                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                            <?php endif; ?>
                                                                        </select>
                                                                    </div>
                                                               </div>
                                                               <div class="control-group" id="topografias" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Topografia</label>
                                                                    <div class="controls">
                                                                        <select data-toggle="tooltip" title="Seleccione organo donde se extrajo la muestra" class="form-control chosen-select" style="width:250px;" name="topografia" id="topografia">
                                                                         <option value="">Seleccione una Topografia</option>
                                                                        </select>
                                                                    </div>
                                                               </div> 
                                                               <div class="control-group " style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Numero de Biopsia</label>
                                                                    <div class="controls">
                                                                        <input type="text" readonly="true" style="width:40px;" class=" form-control" name="numbio1" id="numbio1" autocomplete="off">
                                                                        <input type="hidden" readonly="true" style="width:42px;" class=" form-control" name="numbio2" id="numbio2" value="<?php echo $codigos->codigoxarea();?>" autocomplete="off">
                                                                        <!--<input type="text" maxlength="4" onkeypress="return soloNumeros(event)"  style="width:40px;margin-left:-5px;" class="form-control" name="numbio2" id="numbio2" autocomplete="off">
                                                                        <div id="resultado" style="margin-left:80px; margin-top:-30px;"></div>-->
                                                                    </div>
                                                                </div>
                                                                <div class="control-group" id="codigopq" hidden style="margin-left:75px;margin-top:-50px;">
                                                                    <div class="controls">
                                                                        <input type="text" readonly="true" style="width:42px";class="form-control" name="numbiopq" id="numbiopq" value="<?php echo $codigos->codigopq();?>" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="control-group" id="codigoce" hidden style="margin-left:75px;margin-top:-50px;">
                                                                    <div class="controls">
                                                                        <input type="text" readonly="true" style="width:42px";class="form-control" name="numbioce" id="numbioce" value="<?php echo $codigos->codigoccv();?>" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="control-group" id="codigoccv" hidden style="margin-left:75px;margin-top:-50px;">
                                                                    <div class="controls">
                                                                        <input type="text" readonly="true" style="width:42px";class="form-control" name="numbioccv" id="numbioccv" value="<?php echo $codigos->codigoccv();?>" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="control-group" id="codigoih" hidden style="margin-left:75px;margin-top:-50px;">
                                                                    <div class="controls">
                                                                        <input type="text" readonly="true" style="width:42px";class="form-control" name="numbioih" id="numbioih" value="<?php echo $codigos->codigoih();?>" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="control-group"  style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Institucion donde se opero</label>
                                                                     <div class="controls">
                                                                          <select data-toggle="tooltip" title="Seleccione institucion donde procede la muestra" required class="form-control chosen-select" style="width:250px;" name="institucion" id="institucion">
                                                                            <?php if (count($insts)): ?>
                                                                                <option value="">Seleccione una Institucion</option>
                                                                                <?php foreach ($insts as $inst): ?>
                                                                            <option value="<?php echo $inst->id_inst; ?>">
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
                                                                          <select data-toggle="tooltip" title="Seleccione servicio donde procede la muestra" class="form-control chosen-select" style="width:250px;" name="servicio" id="servicio">
                                                                            <?php if (count($deps)): ?>
                                                                                <option value="">Seleccione un Servicio</option>
                                                                                <?php foreach ($deps as $dep): ?>
                                                                            <option value="<?php echo $dep->dep_id ?>">
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
                                                                          <select data-toggle="tooltip" title="Seleccione medico que atendio al paciente" class="form-control" style="width:250px;" name="medicot" id="medicot" >
                                                                               <option value="">Seleccione un Medico</option>
                                                                          </select>
                                                                          <!--<button onclick="mostrarmed();" class="btn btn-minier btn-danger muestra" data-toggle="tooltip" title="Agregar otro medico" data-type="add" id="admed" name="admed" >+</button>-->
                                                                    </div>
                                                                </div>
                                                                <div class="control-group"  id="medicosop" hidden style="margin-right: 20px; margin-left: 20px;">
                                                                        <label class="control-label"></label>
                                                                        <div class="controls">
                                                                            <input type="text" style="width:235px;" onkeyup="this.value=this.value.toUpperCase()" onkeypress="return soloLetras(event)"  name="medicoop" id="medicoop" class="form-control"/>
                                                                            <!--<button onclick="ocultarmed();" class="btn btn-minier btn-danger muestra" data-type="remove" id="oculmed" name="oculmed">-</button>-->
                                                                        </div>
                                                                </div>
                                                                <div class="control-group"  id="medicostr" hidden style="margin-right: 20px; margin-left: 20px;">
                                                                        <label class="control-label">Medico Tratante:</label>
                                                                        <div class="controls">
                                                                            <input data-toggle="tooltip" title="Ingrese medico que atendio al paciente" type="text" style="width:235px;" onkeyup="this.value=this.value.toUpperCase()" onkeypress="return soloLetras(event)"  name="medicotr" id="medicotr" class="form-control" required />
                                                                        </div>
                                                                </div>
                                                                <div class="control-group" id="fechabio1" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Fecha de Biopsia </label>
                                                                    <div class="controls">
                                                                        <span name="fechas" data-toggle="tooltip" title="Seleccione fecha en que se diagnostico el estudio de biopsia">
                                                                        <input  type="date" class="form-control" id="fecha_bio" style="width:235px;" name="fecha_bio"  max="<?php echo date("Y-m-d"); ?>">
                                                                        </span>
                                                                    </div>   
                                                                </div>
                                                               
                                                                <div class="control-group" id="gestantes" hidden style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Gestante</label>
                                                                    <div class="controls form-inline">
                                                                                <label for="">
                                                                                    <input name="gestante" id="optionsRadios3" value="0" checked type="radio" style="opacity: 1">
                                                                                    <span class="lbl">
                                                                                        Si
                                                                                    </span>
                                                                                </label>
                                                                                <label for="">
                                                                                    <input name="gestante" id="optionsRadios4" value="1" type="radio" style="opacity: 1">
                                                                                    <span class="lbl">
                                                                                        No
                                                                                    </span>
                                                                                </label>
                                                                    </div>
                                                                </div>
                                                                <div class="control-group" id="gestas" hidden style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Gesta</label>
                                                                    <div class="controls">
                                                                        <input data-toggle="tooltip" title="Ingrese numero de embarazos" type="text" class=" form-control" style="width:235px;" onkeypress="return soloNumeros(event)" name="gesta" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="control-group" id="paras" hidden style="margin-right:20px; margin-left:20px;">
                                                                    <label class="control-label">Para</label>
                                                                   <div class="controls">
                                                                        <input data-toggle="tooltip" title="Ingrese numero de abortos,numero de cesareas,numero de embarazos naturales,numero de nacidos vivos" type="text" maxlength="4" class=" form-control" style="width:235px;" onkeypress="return soloNumeros(event)" name="para" autocomplete="off">
                                                                    </div> 
                                                                </div>
                                                                <div class="control-group" id="macs" hidden style="margin-right:20px; margin-left:20px;">
                                                                   <label class="control-label">Mac</label>
                                                                   <div class="controls">
                                                                        <input data-toggle="tooltip" title="Ingrese metodo anticonceptivo de la paciente" type="text" onkeyup="this.value=this.value.toUpperCase()" class=" form-control" name="mac" style="width:235px;" autocomplete="off">
                                                                    </div> 
                                                                </div>
                                                                
                                                                
                                                                <div class="control-group" id="divmuestra1" style="margin-top:65px; margin-right: 20px; margin-left: 20px;">
                                                                        <label class="control-label" for="form-field-2">Muestra 1 </label>
                                                                            <div class="controls">
                                                                                <span name="dm1" data-toggle="tooltip" title="Seleccione muestra de estudio">
                                                                                <select  class="form-control chosen-select" required style="width:90px;" name="desmues1" id="desmues1" data-nmuestra="1" >
                                                                                    <option>Seleccione una Muestra</option>
                                                                                </select>
                                                                                </span>
                                                                                <!--<input type="text" onkeyup="this.value=this.value.toUpperCase()" style="width:250px;" name="desmues1" id="desmues1" class="span7" data-nmuestra="1" placeholder="Muestra 1" required>-->
                                                                                <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="1" id="add1" >+</button>
                                                                                <!-- <button class="btn btn-minier btn-purple cie" data-type="remove" id="removercie2" >-</button> -->
                                                                            </div>
                                                                </div>
                                                                        <div class="control-group" id="divmuestra3" hidden style="margin-right:20px; margin-left:20px;" >
                                                                            <label class="control-label" form="form-field-2">Muestra 3 </label>
                                                                            <div class="controls">
                                                                                    <select class="form-control chosen-select" style="width:100px;" name="desmues3" id="desmues3" data-nmuestra="3">
                                                                                        <option>Seleccione una Muestra</option>
                                                                                    </select>
                                                                                    <!--<input type="text" onkeyup="this.value=this.value.toUpperCase()" style="width:250px;" name="desmues3" id="desmues3" class="span7" data-nmuestra="3" placeholder="Muestra 3">-->
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="3" id="add3" >+</button>
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="3" id="remove3">-</button>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="control-group" id="divmuestra5" hidden style="margin-right:20px; margin-left:20px;" >
                                                                            <label class="control-label" form="form-field-2">Muestra 5 </label>
                                                                            <div class="controls">
                                                                                     <select class="form-control chosen-select" style="width:100px;" name="desmues5" id="desmues5" data-nmuestra="5">
                                                                                        <option>Seleccione una Muestra</option>
                                                                                    </select>
                                                                                    <!--<input type="text" onkeyup="this.value=this.value.toUpperCase()" style="width:250px;" name="desmues5" id="desmues5" class="span7" data-nmuestra="5" placeholder="Muestra 5">-->
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="5" id="add5" >+</button>
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="5" id="remove5">-</button>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="control-group" id="divmuestra7" hidden style="margin-right:20px; margin-left:20px;" >
                                                                            <label class="control-label" form="form-field-2">Muestra 7 </label>
                                                                            <div class="controls">
                                                                                    <select class="form-control chosen-select" style="width:100px;" name="desmues7" id="desmues7" data-nmuestra="7">
                                                                                        <option>Seleccione una Muestra</option>
                                                                                    </select>
                                                                                    <!--<input type="text" onkeyup="this.value=this.value.toUpperCase()" style="width:250px;" name="desmues7" id="desmues7" class="span7" data-nmuestra="7" placeholder="Muestra 7">-->
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="7" id="add7" >+</button>
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="7" id="remove7">-</button>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="control-group" id="divmuestra9" hidden style="margin-right:20px; margin-left:20px;" >
                                                                            <label class="control-label" form="form-field-2">Muestra 9 </label>
                                                                            <div class="controls">
                                                                                    <select class="form-control chosen-select" style="width:100px;" name="desmues9" id="desmues9" data-nmuestra="9">
                                                                                        <option>Seleccione una Muestra</option>
                                                                                    </select>
                                                                                    <!--<input type="text" onkeyup="this.value=this.value.toUpperCase()" style="width:250px;" name="desmues9" id="desmues9" class="span7" data-nmuestra="9" placeholder="Muestra 9">-->
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="9" id="add9" >+</button>
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="9" id="remove9">-</button>
                                                                            </div>
                                                                        </div>
                                                                         <div class="control-group" id="divmuestra11" hidden style=" margin-top:20px; margin-right:20px; margin-left:20px;" >
                                                                            <label class="control-label" form="form-field-2">Muestra 11 </label>
                                                                            <div class="controls">
                                                                                    <select class="form-control chosen-select" style="width:100px;" name="desmues11" id="desmues11" data-nmuestra="11">
                                                                                        <option>Seleccione una Muestra</option>
                                                                                    </select>
                                                                                    <!--<input type="text" onkeyup="this.value=this.value.toUpperCase()" style="width:250px;" name="desmues11" id="desmues11" class="span7" data-nmuestra="11" placeholder="Muestra 11">-->
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="11" id="add11" >+</button>
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="11" id="remove11">-</button>
                                                                            </div>
                                                                        </div>
                                                                         <div class="control-group" id="divmuestra13" hidden style="margin-right:20px; margin-left:20px;" >
                                                                            <label class="control-label" form="form-field-2">Muestra 13 </label>
                                                                            <div class="controls">
                                                                                    <select class="form-control chosen-select" style="width:100px;" name="desmues13" id="desmues13" data-nmuestra="13">
                                                                                        <option>Seleccione una Muestra</option>
                                                                                    </select>
                                                                                    <!--<input type="text" onkeyup="this.value=this.value.toUpperCase()" style="width:250px;" name="desmues13" id="desmues13" class="span7" data-nmuestra="13" placeholder="Muestra 13">-->
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="13" id="add13" >+</button>
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="13" id="remove13">-</button>
                                                                            </div>
                                                                        </div>
                                                                        <div class="control-group" id="divmuestra15" hidden style="margin-right:20px; margin-left:20px;" >
                                                                            <label class="control-label" form="form-field-2">Muestra 15 </label>
                                                                            <div class="controls">
                                                                                    <select class="form-control chosen-select" style="width:100px;" name="desmues15" id="desmues15" data-nmuestra="15">
                                                                                        <option>Seleccione una Muestra</option>
                                                                                    </select>
                                                                                    <!--<input type="text" onkeyup="this.value=this.value.toUpperCase()" style="width:250px;" name="desmues15" id="desmues15" class="span7" data-nmuestra="15" placeholder="Muestra 15">-->
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="15" id="add15" >+</button>
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="15" id="remove15">-</button>
                                                                            </div>
                                                                        </div>
                                                                        <div class="control-group" id="divmuestra17" hidden style="margin-right:20px; margin-left:20px;" >
                                                                            <label class="control-label" form="form-field-2">Muestra 17 </label>
                                                                            <div class="controls">
                                                                                    <select class="form-control chosen-select" style="width:100px;" name="desmues17" id="desmues17" data-nmuestra="17">
                                                                                        <option>Seleccione una Muestra</option>
                                                                                    </select>
                                                                                    <!--<input type="text" onkeyup="this.value=this.value.toUpperCase()" style="width:250px;" name="desmues17"  id="desmues17" class="span7" data-nmuestra="17" placeholder="Muestra 17">-->
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="17" id="add17" >+</button>
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="17" id="remove17">-</button>
                                                                            </div>
                                                                        </div>
                                                                        <div class="control-group" id="divmuestra19" hidden style="margin-right:20px; margin-left:20px;" >
                                                                            <label class="control-label" form="form-field-2">Muestra 19 </label>
                                                                            <div class="controls">
                                                                                    <select class="form-control chosen-select" style="width:100px;" name="desmues19" id="desmues19" data-nmuestra="19">
                                                                                        <option>Seleccione una Muestra</option>
                                                                                    </select>
                                                                                    <!--<input type="text" onkeyup="this.value=this.value.toUpperCase()" style="width:250px;" name="desmues19" id="desmues19" class="span7" data-nmuestra="19" placeholder="Muestra 19">-->
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="19" id="add19" >+</button>
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="19" id="remove19">-</button>
                                                                            </div>
                                                                        </div>                                                                      
                                                                
                                                            </div><!-- span6 -->

                                                            <div class="span6">
                                                               <div class="control-group" id="furs" hidden style="margin-right:20px; margin-left:20px;display:none;">
                                                                    <label class="control-label">Fur</label>
                                                                    <div class="controls">
                                                                        <input data-toggle="tooltip" title="Ingrese frecuencia de la regla" type="text" class=" form-control" onkeyup="this.value=this.value.toUpperCase()" name="fur" style="width:235px;" autocomplete="off">
                                                                    </div>
                                                               </div>                                                           
                                                               <div class="control-group" id="paps" hidden style="margin-right:20px; margin-left:20px;">
                                                                  <label class="control-label">PAP Anterior</label>
                                                                  <div class="controls">
                                                                      <input data-toggle="tooltip" title="Ingrese el tiempo en que la paciente se realizo el ultimo papanicolau" type="text" class=" form-control" onkeyup="this.value=this.value.toUpperCase()" name="pap" style="width:235px;" autocomplete="off">
                                                                  </div>  
                                                               </div>
                                                               <div class="control-group" id="muestrem" hidden style="margin-right:20px; margin-left:20px;">
                                                                    <label class="control-label">Muestra Remitida</label>
                                                                    <div class="controls">
                                                                       <select data-toggle="tooltip" title="Ingrese muestra de estudio" class="form-control " style="width:250px;" name="mremitida" id="mremitida">
                                                                                <?php if (count($biom)): ?>
                                                                                    <option value=-1>Seleccione...</option>
                                                                                    <?php foreach ($biom as $biopm): ?>
                                                                                        <option value="<?php echo $biopm->codigo;?>">
                                                                                            <?php echo $biopm->muestra; ?>
                                                                                        </option>
                                                                                    <?php endforeach; ?>
                                                                                <?php else : ?>
                                                                                    <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                                <?php endif; ?>
                                                                       </select>
                                                                    </div>
                                                               </div>
                                                               <div class="control-group" id="fechabio2" hidden style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Fecha de Biopsia </label>
                                                                    <div class="controls">
                                                                        <span name="fb2" data-toggle="tooltip" title="Seleccione fecha en que se diagnostico el estudio de biopsia">
                                                                        <input type="date" class="form-control" id="fecha_bio2" name="fecha_bio2" style="width:235px;" max="<?php echo date("Y-m-d"); ?>">
                                                                        </span>
                                                                    </div>   
                                                               </div>
                                                               <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Fecha de Ingreso al Servicio</label>
                                                                    <div class="controls">
                                                                        <input type="date" class="form-control" readonly id="fecha_ingreso" name="fecha_ingreso" style="width:235px;" value="<?php echo date("Y-m-d"); ?>">
                                                                    </div>   
                                                                </div>
                                                               <div class="control-group" id="tipoestudio" style="margin-right:20px; margin-left:20px;">
                                                                    <label class="control-label">Tipo de Estudio</label>
                                                                        <div class="controls">
                                                                           <select data-toggle="tooltip" title="Seleccione tipo de estudio de una biopsia" class="form-control " name="tipo" id="tipo" style="width:250px;">
                                                                                <?php if (count($biosp)): ?>
                                                                                    <option value="">Seleccione...</option>
                                                                                    <?php foreach ($biosp as $biop): ?>
                                                                                        <option value="<?php echo $biop->codigo?>">
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
                                                                                    <input name="optionsRadio" id="optionsRadios3"  value="0" type="radio" style="opacity: 1">
                                                                                    <span class="lbl">
                                                                                        Si
                                                                                    </span>
                                                                                </label>
                                                                                <label for="">
                                                                                    <input name="optionsRadio" id="optionsRadios4" checked value="1" type="radio" style="opacity: 1">
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
                                                                                        <option value="<?php echo $tecno->id_proc ?>" >
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
                                                                           <select data-toggle="tooltip" title="Seleccione patologo responsable" class="form-control " style="width:250px;" name="patologo" id="patologo" required>
                                                                                <?php if (count($pats)): ?>
                                                                                    <option value="">Seleccione</option>
                                                                                    <?php foreach ($pats as $pat): ?>
                                                                                        <option value="<?php echo $pat->emp_id ?>" >
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
                                                                                  <textarea data-toggle="tooltip" title="Ingrese diagnostico del medico tratante" class="span12" style="width:250px;" onkeyup="this.value=this.value.toUpperCase()" id="form-field-8" name="diagnosticoc" ></textarea>  
                                                                            </div>
                                                                </div>
                                                                <div class="control-group" style="margin-right:20px; margin-left:20px;">
                                                                        <label class="control-label">Observacion</label>
                                                                            <div class="controls">
                                                                                  <textarea data-toggle="tooltip" title="Ingrese observacion del medico tratante" class="span12" style="width:250px;" onkeyup="this.value=this.value.toUpperCase()" id="form-field-8" name="observacion"></textarea>  
                                                                            </div>
                                                                </div>

                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                   <label class="control-label">Pago del paciente</label>
                                                                    <div class="controls">
                                                                        <span data-toggle="tooltip" title="Ingrese pago de la biopsia" name="pgb">
                                                                        <input type="number" style="width:235px;" min="0" max="500" value="0" onkeypress="return soloNumeros(event)" class=" form-control" name="pago" autocomplete="off">
                                                                        </span>
                                                                    </div>
                                                               </div>
                                                                 <div class="control-group" id="divmuestra2" hidden style="margin-right:20px; margin-left:20px;margin-top:23px;" >
                                                                        <label class="control-label" for="form-field-2">Muestra 2 </label>

                                                                            <div class="controls">
                                                                                <select class="form-control chosen-select" style="width:100px;" name="desmues2" id="desmues2" data-nmuestra="2">
                                                                                        <option>Seleccione una Muestra</option>
                                                                                </select>
                                                                                <!--<input type="text" onkeyup="this.value=this.value.toUpperCase()" style="width:250px;" name="desmues2" id="desmues2" class="span7" data-nmuestra="2" placeholder="Muestra 2">-->
                                                                                <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="2" id="add2" >+</button>
                                                                                <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="2" id="remove2">-</button>
                                                                            </div>
                                                                </div>
                                                                <div class="control-group" id="divmuestra4" hidden style="margin-right:20px; margin-left:20px;" >
                                                                            <label class="control-label" form="form-field-2">Muestra 4 </label>
                                                                            <div class="controls">
                                                                                    <select class="form-control chosen-select" style="width:100px;" name="desmues4" id="desmues4" data-nmuestra="4">
                                                                                        <option>Seleccione una Muestra</option>
                                                                                    </select>
                                                                                    <!--<input type="text" onkeyup="this.value=this.value.toUpperCase()" style="width:250px;" name="desmues4" id="desmues4" class="span7" data-nmuestra="4" placeholder="Muestra 4">-->
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="4" id="add4" >+</button>
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="4" id="remove4">-</button>
                                                                            </div>
                                                                </div>
                                                                <div class="control-group" id="divmuestra6" hidden style="margin-right:20px; margin-left:20px;" >
                                                                            <label class="control-label" form="form-field-2">Muestra 6 </label>
                                                                            <div class="controls">
                                                                                <select class="form-control chosen-select" style="width:100px;" name="desmues6" id="desmues6" data-nmuestra="6">
                                                                                        <option>Seleccione una Muestra</option>
                                                                                </select>
                                                                                    <!--<input type="text" onkeyup="this.value=this.value.toUpperCase()" style="width:250px;" name="desmues6" id="desmues6" class="span7" data-nmuestra="6" placeholder="Muestra 6">-->
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="6" id="add6" >+</button>
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="6" id="remove6">-</button>
                                                                            </div>
                                                                </div>
                                                                <div class="control-group" id="divmuestra8" hidden style="margin-right:20px; margin-left:20px;" >
                                                                            <label class="control-label" form="form-field-2">Muestra 8 </label>
                                                                            <div class="controls">
                                                                                    <select class="form-control chosen-select" style="width:100px;" name="desmues8" id="desmues8" data-nmuestra="8">
                                                                                        <option>Seleccione una Muestra</option>
                                                                                    </select>
                                                                                    <!--<input type="text" onkeyup="this.value=this.value.toUpperCase()" style="width:250px;" name="desmues8" id="desmues8" class="span7" data-nmuestra="8" placeholder="Muestra 8">-->
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="8" id="add8" >+</button>
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="8" id="remove8">-</button>
                                                                            </div>
                                                                </div>
                                                                 <div class="control-group" id="divmuestra10" hidden style="margin-right:20px; margin-left:20px;" >
                                                                            <label class="control-label" form="form-field-2">Muestra 10 </label>
                                                                            <div class="controls">
                                                                                    <select class="form-control chosen-select" style="width:100px;" name="desmues10" id="desmues10" data-nmuestra="10">
                                                                                        <option>Seleccione una Muestra</option>
                                                                                    </select>
                                                                                    <!--<input type="text" onkeyup="this.value=this.value.toUpperCase()" style="width:250px;" name="desmues10" id="desmues10" class="span7" data-nmuestra="10" placeholder="Muestra 10">-->
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="10" id="add10" >+</button>
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="10" id="remove10">-</button>
                                                                            </div>
                                                                </div>
                                                               
                                                                        <div class="control-group" id="divmuestra12" hidden style="margin-right:20px; margin-left:20px;" >
                                                                            <label class="control-label" form="form-field-2">Muestra 12 </label>
                                                                            <div class="controls">
                                                                                    <select class="form-control chosen-select" style="width:100px;" name="desmues12" id="desmues12" data-nmuestra="12">
                                                                                        <option>Seleccione una Muestra</option>
                                                                                    </select>
                                                                                    <!--<input type="text" onkeyup="this.value=this.value.toUpperCase()" style="width:250px;" name="desmues12" id="desmues12" class="span7" data-nmuestra="12" placeholder="Muestra 12">-->
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="12" id="add12" >+</button>
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="12" id="remove12">-</button>
                                                                            </div>
                                                                        </div>
                                                                       
                                                                        <div class="control-group" id="divmuestra14" hidden style="margin-right:20px; margin-left:20px;" >
                                                                            <label class="control-label" form="form-field-2">Muestra 14 </label>
                                                                            <div class="controls">
                                                                                    <select class="form-control chosen-select" style="width:100px;" name="desmues14" id="desmues14" data-nmuestra="14">
                                                                                            <option>Seleccione una Muestra</option>
                                                                                    </select>
                                                                                    <!--<input type="text" onkeyup="this.value=this.value.toUpperCase()" style="width:250px;"  name="desmues14" id="desmues14" class="span7" data-nmuestra="14" placeholder="Muestra 14">-->
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="14" id="add14" >+</button>
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="14" id="remove14">-</button>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="control-group" id="divmuestra16" hidden style="margin-right:20px; margin-left:20px;" >
                                                                            <label class="control-label" form="form-field-2">Muestra 16 </label>
                                                                            <div class="controls">
                                                                                    <select class="form-control chosen-select" style="width:100px;" name="desmues16" id="desmues16" data-nmuestra="16">
                                                                                        <option>Seleccione una Muestra</option>
                                                                                    </select>
                                                                                    <!--<input type="text" onkeyup="this.value=this.value.toUpperCase()" style="width:250px;"  name="desmues16" id="desmues16" class="span7" data-nmuestra="16" placeholder="Muestra 16">-->
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="16" id="add16" >+</button>
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="16" id="remove16">-</button>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="control-group" id="divmuestra18" hidden style="margin-right:20px; margin-left:20px;" >
                                                                            <label class="control-label" form="form-field-2">Muestra 18 </label>
                                                                            <div class="controls">
                                                                                    <select class="form-control chosen-select" style="width:100px;" name="desmues18" id="desmues18" data-nmuestra="18">
                                                                                        <option>Seleccione una Muestra</option>
                                                                                    </select>
                                                                                    <!--<input type="text" onkeyup="this.value=this.value.toUpperCase()" style="width:250px;"  name="desmues18" id="desmues18" class="span7" data-nmuestra="18" placeholder="Muestra 18">-->
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="18" id="add18" >+</button>
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="18" id="remove18">-</button>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                         <div class="control-group" id="divmuestra20" hidden style="margin-right:20px; margin-left:20px;" >
                                                                            <label class="control-label" form="form-field-2">Muestra 20 </label>
                                                                            <div class="controls">
                                                                                    <select class="form-control chosen-select" style="width:100px;" name="desmues20" id="desmues20" data-nmuestra="20">
                                                                                        <option>Seleccione una Muestra</option>
                                                                                    </select>
                                                                                    <!--<input type="text" onkeyup="this.value=this.value.toUpperCase()" style="width:250px;" name="desmues20" id="desmues20" class="span7" data-nmuestra="20" placeholder="Muestra 20">-->
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="20" id="add20" >+</button>
                                                                                    <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="20" id="remove20">-</button>
                                                                            </div>
                                                                        </div>                                                                                                                     
                                                               
                                                                
                                                            </div><!-- span6 -->
                                                            
                                                       </div><!-- span12 -->
                                                       <div class="space-6"></div>

                                                      <div class="span12 text-center">
                                                        
                                                            <button type="submit" class="btn btn-primary"> <i class="fa-floppy-o icon-on-left bigger-130"></i>Guardar</button>
                                                            <a href="index.php?page=paciente&accion=form2" class="btn btn-danger"><i class="fa-times-circle icon-on-left bigger-130"></i>Cancelar</a>
                                                        
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