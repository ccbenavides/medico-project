var autociesal = function (response, nciesal) {
    var availableTags2 = response;    


    $("#descciesal"+nciesal+"").autocomplete({
        source: availableTags2,
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
          $("#codciesal"+nciesal+"").val(cie[1]);
          $("#idciesal"+nciesal+"").val(cie[0]);
        }
      });


}



var getciesal = function(descsal, nciesal){

  var options = {
    type: 'POST',
    url:'index.php?page=cie&accion=ajaxgetcie',
    data: {
      'desc' : descsal
    },
    dataType: 'json',
    success: function(response){
      console.log(response);
      autociesal(response, nciesal);
    }
  };
  $.ajax(options);

};

$(document).on('keyup', '.txtciesal', function() {

  var descsal = $(this).val();
  var nciesal = $(this).data('nciesal');

  getciesal(descsal, nciesal);

if (descsal == '') {
$("#codciesal"+nciesal+"").val('');
$("#idciesal"+nciesal+"").val('');
};

  //alert(descsal+'/'+nciesal);
  //auto();

});