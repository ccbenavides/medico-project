<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Guia Medico</title>

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
        $('#listarguias').dataTable();
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
                            <i class="icon- fa fa-book"></i>
                            <a href="#">Guia M&eacute;dico</a>

                            <span class="divider">
                                <i class="icon-angle-right arrow-icon"></i>
                            </span>
                        </li>
                        <li class="active">Protocolos de Microscopia</li>
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
                            
                            <h2 class="header smaller lighter blue">Protocolos de Microscopia</h2>
                            <div class="span12">
                                          <div class="span10">
                                            <h5 class="text-success">Cantidad de registros <span class="badge"><?php echo count($lguia); ?></span></h5>
                                        </div>
                                         <div class="span2">
                                            <a class="btn btn-success" href="index.php?page=mantenimiento&accion=formguia"><i class="fa-file-o icon-on-left bigger-110"></i>Nuevo</a>
                                        </div>
                           </div>
                        <br><br><br>

                            <div class="table-responsive">
                                <div class="table-header">
                                    Guias registradas en el sistema.
                                </div>
                                <table id="listarguias" class="table table-striped table-bordered table-hover dataTable dt-responsive"  cellspacing="0" width="100%">

                                     <thead>
                                        <tr>
                                            <th>Codigo</th>
                                            <th>Tipo de Guia</th>
                                            <th>Descripcion</th>
                                            <th>URL</th>
                                            <th>Accion</th>
                                        </tr>
                                     </thead>
                                    <tbody>
                                        <?php if (count($lguia)): ?>
                                            <?php foreach ($lguia as $guia): ?>
                                                <tr>
                                                	<td><?php echo $guia->id_url; ?></td>
                                                	<td><?php echo $guia->tipo_descr; ?></td>
                                                	<td><?php echo $guia->descripcion; ?></td>
                                                	<td><a href=<?php echo $guia->url; ?> TARGET="_new"> <?php echo $guia->url; ?></a></td>                                               	                                               	
                                                	<td class="td-actions">
                                                         
                                                        <div class="action-buttons text-center">
                                                           
                                                           <a class="blue" href="index.php?page=mantenimiento&accion=modificar2&id=<?php echo $guia->id_url; ?>">
                                                                <i class="icon-pencil bigger-130"></i>
                                                            </a> 

                                                            <a class="red btn-delete" href="index.php?page=mantenimiento&accion=eliminarguia&id=<?php echo $guia->id_url; ?>">
                                                                <i class="fa fa-trash-o bigger-130"></i>
                                                            </a>

                                                        </div>


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

        <script src="assets/js/bootbox.js"></script>  
         <script type="text/javascript">  
            $(document).on("click", ".btn-delete", function(e) {
                var link = $(this).attr("href"); // "get" the intended link in a var
                e.preventDefault();    
                bootbox.confirm("¿Esta seguro de querer eliminar el registro?", function(result) {    
                    if (result) {
                        document.location.href = link;  // if result, "set" the document location       
                    }    
                });
            });
        </script>

        <!--inline scripts related to this page-->


    </body>
</html>