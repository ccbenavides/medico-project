var notificacion = function (mensaje) {
	$.gritter.add({
		title: 'Notificacion!',
		text: mensaje,
		sticky: false,
		time: '',
		class_name: (!$('#gritter-light').get(0).checked ? 'gritter-light' : '')
	});

	return false;
}

var ajaxmenu = function(){

	var options = {
		type: 'POST',
		url:'index.php?page=menu&accion=ajaxmenu',
		data: {
			
		},
		dataType: 'html',
		success: function(response){


			$('#divmenu').removeAttr('disabled');
			$('#divmenu').html(response);
		}
	};
	$.ajax(options);

};



var getsubmenus = function(codmenu){

	var options = {
		type: 'POST',
		url:'index.php?page=menu&accion=ajaxGetsubmenus',
		data: {
			'codmenu': codmenu,
		},
		dataType: 'html',
		success: function(response){


			$('#divsubmenu').removeAttr('disabled');
			$('#divsubmenu').html(response);
		}
	};
	$.ajax(options);

};



var setmenus = function(menunom, link, sicono){

	var options = {
		type: 'POST',
		url:'index.php?page=menu&accion=ajaxSetmenus',
		data: {
			'menunom': menunom,
			'link': link,
			'sicono': sicono
		},
		dataType: 'json',
		success: function(response){
			ajaxmenu();

		}
	};
	$.ajax(options);

};


var vpiconos = function(codicono){

	var options = {
		type: 'POST',
		url:'index.php?page=menu&accion=ajaxGetIconos',
		data: {
			'codicono': codicono,
		},
		dataType: 'html',
		success: function(response){
			$('#vpicono').removeAttr('disabled');
			$('#vpicono').html(response);
		}
	};
	$.ajax(options);

};


$(document).on('ready', function(e){

ajaxmenu();

});



$(document).on('click', '.menupadre', function(e){

	e.preventDefault();
	$('.menupadre').each(function(){
		$(this).removeClass('actividad_seleccionada');
	});

	$(this).addClass('actividad_seleccionada');
	var codmenu = $(this).data('id_cod');

	getsubmenus(codmenu);

});


$(document).on('click', '#gritter-regular2', function(e){

	$.gritter.add({
		title: 'This is a regular notice!',
		text: 'This will fade out after a certain amount of time. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" class="blue">magnis dis parturient</a> montes, nascetur ridiculus mus.',
		image: $assets+'/avatars/avatar1.png',
		sticky: false,
		time: '',
		class_name: (!$('#gritter-light').get(0).checked ? 'gritter-light' : '')
	});

	return false;

});

$(document).on('click', '#newmenu', function(e){

	$('#formulario-registro').modal('show');
 	

});


$(document).on('click', '#agregar', function(e){
	var nombrem = $('#nombrem').val();
	var link = $('#link').val();
	var sicono = $('#sicono').val();
	$('#formulario-registro').modal('hide');
	//notificacion(nombrem + link);
	setmenus(nombrem, link, sicono);

});


$('#sicono').on('change', function(e){
	var codicono = $('#sicono').val();

 	var selecti = $('#sicono').val();

		if ( selecti == -1 ) {
		$('#agregar').attr('disabled', 'disabled');
		} else{
		$('#agregar').removeAttr('disabled');
			vpiconos(codicono);	
		};



});

