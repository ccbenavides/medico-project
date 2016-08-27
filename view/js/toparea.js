$(document).on('ready',function(){

	// var getTopo = function(area){
	// 	var options = {
	// 		type: 'POST',
	// 		url:'index.php?page=biopsia&accion=ajaxGetTopo',
	// 		data: {
	// 			'area': area,
	// 		},
	// 		dataType: 'html',
	// 		success: function(response){

	// 			$('#topografia').removeAttr('disabled');
	// 			$('#topografia').html(response);
				
	// 		}
	// 	};
	// 	$.ajax(options);
	// };

	// $('#area').on('change', function(e){
	// 	e.preventDefault();

	// 	var area = $(this).val();

	// 	if(area != -1){
	// 		getTopo(area);			
	// 	}else{
	// 		$('#topografia').attr('disabled', 'disabled');
	// 		$('#topografia').val('-1');
	// 	}
	// });

	var getMed = function(servicio){
		var options = {
			type: 'POST',
			url:'index.php?page=biopsia&accion=ajaxGetMedico',
			data: {
				'servicio': servicio,
			},
			dataType: 'html',
			success: function(response){

				$('#medicot').removeAttr('disabled');
				$('#medicot').html(response);
				
			}
		};
		$.ajax(options);
	};

	$('#servicio').on('change', function(e){
		e.preventDefault();

		var servicio = $(this).val();

		if(servicio != -1){
			getMed(servicio);			
		}else{
			$('#medicot').attr('disabled', 'disabled');
			$('#medicot').val('-1');
		}
	});
});

function cargartopo(){
	var area = $('select[name=area]').val();
    var url="index.php?page=biopsia&accion=cargartopog"
    $.ajax({   
        type: "POST",
        url:url,
        data:{
            area:area
        },
        success: function(datos){       
            $('#topografia').html(datos);
            $('#topografia').trigger("chosen:updated");
           
        }
    });
}

function cargarmuexarea(){
	var area = $('select[name=area]').val();
    var url="index.php?page=biopsia&accion=cargarmue"
    $.ajax({   
        type: "POST",
        url:url,
        data:{
            area:area
        },
        success: function(datos){       
            $('#desmues1').html(datos);
            $('#desmues1').trigger("chosen:updated");
            $('#desmues2').html(datos);
            $('#desmues2').trigger("chosen:updated");
            $('#desmues3').html(datos);
            $('#desmues3').trigger("chosen:updated");
            $('#desmues4').html(datos);
            $('#desmues4').trigger("chosen:updated");
            $('#desmues5').html(datos);
            $('#desmues5').trigger("chosen:updated");
            $('#desmues6').html(datos);
            $('#desmues6').trigger("chosen:updated");
            $('#desmues7').html(datos);
            $('#desmues7').trigger("chosen:updated");
            $('#desmues8').html(datos);
            $('#desmues8').trigger("chosen:updated");
            $('#desmues9').html(datos);
            $('#desmues9').trigger("chosen:updated");
            $('#desmues10').html(datos);
            $('#desmues10').trigger("chosen:updated");
            $('#desmues11').html(datos);
            $('#desmues11').trigger("chosen:updated");
            $('#desmues12').html(datos);
            $('#desmues12').trigger("chosen:updated");
            $('#desmues13').html(datos);
            $('#desmues13').trigger("chosen:updated");
            $('#desmues14').html(datos);
            $('#desmues14').trigger("chosen:updated");
            $('#desmues15').html(datos);
            $('#desmues15').trigger("chosen:updated");
            $('#desmues16').html(datos);
            $('#desmues16').trigger("chosen:updated");
            $('#desmues17').html(datos);
            $('#desmues17').trigger("chosen:updated");
            $('#desmues18').html(datos);
            $('#desmues18').trigger("chosen:updated");
            $('#desmues19').html(datos);
            $('#desmues19').trigger("chosen:updated");
            $('#desmues20').html(datos);
            $('#desmues20').trigger("chosen:updated");
        }
    });
}

var getpacientes = function(paciente){

	  var options = {
	    type: 'POST',
	    url:'index.php?page=paciente&accion=ajaxgetpaciente',
	    data: {
	      'paciente' : paciente
	    },
	    dataType: 'json',
	    success: function(response){
	      console.log(response);
	      //auto(response);
	    }
	  };
	  $.ajax(options);

	};

$(document).on('keyup', '#dni', function() {

var paciente = $(this).val();

  getpacientes(paciente);
  //auto();
  if ( paciente == '') {
    $('#idpaciente').val('');
    $('#nompaciente').val('');
  };
  
});

