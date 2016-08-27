<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Requiere Inmunohistoquimica</title>
        <link rel="shortcut icon" href="assets/img/favicon.ico">

        <link href="assets/plugins/bootstrap/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/plugins/bootstrap/bootstrap-responsive.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/css/style.min.css" />
        <link rel="stylesheet" href="assets/css/style-responsive.min.css" />
        <link rel="stylesheet" href="assets/css/bootstrap-timepicker.css" />
        <link rel="stylesheet" href="assets/css/datepicker.css" />

        <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
        <link rel="stylesheet" href="assets/font-awesome-4.3.0/css/font-awesome.css">

        <link rel="stylesheet" href="assets/css/font.css" />

        <link rel="shortcut icon" href="assets/img/favicon.ico">
        <link rel="stylesheet" href="assets/plugins/datatables/dataTables.responsive.css" /> 
       
        <script src="assets/js/jquery-1.10.2.min.js"></script>

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

            	<div class="breadcrumbs" id="breadcrumbs" >
            		<ul class="breadcrumb">
                  <li>
                      <i class="fa fa-list-alt"></i>
                      <a href="#">Inmunohistoquimica</a>

                      <span class="divider">
                          <i class="icon-angle-right arrow-icon"></i>
                      </span>
                  </li>        
                  <li class="active">Control de Marcadores</li>
                </ul>
            	</div>

            	<div class="page-content">
            	   <div class="row-fluid" >
            	   	 <div class="span12">
            	   	 	<h2 class="header smaller lighter blue">Control de Marcadores</h2>
            	   	 	  <div class="widget-box" >
	            	   	 	  	<div class="widget-header">
	            	   	 	  		<h4><i class=" icon-user-md pink"></i>Datos de la biopsia.</h4>

	            	   	 	  	</div><!--widget-header-->
	            	   	 	  	  <div class="widget-body">
	            	   	 	  	  	<widget class="main">
	            	   	 	  	  		<div class="row-fluid">
	            	   	 	  	  			<div class="space-18"></div>
	            	   	 	  	  		      <form class="form-horizontal"  action="index.php?page=biopsia&accion=insertar2<?php if(!empty($_GET["id"])) :?>&id=<?php echo $_GET["id"]; endif; ?>" method="POST" enctype="multipart/form-data">
	            	   	 	  	  		      	<div class="span12">
	            	   	 	  	  		      		<div class="span6">
                                                      <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                          <label class="control-label">Prueba</label>
                                                          <div class="controls">
                                                            <input type="text" style="width:50px;" readonly="true" class=" form-control" name="prueba" id="prueba" autocomplete="off" autofocus value="<?php echo $pruebas->codigoprueba();?>" required>
                                                          </div>  
                                                      </div>
	            	   	 	  	  		      		  <div class="control-group " style="margin-right: 20px; margin-left: 20px;">
                                                            <label class="control-label">Codigo del Bloque</label>
                                                            <div class="controls">
                                                              <input type="text" style="width:275px;" readonly="true"  class=" form-control" name="numbio" id="numbio" <?php if(!empty($_GET["id"])) :?> value="<?php echo $bioimh-> getNumBio(); ?>" <?php endif; ?> autocomplete="off" autofocus>
                                                              <input type="hidden" style="width:275px;" readonly ="true" class=" form-control" name="id_biopsia" id="id_biopsia" <?php if(!empty($_GET["id"])) :?> value="<?php echo $bioimh->getIdBio(); ?>" <?php endif; ?> >
                                                            </div>
                                                      </div>
                                                      <div class="control-group " style="margin-right: 20px; margin-left: 20px;">
                                                          <label class="control-label">DNI</label>
                                                          <div class="controls">
                                                            <input type="text" style="width:275px;" readonly="true"  class="form-control" name="dni" id="dni"<?php if(!empty($_GET["id"])) :?> value="<?php echo $bioimh->getDni(); ?>" <?php endif; ?> autocomplete="off" autofocus>
                                                          </div>
                                                     </div>
                                                     <div class="control-group" style="margin-right: 20px; margin-left:20px;">
                                                         <label class="control-label">Institucion</label>
                                                         <div class="controls">
                                                            <input type="text" style="width:275px;" readonly="true"  class="form-control"
                                                              name="institucion" id="institucion" <?php if(!empty($_GET["id"])) :?> value="<?php echo $bioimh->getnominst(); ?>" <?php endif; ?> autocomplete="off">
                                                         </div> 
                                                     </div>
                                                     <div class="control-group" style="margin-right: 20px; margin-left:20px;">
                                                         <label class="control-label">Servicio</label>
                                                         <div class="controls">
                                                           <input type="text" style="width:275px;" readonly="true"  class="form-control"
                                                            name="servicio" id="servicio" <?php if(!empty($_GET["id"])) :?> value="<?php echo $bioimh->getServicio(); ?>" <?php endif; ?> autocomplete="off">
                                                         </div> 
                                                     </div>
                                                                                                     
                                                     <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                        <h3 class="blue">Ingresar Marcadores</h3>
                                                     </div>
                                                     <div class="control-group" id="divmuestra1" style="margin-right: 20px; margin-left: -60px;">
                                                        <label class="control-label" for="form-field-2">Marcador 1 </label>
                                                        <div class="controls">
                                                          <select class="form-control " style="width:290px;" name="desmues1" id="desmues1" data-nmuestra="1" required>
                                                                            <?php if (count($marcas)): ?>
                                                                                <option value="">Seleccione un Marcador</option>
                                                                                <?php foreach ($marcas as $marcador): ?>
                                                                            <option value="<?php echo $marcador->id_marcador; ?>">
                                                                                        <?php echo $marcador->descr_marcador; ?>
                                                                                    </option>
                                                                                <?php endforeach; ?>
                                                                            <?php else : ?>
                                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                            <?php endif; ?>
                                                          </select>
                                                          <input type="number" name="cantidad1" id="cantidad1" min="1" max="500" value="" style="width:40px;margin-left:10px;" data-nmuestra="1" required>
                                                          <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="1" id="add1" >+</button>
                                                          <!-- <button class="btn btn-minier btn-purple cie" data-type="remove" id="removercie2" >-</button> -->
                                                        </div>
                                                     </div>
                                                      <div class="control-group" id="divmuestra3" hidden style="margin-right:20px; margin-left:-60px;" >
                                                        <label class="control-label" form="form-field-2">Marcador 3 </label>
                                                          <div class="controls">
                                                           <select class="form-control " style="width:290px;" name="desmues3" id="desmues3" data-nmuestra="3">
                                                                            <?php if (count($marcas)): ?>
                                                                                <option value=-1>Seleccione un Marcador</option>
                                                                                <?php foreach ($marcas as $marcador): ?>
                                                                            <option value="<?php echo $marcador->id_marcador; ?>">
                                                                                        <?php echo $marcador->descr_marcador; ?>
                                                                                    </option>
                                                                                <?php endforeach; ?>
                                                                            <?php else : ?>
                                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                            <?php endif; ?>
                                                          </select>
                                                          <input type="number" name="cantidad3" id="cantidad3" min="0" max="500" value="0" style="width:40px;margin-left:10px;" data-nmuestra="3">
                                                            <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="3" id="add3" >+</button>
                                                            <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="3" id="remove3">-</button>
                                                           </div>
                                                      </div>
                                                                     
                                                       <div class="control-group" id="divmuestra5" hidden style="margin-right:20px; margin-left:-60px;" >
                                                            <label class="control-label" form="form-field-2">Marcador 5 </label>
                                                            <div class="controls">
                                                              <select class="form-control " style="width:290px;" name="desmues5" id="desmues5" data-nmuestra="5">
                                                                            <?php if (count($marcas)): ?>
                                                                                <option value=-1>Seleccione un Marcador</option>
                                                                                <?php foreach ($marcas as $marcador): ?>
                                                                            <option value="<?php echo $marcador->id_marcador; ?>">
                                                                                        <?php echo $marcador->descr_marcador; ?>
                                                                                    </option>
                                                                                <?php endforeach; ?>
                                                                            <?php else : ?>
                                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                            <?php endif; ?>
                                                              </select>
                                                              <input type="number" name="cantidad5" id="cantidad5" min="0" max="500" value="0" style="width:40px;margin-left:10px;" data-nmuestra="5">  
                                                              <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="5" id="add5" >+</button>
                                                              <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="5" id="remove5">-</button>
                                                            </div>
                                                        </div>
                                                        <div class="control-group" id="divmuestra7" hidden style="margin-right:20px; margin-left:-60px;" >
                                                            <label class="control-label" form="form-field-2">Marcador 7 </label>
                                                            <div class="controls">
                                                              <select class="form-control " style="width:290px;" name="desmues7" id="desmues7" data-nmuestra="7">
                                                                            <?php if (count($marcas)): ?>
                                                                                <option value=-1>Seleccione un Marcador</option>
                                                                                <?php foreach ($marcas as $marcador): ?>
                                                                            <option value="<?php echo $marcador->id_marcador; ?>">
                                                                                        <?php echo $marcador->descr_marcador; ?>
                                                                                    </option>
                                                                                <?php endforeach; ?>
                                                                            <?php else : ?>
                                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                            <?php endif; ?>
                                                              </select>
                                                              <input type="number" name="cantidad7" id="cantidad7" min="0" max="500" value="0" style="width:40px;margin-left:10px;" data-nmuestra="7">                      
                                                              <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="7" id="add7" >+</button>
                                                              <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="7" id="remove7">-</button>
                                                            </div>
                                                        </div>
                                                                        
                                                        <div class="control-group" id="divmuestra9" hidden style="margin-right:20px; margin-left:-60px;" >
                                                            <label class="control-label" form="form-field-2">Marcador 9 </label>
                                                            <div class="controls">
                                                                <select class="form-control " style="width:290px;" name="desmues9" id="desmues9" data-nmuestra="9">
                                                                            <?php if (count($marcas)): ?>
                                                                                <option value=-1>Seleccione un Marcador</option>
                                                                                <?php foreach ($marcas as $marcador): ?>
                                                                            <option value="<?php echo $marcador->id_marcador; ?>">
                                                                                        <?php echo $marcador->descr_marcador; ?>
                                                                                    </option>
                                                                                <?php endforeach; ?>
                                                                            <?php else : ?>
                                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                            <?php endif; ?>
                                                                </select>
                                                                <input type="number" name="cantidad9" id="cantidad9" min="0" max="500" value="0" style="width:40px;margin-left:10px;" data-nmuestra="9">
                                                                 <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="9" id="add9" >+</button>
                                                                 <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="9" id="remove9">-</button>
                                                            </div>
                                                        </div>
                                                        <div class="control-group" id="divmuestra11" hidden style=" margin-top:20px; margin-right:20px; margin-left:-60px;" >
                                                            <label class="control-label" form="form-field-2">Marcador 11 </label>
                                                            <div class="controls">
                                                                <select class="form-control " style="width:290px;" name="desmues11" id="desmues11" data-nmuestra="11">
                                                                            <?php if (count($marcas)): ?>
                                                                                <option value=-1>Seleccione un Marcador</option>
                                                                                <?php foreach ($marcas as $marcador): ?>
                                                                            <option value="<?php echo $marcador->id_marcador; ?>">
                                                                                        <?php echo $marcador->descr_marcador; ?>
                                                                                    </option>
                                                                                <?php endforeach; ?>
                                                                            <?php else : ?>
                                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                            <?php endif; ?>
                                                                </select>
                                                                <input type="number" name="cantidad11" id="cantidad11" min="0" max="500" value="0" style="width:40px;margin-left:10px;" data-nmuestra="11">
                                                                  <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="11" id="add11" >+</button>
                                                                  <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="11" id="remove11">-</button>
                                                            </div>
                                                        </div>
                                                        <div class="control-group" id="divmuestra13" hidden style="margin-right:20px; margin-left:-60px;" >
                                                            <label class="control-label" form="form-field-2">Marcador 13 </label>
                                                            <div class="controls">
                                                                <select class="form-control " style="width:290px;" name="desmues13" id="desmues13" data-nmuestra="13">
                                                                            <?php if (count($marcas)): ?>
                                                                                <option value=-1>Seleccione un Marcador</option>
                                                                                <?php foreach ($marcas as $marcador): ?>
                                                                            <option value="<?php echo $marcador->id_marcador; ?>">
                                                                                        <?php echo $marcador->descr_marcador; ?>
                                                                                    </option>
                                                                                <?php endforeach; ?>
                                                                            <?php else : ?>
                                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                            <?php endif; ?>
                                                                </select>
                                                                 <input type="number" name="cantidad13" id="cantidad13" min="0" max="500" value="0" style="width:40px;margin-left:10px;" data-nmuestra="13">        
                                                                 <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="13" id="add13" >+</button>
                                                                 <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="13" id="remove13">-</button>
                                                            </div>
                                                        </div>
                                                        <div class="control-group" id="divmuestra15" hidden style="margin-right:20px; margin-left:-60px;" >
                                                            <label class="control-label" form="form-field-2">Marcador 15 </label>
                                                            <div class="controls">
                                                                <select class="form-control " style="width:290px;" name="desmues15" id="desmues15" data-nmuestra="15">
                                                                            <?php if (count($marcas)): ?>
                                                                                <option value=-1>Seleccione un Marcador</option>
                                                                                <?php foreach ($marcas as $marcador): ?>
                                                                            <option value="<?php echo $marcador->id_marcador; ?>">
                                                                                        <?php echo $marcador->descr_marcador; ?>
                                                                                    </option>
                                                                                <?php endforeach; ?>
                                                                            <?php else : ?>
                                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                            <?php endif; ?>
                                                                </select>
                                                                <input type="number" name="cantidad15" id="cantidad15" min="0" max="500" value="0" style="width:40px;margin-left:10px;" data-nmuestra="15">                    
                                                                <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="15" id="add15" >+</button>
                                                                <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="15" id="remove15">-</button>
                                                            </div>
                                                        </div> 
                                                        <div class="control-group" id="divmuestra17" hidden style="margin-right:20px; margin-left:-60px;" >
                                                            <label class="control-label" form="form-field-2">Marcador 17 </label>
                                                            <div class="controls">
                                                                <select class="form-control " style="width:290px;" name="desmues17" id="desmues17" data-nmuestra="17">
                                                                            <?php if (count($marcas)): ?>
                                                                                <option value=-1>Seleccione un Marcador</option>
                                                                                <?php foreach ($marcas as $marcador): ?>
                                                                            <option value="<?php echo $marcador->id_marcador; ?>">
                                                                                        <?php echo $marcador->descr_marcador; ?>
                                                                                    </option>
                                                                                <?php endforeach; ?>
                                                                            <?php else : ?>
                                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                            <?php endif; ?>
                                                                </select>
                                                                <input type="number" name="cantidad17" id="cantidad17" min="0" max="500" value="0" style="width:40px;margin-left:10px;" data-nmuestra="17">                    
                                                                <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="17" id="add17" >+</button>
                                                                <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="17" id="remove17">-</button>
                                                            </div>
                                                        </div>
                                                        <div class="control-group" id="divmuestra19" hidden style="margin-right:20px; margin-left:-60px;" >
                                                            <label class="control-label" form="form-field-2">Marcador 19 </label>
                                                            <div class="controls">
                                                                <select class="form-control " style="width:290px;" name="desmues19" id="desmues19" data-nmuestra="19">
                                                                            <?php if (count($marcas)): ?>
                                                                                <option value=-1>Seleccione un Marcador</option>
                                                                                <?php foreach ($marcas as $marcador): ?>
                                                                            <option value="<?php echo $marcador->id_marcador; ?>">
                                                                                        <?php echo $marcador->descr_marcador; ?>
                                                                                    </option>
                                                                                <?php endforeach; ?>
                                                                            <?php else : ?>
                                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                            <?php endif; ?>
                                                                </select>
                                                                <input type="number" name="cantidad19" id="cantidad19" min="0" max="500" value="0" style="width:40px;margin-left:10px;" data-nmuestra="19">                    
                                                                <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="19" id="add19" >+</button>
                                                                <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="19" id="remove19">-</button>
                                                            </div>
                                                        </div> 
	            	   	 	  	  		      		</div>
	            	   	 	  	  		      		<div class="span6">
                                                         <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                         <label class="control-label">Medico Tratante</label>
                                                         <div class="controls">
                                                          <input type="text" style="width:275px;" readonly="true" class="form-control"
                                                            name="medicot" id="medicot" <?php if(!empty($_GET["id"])) :?> value="<?php echo $bioimh->getMedicoT(); ?>" <?php endif; ?> autocomplete="off">
                                                          </div> 
                                                     </div>
                                                     <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                         <label class="control-label">Fecha de Biopsia</label>
                                                         <div class="controls">
                                                           <input type="text" style="width:275px;" readonly="true" class="form-control"
                                                            name="fecha" id="fecha" <?php if(!empty($_GET["id"])) :?> value="<?php echo $bioimh->getFecha(); ?>" <?php endif; ?> autocomplete="off">
                                                         </div> 
                                                     </div>   
                                                        <div class="control-group" style="margin-right: 20px; margin-left:20px;">
                                                          <label class="control-label">Patologo Responsable</label>
                                                           <div class="controls">
                                                            <input type="text" style="width:275px;" readonly="true"  class="form-control"
                                                             name="patologo" id="patologo" <?php if(!empty($_GET["id"])) :?> value="<?php echo $bioimh->getnompat(); ?>" <?php endif; ?> autocomplete="off">
                                                           </div> 
                                                        </div>
                                                        
                                                         <div class="control-group"  style="margin-right: 20px; margin-left: 20px;">
                                                            <label class="control-label">Tecnologo Responsable</label>
                                                              <div class="controls">
                                                               <select class="form-control " style="width:290px;" name="tecnologo" id="tecnologo" required>
                                                                            <?php if (count($tecs)): ?>
                                                                                <option value="">Seleccione</option>
                                                                                <?php foreach ($tecs as $tec): ?>
                                                                            <option value="<?php echo $tec->emp_id; ?>">
                                                                                        <?php echo $tec->nombre; ?>
                                                                                    </option>
                                                                                <?php endforeach; ?>
                                                                            <?php else : ?>
                                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                            <?php endif; ?>
                                                                </select>
                                                              </div>
                                                        </div>
                                                        <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                            <label class="control-label">Fecha de Ingreso al Servicio</label>
                                                              <div class="controls">
                                                                <input type="date" readonly="true" class="form-control" id="fecha_ingreso" style="width:275px;" name="fecha_ingreso" <?php if(!empty($_GET["id"])) :?> value="<?php echo $bioimh->getFechaI(); ?>" <?php endif; ?> >
                                                                </div>   
                                                        </div>                                                        
                                                        <div class="control-group" id="divmuestra2" hidden style="margin-right:20px; margin-left:-60px; margin-top:80px;" >
                                                            <label class="control-label" for="form-field-2">Marcador 2 </label>
                                                            <div class="controls">
                                                                <select class="form-control " style="width:290px;" name="desmues2" id="desmues2" data-nmuestra="2">
                                                                            <?php if (count($marcas)): ?>
                                                                                <option value=-1>Seleccione un Marcador</option>
                                                                                <?php foreach ($marcas as $marcador): ?>
                                                                            <option value="<?php echo $marcador->id_marcador; ?>">
                                                                                        <?php echo $marcador->descr_marcador; ?>
                                                                                    </option>
                                                                                <?php endforeach; ?>
                                                                            <?php else : ?>
                                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                            <?php endif; ?>
                                                                </select>
                                                               <input type="number" name="cantidad2" id="cantidad2" min="0" max="500" value="0" style="width:40px;margin-left:10px;" data-nmuestra="2">
                                                             <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="2" id="add2" >+</button>
                                                              <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="2" id="remove2">-</button>
                                                            </div>
                                                        </div>
                                                        <div class="control-group" id="divmuestra4" hidden style="margin-right:20px; margin-left:-60px;" >
                                                            <label class="control-label" form="form-field-2">Marcador 4 </label>
                                                            <div class="controls">
                                                                <select class="form-control " style="width:290px;" name="desmues4" id="desmues4" data-nmuestra="4">
                                                                            <?php if (count($marcas)): ?>
                                                                                <option value=-1>Seleccione un Marcador</option>
                                                                                <?php foreach ($marcas as $marcador): ?>
                                                                            <option value="<?php echo $marcador->id_marcador; ?>">
                                                                                        <?php echo $marcador->descr_marcador; ?>
                                                                                    </option>
                                                                                <?php endforeach; ?>
                                                                            <?php else : ?>
                                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                            <?php endif; ?>
                                                                </select>
                                                                <input type="number" name="cantidad4" id="cantidad4" min="0" max="500" value="0" style="width:40px;margin-left:10px;" data-nmuestra="4">
                                                                <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="4" id="add4" >+</button>
                                                                <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="4" id="remove4">-</button>
                                                            </div>
                                                        </div>
                                                        <div class="control-group" id="divmuestra6" hidden style="margin-right:20px; margin-left:-60px;" >
                                                            <label class="control-label" form="form-field-2">Marcador 6 </label>
                                                            <div class="controls">
                                                                <select class="form-control " style="width:290px;" name="desmues6" id="desmues6" data-nmuestra="6">
                                                                            <?php if (count($marcas)): ?>
                                                                                <option value=-1>Seleccione un Marcador</option>
                                                                                <?php foreach ($marcas as $marcador): ?>
                                                                            <option value="<?php echo $marcador->id_marcador; ?>">
                                                                                        <?php echo $marcador->descr_marcador; ?>
                                                                                    </option>
                                                                                <?php endforeach; ?>
                                                                            <?php else : ?>
                                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                            <?php endif; ?>
                                                                </select>
                                                                <input type="number" name="cantidad6" id="cantidad6" min="0" max="500" value="0" style="width:40px;margin-left:10px;" data-nmuestra="6">                    
                                                                <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="6" id="add6" >+</button>
                                                                <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="6" id="remove6">-</button>
                                                            </div>
                                                        </div>
                                                        <div class="control-group" id="divmuestra8" hidden style="margin-right:20px; margin-left:-60px;" >
                                                            <label class="control-label" form="form-field-2">Marcador 8 </label>
                                                            <div class="controls">
                                                                <select class="form-control " style="width:290px;" name="desmues8" id="desmues8" data-nmuestra="8">
                                                                            <?php if (count($marcas)): ?>
                                                                                <option value=-1>Seleccione un Marcador</option>
                                                                                <?php foreach ($marcas as $marcador): ?>
                                                                            <option value="<?php echo $marcador->id_marcador; ?>">
                                                                                        <?php echo $marcador->descr_marcador; ?>
                                                                                    </option>
                                                                                <?php endforeach; ?>
                                                                            <?php else : ?>
                                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                            <?php endif; ?>
                                                                </select>
                                                                <input type="number" name="cantidad8" id="cantidad8" min="0" max="500" value="0" style="width:40px;margin-left:10px;" data-nmuestra="8">                    
                                                                <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="8" id="add8" >+</button>
                                                                <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="8" id="remove8">-</button>
                                                            </div>
                                                        </div>
                                                        <div class="control-group" id="divmuestra10" hidden style="margin-right:20px; margin-left:-60px;" >
                                                            <label class="control-label" form="form-field-2">Marcador 10 </label>
                                                            <div class="controls">
                                                                <select class="form-control " style="width:290px;" name="desmues10" id="desmues10" data-nmuestra="10">
                                                                            <?php if (count($marcas)): ?>
                                                                                <option value=-1>Seleccione un Marcador</option>
                                                                                <?php foreach ($marcas as $marcador): ?>
                                                                            <option value="<?php echo $marcador->id_marcador; ?>">
                                                                                        <?php echo $marcador->descr_marcador; ?>
                                                                                    </option>
                                                                                <?php endforeach; ?>
                                                                            <?php else : ?>
                                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                            <?php endif; ?>
                                                                </select>
                                                                <input type="number" name="cantidad10" id="cantidad10" min="0" max="500" value="0" style="width:40px;margin-left:10px;" data-nmuestra="10">                    
                                                                <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="10" id="add10" >+</button>
                                                                <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="10" id="remove10">-</button>
                                                            </div>
                                                        </div>
                                                        <div class="control-group" id="divmuestra12" hidden style="margin-right:20px; margin-left:-60px;" >
                                                            <label class="control-label" form="form-field-2">Marcador 12 </label>
                                                              <div class="controls">
                                                                <select class="form-control " style="width:290px;" name="desmues12" id="desmues12" data-nmuestra="12">
                                                                            <?php if (count($marcas)): ?>
                                                                                <option value=-1>Seleccione un Marcador</option>
                                                                                <?php foreach ($marcas as $marcador): ?>
                                                                            <option value="<?php echo $marcador->id_marcador; ?>">
                                                                                        <?php echo $marcador->descr_marcador; ?>
                                                                                    </option>
                                                                                <?php endforeach; ?>
                                                                            <?php else : ?>
                                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                            <?php endif; ?>
                                                                </select>
                                                                <input type="number" name="cantidad12" id="cantidad12" min="0" max="500" value="0" style="width:40px;margin-left:10px;" data-nmuestra="12">                    
                                                                <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="12" id="add12" >+</button>
                                                                <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="12" id="remove12">-</button>
                                                             </div>
                                                        </div>
                                                         <div class="control-group" id="divmuestra14" hidden style="margin-right:20px; margin-left:-60px;" >
                                                            <label class="control-label" form="form-field-2">Marcador 14 </label>
                                                            <div class="controls">
                                                                <select class="form-control " style="width:290px;" name="desmues14" id="desmues14" data-nmuestra="14">
                                                                            <?php if (count($marcas)): ?>
                                                                                <option value=-1>Seleccione un Marcador</option>
                                                                                <?php foreach ($marcas as $marcador): ?>
                                                                            <option value="<?php echo $marcador->id_marcador; ?>">
                                                                                        <?php echo $marcador->descr_marcador; ?>
                                                                                    </option>
                                                                                <?php endforeach; ?>
                                                                            <?php else : ?>
                                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                            <?php endif; ?>
                                                                </select>
                                                                <input type="number" name="cantidad14" id="cantidad14" min="0" max="500" value="0" style="width:40px;margin-left:10px;" data-nmuestra="14">                    
                                                                <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="14" id="add14" >+</button>
                                                                <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="14" id="remove14">-</button>
                                                            </div>
                                                        </div>
                                                                        
                                                        <div class="control-group" id="divmuestra16" hidden style="margin-right:20px; margin-left:-60px;" >
                                                            <label class="control-label" form="form-field-2">Marcador 16 </label>
                                                            <div class="controls">
                                                                <select class="form-control " style="width:290px;" name="desmues16" id="desmues16" data-nmuestra="16">
                                                                            <?php if (count($marcas)): ?>
                                                                                <option value=-1>Seleccione un Marcador</option>
                                                                                <?php foreach ($marcas as $marcador): ?>
                                                                            <option value="<?php echo $marcador->id_marcador; ?>">
                                                                                        <?php echo $marcador->descr_marcador; ?>
                                                                                    </option>
                                                                                <?php endforeach; ?>
                                                                            <?php else : ?>
                                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                            <?php endif; ?>
                                                                </select>
                                                                <input type="number" name="cantidad16" id="cantidad16" min="0" max="500" value="0" style="width:40px;margin-left:10px;" data-nmuestra="16">                    
                                                                <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="16" id="add16" >+</button>
                                                                <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="16" id="remove16">-</button>
                                                            </div>
                                                        </div>
                                                        <div class="control-group" id="divmuestra18" hidden style="margin-right:20px; margin-left:-60px;" >
                                                            <label class="control-label" form="form-field-2">Marcador 18 </label>
                                                            <div class="controls">
                                                                <select class="form-control " style="width:290px;" name="desmues18" id="desmues18" data-nmuestra="18">
                                                                            <?php if (count($marcas)): ?>
                                                                                <option value=-1>Seleccione un Marcador</option>
                                                                                <?php foreach ($marcas as $marcador): ?>
                                                                            <option value="<?php echo $marcador->id_marcador; ?>">
                                                                                        <?php echo $marcador->descr_marcador; ?>
                                                                                    </option>
                                                                                <?php endforeach; ?>
                                                                            <?php else : ?>
                                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                            <?php endif; ?>
                                                                </select>
                                                                <input type="number" name="cantidad18" id="cantidad18" min="0" max="500" value="0" style="width:40px;margin-left:10px;" data-nmuestra="18">
                                                                <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="18" id="add18" >+</button>
                                                                <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="18" id="remove18">-</button>
                                                            </div>
                                                        </div>
                                                                        
                                                        <div class="control-group" id="divmuestra20" hidden style="margin-right:20px; margin-left:-60px;" >
                                                            <label class="control-label" form="form-field-2">Marcador 20 </label>
                                                            <div class="controls">
                                                                <select class="form-control " style="width:290px;" name="desmues20" id="desmues20" data-nmuestra="20">
                                                                            <?php if (count($marcas)): ?>
                                                                                <option value=-1>Seleccione un Marcador</option>
                                                                                <?php foreach ($marcas as $marcador): ?>
                                                                            <option value="<?php echo $marcador->id_marcador; ?>">
                                                                                        <?php echo $marcador->descr_marcador; ?>
                                                                                    </option>
                                                                                <?php endforeach; ?>
                                                                            <?php else : ?>
                                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                            <?php endif; ?>
                                                                </select>
                                                                <input type="number" name="cantidad20" id="cantidad20" min="0" max="500" value="0" style="width:40px;margin-left:10px;" data-nmuestra="20">
                                                                <button class="btn btn-minier btn-purple muestra" data-type="add" data-nmuestra="20" id="add20" >+</button>
                                                                <button class="btn btn-minier btn-purple muestra" data-type="remove"  data-nmuestra="20" id="remove20">-</button>
                                                            </div>
                                                        </div> 
	            	   	 	  	  		      		</div>
	            	   	 	  	  		      	</div><!--span12-->
                                                <div class="space-6"></div>

                                                <div class="span12 text-center">
                                                  <button type="submit" class="btn btn-primary" name="boton_enviar" id="boton_enviar"> <i class="fa-floppy-o icon-on-left bigger-110"></i>Guardar</button>
                                                  <a href="index.php?page=biopsiaPQ&accion=editar&id=<?php echo $bioimh->getIdBio(); ?>" class="btn btn-danger"><i class="fa-times-circle icon-on-left bigger-110"></i>Cancelar</a>
                                                        
                                                </div>


	            	   	 	  	  		      </form>
	            	   	 	  	  		</div>

	            	   	 	  	  	</widget><!--widget main-->
                                    <div class="space-10"></div>
	            	   	 	  	  </div><!--widget-body-->
            	   	 	  </div><!--widget-box-->
            	   	 </div><!--span12-->
            	   </div><!--row-fluid-->
            	</div><!--page-content-->

            </div><!--main-content-->

        </div><!--main-container-->

        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small ">
            <i class="icon-double-angle-up icon-only bigger-110"></i>
        </a>
       
        <script src="assets/js/jquery.min.js"></script>
        <script type="text/javascript">
            if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
        </script>
        <script src="assets/js/bootstrap.min.js"></script>

        // <script>
        //   $(document).ready(function(){
        //     $("select[name=tecnologo]").change(function(){
        //       // alert($('select[name=tecnologo]').val());
        //       // $('input[name=valor1]').val($(this).val());
        //       $('#boton_enviar').attr('disabled', false);
        //     });

        //   });
        // </script>

        <!--ace scripts-->

        <script src="assets/js/style-elements.min.js"></script>
        <script src="assets/js/style.min.js"></script>
        <script src="assets/js/jquery.gritter.min.js"></script>
        <script type="assets/js/bootstrap.datepicker.js"></script>
        <script src="assets/js/date-time/bootstrap-datepicker.min.js"></script>
        <script src="view/js/toparea.js"></script>
        
        <!--inline scripts related to this page-->
        <script >
            $(function() {
                $('#datepicker').datepicker();
                $('#datepicker1').datepicker();
            });
         </script>

	</body>









</html>