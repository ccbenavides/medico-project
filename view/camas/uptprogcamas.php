
			<h4 class="header smaller lighter blue" style="margin-top: 1px;">
				Actualizar Cama-Paciente

			<label style="margin-top: 1px;float: right;" id="lablec" >
								<small class="green">
									<b>Cie por decripcion</b>
								</small>
							<input id="bcieupt" type="checkbox" class="ace-switch ace-switch-4" />
							<span class="lbl"></span>
			</label> 

			</h4>
			<div class="span4">
				<input type="hidden" id="idprog" value="<?php echo $idprog; ?>">
				<input type="hidden" id="idcamaegreso" value="<?php echo $ocamas->idcama ?>">
				<form class="form-horizontal" >
			<div class="control-group">
				<label class="control-label" for="form-field-2"><b>Paciente:</b></label>
					<div class="controls">
						<!-- <input type="password" id="form-field-2" placeholder="Password"> -->
						<label  class="control-label span12" for="form-field-1" style="text-align: left;"><?php echo $oprogcamas->a_paterno .' '.$oprogcamas->a_materno.' '.$oprogcamas->nombre ?></label>

					</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="form-field-2"><b>DNI:</b></label>
					<div class="controls">
						<!-- <input type="password" id="form-field-2" placeholder="Password"> -->
						<label  class="control-label span12" for="form-field-1" style="text-align: left;"><?php echo $oprogcamas->dni ?></label>
					</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="form-field-2"><b>Fecha:</b></label>
					<div class="controls">
						<!-- <input type="password" id="form-field-2" placeholder="Password"> -->
						<div class="row-fluid input-append">
							<input class="span10 date-picker" id="fechasalida" type="text" data-date-format="dd-mm-yyyy" />
								<span class="add-on">
									<i class="icon-calendar"></i>
								</span>
						</div>
					</div>
			</div>	
			<div class="control-group">
				<label class="control-label" for="form-field-2"><b>Hora:</b></label>
					<div class="controls">
						<!-- <input type="password" id="form-field-2" placeholder="Password"> -->
						<div class="input-append bootstrap-timepicker">
							<input id="horasalida" type="text" class="input-small hora" />
								<span class="add-on">
									<i class="icon-time"></i>
								</span>
						</div>
					</div>
			</div>
			</form>
			</div>

			<div class="span7">
				<form class="form-horizontal" >
					<div  class="control-group" >
						<label class="control-label" for="form-field-2"><b>Estado Cama:</b></label>
							
						<div class="controls">
							<select id="sestadoupt">
								<option value='-1'> - - seleccione una opcion - - </option>
								<?php foreach ($estados as $estado): ?>

									<option value="<?php echo $estado->idestado_cama ?>"><?php echo $estado->desc_estado_cama ?></option>
								<?php endforeach ?>

							</select>
						</div>
					</div>					
					<div id="divcondicion" class="control-group" <?php echo (($ocamas->estado_cama) == 3) ? '' : 'hidden' ;  ?> >
						<label class="control-label" for="form-field-2"><b>Condicion Egreso:</b></label>

						<div class="controls">
							<select id="scondicion"> 

							</select>
						</div>
					</div>	
					<div id="divservtransf" class="control-group" hidden> 
						<label class="control-label" for="form-field-2"><b>Servicio. Transf:</b></label>

						<div class="controls">
							<select id="s_servtransf"> 

							</select>
						</div>
					</div>	
					<div id="divesptransf" class="control-group" hidden> 
						<label class="control-label" for="form-field-2"><b>Especialidad. Transf:</b></label>

						<div class="controls">
							<select id="s_esptransf"> 

							</select>
						</div>
					</div>						
					<div id="divref" class="control-group" hidden> 
						<label class="control-label" for="form-field-2"><b>Referencia/Cont</b></label>

						<div class="controls">
							<input type="text" id="deschosp">
							<input type ="hidden" id="ref_contra" >
						</div>
					</div>						

					<div id="divciesal1" class="control-group">
						<label class="control-label" for="form-field-2"><b>Cie 1 :</b></label>
						<div class="controls">
							<input type="text"  id="codciesal1" class="span2 codigocieisal" data-nciesal="1" placeholder="Codigo1" >
							<input type="hidden"  id="idciesal1" class="span2" placeholder="idcie1" >
							<input type="text"  id="descciesal1" class="span7 txtciesal" data-nciesal="1" placeholder="Cie 1" disabled>
							<button class="btn btn-minier btn-purple ciesal" data-typesal="addsal" data-nciesal="1" id="addsal1" >+</button>
							<!-- <button class="btn btn-minier btn-purple ciesal" data-typesal="removesal" id="removercie2" >-</button> -->
						</div>

					</div>
					<div id="divciesal2" class="control-group" hidden>
						<label class="control-label" for="form-field-2"><b>Cie 2 :</b></label>

						<div class="controls">
							<input type="text"  id="codciesal2" class="span2 codigocieisal" data-nciesal="2" placeholder="Codigo2" >
							<input type="hidden"  id="idciesal2" class="span2" placeholder="idcie2" >
							<input type="text"  id="descciesal2" class="span7 txtciesal" data-nciesal="2" placeholder="Cie 2" disabled>
							<button class="btn btn-minier btn-purple ciesal" data-typesal="addsal" data-nciesal="2" id="addsal2" >+</button>
							<button class="btn btn-minier btn-purple ciesal" data-typesal="removesal"  data-nciesal="2" id="remove2">-</button>
						</div>

					</div>

					<div id="divciesal3" class="control-group" style='display:none;'>
						<label class="control-label" for="form-field-2"><b>Cie 3 :</b></label>

						<div class="controls">
							<input type="text"  id="codciesal3" class="span2 codigocieisal" data-nciesal="3" placeholder="Codigo3" >
							<input type="hidden"  id="idciesal3" class="span2" placeholder="idcie3" >
							<input type="text"  id="descciesal3" class="span7 txtciesal" data-nciesal="3" placeholder="Cie 3" disabled>
							<!-- <button class="btn btn-minier btn-purple ciesal" data-typesal="addsal" data-nciesal="3" id="addsal3">+</button> -->
							<button class="btn btn-minier btn-purple ciesal" data-typesal="removesal" data-nciesal="3" id="remove3" >-</button>
						</div>

					</div>

									

					<div id="divobsupt" class="control-group" >
						<label class="control-label" for="form-field-2"><b>Observacion </b></label>
							
						<div class="controls">
							<textarea class="span12" id="observacionsalida" placeholder="Observacion"></textarea>
						</div>

					</div>	


				</form>

				<div  style="text-align: right;">
					<button class="btn btn-info" id="btnguardarsalida" type="button">
						<i class="icon-ok bigger-110"></i>Guardar</button>
									&nbsp; &nbsp; &nbsp;
					<button class="btn" type="reset">
						<i class="icon-undo bigger-110"></i>Cancelar</button>
				</div>
			</div>


