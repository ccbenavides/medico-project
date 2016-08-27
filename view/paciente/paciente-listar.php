<!DOCTYPE html>
<html>
    <head>
         <meta charset="utf-8" />
        <title>Pacientes</title>

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
        
    
        <script src="assets/js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" charset="utf-8">
                $(document).ready(function() {
                    $('#listarpaciente').dataTable();
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
                        <li class="active">Pacientes</li>
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
                            
                            <h2 class="header smaller lighter blue">Pacientes</h2>
                            <div class="span12">
                                          <div class="span10">
                                            <h5 class="text-success">Cantidad de registros <span class="badge"><?php echo count($pacientes_all); ?></span></h5>
                                        </div>
                                         <!-- <div class="span2">
                                            <a class="btn btn-success" href="index.php?page=paciente&accion=form"><i class="fa-file-o icon-on-left bigger-110"></i>Nuevo</a>
                                        </div> -->
                           </div>
                        <br><br><br>

                            <div class="table-responsive">
                                <div class="table-header">
                                   Pacientes registrados en el sistema.
                                </div>


                             <table id="listarpaciente"  class="table table-striped table-bordered table-hover dataTable dt-responsive"  cellspacing="0" width="100%">
                                             <thead>
                                                <tr>
                                                    <th>Codigo</th>
                                                    <th>DNI</th>
                                                    <th>Nombres y Apellidos</th>
                                                    <th>Profesion</th>
                                                    <th>Tipo de Paciente</th>
                                                    <!-- <th>Accion</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (count($pacientes_all)): ?>
                                                    <?php foreach ($pacientes_all as $pac): ?>
                                                        <tr>
                                                            <td><?php echo $pac->id_paciente; ?></td>
                                                            <td><?php echo $pac->dni; ?></td>
                                                            <td><?php echo $pac->nombres; ?></td>
                                                            <td><?php echo $pac->goc_descripcion; ?></td>
                                                            <td><?php echo $pac->descripcion; ?></td>
                                                            <!-- <td class="td-actions center"> -->
                                                               <!-- <div class="action-buttons"> -->
                                                                    <!--<a class="pink" id="mostrar" data-toggle="modal" href="index.php?page=paciente&accion=mostrar&id=<?php echo $pac->id_paciente; ?>">
                                                                        <i class="fa fa-search bigger-130"></i>
                                                                    </a>-->

                                                                    <!-- <a class="blue" href="index.php?page=paciente&accion=modificar&id=<?php echo $pac->id_paciente; ?>">
                                                                        <i class="icon-pencil bigger-130"></i></a> -->
                                                                    
                                                                <!--<a class="red" href="index.php?page=tipoguardiahorario&accion=eliminar&id=<?php echo $tipoguardia_horario->tipoguar_horario_id;  ?>">
                                                                    <i class="fa fa-minus-circle bigger-130"></i></a>-->
                                                          <!--      </div>
                                                            </td> -->
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

         <!--datos-paciente-->
        <div class="modal hide fade" style="width:700px;" id="modal-paciente" tabindex="0" role="dialog" aria-labelledby="tituloModal" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="blue bigger" id="tituloModal">Datos Paciente</h3>
            </div>

            <div class="modal-body overflow-hidden" >
                <div class="row-fluid">
                    
                    <form class="form-horizontal"  method="POST" enctype="multipart/form-data">
                        <div class="span12">
                            <div class="span6">
                                <div class="control-group" >
                                  <label class="control-label span2">DNI</label>
                                  <div class="controls">
                                     <input type="text" style="margin-left:-90px;width:100px;" readonly="true"  class="form-control" name="dni"  autocomplete="off" autofocus>
                                  </div>
                                </div>
                                <div class="control-group" >
                                  <label class="control-label span1">NOMBRES</label>
                                  <div class="controls">
                                     <input type="text" style="margin-left:-90px;width:250px;" readonly="true"  class="form-control" name="nombres"  autocomplete="off" autofocus>
                                  </div>
                                </div>
                                <div class="control-group" >
                                  <label class="control-label span1">A.PATERNO</label>
                                  <div class="controls">
                                     <input type="text" style="margin-left:-90px;width:250px;" readonly="true"  class="form-control" name="apaterno"  autocomplete="off" autofocus>
                                  </div>
                                </div>
                                <div class="control-group" >
                                  <label class="control-label span1">A.MATERNO</label>
                                  <div class="controls">
                                     <input type="text" style="margin-left:-90px;width:250px;" readonly="true"  class="form-control" name="amaterno"  autocomplete="off" autofocus>
                                  </div>
                                </div>
                                <div class="control-group" >
                                  <label class="control-label span1">DIRECCION</label>
                                  <div class="controls">
                                     <input type="text" style="margin-left:-90px;width:250px;" readonly="true"  class="form-control" name="direccion"  autocomplete="off" autofocus>
                                  </div>
                                </div>
                                <div class="control-group" >
                                  <label class="control-label span1">OCUPACION</label>
                                  <div class="controls">
                                     <input type="text" style="margin-left:-90px;width:250px;" readonly="true"  class="form-control" name="ocupacion"  autocomplete="off" autofocus>
                                  </div>
                                </div>
                                <div class="control-group" >
                                  <label class="control-label span1">FECHA NAC.</label>
                                  <div class="controls">
                                     <input type="text" style="margin-left:-90px;width:250px;" readonly="true"  class="form-control" name="fechnac"  autocomplete="off" autofocus>
                                  </div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="control-group">
                                  <label class="control-label span1"></label>
                                  <div class="controls">
                                     <input type="hidden" hidden style="margin-left:-100px;" readonly="true"  class="form-control">
                                  </div>
                                </div>
                                <div class="control-group" >
                                  <label class="control-label span5">EDAD</label>
                                  <div class="controls">
                                     <input type="text" style="margin-left:-40px;width:170px;" readonly="true"  class="form-control" name="edad"  autocomplete="off" autofocus>
                                  </div>
                                </div>
                                <div class="control-group" >
                                  <label class="control-label span5">SEXO</label>
                                  <div class="controls">
                                     <input type="text" style="margin-left:-40px;width:170px;" readonly="true"  class="form-control" name="sexo"  autocomplete="off" autofocus>
                                  </div>
                                </div>
                                <div class="control-group" >
                                  <label class="control-label span5">DEPARTAMENTO</label>
                                  <div class="controls">
                                     <input type="text" style="margin-left:-40px;width:170px;" readonly="true"  class="form-control" name="departamento"  autocomplete="off" autofocus>
                                  </div>
                                </div>
                                <div class="control-group" >
                                  <label class="control-label span5">PROVINCIA</label>
                                  <div class="controls">
                                     <input type="text" style="margin-left:-40px;width:170px;" readonly="true"  class="form-control" name="provincia"  autocomplete="off" autofocus>
                                  </div>
                                </div>
                                <div class="control-group" >
                                  <label class="control-label span5">DISTRITO</label>
                                  <div class="controls">
                                     <input type="text" style="margin-left:-40px;width:170px;" readonly="true"  class="form-control" name="distrito"  autocomplete="off" autofocus>
                                  </div>
                                </div>
                                <div class="control-group" >
                                  <label class="control-label span5">TIPO SEGURO</label>
                                  <div class="controls">
                                     <input type="text" style="margin-left:-40px;width:170px;" readonly="true"  class="form-control" name="seguro" autocomplete="off" autofocus>
                                  </div>
                                </div>
                            </div>
                            
                        </div>
                    </form>

                </div>

            </div>

        </div>

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
        <script src="view/js/paciente.js"></script>

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
    </body>
</html>