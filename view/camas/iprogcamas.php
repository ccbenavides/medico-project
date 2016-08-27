
			<h4 class="header smaller lighter blue" style="margin-top: 1px;">
				Ingresar Paciente - Cama
			<label style="margin-top: 1px;float: right; display:none;" id="lablec" >
								<small class="green">
									<b>Cie por decripcion</b>
								</small>
							<input id="skip-validation" type="checkbox" class="ace-switch ace-switch-4" />
							<span class="lbl"></span>
			</label> 
			</h4>
			<div class="span4">
				<form class="form-horizontal" >

			<div class="control-group">
				<label class="control-label" for="form-field-2"><b>Buscar:</b></label>
					<div class="controls">
						<input type="text" class="span4" id="dni" name="email" placeholder="DNI">
					</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="form-field-2"><b>Paciente:</b></label>
					<div class="controls">
						<input type="text" class="span12" id="nompaciente" placeholder="Paciente"  disabled>
						<input type="hidden" id="idpaciente" >
						<input type="hidden" id="idcama" value="<?php echo $ocamas->idcama ?>">
					</div>
			</div>


			<div class="control-group">
				<label class="control-label" for="form-field-2"><b>Fecha Ingreso:</b></label>
					<div class="controls">
						<!-- <input type="password" id="form-field-2" placeholder="Password"> -->
						<div class="row-fluid input-append">
							<input class="span10 date-picker" id="fechaingreso" type="text" data-date-format="dd-mm-yyyy" />
								<span class="add-on">
									<i class="icon-calendar"></i>
								</span>
						</div>
					</div>
			</div>	

			<div class="control-group">
				<label class="control-label" for="form-field-2"><b>Hora Ingreso:</b></label>
					<div class="controls">
						<!-- <input type="password" id="form-field-2" placeholder="Password"> -->
						<div class="input-append bootstrap-timepicker">
							<input id="horaingreso" type="text" class="input-small" />
								<span class="add-on">
									<i class="icon-time"></i>
								</span>
						</div>
					</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="form-field-2"><b>Especialidad Ingreso:</b></label>
					<div class="controls">
						<!-- <input type="password" id="form-field-2" placeholder="Password"> -->
						<select id="inpespec">
							<?php foreach ($lespecatiende as $lespi): ?>
								<option value="<?php echo $lespi->id_especialidad ?>"> <?php echo $lespi->descripcion ?></option>
							<?php endforeach ?>

						</select>
					</div>
			</div>			

			<div class="control-group">
				<label class="control-label" for="form-field-2"><b>Procedencia:</b></label>
					<div class="controls">
						<!-- <input type="password" id="form-field-2" placeholder="Password"> -->
						<select id="servproc">
							<?php foreach ($listadoserv as $lserv): ?>
								<option value="<?php echo $lserv->idservicio ?>"> <?php echo $lserv->nom_servicio ?></option>
							<?php endforeach ?>

						</select>
					</div>
			</div>

			</form>
			</div>


			<div class="span7">
				
				<form class="form-horizontal" >

					<div class="control-group"> 
						<div class="controls">

						</div>
					</div>


					<div id="divcie1" class="control-group" hidden>

						<label class="control-label" for="form-field-2"><b>Cie 1 :</b></label>

						<div class="controls">

							<input type="text"  id="codcie1" class="span2 codigociei" data-ncie="1" placeholder="Codigo1" >
							<input type="hidden"  id="idcie1" class="span2" placeholder="idcie1" >
							<input type="text"  id="desccie1" class="span7 txtcie" data-ncie="1" placeholder="Cie 1" disabled>
							<button class="btn btn-minier btn-purple cie" data-type="add" data-ncie="1" id="add1" >+</button>
							<!-- <button class="btn btn-minier btn-purple cie" data-type="remove" id="removercie2" >-</button> -->
						</div>

					</div>
					<div id="divcie2" class="control-group" hidden>
						<label class="control-label" for="form-field-2"><b>Cie 2 :</b></label>

						<div class="controls">
							<input type="text"  id="codcie2" class="span2 codigociei" data-ncie="2" placeholder="Codigo2" >
							<input type="hidden"  id="idcie2" class="span2" placeholder="idcie2" >
							<input type="text"  id="desccie2" class="span7 txtcie" data-ncie="2" placeholder="Cie 2" disabled>
							<button class="btn btn-minier btn-purple cie" data-type="add" data-ncie="2" id="add2" >+</button>
							<button class="btn btn-minier btn-purple cie" data-type="remove"  data-ncie="2" id="remove2">-</button>
						</div>

					</div>

					<div id="divcie3" class="control-group" style='display:none;'>
						<label class="control-label" for="form-field-2"><b>Cie 3 :</b></label>

						<div class="controls">
							<input type="text"  id="codcie3" class="span2 codigociei" data-ncie="3" placeholder="Codigo3" >
							<input type="hidden"  id="idcie3" class="span2" placeholder="idcie3" >
							<input type="text"  id="desccie3" class="span7 txtcie" data-ncie="3" placeholder="Cie 3" disabled>
							<!-- <button class="btn btn-minier btn-purple cie" data-type="add" data-ncie="3" id="add3">+</button> -->
							<button class="btn btn-minier btn-purple cie" data-type="remove" data-ncie="3" id="remove3" >-</button>
						</div>

					</div>					

					<div id="divobsi" class="control-group" hidden>
						<label class="control-label" for="form-field-2"><b>Observacion:</b></label>
							
						<div class="controls">
							<textarea class="span12" id="observacion" placeholder="Observacion"></textarea>
						</div>

					</div>	


					<div  class="control-group" >
						<label class="control-label" for="form-field-2"><b>Estado:</b></label>
							
						<div class="controls">
							<select id="sestadoi">
								<option value="-1"> - - Seleccione un estado - - </option>
								<?php foreach ($estados as $estado): ?>
									<option value="<?php echo $estado->idestado_cama ?>"><?php echo $estado->desc_estado_cama ?></option>
								<?php endforeach ?>

							</select>
						</div>
					</div>

				</form>

				<div  style="text-align: right;">
					<button class="btn btn-info" id="btnguardar" type="button">
						<i class="icon-ok bigger-110"></i>Guardar</button>
									&nbsp; &nbsp; &nbsp;
					<button class="btn" type="reset">
						<i class="icon-undo bigger-110"></i>Cancelar</button>
				</div>
			</div>
