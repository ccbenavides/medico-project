<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

        <title>Pacientes</title>
        <!--basic styles-->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
        <link rel="stylesheet" href="assets/font-awesome-4.3.0/css/font-awesome.css" />

        <!--fonts-->

        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

        <!--page specific plugin styles-->

        <link rel="stylesheet" href="assets/css/jquery-ui-1.10.3.custom.min.css" />
        <link rel="stylesheet" href="assets/css/jquery.gritter.css" />

        <!-- // <script src="view/js/jquery-1.11.1.min.js"></script> -->
        <!-- // <script src="view/js/bootstrap.min.js"></script> -->

        <link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css" /> 
        <link rel="stylesheet" href="assets/plugins/datatables/dataTables.responsive.css" /> 
        <!--ace styles-->

        <link rel="stylesheet" href="assets/css/ace.min.css" />
        <link rel="stylesheet" href="assets/css/ace-responsive.min.css" />
        <link rel="stylesheet" href="assets/css/ace-skins.min.css" />

       
        <!--inline styles related to this page-->
        <!-- // <script src="view/js/jquery-1.11.1.min.js"></script> -->
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <script type="text/javascript">
                    $(document).on('ready', function() {

            $('#div').find('input, textarea,select,button').attr('disabled', true);
            <?php
            if (isset($_GET["id"]) && !empty($_GET['id'])):
                if ($paciente->getId_ubigeo() == !""):
                    ?>
                                $('select#departamento option').each(function() {
                                this.selected = (this.text === '<?php echo $u->getDepartamento(); ?>');
                                });
                                        getProvincias('<?php echo $u->getDepartamento(); ?>');
                <?php endif;
                ?>
                            $('select#t_seguro option').each(function() {
                            this.selected = (this.value === '<?php echo $paciente->getId_tipo_paciente(); ?>');
                                    //                        console.log(this.value);
                            });
            <?php endif;
            ?>

            $.validator.addMethod("checkUserName",
                    function(value) {
                    var result = false;
                            $.ajax({
                            async: false,
                                    type: 'post',
                                    url: 'index.php?page=paciente&accion=dniexiste',
                                    data: {"dni": value},
                                    success: function(respuesta) {
                                    result = (respuesta == true) ? true : false;
                                    }
                            });
                            console.log(result);
                            return result;
                    },
                    "Este DNI ya está registrado."
                    //"Este DNI pertenece a otra persona."
                    );
                    $("#form1").validate({
            rules: {
            APP: {required: true, minlength: 3, maxlength: 20},
                    APM: {required: true, minlength: 3, maxlength: 20},
                    nombre: {required: true, minlength: 3, maxlength: 30},
                    sexo: {required: true},
                    dep: {required: true},
                    prov: {required: true},
                    dist: {required: true},
                    direccion: {required: true, maxlength: 50},
                    fecha_nacimiento: {required: true},
                    TipoSeguro: {required: true, min: 1},
                    dni: {required: true, minlength: 8, maxlength: 8, number: true,
<?php if (!isset($_GET["id"])) { ?>
                        checkUserName: true
<?php } ?>
                    }
            },
                    messages: {
                    APP: {minlength: "minimo 3 letras", maxlength: "maximo 20 caracteres"},
                            APM: {minlength: "minimo 3 letras", maxlength: "maximo 20 caracteres"},
                            nombre: {minlength: "minimo 3 letras", maxlength: "maximo 30 letras"},
                            dni: {minlength: "Ingrese 8 numeros", maxlength: "Ingrese 8 numeros"},
                            dep: {min: "Seleccione un Departamento"},
                            prov: {min: "Seleccione una Provincia"},
                            dist: {min: "Seleccione un Distrito"},
                            TipoSeguro: {min: "Seleccione un Seguro"}
                    }
            });
            });
                    function Activar() {
                    var estado = document.getElementById('chk').checked;
                            console.log(estado);
                            if (estado === true) {
                    //                    document.getElementById('titulo').textContent = 'Modificar Registro Triaje';
                    $('#div').find('input, textarea,select,button').attr('disabled', false);
                    } else if (estado === false) {
                    //                    document.getElementById('titulo').textContent = 'Detalles Registro Triaje';
                    $('#div').find('input, textarea,select,button').attr('disabled', true);
                    }
                    }

        </script>
    </head>


    <body>

        <!--formulario-->
        <?php include 'barrasesion.php' ?>

        <div class="main-container container-fluid">

            <a class="menu-toggler" id="menu-toggler" href="#">
                <span class="menu-text"></span>
            </a>

            <?php include 'nav-bar.php' ?>

            <div class="main-content">
                <div class="breadcrumbs" id="breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <i class="icon- fa fa-user-plus"></i>
                            <a href="index.php">Pacientes</a>

                            <span class="divider">
                            <i class="icon-angle-right arrow-icon"></i>
                            </span>
                        </li>
                        <li class="active">Registro</li>
                    </ul><!--.breadcrumb-->
                </div>

           <div class="page-content">
                  
                      <div class="row-fluid">
                        <div class="span12">
                              
                         <h2 class="header smaller lighter blue">Registro Pacientes</h2>



                         <div class="widget-box">
                             <div class="widget-header">
                                <h4><i class="fa fa-user pink"></i> Datos del Paciente.</h4>
                                
                             </div><!-- widget-header -->
                             <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row-fluid">
                                        <div class="space-18"></div>

                    <form class="form-horizontal" id='form1'  action="index.php?page=paciente&accion=insertar<?php if (!empty($_GET["id"])) : ?>&id=<?php
                        echo $_GET["id"];
                    endif;
                    ?>" role="form" method="POST" > 

                            <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                    <label for="" class="control-label">Dni</label>
                                    <div class="controls">
                                
                                    <div class="col-md-2 text-danger">
                            
                                    <input type="text" class="form-control" maxlength="8" name="dni" id="txtDNI"  autocomplete="off" placeholder="DNI"  onkeypress="return soloNumeros(event)"
                                           <?php if (!empty($_GET["id"])) : ?>readonly="" value="<?php
                                               echo $paciente->getDNI();
                                           endif;
                                           ?>">
                                    </div>
                                </div>
                            </div>
                        <!--                    INGRESE APELLIDOS-->
                        <!-- <div class="form-group"> -->
                            <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                <label  class="control-label">Apellidos </label>
                                <div class="controls">
                                    <!-- <div class="row"> -->
                                        <!-- <div class="col-sm-6"> -->
                                            <!--                                            $f = new Paciente(); $f->getA_paterno()?>-->
                                            <input type="text" maxlength="23" autocomplete="off" style="word-spacing: 1; text-transform: uppercase;" placeholder="Apellido Paterno"  class="form-control span3" onkeypress="return soloLetras(event)" name="APP" id="txtAPaterno" 
                                                   <?php if (!empty($_GET["id"])) : ?> value="<?php
                                                       echo $paciente->getA_paterno();
                                                   endif;
                                                   ?>">
                                        <!-- </div> -->
                                        <!-- <div class="col-sm-6"> -->
                                            <input type="text" maxlength="23" autocomplete="off" class="form-control span3" style="word-spacing: 1; text-transform: uppercase;" onkeypress="return soloLetras(event)" name="APM" id="txtAMaterno" placeholder="Apellido Materno"
                                                   <?php if (!empty($_GET["id"])) : ?> value="<?php
                                                       echo $paciente->getA_materno();
                                                   endif;
                                                   ?>">
                                        <!-- </div>                                     -->
                                    <!-- </div> -->
                                </div>  
                            </div>
                        <!-- </div>    -->
                        <!--                    INGRESE NOMBRES-->
                        <!-- <div class="form-group"> -->
                            <!-- <div class="row"> -->
                            <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                <label  class="control-label">Nombres </label>
                                <div class="controls">
                                <!-- <div class="col-sm-8"> -->
                                    <!-- <div class="row"> -->
                                        <!-- <div class="col-sm-12"> -->
                                            <input type="text" maxlength="50" autocomplete="off" class="form-control span6" style="word-spacing: 1; text-transform: uppercase;" onkeypress="return soloLetras(event)" name="nombre" id="txtNombre" placeholder="Nombre completo"
                                                   <?php if (!empty($_GET["id"])) : ?> value="<?php
                                                       echo $paciente->getNombre();
                                                   endif;
                                                   ?>">
                                        <!-- </div>    -->
                                    <!-- </div> -->

                                </div>
                            </div>
                        <!-- </div> -->
                        <!--                    HISTORIA CLINICA DNI Y SEXO-->
                        <!-- <div class="form-group"> -->
                            <!-- <div class="row"> -->
                                <!-- <div class="col-md-3"></div> -->
                                <!-- <div class="col-md-1"> -->
                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                    <label for="" class=" control-label">Sexo</label>
                                <!-- </div> -->
                                <div class="controls">
                                <!-- <div class="col-md-4"> -->
                                    <div class="form-inline">
                                        <label for="">
                                                                <input type="radio" name="sexo" id="dni" value="0"  style="opacity: 1" checked>
                                                                <span class="lbl"> Masculino</span>
                                                            </label>

                                        <!-- <input type="radio" name="sexo" id="dni" value="0" checked=""/> Masculino                                         -->
                                    <!-- </div>  -->
                                    <label for="">
                                                                <input type="radio" name="sexo" id="" value="1"  style="opacity: 1"<?php if (!empty($_GET["id"])) : ?>  <?php if ($paciente->getSexo() == 1) { ?>checked<?php } endif; ?>/>
                                                                <span class="lbl"> Femenino</span>
                                                            </label>

                                    <!-- <div class="radio-inline">
                                        <input type="radio" name="sexo" id="" value="1" 
                                               <?php if (!empty($_GET["id"])) : ?>  <?php if ($paciente->getSexo() == 1) { ?>checked<?php } endif; ?>/>Femenino                                         
                                    </div> -->
                                </div>
                                </div>

                                
                            </div>
                        <!-- </div> -->
                        <!--                    UBIGEO-->
                        <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                            <!-- <div class="row"> -->
                                <label for="" class="control-label">Ubigeo</label>
                                <div class="controls">
                                <!-- <div class="col-sm-8"> -->
                                    <!-- <div class="row"> -->
                                        <!-- <div class="col-sm-4"> -->
                                            <select id="departamento" name="dep" class="form-control"  onchange="Provincias(this)">
                                                <option value="">DEPARTAMENTO</option>

                                                <?php
                                                $ubigeo = new Ubigeo();
                                                $departamentos = $ubigeo->departamentos();
                                                if (count($departamentos)) {
                                                    foreach ($departamentos as $ubigeo) {
                                                        if (!empty($_GET["id"])) {
                                                            echo '<option value=' . $ubigeo->departamento . '>' . $ubigeo->departamento . '</option>';
                                                        } else {
                                                            echo '<option>' . $ubigeo->departamento . '</option>';
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                        <!-- </div> -->
                                        <!-- <div class="col-sm-4"> -->
                                            <select id="provincia" name="prov" class="form-control" onchange="Distritos(this)">
                                                <option value="">PROVINCIA</option>

                                            </select>
                                        <!-- </div> -->
                                        <!-- <div class="col-sm-4"> -->
                                            <select id="distrito" name="dist"class="form-control"> 
                                                <option value="">DISTRITO</option>

                                            </select>
                                        <!-- </div> -->
                                    </div>
                                </div>
                            <!-- </div> -->
                        <!-- </div> --> 
                        <!--                    direccion-->
                      <!--   <div class="form-group">
                            <div class="row"> -->
                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                <label for="" class="col-sm-4 control-label">Dirección</label>
                                <div class="controls">
                                    <!-- <div class="row"> -->
                                        <!-- <div class="col-sm-12"> -->
                                            <input type="text" class="form-control span6" autocomplete="off"  name="direccion" style="word-spacing: 1; text-transform: uppercase;" id="txtDireccion" placeholder="Ingrese direccion" onkeypress=" return NumeroLetras(event)"
                                                   <?php if (!empty($_GET["id"])) : ?> value="<?php
                                                       echo $paciente->getDireccion();
                                                   endif;
                                                   ?>">
                                        <!-- </div> -->
                                    <!-- </div> -->
                                </div>
                                </div>
                        <!-- </div> -->
                        <!--                    INGRESE Fecha de nacimiento-->
                        <!-- <div class="form-group">
                            <div class="row"> -->
                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                <label for="" class="control-label">Fecha de Nacimiento </label>
                                <!-- <div class="col-sm-8"> -->
                                    <!-- <div class="row"> -->
                                        <!-- <div class="col-sm-6"> -->
                                        <div class="controls">
                                            <input type="date" class="form-control" name="fecha_nacimiento" id="edad" max="<?php echo date("Y-m-d"); ?>"

                                                   <?php if (!empty($_GET["id"])): ?> value="<?php
                                                       echo $paciente->getFecha_nacimiento();
                                                   endif;
                                                   ?>">
                                        </div>   
                                  <!--   </div>
                                </div> -->
                            <!-- </div> -->
                        </div>
                        <!--                    TIPO DE SEGURO-->
                        <!-- <div class="form-group">
                            <div class="row"> -->
                                <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                <label for="" class="col-sm-4 control-label">Tipo de Seguro </label>
                                <div class="controls">
                                   <!--  <div class="row">
                                        <div class="col-sm-6"> -->
                                            <select class="form-control" id="t_seguro" name="TipoSeguro">
                                                <option value="-1">SELECCIONE UN SEGURO</option>
                                                <option value="1">ESSALUD</option>
                                                <option value="2">PRIVADO</option>
                                                <option value="3">SANIDAD EP</option>
                                                <option value="4">SIN SEGURO</option>
                                                <option value="5">SIS</option>
                                                <option value="6">SOAT</option>
                                                <option value="7">OTROS</option> 
                                            </select>             
                                   <!--      </div>
                                    </div> -->
                                </div>
                            </div> 
                        <!-- </div> -->
                        <!--                    BOTON ACEPTAR-->
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label"></label>
                            <div class="col-sm-8" >
                                <div class="row">
                                    <div class="col-lg-7"></div>
                                    <div class="col-lg-5 ">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                        <!--<a class="btn btn-primary">Guardar</a>-->
                                        <a class="btn btn-default" href="index.php?page=paciente&accion=form">Cancelar</a>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </form>                    
                </div>

              <!--   <div class="col-lg-5">

                    <b> Para ingresar los DATOS activa el check   <i class="fa fa-hand-o-right fa-lg"> </i></b><span class="white">  .</span><input type="checkbox" name="Modificar" value="ON" onclick="Activar(this)" id="chk"/>
                </div> -->
            </div>         
        </div>

         <div class="hidden-phone">
                <div class="ace-settings-container" id="ace-settings-container">
                    <div class="btn btn-app btn-mini btn-warning ace-settings-btn" id="ace-settings-btn">
                        
                            <i class="icon-cog bigger-150"></i>
                        
                    </div>

                    <div class="ace-settings-box" id="ace-settings-box">
                        <div>
                            <div class="pull-left">
                                <select id="skin-colorpicker" class="hide">
                                    <option data-class="default" value="#438EB9" />#438EB9
                                    <option data-class="skin-1" value="#222A2D" />#222A2D
                                    <option data-class="skin-2" value="#C6487E" />#C6487E
                                    <option data-class="skin-3" value="#D0D0D0" />#D0D0D0
                                </select>
                            </div>
                            <span>&nbsp; Elegir mascara</span>
                        </div>

                        <div>
                            <input type="checkbox" class="ace-checkbox-2" id="ace-settings-header" />
                            <label class="lbl" for="ace-settings-header"> Fijar cabecera</label>
                        </div>

                        <div>
                            <input type="checkbox" class="ace-checkbox-2" id="ace-settings-sidebar" />
                            <label class="lbl" for="ace-settings-sidebar"> Fijar Barra</label>
                        </div>

                        <div>
                            <input type="checkbox" class="ace-checkbox-2" id="ace-settings-breadcrumbs" />
                            <label class="lbl" for="ace-settings-breadcrumbs"> Fijar Breadcrumbs</label>
                        </div>
                    </div>
                </div><!--/#ace-settings-container-->
                </div>
                
        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small ">
            <i class="icon-double-angle-up icon-only bigger-110"></i>
        </a>
        <!--        fin del formulario-->
        <hr class="divider">
        
    </body>

    <script>
                function getProvincias(val) {

                var configuracion = {
                type: 'GET',
                        url: 'index.php?page=paciente&accion=changeUb',
                        data: {"tipo": "provincia", "departamento": val},
                        success: function(datosRespuesta) {
                        //alert(datosRespuesta);
                        $('#provincia').empty();
                                $('#distrito').empty();
                                $('#provincia').html(datosRespuesta);
<?php
if (isset($_GET["id"]) && !empty($_GET['id'])):
    if ($paciente->getId_ubigeo() == !""):
        ?>
                                $('select#provincia option').each(function() {
                                //                            console.log('Buscando provincia')
                                this.selected = (this.text == '<?php echo $u->getProvincia(); ?>');
                                });
                                        getDistritos('<?php echo $u->getProvincia(); ?>');
        <?php
    endif;
endif;
?>
                        }

                };
                        $.ajax(configuracion);
                }

        function getDistritos(val) {
        var configuracion = {
        type: 'GET',
                url: 'index.php?page=paciente&accion=changeUb',
                data: {"tipo": "distrito", "provincia": val},
                success: function(datosRespuesta) {
                $('#distrito').empty();
                        $('#distrito').html(datosRespuesta);
<?php
if (isset($_GET["id"]) && !empty($_GET['id'])):
    if ($paciente->getId_ubigeo() == !""):
        ?>
                        $('select#distrito option').each(function() {
                        //                            console.log('Buscando distrito')
                        this.selected = (this.text == '<?php echo $u->getDistrito(); ?>');
                        });
        <?php
    endif;
endif;
?>
                }
        };
                $.ajax(configuracion);
        }


        function Provincias(val) {
//            console.log(val);
        var configuracion = {
        type: 'GET',
                url: 'index.php?page=paciente&accion=changeUb',
                data: {"tipo": "provincia", "departamento": val.value},
                success: function(datosRespuesta) {
                $('#provincia').empty();
                        $('#distrito').empty();
                        $('#provincia').html(datosRespuesta);
                }
        };
                $.ajax(configuracion);
        }

        function Distritos(val) {
        var configuracion = {
        type: 'GET',
                url: 'index.php?page=paciente&accion=changeUb',
                data: {"tipo": "distrito", "provincia": val.value},
                success: function(datosRespuesta) {
                $('#distrito').empty();
                        $('#distrito').html(datosRespuesta);
                }
        };
                $.ajax(configuracion);
        }

        function soloLetras(e) {
        key = e.keyCode || e.which;
                tecla = String.fromCharCode(key).toUpperCase();
                letras = " ÁÉÍÓÚABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
                especiales = "8-37-39-46";
                tecla_especial = false
                for (var i in especiales) {
        if (key == especiales[i]) {
        tecla_especial = true;
                break;
        }
        }

        if (letras.indexOf(tecla) == - 1 && !tecla_especial) {
        return false;
        }
        }

        function soloNumeros(e) {
        key = e.keyCode || e.which;
                tecla = String.fromCharCode(key).toUpperCase();
                letras = "1234567890";
                especiales = "8-37-39-46";
                tecla_especial = false
                for (var i in especiales) {
        if (key == especiales[i]) {
        tecla_especial = true;
                break;
        }
        }

        if (letras.indexOf(tecla) == - 1 && !tecla_especial) {
        return false;
        }
        }

        function NumeroLetras(e) {
        key = e.keyCode || e.which;
                tecla = String.fromCharCode(key).toUpperCase();
                letras = " ÁÉÍÓÚABCDEFGHIJKLMNÑOPQRSTUVWXYZ1234567890.-,'";
                especiales = "8-37-39-46";
                tecla_especial = false
                for (var i in especiales) {
        if (key == especiales[i]) {
        tecla_especial = true;
                break;
        }
        }

        if (letras.indexOf(tecla) == - 1 && !tecla_especial) {
        return false;
        }
        }
    </script>
    <!--<script src="view/js/bootstrap.min.js"></script>-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

    <script type="text/javascript">
        window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
    </script>

    <script type="text/javascript">
        if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
    </script>

    <script src="assets/js/bootstrap.min.js"></script>

    <script src="assets/js/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="assets/js/jquery.ui.touch-punch.min.js"></script>
    <script src="assets/js/bootbox.min.js"></script>
    <script src="assets/js/jquery.easy-pie-chart.min.js"></script>
    <script src="assets/js/jquery.gritter.min.js"></script>
    <script src="assets/js/spin.min.js"></script>

        <!--ace scripts-->

    <script src="assets/js/ace-elements.min.js"></script>
    <script src="assets/js/ace.min.js"></script>

        <!--buscador y paginacion de tabla-->
    <script src="assets/js/jquery.dataTables.js"></script>
    <script src="assets/js/jquery.dataTables.bootstrap.js"></script>
    <script src="assets/js/dataTables.responsive.js"></script>
    <script type="text/javascript">
            $(function() {
                $('#loading-btn').on(ace.click_event, function () {
                    var btn = $(this);
                    btn.button('loading')
                    setTimeout(function () {
                        btn.button('reset')
                    }, 2000)
                });
            
                $('#id-button-borders').attr('checked' , 'checked').on('click', function(){
                        $('#default-buttons .btn').toggleClass('no-border');
                });
            })
    </script>
    <!-- // <script src="view/js/bootstrap.min.js"></script>  -->


</html>
