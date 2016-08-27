var modal_usuario=$('#modal-biopsia');
$('body').on('click', '#bajar', function(e) {
    var user=$(this).data('usu');
    var id=$(this).data('id');
    modal_usuario.modal('show');
    document.getElementById('usunomb').value=user;
    document.getElementById('id_biopsia').value=id;
});

$('body').on('click', '#btnInsertarbaja', function(e) {
    e.preventDefault();

    var id_biopsia=$('#id_biopsia').val();
    var motivo=$('#motivob').val();
    if (motivo!='') {
       var options={
            type:'POST',
            url:'index.php?page=mantenimiento&accion=ajaxbajab',
            data: {
                'id_biopsia':id_biopsia,
                'motivo':motivo            
            },
            dataType:'html',
            success:function(response){
                modal_usuario.modal('hide');
                window.location="index.php?page=mantenimiento&accion=biopsias";
            }
        };
        $.ajax(options); 
    } else{
       document.getElementById('mensaje').innerHTML +='Colocar el motivo'; 
    }; 
    
});
var modal_bio=$('#modal-altabiopsia');
$('body').on('click', '#alta', function(e) {
    var num=$(this).data('num');
    var id=$(this).data('id');
    modal_bio.modal('show');
    document.getElementById('nbiopsia').value=num;
    document.getElementById('idbio').value=id;
});
$('body').on('click', '#btnInsertaralta', function(e) {
    e.preventDefault();

    var id_biopsia=$('#idbio').val();
    var motivo=$('#motivobio').val();
    if (motivo!='') {
       var options={
            type:'POST',
            url:'index.php?page=mantenimiento&accion=ajaxaltab',
            data: {
                'id_biopsia':id_biopsia,
                'motivo':motivo            
            },
            dataType:'html',
            success:function(response){
                modal_bio.modal('hide');
                window.location="index.php?page=mantenimiento&accion=biopsias";
            }
        };
        $.ajax(options); 
    } else{
       document.getElementById('mensajeb').innerHTML +='Colocar el motivo'; 
    }; 
    
});

