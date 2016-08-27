<?php foreach($resultados as $oresult):?>
	<tr>
	    <td width="15%"><?php echo $oresult->descr_marcador;?></td>
	    <td width="30%"><?php echo $oresult->resultado;?></td>
	</tr>
<?php endforeach;?>