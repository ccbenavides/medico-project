<?php

require_once 'conexion.php';
require_once 'paciente.php';

$dni=$_POST['dni'];
$pac = new Paciente();
$pacientes=$pac->cargar_busqueda_dni(strtoupper($dni));

if(!empty($pacientes)){ ?>

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover dataTable dt-responsive"  cellspacing="0" width="100%" >
            <thead>
                <tr class="info">
                    <th>Codigo</th>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Profesion</th>
                    <th class="text-center">Tipo de Seguro</th>
                    <th class="text-center">Accion</th>
                </tr>
            </thead>
            <tbody border="1">
                <?php
                if (count($pacientes) > 0) {
                    foreach ($pacientes as $paciente) {
                        echo '<tr>';
                        echo '<td>' . $paciente->id_paciente . '</td>';
                        echo '<td>' . $paciente->dni . '</td>';
                        echo '<td>' . $paciente->nombres . '</td>';
                        echo '<td>' . $paciente->goc_descripcion . '</td>';
                        echo '<td class="text-center">' . $paciente->descripcion . '</td>';
                        ?>
                    <td>
                        <div class="td-actions center">
                            <div class="action-buttons">
                                <a class ="btn btn-success" href ="index.php?page=biopsia&accion=editar&id=<?php echo $paciente->id_paciente; ?>">
                                <i class="fa fa-file-o bigger-130">&nbsp;Nuevo</i>
                                </a>  
                            </div>
                        </div>
                    </td>
                    <?php
                    echo '</tr>';
                }
            }
            }else{

                if (is_numeric($dni)) {
                    if (strlen($dni)==8) {
                        $v = $dni;
                    } else {
                        $v = '';
                    }
                    
                } else {
                    $v = '';
                }
                
                    echo '<div class="page-content">';
                    // echo '<p><span class="blue"><strong>El paciente no se encuentra registrado,Si desea registrarlo haga 
                    // click aqui:&nbsp;<a href="index.php?page=paciente&accion=form'.$v.'" class="btn btn-primary">
                    //       <i class="fa fa-file-o bigger-130"></i>&nbsp;Registrar</a></strong></span></p><br>';

                    // echo '<p><span class="blue"><strong>El paciente no se encuentra registrado,Si desea registrarlo haga 
                    // click aqui:&nbsp;<submit id="btnregistrar" class="btn btn-primary" data-dni='.$v.'>
                    //       <i class="fa fa-file-o bigger-130"></i>&nbsp;Registrar</strong></submit></span></p><br>';
                    echo '<form action="index.php?page=paciente&accion=formpac" role="form" method="POST"><input type="hidden" value='.$v.' name="dnibusqueda"><span class="blue"><strong>El paciente no se encuentra registrado,Si desea registrarlo haga  click aqui:&nbsp;<button  type="submit" class="btn btn-primary">
                    <i class="fa fa-file-o bigger-130"></i>&nbsp;Registrar</button></strong></span></form>';                    

                    echo '</div>';
                  }
            ?>


            </tbody>
        </table>
    </div>