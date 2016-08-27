<?php foreach($procedimientos as $oproc):?>
	<tr>
	    <td width="15%"><?php echo $oproc->muestra_remitida;?></td>
	    <td width="30%"><?php echo $oproc->diag_final;?></td>
	</tr>
<?php endforeach;?>