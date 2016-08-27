<?php foreach($diagnosticos as $diag):?>
	<tr>
	    <td width="10%"><?php echo $diag->muestra_remitida;?></td>
	    <td width="20%"><?php echo $diag->diag_final;?></td>
	    <!--<td width="25%"><?php echo $diag->descrip_muestce;?></td>-->
	</tr>
<?php endforeach;?>