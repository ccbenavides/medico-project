<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        
        <title>Estado de Biopsia</title>
        
         
         <!--favicon-->
       <link rel="shortcut icon" href="assets/img/micros.ico">


        <!--basic styles--> 
         <link href="assets/css/chosen.css" rel="stylesheet">     
        <link href="assets/plugins/bootstrap/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/plugins/bootstrap/bootstrap-responsive.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/css/ace.min.css" />
        <link rel="stylesheet" href="assets/css/ace-responsive.min.css" />
        <link rel="stylesheet" href="assets/css/ace-skins.min.css" />

        <!--fonts&iconos-->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
        <link rel="stylesheet" href="assets/font-awesome-4.3.0/css/font-awesome.min.css" />        
        <!--[if IE 7]>
        <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
        <![endif]-->
        <link rel="stylesheet" href="assets/css/font.css" />
        <link rel="stylesheet" href="assets/css/bootstrap-timepicker.css" />
        <link rel="stylesheet" href="assets/css/datepicker.css" />

        <!--DATATABLES-->  
        <link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css" /> 
        <link rel="stylesheet" href="assets/plugins/datatables/dataTables.responsive.css" /> 

        
        
    
        <script src="assets/js/jquery-1.10.2.min.js"></script>
        
        <script type="text/javascript" charset="utf-8">
            $(document).ready(function() {
            $('#listarbitacora').dataTable();
                });
         </script>

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
                            <li class="active">Estado de Biopsia</li>
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
                            <h2 class="header smaller lighter blue">Estado de Biopsia</h2>
                            <div class="span6">
                               <div class="control-group " style="margin-right: 20px;">
                                    <div class="controls">
                                                                          <select class="form-control" name="area" id="area" required>
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
                                <div class="control-group row-fluid" style="margin-top:-50px; margin-left:320px;">
                                               <div class="span12 row-fluid input-append">
                                                <div class="controls span7">
                                                    <input class="span6 date-picker" placeholder="Seleccione una fecha" id="fecha" name="fecha" type="text" data-date-format="yyyy-mm-dd" required/>
                                                        <span class="add-on">
                                                            <i class="icon-calendar"></i>
                                                        </span>

                                                </div>                                                
                                </div>
                                </div> 
                            </div>
                            
                            <div class="row-fluid span12" style="margin-left:-5px;">
                                <div id="tablaestado">
                                   <div class="table-responsive">
                                       <div class="table-header">
                                            Biopsias registradas en el sistema.
                                        </div>

                                        <table id="listarbitacora" class="table table-striped table-bordered table-hover dataTable dt-responsive" cellspacing="0" width="100%">
                                            
                                        <thead>
                                           <tr>
                                                <th>Numero de Biopsia</th>
                                                <th>Fecha de Ingreso</th>
                                                <th>Tecnologo Responsable</th>
                                                <th>Patologo Responsable</th>
                                                <th>Estado</th>
                                                <th>Accion</th>
                    
                                           </tr>
                                        </thead>

                                        </table>
                                        
                                    </div><!--span12-->
                                </div>
                            </div><!--rowfluid-->
                                                              
                         </div><!--span12--><!-- registros datos empleado-->


                      </div> <!--row-fluid-->


                      

                     </div><!--row-fluid -->
     

        <!-- / le javascript -->
        <!-- // <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script> -->
        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small ">
            <i class="icon-double-angle-up icon-only bigger-110"></i>
        </a>

        <div class="modal hide fade" id="modal-user" tabindex="0" role="dialog" aria-labelledby="tituloModal" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="blue bigger" id="tituloModal">Autorizar Edicion</h3>
            </div>
            <div class="modal-body overflow-hidden" >
                <div class="row-fluid" >
                    <div class="space-4"></div>
                    <form method="POST" class="form-horizontal" >
                        <div class="control-group">
                            <label class="control-label green span2">Editar</label>
                             <div class="controls span3">
                                   <select class="form-control" name="edicion" id="edicion">
                                        <option value="">Seleccione Estudio</option>
                                       <option value="1">Estudio Macroscopico</option>
                                       <option value="2">Estudio Microscopico</option>   
                                    </select> 
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label green span2">Motivo</label>
                             <div class="controls span3">
                                   <select class="form-control" name="descr" id="descr">
                                        <option value="">Seleccione</option>
                                       <option value="1">Error</option>
                                       <option value="2">Omision</option>  
                                       <option value="3">Otro</option>  
                                    </select> 
                            </div>
                        </div>
                         <div class="control-group" >
                            <label class="control-label green span2" >Descripcion</label>
                              <textarea required="required" name="motivo"  cols="100" id="motivo" onkeyup="this.value=this.value.toUpperCase()" class="autosize-transition span12" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 90px; width:400px;margin-left:15px;"></textarea>
                              <input type=hidden name="id_biopsia" id="id_biopsia" class="form-control">
                         </div>
                         <div id="mensaje"></div>
                    </form>

                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-small" data-dismiss="modal"><i class="icon-remove"></i> Cancelar</button>
                <button class="btn btn-small btn-primary"id="btnInsertarEdicion"> <i class="icon-ok"></i>Registrar</button>
            </div>


        </div>

        <div class="modal hide fade" id="modal-desautoriza" tabindex="0" role="dialog" aria-labelledby="tituloModal" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="blue bigger" id="tituloModal">Desautorizar Edicion</h3>
            </div>
            <div class="modal-body overflow-hidden" >
                <div class="row-fluid" >
                    <div class="space-4"></div>
                    <form method="POST" class="form-horizontal" >
                        <div class="control-group">
                            <label class="control-label green span2">Estudio</label>
                             <div class="controls span3">
                                   <select class="form-control" name="ediciones" id="ediciones">
                                        <option value="">Seleccione Estudio</option>
                                       <option value="1">Estudio Macroscopico</option>
                                       <option value="2">Estudio Microscopico</option>   
                                    </select> 
                            </div>
                            <input type=hidden name="id_biopsia1" id="id_biopsia1" class="form-control">
                        </div>
                        <!--<div class="control-group" >
                            <label class="control-label green span2" >Motivo</label>
                              <textarea required="required" name="motivodes"  cols="100" id="motivodes" onkeyup="this.value=this.value.toUpperCase()" class="autosize-transition span12" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 90px; width:400px;margin-left:15px;"></textarea>
                              <input type=hidden name="id_biopsia1" id="id_biopsia1" class="form-control">
                         </div>-->
                         <div id="mensajero"></div>
                    </form>

                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-small" data-dismiss="modal"><i class="icon-remove"></i> Cancelar</button>
                <button class="btn btn-small btn-primary"id="btnEliminarEdicion"> <i class="icon-ok"></i>Registrar</button>
            </div>


        </div>

        <!-- // <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script> -->
        <script src="view/js/jquery-2.0.3.min.js"></script>
        <script type="text/javascript">
            if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
        </script>
        <script src="assets/js/bootstrap.min.js"></script>
               
         <!--page specific plugin scripts-->
        <script src="assets/js/date-time/bootstrap-timepicker.min.js"></script>
        <script src="assets/js/date-time/bootstrap-datepicker.min.js"></script> 

        <script src="assets/js/jquery.dataTables.js"></script>
        <script src="assets/js/jquery.dataTables.bootstrap.js"></script>
        <script src="assets/js/dataTables.responsive.js"></script>
        <script src="assets/js/chosen.jquery.js"></script>
        <!--ace scripts-->
        <script src="view/js/jsautoriza/autoriz.js"></script>
        <script src="assets/js/style-elements.min.js"></script>
        <script src="assets/js/style.min.js"></script>
        <script src="assets/js/bootbox.js"></script>

        <style>
            .personal {
                font-size: 13px;
            }
        </style>

        <script src="assets/js/chosen.jquery.js"></script>
        <script type="text/javascript">
           
                 $('.date-picker').datepicker().next().on(ace.click_event, function(){
                    });
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
    </body>

    </body>
</html>