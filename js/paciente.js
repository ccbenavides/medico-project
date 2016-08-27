var auto = function (response) {
    //   var availableTags = [
    //   "ActionScript",
    //   "AppleScript",
    //   "Asp",
    //   "BASIC",
    //   "C",
    //   "C++",
    //   "Clojure",
    //   "COBOL",
    //   "ColdFusion",
    //   "Erlang",
    //   "Fortran",
    //   "Groovy",
    //   "Haskell",
    //   "Java",
    //   "JavaScript",
    //   "Lisp",
    //   "Perl",
    //   "PHP",
    //   "Python",
    //   "Ruby",
    //   "Scala",
    //   "Scheme"
    // ];
    var availableTags = response;    
    $( "#paciente2" ).autocomplete({
      source: availableTags
    });

    $("#dni").autocomplete({
        source: availableTags,
        focus: function(event, ui) {
          // prevent autocomplete from updating the textbox
          event.preventDefault();
          // manually update the textbox
          $(this).val(ui.item.label);
        },
        select: function(event, ui) {
          // prevent autocomplete from updating the textbox
          event.preventDefault();
          // manually update the textbox and hidden field
          $(this).val(ui.item.label);
          var pac = ui.item.value.split('|');
          var nompac = pac[0];
          var idpac = pac[1];
          $("#nompaciente").val(nompac);
          $("#idpaciente").val(idpac);
        }
      });


}



var getpacientes = function(paciente){

  var options = {
    type: 'POST',
    url:'index.php?page=paciente&accion=ajaxgetpaciente',
    data: {
      'paciente' : paciente
    },
    dataType: 'json',
    success: function(response){
      console.log(response);
      auto(response);
    }
  };
  $.ajax(options);

};

$(document).on('keyup', '#dni', function() {

var paciente = $(this).val();

  getpacientes(paciente);
  //auto();
  if ( paciente == '') {
    $('#idpaciente').val('');
    $('#nompaciente').val('');
  };


});