var cambiarstatus = function (idbiopsia, contra) {
    var options = {
        type: 'POST',
        url: "index.php?page=biopsiaPQ&accion=cambiarstatus",
        data: {
        	'idbiopsia' : idbiopsia,
        	'contra' : contra
        },
        dataType: 'json',
        success: function(response){
        	switch (response.update) {
				case true:
					bootbox.alert(response.msj, function () {
						location.reload();
					});

					break;
				case false:
					bootbox.alert(response.msj);
					break;
			}

            // console.log(response);
        }
    };
    $.ajax(options);
};



$(document).on('click', '.cambiarstatus', function(event) {
	event.preventDefault();
	/* Act on the event */
	var idbiopsia = $(this).data('id');
	// console.log(idbiopsia);


	bootbox.dialog({
	  message: 'Como medida de seguridad debe ingresar su contraseña<br/><br> '+
	  '<input id="contra" name="contra" type="password" placeholder="Contraseña" class="form-control ">',

	  title: "<i class='fa fa-warning'></i> <b>Advertencia<b>",
	  buttons: {
	    danger: {
	      label: "Cancelar",
	      className: "btn-danger",
	      callback: function() {
	        // Example.show("uh oh, look out!");
	      }
	    },
	    main: {
	      label: "Enviar",
	      className: "btn-primary",
	      callback: function() {
	        var contra = $('#contra').val();
	        cambiarstatus(idbiopsia, contra);
	      }
	    }
	  }
	});

});