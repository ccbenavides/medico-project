<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Muestras Asignadas</title>
  
        <!--favicon-->
        <link rel="shortcut icon" href="assets/img/favicon.ico">

        <!--basic styles--> 
              
        <link href="assets/plugins/bootstrap/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/plugins/bootstrap/bootstrap-responsive.min.css" rel="stylesheet" />
        <!--<link rel="stylesheet" href="assets/css/bootstrap-modal.css">-->
        <link rel="stylesheet" href="assets/css/ace.min.css" />
        <link rel="stylesheet" href="assets/css/ace-responsive.min.css" />
        <link rel="stylesheet" href="assets/css/ace-skins.min.css" />
        <link rel="stylesheet" href="assets/css/bootstrap-timepicker.css" />
        <link rel="stylesheet" type="text/css" href="assets/datepicker-1.5.1/css/bootstrap-datepicker.css">
        

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
            $(document).on('ready',function() {
                $('#id_codigo').on('change',function() {
                    var datos=$('#id_codigo').val();
                    if (datos==38) {
                        $('#otrobet').show();
                    } else{
                        $('#otrobet').hide();
                    };

                });
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
                                <a href="#">Citologia Cervico Vaginal</a>

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
                                                                        <input type="text" style="width:275px;" readonly ="true" class=" form-control" name="numbio" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiaccv->getNumBio(); ?>" <?php endif; ?> autocomplete="off" autofocus>
                                                                        <input type="hidden" style="width:275px;" readonly ="true" class=" form-control" name="id_biopsia" id="id_biopsia" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiaccv->getIdBio(); ?>" <?php endif; ?> >
                                                                    </div>
                                                                </div>
                                                               <div class="control-group " style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">DNI</label>
                                                                    <div class="controls">
                                                                        <input type="text" style="width:275px;" readonly ="true" class=" form-control" name="dni" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiaccv->getDni(); ?>" <?php endif; ?> autocomplete="off" autofocus>
                                                                    </div>
                                                                </div>
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Nombres y Apellidos</label>
                                                                    
                                                                    <div class="controls">
                                                                        <input type="text" style="width:275px;" readonly ="true" class=" form-control"
                                                                           name="nombres" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiaccv->getNombre(); ?>" <?php endif; ?> autocomplete="off">
                                                                    </div>
                                                                </div>
                                                               
                                                                
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Edad</label>
                                                                    <div class="controls">
                                                                        <input type="text" style="width:275px;" readonly ="true" class=" form-control"
                                                                           name="edad" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiaccv->getEdad(); ?>" <?php endif; ?> autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Sexo</label>
                                                                     <div class="controls">
                                                                          <input type="text" style="width:275px;" readonly ="true" class="  form-control"
                                                                           name="sexo" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiaccv->getSexo(); ?>" <?php endif; ?> autocomplete="off">
                                                                     </div>
                                                                </div>
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Fecha de Ingreso al Servicio</label>
                                                                       <div class="controls">
                                                                                <input type="text" style="width:275px;" readonly ="true" class=" form-control"
                                                                                   name="fechaingreso" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiaccv->getFechaI(); ?>" <?php endif; ?> autocomplete="off">
                                                                       </div> 
                                                                </div>
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Servicio</label>
                                                                       <div class="controls">
                                                                                <input type="text" style="width:275px;" readonly ="true"  class=" form-control"
                                                                                   name="servicio" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiaccv->getServicio(); ?>" <?php endif; ?> autocomplete="off">
                                                                       </div> 
                                                                </div>
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Gestante</label>
                                                                       <div class="controls">
                                                                                <input type="text" style="width:275px;" readonly ="true"  class=" form-control"
                                                                                   name="gestante" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiaccv->getgestante(); ?>" <?php endif; ?> autocomplete="off">
                                                                       </div> 
                                                                </div>
                                                            </div><!-- span6 -->
                                                            <div class="span6">
                                                               <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Gesta</label>
                                                                       <div class="controls">
                                                                                <input type="text" style="width:275px;" readonly ="true"  class=" form-control"
                                                                                   name="gesta" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiaccv->getgesta(); ?>" <?php endif; ?> autocomplete="off">
                                                                       </div> 
                                                                </div>
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Para</label>
                                                                       <div class="controls">
                                                                                <input type="text" style="width:275px;" readonly ="true"  class=" form-control"
                                                                                   name="para" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiaccv->getpara(); ?>" <?php endif; ?> autocomplete="off">
                                                                       </div> 
                                                                </div>
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Mac</label>
                                                                       <div class="controls">
                                                                                <input type="text" style="width:275px;" readonly ="true"  class=" form-control"
                                                                                   name="mac" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiaccv->getmac(); ?>" <?php endif; ?> autocomplete="off">
                                                                       </div> 
                                                                </div>
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Fur</label>
                                                                       <div class="controls">
                                                                                <input type="text" style="width:275px;" readonly ="true"  class=" form-control"
                                                                                   name="fur" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiaccv->getfur(); ?>" <?php endif; ?> autocomplete="off">
                                                                       </div> 
                                                                </div>
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Pap Anterior</label>
                                                                       <div class="controls">
                                                                                <input type="text" style="width:275px;" readonly ="true"  class=" form-control"
                                                                                   name="pap" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiaccv->getpap(); ?>" <?php endif; ?> autocomplete="off">
                                                                       </div> 
                                                                </div>
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Diagnostico Clinico</label>
                                                                       <div class="controls">
                                                                                <input type="text" style="width:275px;" readonly ="true"  class=" form-control"
                                                                                   name="diagclinico" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiaccv->getDiagClinico(); ?>" <?php endif; ?> autocomplete="off">
                                                                       </div> 
                                                                </div>
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Observacion</label>
                                                                       <div class="controls">
                                                                                <input type="text" style="width:275px;" readonly ="true"  class=" form-control"
                                                                                   name="observacion" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiaccv->getObs(); ?>" <?php endif; ?> autocomplete="off">
                                                                       </div> 
                                                                </div>
                                                                
                                                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                                    <label class="control-label">Tipo de Seguro</label>
                                                                     <div class="controls">
                                                                          <input type="text" style="width:275px;" readonly ="true" class="  form-control"
                                                                           name="tiposeguro" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiaccv->getTipoSeguro(); ?>" <?php endif; ?> autocomplete="off">
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

                                <div class="row-fluid" id="diagnostico_final">
                                  <div class="span12">
                                      <div class="widget-box">
                                        <div class="widget-header">
                                            <h4><i class="fa fa-stethoscope pink"></i>Muestra Remitida: <?php echo $biopsiaccv->getMuestra(); ?></h4>

                                            <div class="widget-toolbar">
                                                <a href="#" data-action="collapse">
                                                        <i class="icon-chevron-up"></i>
                                                </a>    
                                            </div>
                                            
                                        </div><!--widget-header diagnostico-->
                                        <div class="widget-body">
                                            <div class="widget-main">
                                               <div class="row-fluid">
                                                  <div class="space-6"></div>
                                                   <div class="table-responsive">
                                                        <h3 class="text-primary blue">Detalle de Diagnostico
                                                          <a class="btn btn-info pull-right" id="btnAgregarDiag" data-toggle="modal"><i class="icon-pencil icon-on-left bigger-110"></i> &nbsp; Diagnostico</a>  
                                                        </h3>
                                                        <hr>
                                                        <table class="table table-bordered table-striped table-condensed table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th width="45%">DIAGNOSTICO</th>
                                                                    <th width="20%">CODIGO BETHSDA</th>                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody id="ajax_diagnosticoccv"></tbody>
                                                        </table>
                                                        
                                                  </div> <!--tabla de diagnostico-->
                                                  <br>
                                                  <div class="table-responsive">
                                                        <h3 class="text-primary blue">Descripcion
                                                          <a class="btn btn-info pull-right" id="btnAgregarDesc" data-toggle="modal"><i class="icon-pencil icon-on-left bigger-110"></i> &nbsp; Descripcion</a>  
                                                        </h3>
                                                        <hr>
                                                        <table class="table table-bordered table-striped table-condensed table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th width="10%">PATOLOGO RESPONSABLE</th>
                                                                    <th width="10%">TECNOLOGO RESPONSABLE</th>  
                                                                    <th width="30%">DESCRIPCION</th>
                                                                    <th width="10%">FECHA DE INFORME</th>                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody id="ajax_descripcion"></tbody>
                                                        </table>
                                                        
                                                  </div><!--tabla descripcion-->
                                                  <div class="span12 text-center">
                                                    <a class="btn btn-success blue" href="index.php?page=reportes&amp;accion=infpacccv&amp;id=<?php echo $_GET['id'] ?>" target="_blank">Vista Previa</a>&nbsp;&nbsp;
                                                    <a id="Finalizarccv" data-toggle="modal" class="btn btn-primary">Finalizar</a> 
                                                  </div>

                                                   <span style="font-weight: bold;"><?php if(!empty($_GET["id"])) :?> Recepcionada por: <?php echo $biopsiaccv->getcreacion(); ?> <?php endif; ?></span>

                                               </div> 
                                            </div><!--widget-main-->
                                        </div><!--widget-body-->
                                      </div><!--widget-box--> 
                                  </div><!--span12-->  
                                </div><!--row-fluid diagnostico-->
                              
                            
                            </div><!-- span12 -->
                        </div><!-- row-fluid -->
                    </div><!-- page-content -->
            </div> <!-- main content -->
        </div><!-- main container -->
        
        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small ">
            <i class="icon-double-angle-up icon-only bigger-110"></i>
        </a>
        <!--diagnostico-->
        <div class="modal hide fade" style="width:800px;position:center;" id="modal-agregar-diagnostico" tabindex="0" role="dialog" aria-labelledby="tituloModal" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="blue bigger" id="tituloModal">Detalles de Diagnostico</h3>
            </div>
             <div class="modal-body overflow-hidden">
                <div class="row-fluid">
                    <div class="space-6"></div>
                    
                    <form method="POST" class="form-horizontal">
                       <div class="control-group" >
                            <label class="control-label green span2" for="form-field-2">DIAGNOSTICO</label>
                              <div class="controls span3">
                                <select class="form-control" required style="width:400px;" name="id_diagccv" id="id_diagccv">
                                   <?php if (count($diagcv)): ?>
                                      <option value="">Seleccione un Diagnostico</option>
                                      <?php foreach ($diagcv as $diag): ?>
                                       <option value="<?php echo $diag->id_diagccv ?>" <?php if(!empty($_GET["id"])):if($diag->id_diagccv == $biopsiaccv->getdiagccv()): ?> selected <?php endif; endif; ?> >
                                          <?php echo $diag->descr_diagccv; ?>
                                       </option>
                                      <?php endforeach; ?>
                                   <?php else : ?>
                                      <? echo '<option value=-1> No existen registros </option>'; ?>
                                       <?php endif; ?>
                                </select>
                              </div>
                        </div>
                        <div class="control-group" >
                            <label class="control-label green span2">CODIGO BETHSDA</label>
                              <div class="controls">
                               <select class="form-control" style="width:400px;margin-left:-50px;" name="id_codigo" id="id_codigo">
                                  <?php if (count($codbcv)): ?>
                                    <option value="">Seleccione un Codigo</option>
                                    <?php foreach ($codbcv as $codb): ?>
                                      <option value="<?php echo $codb->id_codigo ?>" <?php if(!empty($_GET["id"])):if($codb->id_codigo == $biopsiaccv->getidcodigo()): ?> selected <?php endif; endif; ?> >
                                       <?php echo $codb->descr_codigo; ?>
                                      </option>
                                    <?php endforeach; ?>
                                   <?php else : ?>
                                    <? echo '<option value=-1> No existen registros </option>'; ?>
                                  <?php endif; ?>
                                </select>
                              </div>
                        </div>
                        <div class="control-group"  id="otrobet" hidden >
                            <label class="control-label green span2">CODIGO</label>
                              <div class="controls">
                                <input type="text" style="width:390px;margin-left:-65px;" onkeyup="this.value=this.value.toUpperCase()" name="otro_codbet" id="otro_codbet" class="form-control"/>
                              </div>
                        </div>
                     </form>   
                       
                    
                </div>
             </div>
             <div class="modal-footer">
                <button class="btn btn-small" data-dismiss="modal"><i class="icon-remove"></i> Cancelar</button>
                <button class="btn btn-small btn-primary"id="btnInsertarDiagnostico"> <i class="icon-ok"></i>Guardar</button>
             </div>

        </div><!--modal diagnostico-->
    <!--descripcion-->
        <div class="modal hide fade"  id="modal-agregar-descripcion" tabindex="-1" role="dialog" aria-labelledby="tituloModal" aria-hidden="true">
           <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="blue bigger" id="tituloModal">Ingresar Descripcion y Tecnologo</h3>
           </div> 
           <div class="modal-body overflow-visible">
               <div class="row-fluid">
                  <div class="space-6"></div>
                  
                    <form method="POST" class="form-horizontal" >
                        <div class="control-group" >
                            <label class="control-label green span2">TECNOLOGO </label>
                              <div class="controls" >
                                <select class="form-control" style="width:350px;margin-left:-70px;" name="tecnologo" id="tecnologo">
                                   <?php if (count($tecs)): ?>
                                      <option value="">Seleccione un Tecnologo</option>
                                      <?php foreach ($tecs as $tec): ?>
                                       <option value="<?php echo $tec->emp_id; ?>" <?php if(!empty($_GET["id"])):if($tec->emp_id == $biopsiaccv->getTecn()): ?> selected <?php endif; endif; ?> >
                                          <?php echo $tec->nombre; ?>
                                       </option>
                                      <?php endforeach; ?>
                                   <?php else : ?>
                                      <? echo '<option value=-1> No existen registros </option>'; ?>
                                       <?php endif; ?>
                                </select>
                              </div>
                        </div>
                        <!--<div class="control-group" >
                            <label class="control-label green span2">FECHA DE INFORME</label>
                                <div class="controls">
                                    <input type="date" style="width:335px;margin-left:-70px;" class="form-control" id="fecha_informe" style="width:235px;" name="fecha_informe"  max="<?php echo date("Y-m-d"); ?>">
                                </div>   
                        </div>-->
                        <div class="control-group" style="margin-right: 20px;">
                            <label class="control-label green span2" >DESCRIPCION</label>
                            
                                <textarea required="required" name="descripcion"  cols="100" id="descripcion" onkeyup="this.value=this.value.toUpperCase()" class="autosize-transition span12" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 210px;"><?php if(!empty($_GET["id"])) :?><?php echo $biopsiaccv-> getDescripcion(); ?><?php endif; ?></textarea>
                            
                        </div>  

                        <div class="control-group">
                            <label class="control-label green span4">FECHA DE INFORME</label>
                            <div class="controls">
                                <div class="row-fluid input-append" >
                                    <input class="span8 date-picker" id="fecha_informe" type="text" data-date-format="dd-mm-yyyy">
                                        <span class="add-on">
                                            <i class="icon-calendar"></i>
                                        </span>
                                </div> 
                            </div>
                        </div> 
                                    
                    </form>
                    

                    
               </div> 
           </div><!--modal-body-->
           <div class="modal-footer">
                <button class="btn btn-small" data-dismiss="modal"><i class="icon-remove"></i> Cancelar</button>
                <button class="btn btn-small btn-primary"id="btnInsertarDescripcion"> <i class="icon-ok"></i>Guardar</button>
            </div>
        </div><!--modal descripcion-->
        
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
                                   <input type="hidden" style="width:275px;" readonly ="true" class=" form-control" name="id_biopsia" id="id_biopsia" <?php if(!empty($_GET["id"])) :?> value="<?php echo $biopsiaccv->getIdBio(); ?>" <?php endif; ?> > 
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div><!--modal-body-->
            <div class="modal-footer">
                <button class="btn btn-small btn-primary"id="btnFinalizarccv"> <i class="icon-ok"></i>Si</button>
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
        <script src="assets/datepicker-1.5.1/js/bootstrap-datepicker.js"></script>
        <script src="assets/datepicker-1.5.1/locales/bootstrap-datepicker.es.min.js"></script>  
        <script src="assets/js/date-time/bootstrap-datepicker.min.js"></script>
        <script src="view/js/toparea.js"></script>
        <script src="assets/js/bootbox.js"></script>
        <script src="assets/js/bootbox.min.js"></script>
        <script src="assets/js/chosen.jquery.js"></script>

         <script type="text/javascript">
             $(document).ready(function() {
                 $('#fecha_informe').datepicker({
                    language: "es",
                    format: "dd/mm/yyyy",
                    autoclose: true,

                });
             });
         </script>

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