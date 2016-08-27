$(document).on('ready',function(){

	var identifi=$('#identificador').val();
	if (identifi>0) {
		$('#empleado').attr('disabled', 'disabled');
	};

	$('#empleado').on('change',function(){
		var empleado=$(this).val();
		$.ajax({
                        type:"POST",
                        url: "index.php?page=usuarios&accion=nick",
                        data: {
                            'empleado':empleado,
                        },
                        success: function(data) {
                            $('#user').val(data);
                            
                        }
                    });  

	});

var modal_usuario=$('#modal-user');
$('body').on('click', '#bajar', function(e) {
    var user=$(this).data('usu');
    var id=$(this).data('id');
    modal_usuario.modal('show');
    document.getElementById('usunomb').value=user;
    document.getElementById('id_usuario').value=id;
});

$('body').on('click', '#btnInsertarUsu', function(e) {
    e.preventDefault();

    var id_usuario=$('#id_usuario').val();
    var motivo=$('#motivo').val();
    if (motivo!='') {
       var options={
            type:'POST',
            url:'index.php?page=usuarios&accion=ajaxbajar',
            data: {
                'id_usuario':id_usuario,
                'motivo':motivo            
            },
            dataType:'html',
            success:function(response){
                modal_usuario.modal('hide');
                window.location="index.php?page=usuarios&accion=listar";
            }
        };
        $.ajax(options); 
    } else{
       document.getElementById('mensaje').innerHTML +='Colocar el motivo'; 
    }; 
    
});
    
})