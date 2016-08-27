var autociexcod = function (response, nciesal) {
    var availableTags = response;    
    $("#codciesal"+nciesal+"").autocomplete({
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
          // $("#codcie"+nciesal+"").val(ui.item.value);
          $("#descciesal"+nciesal+"").val(cie[1]);
          $("#idciesal"+nciesal+"").val(cie[0]);
        }
      });


}



var getciexcodsal = function(icodsal, nciesal){

  var options = {
    type: 'POST',
    url:'index.php?page=cie&accion=ajaxgetciexcod',
    data: {
      'icod' : icodsal
    },
    dataType: 'json',
    success: function(response){
      console.log(response);
      autociexcod(response, nciesal);
    }
  };
  $.ajax(options);

};

$(document).on('keyup', '.codigocieisal', function() {

  var icodsal = $(this).val();
  var nciesal = $(this).data('nciesal');

  getciexcodsal(icodsal, nciesal);

if (icodsal == '') {
$("#descciesal"+nciesal+"").val('');
$("#idciesal"+nciesal+"").val('');
};

  // alert(icodsal+'|'+nciesal);
  //auto();

});