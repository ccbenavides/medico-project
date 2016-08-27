<?php foreach($infos as $oinfo):?>
	<tr>
	    <td hidden><?php echo $oinfo->id_biopsia;?></td>
	   	<td><?php echo $oinfo->num_biopsia;?></td>
	   	<td><?php echo $oinfo->fecha_ingreso;?></td>
	    <td><?php echo $oinfo->fecha_informe;?></td>
	    <td class="td-actions center">
	    <?php  switch($oinfo->id_area):
	    case '1':?>
	    <a class="blue" href="index.php?page=reportes&accion=infpac&id=<?php echo $oinfo->id_biopsia; ?>" target="_blank"><i class="icon-eye-open bigger-150"></i></a>
	    <?php break;?>
	    <?php case '2':?>
	    	<a class="blue" href="index.php?page=reportes&accion=infpacce&id=<?php echo $oinfo->id_biopsia; ?>" target="_blank"><i class="icon-eye-open bigger-150"></i></a>
	    <?php break;?>
	    <?php case '3':?>
	    	<a class="blue" href="index.php?page=reportes&accion=infpacccv&id=<?php echo $oinfo->id_biopsia; ?>" target="_blank"><i class="icon-eye-open bigger-150"></i></a>
	    <?php break;?>
	    <?php case '4':?>
	    	<a class="blue" href="index.php?page=reportes&accion=infpacih&id=<?php echo $oinfo->id_biopsia; ?>" target="_blank"><i class="icon-eye-open bigger-150"></i></a>
	    <?php break;?>
	    <?php endswitch;?>
	    </td>
	</tr>
<?php endforeach;?>