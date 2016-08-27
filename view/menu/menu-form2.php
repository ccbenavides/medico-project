
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <meta name="description" content="overview &amp; stats" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lista de Usuarios</title>
         <!--basic styles--> 
        <!--        <link href="assets/css/reset.css" rel="stylesheet" /> -->
        <link href="assets/plugins/bootstrap/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/plugins/bootstrap/bootstrap-responsive.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/css/style.min.css" />
        <link rel="stylesheet" href="assets/css/style-responsive.min.css" />
		<link rel="stylesheet" href="css/personalizada.css" />

        <!--fonts&iconos-->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
        <!--[if IE 7]>
        <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
        <![endif]-->
    
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

        <!--DATATABLES-->  
        <link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css" /> 
        <link rel="stylesheet" href="assets/plugins/datatables/dataTables.responsive.css" /> 

        <link rel="shortcut icon" href="assets/img/favicon.ico">
        
    
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
                        <li class="active">Menus</li>
                    </ul><!--.breadcrumb-->
      
                </div>

            <div class="page-content">
<h2 class="header smaller lighter blue">Mantenimiento Menus</h2>
                <div class="row-fluid">

					<div class="span6">
                    	<div class="widget-box">
                                <div class="widget-header">
									<h4><i class=" icon-list pink"></i>Menus:</h4>
                                    <button class="btn btn-small btn-primary" id="bootbox-regular">Añadir</button>
                                </div>
                                <div class="widget-body">
                                    
                                    <div class="widget-main">
                                    	<table id="sample-table-1" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>cod</th>
												<th>Menu</th>
											</tr>
										</thead>

										<tbody>
											<?php foreach ($lmenus as $lmenu): ?>
											<tr class="menupadre" data-id_cod="<?php echo $lmenu->id_menu_nav; ?>"> 
												<td><?php echo $lmenu->id_menu_nav; ?></td> 
												<td><?php echo $lmenu->descripcion; ?></td> 
											</tr>
												
											<?php endforeach ?>
										</tbody>
									</table>
                                    </div><!--widget-main-->
                                </div><!--widget-body-->
                            </div><!--widget-box-->
                                  
                         </div>
								<div class="span6">
                                    <div id="divsubmenu" ></div>									
								</div><!--/span-->
							</div><!--/row-->


            </div><!-- page -->

        </div><!-- main-content -->

        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
            <i class="icon-double-angle-up icon-only bigger-110"></i>
        </a>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript">
            if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
        </script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.js"></script>

        <!--datatables js-->

        <script src="assets/js/jquery.dataTables.js"></script>
        <script src="assets/js/jquery.dataTables.bootstrap.js"></script>
        <script src="assets/js/dataTables.responsive.js"></script>

        <!--ace scripts-->

        <script src="assets/js/style-elements.min.js"></script>
        <script src="assets/js/style.min.js"></script>
        <script src="js/menu.js"></script>
        <script src="assets/js/bootbox.min.js"></script>
        <script src="assets/js/ace-elements.min.js"></script>
        <script src="assets/js/ace.min.js"></script>

        <!--inline scripts related to this page-->

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
