<?php foreach($diagnosticos as $diagnostico):?>
	<tr>
	    <td><?php echo $diagnostico->muestra_remitida;?></td>
	    <td><?php echo $diagnostico->diag_final;?></td>	   
	</tr>
<?php endforeach;?>