<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="description" content="overview &amp; stats" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Crear Biopsia</title>
        <link href="assets/plugins/bootstrap/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/plugins/bootstrap/bootstrap-responsive.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/css/style.min.css" />
        <link rel="stylesheet" href="assets/css/style-responsive.min.css" />

        <!--fonts&iconos-->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
        <link rel="stylesheet" href="assets/font-awesome-4.3.0/css/font-awesome.css">
        <!--[if IE 7]>
        <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
        <![endif]-->
    
        <link rel="stylesheet" href="assets/css/font.css" />

        <!--DATATABLES-->  
        <link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css" /> 
        <link rel="stylesheet" href="assets/plugins/datatables/dataTables.responsive.css" /> 

        <link rel="shortcut icon" href="assets/img/favicon.ico">
        
    
        <script src="assets/js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" charset="utf-8">
                $(document).ready(function() {
                    $('#listarpacientes').dataTable();
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
                            <a href="#">Paciente</a>

                            <span class="divider">
                                <i class="icon-angle-right arrow-icon"></i>
                            </span>
                        </li>
                        <li class="active">Crear Biopsia</li>
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
                            
                            <h2 class="header smaller lighter blue">Crear Biopsia</h2>
                            <div class="span12">
                                          <div class="span10">
                                            <h5 class="text-success">Cantidad de registros <span class="badge"><?php echo count($pacientes); ?></span></h5>
                                        </div>
                                         <!-- <div class="span2">
                                            <a class="btn btn-app btn-mini btn-primary"href="index.php?page=paciente&accion=form">Nuevo</a>
                                        </div> -->
                           </div>
                        <br><br><br>

                            <div class="table-responsive">
                                <div class="table-header">
                                   Pacientes registrados en el sistema.
                                </div>


                             <table id="listarpacientes"  class="table table-striped table-bordered table-hover dataTable dt-responsive"  cellspacing="0" width="100%">
                                             <thead>
                                                <tr>
                                                    <th>Codigo</th>
                                                    <th>DNI</th>
                                                    <th>Nombres y Apellidos</th>
                                                    <th>Lugar de Procedencia</th>
                                                    <th>Tipo de Seguro</th>
                                                    <th>Accion</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (count($pacientes)): ?>
                                                    <?php foreach ($pacientes as $pac): ?>
                                                        <tr>
                                                            <td><?php echo $pac->id_paciente; ?></td>
                                                            <td><?php echo $pac->dni; ?></td>
                                                            <td><?php echo $pac->nombres; ?></td>
                                                            <td><?php echo $pac->distrito; ?></td>
                                                            <td><?php echo $pac->descripcion; ?></td>
                                                            <td class="td-actions center">
                                                               <div class="action-buttons">
                                                                    <a href="index.php?page=biopsia&accion=form" class="btn btn-default">Crear Biopsia</a>
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