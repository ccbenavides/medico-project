<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="description" content="overview &amp; stats" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Biopsias</title>
        <link href="assets/plugins/bootstrap/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/plugins/bootstrap/bootstrap-responsive.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/css/ace.min.css" />
        <link rel="stylesheet" href="assets/css/ace-responsive.min.css" />
        <link rel="stylesheet" href="assets/css/ace-skins.min.css" />

        <!--fonts&iconos-->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
        <link rel="stylesheet" href="assets/font-awesome-4.3.0/css/font-awesome.css">
            
        <link rel="stylesheet" href="assets/css/font.css" />

        <!--DATATABLES-->  
        <link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css" /> 
        <link rel="stylesheet" href="assets/plugins/datatables/dataTables.responsive.css" /> 

       <link rel="shortcut icon" href="assets/img/micros.ico">
        
    
        <script src="assets/js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" charset="utf-8">
                $(document).ready(function() {
                    $('#listarbiopsias').dataTable();
                } );
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
                            <a href="#">Mantenimiento</a>

                            <span class="divider">
                                <i class="icon-angle-right arrow-icon"></i>
                            </span>
                        </li>
                        <li class="active">Biopsias</li>
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
                   <!--      <div class="row-fluid"> -->
                            
                            <h2 class="header smaller lighter blue">Biopsias</h2>
                            <div class="span12">
                                          <div class="span10">
                                            <h5 class="text-success">Cantidad de registros <span class="badge"><?php echo count($listadod); ?></span></h5>
                                        </div>
                                         <!-- <div class="span2">
                                            <a class="btn btn-app btn-mini btn-primary"href="index.php?page=paciente&accion=form">Nuevo</a>
                                        </div> -->
                           </div>
                        <br><br><br>

                            <div class="table-responsive">
                                <div class="table-header">
                                   Biopsias registradas en el sistema.
                                </div>


                             <table id="listarbiopsias"  class="table table-striped table-bordered table-hover dataTable dt-responsive"  cellspacing="0" width="100%">
                                             <thead>
                                                <tr>
                                                    <th>Codigo</th>
                                                    <th>Numero Biopsia</th>
                                                    <th>Paciente</th>
                                                    <th>Fecha de Ingreso</th>
                                                    <th>Estado</th>
                                                    <th>Accion</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (count($listadod)): ?>
                                                    <?php foreach ($listadod as $pac): ?>
                                                        <tr>
                                                            <td><?php echo $pac->id_biopsia; ?></td>
                                                            <td><?php echo $pac->num_biopsia; ?></td>
                                                            <td><?php echo $pac->paciente; ?></td>
                                                            <td><?php echo $pac->fecha_ingreso; ?></td>
                                                            <td><?php echo $pac->estado_biopsia; ?></td>
                                                            <td class="td-actions center">
                                                               <div class="action-buttons text-center">
                                                                   <a class="purple" id="alta" data-num="<?php echo $pac->num_biopsia; ?>" data-id="<?php echo $pac->id_biopsia;?>" data-toggle="modal">
                                                                <i class="fa fa-plus-circle bigger-130"></i>
                                                            </a>

                                                            <a class="red btn-delete" id="bajar" data-usu="<?php echo $pac->num_biopsia; ?>" data-id="<?php echo $pac->id_biopsia;?>" data-toggle="modal" >
                                                                <i class="fa fa-minus-circle bigger-130"></i>
                                                            </a>
                                                               </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <?php echo '<div class="alert alert-warning">
                                                                <p><span class="blue">El paciente no se  encuentra registrado.</span></p>
                                                                </div>'; ?>
                                                <?php endif; ?>
                                            </tbody>

                            </table>
                            </div>  <!-- table-responsive -->
                     </div><!-- span12 -->
<!-- 
                    </div> -->
                </div><!-- row-f -->


            </div><!-- page -->

        </div><!-- main-content -->

        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small ">
            <i class="icon-double-angle-up icon-only bigger-110"></i>
        </a>
        

        <div class="modal hide fade" id="modal-biopsia" tabindex="0" role="dialog" aria-labelledby="tituloModal" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="blue bigger" id="tituloModal">Dar de Baja - Biopsia</h3>
            </div>
            <div class="modal-body overflow-hidden" >
                <div class="row-fluid" >
                    <div class="space-4"></div>
                    <form method="POST" class="form-horizontal" >
                         <div class="control-group" >                            
                            <label class="control-label green span2">N° Biopsia</label>
                            <div class="controls span3">
                                <input type="text" name="usunomb" id="usunomb"  readonly="true" class="form-control"/>
                                <input type=hidden name="id_biopsia" id="id_biopsia" class="form-control">
                            </div>
                         </div>
                          <div class="control-group" >
                            <label class="control-label green span2" >Motivo</label>
                              <textarea required="required" name="motivob"  cols="100" id="motivob" onkeyup="this.value=this.value.toUpperCase()" class="autosize-transition span12" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 90px; width:400px;margin-left:15px;"></textarea>
                         </div>
                         <div id="mensaje"></div>
                    </form>

                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-small btn-danger" data-dismiss="modal"><i class="icon-remove"></i> Cancelar</button>
                <button class="btn btn-small btn-primary"id="btnInsertarbaja"> <i class="icon-ok"></i>Aceptar</button>
            </div>
        </div>

        <div class="modal hide fade" id="modal-altabiopsia" tabindex="0" role="dialog" aria-labelledby="tituloModal" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="blue bigger" id="tituloModal">Dar de Alta - Biopsia</h3>
            </div>
            <div class="modal-body overflow-hidden" >
                <div class="row-fluid" >
                    <div class="space-4"></div>
                    <form method="POST" class="form-horizontal" >
                         <div class="control-group" >                            
                            <label class="control-label green span2">N° Biopsia</label>
                            <div class="controls span3">
                                <input type="text" name="nbiopsia" id="nbiopsia"  readonly="true" class="form-control"/>
                                <input type=hidden name="idbio" id="idbio" class="form-control">
                            </div>
                         </div>
                          <div class="control-group" >
                            <label class="control-label green span2" >Motivo</label>
                              <textarea required="required" name="motivobio"  cols="100" id="motivobio" onkeyup="this.value=this.value.toUpperCase()" class="autosize-transition span12" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 90px; width:400px;margin-left:15px;"></textarea>
                         </div>
                         <div id="mensajeb"></div>
                    </form>

                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-small btn-danger" data-dismiss="modal"><i class="icon-remove"></i> Cancelar</button>
                <button class="btn btn-small btn-primary"id="btnInsertaralta"> <i class="icon-ok"></i>Aceptar</button>
            </div>
        </div>
        
        
        <script src="assets/js/bootstrap.min.js"></script>
   

        <!--datatables js-->

        <script src="assets/js/jquery.dataTables.js"></script>
        <script src="assets/js/jquery.dataTables.bootstrap.js"></script>
        <script src="assets/js/dataTables.responsive.js"></script>

        <!--ace scripts-->

        <script src="assets/js/style-elements.min.js"></script>
        <script src="assets/js/style.min.js"></script>
        <script src="view/js/biopsias.js"></script>
  
        <!--inline scripts related to this page-->
        
         <script src="assets/js/bootbox.js"></script>  

       
    </body>
</html>