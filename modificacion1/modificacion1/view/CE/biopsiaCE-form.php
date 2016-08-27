<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        

        <title>Muestras Asignadas</title>
        
         <!-- BASIC-->
           
        <!--favicon-->
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
        <script type="text/javascript">
        $(document).on('ready',function(){
            var numero=document.getElementById('requiereih');
            if (numero.value!='Si') {
                $('#inmunohisto').hide();
            } else{
                $('#inmunohisto').show();
            };

        });
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
                                <i class="fa fa-list-alt"></i>
                                <a href="#">Citologia Especial</a>

                                <span class="divider">
                                    <i class="icon-angle-right arrow-icon"></i>
                                </span>
                            </li>
                          
                            <li class="active">Muestras Asignadas</li>
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
                                <h2 class="header smaller lighter blue">Biopsia del Paciente</h2>
                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h4><i class=" icon-user-md pink"></i>Datos del paciente.</h4>
                                        <div class="widget-toolbar">
                                            <a href="#" data-action="collapse">
                                                    <i class="icon-chevron-up"></i>
                                            </a>    
                                        </div>
                                        
                                    </div><!-- widget-header -->
                                    <div class="widget-body">
                                        <widget class="main">
                                            <div class="row-fluid ">
                                                <div class="space-18"></div>
                                                
                                                    <form class="form-horizontal"  action="index.php?page=empleado&accion=insertar<?php if(!empty($_GET["id"])) :?>&id=<?php echo $_GET["id"]; endif; ?>" method="POST" enctype="multipart/form-data">
                                                       <div class="span12 ">
                                                           <div class="span6">
                                                               <div class="control-group " style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Numero de Biopsia</label>
                                                                    <div class="controls">
                                                                        <input type="text" style="width:275px;" readonly ="true"  class=" form-control" name="numbio" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiace->getNumBio(); ?>" <?php endif; ?> autocomplete="off" autofocus>
                                                                        <input type="hidden" style="width:275px;" readonly ="true" class=" form-control" name="id_biopsia" id="id_biopsia" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiace->getIdBio(); ?>" <?php endif; ?> >
                                                                        <input type="hidden" style="width:275px;" readonly ="true" class=" form-control" name="requiereih" id="requiereih" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiace->getrequiereih(); ?>" <?php endif; ?> >
                                                                    </div>
                                                                </div>
                                                               <div class="control-group " style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">DNI</label>
                                                                    <div class="controls">
                                                                        <input type="text" style="width:275px;" readonly ="true"  class=" form-control" name="dni" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiace->getDni(); ?>" <?php endif; ?> autocomplete="off" autofocus>
                                                                    </div>
                                                                </div>
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Nombres y Apellidos</label>
                                                                    
                                                                    <div class="controls">
                                                                        <input type="text" style="width:275px;" readonly ="true"  class=" form-control"
                                                                           name="nombres" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiace->getNombre(); ?>" <?php endif; ?> autocomplete="off">
                                                                    </div>
                                                                </div>
                                                               
                                                                
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Edad</label>
                                                                    <div class="controls">
                                                                        <input type="text" style="width:275px;" readonly ="true"  class=" form-control"
                                                                           name="edad" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiace->getEdad(); ?>" <?php endif; ?> autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                                                                          
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Sexo</label>
                                                                     <div class="controls">
                                                                          <input type="text" style="width:275px;" readonly ="true"  class="  form-control"
                                                                           name="sexo" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiace->getSexo(); ?>" <?php endif; ?> autocomplete="off">
                                                                     </div>
                                                                </div>
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Fecha de Biopsia</label>
                                                                       <div class="controls">
                                                                                <input type="text" style="width:275px;" readonly ="true"  class=" form-control"
                                                                                   name="fecha" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiace->getFecha(); ?>" <?php endif; ?> autocomplete="off">
                                                                       </div> 
                                                                </div>                                                                                                                                                                                   
                                                            </div><!-- span6 -->
                                                            <div class="span6"> 
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Fecha de Ingreso al Servicio</label>
                                                                       <div class="controls">
                                                                                <input type="text" style="width:275px;" readonly ="true"  class=" form-control"
                                                                                   name="fechaingreso" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiace->getFechaI(); ?>" <?php endif; ?> autocomplete="off">
                                                                       </div>
                                                                 </div> 
                                                                 <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Servicio</label>
                                                                       <div class="controls">
                                                                                <input type="text" style="width:275px;" readonly ="true"  class=" form-control"
                                                                                   name="servicio" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiace->getServicio(); ?>" <?php endif; ?> autocomplete="off">
                                                                       </div> 
                                                                </div>
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Medico Tratante</label>
                                                                       <div class="controls">
                                                                                <input type="text" style="width:275px;" readonly ="true"   class=" form-control"
                                                                                   name="medicot" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiace->getMedicoT(); ?>" <?php endif; ?> autocomplete="off">
                                                                       </div> 
                                                                </div>
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Topografia</label>
                                                                       <div class="controls">
                                                                                <input type="text" style="width:275px;" readonly ="true"   class=" form-control"
                                                                                   name="topografia" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiace->getTopografia(); ?>" <?php endif; ?> autocomplete="off">
                                                                       </div> 
                                                                </div>
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Tipo de Seguro</label>
                                                                     <div class="controls">
                                                                          <input type="text" style="width:275px;" readonly ="true"  class="  form-control"
                                                                           name="tiposeguro" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiace->getTipoSeguro(); ?>" <?php endif; ?> autocomplete="off">
                                                                     </div>
                                                                </div>                                              
                                                         </div><!-- span6 -->
                                                        
                                                       </div><!-- span12 -->
                                                       <div class="space-6"></div>

                                                    </form><!-- form -->
 
                                            </div><!-- row-fluid -->
                                            
                                        </widget><!--widget-main-->

                                        <div class="space-10"></div>
                                        
                                    </div><!-- widget-body -->

                                </div><!--widget-box-->
                               
                                   
                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h4><i class=" icon-user-md pink"></i>Diagnostico Final</h4>
                                        <div class="widget-toolbar">
                                            <a href="#" data-action="collapse">
                                                    <i class="icon-chevron-up"></i>
                                            </a>    
                                        </div>
                                    </div>
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <div class="row-fluid ">
                                              <div class="span12">
                                                   <div class="span6">
                                                      <div class="table-responsive">
                                                         <h3 class="text-primary blue">Laminas/Tacos<?php if($_SESSION['idusuario']==1 or $_SESSION['idperfil_anat']==5):?>
                                                            <a class="btn btn-info pull-right" id="btnAgregMat" data-toggle="modal"><i class="icon-pencil icon-on-left bigger-110"></i> &nbsp;Laminas / Tacos</a><?php endif?>
                                                         </h3> 
                                                         <table class="table table-bordered table-striped table-condensed table-hover" >
                                                            <thead>
                                                                <tr>
                                                                    <th>N° Laminas</th> 
                                                                    <th>N° Tacos</th> 
                                                                    <?php if($_SESSION['idperfil_anat']==1 or $_SESSION['idperfil_anat']==2 or $_SESSION['idperfil_anat']==6 or $_SESSION['idperfil_anat']==3):?> 
                                                                    <th>Tecnologo</th> 
                                                                    <?php endif?>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="ajax_lamtaco"></tbody>
                                                         </table>
                                                      </div>
                                                   </div><!-- primer span6-->
                                                   <div class="span6">
                                                      <div class="table-responsive">
                                                         <h3 class="text-primary blue">Macroscopia<?php if($_SESSION['idusuario']==1 or $_SESSION['idperfil_anat']==2 or  $_SESSION['idperfil_anat']==5):?>
                                                            <a class="btn btn-info pull-right" id="btnAgregMac" data-toggle="modal"><i class="icon-pencil icon-on-left bigger-110"></i> &nbsp;Macroscopia</a><?php endif?>
                                                         </h3>
                                                         <table class="table table-bordered table-striped table-condensed table-hover" >
                                                            <thead>
                                                                <tr>
                                                                  <th width="30%">Macroscopia</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="ajax_macro"></tbody>
                                                         </table>  
                                                      </div>
                                                   </div><!--segundo span6-->
                                              </div><!--span12-->
                                              <?php if($_SESSION['idperfil_anat']==5):?> 
                                                <div class="span12 text-center">
                                                   <a id="GuardarEstado2" data-toggle="modal" class="btn btn-primary">Finalizar</a> 
                                                </div>
                                              <?php endif?>
                                              <hr>
                                              <?php if($_SESSION['idperfil_anat']==1 or $_SESSION['idperfil_anat']==6 or $_SESSION['idperfil_anat']==2 or $_SESSION['idperfil_anat']==3):?>
                                              <div class="table-responsive" >
                                                    <h3 class="text-primary  blue">Diagnostico/Descripcion
                                                      <a class="btn btn-sucess pull-right" id="btnderivarIH" data-toggle="modal"><i class="icon-arrow-right icon-on-left bigger-110"></i> &nbsp;Requiere IH</a>
                                                      <a class="btn btn-info pull-right" id="btnAgregarDiagDes" data-toggle="modal" style="margin-right:10px;"><i class="icon-pencil icon-on-left bigger-110"></i> &nbsp;Diagnostico</a> 
                                                    </h3>
                                                    <table class="table table-bordered table-striped table-condensed table-hover" >
                                                        <thead>
                                                            <tr>
                                                                <th width="10%">Muestra Remitida</th>
                                                                <th width="20%">Descripcion</th>
                                                                <!--<th width="25%">Descripcion</th>-->
                                                            </tr>
                                                        </thead>
                                                        <tbody id="ajax_diagdes"></tbody>  
                                                    </table>
                                                </div><!--tabla de diagnostico--> 

                                                <div class="table-responsive" id="inmunohisto" hidden>
                                                                <h3 class="text-primary  blue">Inmunohistoquimica
                                                                  <a class="btn btn-info pull-right" id="btnAgregarIH" data-toggle="modal" style="margin-right:10px;"><i class="icon-pencil icon-on-left bigger-110"></i> &nbsp;IH</a>
                                                                </h3>                                                                                                                              
                                                                <table class="table table-bordered table-striped table-condensed table-hover">
                                                                    <thead>
                                                                        <tr>
                                                                            <th width="15%">Marcador</th>
                                                                            <th width="30%">Resultado</th>                                                                                                                                                  
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="ajax_marcadoresce"></tbody>
                                                                </table>                                                               

                                                </div>
                                                <?php endif?>
                                                <hr>
                                                <?php if($_SESSION['idperfil_anat']==1 or $_SESSION['idperfil_anat']==6 or $_SESSION['idperfil_anat']==3):?>
                                                <div class="table-responsive">
                                                  <h3 class="text-primary blue">Resultado
                                                    <a class="btn btn-info pull-right" id="btnAgreResult" data-toggle="modal"><i class="icon-pencil icon-on-left bigger-110"></i> &nbsp;Resultado</a>
                                                  </h3>
                                                  <table class="table table-bordered table-striped table-condensed table-hover" >
                                                      <thead>
                                                          <tr>
                                                              <th>Resultado</th>
                                                              <th>Patologo Responsable</th>
                                                              <th>Fecha de Informe</th>
                                                          </tr>
                                                      </thead>
                                                      <tbody id="ajax_resce"></tbody>
                                                  </table>
                                                </div><!--tabla de resultados-->
                                                <div class="span12 text-center">
                                                    <a id="FinalizarBio" data-toggle="modal" class="btn btn-primary">Finalizar</a> 
                                                </div>

                                                 <span style="font-weight: bold;"><?php if(!empty($_GET["id"])) :?> Recepcionada por: <?php echo $biopsiace->getcreacion(); ?> <?php endif; ?></span>
                                                 <br>
                                                 <span style="font-weight: bold;"><?php if(!empty($_GET["id"])) :?> Ultima actualizacion de la macroscopia por: <?php echo $biopsiace->getmodificamacroce(); ?> <?php endif; ?></span>
                                                <?php endif?>
                                            </div><!--row-fluid-->
                                        </div><!--widget-main-->
                                      
                                        
                                    </div>
                                    
                                </div>
                                <div class="span6"></div>
                          </div><!-- span12 -->
                        </div><!-- row-fluid -->
                    </div><!-- page-content -->
            </div> <!-- main content -->
        </div><!-- main container -->
        
        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small ">
            <i class="icon-double-angle-up icon-only bigger-110"></i>
        </a>
       <!--materiales-->
        <div class="modal hide fade" id="modal-agregar-materialce" tabindex="0" role="dialog" aria-labelledby="tituloModal" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="blue bigger" id="tituloModal">Ingreso de Materiales</h3>                               
            </div>
            <div class="modal-body overflow-hidden">
                <div class="row-fluid">
                    <div class="space-6"></div>
                    <form method="POST" class="form-horizontal">
                      <div class="control-group" >                            
                            <label class="control-label green">N° de Tacos</label>
                            <div class="controls">
                                <input type="number" name="num_tacos" id="num_tacos" min="1" max="50" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiace-> getNumTaco(); ?>" <?php endif; ?> onkeypress="return soloNumeros(event)" class="form-control"/>
                            </div>
                      </div>
                      <div class="control-group">
                           <label class="control-label green">N° de Laminas</label>
                            <div class="controls">
                                <input type="number" name="num_laminas" id="num_laminas" min="1" max="50" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiace-> getNumLamina(); ?>" <?php endif; ?> onkeypress="return soloNumeros(event)" class="form-control"/>
                            </div> 
                      </div>

                     <!--<div class="control-group">
                            <label class="control-label green">Fecha de Entrega</label>
                            <div class="controls">
                                <input type="date" class="form-control" id="fecha_entmat" name="fecha_entmat"  max="<?php echo date("Y-m-d"); ?>">
                            </div>
                      </div>-->
                        
                    </form>
                </div>
            </div><!--modal body-->
             <div class="modal-footer">
                <button class="btn btn-small" data-dismiss="modal"><i class="icon-remove"></i> Cancelar</button>
                <button class="btn btn-small btn-primary" id="btnInsertMat"> <i class="icon-ok"></i>Guardar</button>
            </div>
        </div><!--modal ingreso materiales-->

        <div class="modal hide fade" id="modal-agregar-macroce" tabindex="0" role="dialog" aria-labelledby="tituloModal" aria-hidden="true" >
          <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
             <h3 class="blue bigger" id="tituloModal">Ingresar Macroscopia</h3>
          </div>
           <div class="modal-body overflow-hidden">
                <div class="row-fluid">
                    <div class="space-6"></div>
                    <form method="POST" class="form-horizontal">
                        <div class="control-group" >
                            <label class="control-label green span2">MACROSCOPIA</label>
                              <textarea required="required" name="macroscopia"  cols="100" id="macroscopia" onkeyup="this.value=this.value.toUpperCase()" class="autosize-transition span12" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 210px;"><?php if(!empty($_GET["id"])) :?><?php echo $biopsiace-> getMacro(); ?><?php endif; ?></textarea>
                      
                        </div>

                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-small" data-dismiss="modal"><i class="icon-remove"></i> Cancelar</button>
                <button class="btn btn-small btn-primary"id="btnInsertMacro"> <i class="icon-ok"></i>Guardar</button>
            </div>
        </div><!--modal macroscopia-->

        <!--guardar estado macroscopia-->
        

        <div class="modal hide fade" id="modal-agregar-diag-ce" tabindex="0" role="dialog" aria-labelledy="tituloModal" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="blue bigger" id="tituloModal">Diagnostico</h3>
            </div>
            <div class="modal-body overflow-hidden">
                <div class="row-fluid">
                    <div class="space-6"></div>
                    <form method="POST" class="form-horizontal">
                        <div class="control-group">
                          <label class="control-label green span2">MUESTRAS REMITIDAS</label>
                           <div class="controls">
                             <select class="form-control " style="width:350px;margin-left:-70px;" name="id_muestrabio" id="id_muestrabio">
                                 <?php if (count($muestras)): ?>
                              <option value="">Seleccione una Muestra</option>
                               <?php foreach ($muestras as $muestra): ?>
                              <option value="<?php echo $muestra->id_muestrabio ?>">
                                  <?php echo $muestra->muestra_remitida; ?>
                              </option>
                                <?php endforeach; ?>
                              <?php else : ?>
                               <? echo '<option value=-1> No existen registros </option>'; ?>
                               <?php endif; ?>
                             </select>
                          </div>
                       </div>  
                       <div class="control-group">
                            <label class="control-label green span2" >DIAGNOSTICO</label>
                             <textarea required="required" name="diag_final"  cols="100" id="diag_final" onkeyup="this.value=this.value.toUpperCase()" class="autosize-transition span12" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 90px;"></textarea>
                        </div>
                         <!--<div class="control-group">
                            <label class="control-label green span2" >DESCRIPCION</label>
                             <textarea required="required" name="descrip_muestce"  cols="100" id="descrip_muestce" onkeyup="this.value=this.value.toUpperCase()" class="autosize-transition span12" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 140px;"></textarea>
                        </div>-->
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                 <button class="btn btn-small" data-dismiss="modal"><i class="icon-remove"></i> Cancelar</button>
                <button class="btn btn-small btn-primary"id="btnInsertarDiag"> <i class="icon-ok"></i>Guardar</button>
            </div>
        </div><!--diagnostico-->

        <div class="modal hide fade" id="modal-derivacionih" tabindex="0" role="dialog" aria-labelledy="tituloModal" aria-hidden="true" >
            <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h3 class="blue bigger" id="tituloModal">Requiere Inmunohistoquimica</h3>
              </div>
              <div class="modal-body overflow-hidden">
                <div class="row-fluid">
                    <div class="space-6"></div>
                      <form method="GET" class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label green">Numero de Biopsia</label>
                             <div class="controls">
                               <input type="text" style="width:275px;" readonly="true"  class=" form-control" name="numero_biopsia" id="numero_biopsia"  <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiace-> getNumBio(); ?>" <?php endif; ?> autocomplete="off" autofocus>
                               <input type="hidden" style="width:275px;" readonly ="true" class=" form-control" name="id_biopsia" id="id_biopsia" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiace->getIdBio(); ?>" <?php endif; ?> >
                             </div>
                        </div>
                        <div class="text-center">
                          <a href="index.php?page=biopsiaCE&accion=crearih&id=<?php echo $biopsiace->getIdBio(); ?>" class="btn btn-success" style="margin-right:10px;">Ir a IH</a>                          
                          
                                                        
                        </div>
                      </form>
                </div>
              </div>
        </div>

       <div class="modal hide fade" id="modal-agregar-resultce" tabindex="0" role="dialog" aria-labelledy="tituloModal" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="blue bigger" id="tituloModal">Ingresar Resultado</h3>
            </div>
            <div class="modal-body overflow-hidden">
                <div class="row-fluid">
                    <div class="space-6"></div>
                    <form method="POST" class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label green span3">RESULTADO</label>
                            <div class="controls" >
                                <select class="form-control" style="width:350px;margin-left:-40px;" name="resultado" id="resultado">
                                   <?php if (count($resultados)): ?>
                                      <option value=-1>Seleccione un Resultado</option>
                                      <?php foreach ($resultados as $rt): ?>
                                       <option value="<?php echo $rt->id_res; ?>" <?php if(!empty($_GET["id"])):if($rt->id_res == $biopsiace->getresultadoce()): ?> selected <?php endif; endif; ?> >
                                          <?php echo $rt->descr_res; ?>
                                       </option>
                                      <?php endforeach; ?>
                                   <?php else : ?>
                                      <? echo '<option value=-1> No existen registros </option>'; ?>
                                       <?php endif; ?>
                                </select>
                              </div>
                        </div>
                       
                        <!--<div class="control-group">
                            <label class="control-label green span3">PATOLOGO </label>
                            <div class="controls">
                                <select class="form-control" style="width:350px;margin-left:-40px;" name="valida_patologo" id="valida_patologo">
                                   <?php if (count($pat)): ?>
                                    <option value=-1>Seleccione</option>
                                      <?php foreach ($pat as $pats): ?>
                                       <option value="<?php echo $pats->emp_id ?>">
                                          <?php echo $pats->nombre; ?>
                                       </option>
                                      <?php endforeach; ?>
                                   <?php else : ?>
                                      <? echo '<option value=-1> No existen registros </option>'; ?>
                                       <?php endif; ?>
                                </select> 
                            </div>
                        </div>-->
                        <!--
                        <div class="control-group">
                            <label class="control-label green span3">FECHA DE INFORME</label>
                            <div class="controls">
                                <input type="date" style="width:335px;margin-left:-40px;" class="form-control" id="fecha_informe" name="fecha_informe"  max="<?php echo date("Y-m-d"); ?>">
                            </div>
                        </div>-->

                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-small" data-dismiss="modal"><i class="icon-remove"></i> Cancelar</button>
                <button class="btn btn-small btn-primary"id="btnInsertresult"> <i class="icon-ok"></i>Guardar</button> 
            </div>
        </div>

        <div class="modal hide fade" id="modal-estado2" tabindex="0" role="dialog" aria-labelledy="tituloModal" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="blue bigger" id="tituloModal">¿Esta seguro de finalizar el registro?</h3>
            </div>
            <div class="modal-body overflow-hidden">
                <div class="row-fluid">
                    <div class="space-6">
                        <form method="POST" class="form-horizontal">
                            <div class="control-group">
                                <div class="controls">
                                   <input type="hidden" style="width:275px;" readonly ="true" class=" form-control" name="id_biopsia" id="id_biopsia" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiace->getIdBio(); ?>" <?php endif; ?> > 
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div><!--modal-body-->
            <div class="modal-footer">
                <button class="btn btn-small btn-primary"id="btnActualizar2"> <i class="icon-ok"></i>Si</button>
                <button class="btn btn-small" data-dismiss="modal"><i class="icon-remove"></i> No</button>                
            </div>
        </div>
        <!--modal resultado de marcadores-->
        <div class="modal hide fade" id="modal-agregar-resmarc" tabindex="0" role="dialog" aria-labelledby="tituloModal" aria-hidden="true" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="blue bigger" id="tituloModal">Ingreso de Resultado</h3>  
            </div>
            <div class="modal-body overflow-hidden" >
                <div class="row-fluid">
                    <div class="space-6"></div>
                    <form method="POST" class="form-horizontal">
                       <div class="control-group">
                          <label class="control-label green span2">MARCADOR</label>
                           <div class="controls">
                             <select class="form-control " style="width:350px;margin-left:-70px;" name="id_marc_prueba" id="id_marc_prueba">
                                 <?php if (count($marcadores)): ?>
                              <option value="">Seleccione un Marcador</option>
                               <?php foreach ($marcadores as $marc): ?>
                              <option value="<?php echo $marc->id_marc_prueba ?>">
                                  <?php echo $marc->descr_marcador; ?>
                              </option>
                                <?php endforeach; ?>
                              <?php else : ?>
                               <? echo '<option value=-1> No existen registros </option>'; ?>
                               <?php endif; ?>
                             </select>
                          </div>
                       </div> 
                        <div class="control-group" >
                            <label class="control-label green span2" >RESULTADO</label>
                              <textarea required="required" name="resulih"  cols="100" id="resulih" onkeyup="this.value=this.value.toUpperCase()" class="autosize-transition span12" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 210px;"></textarea>
                      
                        </div>
                    </form>                
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-small" data-dismiss="modal"><i class="icon-remove"></i> Cancelar</button>
                <button class="btn btn-small btn-primary"id="btnInsertaResult"> <i class="icon-ok"></i>Guardar</button>
            </div>
       </div><!--modal resultado-->

       <!--actualizar estado de biopsia luego de registrar el resultado-->
        <div class="modal hide fade" id="modal-finaliza" tabindex="0" role="dialog" aria-labelledy="tituloModal" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="blue bigger" id="tituloModal">¿Esta seguro de finalizar?</h3>
            </div>
            <div class="modal-body overflow-hidden">
                <div class="row-fluid">
                    <div class="space-6">
                        <form method="POST" class="form-horizontal">
                            <div class="control-group">
                                <div class="controls">
                                   <input type="hidden" style="width:275px;" readonly ="true" class=" form-control" name="id_biopsia" id="id_biopsia" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiace->getIdBio(); ?>" <?php endif; ?> > 
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div><!--modal-body-->
            <div class="modal-footer">
                <button class="btn btn-small btn-primary"id="btnFinalizaBio"> <i class="icon-ok"></i>Si</button>
                <button class="btn btn-small" data-dismiss="modal"><i class="icon-remove"></i> No</button>                
            </div>
        </div>


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
        <script src="view/js/bioce.js"></script>
        <script src="assets/js/bootbox.js"></script>
        <script src="view/js/validaciones.js"></script> 
        <script src="view/js/diagnosticopq.js"></script>
        <script src="view/js/procedceih.js"></script>

        <!--inline scripts related to this page-->
        <script >
            $(function() {
                $('#datepicker').datepicker();
                $('#datepicker1').datepicker();
            });
         </script>


    </body>
</html>