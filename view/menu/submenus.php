                    	<div class="widget-box">
                                <div class="widget-header">
									<h4><i class=" icon-list-ol pink"></i>Menus:</h4>
									<button class="btn btn-small btn-primary">Añadir</button>
                                </div>
                                <div class="widget-body">
                                    
                                    <div class="widget-main">
                                    	<table id="sample-table-1" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>cod</th>
												<th>Sub Menu</th>

												
											</tr>
										</thead>

										<tbody>
											<?php foreach ($lsubmenus as $lsubmenu): ?>
											<tr  data-id_cod="<?php echo $lsubmenu->id_menu_nav; ?>"> 
												<td><?php echo $lsubmenu->id_menu_nav; ?></td> 
												<td><?php echo $lsubmenu->descripcion; ?></td> 
											</tr>
												
											<?php endforeach ?>
										</tbody>
									</table>
                                    </div><!--widget-main-->
                                </div><!--widget-body-->
                            </div><!--widget-box-->