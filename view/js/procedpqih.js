$(document).on('ready',function(){
	$('#id_marc_prueba').on('change',function(){
        var id_marc_prueba=$(this).val();
        $.ajax({
                        type:"POST",
                        url: "index.php?page=biopsiaIH&accion=recuperarresult",
                        data: {
                            'id_marc_prueba':id_marc_prueba,
                        },
                        success: function(data) {
                            $('#resultado').val(data);
                            
                        }
                    });  

    });

})