$(document).ready(function()
{
  $("#buy").removeClass('disabled');
  $("#focus").focus();
  
$("#focus").blur(function(){
  $("#focus").focus();
});


$("#buy").on("click", disableButton);
  function disableButton() {
    $("#buy").toggleClass('disabled');
   }

});