$(document).ready(function() {
   
  cargacombo3();

 
});



function cargacombo3(){
	var opss = document.getElementById("cmb02").value;
    var fechad=$('#desde');
    var fechah=$('#hasta');
	if (opss==1) {
        cargarFormulario("cmbmonitoreo", "index.php?page=movimiento&accion=cargarempleado");
        document.getElementById('fechadesde').value="";
        document.getElementById('fechahasta').value="";
        fechad.show();
        fechah.show();
    }else if(opss==2){
        cargarFormulario("cmbmonitoreo", "index.php?page=movimiento&accion=cargaremp1");
        document.getElementById('fechadesde').value="";
        document.getElementById('fechahasta').value="";
        fechad.show();
        fechah.show();
    }else if (opss==4) {
        cargarFormulario("cmbmonitoreo", "index.php?page=movimiento&accion=cargaremp1");
        fechad.hide();
        fechah.hide();
    };
}





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