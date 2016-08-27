<?php foreach($verificaciones as $verificacion):?>
	<tr>
	    <td width="45%"><?php echo $verificacion->patologo;?></td>
	    <td width="20%"><?php echo $verificacion->fecha_informe;?></td>
	</tr>
<?php endforeach;?>