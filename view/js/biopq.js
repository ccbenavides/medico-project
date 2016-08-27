//-----------modal agregar materiales-----//
var modal_material=$('#modal-agregar-material');
var ajax_material=$('#ajax_laminastacos');

$('body').on('click', '#btnAgregarMaterial', function(e) {
	e.preventDefault();
		modal_material.modal('show');	
	
});

$('body').on('click', '#btnInsertarMaterial', function(e) {
	e.preventDefault();

	var id_biopsia=$('#id_biopsia').val();
	var num_laminas=$('#num_laminas').val();
	var num_tacos=$('#num_tacos').val();
	var fecha_entmat=$('#fecha_entmat').val();
	
	var options={
			type:'POST',
			url:'index.php?page=biopsiaPQ&accion=ajaxAgregarMaterial',
			data: {
				'id_biopsia':id_biopsia,
				'num_laminas':num_laminas,
				'num_tacos':num_tacos,
				'fecha_entmat':fecha_entmat				
			},
			dataType:'html',
			success:function(response){
				modal_material.modal('hide');
				//getMaterial(id_biopsia);
			}
		};
		$.ajax(options);
});

modal_material.on('hidden.bs.modal', function(){
		var id_biopsia = $('#id_biopsia').val();	
		getMaterial(id_biopsia);
});

var getMaterial=function(id_biopsia){
		var options = {
			type: 'POST',
			url:'index.php?page=biopsiaPQ&accion=ajaxGetMat',
			data: {
				'id_biopsia': id_biopsia
			},
			dataType: 'html',
			success: function(response){

					ajax_material.html('');
					ajax_material.html(response);
					ajax_material.fadeIn('slow');				
					
			}
		};

		$.ajax(options);
};
var id_biopsia = $('#id_biopsia').val();
getMaterial(id_biopsia);

//----modal agregar macroscopia------//
var modal_macro=$('#modal-agregar-macroscopia');
var ajax_macro=$('#ajax_macroscopia');

$('body').on('click', '#btnAgregarMacro', function(e) {
            e.preventDefault();
              modal_macro.modal('show');  
});

$('body').on('click', '#btnInsertarMacro', function(e) {
	e.preventDefault();

	var id_biopsia=$('#id_biopsia').val();
	var macroscopia=$('#macroscopia').val();
		
	var options={
			type:'POST',
			url:'index.php?page=biopsiaPQ&accion=ajaxAgregarMacro',
			data: {
				'id_biopsia':id_biopsia,
				'macroscopia':macroscopia							
			},
			dataType:'html',
			success:function(response){
				modal_macro.modal('hide');

				//getMaterial(id_biopsia);
			}
		};
		$.ajax(options);

});

modal_macro.on('hidden.bs.modal', function(){
		var id_biopsia = $('#id_biopsia').val();	
		obtenermacro(id_biopsia);
		$('#btnAgregarDiag').removeAttr('disabled');
});

var obtenermacro=function(id_biopsia){
		var options = {
			type: 'POST',
			url:'index.php?page=biopsiaPQ&accion=ajaxGetMacro',
			data: {
				'id_biopsia': id_biopsia
			},
			dataType: 'html',
			success: function(response){
					ajax_macro.html('');
					ajax_macro.html(response);
					ajax_macro.fadeIn('slow');				
					
			}
		};

		$.ajax(options);
};
var id_biopsia = $('#id_biopsia').val();
obtenermacro(id_biopsia);

//--modal para actualizar estado de biopsia luego de la macro , solo en el tecnico de macroscopia-->
var modal_actualiza=$('#modal-estado-macro');
$('body').on('click','#GuardarEstado',function(e){
	e.preventDefault();
	var num_laminas=$('#num_laminas').val();
	var num_tacos=$('#num_tacos').val();
	var macroscopia=$('#macroscopia').val();
	if (macroscopia!='' && num_laminas!=0 && num_tacos!=0) {
		modal_actualiza.modal('show');
	} else{
		bootbox.alert("Aun no se ha registrado la macroscopia y materiales, por lo tanto no puede guardar la informacion", function(){});
	};

});
$('body').on('click','#btnActualizar',function(e){
	e.preventDefault();
	var id_biopsia=$('#id_biopsia').val();
	var options={
			type:'POST',
			url:'index.php?page=biopsiaPQ&accion=ajaxActualizaMacro',
			data: {
				'id_biopsia':id_biopsia							
			},
			dataType:'html',
			success:function(response){
				modal_actualiza.modal('hide');
				if (id_biopsia>0) {
					window.location="index.php?page=biopsiaPQ&accion=listar";
				};

				
			}
		};
		$.ajax(options);
});
//----modal agregar diagnostico----//

