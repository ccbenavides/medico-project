$(document).on('ready', function(){

//changedepartamentos();
	// Trae las dependencias que pertenecen a un determinado departamento
	var getDependencias = function(departamento){

		var options = {
			type: 'POST',
			url:'index.php?page=paciente&accion=ajaxGetServicios',
			data: {
				'departamento': departamento,
			},
			dataType: 'html',
			success: function(response){

				$('#servicio').removeAttr('disabled');
				$('#servicio').html(response);
				
			}
		};
		$.ajax(options);

	};


function changedepartamentos() {
	
	alert('alerta');
}



	$('#departamentos2').on('change', function(e){
		// e.preventDefault();

		 alert('holas');
		var departamento = $(this).val();

		// if(departamento != -1){
		// 	// getDependencias(departamento);
		// 	$('#dependencia').attr('disabled', 'disabled');
		// 	$('#dependencia').val('-1');

		// }else{
		// 	getDependencias(departamento);
		// 	// $('#dependencia').attr('disabled', 'disabled');
		// 	// $('#dependencia').val('-1');
		// }
	});


$(document).on('change', '#departamentos', function(){
//alert('alertaaaaaaa');	
		var departamento = $(this).val();

		if(departamento != -1){
			getDependencias(departamento);
			

		}else{
			
			$('#servicio').attr('disabled', 'disabled');
			$('#servicio').val('-1');
			 }
});

});


