$(document).on('change', '#fecha', function(event) {
    var area = $('#area').val();
    var fecha=$('#fecha').val();

    if (area =="") {
    	bootbox.alert('Debe indicar un area');
    	document.getElementById('fecha').value="";
    }else{
    	tablaestado(area,fecha);
    }

    
});


$(document).on('change', '#area', function(event) {
    var area = $('#area').val();
    var fecha=$('#fecha').val();

    if (fecha !="") {
      	tablaestado(area,fecha);
    }
   
});


var tablaestado = function(area,fecha){

	var options = {
		type: 'POST',
		url:'index.php?page=movimiento&accion=tablaestado',
		data: {
			'fecha' : fecha,
			'area':area
		},
		dataType: 'html',
		success: function(response){
			$('#tablaestado').empty();
			$('#tablaestado').html(response);
			$('#listarbitacora').dataTable();
			$('#tablaestado').fadeIn("fast");			
		}
	};
	$.ajax(options);
};

var modal_dos=$('#modal-desautoriza');
$('body').on('click', '#desautorizar', function(e) {
   var id2=$(this).data('id');
   var estado2=$(this).data('est');
   if (estado2<3) {
      modal_dos.modal('show');
      document.getElementById('id_biopsia1').value=id2;
   } else{
      bootbox.alert('Aun no puede desautorizar edicion porque la biopsia ya ha sido estudiada');
   };
});

$('body').on('click', '#btnEliminarEdicion', function(e) {
    e.preventDefault();
    var area = $('#area').val();
    var fecha=$('#fecha').val();
    var id_biopsia1=$('#id_biopsia1').val();
    var ediciones=$('#ediciones').val();
    
    if (ediciones!="") {
       var options={
            type:'POST',
            url:'index.php?page=movimiento&accion=ajaxdesautoriza',
            data: {
                'id_biopsia1':id_biopsia1,
                'ediciones':ediciones
                       
            },
            dataType:'html',
            success:function(response){
                modal_dos.modal('hide');
                tablaestado(area,fecha);
            }
        };
        $.ajax(options); 
    } else{
       document.getElementById('mensajero').innerHTML +='Falta colocar algun dato'; 
    }; 
    
});

var modal_usu=$('#modal-user');

$('body').on('click', '#modificar', function(e) {
   var id=$(this).data('id');
   var estado=$(this).data('est');
   if (estado>1) {
   		modal_usu.modal('show');
   		document.getElementById('id_biopsia').value=id;
   } else{
   		bootbox.alert('Aun no puede autorizar edicion porque la biopsia no ha sido estudiada');
   };
   
   
});



$('body').on('click', '#btnInsertarEdicion', function(e) {
    e.preventDefault();
    var area = $('#area').val();
    var fecha=$('#fecha').val();
    var id_biopsia=$('#id_biopsia').val();
    var motivo=$('#motivo').val();
    var edicion=$('#edicion').val();
    var descr=$('#descr').val();

    if (motivo!='' && edicion!="") {
       var options={
            type:'POST',
            url:'index.php?page=movimiento&accion=ajaxautorizacion',
            data: {
                'id_biopsia':id_biopsia,
                'motivo':motivo,
                'edicion':edicion,
                'descr':descr            
            },
            dataType:'html',
            success:function(response){
                modal_usu.modal('hide');
                tablaestado(area,fecha);
            }
        };
        $.ajax(options); 
    } else{
       document.getElementById('mensaje').innerHTML +='Falta colocar algun dato'; 
    }; 
    
});

$('.modal').on('hidden.bs.modal', function(){ 
		$(this).find('form')[0].reset(); //para borrar todos los datos que tenga los input, textareas, select.
		//$("label.error").remove();  //lo utilice para borrar la etiqueta de error del jquery validate
});