var ajaxcamas = function(idlado){

	var options = {
		type: 'POST',
		url:'index.php?page=progcamas&accion=ajaxcamas',
		data: {
			'idlado' : idlado
		},
		dataType: 'html',
		success: function(response){
			$('#divcamas').removeAttr('disabled');
			$('#divcamas').html(response);
			$('#divcamas').fadeIn("fast");
			$('#divinfocamas').fadeOut("fast");
		}
	};
	$.ajax(options);
};

var ajaxlado = function(idpiso){
	var options = {
		type: 'POST',
		url:'index.php?page=progcamas&accion=ajaxgetlado',
		data: {
			'idpiso' : idpiso
		},
		dataType: 'html',
		success: function(response){
			$('#slado').removeAttr('disabled');
			$('#slado').html(response);
			$('#divinfocamas').hide();


		}
	};
	$.ajax(options);
};

var getinfocamas = function(codcama){

	var options = {
		type: 'POST',
		url:'index.php?page=progcamas&accion=ajaxgetinfocama',
		data: {
			'codcama' : codcama
		},
		dataType: 'html',
		success: function(response){


			$('#divinfocamas').removeAttr('disabled');
			$('#divinfocamas').html(response);
			$('#horaingreso').timepicker({
				minuteStep: 1,
				showSeconds: true,
				showMeridian: false
			});

			$('#horasalida').timepicker({
				minuteStep: 1,
				showSeconds: true,
				showMeridian: false
			});
			$('.date-picker').datepicker().next().on(ace.click_event, function(){
				$(this).prev().focus();
			});
			var estc = $('#estc').val();
			//alert(estc);

			if (estc == 4) {
				//id="divciesal2"
				$('#divciesal1').hide();
				$('#divobsupt').hide();
			};
		}
	};
	$.ajax(options);
};

var insertprogcamas = function(idestado, idlado, idcama, idpaciente, fechaingreso, horaingreso, idservicio, cie1, cie2, cie3, observacion, inpespec){
	var options = {
		type: 'POST',
		url:'index.php?page=progcamas&accion=ajaxinsertprogcamas',
		data: {
			'idestado' : idestado,
			'idlado' : idlado,
			'idcama' : idcama,
			'idpaciente' : idpaciente,
			'fechaingreso' : fechaingreso,
			'horaingreso' : horaingreso,
			'idservicio' : idservicio,
			'cie1' : cie1,
			'cie2' : cie2,
			'cie3' : cie3,
			'observacion' : observacion,
			'inpespec' : inpespec,
		},
		dataType: 'json',
		success: function(response){

			if (response.inserted == true) {
				bootbox.alert("Registro Realizado Correctamente!");
				ajaxcamas(response.idlado);
			} else{};
		}
	};
	$.ajax(options);

};

var updateprogcamas = function(idestadoupt, idprog, idlado, idcamaegreso ,fechasalida, horasalida, ciesal1, ciesal2, ciesal3, observacionsalida, scondicion, s_esptransf, ref_contra ){

	var options = {
		type: 'POST',
		url:'index.php?page=progcamas&accion=ajaxupdateprogcamas',
		data: {
			'idestadoupt' : idestadoupt,
			'idprog' : idprog,
			'idlado' : idlado,
			'idcamaegreso' : idcamaegreso,
			'fechasalida' : fechasalida,
			'horasalida' : horasalida,
			'ciesal1' : ciesal1,
			'ciesal2' : ciesal2,
			'ciesal3' : ciesal3,
			'observacionsalida' : observacionsalida,
			'scondicion' : scondicion,
			's_esptransf' : s_esptransf,
			'ref_contra' : ref_contra,
		},
		dataType: 'json',
		success: function(response){

			if (response.updated == true) {
				bootbox.alert("Egreso Realizado Correctamente!");
				ajaxcamas(response.idlado);
				// console.log(response.ciesupt1);
				// console.log(response.ciesupt2);
				// console.log(response.ciesupt3);
				console.log(response.prog);
			} else{};
		}
	};
	$.ajax(options);

};


var mostrarmensaje = function (titulo, mensaje) {

	$.gritter.add({
		title: titulo,
		text: mensaje,
		image: 'assets/avatars/avatar1.png',
		sticky: false,
		time: '',
		class_name: (!$('#gritter-light').get(0).checked ? 'gritter-light' : '')
	});

	return false;
}

$(document).on('ready', function(e){

//ajaxcamas();

});

