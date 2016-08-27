var ajaxcondicion = function(idestadoe){

	var options = {
		type: 'POST',
		url:'index.php?page=condicion&accion=ajaxcondicion',
		data: {
			'idestadoe' : idestadoe
		},
		dataType: 'html',
		success: function(response){
			// $('#divcamas').removeAttr('disabled');
			$('#scondicion').html(response);
			// $('#divcamas').fadeIn("fast");
			// $('#divinfocamas').fadeOut("fast");
		}
	};
	$.ajax(options);
};

var ajaxservicios = function(idcondicion){

	var options = {
		type: 'POST',
		url:'index.php?page=condicion&accion=ajaxtransferido',
		data: {
			'idcondicion' : idcondicion
		},
		dataType: 'html',
		success: function(response){
			// $('#divcamas').removeAttr('disabled');
			$('#s_servtransf').html(response);
			$('#divservtransf').show();
			// $('#divcamas').fadeIn("fast");
			// $('#divinfocamas').fadeOut("fast");
		}
	};
	$.ajax(options);
};

var ajaxespecialidad = function(idservtransf){

	var options = {
		type: 'POST',
		url:'index.php?page=condicion&accion=ajaxespecialidad',
		data: {
			'idservtransf' : idservtransf
		},
		dataType: 'html',
		success: function(response){
			// $('#divcamas').removeAttr('disabled');
			$('#s_esptransf').html(response);
			$('#divesptransf').show();
			// $('#divcamas').fadeIn("fast");
			// $('#divinfocamas').fadeOut("fast");
		}
	};
	$.ajax(options);
};

$(document).on('change', '#sestadoupt', function() {
	var idestadoe = $(this).val();

	ajaxcondicion(idestadoe);
	
});

$(document).on('change', '#s_servtransf', function() {
	var idservtransf = $(this).val();

	ajaxespecialidad(idservtransf);
	
});

$(document).on('change', '#scondicion', function() {
	var idcondicion = $(this).val();


	switch(idcondicion){
	case '-1':
	$('#divservtransf').hide();
	$('#divref').hide();
	$('#divesptransf').show();	

	break;

	case '1':
	$('#divservtransf').hide();
	$('#divref').hide();
	$('#divesptransf').hide();	
	break;	

	case '2':
	$('#divservtransf').hide();
	$('#divref').hide();
	$('#divesptransf').hide();	
	ajaxservicios(idcondicion);	
	break;	

	case '3':
	$('#divservtransf').hide();
	$('#divref').hide();
	$('#divesptransf').hide();	
	break;		

	case '4':
	$('#divservtransf').hide();
	$('#divref').show();
	$('#divesptransf').hide();	
	break;	

	case '5':
	$('#divservtransf').hide();
	$('#divref').show();
	$('#divesptransf').hide();	
	break;


	case '6':
	$('#divservtransf').hide();
	$('#divref').hide();
	$('#divesptransf').hide();	
	break;

	}	


	
});