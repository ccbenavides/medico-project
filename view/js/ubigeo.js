$(document).on('ready',function(){
	//obtiene provincias de un determinado departamento
	var getProvincias = function(departamento){
		var options = {
			type: 'POST',
			url:'index.php?page=paciente&accion=ajaxGetProvincia',
			data: {
				'departamento': departamento,
			},
			dataType: 'html',
			success: function(response){

				$('#provincia').removeAttr('disabled');
				$('#provincia').html(response);
				
			}
		};
		$.ajax(options);
	};

	//seleccionar un departamento y devuelve sus provincias
	$('#departamento').on('change', function(e){
		e.preventDefault();

		var departamento = $(this).val();

		if(departamento != -1){
			getProvincias(departamento);			
		}else{
			$('#provincia').attr('disabled', 'disabled');
			$('#provincia').val('-1');
		}
	});
	//obtiene los distritos de una provincia
	var getDistritos = function(provincia){
		var options = {
			type: 'POST',
			url:'index.php?page=paciente&accion=ajaxGetDistrito',
			data: {
				'provincia': provincia,
			},
			dataType: 'html',
			success: function(response){

				$('#distrito').removeAttr('disabled');
				$('#distrito').html(response);
				
			}
		};
		$.ajax(options);
	};
	//seleccionar una provincia y obtiene sus distritos
	$('#provincia').on('change',function(e){
		e.preventDefault();

		var provincia =$(this).val();
		if(provincia !=-1){
			getDistritos(provincia);
		}else{
			$('#distrito').attr('disabled','disabled');
			$('#distrito').val('-1');
		}
	});

	var getEstado =function(tipo){
		var options = {
			type: 'POST',
			url:'index.php?page=paciente&accion=ajaxGetEstado',
			data: {
				'tipo': tipo,
			},
			dataType: 'html',
			success: function(response){

				$('#sishrl').removeAttr('disabled');
				$('#sishrl').html(response);
				
			}
		};
		$.ajax(options);
	};

	$('#tipo').on('change',function(e){
		e.preventDefault();

		var tipo =$(this).val();
		if(tipo !=-1){
			getEstado(tipo);
		}else{
			$('#sishrl').attr('disabled','disabled');
			$('#sishrl').val('-1');
		}
	});

	

})