$('#spiso').on('change', function(e){
	var idpiso = $('#spiso').val();

	ajaxlado(idpiso);
	$('#divcamas').hide();
	$('#divinfocamas').hide();
});

$('#slado').on('change', function(e){
	var idlado = $('#slado').val();
	$('#divcamas').hide();
	ajaxcamas(idlado);
});

$(document).on('click', '.clasecama', function(e){
	e.preventDefault();
	$('.clasecama').each(function(){
		$(this).removeClass('camaseleccionada');
	});

	$(this).addClass('camaseleccionada');
	var codcama = $(this).data('id_cama');
	getinfocamas(codcama);
	$('#divinfocamas').show();
});

$(document).on('click', '#btnguardar', function() {

	var idestado = $('#sestadoi').val();
	var idlado = $('#slado').val();
	var idcama = $('#idcama').val();
	var idpaciente = $('#idpaciente').val();
	var fechaingreso = $('#fechaingreso').val();
	var horaingreso = $('#horaingreso').val();
	var idservicio = $('#servproc').val();
	var cie1 = $('#idcie1').val();
	var cie2 = $('#idcie2').val();
	var cie3 = $('#idcie3').val();
	var observacion = $('#observacion').val();
	var inpespec = $('#inpespec').val();

	var funcioning = function () {
		bootbox.confirm("Esta seguro de realizar este registro?", function(result) {
			if(result) {
			insertprogcamas(idestado, idlado, idcama, idpaciente, fechaingreso, horaingreso, idservicio, cie1, cie2, cie3, observacion, inpespec);
			}
		});
	}


	switch(idestado){
		case '-1':

				bootbox.alert("Debe Completar todos los campos");
		break;		

		case '2':
			if (idpaciente =='' || fechaingreso =='' || idestado == -1) {
				bootbox.alert("Debe Completar todos los campos");
			} else{
					funcioning();
			};

		break;

		case '3':
			if (idpaciente =='' || fechaingreso =='' || idestado == -1 || cie1 == '') {
				bootbox.alert("Debe Completar todos los campos e ingresar al menos 1 cie");
			} else{
					funcioning();
			};

		break;


	}





// if (idpaciente =='' || fechaingreso =='' || idestado == -1) {
// 	bootbox.alert("Debe Completar todos los campos");

// } else{



// 	bootbox.confirm("Esta seguro de realizar este registro?", function(result) {
// 		if(result) {
// 		insertprogcamas(idestado, idlado, idcama, idpaciente, fechaingreso, horaingreso, idservicio, cie1, cie2, cie3, observacion, inpespec);
// 		}
// 	});
// };

});

