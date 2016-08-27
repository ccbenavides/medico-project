<?php foreach($resultados as $resultado):?>
	<tr>
	    <td><?php echo $resultado->descr_res;?></td>
	    <td><?php echo $resultado->descr_ubicacion;?></td>	 
	    <td><?php 
		    list($anio, $mes, $dia) = explode('-', $resultado->fecha_informe);
		    echo $dia.'/'.$mes.'/'.$anio;?>
		</td>	
	    <td><?php echo $resultado->patologo;?></td>	  
	</tr>
<?php endforeach;?>