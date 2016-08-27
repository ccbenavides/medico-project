
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

	<tr >
		<?php foreach ($lhabitaciones as $lhabit): ?>
		<?php $cantcamas = $camas->ocantcamaxhabit($lhabit->idhabitacion); ?>
		<?php 
			$resto = ($cantcamas->cantidad)%2; 
			if ($resto == 0) {
				$limit =($cantcamas->cantidad)/2; ;
			} else {
				$newcant =($cantcamas->cantidad)+1 ;
				$limit =$newcant/2 ;
			}
			$lcamas = $camas->listarcamasxhab($lhabit->idhabitacion, 0, $limit);
		?>

	

		<td class="tdpadre">
			<table class="table table-striped table-bordered table-hover" >
			<?php foreach ($lcamas as $lcama): ?>
				<td data-id_cama="<?php echo $lcama->idcama; ?>" class="tdcama clasecama"  style=" background: <?php 
					switch ($lcama->estado_cama) {
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
					<?php echo $lcama->letracama; ?>
				</td>
			<?php endforeach ?>
			</table>
		</td>

		<?php endforeach ?>	
		
	</tr>		


	<tr >
		<?php foreach ($lhabitaciones as $lhabit): ?>
		<?php $cantcamas = $camas->ocantcamaxhabit($lhabit->idhabitacion); ?>
		<?php 
			$resto = ($cantcamas->cantidad)%2; 
			if ($resto == 0) {
				$limit =($cantcamas->cantidad)/2; ;
			} else {
				$newcant =($cantcamas->cantidad)+1 ;
				$limit =$newcant/2 ;
			}
			$lcamas = $camas->listarcamasxhab($lhabit->idhabitacion, $limit, $limit);
		?>

	

		<td class="tdpadre">
			<table class="table  " >
			<?php foreach ($lcamas as $lcama): ?>
				<td data-id_cama="<?php echo $lcama->idcama; ?>" class="tdcama clasecama"  style=" background: <?php 
					switch ($lcama->estado_cama) {
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
					<?php echo $lcama->letracama; ?>
				</td>
			<?php endforeach ?>
			</table>
		</td>





			

		<?php endforeach ?>	
		
	</tr>

	</tbody>
</table>									