$(document).on('click', '#btnguardarsalida', function() {
	var idestadoupt = $('#sestadoupt').val();
	var idlado = $('#slado').val();
	var idprog = $('#idprog').val();
	var idcamaegreso = $('#idcamaegreso').val();
	var fechasalida = $('#fechasalida').val();
	var horasalida = $('#horasalida').val();
	var ciesal1 = $('#idciesal1').val();
	var ciesal2 = $('#idciesal2').val();
	var ciesal3 = $('#idciesal3').val();
	var observacionsalida = $('#observacionsalida').val();
	var scondicion = $('#scondicion').val();
	var s_esptransf = $('#s_esptransf').val();
	var ref_contra = $('#ref_contra').val();
	
	var estadocam = $('#estc').val();

	// var funcionupt = updateprogcamas(idestadoupt, idprog, idlado, idcamaegreso, fechasalida, horasalida, ciesal1, ciesal2, ciesal3, observacionsalida, scondicion, s_esptransf, ref_contra );
		
	var funcionupt = function () {
		// alert(estadocam); 
		updateprogcamas(idestadoupt, idprog, idlado, idcamaegreso, fechasalida, horasalida, ciesal1, ciesal2, ciesal3, observacionsalida, scondicion, s_esptransf, ref_contra );
	}

	switch(estadocam){
		case '4':
			if (fechasalida == '' || idestadoupt == -1 ) {
				bootbox.alert("Debe Completar todos los campos ");	
			} else{
				bootbox.confirm("Esta seguro de realizar este registro?", function(result) {
					if(result) {
						funcionupt();
				
					}
				});
			};
		break;	

		case '2':
			switch(idestadoupt){
				case '-1':
				if (fechasalida == '') {
					bootbox.alert("Debe Completar todos los campos");
				} else{
					bootbox.alert("Debe seleccionar un estado");
				};
				break;	

				case '1':
				if (fechasalida == '') {
					bootbox.alert("Debe asignar fecha");
				} else{

					bootbox.confirm("Esta seguro de realizar este registro?", function(result) {
						if(result) {
							funcionupt();
					
						}
					});					
				};
				break;

				case '3':
				if (fechasalida == '' || ciesal1 =='') {
					bootbox.alert("Debe Completar todos los campos e ingresar al menos 1 cie");
				} else{

					bootbox.confirm("Esta seguro de realizar este registro?", function(result) {
						if(result) {
							funcionupt();
					
						}
					});					
				};
				break;
			}
		break;			

		case '3':
			// if (fechasalida == '' || idestadoupt == -1 || ciesal1 =='') {
			// 	bootbox.alert("Debe Completar todos los campos e ingresar al menos 1 cie4");	
			// } else{
			// 	bootbox.confirm("Esta seguro de realizar este registro4?", function(result) {
			// 		if(result) {
			// 			funcionupt();
			// 		}
			// 	});
			// };

			switch(idestadoupt){

				case '-1':
					bootbox.alert("Debe completar todos los campos");
				break;	
							
				case '1':
					

					switch(scondicion){
						case '-1':
							bootbox.alert("Debe completar todos los campos");
						break;

						case '1':
							//bootbox.alert("libre/alta");
							if (fechasalida == '' || idestadoupt == -1 || ciesal1 == '') {
								bootbox.alert("Debe completar todos los campos");
							} else{
								bootbox.confirm("Esta seguro de realizar este registro?", function(result) {
									if(result) {
										funcionupt();
									}
								});
							};

						break;	

						case '2':
							//bootbox.alert("libre/transferido");

							if (fechasalida == '' || idestadoupt == -1 || ciesal1 == '' || s_esptransf == -1) {
								bootbox.alert("Debe completar todos los campos");
							} else{
								bootbox.confirm("Esta seguro de realizar este registro?", function(result) {
									if(result) {
										funcionupt();
									}
								});
							};

						break;	

						case '3':
							//bootbox.alert("libre/fallecido");

							if (fechasalida == '' || idestadoupt == -1 || ciesal1 == '') {
								bootbox.alert("Debe completar todos los campos");
							} else{
								bootbox.confirm("Esta seguro de realizar este registro?", function(result) {
									if(result) {
										funcionupt();
									}
								});
							};

						break;	

						case '4':
							//bootbox.alert("libre/Referido");

							if (fechasalida == '' || idestadoupt == -1 || ciesal1 == '' || ref_contra == '') {
								bootbox.alert("Debe completar todos los campos");
							} else{
								bootbox.confirm("Esta seguro de realizar este registro?", function(result) {
									if(result) {
										funcionupt();
									}
								});
							};

						break;	

						case '5':
							//bootbox.alert("libre/contraReferido");
							if (fechasalida == '' || idestadoupt == -1 || ciesal1 == '' || ref_contra == '') {
								bootbox.alert("Debe completar todos los campos");
							} else{
								bootbox.confirm("Esta seguro de realizar este registro?", function(result) {
									if(result) {
										funcionupt();
									}
								});
							};

						break;	

						case '6':
							//bootbox.alert("libre/RV");
							if (fechasalida == '' || idestadoupt == -1 || ciesal1 == '' ) {
								bootbox.alert("Debe completar todos los campos");
							} else{
								bootbox.confirm("Esta seguro de realizar este registro?", function(result) {
									if(result) {
										funcionupt();
									}
								});
							};							
						break;																																
					}

				break;

				case '4':
					//bootbox.alert("Por Descocupar");
					switch(scondicion){
						case '-1':
							bootbox.alert("Debe completar todos los campos");
						break;

						case '1':
							//bootbox.alert("Alta");
							if (fechasalida == '' || idestadoupt == -1 || ciesal1 == '' ) {
								bootbox.alert("Debe completar todos los campos");
							} else{
								bootbox.confirm("Esta seguro de realizar este registro?", function(result) {
									if(result) {
										funcionupt();
									}
								});
							};	
						break;		

						case '3':
							//bootbox.alert("Por Descocupar");
							if (fechasalida == '' || idestadoupt == -1 || ciesal1 == '' ) {
								bootbox.alert("Debe completar todos los campos");
							} else{
								bootbox.confirm("Esta seguro de realizar este registro?", function(result) {
									if(result) {
										funcionupt();
									}
								});
							};	
						break;										
					}


				break;				
			}

		break;



	}




});


