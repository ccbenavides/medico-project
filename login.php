<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


        <meta name="description" content="User login page" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>Sistema de Gestion de Biopsias</title>


        <meta name="description" content="User login page" />
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

        <!--fonts-->

        <link rel="stylesheet" href="js/autosource/googleapis.css" />

        <!--ace styles-->

        <link rel="stylesheet" href="assets/css/ace.min.css" />
        <link rel="stylesheet" href="assets/css/ace-responsive.min.css" />
        <link rel="stylesheet" href="assets/css/ace-skins.min.css" />
        <link rel="shortcut icon" href="assets/img/micros.ico">

    </head>

    <body class="login-layout">
                    
                        <div class="login-container">
                            <div class="row-fluid">
                                <div class="center">
                                    <h1>
                                        <img src="assets/img/micro1.png" style="margin-left:-20px;">
                                        <span class="white">SIGBIO</span>
                                        <span class="white">Application</span>
                                    </h1>

                                    <h4 class="white">HOSPITAL REGIONAL LAMBAYEQUE</h4>
                                    <h5 class="white">SERVICIO ANATOMIA PATOLOGICA</h5>
                                    <!-- <h6 class="blue">Unidad de Desarrollo</h6> -->
                                </div>
                            </div>

                        
                             <div class="space-6"></div>

                                    <div class="row-fluid">
                                            <div class="position-relative">
                                                <div id="login-box" class="login-box visible widget-box no-border">
                                                    <div class="widget-body">
                                                        <div class="widget-main">

                                                            <form id="form-login" class="form-signin" action="index.php?page=login&accion=login" method="POST">
                                                                <!-- <h2 class="form-signin-heading text-primary">Acceso Restringido</h2> -->
                                                                <h5 class="header blue lighter bigger">
                                                                    Por favor Ingresar sus Datos                                                               
                                                                </h5>
                                                                <!-- <hr> -->
                                                                <div class="space-6"></div>

                                                                <label>Nombre de Usuario</label>
                                                                
                                                                <span class="block input-icon input-icon-right">
                                                                    <input type="text" autocomplete="off" class="span12" name="user" id="user" required autofocus onKeyPress="capLock(event)" placeholder="Usuario">
                                                                    <i class="icon-user"></i>
                                                                </span>

                                                                <label> <br>Contraseña</label>

                                                                <span class="block input-icon input-icon-right">
                                                                <input type="password" class="span12" name="pass" id="pass" required onKeyPress="capLock(event)" placeholder="Contraseña"><br>
                                                                <i class="icon-lock"></i>
                                                                </span><br>
                                                                <button id="submit-login" class="btn btn-lg btn-primary btn-block"><i class="fa fa-sign-in icon-on-left bigger-110"></i>Entrar</button><br>
                                                                <a id="caplock" class="text-warning" style="visibility:hidden">El bloqueo de mayúsculas está activado</a>
                                                            </form>
                                                        </div>        
                                                </div>
                                            </div>
                                        </div>
                            </div>
                         </div> <!--login-container-->
                            
          


        <script type="text/javascript">
                    window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
        </script>
         <script type="text/javascript">
            if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
        </script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/js/jquery-1.10.2.min.js"></script> 
        <script src="assets/js/style-elements.min.js"></script>
        <script src="assets/js/style.min.js"></script>

    


    </body>
</html>
