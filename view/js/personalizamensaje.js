$(document).on('ready',function() {
	$('input:text[name=nombretop]').tooltip({
		placement:"right",
		trigger:"focus"
	});
	$('select[name=area').tooltip({
		placement:"right",
		trigger:"hover"
	});
	$('input:text[name=dni]').tooltip({
		placement:"right",
		trigger:"focus"
	});
})