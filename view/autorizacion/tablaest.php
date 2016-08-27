<div class="table-responsive">
   <div class="table-header">
        Biopsias registradas en el sistema.
    </div>

    <table id="listarbitacora" class="table table-striped table-bordered table-hover dataTable dt-responsive" cellspacing="0" width="100%">
        
    <thead>
       <tr>
            <th>Numero de Biopsia</th>
            <th>Fecha de Ingreso</th>
            <th>Paciente</th>
            <th>Patologo Responsable</th>
            <th>Estado</th>
            <th>Accion</th>

       </tr>
    </thead>
    <tbody>
            <?php if (count($lestados)): ?>
                <?php foreach ($lestados as $lestadoct): ?>
                    <tr data-id="<?php echo $lestadoct->id_biopsia ?>">
                        <td><?php echo $lestadoct->num_biopsia; ?></td>
                        <td><?php echo $lestadoct->fecha_ingreso; ?></td>
                        <td><?php echo $lestadoct->paciente; ?></td>
                        <td><?php echo $lestadoct->patologo; ?></td>
                        <td><?php  
                        switch ($lestadoct->estado_biopsia) {
                            case 1:
                                echo "No Analizada";
                                break;
                            case 2:
                                echo "En Analisis";
                                break;
                            case 3:
                                echo "Finalizada";
                                break;                                
                        }
                        ?></td>
                        <td class="td-actions center">
                            <div class="action-buttons">
                                <a title="autorizar edicion" class="green" data-id="<?php echo $lestadoct->id_biopsia ?>" data-est="<?php echo $lestadoct->estado_biopsia ?>" id="modificar"><i class="fa fa-pencil-square-o bigger-130"></i></a>
                                <a title="desautorizar edicion" class="red" data-id="<?php echo $lestadoct->id_biopsia ?>" data-est="<?php echo $lestadoct->estado_biopsia ?>" id="desautorizar"><i class="fa fa-times-circle bigger-130"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <?php echo '<div class="alert alert-warning">No se encontraron registros.</div>'; ?>
            <?php endif; ?>
    </tbody>
    </table>
</div><!--span12-->
 