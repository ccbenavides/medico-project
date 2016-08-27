<?php foreach($conclusiones as $oconclusion):?>
	<tr>
	    <td><?php echo $oconclusion->conclusion;?></td>
	    <td><?php echo $oconclusion->patologo;?></td>
	    <td><?php list($anio, $mes, $dia) = explode('-', $oconclusion->fecha_informe);
	    			echo $dia.'/'.$mes.'/'.$anio ;?></td>
	</tr>
<?php endforeach;?>