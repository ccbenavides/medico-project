var obtenerdatos = function(dni) {
    //alert(durac);

        var options = {
        type: 'POST',
        url:'index.php?page=biopsia&accion=busca',
        data: {
            'dni': dni,            
        },
        dataType: 'json',
        success: function(response){
            bootbox.alert(response.mensaje,function(){
                window.location='index.php?page=biopsia&accion=form';
            });
            
        }
    };          

    $.ajax(options);

}

$('#buscar-paciente').on('submit', function(event) {
    event.preventDefault();
    
    var dni = $('#dni').val();
    
    obtenerdatos(dni);

});