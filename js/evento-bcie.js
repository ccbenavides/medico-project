
$(document).on('change', '#skip-validation', function(event) {
	event.preventDefault();
	/* Act on the event */
	var xdesc = this.checked;

	//alert(xdesc);

	if (xdesc == true) {
		//alert('buscar por cie');
		$('#codcie1').attr('disabled', 'disabled');
		$('#desccie1').removeAttr('disabled');
		$('#codcie2').attr('disabled', 'disabled');
		$('#desccie2').removeAttr('disabled');
		$('#codcie3').attr('disabled', 'disabled');
		$('#desccie3').removeAttr('disabled');



		$('#codcie1').val('');
		$('#desccie1').val('');
		$('#idcie1').val('');
		$('#codcie2').val('');
		$('#desccie2').val('');
		$('#idcie2').val('');
		$('#codcie3').val('');
		$('#desccie3').val('');
		$('#idcie3').val('');

	} else{
		//alert('buscar por descripcion');
		$('#codcie1').removeAttr('disabled');
		$('#desccie1').attr('disabled', 'disabled');
		$('#codcie2').removeAttr('disabled');
		$('#desccie2').attr('disabled', 'disabled');		
		$('#codcie3').removeAttr('disabled');
		$('#desccie3').attr('disabled', 'disabled');

		$('#codcie1').val('');
		$('#desccie1').val('');
		$('#idcie1').val('');
		$('#codcie2').val('');
		$('#desccie2').val('');
		$('#idcie2').val('');
		$('#codcie3').val('');
		$('#desccie3').val('');
		$('#idcie3').val('');			
	};


});




$(document).on('change', '#bcieupt', function(event) {
	event.preventDefault();
	/* Act on the event */
	var xdescupt = this.checked;

	//alert(xdescupt);

	if (xdescupt == true) {
		//alert('buscar por cie');
		$('#codciesal1').attr('disabled', 'disabled');
		$('#descciesal1').removeAttr('disabled');
		$('#codciesal2').attr('disabled', 'disabled');
		$('#descciesal2').removeAttr('disabled');
		$('#codciesal3').attr('disabled', 'disabled');
		$('#descciesal3').removeAttr('disabled');



		$('#codciesal1').val('');
		$('#descciesal1').val('');
		$('#idciesal1').val('');
		$('#codciesal2').val('');
		$('#descciesal2').val('');
		$('#idciesal2').val('');
		$('#codciesal3').val('');
		$('#descciesal3').val('');
		$('#idciesal3').val('');

	} else{
		//alert('buscar por descripcion');
		$('#codciesal1').removeAttr('disabled');
		$('#descciesal1').attr('disabled', 'disabled');
		$('#codciesal2').removeAttr('disabled');
		$('#descciesal2').attr('disabled', 'disabled');		
		$('#codciesal3').removeAttr('disabled');
		$('#descciesal3').attr('disabled', 'disabled');

		$('#codciesal1').val('');
		$('#descciesal1').val('');
		$('#idciesal1').val('');
		$('#codciesal2').val('');
		$('#descciesal2').val('');
		$('#idciesal2').val('');
		$('#codciesal3').val('');
		$('#descciesal3').val('');
		$('#idciesal3').val('');			
	};


});


