$(document).ready(function() {
   
  cargaretiqueta();

  $('#area').on('change',function(){
        var area=$(this).val();
        document.getElementById("numbio").value='';
        document.getElementById("hasta").value='';
        if (area>=1) {
            $.ajax({
                        type:"POST",
                        url: "index.php?page=paciente&accion=mostrarnumbio",
                        data: {
                            'area':area,
                        },
                        success: function(data) {
                            //$('#numbio').val(data);
                          document.getElementById("numbio").placeholder=data;
                          document.getElementById("hasta").placeholder=data;
                        }
            });  
        } else{
           //bootbox.alert("Debe seleccionar un area", function(){});
           document.getElementById("numbio").placeholder=''; 
           document.getElementById("hasta").placeholder='';   
        };
        

    });

});

function cargaretiqueta(){
    var opss = document.getElementById("cmbetiqueta").value;
    var areas=$('#areas');
    var numbiop=$('#numbios');
    var desde=$('#desdes');
    var hasta=$('#hastas');
    if (opss==1) {
        //cargarFormulario("cmbdatos", "index.php?page=paciente&accion=cargarnumbio");
        areas.show();
        numbiop.show();
        document.getElementById("numbio").placeholder='';
        document.getElementById("area").selectedIndex="";
        desde.hide();
        hasta.hide();
        
    }else if (opss==2) {
        //cargarFormulario("cmbdatos", "index.php?page=paciente&accion=cargarrango");
        document.getElementById("area").selectedIndex="";
        areas.show();
        numbiop.hide();
        desde.show();
        hasta.show();
        document.getElementById("hasta").placeholder='';
        document.getElementById("desde").placeholder='';
    }
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