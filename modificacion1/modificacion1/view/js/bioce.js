//modal agregar materiales//
var modal_agreg=$('#modal-agregar-materialce');
var ajax_mat=$('#ajax_lamtaco');
$('body').on('click', '#btnAgregMat', function(e) {
	e.preventDefault();
	modal_agreg.modal('show');
});
$('body').on('click', '#btnInsertMat', function(e) {
	e.preventDefault();
	var id_biopsia=$('#id_biopsia').val();
	var num_laminas=$('#num_laminas').val();
	var num_tacos=$('#num_tacos').val();
	var fecha_entmat=$('#fecha_entmat').val();
	
	var options={
			type:'POST',
			url:'index.php?page=biopsiaCE&accion=ajaxAgregaMat',
			data: {
				'id_biopsia':id_biopsia,
				'num_laminas':num_laminas,
				'num_tacos':num_tacos,
				'fecha_entmat':fecha_entmat				
			},
			dataType:'html',
			success:function(response){
				modal_agreg.modal('hide');
				//getMaterial(id_biopsia);
			}
		};
		$.ajax(options);
});
modal_agreg.on('hidden.bs.modal', function(){
		var id_biopsia = $('#id_biopsia').val();	
		getMaterial(id_biopsia);
});

var getMaterial=function(id_biopsia){
		var options = {
			type: 'POST',
			url:'index.php?page=biopsiaCE&accion=ajaxGetMatce',
			data: {
				'id_biopsia': id_biopsia
			},
			dataType: 'html',
			success: function(response){

					ajax_mat.html('');
					ajax_mat.html(response);
					ajax_mat.fadeIn('slow');				
					
			}
		};

		$.ajax(options);
};
var id_biopsia = $('#id_biopsia').val();
getMaterial(id_biopsia);

