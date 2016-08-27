var autocie = function (response, ncie) {
    var availableTags = response;    
    $("#desccie"+ncie+"").autocomplete({
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
          $("#codcie"+ncie+"").val(cie[1]);
          $("#idcie"+ncie+"").val(cie[0]);
        }
      });


}



var getcie = function(desc, ncie){

  var options = {
    type: 'POST',
    url:'index.php?page=cie&accion=ajaxgetcie',
    data: {
      'desc' : desc
    },
    dataType: 'json',
    success: function(response){
      console.log(response);
      autocie(response, ncie);
    }
  };
  $.ajax(options);

};

$(document).on('keyup', '.txtcie', function() {

  var desc = $(this).val();
  var ncie = $(this).data('ncie');

  getcie(desc, ncie);

if (desc == '') {
$("#codcie"+ncie+"").val('');
$("#idcie"+ncie+"").val('');
};

  //alert(desc+'/'+ncie);
  //auto();

});