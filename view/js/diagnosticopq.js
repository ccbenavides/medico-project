$(document).on('ready',function(){

	$('#id_muestrabio').on('change',function(){
		var id_muestrabio=$(this).val();
		$.ajax({
                        type:"POST",
                        url: "index.php?page=biopsiaPQ&accion=recuperardiag",
                        data: {
                            'id_muestrabio':id_muestrabio,
                        },
                        success: function(data) {
                            $('#diag_final').val(data);
                            
                        }
                    });  

	});
})