//modal macroscopia//
var modal_macro=$('#modal-agregar-macroce');
var ajax_mac=$('#ajax_macro');
$('body').on('click', '#btnAgregMac', function(e) {
	e.preventDefault();
	modal_macro.modal('show');
});
$('body').on('click', '#btnInsertMacro', function(e) {
	e.preventDefault();
	var id_biopsia=$('#id_biopsia').val();
	var macroscopia=$('#macroscopia').val();

	var options={
			type:'POST',
			url:'index.php?page=biopsiaCE&accion=ajaxAgregMacro',
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
		getMacros(id_biopsia);
});

var getMacros=function(id_biopsia){
		var options = {
			type: 'POST',
			url:'index.php?page=biopsiaCE&accion=ajaxGetMacros',
			data: {
				'id_biopsia': id_biopsia
			},
			dataType: 'html',
			success: function(response){

					ajax_mac.html('');
					ajax_mac.html(response);
					ajax_mac.fadeIn('slow');				
					
			}
		};

		$.ajax(options);
};
var id_biopsia = $('#id_biopsia').val();
getMacros(id_biopsia);

//--modal para actualizar estado de biopsia luego de la macro , solo en el tecnico de macroscopia-->
var modal_actualiza=$('#modal-estado2');
$('body').on('click','#GuardarEstado2',function(e){
	e.preventDefault();
	var macroscopia=$('#macroscopia').val();
	var num_laminas=$('#num_laminas').val();
	var num_tacos=$('#num_tacos').val();

	if (macroscopia!='' && num_laminas!=0 && num_tacos!=0) {
		modal_actualiza.modal('show');
	} else{
		bootbox.alert("Aun no se ha registrado la macroscopia y materiales, por lo tanto no puede guardar la informacion", function(){});
	};

	
});
$('body').on('click','#btnActualizar2',function(e){
	e.preventDefault();
	var id_biopsia=$('#id_biopsia').val();
	var options={
			type:'POST',
			url:'index.php?page=biopsiaCE&accion=ajaxActualiza2',
			data: {
				'id_biopsia':id_biopsia							
			},
			dataType:'html',
			success:function(response){
				modal_actualiza.modal('hide');
				if (id_biopsia>0) {
					window.location="index.php?page=biopsiaCE&accion=listar";
				};

				
			}
		};
		$.ajax(options);
});

//modal diagnostico//
var modal_diagce=$('#modal-agregar-diag-ce');
var ajax_diagce=$('#ajax_diagdes');
$('body').on('click', '#btnAgregarDiagDes', function(e) {
	e.preventDefault();
	var macroscopia=$('#macroscopia').val();
	if (macroscopia!='') {
		modal_diagce.modal('show');
	} else{
		bootbox.alert("Aun no se ha registrado la macroscopia, por lo tanto no puede registrar el diagnostico", function(){});
	};
	
});
$('body').on('click', '#btnInsertarDiag', function(e) {
	e.preventDefault();
	var id_biopsia=$('#id_biopsia').val();
	var id_muestrabio=$('#id_muestrabio').val();
	var diag_final=$('#diag_final').val();
	//var descrip_muestce=$('#descrip_muestce').val();

	var options={
			type:'POST',
			url:'index.php?page=biopsiaCE&accion=ajaxAgregDiades',
			data: {
				'id_biopsia':id_biopsia,
				'id_muestrabio':id_muestrabio,
				'diag_final':diag_final
				//'descrip_muestce':descrip_muestce							
			},
			dataType:'html',
			success:function(response){
				modal_diagce.modal('hide');
				//getMaterial(id_biopsia);
			}
		};
		$.ajax(options);	
});
modal_diagce.on('hidden.bs.modal', function(){
		var id_biopsia = $('#id_biopsia').val();	
		getDiagDes(id_biopsia);
});

var getDiagDes=function(id_biopsia){
		var options = {
			type: 'POST',
			url:'index.php?page=biopsiaCE&accion=ajaxGetDiagdes',
			data: {
				'id_biopsia': id_biopsia
			},
			dataType: 'html',
			success: function(response){

					ajax_diagce.html('');
					ajax_diagce.html(response);
					ajax_diagce.fadeIn('slow');				
					
			}
		};

		$.ajax(options);
};
var id_biopsia = $('#id_biopsia').val();
getDiagDes(id_biopsia);
//modal derivar ih//
var modal_ih=$('#modal-derivacionih');
$('body').on('click', '#btnderivarIH', function(e) {
	e.preventDefault();
	var requerido=$('#requiereih').val();
	var macroscopia=$('#macroscopia').val();

	if (requerido!='Si' && macroscopia!='') {
		modal_ih.modal('show');
	} else{
		bootbox.alert("Usted no puede registrar el control de marcadores", function(){});
		
	};
});

var modal_marc=$('#modal-agregar-resmarc');
var ajax_marc=$('#ajax_marcadoresce');
$('body').on('click','#btnAgregarIH',function(e){
	e.preventDefault();
	modal_marc.modal('show');
});
$('body').on('click', '#btnInsertaResult', function(e) {
	e.preventDefault();
  		var id_biopsia=$('#id_biopsia').val();
  		var id_marc_prueba=$('#id_marc_prueba').val();
  		var resulih=$('#resulih').val();
  		
  		var options={
			type:'POST',
			url:'index.php?page=biopsiaCE&accion=ajaxAgregarIH',
			data: {
				'id_biopsia':id_biopsia,
				'id_marc_prueba':id_marc_prueba,
				'resulih':resulih			
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
			url:'index.php?page=biopsiaCE&accion=ajaxGetMarc',
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

//modal resultado//
var modal_result=$('#modal-agregar-resultce');
var ajax_rest=$('#ajax_resce');
$('body').on('click', '#btnAgreResult', function(e) {
	e.preventDefault();
	modal_result.modal('show');
});
$('body').on('click', '#btnInsertresult', function(e) {
	e.preventDefault();
	var id_biopsia=$('#id_biopsia').val();
	var resultado=$('#resultado').val();
	var valida_patologo=$('#valida_patologo').val();
	var fecha_informe=$('#fecha_informe').val();

	if (resultado!=-1) {
		var options={
			type:'POST',
			url:'index.php?page=biopsiaCE&accion=ajaxAgregResul',
			data: {
				'id_biopsia':id_biopsia,
				'resultado':resultado,
				'valida_patologo':valida_patologo,
				'fecha_informe':fecha_informe						
			},
			dataType:'html',
			success:function(response){
				modal_result.modal('hide');
				getResultado(id_biopsia);
				// if (valida_patologo>0) {
				// 	window.location="index.php?page=biopsiaCE&accion=finalizada";
				// };
			}
		};
		$.ajax(options);
	} else{
		bootbox.alert("Debe seleccionar un resultado", function(){});
	};
	
});
modal_result.on('hidden.bs.modal', function(){
		var id_biopsia = $('#id_biopsia').val();	
		getResultado(id_biopsia);
});

var getResultado=function(id_biopsia){
		var options = {
			type: 'POST',
			url:'index.php?page=biopsiaCE&accion=ajaxGetResult',
			data: {
				'id_biopsia': id_biopsia
			},
			dataType: 'html',
			success: function(response){

					ajax_rest.html('');
					ajax_rest.html(response);
					ajax_rest.fadeIn('slow');				
					
			}
		};

		$.ajax(options);
};
var id_biopsia = $('#id_biopsia').val();
getResultado(id_biopsia);

//-actualizar estado finalizado---//
var modal_estado=$('#modal-finaliza');
$('body').on('click','#FinalizarBio',function(e){
	e.preventDefault();
	var macroscopia=$('#macroscopia').val();
	var resultado=$('#resultado').val();
	if (macroscopia!='' && resultado!=-1) {
		modal_estado.modal('show');
	} else{
		bootbox.alert("Falta registrar datos para finalizar el registro", function(){});
	};
	
});
$('body').on('click','#btnFinalizaBio',function(e){
	e.preventDefault();
	var id_biopsia=$('#id_biopsia').val();
	var options={
			type:'POST',
			url:'index.php?page=biopsiaCE&accion=ajaxfinalizace',
			data: {
				'id_biopsia':id_biopsia							
			},
			dataType:'html',
			success:function(response){
				modal_estado.modal('hide');
				if (id_biopsia>0) {
					window.location="index.php?page=biopsiaCE&accion=finalizada";
				};

				
			}
		};
		$.ajax(options);
});

// $('.modal').on('hidden.bs.modal', function(){ 
// 		$(this).find('form')[0].reset(); //para borrar todos los datos que tenga los input, textareas, select.
// 		//$("label.error").remove();  //lo utilice para borrar la etiqueta de error del jquery validate
// });