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
                                <a href="#">Inmunohistoquimica</a>

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
                                                                        <input type="text" style="width:275px;" readonly="true" class=" form-control" name="numbio"  <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiaih->getNumBio(); ?>" <?php endif; ?> autocomplete="off" autofocus>
                                                                        <input type="hidden" style="width:275px;" readonly ="true" class=" form-control" name="id_biopsia" id="id_biopsia" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiaih->getIdBio(); ?>" <?php endif; ?> >
                                                                        <input type="hidden" style="width:275px;" readonly ="true" class=" form-control" name="numero" id="numero" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiaih->getnumero(); ?>" <?php endif; ?> >
                                                                    </div>
                                                                </div>
                                                               <div class="control-group " style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">DNI</label>
                                                                    <div class="controls">
                                                                        <input type="text" style="width:275px;" readonly="true" class=" form-control" name="dni" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiaih->getDni(); ?>" <?php endif; ?> autocomplete="off" autofocus>
                                                                    </div>
                                                                </div>
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Nombres y Apellidos</label>                                                                    
                                                                    <div class="controls">
                                                                        <input type="text" style="width:275px;" readonly="true" class=" form-control"
                                                                           name="nombre" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiaih->getNombre(); ?>" <?php endif; ?> autocomplete="off">
                                                                    </div>
                                                                </div>
                                                               
                                                                
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Edad</label>
                                                                    <div class="controls">
                                                                        <input type="text" style="width:275px;" readonly="true" class=" form-control"
                                                                           name="edad" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiaih->getEdad(); ?>" <?php endif; ?> autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Sexo</label>
                                                                     <div class="controls">
                                                                          <input type="text" style="width:275px;" readonly="true" class=" form-control"
                                                                           name="sexo" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiaih->getSexo(); ?>" <?php endif; ?> autocomplete="off">
                                                                     </div>
                                                                </div>
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Fecha de Biopsia</label>
                                                                       <div class="controls">
                                                                                <input type="text" style="width:275px;" readonly="true"  class=" form-control"
                                                                                   name="fecha" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiaih->getFecha(); ?>" <?php endif; ?> autocomplete="off">
                                                                       </div> 
                                                                </div>                                                                                                          
                                                            </div><!-- span6 -->
                                                            <div class="span6">

                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Fecha de Ingreso al Servicio</label>
                                                                       <div class="controls">
                                                                                <input type="text" style="width:275px;" readonly="true" class=" form-control"
                                                                                   name="fechaingreso" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiaih->getFechaI(); ?>" <?php endif; ?> autocomplete="off">
                                                                       </div> 
                                                                </div>
                                                                <div class="control-group" style="margin-right: 20px; margin-left:20px;">
                                                                    <label class="control-label">Servicio</label>
                                                                       <div class="controls">
                                                                                <input type="text" style="width:275px;" readonly="true" class=" form-control"
                                                                                   name="servicio" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiaih->getServicio(); ?>" <?php endif; ?> autocomplete="off">
                                                                       </div> 
                                                                </div>
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Medico Tratante</label>
                                                                       <div class="controls">
                                                                                <input type="text" style="width:275px;" readonly="true"  class=" form-control"
                                                                                   name="medicot" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiaih->getMedicoT(); ?>" <?php endif; ?> autocomplete="off">
                                                                       </div> 
                                                                </div>
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Topografia</label>
                                                                       <div class="controls">
                                                                                <input type="text" style="width:275px;" readonly="true"  class=" form-control"
                                                                                   name="topografia" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiaih->getTopografia(); ?>" <?php endif; ?> autocomplete="off">
                                                                       </div> 
                                                                </div>
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Tipo de Seguro</label>
                                                                     <div class="controls">
                                                                          <input type="text" style="width:275px;" readonly="true" class="  form-control"
                                                                           name="tiposeguro" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiaih->getTipoSeguro(); ?>" <?php endif; ?> autocomplete="off">
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
                                                <div class="space-6"></div>
                                                 <div class="table-responsive">
                                                    <h3 class="text-primary blue">Macroscopia<?php if($_SESSION['idusuario']==1 or $_SESSION['idperfil_anat']==2 or $_SESSION['idperfil_anat']==5):?>
                                                        <a class="btn btn-info pull-right" id="btnAgregMacroIH" data-toggle="modal"><i class="icon-pencil icon-on-left bigger-110"></i> &nbsp;Macroscopia</a><?php endif?>  
                                                    </h3>
                                                    
                                                    <table class="table table-bordered table-striped table-condensed table-hover" >
                                                        <thead>
                                                            <tr>
                                                                <th width="40%">Macroscopia</th>
                                                                <?php if($_SESSION['idperfil_anat']==1 or $_SESSION['idperfil_anat']==2 or $_SESSION['idperfil_anat']==6 or $_SESSION['idperfil_anat']==3):?> 
                                                                <th width="10%">Tecnologo Responsable</th>
                                                                <?php endif?>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="ajax_macroih"></tbody>
                                                    </table>      
                                                  </div><!--tabla macroscopia-->
                                                <?php if($_SESSION['idperfil_anat']==5):?> 
                                                <div class="span12 text-center">
                                                   <a id="GuardarEstado2" data-toggle="modal" class="btn btn-primary">Finalizar</a> 
                                                </div>
                                                <?php endif?>
                                                  <br>
                                                  <?php if($_SESSION['idperfil_anat']==1 or $_SESSION['idperfil_anat']==6 or $_SESSION['idperfil_anat']==2 or $_SESSION['idperfil_anat']==3):?>
                                                  <div class="table-responsive">
                                                    <h3 class="text-primary blue">Diagnostico
                                                       <a href="index.php?page=biopsiaIH&accion=crearmarc&id=<?php echo $biopsiaih->getIdBio(); ?>" class="btn btn-sucess pull-right" id="btnmarca" data-toggle="modal"><i class="icon-arrow-right icon-on-left bigger-110"></i> &nbsp;Ir Marcadores</a>
                                                      <a class="btn btn-info pull-right" id="btnAgregDiagnost" data-toggle="modal" style="margin-right:10px;"><i class="icon-pencil icon-on-left bigger-110"></i> &nbsp;Diagnostico</a> 
                                                    </h3>
                                                    
                                                    <table class="table table-bordered table-striped table-condensed table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th width="15%">Muestra Remitida</th>
                                                                <th width="30%">Procedimiento</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="ajax_diagih"></tbody>
                                                    </table>
                                                  </div><!--tabla diagnostico-->                                                 
                                                  <br>
                                                  <div class="table-responsive">
                                                    <h3 class="text-primary blue" >Resultado de Marcadores
                                                      <a class="btn btn-info pull-right" id="btnAgregResIH" data-toggle="modal"><i class="icon-pencil icon-on-left bigger-110"></i> &nbsp;Resultado</a>    
                                                    </h3>
                                                    <table class="table table-bordered table-striped table-condensed table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Marcador</th>
                                                                <th>Resultado</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="ajax_resih"></tbody>
                                                    </table>
                                                  </div><!--tabla resultado-->
                                                  <br>
                                                  <?php endif?>
                                                  <?php if($_SESSION['idperfil_anat']==1 or $_SESSION['idperfil_anat']==6 or $_SESSION['idperfil_anat']==3):?>
                                                  <div class="table-responsive">
                                                    <h3 class="text-primary blue">Conclusion
                                                      <a class="btn btn-info pull-right" id="btnAgregConclusion" data-toggle="modal"><i class="icon-pencil icon-on-left bigger-110"></i> &nbsp;Conclusion</a> 
                                                    </h3>
                                                    <table class="table table-bordered table-striped table-condensed table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Conclusion</th>
                                                                <th>Patologo Responsable</th>
                                                                <th>Fecha de Informe</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="ajax_conclusion"></tbody>
                                                    </table>
                                                  </div><!--tabla conclusion-->
                                                  <div class="span12 text-center">
                                                    <a id="Finalizar" data-toggle="modal" class="btn btn-primary">Finalizar</a> 
                                                  </div>

                                                  <span style="font-weight: bold;"><?php if(!empty($_GET["id"])) :?> Recepcionada por: <?php echo $biopsiaih->getcreacion(); ?> <?php endif; ?></span>
                                                  <br>
                                                  <span style="font-weight: bold;"><?php if(!empty($_GET["id"])) :?> Ultima actualizacion de la macroscopia por: <?php echo $biopsiaih->getmodificamacroih(); ?> <?php endif; ?></span>

                                                  <?php endif?>
                                            </div>
                                        </div>
                                        <div class="space-10"></div>
                                    </div>
                                </div>
                                                                                          
                            </div><!-- span12 -->
                        </div><!-- row-fluid -->
                    </div><!-- page-content -->
            </div> <!-- main content -->
        </div><!-- main container -->
        
        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small ">
            <i class="icon-double-angle-up icon-only bigger-110"></i>
        </a>
       <div class="modal hide fade" id="modal-agregar-macroih" tabindex="0" role="dialog" aria-labelledby="tituloModal" aria-hidden="true" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="blue bigger" id="tituloModal">Ingreso de Macroscopia</h3>                               
            </div>
            <div class="modal-body overflow-hidden" >
                <div class="row-fluid">
                     <div class="space-6"></div>
                     <form method="POST" class="form-horizontal">
                        <div class="control-group" >
                            <label class="control-label green span2" >MACROSCOPIA</label>
                              <textarea required="required" name="macroscopia"  cols="100" id="macroscopia" onkeyup="this.value=this.value.toUpperCase()" class="autosize-transition span12" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 210px;"><?php if(!empty($_GET["id"])) :?><?php echo $biopsiaih->getMacro(); ?><?php endif; ?></textarea>
                      
                        </div>

                     </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-small" data-dismiss="modal"><i class="icon-remove"></i> Cancelar</button>
                <button class="btn btn-small btn-primary"id="btnInsertaMacro"> <i class="icon-ok"></i>Guardar</button>
            </div>
       </div><!--modal macroscopia-->

       <div class="modal hide fade" id="modal-agregar-diagih" tabindex="0" role="dialog" aria-labelledby="tituloModal" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="blue bigger" id="tituloModal">Ingreso de Diagnostico</h3>  
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
                            <label class="control-label green span2" >PROCEDIMIENTO</label>
                             <textarea required="required" name="procedimiento"  cols="100" id="procedimiento" onkeyup="this.value=this.value.toUpperCase()" class="autosize-transition span12" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 90px;"></textarea>
                        </div> 
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-small" data-dismiss="modal"><i class="icon-remove"></i> Cancelar</button>
                <button class="btn btn-small btn-primary"id="btnInsertaDiag"> <i class="icon-ok"></i>Guardar</button>
            </div>
       </div><!--modal diagnostico-->

       <div class="modal hide fade" id="modal-agregar-resih" tabindex="0" role="dialog" aria-labelledby="tituloModal" aria-hidden="true" >
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
                              <textarea required="required" name="resultado"  cols="100" id="resultado" onkeyup="this.value=this.value.toUpperCase()" class="autosize-transition span12" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 210px;"></textarea>
                      
                        </div>
                    </form>                
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-small" data-dismiss="modal"><i class="icon-remove"></i> Cancelar</button>
                <button class="btn btn-small btn-primary"id="btnInsertaResult"> <i class="icon-ok"></i>Guardar</button>
            </div>
       </div><!--modal resultado-->

       <div class="modal hide fade" id="modal-agregar-conclusion" tabindex="0" role="dialog" aria-labelledby="tituloModal" aria-hidden="true" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="blue bigger" id="tituloModal">Conclusion</h3>  
            </div>
            <div class="modal-body overflow-hidden" >
                <div class="row-fluid">
                    <div class="space-6"></div>
                    <form method="POST" class="form-horizontal">
                       <!--
                       <div class="control-group">
                          <label class="control-label green span2">PATOLOGO</label>
                           <div class="controls">
                             <select class="form-control " style="width:350px;margin-left:-70px;" name="valida_patologo" id="valida_patologo">
                                 <?php if (count($pats)): ?>
                              <option value=-1>Seleccione</option>
                               <?php foreach ($pats as $pat): ?>
                              <option value="<?php echo $pat->emp_id ?>">
                                  <?php echo $pat->nombre; ?>
                              </option>
                                <?php endforeach; ?>
                              <?php else : ?>
                               <? echo '<option value=-1> No existen registros </option>'; ?>
                               <?php endif; ?>
                             </select>
                          </div>
                       </div> -->
                       <!--<div class="control-group">
                          <label class="control-label green span2">FECHA DE INFORME</label>
                            <div class="controls">
                                <input type="date" class="form-control" id="fecha_informe" name="fecha_informe" style="width:335px;margin-left:-70px;" max="<?php echo date("Y-m-d"); ?>">
                            </div>
                       </div>-->
                        <div class="control-group" >
                            <label class="control-label green span2" >CONCLUSION</label>
                              <textarea required="required" name="conclusion"  cols="100" id="conclusion" onkeyup="this.value=this.value.toUpperCase()" class="autosize-transition span12" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 210px;"><?php if(!empty($_GET["id"])) :?><?php echo $biopsiaih->getconclu(); ?><?php endif; ?></textarea>
                      
                        </div>
                    </form>                
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-small" data-dismiss="modal"><i class="icon-remove"></i> Cancelar</button>
                <button class="btn btn-small btn-primary"id="btnInsertaConclusion"> <i class="icon-ok"></i>Guardar</button>
            </div>
       </div><!--modal conclusion-->

       <!--guardar estado macroscopia-->
        <div class="modal hide fade" id="modal-estado-macro" tabindex="0" role="dialog" aria-labelledy="tituloModal" aria-hidden="true">
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
                                   <input type="hidden" style="width:275px;" readonly ="true" class=" form-control" name="id_biopsia" id="id_biopsia" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiaih->getIdBio(); ?>" <?php endif; ?> > 
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div><!--modal-body-->
            <div class="modal-footer">
                <button class="btn btn-small btn-primary"id="btnActualizar"> <i class="icon-ok"></i>Si</button>
                <button class="btn btn-small" data-dismiss="modal"><i class="icon-remove"></i> No</button>                
            </div>
        </div>

        <!--actualizar estado de biopsia luego de registrar el resultado-->
        <div class="modal hide fade" id="modal-estado-biopsia" tabindex="0" role="dialog" aria-labelledy="tituloModal" aria-hidden="true">
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
                                   <input type="hidden" style="width:275px;" readonly ="true" class=" form-control" name="id_biopsia" id="id_biopsia" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiaih->getIdBio(); ?>" <?php endif; ?> > 
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div><!--modal-body-->
            <div class="modal-footer">
                <button class="btn btn-small btn-primary"id="btnFinalizar"> <i class="icon-ok"></i>Si</button>
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
        <script src="view/js/bioih.js"></script>
        <script src="assets/js/bootbox.js"></script>
        <script src="view/js/procedih.js"></script>

        <!--inline scripts related to this page-->
        <script >
            $(function() {
                $('#datepicker').datepicker();
                $('#datepicker1').datepicker();
                $('#spinner1').ace_spinner({value:0,min:0,max:200,step:10, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
                .on('change', function(){
                    //alert(this.value)
                });
            });
         </script>


    </body>
</html>