/*var resultadopq = function (fecha_inicial, fecha_final) {
    var options = {
        type: 'POST',
        url: 'index.php?page=biopsiaPQ&accion=ajaxgetinfopaciente',
        data: {
            'fecha_inicial': fecha_inicial,
            'fecha_final': fecha_final
        },
    
        dataType: 'html',
        success: function (response) {
            $('#fecha_inicial').val('');
            $('#fecha_final').val('');
            ajax_resultado.html('');
            ajax_resultado.html(response);
            ajax_resultado.show();
        }
    };
    $.ajax(options);
};*/

replaceAll = function(string, omit, place, prevstring) {
  if (prevstring && string === prevstring)
    return string;
  prevstring = string.replace(omit, place);
  return replaceAll(prevstring, omit, place, string)
}
var json_bios = {};
var index = 0;

$('#btnInsertarFecha').on('click', function() {
    var fecha_inicial_prev= replaceAll($('#fecha_inicial').val() , "/" , "-");
    var fecha_final_prev = replaceAll($('#fecha_final').val() , "/" , "-");

    var fecha_inicial = fecha_inicial_prev.split("-").reverse().join("-");
    var fecha_final = fecha_final_prev.split("-").reverse().join("-");
    //if (!empty(fecha_inicial) && !empty(fecha_final)) {
    var options={
        type:'POST',
        url:'index.php?page=biopsiaPQ&accion=revisionFecha',
        data: {
            'fecha_inicial':fecha_inicial,
            'fecha_final': fecha_final
        },
        dataType:'html',
        success:function(response){
            console.log(response);
            modal_verpq.modal('hide');
           //  resultadopq(fecha_inicial, fecha_final);
            json_bios = JSON.parse(response);
           // ajax_resultado.html('');
          //  ajax_resultado.html(response);
            ajax_resultado.show();
            $("#txt_nombres").val(json_bios.biosp[0].nombre);
            $("#biopsia_anterior").addClass("btn-disable");
    
        }
    };
    $.ajax(options);
    /*}else{
        bootbox.alert("Todos los campos son requeridos", function(){});
    }*/
});


$("#biopsia_anterior").click(function(){
    if(index == 0){
        $("#biopsia_anterior").addClass("btn-disable");
        $("#biopsia_anterior").removeClass("btn-enable");
    }else{
        $("#txt_nombres").val(json_bios.biosp[index - 1].nombre);
        index--;
    }

   if(index == 0){
        $("#biopsia_anterior").addClass("btn-disable");
        $("#biopsia_anterior").removeClass("btn-enable");

    }

});

$("#biopsia_siguiente").click(function(){
    
    if(json_bios.length -1 == index){
       $("#biopsia_siguiente").addClass("btn-disable");
    }else{
        $("#biopsia_anterior").addClass("btn-enable");      
         $("#txt_nombres").val(json_bios.biosp[index + 1].nombre);
        index++;
    }
    if(index == 1){
           $("#biopsia_anterior").removeClass("btn-disable");
    }

});
//for(index in json_bios.biosp){ console.log(json_bios.biosp[0].nombre)}


//---modal agregar resultado-------//
var modal_verpq=$('#modal-agregar-ver');
var ajax_resultado=$('#datos_paciente');
$('body').on('click', '#btnfecha', function() {


        modal_verpq.modal('show');  

});
$(document).on('ready', function () {
    //$('#datos_paciente').load('view/PQ/biopsiaPQ-datospaciente.php');
    var id_pos=0;
    /*$('#biopsia_siguiente').on('click', function () {
        var cod_biopsia = $(this).data('id_biopsia');
        var id_count = $(this).data('id_count');
        var position = $(this).data('id_pos');
        if(position <= id_count){
            position++;
            id_pos=position;
            console.log(id_pos+" "+cod_biopsia +" "+id_count);
        }else{
            console.log("No hay mas registros, este es el maximo: "+position);
        }
        var options = {
            type: 'POST',
            url: 'index.php?page=biopsiaPQ&accion=ajaxgetinfopaciente',
            data: {
                'position':id_pos
            },
            dataType: 'html',
            success: function (response) {
                ajax_resultado.html(response);
            }
        }
        $.ajax(options);
    });
    $('#biopsia_anterior').on('click', function () {
        var cod_biopsia = $(this).data('id_biopsia');
        var id_count = $(this).data('id_count');
        var position = $(this).data('id_pos');
        if(position > 0){
            position--;
            id_pos = position;
            console.log(position+" "+cod_biopsia +" "+id_count);
        }else{
            console.log("No hay mas registros, este es el maximo: "+position);
        }
        var options = {
            type: 'POST',
            url: 'index.php?page=biopsiaPQ&accion=ajaxgetinfopaciente',
            data: {
                'position':id_pos
            },
            dataType: 'html',
            success: function (response) {
                ajax_resultado.html(response);
            }
        }
        $.ajax(options);
    });*/
});

//Fin funciones para botones anterior, siguiente, guardar
