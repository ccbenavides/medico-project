<div class="span12">
	<input id="estc" value="<?php echo $ocamas->estado_cama ?>" hidden>
	<input id="gritter-light" checked="" type="checkbox" class="ace-switch ace-switch-5"  />
	<div class="tabbable">
		<ul class="nav nav-tabs" id="myTab">
			<li class="active">
				<a data-toggle="tab" href="#home">
					<i class="green icon-home bigger-110"></i>
						Informacion
				</a>
			</li>

			<li <?php echo (($ocamas->estado_cama == 1)) ? 'hidden' : '' ; ?> >
				<a data-toggle="tab" href="#profile" >
					<i class="green fa fa-wheelchair bigger-110"></i> Paciente
					<!-- <span class="badge badge-important">4</span> -->
				</a>
			</li>

			<li class="dropdown">
				<a data-toggle="dropdown" class="dropdown-toggle" href="#">
					Acciones
				<b class="caret"></b>
				</a>
		<ul class="dropdown-menu dropdown-info">
			<li <?php echo (($ocamas->estado_cama == 1)) ? '' : 'hidden' ; ?> >
				<a data-toggle="tab" href="#dropdown1" >Ingresar</a>
			</li>
<!-- 			<li <?php// echo (($ocamas->estado_cama == 1)) ? 'hidden' : '' ; ?>>
				<a data-toggle="tab" href="#dropdown2">Actualizar</a>
			</li> -->
			<li <?php echo (($ocamas->estado_cama == 1)) ? 'hidden' : '' ; ?>>
				<a data-toggle="tab" href="#dropdown3">Actualizar</a>
			</li>
		</ul>
			</li>
		</ul>
	<div class="tab-content">
		<div id="home" class="tab-pane in active">
			<form class="form-horizontal">
				<div class="control-group">
					<label class="control-label" for="form-field-1">Estado: </label>
						<div class="controls">

								<label class="label label-large label-success arrowed-in arrowed-in-right"><?php echo $ocamas->desc_estado_cama; ?></label>
						</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="form-field-2">Tipo Cama:</label>
						<div class="controls">
						<!-- <input type="password" id="form-field-2" placeholder="Password"> -->
							<span class="help-inline"><b><?php echo $ocamas->desc_tipo_cama ?></b></span>
						</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="form-field-2">Habitación:</label>
						<div class="controls">
						<!-- <input type="password" id="form-field-2" placeholder="Password"> -->
							<span class="help-inline"><b><?php echo $ocamas->nrohabitacion ?></b></span>
						</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="form-field-2">Cama:</label>
						<div class="controls">
						<!-- <input type="password" id="form-field-2" placeholder="Password"> -->
							<span class="help-inline"><b><?php echo $ocamas->letracama ?></b></span>
						</div>
				</div>


			</form>

		</div>

		<div id="profile" class="tab-pane">
			<div class="span4">
				<form class="form-horizontal" >
			<div class="control-group">
				<label class="control-label" for="form-field-2"><b>Paciente:</b></label>
					<div class="controls">
						<!-- <input type="password" id="form-field-2" placeholder="Password"> -->
						<label  class="control-label span12" for="form-field-1" style="text-align: left;"><?php echo $oprogcamas->a_paterno .' '.$oprogcamas->a_materno.' '.$oprogcamas->nombre ?></label>
					</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="form-field-2"><b>Fecha Ingreso:</b></label>
					<div class="controls">
						<!-- <input type="password" id="form-field-2" placeholder="Password"> -->
						<label class="control-label" for="form-field-1" style="text-align: left;"><?php echo $oprogcamas->fecha_ingreso ?></label>
					</div>
			</div>	

			<div class="control-group">
				<label class="control-label" for="form-field-2"><b>Hora Ingreso:</b></label>
					<div class="controls">
						<!-- <input type="password" id="form-field-2" placeholder="Password"> -->
						<label label class="control-label" for="form-field-1" style="text-align: left;"><?php echo $oprogcamas->hora_ingreso ?></label>
					</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="form-field-2"><b>Procedencia:</b></label>
					<div class="controls">
						<!-- <input type="password" id="form-field-2" placeholder="Password"> -->
						<label label class="control-label" for="form-field-1" style="text-align: left;"><?php echo $oprogcamas->nom_servicio ?></label>
					</div>
			</div>

			</form>
			</div>
			
		<div class="span5" > 
				<form class="form-horizontal">
				<?php foreach ($oprogcamasdet as $progcamadet): ?>
								<div class="control-group">
								<label class="control-label" for="form-field-2"><b>Cie <?php echo (($progcamadet->cie_tipo)==1 ) ? 'Ingreso' : 'Egreso' ; ?><?php echo $progcamadet->orden ?> :</b></label>
									<div class="controls">
										<!-- <input type="password" id="form-field-2" placeholder="Password"> -->
										<label label class="control-label" for="form-field-1" style="text-align: left; width: 250px;"><?php echo $progcamadet->codigo.' / '.$progcamadet->descripcion ?></label>
									</div>
							</div>

				<?php endforeach ?>
				</form>

		</div>

		<div class="span3" > 
				<form class="form-horizontal">
			<div class="control-group">
				<label class="control-label" for="form-field-2"><b>Observacion Ingreso:</b></label>
					<div class="controls">
						<!-- <input type="password" id="form-field-2" placeholder="Password"> -->
						<label label class="control-label" for="form-field-1" style="text-align: left;"><?php echo $oprogcamas->observacion_ingreso ?></label>
					</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="form-field-2"><b>Observacion Egreso:</b></label>
					<div class="controls">
						<!-- <input type="password" id="form-field-2" placeholder="Password"> -->
						<label label class="control-label" for="form-field-1" style="text-align: left;"><?php echo $oprogcamas->observacion_salida ?></label>
					</div>
			</div>			
				</form>

		</div>

		</div>

		<div id="dropdown1" class="tab-pane">
			<?php require 'view/camas/iprogcamas.php'; ?>
		</div>
		<div id="dropdown2" class="tab-pane">
			<?php// require 'view/camas/iprogcamas.php'; ?>
		</div>		
		<div id="dropdown3" class="tab-pane">
			<?php require 'view/camas/uptprogcamas.php'; ?>
		</div>
	</div>
</div>
</div><!--/span-->