
<table id="sample-table-1" class="table table-striped table-bordered table-hover"  >
<!--colores para td
	rojo = #FC7565
	verde = #9CDB81
	amarillo = #FFCD00
	celeste = #7AF0DE
-->
	<thead>
		<tr>
		<?php foreach ($lhabitaciones as $lhabit): ?>
			<th><b><?php echo $lhabit->nrohabitacion ?></b></th>
		<?php endforeach ?>
		</tr>
	</thead>
	<tbody>
		
			<tr>
			<?php foreach ($lhabitaciones as $lhabit): ?>
						
				<?php  $lcamas = $camas->listarcamasxhab($lhabit->idhabitacion, 'A'); ?>
				<td data-id_cama="<?php echo $lcamas->idcama; ?>" class="clasecama"  style=" background: <?php 
					switch ($lcamas->estado_cama) {
						case '1':
							echo "#9CDB81";
							break;
						case '2':
							echo "#FFCD00";
							break;	
						case '3':
							echo "#FC7565";
							break;	
						case '4':
							echo "#7AF0DE";
							break;																				
						default:
							# code...
							break;
						}
					?>">	
					<?php echo $lcamas->letracama; ?>
				</td>	

			<?php endforeach ?>
			</tr>

			<tr>
			<?php foreach ($lhabitaciones as $lhabit): ?>
						
				<?php  $lcamas = $camas->listarcamasxhab($lhabit->idhabitacion, 'B'); ?>
				<td data-id_cama="<?php echo $lcamas->idcama; ?>" class="clasecama"  style=" background: <?php 
					switch ($lcamas->estado_cama) {
						case '1':
							echo "#9CDB81";
							break;
						case '2':
							echo "#FFCD00";
							break;	
						case '3':
							echo "#FC7565";
							break;	
						case '4':
							echo "#7AF0DE";
							break;																				
						default:
							# code...
							break;
						}
					?>">	
					<?php echo $lcamas->letracama; ?>
				</td>	
			<?php endforeach ?>
			</tr>		
		
	</tbody>
</table>									