                                    	<table id="sample-table-1" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>cod</th>
												<th>Menu</th>
												<th>Icono</th>
											</tr>
										</thead>

										<tbody>
											<?php foreach ($lmenus as $lmenu): ?>
											<tr class="menupadre" data-id_cod="<?php echo $lmenu->id_menu_nav; ?>"> 
												<td><?php echo $lmenu->id_menu_nav; ?></td> 
												<td><?php echo $lmenu->descripcion; ?></td>
												<td><i class="<?php echo $lmenu->icono; ?> "></i>  </td>
											</tr>
												
											<?php endforeach ?>
										</tbody>
									</table>