var modal_diagpq=$('#modal-agregar-diag');
var ajax_diagpq=$('#ajax_diagnostico');

$('body').on('click', '#btnAgregarDiag', function(e) {
	e.preventDefault();
	  var macroscopia=$('#macroscopia').val();
	  if (macroscopia!='') {
	  	modal_diagpq.modal('show');
	  } else{
	  	bootbox.alert("Aun no se ha registrado la macroscopia, por lo tanto no puede registrar el diagnostico", function(){});	
	  };
		
	
	
});
$('body').on('click', '#btnInsertarDiag', function(e) {
	e.preventDefault();

	var id_biopsia=$('#id_biopsia').val();
	var id_muestrabio=$('#id_muestrabio').val();
	var diag_final=$('#diag_final').val();
	
	if (id_muestrabio!=-1) {
		var options={
			type:'POST',
			url:'index.php?page=biopsiaPQ&accion=ajaxAgregarDiag',
			data: {
				'id_biopsia':id_biopsia,
				'id_muestrabio':id_muestrabio,
				'diag_final':diag_final							
			},
			dataType:'html',
			success:function(response){
				modal_diagpq.modal('hide');
				//getMaterial(id_biopsia);

			}
		};
		$.ajax(options);
	}else{
		bootbox.alert("Para poder agregar un diagnostico debe seleccionar una muestra ", function(){});
	}
	
});

modal_diagpq.on('hidden.bs.modal', function(){
		var id_biopsia = $('#id_biopsia').val();	
		obtenerdiagpq(id_biopsia);
});

var obtenerdiagpq=function(id_biopsia){
		var options = {
			type: 'POST',
			url:'index.php?page=biopsiaPQ&accion=ajaxGetDiag',
			data: {
				'id_biopsia': id_biopsia
			},
			dataType: 'html',
			success: function(response){

					ajax_diagpq.html('');
					ajax_diagpq.html(response);
					ajax_diagpq.fadeIn('slow');				
					
			}
		};

		$.ajax(options);
};
var id_biopsia = $('#id_biopsia').val();
obtenerdiagpq(id_biopsia);
//--modal derivar IH--//
var modal_ih=$('#modal-derivar-ih');

$('body').on('click', '#btnderivaIH', function(e) {
	e.preventDefault();
	var requerido=$('#requiereih').val();
	var macroscopia=$('#macroscopia').val();
	if (requerido!='Si'&& macroscopia!='') {
		modal_ih.modal('show');
	} else{
		bootbox.alert("Usted no puede registrar el control de marcadores", function(){});
		
	};

});
//---modal agregar resultado-------//
var modal_verpq=$('#modal-agregar-ver');
var ajax_resultado=$('#ajax_resultado');

$('body').on('click', '#btnAgregarResultado', function(e) {
	e.preventDefault();
	var id_biopsia=$('#id_biopsia').val();

	//var numerodiag=$('#numerodiag').val();
	 modal_verpq.modal('show');
	
	
});


$('body').on('click', '#btnInsertarVer', function(e) {
	e.preventDefault();

	var id_biopsia=$('#id_biopsia').val();
	var id_res=$('#id_res').val();
	var id_ubicacion=$('#id_ubicacion').val();
	var valida_patologo=$('#valida_patologo').val();
	var fecha_informe=$('#fecha_informe').val();	
	
	if (id_res!=-1 && id_ubicacion!=-1 && valida_patologo!=-1) {
		var options={
			type:'POST',
			url:'index.php?page=biopsiaPQ&accion=ajaxAgregarRes',
			data: {
				'id_biopsia':id_biopsia,
				'id_res':id_res,
				'id_ubicacion':id_ubicacion,
				'valida_patologo':valida_patologo,
				'fecha_informe':fecha_informe						
			},
			dataType:'html',
			success:function(response){
				modal_verpq.modal('hide');
				resultadopq(id_biopsia);
				// if (valida_patologo>0) {
				// 	window.location="index.php?page=biopsiaPQ&accion=finalizado";
				// };
			}
		};
		$.ajax(options);
	}else{
		bootbox.alert("Debe seleccionar un resultado o la ubicacion", function(){});
	}
	
});

