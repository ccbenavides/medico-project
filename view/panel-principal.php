<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Sistema de Gestion de Biopsias</title>

		<meta name="description" content="Common UI Features &amp; Elements" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

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
		<link rel="stylesheet" href="assets/css/smoothslides.theme.css">

		<!--fonts-->

		<link rel="stylesheet" href="js/autosource/googleapis.css" />

		<!--ace styles-->
		<link rel="stylesheet" href="assets/css/introjs.css">
		<link rel="stylesheet" href="assets/css/ace.min.css" />
		<link rel="stylesheet" href="assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />

		<script src="assets/js/jquery.mobile-1.4.5.min.js"></script>
		<link rel="stylesheet" href="css/personalizada.css" />
		<link rel="shortcut icon" href="assets/img/micros.ico">
		
		<!--inline styles related to this page-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
    
        <script src="assets/js/jquery-1.10.2.min.js"></script> 

		
		<style type="text/css">
				    #img_logo{
				        max-width: 330px;
				        margin-left:  -70px;

				    }
    	</style>

<script type="text/javascript">
	$(document).live("orientationchange", function() {
		alert("cambio de orientacion");
	} );
</script>
    </head>

	<body onload="openDialog();">

			

			<?php
				include 'barrasesion.php'
			
			?>

		<div class="main-container container-fluid">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>

			<?php
				include 'nav-bar.php'
			
			?>
			
			<div class="main-content">

					<div class="breadcrumbs" id="breadcrumbs" data-position="bottom" data-intro="En esta barra se encuentra la barra del menu y submenu" data-step="1">
							<ul class="breadcrumb">
								<li>
									<i class="icon-user-md home-icon"></i>
									<a href="#">SISTEMA DE GESTION DE BIOPSIAS</a>

									<span class="divider">
										<i class="icon-angle-right arrow-icon"></i>
									</span>
								</li>
								<li class="active">Inicio</li>
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

				<!-- Contenido-pag-->
				<div class="page-content">
                 

                  <!-- Sub migajas -->

					<div class="page-header position-relative">
						<h1>
							SIGBIO
							<small>
								<i class="icon-double-angle-right"></i>
								Sistema de Gestion de Biopsias
							</small>
						</h1>
					</div>
				
					
					<?php
						require 'model/clases/biopsia.php';
							$bipend=new Biopsia();
							
							$usuario_perfil = $_SESSION['idperfil_anat'];
							$nomuser=$_SESSION['idusuario'];

							switch ($usuario_perfil) {
								case 1:
									$area=$bipend->alertaparaadmin();
									break;
								case 3:
									$biocritico=$bipend->alertapat($nomuser);
									break;
								case 5:
									$biocritico=$bipend->alertaparatec($nomuser);
									break;
								case 6:
									$area=$bipend->alertaparaadmin();
									break;
								default:
									# code...
									break;
							}
					?>
					
									
					<div class="row-fluid" >

						<div class="span12"> 
							<div class="alert alert-info">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<i class="icon-ok green"></i>
					            Bienvenido a SIGBIO (V1.0), para cualquier informaci&oacute;n favor de comunicarse con el Administrador del Sistema Anexo:. 
					            <strong class="green">
					                1208.
					                <small></small>
					            </strong>
					            
					            <!-- Unidad de Desarrollo de Sistemas.   -->

					            
					           
					            <!-- <button type="button" class="btn btn-warning" style="float: right;margin-top: -4%;" id="btnayuda" name="btnayuda"> Ayuda</button> -->
					        </div>
					     </div>

						<div class="span3">
							
						</div>
						<?php if($perfil_usr==1 or $perfil_usr==6):?>
						<input hidden id="valores" name="valores" value="<?php echo count($area); ?>">
						<?php endif?>
						<?php if($perfil_usr==3 or $perfil_usr==5):?>
						<input hidden id="vtec" name="vtec" value="<?php echo count($biocritico);?>">
						<?php endif?>

						

							<div class="row-fluid span6" >	
								<h2 class="text-info" style="text-align:center">Bienvenido al Sistema de Gestion de Biopsias</h2>
								<h2 class="text-info" style="text-align:center">Hospital Regional Lambayeque</h2>
					            <h4 class="text-info" style="text-align:center">Servicio de Anatomia Patologica</h4>
					            <div class="ss-slides" >
								    <div class="ss-slide" title="Patologia Quirurgica">
								        <img  src="view/img/Pato1.png"/>
								    </div>
								    <div class="ss-slide " title="Citologia Especial">
								        <img  src="view/img/Cit_Esp1.png" />
								    </div>
								    <div class="ss-slide " title="Citologia Cervico Vaginal">
								        <img  src="view/img/Cit_Cervic1.png" />
								    </div>
								    <div class="ss-slide " title="Inmunohistoquimica">
								        <img  src="view/img/ih1.png" />
								    </div>
								    								    
								</div>
					        
							
							</div>

							<div class="span7">
								
							</div>
							<div class="span6">
								
							</div>

							<div class="span12 text-center">
											
							
							<span onclick="javascript:introJs().setOptions({ 'skipLabel': 'Saltar', 'nextLabel': 'Siguiente', 'prevLabel': 'Anterior', 'doneLabel': 'Finalizar'}).start();" href='javascript:void(0);' class="label label-large label-pink arrowed-right">Guia de usuario</span>	
							<a href="index.php?page=usuarios&accion=opciones" target="_blank"><span class="label label-large label-purple arrowed-in">Opciones de Acceso</span></a>
							<a href="view/manual/bajar.php?archivo=MANUAL_DE_USUARIO.pdf" target="_blank"><span class="label label-large label-warning">Manual de Usuario</span></a>
												
							</div>
						
						



					</div>

										
				 </div><!-- fin contenido-->


		   </div><!--/.main-content-->
		</div><!--/.main-container-->



		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small ">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>

		<!--SCRIPTS PROYECTO-->
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

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>

		<!--page specific plugin scripts-->

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="assets/js/jquery.js"></script>
		<script src="assets/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="assets/js/bootbox.min.js"></script>
		<script src="assets/js/jquery.easy-pie-chart.min.js"></script>
		<script src="assets/js/jquery.gritter.min.js"></script>
		<script src="assets/js/spin.min.js"></script>
		<script src="assets/js/smoothslides.min.js"></script>
		<script src="assets/js/intro.js"></script>
		<!--ace scripts-->

		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>
		<script type="text/javascript">
		/* wait for images to load */
		$(window).load( function() {
			$(document).smoothSlides({
			duration: 5000
			/* options seperated by commas */
			});

			var numero=$('#valores').val();
			if (numero>0) {
				$.gritter.add({
			    
			    title: 'Muestras Criticas',
			    // (string | mandatory) the text inside the notification
			    text: 'En el servicio hay '+numero+' muestras que deben ser analizadas lo mas pronto posible <a href="index.php?page=biopsia&accion=muestracritica" class="red">Click aqui para acceder a la informacion</a>',
			    //class_name: 'gritter-green'
				});
			};
			var tec=$('#vtec').val();
			if (tec>0) {
			   $.gritter.add({
			    
			    title: 'Muestras Criticas',
			    // (string | mandatory) the text inside the notification
			    text: 'Usted tiene '+tec+' muestras que debe analizar lo mas pronto posible <a href="index.php?page=biopsia&accion=muestracritica" class="blue">Click aqui</a>',
			    class_name: 'gritter-light'
				}); 
			};
			 

		});
	</script>




	</body>
</html>
