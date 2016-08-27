var autociexcod = function (response, ncie) {
    var availableTags = response;    
    $("#codcie"+ncie+"").autocomplete({
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
          var cie = ui.item.value.split('|');
          // $("#codcie"+ncie+"").val(ui.item.value);
          $("#desccie"+ncie+"").val(cie[1]);
          $("#idcie"+ncie+"").val(cie[0]);
        }
      });


}



var getciexcod = function(icod, ncie){

  var options = {
    type: 'POST',
    url:'index.php?page=cie&accion=ajaxgetciexcod',
    data: {
      'icod' : icod
    },
    dataType: 'json',
    success: function(response){
      console.log(response);
      autociexcod(response, ncie);
    }
  };
  $.ajax(options);

};

$(document).on('keyup', '.codigociei', function() {

  var icod = $(this).val();
  var ncie = $(this).data('ncie');

  getciexcod(icod, ncie);

if (icod == '') {
$("#desccie"+ncie+"").val('');
$("#idcie"+ncie+"").val('');
};

  // alert(icod+'|'+ncie);
  //auto();

});