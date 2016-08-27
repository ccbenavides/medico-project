<?php foreach($areaspaciente  as $apaciente):?>
		<tr class="actividad_de_especialidad" data-id_area_pac="<?php echo $apaciente->id_area;?>" data-id_area_pac_txt="<?php echo $apaciente->descr_area;?>" data-id_area_dni="<?php echo $apaciente->dni;?>">
		<td><?php echo $apaciente->id_area;?></td>
		<td> <label for="a"> <?php echo $apaciente->descr_area;?></label></td>
		</tr>

<?php endforeach;?>