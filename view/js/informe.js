$(document).ready(function() {
   
  cargarcomboinforme1();

  $(document).on('change', '#area', function(){
//alert('alertaaaaaaa');    
        var area = $(this).val();

        if(area != ''){
            getMuestras(area);
            

        }else{
            
            $('#muestra').attr('disabled', 'disabled');
            $('#muestra').val('');
             }
});

var getMuestras = function(area){

        var options = {
            type: 'POST',
            url:'index.php?page=reportes&accion=ajaxGetMuestra',
            data: {
                'area': area,
            },
            dataType: 'html',
            success: function(response){

                $('#muestra').removeAttr('disabled');
                $('#muestra').html(response);               
            }
        };
        $.ajax(options);

    };

$(document).on('change', '#grupos', function(){
//alert('alertaaaaaaa');    
        var grupo = $(this).val();

        if(grupo != ''){
            getEmpleados(grupo);
            

        }else{
            
            $('#empleado').attr('disabled', 'disabled');
            $('#empleado').val('');
             }
});

var getEmpleados = function(grupo){

        var options = {
            type: 'POST',
            url:'index.php?page=reportes&accion=ajaxGetEmpleado',
            data: {
                'grupos': grupo,
            },
            dataType: 'html',
            success: function(response){

                $('#empleado').removeAttr('disabled');
                $('#empleado').html(response);               
            }
        };
        $.ajax(options);

    };

$(document).on('change', '#fechaorigen', function(event) {
    event.preventDefault();
    /* Act on the event */
    var fechasistema = $('#fsistema').val();
    var forigen = $(this).val();

    var f1 = fechasistema;
    var f2 = forigen;

    var aFecha1 = f1.split('-'); 
    var aFecha2 = f2.split('-'); 
    var fFecha1 = Date.UTC(aFecha1[0],aFecha1[1]-1,aFecha1[2]); 
    var fFecha2 = Date.UTC(aFecha2[0],aFecha2[1]-1,aFecha2[2]); 
    var dif = fFecha2 - fFecha1;
    var dias = Math.floor(dif / (1000 * 60 * 60 * 24));
   
    if (dias>=1) {
        bootbox.alert('En esta fecha no se han registrado biopsias',function(){
            //bootbox.alert("Hello world callback"+forigen);
            document.getElementById('fechaorigen').value="";
        });
        
    };

});


});

function cargarcomboinforme1(){
    var opss = document.getElementById("cmbselect").value;
    var fechas=$('#fechas');
     var fechaor=$('#fechaorigen');
      var fechad=$('#desde');
    var fechah=$('#hasta');
    if (opss==1) {
        cargarFormulario("cmbinforme", "index.php?page=reportes&accion=cargardiario");
        fechas.show();
        document.getElementById('fechaorigen').value="";
        fechad.hide();
        fechah.hide();
    }else if (opss==2) {
        cargarFormulario("cmbinforme", "index.php?page=reportes&accion=cargarservicio");
        fechas.hide();
        fechaor.removeAttr('required');
        fechad.show();
        fechah.show();
        document.getElementById('fechadesde').value="";
        document.getElementById('fechahasta').value="";
    }else if (opss==3) {
        cargarFormulario("cmbinforme", "index.php?page=reportes&accion=cargamuestra");
        fechas.hide();
        fechad.show();
        fechah.show();
        fechaor.removeAttr('required');
        document.getElementById('fechadesde').value="";
        document.getElementById('fechahasta').value="";
    }else if (opss==5) {
        cargarFormulario("cmbinforme", "index.php?page=reportes&accion=carga2fechas");
        fechas.hide();
        fechad.show();
        fechah.show();
        fechaor.removeAttr('required');
        document.getElementById('fechadesde').value="";
        document.getElementById('fechahasta').value="";
    }else if (opss==6) {
        cargarFormulario("cmbinforme", "index.php?page=reportes&accion=cargames");
        fechas.hide();
        fechad.hide();
        fechah.hide();
        fechaor.removeAttr('required');
    }else if (opss==7) {
        cargarFormulario("cmbinforme","index.php?page=reportes&accion=cargamaterial");
        fechas.hide();
        fechad.show();
        fechah.show();
        fechaor.removeAttr('required');
        document.getElementById('fechadesde').value="";
        document.getElementById('fechahasta').value="";
    }else if (opss==8) {
        cargarFormulario("cmbinforme","index.php?page=reportes&accion=cargapersonal");
        fechas.hide();
        fechad.hide();
        fechah.hide();
        fechaor.removeAttr('required');
    }else if (opss==9) {
        cargarFormulario("cmbinforme", "index.php?page=reportes&accion=cargardiv");
        document.getElementById('fechadesde').value="";
        document.getElementById('fechahasta').value="";
        fechad.show();
        fechah.show();
        fechas.hide();
        fechaor.removeAttr('required');
    }else if (opss==10) {
        cargarFormulario("cmbinforme", "index.php?page=reportes&accion=cargardiv");
        document.getElementById('fechadesde').value="";
        document.getElementById('fechahasta').value="";
        fechad.show();
        fechah.show();
        fechas.hide();
        fechaor.removeAttr('required');
    }else if (opss==11) {
        cargarFormulario("cmbinforme", "index.php?page=reportes&accion=cargardiv");
        document.getElementById('fechadesde').value="";
        document.getElementById('fechahasta').value="";
        fechad.show();
        fechah.show();
        fechas.hide();
        fechaor.removeAttr('required');
    }else if (opss==12) {
        cargarFormulario("cmbinforme", "index.php?page=reportes&accion=cargardiv");
        document.getElementById('fechadesde').value="";
        document.getElementById('fechahasta').value="";
        fechad.show();
        fechah.show();
        fechas.hide();
        fechaor.removeAttr('required');
    };
}






/*
 *  [ -----------------  FUNCIONES AJAX   --------------------- ]
 */

function nuevoAjax()  {  
    var xmlhttp=false;  
    try  {  
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");  
    }  
    catch (e)  {  
        try  {  
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");  
        }  
        catch (e)  {  
            xmlhttp = false;  
        }  
    }  
    if (!xmlhttp && typeof XMLHttpRequest!='undefined')  {  
        xmlhttp = new XMLHttpRequest();  
    }  
    return xmlhttp;  
}  

function cargarFormulario(id, url)  {  
    var objDiv = document.getElementById(id);  
    ajax = nuevoAjax();  
    ajax.open("POST", url, true);  
    ajax.onreadystatechange = function() {
        switch (ajax.readyState) {  
            case 4:
                if(ajax.status == 200)  {  
                    objDiv.innerHTML = "";  
                    objDiv.innerHTML = ajax.responseText;  
                }  
                else {  
                    objDiv.innerHTML = 'Error 200';  
                }  
                break;  
        }  
    }  
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");  
    ajax.send();
} 