$(document).on('click', '.muestra', function(event) {
	event.preventDefault();
	/* Act on the event */
	var tipobtn = $(this).data('type');
	var idbtn = $(this).data('nmuestra');

	if (tipobtn == 'add') {
		//var 
		//$('#divcie'+idbtn+1+'').removeAttr("style");
		var muestra= idbtn+1;

		$('#divmuestra'+muestra+'').show();
		$('#add'+idbtn+'').hide();


	} else if (tipobtn == 'remove') {
		var muestramas= idbtn-1;
		$('#desmues'+idbtn+'').val('');
		$('#divmuestra'+idbtn+'').hide();
		$('#add'+muestramas+'').show();
	};
	//alert(tipobtn);


});
//modal diagnostico biopsia CCV
var modal_diagnostico=$('#modal-agregar-diagnostico');
var ajax_diagnosticoccv=$('#ajax_diagnosticoccv');

	$('body').on('click', '#btnAgregarDiag', function(e) {
		e.preventDefault();
		
		modal_diagnostico.modal('show');
	});

	$('body').on('click', '#btnInsertarDiagnostico', function(e) {
			e.preventDefault();

		var id_biopsia= $('#id_biopsia').val();
		var id_diagccv=$('#id_diagccv').val();
		var id_codigo=$('#id_codigo').val();
		var otro_codbet=$('#otro_codbet').val();

		var options={
			type:'POST',
			url:'index.php?page=biopsiaCCV&accion=ajaxAgregarDiag',
			data: {
				'id_biopsia': id_biopsia,
				'id_codigo': id_codigo,
				'otro_codbet':otro_codbet,
				'id_diagccv':id_diagccv
			},
			dataType:'html',
			success:function(response){
				modal_diagnostico.modal('hide');
				//getDiagnostico(bio_id);
			}
		};
		$.ajax(options);	
	});

	modal_diagnostico.on('hidden.bs.modal', function(){

		var id_biopsia = $('#id_biopsia').val();	
		getDiagnostico(id_biopsia);
	});

	var getDiagnostico=function(id_biopsia){
		var options = {
			type: 'POST',
			url:'index.php?page=biopsiaCCV&accion=ajaxGetDiag',
			data: {
				'id_biopsia': id_biopsia
			},
			dataType: 'html',
			success: function(response){

					ajax_diagnosticoccv.html('');
					ajax_diagnosticoccv.html(response);
					ajax_diagnosticoccv.fadeIn('slow');				
					
			}
		};

		$.ajax(options);
	};
	var id_biopsia = $('#id_biopsia').val();
	getDiagnostico(id_biopsia);


//modal descripcion biopsia CCV
var modal_descripcion=$('#modal-agregar-descripcion');
var ajax_descripcion=$('#ajax_descripcion');
$('body').on('click', '#btnAgregarDesc', function(e) {
	e.preventDefault();
	var id_diagccv=$('#id_diagccv').val();
	var id_codigo=$('#id_codigo').val();
	if (id_diagccv!=0 && id_codigo!=0) {
		modal_descripcion.modal('show');
	} else{
		bootbox.alert("Aun no se ha registrado el diagnostico, por lo tanto no puede registrar la descripcion", function(){});
	};
	
});
$('body').on('click', '#btnInsertarDescripcion', function(e) {
	e.preventDefault();
	var id_biopsia= $('#id_biopsia').val();
	var descripcion=$('#descripcion').val();
	var tecnologo=$('#tecnologo').val();
	var fecha_informe=$('#fecha_informe').val();
	var options={
			type:'POST',
			url:'index.php?page=biopsiaCCV&accion=ajaxAgregarDes',
			data: {
				'id_biopsia': id_biopsia,
				'tecnologo': tecnologo,
				'descripcion':descripcion,
				'fecha_informe':fecha_informe				
			},
			dataType:'html',
			success:function(response){
				modal_descripcion.modal('hide');
				getDescripcion(id_biopsia);
				// if (id_biopsia>0) {
				// 	window.location="index.php?page=biopsiaCCV&accion=finalizada";
				// };
			}
		};
		$.ajax(options);
});
modal_descripcion.on('hidden.bs.modal', function(){

		var id_biopsia = $('#id_biopsia').val();	
		getDescripcion(id_biopsia);
	});

var getDescripcion=function(id_biopsia){
		var options = {
			type: 'POST',
			url:'index.php?page=biopsiaCCV&accion=ajaxGetDes',
			data: {
				'id_biopsia': id_biopsia
			},
			dataType: 'html',
			success: function(response){

					ajax_descripcion.html('');
					ajax_descripcion.html(response);
					ajax_descripcion.fadeIn('slow');				
					
			}
		};

		$.ajax(options);
	};
var id_biopsia = $('#id_biopsia').val();
getDescripcion(id_biopsia);

var modal_estado=$('#modal-estado-biopsia');
$('body').on('click','#Finalizarccv',function(e){
	e.preventDefault();
	var id_diagccv=$('#id_diagccv').val();
	var id_codigo=$('#id_codigo').val();
	var descripcion=$('#descripcion').val();
	var tecnologo=$('#tecnologo').val();
	if (id_diagccv!=0 && id_codigo!=0 && tecnologo!=0 && descripcion!='') {
		modal_estado.modal('show');
	} else{
		bootbox.alert("Falta registrar datos para finalizar el registro", function(){});
	};
	
});
$('body').on('click','#btnFinalizarccv',function(e){
	e.preventDefault();
	var id_biopsia=$('#id_biopsia').val();
	var options={
			type:'POST',
			url:'index.php?page=biopsiaCCV&accion=ajaxfinalizaccv',
			data: {
				'id_biopsia':id_biopsia							
			},
			dataType:'html',
			success:function(response){
				modal_estado.modal('hide');
				if (id_biopsia>0) {
					window.location="index.php?page=biopsiaCCV&accion=finalizada";
				};

				
			}
		};
		$.ajax(options);
});



