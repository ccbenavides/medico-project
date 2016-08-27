<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>UI Elements - Ace Admin</title>

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

		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

		<!--ace styles-->

		<link rel="stylesheet" href="assets/css/ace.min.css" />
		<link rel="stylesheet" href="assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />


		<link rel="stylesheet" href="css/personalizada.css" />
		
		<!--inline styles related to this page-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

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
							<i class="icon-home home-icon"></i>
							<a href="#">Home</a>

							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>

						<li>
							<a href="#">UI Elements</a>

							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>
						<li class="active">Elements</li>
					</ul><!--.breadcrumb-->


				</div>

				<div class="page-content">
					<div class="page-header position-relative">
						<h1>
							UI Elements
							<small>
								<i class="icon-double-angle-right"></i>
								Common UI Features &amp; Elements
							</small>
						</h1>
					</div><!--/.page-header-->



							

							<input id="gritter-light" checked="" type="checkbox" class="ace-switch ace-switch-5" />

							

							<script type="text/javascript">
								var $assets = "assets";//this will be used in gritter alerts containing images
							</script>

					
					<div class="row-fluid">

					<div class="span6">
                    	<div class="widget-box">
                                <div class="widget-header">
									<h4><i class="fa fa-heartbeat pink"></i> Menus:</h4>
                                    <button class="btn btn-small btn-primary" id="newmenu">Añadir</button>
                                </div>
                                <div class="widget-body">
                                    
                                    <div class="widget-main">

                                    	<div id="divmenu" ></div>

                                    </div><!--widget-main-->
                                </div><!--widget-body-->
                            </div><!--widget-box-->
                                  
                         </div>
								<div class="span6">
                                    <div id="divsubmenu" ></div>									
								</div><!--/span-->
							</div><!--/row-->
				</div><!--/.page-content-->


			</div><!--/.main-content-->

		</div><!--/.main-container-->

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>

		<!--basic scripts-->

		<!--[if !IE]>-->




        
	<div aria-hidden="true" class="bootbox modal hide fade" id="formulario-registro" tabindex="-1" >
		<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
			<h3><i class="fa fa-heartbeat pink" ></i> Ingreso de Menu</h3>
		</div>
		<div class="modal-body">
			<div class="control-group">

				<label> <b>Menu</b></label>
				<input class="input-block-level" id="nombrem"  autocomplete="off"  type="text">
				<label><b>Link</b></label>
				<input class="input-block-level" id="link" autocomplete="off"  type="text">

				<div class="row-fluid">
					<div class="span6">
				<label><b>Icono</b></label>
				<select id="sicono" name="sicono" >
					<option value="-1" > - - Seleccione un Icono - -</option>
					<?php foreach ($liconos as $licono): ?>
						<option value="<?php echo $licono->id_icono ?>" ><?php echo $licono->icono_descr ?></option>
					<?php endforeach ?>
				</select>
					</div>
					<div class="span6">
						<div id="vpicono">
							<label><i class="fa fa-camera-retro fa-5x"></i></label>
						</div>

					</div>

				
				</div>
			</div>


		</div>
		<div class="modal-footer">
			<a data-handler="0" class="btn null" data-dismiss="modal">Cancel</a>
			<button data-handler="1" class="btn btn-primary" disabled id="agregar">OK</button>
		</div>
	</div>
       
















<!-- / le javascript -->



	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

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
		<script src="js/menu.js"></script>


		<!--inline scripts related to this page-->

		
	</body>
</html>
