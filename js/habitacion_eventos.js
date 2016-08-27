$(document).on('click', '.cie', function(event) {
	event.preventDefault();
	/* Act on the event */
	var tipobtn = $(this).data('type');
	var idbtn = $(this).data('ncie');

	if (tipobtn == 'add') {
		//var 
		//$('#divcie'+idbtn+1+'').removeAttr("style");
		var cie= idbtn+1;

		$('#divcie'+cie+'').show();
		$('#add'+idbtn+'').hide();


	} else if (tipobtn == 'remove') {
		var ciemas= idbtn-1;
		$('#codcie'+idbtn+'').val('');
		$('#desccie'+idbtn+'').val('');
		$('#divcie'+idbtn+'').hide();
		$('#add'+ciemas+'').show();
	};
	//alert(tipobtn);
});

$(document).on('click', '.ciesal', function(event) {
	event.preventDefault();
	/* Act on the event */
	var tipobtn = $(this).data('typesal');
	var idbtn = $(this).data('nciesal');

	if (tipobtn == 'addsal') {
		//var 
		//$('#divcie'+idbtn+1+'').removeAttr("style");
		var cie= idbtn+1;

		$('#divciesal'+cie+'').show();
		$('#addsal'+idbtn+'').hide();


	} else if (tipobtn == 'removesal') {
		var ciemas= idbtn-1;
		$('#codciesal'+idbtn+'').val('');
		$('#descciesal'+idbtn+'').val('');
		$('#divciesal'+idbtn+'').hide();
		$('#addsal'+ciemas+'').show();
	};
	//alert(tipobtn);
});

$(document).on('change', '#sestadoi', function(){

	var selectesti = $('#sestadoi').val();

	switch(selectesti){
		case '-1':
		$('#divcie1').hide();
		$('#divobsi').hide();
		$('#lablec').css("display", "none");
		break;		

		case '2':
		$('#divcie1').hide();
		$('#divobsi').hide();
		$('#lablec').css("display", "none");
		break;

		case '3':
		$('#divcie1').show();
		$('#divobsi').show();
		$('#lablec').css("display", "block");
		break;		
	}
});

$(document).on('change', '#sestadoupt', function(){

	var selectesti = $('#sestadoupt').val();
	var estadoc = $('#estc').val();

	switch(selectesti){
		case '-1':
		// $('#divciesal1').hide();
		// $('#divobsupt').hide();
		break;		

		case '1':
		if (estadoc == 2) {		
		$('#divciesal1').hide();
		$('#divciesal2').hide();
		$('#divciesal3').hide();
		$('#divobsupt').hide();
		$('#divcondicion').hide();


		$('#codciesal1').val('');
		$('#descciesal1').val('');
		$('#codciesal2').val('');
		$('#descciesal2').val('');
		$('#codciesal3').val('');
		$('#descciesal3').val('');

		};

		break;

		case '3':
		if (estadoc == 2) {		
		$('#divciesal1').show();
		$('#addsal1').show();
		$('#divobsupt').show();
		};

		break;
		// case '3':
		// $('#divcie1').show();
		// $('#divobsi').show();
		// break;		
	}
});
