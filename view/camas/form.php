<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Programacion - Camas</title>

		<meta name="description" content="Common UI Features &amp; Elements" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		
		
		<!--basic styles-->

		<link href="assets/css/bootstrap-camas.css" rel="stylesheet" />
		<link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />
		<link rel="stylesheet" href="assets/font-awesome-4.3.0/css/font-awesome.css" />
		<link rel="stylesheet" href="js/autosource/jquery-ui.css">

		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!--page specific plugin styles-->

		<link rel="stylesheet" href="assets/css/jquery-ui-1.10.3.custom.min.css" />
		<link rel="stylesheet" href="assets/css/jquery.gritter.css" />
		<link rel="stylesheet" href="assets/css/datepicker.css" />
		<link rel="stylesheet" href="assets/css/bootstrap-timepicker.css" />

		<!--fonts-->

		<link rel="stylesheet" href="js/autosource/googleapis.css" />

		<!--ace styles-->

		<!-- <link rel="stylesheet" href="assets/css/ace.min.css" /> -->
		<link rel="stylesheet" href="assets/css/ace-personalizado.css" />
		<link rel="stylesheet" href="assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />


		<link rel="stylesheet" href="css/personalizada.css" />
		<script src="assets/js/jquery-1.10.2.min.js"></script> 
		<script src="js/autosource/jquery-ui.js"></script>




		<!--inline styles related to this page-->
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />





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
							<i class="icon-home home-icon"></i>
							<a href="#">Home</a>

							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>

						<li>
							<a href="#">Prog. Camas</a>

							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>
						<li class="active">Camas</li>
					</ul><!--.breadcrumb-->


				</div>

				<div class="page-content">
					<div class="page-header position-relative">
						<h1>
							Habitaciones
<!-- 							<small>
								<i class="icon-double-angle-right"></i>
								Common UI Features &amp; Elements
							</small> -->
						</h1>
					</div><!--/.page-header-->
					<label> Piso</label>
					<select id="spiso"> 
							<option value="-1" >Seleccion de Piso</option>
							<option value="1">3er Piso</option>
							<option value="2">4to Piso</option>
					</select>&nbsp;&nbsp;&nbsp;&nbsp;
					<!-- <label> Lado</label> -->
					<select id="slado" disabled> 

					</select>				
					<div class="row-fluid">

					<div class="span12">
                    	<div class="widget-box">
                                <div class="widget-header">
									<h4><i class="fa fa-bed  pink home-icon  "></i> Habitaciones:</h4>
                                    <!-- <button class="btn btn-small btn-primary" id="newmenu">Añadir</button> -->
                                </div>
                                <div class="widget-body">
                                    
                                    <div class="widget-main">

                                    	<div id="divcamas" ></div>
<!--                                     	<code><div style="width:4px;height:0;border:5px solid #68BC31;overflow:hidden"></div> Libre</code> 
                                    	<code><button class="btn btn-minier" style="border-color: #7AF0DE; ">&nbsp;</button> Por Desocupar</code> 
                                    	<code><button class="btn btn-minier" style="border-color: #FFCD00; ">&nbsp;</button> Por Ocupar</code> 
                                    	<code><button class="btn btn-minier" style="border-color: #E00606; ">&nbsp;</button> Ocupado</code> --> 

									<table style="color: rgb(84, 84, 84); font-size: smaller;">
										<tbody>
											<tr>
												<td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #9CDB81;overflow:hidden"></div></div></td><td class="legendLabel"> <code>Libre</code></td> 
												<td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #7AF0DE;overflow:hidden"></div></div></td><td class="legendLabel"> <code>Por Desocupar</code></td> 
												<td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #FFCD00;overflow:hidden"></div></div></td><td class="legendLabel"> <code>Por Ocupar</code></td> 
												<td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #FC7565;overflow:hidden"></div></div></td><td class="legendLabel"> <code>Ocupado</code></td> 
											</tr>

										</tbody>
									</table>

                                    </div><!--widget-main-->
                                    
                                </div><!--widget-body-->
                            </div><!--widget-box-->
                         </div>

					</div><!--/row-->

					<div class="row-fluid">
						<br>
						
					<div class="row-fluid">
						<div class="span12">
                                    <div id="divinfocamas" ></div>									
								</div><!--/span-->
					</div>

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
				<select id="sicono" name="sicono" placeholder="seleccionar" >
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
		<script src="js/autosource/jquery-ui.js"></script>
		<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="assets/js/bootbox.min.js"></script>
		<script src="assets/js/jquery.easy-pie-chart.min.js"></script>
		<script src="assets/js/spin.min.js"></script>
		<script src="assets/js/date-time/bootstrap-timepicker.min.js"></script>
		<script src="assets/js/date-time/bootstrap-datepicker.min.js"></script>
		<script src="assets/js/jquery.gritter.min.js"></script>
		<script src="assets/js/jquery.validate.min.js"></script>

		<!--ace scripts-->

		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>
		<script src="js/Habitaciones.js"></script>
		<script src="js/habitacion_eventos.js"></script>
		<script src="js/condicionegreso.js"></script>
		<script src="js/paciente.js"></script>
		
		
		<script src="js/cie.js"></script>
		<script src="js/cie_salida.js"></script>
		<script src="js/ref_contra.js"></script>
		<script src="js/evento-bcie.js"></script>
		<script src="js/ciexcod.js"></script>
		<script src="js/ciexcod_salida.js"></script>

<script type="text/javascript">
// $(function () {
//     $("#btnPrint").click(function () {
//         var contents = $("#dvContents").html();
//         var frame1 = $('<iframe />');
//         frame1[0].name = "frame1";
//         frame1.css({ "position": "absolute", "top": "-1000000px" });
//         $("body").append(frame1);
//         var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
//         frameDoc.document.open();
//         //Create a new HTML document.
//         frameDoc.document.write('<html><head><title>DIV Contents</title>');
//         frameDoc.document.write('</head><body>');
//         //Append the external CSS file.
//         frameDoc.document.write('<link href="style.css" rel="stylesheet" type="text/css" />');
//         //Append the DIV contents.
//         frameDoc.document.write(contents);
//         frameDoc.document.write('</body></html>');
//         frameDoc.document.close();
//         setTimeout(function () {
//             window.frames["frame1"].focus();
//             window.frames["frame1"].print();
//             frame1.remove();
//         }, 500);
//     });
// });
</script>



		<!--inline scripts related to this page-->

		
	</body>
</html>
