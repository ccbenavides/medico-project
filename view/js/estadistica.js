$(document).ready(function() {

	cargarcomboinforme2();

});

function cargarcomboinforme2(){
    var opss = document.getElementById("cmb01").value;
    var fechad=$('#desde');
    var fechah=$('#hasta');
    if (opss==1) {
        cargarFormulario("cmbestadistica", "index.php?page=reportes&accion=cargararea");
        document.getElementById('fechadesde').value="";
        document.getElementById('fechahasta').value="";
        fechad.show();
        fechah.show();
    }else if (opss==2) {
    	cargarFormulario("cmbestadistica", "index.php?page=reportes&accion=cargararea");
        document.getElementById('fechadesde').value="";
        document.getElementById('fechahasta').value="";
        fechad.show();
        fechah.show();
    }else if (opss==3) {
    	cargarFormulario("cmbestadistica", "index.php?page=reportes&accion=cargararea");
        document.getElementById('fechadesde').value="";
        document.getElementById('fechahasta').value="";
        fechad.show();
        fechah.show();
    }else if (opss==4) {
    	cargarFormulario("cmbestadistica", "index.php?page=reportes&accion=cargararea");
        document.getElementById('fechadesde').value="";
        document.getElementById('fechahasta').value="";
        fechad.show();
        fechah.show();
    }else if (opss==5) {
    	cargarFormulario("cmbestadistica", "index.php?page=reportes&accion=cargararea");
        document.getElementById('fechadesde').value="";
        document.getElementById('fechahasta').value="";
        fechad.show();
        fechah.show();
    }else if (opss==6) {
    	cargarFormulario("cmbestadistica", "index.php?page=reportes&accion=cargardiv");
    	document.getElementById('fechadesde').value="";
        document.getElementById('fechahasta').value="";
        fechad.show();
        fechah.show();
    }else if (opss==7) {
    	cargarFormulario("cmbestadistica", "index.php?page=reportes&accion=cargardiv");
    	document.getElementById('fechadesde').value="";
        document.getElementById('fechahasta').value="";
        fechad.show();
        fechah.show();
    }else if (opss==8) {
    	cargarFormulario("cmbestadistica", "index.php?page=reportes&accion=cargardiv");
    	document.getElementById('fechadesde').value="";
        document.getElementById('fechahasta').value="";
        fechad.show();
        fechah.show();
    }else if (opss==9) {
    	cargarFormulario("cmbestadistica", "index.php?page=reportes&accion=cargardiv");
    	document.getElementById('fechadesde').value="";
        document.getElementById('fechahasta').value="";
        fechad.show();
        fechah.show();
    }else if (opss==10) {
    	cargarFormulario("cmbestadistica", "index.php?page=reportes&accion=cargardiv");
    	document.getElementById('fechadesde').value="";
        document.getElementById('fechahasta').value="";
        fechad.show();
        fechah.show();
    }else if (opss==11) {
    	cargarFormulario("cmbestadistica", "index.php?page=reportes&accion=cargardiv");
    	document.getElementById('fechadesde').value="";
        document.getElementById('fechahasta').value="";
        fechad.show();
        fechah.show();
    }else if (opss==12) {
    	cargarFormulario("cmbestadistica", "index.php?page=reportes&accion=cargardiv");
    	document.getElementById('fechadesde').value="";
        document.getElementById('fechahasta').value="";
        fechad.show();
        fechah.show();
    }else if (opss==13) {
    	cargarFormulario("cmbestadistica", "index.php?page=reportes&accion=cargardiv");
    	document.getElementById('fechadesde').value="";
        document.getElementById('fechahasta').value="";
        fechad.show();
        fechah.show();
    }else if (opss==14) {
        cargarFormulario("cmbestadistica", "index.php?page=reportes&accion=cargardiv");
        document.getElementById('fechadesde').value="";
        document.getElementById('fechahasta').value="";
        fechad.show();
        fechah.show();
    }else if (opss==15) {
        cargarFormulario("cmbestadistica", "index.php?page=reportes&accion=cargardiv");
        document.getElementById('fechadesde').value="";
        document.getElementById('fechahasta').value="";
        fechad.show();
        fechah.show();
    }else if (opss==16) {
        cargarFormulario("cmbestadistica", "index.php?page=reportes&accion=cargardiv");
        document.getElementById('fechadesde').value="";
        document.getElementById('fechahasta').value="";
        fechad.show();
        fechah.show();
    }else if (opss==17) {
        cargarFormulario("cmbestadistica", "index.php?page=reportes&accion=cargardiv");
        document.getElementById('fechadesde').value="";
        document.getElementById('fechahasta').value="";
        fechad.show();
        fechah.show();
    }else if (opss==18) {
        cargarFormulario("cmbestadistica", "index.php?page=reportes&accion=cargardiv");
        document.getElementById('fechadesde').value="";
        document.getElementById('fechahasta').value="";
        fechad.show();
        fechah.show();
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

    // console.log(id,url)
} 