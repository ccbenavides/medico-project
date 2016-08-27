<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Usuarios</title>

        <meta name="description" content="Common UI Features &amp; Elements" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!--basic styles-->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
        <link rel="stylesheet" href="assets/font-awesome-4.3.0/css/font-awesome.css" />

        <!--[if IE 7]>
          <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
        <![endif]-->

        <!--page specific plugin styles-->

        <link rel="stylesheet" href="assets/css/jquery-ui-1.10.3.custom.min.css" />
        <link rel="stylesheet" href="assets/css/jquery.gritter.css" />

        <!--fonts-->

        <link rel="stylesheet" href="assets/css/font.css" />

        <!--ace styles-->
        <link rel="stylesheet" href="assets/css/ace.min.css" />
        <link rel="stylesheet" href="assets/css/ace-responsive.min.css" />
        <link rel="stylesheet" href="assets/css/ace-skins.min.css" />

        <!--DATATABLES-->  
        <link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css" /> 
        <link rel="stylesheet" href="assets/plugins/datatables/dataTables.responsive.css" /> 

        <link rel="shortcut icon" href="assets/img/micros.ico">

        <script src="assets/js/jquery-1.10.2.min.js"></script> 
            
        <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {
        $('#listausuarios').dataTable();
            } );
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
                            <i class="icon-wrench home-icon"></i>
                            <a href="#">Mantenimiento</a>

                            <span class="divider">
                                <i class="icon-angle-right arrow-icon"></i>
                            </span>
                        </li>
                        <li class="active">Usuarios</li>
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
                            
                            <h2 class="header smaller lighter blue">Usuarios</h2>
                            <div class="span12">
                                          <div class="span10">
                                            <h5 class="text-success">Cantidad de registros <span class="badge"><?php echo count($lusuarios); ?></span></h5>
                                        </div>
                                         <div class="span2">
                                            <a class="btn btn-success" href="index.php?page=usuarios&accion=form"><i class="fa-file-o icon-on-left bigger-110"></i>Nuevo</a>
                                        </div>
                           </div>
                        <br><br><br>

                            <div class="table-responsive">
                                <div class="table-header">
                                    Usuarios registrados en el sistema.
                                </div>
                                <table id="listausuarios" class="table table-striped table-bordered table-hover dataTable dt-responsive"  cellspacing="0" width="100%">

                                     <thead>
                                        <tr>
                                            <th>Codigo</th>
                                            <th>Empleado</th>
                                            <th>Usuario</th>
                                            <th>Contraseña</th>
                                            <th>Perfil</th>
                                            <th>Estado</th>
                                            <th>Accion</th>
                                            <th>Ficha</th>
                                        </tr>
                                     </thead>
                                    <tbody>
                                        <?php if (count($lusuarios)): ?>
                                            <?php foreach ($lusuarios as $lusuario): ?>
                                                <tr>
                                                	<td><?php echo $lusuario->id_usuario; ?></td>
                                                	<td><?php echo $lusuario->nombre; ?></td>
                                                	<td><?php echo $lusuario->nom_usuario; ?></td>
                                                	<td><?php echo '*****'; ?></td>
                                                    <td><?php echo $lusuario->descr_perfil; ?></td>
                                                    <td><?php echo $lusuario->estado; ?></td>                                                	                                               	
                                                	<td class="td-actions">
                                                         
                                                        <div class="action-buttons text-center">
                                                           <a class="blue" href="index.php?page=usuarios&accion=modificar&id=<?php echo $lusuario->id_usuario; ?>">
                                                                <i class="icon-pencil bigger-130"></i>
                                                            </a>
                                                            <a class="purple" href="index.php?page=usuarios&accion=alta&id=<?php echo $lusuario->id_usuario;?>">
                                                                <i class="fa fa-plus-circle bigger-130"></i>
                                                            </a>

                                                            <a class="red btn-delete" id="bajar" data-usu="<?php echo $lusuario->nom_usuario; ?>" data-id="<?php echo $lusuario->id_usuario;?>" data-toggle="modal" href="#">
                                                                <i class="fa fa-minus-circle bigger-130"></i>
                                                            </a>
                                                        </div>


                                                    </td>
                                                    <td class="center">
                                                      <a class="red" href="index.php?page=usuarios&accion=registro&id=<?php echo $lusuario->id_usuario;?>" target="_blank">
                                                                <i class="fa fa-file-pdf-o bigger-130"></i>
                                                            </a>  
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <?php echo '<div class="alert alert-warning">No se encontraron registros.</div>'; ?>
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

        <div class="modal hide fade" id="modal-user" tabindex="0" role="dialog" aria-labelledby="tituloModal" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="blue bigger" id="tituloModal">Motivo de Baja</h3>
            </div>
            <div class="modal-body overflow-hidden" >
                <div class="row-fluid" >
                    <div class="space-4"></div>
                    <form method="POST" class="form-horizontal" >
                         <div class="control-group" >                            
                            <label class="control-label green span2">Usuario</label>
                            <div class="controls span3">
                                <input type="text" name="usunomb" id="usunomb"  readonly="true" class="form-control"/>
                                <input type=hidden name="id_usuario" id="id_usuario" class="form-control">
                            </div>
                         </div>
                         <div class="control-group" >
                            <label class="control-label green span2" >Motivo</label>
                              <textarea required="required" name="motivo"  cols="100" id="motivo" onkeyup="this.value=this.value.toUpperCase()" class="autosize-transition span12" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 90px; width:400px;margin-left:15px;"></textarea>
                         </div>
                         <div id="mensaje"></div>
                    </form>

                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-small" data-dismiss="modal"><i class="icon-remove"></i> Cancelar</button>
                <button class="btn btn-small btn-primary"id="btnInsertarUsu"> <i class="icon-ok"></i>Registrar</button>
            </div>


        </div>






    <script src="assets/js/jquery.min.js"></script>

        <!--<![endif]-->

        <!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

        <!--[if !IE]>-->

        <script type="text/javascript">
            window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
        </script>

        <!--<![endif]-->

        <!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
        <script src="assets/js/jquery-1.10.2.min.js"></script> 
        <script type="text/javascript">
            if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
        </script>
        <script src="assets/js/bootstrap.min.js"></script>

        <!--page specific plugin scripts-->

        <!--[if lte IE 8]>
          <script src="assets/js/excanvas.min.js"></script>
        <![endif]-->

        <script src="assets/js/jquery-ui-1.10.3.custom.min.js"></script>
        <script src="assets/js/jquery.ui.touch-punch.min.js"></script>
        <script src="assets/js/bootbox.min.js"></script>
        <script src="assets/js/jquery.easy-pie-chart.min.js"></script>
        <script src="assets/js/jquery.gritter.min.js"></script>
        <script src="assets/js/spin.min.js"></script>

        <!--ace scripts-->

        <script src="assets/js/ace-elements.min.js"></script>
        <script src="assets/js/ace.min.js"></script>
        <!--datatables js-->

        <script src="assets/js/jquery.dataTables.js"></script>
        <script src="assets/js/jquery.dataTables.bootstrap.js"></script>
        <script src="assets/js/dataTables.responsive.js"></script>
        <script src="view/js/usuarios.js"></script>
        <script src="assets/js/bootbox.js"></script>  
         <script type="text/javascript">  
            
            $(document).on("click", ".purple", function(e) {
                var link = $(this).attr("href"); // "get" the intended link in a var
                e.preventDefault();    
                bootbox.confirm("¿Esta seguro de querer dar de alta el usuario?", function(result) {    
                    if (result) {
                        document.location.href = link;  // if result, "set" the document location       
                    }    
                });
            });
        </script>

        <!--inline scripts related to this page-->


    </body>
</html>