modal_verpq.on('hidden.bs.modal', function(){
		var id_biopsia = $('#id_biopsia').val();	
		resultadopq(id_biopsia);
});

var resultadopq=function(id_biopsia){
		var options = {
			type: 'POST',
			url:'index.php?page=biopsiaPQ&accion=ajaxGetRes',
			data: {
				'id_biopsia': id_biopsia
			},
			dataType: 'html',
			success: function(response){

					ajax_resultado.html('');
					ajax_resultado.html(response);
					ajax_resultado.fadeIn('slow');				
					
			}
		};

		$.ajax(options);
};
var id_biopsia = $('#id_biopsia').val();
resultadopq(id_biopsia);

//-actualizar estado finalizado---//
var modal_estado=$('#modal-estado-biopsia');
$('body').on('click','#Finalizar',function(e){
	e.preventDefault();
	var id_res=$('#id_res').val();
	var id_ubicacion=$('#id_ubicacion').val();
	var macroscopia=$('#macroscopia').val();
	if (id_res!=-1 && id_ubicacion!=-1 && macroscopia!='') {
		modal_estado.modal('show');
	} else{
		bootbox.alert("Falta registrar datos para finalizar el registro", function(){});
	};
	
});
$('body').on('click','#btnFinalizar',function(e){
	e.preventDefault();
	var id_biopsia=$('#id_biopsia').val();
	var options={
			type:'POST',
			url:'index.php?page=biopsiaPQ&accion=ajaxfinaliza',
			data: {
				'id_biopsia':id_biopsia							
			},
			dataType:'html',
			success:function(response){
				modal_estado.modal('hide');
				if (id_biopsia>0) {
					window.location="index.php?page=biopsiaPQ&accion=finalizado";
				};

				
			}
		};
		$.ajax(options);
});
var modal_marc=$('#modal-agregar-resih');
var ajax_marc=$('#ajax_marcadores');
$('body').on('click','#btnAgregarMarc',function(e){
	e.preventDefault();
	modal_marc.modal('show');
});
$('body').on('click', '#btnInsertaResult', function(e) {
	e.preventDefault();
  		var id_biopsia=$('#id_biopsia').val();
  		var id_marc_prueba=$('#id_marc_prueba').val();
  		var resultado=$('#resultado').val();
  		
  		var options={
			type:'POST',
			url:'index.php?page=biopsiaPQ&accion=ajaxAgregarIH',
			data: {
				'id_biopsia':id_biopsia,
				'id_marc_prueba':id_marc_prueba,
				'resultado':resultado				
			},
			dataType:'html',
			success:function(response){
				modal_marc.modal('hide');
				
			}
		};
		$.ajax(options);
});
modal_marc.on('hidden.bs.modal', function(){
		var id_biopsia = $('#id_biopsia').val();	
		getResIH(id_biopsia);
});
var getResIH=function(id_biopsia){
		var options = {
			type: 'POST',
			url:'index.php?page=biopsiaPQ&accion=ajaxGetMarc',
			data: {
				'id_biopsia': id_biopsia
			},
			dataType: 'html',
			success: function(response){

					ajax_marc.html('');
					ajax_marc.html(response);
					ajax_marc.fadeIn('slow');				
					
			}
		};

		$.ajax(options);
};
var id_biopsia = $('#id_biopsia').val();
getResIH(id_biopsia);

// $('.modal').on('hidden.bs.modal', function(){ 
// 		$(this).find('form')[0].reset(); //para borrar todos los datos que tenga los input, textareas, select.
// 		//$("label.error").remove();  //lo utilice para borrar la etiqueta de error del jquery validate
// });

$(document).on('click','#eliminarmarcad', function(e) {	
	e.preventDefault();
	var idbiopsia=$('#idbiopsia').val();
	var idmarca=$(this).parent().attr('data');
	bootbox.confirm("¿Esta seguro de querer eliminar el registro?", function(res) {    
		if (res) {
			eliminarmarca(idbiopsia, idmarca);       
		}    
	});
});

var eliminarmarca=function(idbiopsia, idmarca){
		var options = {
			type: 'POST',
			url:'index.php?page=biopsiaPQ&accion=eliminarMarc',
			data: {
				'idbiopsia': idbiopsia,
				'idmarca': idmarca
			},
			dataType: 'html',
			success: function(response){

					ajax_marc.html('');
					ajax_marc.html(response);
					ajax_marc.fadeIn('slow');				
					
			}
		};

		$.ajax(options);
};