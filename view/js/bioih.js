


//modal agregar macro//
var modal_agregmacro=$('#modal-agregar-macroih');
var ajax_macro=$('#ajax_macroih');

$('body').on('click', '#btnAgregMacroIH', function(e) {
	e.preventDefault();
	modal_agregmacro.modal('show');
});
$('body').on('click', '#btnInsertaMacro', function(e) {
	e.preventDefault();
	var id_biopsia=$('#id_biopsia').val();
	var macroscopia=$('#macroscopia').val();
	var tecnologo=$('#tecnologo').val();
	
	var options={
			type:'POST',
			url:'index.php?page=biopsiaIH&accion=ajaxAgregaMacro',
			data: {
				'id_biopsia':id_biopsia,
				'macroscopia':macroscopia,
				'tecnologo':tecnologo				
			},
			dataType:'html',
			success:function(response){
				modal_agregmacro.modal('hide');
				//getMaterial(id_biopsia);
			}
		};
		$.ajax(options);
});
modal_agregmacro.on('hidden.bs.modal', function(){
		var id_biopsia = $('#id_biopsia').val();	
		getMacroIH(id_biopsia);
});

var getMacroIH=function(id_biopsia){
		var options = {
			type: 'POST',
			url:'index.php?page=biopsiaIH&accion=ajaxGetMacroih',
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
getMacroIH(id_biopsia);

//modal agregar diagnostico//
var modal_diag=$('#modal-agregar-diagih');
var ajax_diagih=$('#ajax_diagih');
$('body').on('click', '#btnAgregDiagnost', function(e) {
	e.preventDefault();
		var numero=$('#numero').val();
		if (numero>0) {
			modal_diag.modal('show');
		} else{
			bootbox.alert("Aun no se ha registrado los marcadores, por lo tanto no puede registrar el diagnostico", function(){});
		};
 		
});
$('body').on('click', '#btnInsertaDiag', function(e) {
	e.preventDefault();
  		var id_biopsia=$('#id_biopsia').val();
  		var id_muestrabio=$('#id_muestrabio').val();
  		var procedimiento=$('#procedimiento').val();

  		var options={
			type:'POST',
			url:'index.php?page=biopsiaIH&accion=ajaxAgregProc',
			data: {
				'id_biopsia':id_biopsia,
				'id_muestrabio':id_muestrabio,
				'procedimiento':procedimiento				
			},
			dataType:'html',
			success:function(response){
				modal_diag.modal('hide');
				
			}
		};
		$.ajax(options);
});
modal_diag.on('hidden.bs.modal', function(){
		var id_biopsia = $('#id_biopsia').val();	
		getDiagIH(id_biopsia);
});

var getDiagIH=function(id_biopsia){
		var options = {
			type: 'POST',
			url:'index.php?page=biopsiaIH&accion=ajaxGetProc',
			data: {
				'id_biopsia': id_biopsia
			},
			dataType: 'html',
			success: function(response){

					ajax_diagih.html('');
					ajax_diagih.html(response);
					ajax_diagih.fadeIn('slow');				
					
			}
		};

		$.ajax(options);
};
var id_biopsia = $('#id_biopsia').val();
getDiagIH(id_biopsia);

// Modal agregar Resultado general Añadir
var modal_result=$('#modal-agregar-resultado');
var ajax_result=$('#ajax_resultado');

$('body').on('click', '#btnAgregResultado', function(e) {
	e.preventDefault();
	modal_result.modal('show');
});
$('body').on('click', '#btnInsertarResultgen', function(e) {
	e.preventDefault();
  		var id_biopsia=$('#id_biopsia').val();
  		// var id_marc_prueba=$('#id_marc_prueba').val();
  		var res_general=$('#res_general').val();
  		
  		var options={
			type:'POST',
			url:'index.php?page=biopsiaIH&accion=ajaxAgregResultGen',
			data: {
				'id_biopsia':id_biopsia,
				// 'id_marc_prueba':id_marc_prueba,
				'res_general':res_general				
			},
			dataType:'html',
			success:function(response){
				modal_result.modal('hide');
				
			}
		};
		$.ajax(options);
});

modal_result.on('hidden.bs.modal', function(){
		var id_biopsia = $('#id_biopsia').val();	
		getResultIH(id_biopsia);
});
var getResultIH=function(id_biopsia){
		var options = {
			type: 'POST',
			url:'index.php?page=biopsiaIH&accion=ajaxGetResGen',
			data: {
				'id_biopsia': id_biopsia
			},
			dataType: 'html',
			success: function(response){

					ajax_result.html('');
					ajax_result.html(response);
					ajax_result.fadeIn('slow');				
					
			}
		};

		$.ajax(options);
};
var id_biopsia = $('#id_biopsia').val();
getResultIH(id_biopsia);

// ---------

//modal agregar resultado//
var modal_res=$('#modal-agregar-resih');
var ajax_res=$('#ajax_resih');
$('body').on('click', '#btnAgregResIH', function(e) {
	e.preventDefault();
	modal_res.modal('show');	
});
$('body').on('click', '#btnInsertaResult', function(e) {
	e.preventDefault();
  		var id_biopsia=$('#id_biopsia').val();
  		var id_marc_prueba=$('#id_marc_prueba').val();
  		var resultado=$('#resultado').val();
  		
  		var options={
			type:'POST',
			url:'index.php?page=biopsiaIH&accion=ajaxAgregResult',
			data: {
				'id_biopsia':id_biopsia,
				'id_marc_prueba':id_marc_prueba,
				'resultado':resultado				
			},
			dataType:'html',
			success:function(response){
				modal_res.modal('hide');
				
			}
		};
		$.ajax(options);
});
modal_res.on('hidden.bs.modal', function(){
		var id_biopsia = $('#id_biopsia').val();	
		getResIH(id_biopsia);
});
var getResIH=function(id_biopsia){
		var options = {
			type: 'POST',
			url:'index.php?page=biopsiaIH&accion=ajaxGetRes',
			data: {
				'id_biopsia': id_biopsia
			},
			dataType: 'html',
			success: function(response){

					ajax_res.html('');
					ajax_res.html(response);
					ajax_res.fadeIn('slow');				
					
			}
		};

		$.ajax(options);
};
var id_biopsia = $('#id_biopsia').val();
getResIH(id_biopsia);


//modal agregar conclusion//
var modal_conl=$('#modal-agregar-conclusion');
var ajax_conl=$('#ajax_conclusion');

$('body').on('click', '#btnAgregConclusion', function(e) {
	e.preventDefault();
	modal_conl.modal('show');
});

$('body').on('click', '#btnInsertaConclusion', function(e) {
	e.preventDefault();

	var id_biopsia=$('#id_biopsia').val();
	var valida_patologo=$('#valida_patologo').val();
	var fecha_informe=$('#fecha_informe').val();
	var conclusion=$('#conclusion').val();
    
	var options={
			type:'POST',
			url:'index.php?page=biopsiaIH&accion=ajaxAgregConclus',
			data: {
				'id_biopsia':id_biopsia,
				'valida_patologo':valida_patologo,
				'fecha_informe':fecha_informe,
				'conclusion':conclusion				
			},
			dataType:'html',
			success:function(response){
				modal_conl.modal('hide');
				getConclusionIH(id_biopsia);
							
			}
		};
		$.ajax(options);
});
modal_conl.on('hidden.bs.modal', function(){
		var id_biopsia = $('#id_biopsia').val();	
		getConclusionIH(id_biopsia);
});
var getConclusionIH=function(id_biopsia){
		var options = {
			type: 'POST',
			url:'index.php?page=biopsiaIH&accion=ajaxGetConclus',
			data: {
				'id_biopsia': id_biopsia
			},
			dataType: 'html',
			success: function(response){

					ajax_conl.html('');
					ajax_conl.html(response);
					ajax_conl.fadeIn('slow');				
					
			}
		};

		$.ajax(options);
};
var id_biopsia = $('#id_biopsia').val();
getConclusionIH(id_biopsia);

var modal_actualiza=$('#modal-estado-macro');
$('body').on('click','#GuardarEstado2',function(e){
	e.preventDefault();
	var macroscopia=$('#macroscopia').val();
	if (macroscopia!='') {
		modal_actualiza.modal('show');
	}else{
		bootbox.alert("Aun no se ha registrado la macroscopia, por lo tanto no puede finalizar", function(){});
	};
	
});
$('body').on('click','#btnActualizar',function(e){
	e.preventDefault();
	var id_biopsia=$('#id_biopsia').val();
	var options={
			type:'POST',
			url:'index.php?page=biopsiaIH&accion=ajaxActualizado2',
			data: {
				'id_biopsia':id_biopsia							
			},
			dataType:'html',
			success:function(response){
				modal_actualiza.modal('hide');
				if (id_biopsia>0) {
					window.location="index.php?page=biopsiaIH&accion=listar";
				};

				
			}
		};
		$.ajax(options);
});
var modal_estado=$('#modal-estado-biopsia');
$('body').on('click','#Finalizar',function(e){
	e.preventDefault();
	var conclusion=$('#conclusion').val();
	if (conclusion!='') {
		modal_estado.modal('show');
	} else{
		bootbox.alert("Aun no se ha registrado la conclusion, por lo tanto no puede finalizar", function(){});
	};
	
});
$('body').on('click','#btnFinalizar',function(e){
	e.preventDefault();
	var id_biopsia=$('#id_biopsia').val();
	var options={
			type:'POST',
			url:'index.php?page=biopsiaIH&accion=ajaxfinalizaih',
			data: {
				'id_biopsia':id_biopsia							
			},
			dataType:'html',
			success:function(response){
				modal_estado.modal('hide');
				if (id_biopsia>0) {
					window.location="index.php?page=biopsiaIH&accion=finalizar";
				};

				
			}
		};
		$.ajax(options);
});

$(document).on('click','#eliminarmarca', function(e) {	
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
			url:'index.php?page=biopsiaIH&accion=eliminarMarc',
			data: {
				'idbiopsia': idbiopsia,
				'idmarca': idmarca
			},
			dataType: 'html',
			success: function(response){

					ajax_res.html('');
					ajax_res.html(response);
					ajax_res.fadeIn('slow');				
					
			}
		};

		$.ajax(options);
};