$(document).on('ready',function() {
	var estructura=$('#estructura_historial');
	
	$('#historial-paciente').on('submit',function(e){
		e.preventDefault();
		estructura.slideDown("slow");
		getPacientes($('input:text[name=dni]').val());
		getAreas($('input:text[name=dni]').val());
	});

	$('input:text[name=dni]').keyup(function(e){
		if (e.keyCode===8) {
			
			estructura.slideUp();
			
		};
	});

})
var ajax_paciente=$('#ajax_paciente');
var getPacientes=function(dni){
		var options = {
			type: 'POST',
			url:'index.php?page=paciente&accion=ajaxgetpac',
			data: {
				'dni': dni
			},
			dataType: 'html',
			success: function(response){

					ajax_paciente.html('');
					ajax_paciente.html(response);
					ajax_paciente.fadeIn('slow');				
					
			}
		};

		$.ajax(options);
};

var ajax_area=$('#ajax_areas');
var getAreas=function(dni){
	var options = {
			type: 'POST',
			url:'index.php?page=paciente&accion=ajaxareas',
			data: {
				'dni': dni
			},
			dataType: 'html',
			success: function(response){

					ajax_area.html('');
					ajax_area.html(response);
					ajax_area.fadeIn('slow');				
					
			}
		};

		$.ajax(options);
};
var actividad_dep_seleccionada = -1;

	$('body').on('click', '.actividad_de_especialidad', function(e){
		e.preventDefault();
		var area_pac_id = $(this).data('id_area_pac');
		var area_dni_id=$(this).data('id_area_dni');

		actividad_dep_seleccionada = area_pac_id;

		getBiopsias(actividad_dep_seleccionada, area_dni_id);

		
	});
var ajax_bio=$('#ajax_biopsias');
var getBiopsias=function(area,dni){
	var options = {
			type: 'POST',
			url:'index.php?page=paciente&accion=ajaxbiopsias',
			data: {
				'area_pac_id': area,
				'area_dni_id':dni
			},
			dataType: 'html',
			success: function(response){

					ajax_bio.html('');
					ajax_bio.html(response);
					ajax_bio.fadeIn('slow');				
					
			}
		};

		$.ajax(options);
};