<?php foreach($diagnosticos as $diagnostico):?>
	<tr>
	    <td width="45%"><?php echo $diagnostico->descr_diagccv;?></td>
	    <td width="20%"><?php echo $diagnostico->codigo;?></td>
	</tr>
<?php endforeach;?>