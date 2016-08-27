<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="description" content="overview &amp; stats" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Muestras Pendientes</title>
        <link href="assets/plugins/bootstrap/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/plugins/bootstrap/bootstrap-responsive.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/css/style.min.css" />
        <link rel="stylesheet" href="assets/css/style-responsive.min.css" />
        <link rel="stylesheet" href="assets/css/ace-skins.min.css">

        <!--fonts&iconos-->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
        <link rel="stylesheet" href="assets/font-awesome-4.3.0/css/font-awesome.css">
        <!--[if IE 7]>
        <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
        <![endif]-->
    
        <link rel="stylesheet" href="assets/css/font.css" />

        <!--DATATABLES-->  
        <!--<link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css" /> -->
        <link rel="stylesheet" href="assets/plugins/datatables/dataTables.responsive.css" /> 

        <link rel="shortcut icon" href="assets/img/favicon.ico">
        
    
        <script src="assets/js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#listarbiopsiaPQ').dataTable();
                $('#listarbiopsiaCE').dataTable();
                $('#listarbiopsiaCCV').dataTable();
                $('#listarbiopsiaIH').dataTable();
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
            <div class="breadcrumbs" id="breadcrumbs" >
                <ul class="breadcrumb">
                        <li>
                            <i class="icon-wrench home-icon"></i>
                            <a href="#">Mantenimiento</a>

                            <span class="divider">
                                <i class="icon-angle-right arrow-icon"></i>
                            </span>
                        </li>
                        <li class="active">Muestras Pendientes</li>
                 </ul>
            </div>
            <div class="page-content">
                <div class="row-fluid">
                    <div class="span12">
                    <div class="widget-container-span" style="margin-top:40px;">
                        <div class="widget-box" >
                            <div class="widget-header">
                                <h3 class="smaller">MUESTRAS POR ANALIZAR</h3>
                                <div class="widget-toolbar no-border">
                                    <ul class="nav nav-tabs" id="myTab">
                                        <li class="active">
                                            <a data-toggle="tab" href="#biopq">Patologia Quirurgica</a>
                                        </li>

                                        <li>
                                            <a data-toggle="tab" href="#bioce">Citologia Especial</a>
                                        </li>

                                        <li>
                                            <a data-toggle="tab" href="#bioccv">Citologia Cervico Vaginal</a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#bioih" >Inmunohistoquimica</a>
                                        </li>
                                    </ul>
                                </div><!--widget-toolbar-->
                            </div><!--widget-header-->
                                <div class="widget-body">
                                    <div class="widget-main padding-6">
                                        <div class="tab-content">
                                            <div id="biopq" class="tab-pane in active">
                                                <div id="biopq" class="tab-pane active">
                                                    <div class="table-responsive">
                                                            <div class="table-header" style="background-color:rgb(197,216,158)">
                                                               Biopsias registradas en el sistema.
                                                            </div>

                                                         <table id="listarbiopsiaPQ"  class="table table-striped table-bordered table-hover dataTable dt-responsive"  cellspacing="0" width="100%">
                                                                         <thead>
                                                                            <tr>
                                                                                <th>Codigo</th>
                                                                                <th>Numero de Biopsia</th>
                                                                                <th>Fecha de Ingreso al Servicio</th>
                                                                                <th>Responsable</th>
                                                                                <th>Muestras Remitidas</th>
                                                                                <th>Accion</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php if (count($bios)): ?>
                                                                                <?php foreach ($bios as $bio): ?>
                                                                                    <tr>
                                                                                        <td><?php echo $bio->id_biopsia; ?></td>
                                                                                        <td><?php echo $bio->num_biopsia; ?></td>
                                                                                        <td><?php echo $bio->fecha_ingreso; ?></td>
                                                                                        <td><?php echo $bio->medico; ?></td>
                                                                                        <td><?php echo $bio->muestras; ?></td>
                                                                                        <td class="td-actions center">
                                                                                           <div class="action-buttons">
                                                                                                <a class="blue" href="index.php?page=biopsiaPQ&accion=editar&id=<?php echo $bio->id_biopsia; ?>"><i class="icon-pencil bigger-130"></i></a>
                                                                                            
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
                                                </div>
                                                
                                            </div><!--biopq-->
                                            <div id="bioce" class="tab-pane">
                                                <div class="table-responsive">
                                                        <div class="table-header" style="background-color:rgb(255,167,7);">
                                                           Biopsias registradas en el sistema.
                                                        </div>


                                                     <table id="listarbiopsiaCE"  class="table table-striped table-bordered table-hover dataTable dt-responsive"  cellspacing="0" width="100%">
                                                                     <thead>
                                                                        <tr>
                                                                            <th>Codigo</th>
                                                                            <th>Numero de Biopsia</th>
                                                                            <th>Fecha de Ingreso al Servicio</th>
                                                                            <th>Responsable</th>
                                                                            <th>Muestra Remitida</th>
                                                                            <th>Accion</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php if (count($bioscv)): ?>
                                                                            <?php foreach ($bioscv as $biocv): ?>
                                                                                <tr>
                                                                                    <td><?php echo $biocv->id_biopsia; ?></td>
                                                                                    <td><?php echo $biocv->num_biopsia; ?></td>
                                                                                    <td><?php echo $biocv->fecha_ingreso; ?></td>
                                                                                   <td><?php echo $biocv->medico;?></td>
                                                                                    <td><?php echo $biocv->muestras; ?></td>
                                                                                    <td class="td-actions center">
                                                                                       <div class="action-buttons">
                                                                                            <a class="blue" href="index.php?page=biopsiaCE&accion=editar&id=<?php echo $biocv->id_biopsia; ?>"><i class="icon-pencil bigger-130"></i></a>
                                                                                        
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
                                            </div><!--bioce-->
                                            <div id="bioccv" class="tab-pane">
                                                <div class="table-responsive" >
                                                        <div class="table-header" style="background-color:rgb(214,141,139)">
                                                           Biopsias registradas en el sistema.
                                                        </div>

                                                     <table id="listarbiopsiaCCV" class="table table-striped table-bordered table-hover dataTable dt-responsive"  cellspacing="0" width="100%">
                                                                     <thead>
                                                                        <tr>
                                                                            <th>Codigo</th>
                                                                            <th>Numero de Biopsia</th>
                                                                            <th>Fecha de Ingreso al Servicio</th>
                                                                            <th>Responsable</th>
                                                                            <th>Muestra Remitida</th> 
                                                                            <th>Accion</th>                                                   
                                                                          
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php if (count($biosccv)): ?>
                                                                            <?php foreach ($biosccv as $bioccv): ?>
                                                                                <tr>
                                                                                    <td><?php echo $bioccv->id_biopsia; ?></td>
                                                                                    <td><?php echo $bioccv->num_biopsia; ?></td>
                                                                                    <td><?php echo $bioccv->fecha_ingreso; ?></td>
                                                                                    <td><?php echo $bioccv->medico;?></td>
                                                                                    <td><?php echo $bioccv->muestras;?></td>
                                                                                    <td class="td-actions center">
                                                                                       <div class="action-buttons">
                                                                                            <a class="blue" href="index.php?page=biopsiaCCV&accion=editar&id=<?php echo $bioccv->id_biopsia; ?>"><i class="icon-pencil bigger-130"></i></a>
                                                                                        
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
                                            </div><!--bioccv-->
                                            <div id="bioih" class="tab-pane" >
                                                 <div class="table-responsive" >
                                                    <div class="table-header" style="background-color:rgb(199,141,95)">
                                                       Biopsias registradas en el sistema.
                                                    </div>

                                                 <table id="listarbiopsiaIH"  class="table table-striped table-bordered table-hover dataTable dt-responsive"  cellspacing="0" width="100%">
                                                                 <thead>
                                                                    <tr>
                                                                        <th>Codigo</th>
                                                                        <th>Numero de Biopsia</th>
                                                                        <th>Fecha de Ingreso</th>
                                                                        <th>Responsable</th>
                                                                        <th>Muestras Remitidas</th>
                                                                        <th>Accion</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php if (count($biosih)): ?>
                                                                        <?php foreach ($biosih as $bioih): ?>
                                                                            <tr>
                                                                                <td><?php echo $bioih->id_biopsia;?></td>
                                                                                <td><?php echo $bioih->num_biopsia; ?></td>
                                                                                <td><?php echo $bioih->fecha_ingreso; ?></td>
                                                                                <!--<td><?php echo $bioih->dias; ?></td>-->
                                                                                <td><?php echo $bioih->medico; ?></td>
                                                                                <td><?php echo $bioih->muestras; ?></td>
                                                                                <td class="td-actions center">
                                                                                   <div class="action-buttons">
                                                                                        <a class="blue" href="index.php?page=biopsiaIH&accion=editar&id=<?php echo $bioih->id_biopsia; ?>"><i class="icon-pencil bigger-130"></i></a>
                                                                                    
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
                                                                </div>

                                        </div>
                                    </div><!--widget-main-->
                                </div><!--widget-body-->
                        </div><!--widget-box-->
                    </div><!--widget-container-->
                    </div>
                </div><!--row-fluid-->

            </div><!--page-->


          </div><!--main-content-->    

        </div><!--main-container-->

    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
            <i class="icon-double-angle-up icon-only bigger-110"></i>
    </a>

    <script src="assets/js/bootstrap.min.js"></script>

    <script type="text/javascript">
            window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
    </script>

    <script type="text/javascript">
            if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
    </script>

    <script src="assets/js/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="assets/js/jquery.ui.touch-punch.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.dataTables.js"></script>
    <script src="assets/js/jquery.dataTables.bootstrap.js"></script>
    <script src="assets/js/dataTables.responsive.js"></script>
    <script src="assets/js/style-elements.min.js"></script>
    <script src="assets/js/style.min.js"></script>
    

    </body>



</html>
