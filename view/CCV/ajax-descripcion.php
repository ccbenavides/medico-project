<?php foreach($descripciones as $descripcion):?>
	<tr>
		<td width="10%"><?php echo $descripcion->patologo;?></td>
		<td width="10%"><?php echo $descripcion->tecnologo;?></td>
	    <td width="30%"><?php echo $descripcion->descripcion;?></td>
	    <td width="10%"><?php  
	    				list($anio, $mes, $dia) = explode('-', $descripcion->fecha_informe);
	    				echo $dia.'/'.$mes.'/'.$anio;?>
	    </td>
	</tr>
<?php endforeach;?>