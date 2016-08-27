var autohospref = function (response) {
    var availableTags = response;    
    $("#deschosp").autocomplete({
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
          // var cie = ui.item.value.split('|');
          $("#ref_contra").val(ui.item.value);
          // $("#codcie"+ncie+"").val(cie[1]);
          // $("#idcie"+ncie+"").val(cie[0]);
        }
      });


}



var gethospref = function(deschosp){

  var options = {
    type: 'POST',
    url:'index.php?page=cie&accion=ajaxgethospref',
    data: {
      'deschosp' : deschosp
    },
    dataType: 'json',
    success: function(response){
      console.log(response);
      autohospref(response);
    }
  };
  $.ajax(options);

};

$(document).on('keyup', '#deschosp', function() {

  var deschosp = $(this).val();
  

  gethospref(deschosp);

  if (deschosp == '') {
  $("#ref_contra").val('');
  };

  //alert(desc+'/'+ncie);
  //auto();

});