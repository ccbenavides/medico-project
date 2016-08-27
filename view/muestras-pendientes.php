<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="description" content="overview &amp; stats" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Muestras Pendientes</title>
         <link href="assets/plugins/bootstrap/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/plugins/bootstrap/bootstrap-responsive.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/css/ace.min.css" />
        <link rel="stylesheet" href="assets/css/ace-responsive.min.css" />
        <link rel="stylesheet" href="assets/css/ace-skins.min.css" />

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
         <script type="text/javascript" charset="utf-8">
                $(document).ready(function() {
                    $('#listarbiopsiaPQ').dataTable();
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
                        <li class="active">Muestras Pendientes</li>
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

            <div class="page-content" style="<?php echo $tema; ?>">
                <div class="row-fluid">
                    <div class="span12">
                   <!--      <div class="row-fluid"> -->
                            
                            <h2 class="header smaller lighter blue" style="margin-top:40px;">Muestras Pendientes</h2>
                            
                        <br><br><br>
                        <div class="table-responsive">
                          <div class="table-header" style="margin-top:-30px;">
                                    Biopsias registradas en el sistema.
                          </div>

                                                         <table id="listarbiopsiaPQ"  class="table table-striped table-bordered table-hover dataTable dt-responsive"  cellspacing="0" width="100%">
                                                                         <thead>
                                                                            <tr>
                                                                                <th>Codigo</th>
                                                                                <th>Numero de Biopsia</th>
                                                                                <th>Fecha de Ingreso al Servicio</th>
                                                                                <th>Dias</th>
                                                                                <th>Medico Patologo</th>
                                                                                <th>Muestras Remitidas</th>
                                                                                
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php if (count($bios)): ?>
                                                                                <?php foreach ($bios as $bio): ?>
                                                                                    <tr>
                                                                                        <td><?php echo $bio->id_biopsia; ?></td>
                                                                                        <td><?php echo $bio->num_biopsia; ?></td>
                                                                                        <td><?php echo $bio->fecha_ingreso; ?></td>
                                                                                        <td><?php echo $bio->dias; ?></td>
                                                                                        <td><?php echo $bio->medico; ?></td>
                                                                                        <td><?php echo $bio->muestras; ?></td>
                                                                                        
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
      
        
        <script src="assets/js/bootstrap.min.js"></script>
   

        <!--datatables js-->

        <script src="assets/js/jquery.dataTables.js"></script>
        <script src="assets/js/jquery.dataTables.bootstrap.js"></script>
        <script src="assets/js/dataTables.responsive.js"></script>

        <!--ace scripts-->

        <script src="assets/js/style-elements.min.js"></script>
        <script src="assets/js/style.min.js"></script>
  
        <!--inline scripts related to this page-->
        
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
    </body>
</html>