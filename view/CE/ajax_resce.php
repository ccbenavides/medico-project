<?php foreach($resultados as $result):?>
	<tr>
	    <td ><?php echo $result->resultado;?></td>
	    <td ><?php echo $result->patologo;?></td>
	    <td ><?php 
	    	list($anio, $mes, $dia) = explode('-', $result->fecha_informe);
	    	echo $dia.'/'.$mes.'/'.$anio;?>
	    </td>
	</tr>
<?php endforeach;?>