<link rel="stylesheet" href="assets/css/chosen.css" id="datos_paciente">
 <div class="page-content">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-box" data-position="top" data-intro="En este cuadro se encuentra los datos del paciente" data-step="1">
                    <div class="widget-header">
                        <h4><i class=" icon-user-md pink"></i>Datos del paciente.</h4>
                    </div><!-- widget-header -->
                    <div class="widget-body">
                        <widget class="main">
                            <div class="row-fluid ">
                                <div class="space-18"></div>
                                <form class="form-horizontal" enctype="multipart/form-data">
                                    <div class="span12 ">
                                        <div class="span6">
                                            <div class="control-group " style="margin-right: 20px; margin-left: 20px;">
                                                <label class="control-label">Numero de Biopsia</label>
                                                <div class="controls">
                                                    <input type="text" style="width:275px;" readonly="true" class=" form-control" name="num_biopsia" 
                                                        <?php if (count($biosp)==0): ?>
                                                            value = ""
                                                        <?php else: ?>
                                                              value="<?php echo $biosp[$position]->num_biopsia; ?>"       
                                                        <?php endif ?>
                                                   autocomplete="off" autofocus>
                                                </div>
                                            </div>
                                            <div class="control-group " style="margin-right: 20px; margin-left: 20px;">
                                                <label class="control-label">Nombres y Apellidos</label>
                                                <div class="controls">
                                                    <input type="text" style="width:275px;" readonly="true" class=" form-control" name="nombre" 
                                                        <?php if (count($biosp)==0): ?>
                                                            value = ""
                                                        <?php else: ?>
                                                            value="<?php echo $biosp[$position]->nombre; ?>"       
                                                        <?php endif ?>
                                                     autocomplete="off" autofocus>
                                                </div>
                                            </div>
                                           
                                            <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                <label class="control-label">Edad</label>
                                                <div class="controls">
                                                    <input type="number" style="width:275px;" class="form-control" readonly="true"
                                                       name="edad" 
                                                       <?php if (count($biosp)==0): ?>
                                                            value = ""
                                                        <?php else: ?>
                                                            value="<?php echo $biosp[$position]->edad ?>"       
                                                        <?php endif ?>
                                                     autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="control-group" style="margin-right:20px; margin-left:20px;">
                                                <label class="control-label">Sexo</label>
                                                <div class="controls form-inline">
                                                    <label for="">
                                                        <input  name="optionsRadio" id="optionsRadios3" value="1"type="radio" style="opacity: 1" 
                                                            <?php if (count($biosp)==0): ?>
                                                                uncheck
                                                            <?php else: ?>
                                                                <?php if($biosp[$position]->sexo == 0):?> checked <?php endif; ?>      
                                                            <?php endif ?>
                                                         style="margin-right:20px;">
                                                        <span class="lbl">
                                                            Masculino
                                                        </span>
                                                    </label>
                                                    <label for="">
                                                        <input  name="optionsRadio" id="optionsRadios4" value="0" type="radio" style="opacity: 1" 
                                                            <?php if (count($biosp)==0): ?>
                                                                uncheck
                                                            <?php else: ?>
                                                                <?php if($biosp[$position]->sexo == 1):?> checked <?php endif; ?> style="margin-right:20px;">     
                                                            <?php endif ?>                                                                                
                                                        <span class="lbl">
                                                            Femenino
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="control-group" id="ltecs" style="margin-right:20px; margin-left:20px;">
                                                <label class="control-label">Procedencia</label>
                                                <div class="controls">
                                                    <input type="text" style="width:275px;" readonly="true" class=" form-control" name="nombre" 
                                                        <?php if (count($biosp)==0): ?>
                                                            value = ""
                                                        <?php else: ?>
                                                            value="<?php echo $biosp[$position]->provincia; ?>"      
                                                        <?php endif ?>   
                                                    autocomplete="off" autofocus>
                                                </div>
                                            </div>
                                            <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                <label class="control-label" style="margin-right: 20px">SIS </label>
                                                <label>
                                                    <input type="checkbox" name="myoption[]" class="ace ace-checkbox" 
                                                        <?php if (count($biosp)==0): ?>
                                                            uncheck
                                                        <?php else: ?>
                                                            <?php if($biosp[$position]->sishrl_paciente == "Si"): ?> checked <?php endif; ?>     
                                                        <?php endif ?> 
                                                    />
                                                    <span class="lbl"></span>
                                                </label>
                                            </div>

                                            <div class="control-group" style="margin-right:20px; margin-left:20px;">
                                                <label class="control-label">Servicio</label>
                                                <div class="controls">
                                                    <select title="Seleccione servicio donde procede la muestra" class="form-control chosen-select"  style="width:289px;" name="servicio" id="servicio">
                                                         <?php if (count($biosp)==0): ?>
                                                            <?php if (count($servicios)): ?>
                                                            <option value="">Seleccione un Servicio</option>
                                                            <?php foreach ($servicios as $servicio): ?>
                                                                <option value="<?php echo $servicio->dep_id ?>">
                                                                    <?php echo $servicio->dep_descr; ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        <?php else : ?>
                                                            <? echo '<option value=-1> No existen registros </option>'; ?>
                                                        <?php endif; ?>

                                                        <?php else: ?>
                                                            <?php if (count($servicios)): ?>
                                                                <option value="">Seleccione un Servicio</option>
                                                                <?php foreach ($servicios as $servicio): ?>                                                                                            
                                                                    <option value="<?php echo $servicio->dep_id ?>" <?php if($biosp[$position]->dep_id == $servicio->dep_id): { echo $biosp[$position]->dep_id; } ?> selected <?php endif; ?> >
                                                                        <?php echo $servicio->dep_descr; ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            <?php else : ?>
                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                            <?php endif; ?>     
                                                        <?php endif ?> 
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group" id="ltecs" style="margin-right:20px; margin-left:20px;">
                                                <label class="control-label">Topografia</label>
                                                <div class="controls">
                                                    <select data-toggle="tooltip" title="Seleccione procedencia de la muestra" class="form-control chosen-select" style="width:289px;" name="topografia" id="topografia">
                                                        <?php if (count($biosp)==0): ?>
                                                            <?php if (count($topografias)): ?>
                                                            <option value="">Seleccione</option>
                                                            <?php foreach ($topografias as $topografia): ?>
                                                                <option value="<?php echo $topografia->id_top ?>">
                                                                    <?php echo $topografia->descr_top ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                            <?php else : ?>
                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                            <?php endif; ?>
                                                            <?php else: ?>
                                                        <?php if (count($topografias)): ?>
                                                            <option value="">Seleccione</option>
                                                            <?php foreach ($topografias as $topografia): ?>
                                                                <option value="<?php echo $topografia->id_top ?>" <?php if($biosp[$position]->id_top == $topografia->id_top): { echo $biosp[$position]->id_top; } ?> selected <?php endif; ?> >
                                                                    <?php echo $topografia->descr_top ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        <?php else : ?>
                                                            <? echo '<option value=-1> No existen registros </option>'; ?>
                                                        <?php endif; ?>
                                                        <?php endif ?>                                                                         
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group" id="ltecs" style="margin-right:20px; margin-left:20px;">
                                                <label class="hcontrol-label">Muestra Remitida</label>
                                                <div class="controls">
                                                    <select data-toggle="tooltip" title="Seleccione procedencia de la muestra" class="form-control chosen-select" style="width:289px;" name="muestra" id="muestra">
                                                        <?php if (count($biosp)==0): ?>
                                                            <?php if (count($muestras)): ?>
                                                            <option value="">Seleccione</option>
                                                            <?php foreach ($muestras as $muestra): ?>
                                                                <option value="<?php echo $muestra->codigo ?>" >
                                                                    <?php echo $muestra->descr_muestra ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                            <?php else : ?>
                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <?php if (count($muestras)): ?>
                                                            <option value="">Seleccione</option>
                                                            <?php foreach ($muestras as $muestra): ?>
                                                                <option value="<?php echo $muestra->codigo ?>" <?php if($biosp[$position]->descr_muestra == $muestra->descr_muestra): { echo $biosp[$position]->id_muestrarem; } ?> selected <?php endif; ?> >
                                                                    <?php echo $muestra->descr_muestra ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                            <?php else : ?>
                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                            <?php endif; ?>
                                                        <?php endif ?> 
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                <label class="control-label">Numero de Muestras</label>
                                                <div class="controls">
                                                    <input type="number" style="width:275px;" class="form-control" name="fechaingreso" <?php if(!empty($_GET["id"])) :?> 
                                                        <?php if (count($biosp)==0): ?>
                                                            value=""
                                                        <?php else: ?>
                                                            value="<?php echo $biopsiap->getFechaI(); ?>" <?php endif; ?>
                                                        <?php endif ?>                                                                                     
                                                           autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="control-group" style="margin-right:20px; margin-left:20px;">
                                                <label class="control-label">Diagnostico Clinico</label>
                                                <div class="controls">
                                                    <textarea class="span12" style="width:289px;" onkeyup="this.value=this.value.toUpperCase()" id="form-field-8" name="diagnosticoc" >
                                                        <?php if (count($biosp)!=0): ?>
                                                             <?php echo $biosp[$position]->diag_inicial ?>       
                                                        <?php endif ?>  
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div><!-- span6 -->
                                        <div class="span6">
                                            <div class="control-group" id="ltecs" style="margin-right:20px; margin-left:20px;">
                                                <label class="control-label">Medico Tratante</label>
                                                <div class="controls">
                                                    <input type="text" style="width:275px;" class=" form-control" name="nombre"
                                                        <?php if (count($biosp)==0): ?>
                                                            value=""
                                                        <?php else: ?>
                                                            value="<?php echo $biosp[$position]->medico_tratante; ?>" 
                                                        <?php endif ?> 
                                                     autocomplete="off" autofocus>
                                                </div>
                                            </div>

                                            <div class="control-group" style="margin-right:20px; margin-left:20px;">
                                                <label class="control-label">Observacion</label>
                                                <div class="controls">
                                                    <textarea class="span12" style="width:289px;" onkeyup="this.value=this.value.toUpperCase()" id="form-field-8" name="diagnosticoc" >
                                                        <?php if (count($biosp)!=0): ?>
                                                            <?php echo $biosp[$position]->observacion ?>
                                                        <?php endif ?>                                                                              
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                <label class="control-label">Fecha de Biopsia</label>
                                                <div class="controls">
                                                    <input type="date" style="width:275px;" class="form-control" name="edad" 
                                                        <?php if (count($biosp)==0): ?>
                                                            value=""
                                                        <?php else: ?>
                                                            value="<?php echo $biosp[$position]->fecha_biopsia; ?>" 
                                                        <?php endif ?> 
                                                    autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                <label class="control-label">Fecha de Ingreso al Servicio</label>
                                                <div class="controls">
                                                    <input type="date" style="width:275px;" class="form-control" name="fecha_ingreso"  
                                                        <?php if (count($biosp)==0): ?>
                                                            value=""
                                                        <?php else: ?>
                                                            value="<?php echo $biosp[0]->fecha_ingreso; ?>"
                                                        <?php endif ?> 
                                                    autocomplete="off">
                                                </div>
                                            </div>
                                        </div><!-- span6 -->
                                        <!-- span4 -->
                                        <div class="span4">
                                            <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                <label class="control-label">Fecha de Informe</label>
                                                <div class="controls">
                                                    <input type="date" style="width:150px;" class="form-control" name="fecha_informe" 
                                                        <?php if (count($biosp)==0): ?>
                                                            value=""
                                                        <?php else: ?>
                                                            value="<?php echo $biosp[$position]->fecha_informe; ?>"
                                                        <?php endif ?> 
                                                    autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="control-group" style="margin-right: 20px; margin-left: 20px;">
                                                <label class="control-label">Pago hecho por el Paciente</label>
                                                <div class="controls">
                                                    <input type="number" style="width:150px;" class="form-control" name="edad" 
                                                        <?php if (count($biosp)==0): ?>
                                                            value=""
                                                        <?php else: ?>
                                                            value="<?php echo $biosp[$position]->pago_paciente; ?>"
                                                        <?php endif ?> 
                                                     autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- span4 -->
                                        <!-- span2 -->
                                        <div class="span2">
                                            <div class="control-group">
                                                <label>
                                                    <input type="checkbox" name="myoption[]" class="ace ace-checkbox" checked disabled/>
                                                    <span class="lbl">Biopsia</span>
                                                </label>
                                            </div>
                                            <div class="control-group">
                                                <label>
                                                    <input type="checkbox" name="myoption[]" class="ace ace-checkbox" />
                                                    <span class="lbl">Pieza Quirurgica</span>
                                                </label>
                                            </div>
                                        </div>
                                        <!-- span2 -->
                                        <!-- span6 -->
                                        <div class="span6">
                                            <h4>Diagnostico: </h4>
                                            <div class="control-group">
                                                <label class="control-label">RESULTADO</label>
                                                <div class="controls" >
                                                    <select class="form-control chosen-select" style="width:289px;" name="id_res" id="id_res">
                                                        <?php if (count($biosp)==0): ?>
                                                            <?php if (count($resultados)): ?>
                                                            <option value=-1>Seleccione un Resultado</option>
                                                            <?php foreach ($resultados as $rt): ?>
                                                                <option value="<?php echo $rt->id_res; ?>">
                                                                    <?php echo $rt->descr_res; ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                            <?php else : ?>
                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                            <?php endif; ?>
                                                        
                                                        <?php else: ?>
                                                            <?php if (count($resultados)): ?>
                                                            <option value=-1>Seleccione un Resultado</option>
                                                            <?php foreach ($resultados as $rt): ?>
                                                                <option value="<?php echo $rt->id_res; ?>" <?php if($rt->id_res == $biosp[$position]->id_res): ?> selected <?php endif; ?>  >
                                                                    <?php echo $rt->descr_res; ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                            <?php else : ?>
                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                            <?php endif; ?>
                                                        <?php endif ?> 
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">UBICACION </label>
                                                <div class="controls">
                                                    <select class="form-control chosen-select" style="width:289px;" name="id_ubicacion" id="id_ubicacion">
                                                        <?php if (count($biosp)==0): ?>
                                                            <?php if (count($ubica)): ?>
                                                            <option value=-1>Seleccione una Ubicacion</option>
                                                            <?php foreach ($ubica as $ub): ?>
                                                                <option value="<?php echo $ub->id_ubicacion ?>" >
                                                                    <?php echo $ub->descr_ubicacion; ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                            <?php else : ?>
                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                            <?php endif; ?>

                                                        <?php else: ?>
                                                            <?php if (count($ubica)): ?>
                                                            <option value=-1>Seleccione una Ubicacion</option>
                                                            <?php foreach ($ubica as $ub): ?>
                                                                <option value="<?php echo $ub->id_ubicacion ?>" <?php if($ub->id_ubicacion == $biosp[$position]->id_ubicacion): ?> selected <?php endif; ?> >
                                                                    <?php echo $ub->descr_ubicacion; ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                            <?php else : ?>
                                                                <? echo '<option value=-1> No existen registros </option>'; ?>
                                                            <?php endif; ?>
                                                        <?php endif ?>                                                                             
                                                    </select>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="control-group" style="margin-left: 35%;" id="control-revision">
                                                <button type="button" class="btn btn-sm btn-info" id="biopsia_anterior" 
                                                    <?php if (count($biosp)==0): ?>
                                                         disabled
                                                    <?php else: ?>
                                                        data-id_count="<?php echo count($biosp);?>" data-id_pos="<?php echo $position;?>" data-id_biopsia="<?php if($position == (count($biosp)-1)){ echo $biosp[$position+1]->id_biopsia;}else{ echo $biosp[$position]->id_biopsia;} ?>"
                                                    <?php endif ?> 
                                                >
                                                    <
                                                </button>
                                                <button type="button" class="btn btn-sm btn-info" id="biopsia_siguiente" 
                                                    <?php if (count($biosp)==0): ?>
                                                        disabled
                                                    <?php else: ?>
                                                        data-id_count="<?php echo count($biosp);?>" data-id_pos="<?php echo $position;?>" data-id_biopsia="<?php if($position > 0){ echo $biosp[$position-1]->id_biopsia;}else{ echo $biosp[$position]->id_biopsia;} ?>"
                                                    <?php endif ?>     
                                                >
                                                  >
                                                </button>
                                                <button type="button" class="btn btn-sm btn-success" 
                                                    <?php if (count($biosp)==0): ?>
                                                         disabled
                                                    <?php endif ?> >
                                                    <i class="ace-icon fa fa-floppy-o bigger-160"></i>
                                                    Guardar
                                                </button>
                                            </div>
                                        </div>

                                        <!-- span6 -->
                                    </div><!-- span12 -->
                                    <div class="space-6"></div>

                                </form><!-- form -->
                            </div><!-- row-fluid -->

                        </widget><!--widget-main-->
                        <div class="space-10"></div>
                    </div><!-- widget-body -->
                </div><!--widget-box-->
                <div class="widget-box" >
                </div><!--widget-box-->
            </div>
        </div><!-- span12 -->
        <!--
        </div> -->
    </div><!-- row-f -->
</div><!-- page -->

<script src="assets/js/chosen.jquery.js"></script>
<script>
    $('.chosen-select').chosen();
</script>