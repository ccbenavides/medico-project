<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        
        <title>Etiquetado de Biopsia</title>
        
         
        <link rel="shortcut icon" href="assets/img/micros.ico">

        <!--basic styles--> 
              
        <link href="assets/plugins/bootstrap/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/plugins/bootstrap/bootstrap-responsive.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/css/ace.min.css" />
        <link rel="stylesheet" href="assets/css/ace-responsive.min.css" />
        <link rel="stylesheet" href="assets/css/ace-skins.min.css" />
        <link rel="stylesheet" href="assets/css/bootstrap-timepicker.css" />
        <link rel="stylesheet" href="assets/css/datepicker.css" />
        
        <!--fonts&iconos-->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
        <link rel="stylesheet" href="assets/font-awesome-4.3.0/css/font-awesome.css">
        <!--[if IE 7]>
        <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
        <![endif]-->
    
        <link rel="stylesheet" href="assets/css/font.css" />


              
    
        <script src="assets/js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript">

            $(document).ready(function() {

                $('#area').on('change',function(){
                    var area=$(this).val();
                    document.getElementById("desde").value='';
                    if (area>=1) {
                        $.ajax({
                                    type:"POST",
                                    url: "index.php?page=paciente&accion=mostrarminnumbio",
                                    data: {
                                        'area':area,
                                    },
                                    success: function(data) {
                                        //$('#numbio').val(data);
                                      document.getElementById("desde").placeholder=data;
                                      
                                    }
                        });  
                    } else{
                       //bootbox.alert("Debe seleccionar un area", function(){});
                       document.getElementById("desde").placeholder=''; 
                         
                    };
            });

        });

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
                          
                            <li class="active">Etiqueta Biopsia</li>
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
                                <h2 class="header smaller lighter blue">Etiquetado</h2>
                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h4><i class=" icon-user-md pink"></i>Datos de etiqueta.</h4>
                                        
                                    </div><!-- widget-header -->
                                    <div class="widget-body">
                                        <div class="widget-main">
                                           <div class="row-fluid">
                                               <form action="index.php?page=paciente&accion=mostraretiqueta" class="form-horizontal" method="POST" target="_blank">
                                                   <div class="control-group row-fluid">
                                                       <label for="" class="control-label span2">Tipo de Etiqueta</label>
                                                        <div class="controls span7">
                                                            <select class="span6" id="cmbetiqueta" required name="cmbetiqueta" onchange="cargaretiqueta()">
                                                                <option value="">Seleccione tipo de etiqueta</option>
                                                                <option value="1">ETIQUETA PARA MACROSCOPIA</option>
                                                                <option value="2">CODIGO DE CANASTILLAS</option>
                                                            </select>
                                                        </div>
                                                   </div>

                                                   <div class="col-lg-3">
                                                       <div id="cmbdatos"></div>
                                                   </div>

                                                   <div class="control-group row-fluid" id="areas" hidden>
                                                                    <label class="control-label span2">Area</label>
                                                                    <div class="controls span6">
                                                                          <select class="span6" name="area" id="area" required>
                                                                            <?php if (count($areas)): ?>
                                                                                <option value="">Seleccione una Area</option>
                                                                                <?php foreach ($areas as $area): ?>
                                                                            <option value="<?php echo $area->id_area ?>" >
                                                                                        <?php echo $area->descr_area; ?>
                                                                                    </option>
                                                                                <?php endforeach; ?>
                                                                            <?php else : ?>
                                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                                            <?php endif; ?>
                                                                        </select>
                                                                    </div>
                                                               </div>
                                                     
                                                        <div class='control-group row-fluid' id="numbios" hidden>
                                                            <label class='control-label span2'>Numero de Biopsia</label>
                                                        <div class='controls span6'>
                                                        <input class='span3' onkeyup='this.value=this.value.toUpperCase()' maxlength='10' type='text' name='numbio' id='numbio'>
                                                        </div>
                                                        </div>

                                                        <div class='control-group row-fluid' id="desdes" hidden>
                                                            <label class='control-label span2'>Desde</label>
                                                        <div class='controls span6'>
                                                        <input class='span3' onkeyup='this.value=this.value.toUpperCase()' maxlength='10' type='text' name='desde' id='desde' >
                                                        </div>
                                                        </div>

                                                        <div class='control-group row-fluid' id="hastas" hidden>
                                                            <label class='control-label span2'>Hasta</label>
                                                        <div class='controls span6'>
                                                        <input class='span3' onkeyup='this.value=this.value.toUpperCase()' maxlength='10' type='text' name='hasta' id='hasta' >
                                                        </div>
                                                        </div>

                                                   <div class="row-fluid text-center">
                                                      <button id="btn_buscar_programacion" class="btn btn-primary" type="submit" onclick=""><i class="fa fa-print icon-on-left bigger-130">&nbsp;Imprimir</i></button> 
                                                    </div>

                                               </form>
                                           </div> 

                                        </div>

                                        <div class="space-10"></div>
                                        
                                    </div><!-- widget-body -->

                                   
                                    
                                </div><!--widget-box-->
                                    
                                                        
                          
             
                             
                            </div><!-- span12 -->
                        </div><!-- row-fluid -->
                    </div><!-- page-content -->
            </div> <!-- main content -->
        </div><!-- main container -->
        
        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small ">
            <i class="icon-double-angle-up icon-only bigger-110"></i>
        </a>
       
        <script src="assets/js/jquery.min.js"></script>
        <script type="text/javascript">
            if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
        </script>
        <script src="assets/js/bootstrap.min.js"></script>

        <script src="assets/js/style-elements.min.js"></script>
        <script src="assets/js/style.min.js"></script>
        <script src="assets/js/jquery.gritter.min.js"></script>
        <script type="assets/js/bootstrap.datepicker.js"></script>
        <script src="assets/js/date-time/bootstrap-datepicker.min.js"></script>
        <script src="view/js/etiqueta.js"></script>
        <script src="assets/js/bootbox.min.js"></script>
        <script src="assets/js/bootbox.js"></script>
        
    </body>
</html>