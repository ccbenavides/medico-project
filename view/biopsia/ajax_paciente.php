<?php foreach($paciente as $opac):?>
	<tr>
	    <td><?php echo $opac->dni;?></td>
	   	<td><?php echo $opac->nombres;?></td>
	   	<td><?php echo $opac->edad;?></td>
	    <td><?php echo $opac->sexo;?></td>
	</tr>
<?php endforeach;?>