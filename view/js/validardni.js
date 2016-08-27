          // $(document).ready(function() {    
          //       $('#dni').blur(function(){
                    
          //           $('#resultado').html('<img src="assets/img/loader.gif" alt="" />').fadeOut(1000);
                    
          //           var dni= $(this).val();  
                   
                    
          //           $.ajax({
          //               type:"POST",
          //               url: "index.php?page=paciente&accion=buscarxdnipac",
          //               data: {
          //                   'dni':dni,
          //               },
          //               success: function(data) {
          //                   $('#resultado').fadeIn(1000).html(data);
                            
          //               }
          //           });                 

          //       });              
          //   });    


  $(document).ready(function() {
// body.loading .modal {
//     display: block;
// }

// $('.modalcarga').modal('show');
 // var ventana = $('#modalcarga').val();


    var dni = $('#dni').val();
    var modoform = $('#modoform').val();

    if (dni != '') {
      if (modoform == 'add') {
        $('#modalcarga').fadeIn('fast');
        reniecws(dni);
      };      
    };

  });


// $(document).on('change', '#dni', function() {
//   var dni = $(this).val();

//   alert(dni);

// });


  // $(document).on('input', '#dni', function(event) {
  //   event.preventDefault();
  //   /* Act on the event */
  // var dni = $(this).val();

  //   if (dni.length == 8) {
  //     reniecws(dni);
  //     // setTimeout( reniecws(dni), 5000 );
  //   };

  // });

  // $("#dni").bind('paste', function(e) {
  //   var dni = $(this).val();
  //   // alert(dni);
  //   if (dni.length == 8) {
  //     reniecws(dni);
  //     setTimeout( reniecws(dni), 5000 );
  //   };
  // });

var reniecws = function (dni) {
    var options = {
        type: 'POST',
        url: "index.php?page=paciente&accion=reniecws",
        data: {
        'dni' : dni
        },
        dataType: 'json',
        success: function(response){
            console.log(response.existe);
            if (response.existe == false) {

              $('#modalcarga').fadeOut('slow');
              $('#resultado').fadeIn(1000).html(response.msj);
              
            } else{
            // console.log(response.arraydistritos);
            $('#appaterno').val(response.apepa);
            $('#apmaterno').val(response.apema);
            $('#nombres').val(response.nombres);
            // $('#fecha_nacimiento').val(response.fechanac);
            document.getElementById("fecha_nacimiento").value = response.fechanac;
            $('#edad').val(response.edad);
            if (response.sexo == 1) {
              $("#optionsRadios3").prop("checked", true)
            } else{
              $("#optionsRadios4").prop("checked", true)
            };
            $('#direccion').val(response.direccion);
            $('#departamento option:contains("'+response.departamento+'")').prop('selected', true);

            var provincias = response.arrayprovincias;
            var distritos = response.arraydistritos;
            
            $('#provincia').empty();
            $('#distrito').empty();

            for (var i=0;i<provincias.length;i++){
              if (provincias[i] == response.provincia) {
                $('<option selected/>').val(provincias[i]).html(provincias[i]).appendTo('#provincia');
              } else{
                $('<option/>').val(provincias[i]).html(provincias[i]).appendTo('#provincia');
              };
            }

            for (var i=0;i<distritos.length;i++){
              if (distritos[i] == response.distrito) {
                $('<option selected/>').val(distritos[i]).html(distritos[i]).appendTo('#distrito');
              } else{
                $('<option/>').val(distritos[i]).html(distritos[i]).appendTo('#distrito');
              };
            }
            $('#modalcarga').fadeOut('slow');
            };
        }
    };
    $.ajax(options);
};

var verificardni = function (dni) {
    var options = {
        type: 'POST',
        url: "index.php?page=paciente&accion=buscarxdnipac",
        data: {
        'dni' : dni
        },
        dataType: 'json',
        success: function(response){
            $('#resultado').fadeIn(1000).html(response.msj);
            if (response.exist == false) {
                $('#modalcarga').fadeIn('fast');
                reniecws(dni);
            };
            
        }
    };
    $.ajax(options);
};





$(document).on('input', '#dni', function(event) {
    event.preventDefault();
    /* Act on the event */

    var dni = $(this).val();

    if (dni.length == 8) {
        $('#resultado').html('<img src="assets/img/loader.gif" alt="" />').fadeOut(1000);
        verificardni(dni);      
    } else{
        $('#resultado').empty();
        $(".data").val("");
        $('#provincia').empty();
        $('#distrito').empty();
        $('#departamento option:contains("Selecione un Departamento")').prop('selected', true);
        $('<option/>').val("").html("Seleccione una Provincia").appendTo('#provincia');
        $('<option/>').val("").html("Seleccione un Distrito").appendTo('#distrito');
    };
  
});

// $(document).on('keyup', '#dni', function(event) {
//     event.preventDefault();
//     /* Act on the event */

//     var dni = $(this).val();

//     if (dni.length == 8) {
//         $('#resultado').html('<img src="assets/img/loader.gif" alt="" />').fadeOut(1000);
//         verificardni(dni);      
//     } else{
//         $('#resultado').empty();
//         $(".data").val("");

//     };
  
// });
//47015037