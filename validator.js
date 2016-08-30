$(function(){


// permite solo caracteres numericos
$('.enteros').keyup(function() {
                if (this.value.match(/[^0-9]/g)) {                    
                     this.value = this.value.replace(/[^0-9]/g, '');
                }
  });

$(".numericos").keypress(function (e) {
	if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        //$("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
});


//pemite solo caracteres alfanumericos
 $('.alfanumericos').keyup(function() {
                if (this.value.match(/[^a-zA-Z0-9 ]/g)) {
                    this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, '');
                }
  });
//pemite solo caracteres alfabeticos
 $('.alfabeticos').keyup(function() {
                if (this.value.match(/[^a-zA-Z ]/g)) {
                    this.value = this.value.replace(/[^a-zA-Z ]/g, '');
                }
  });


//permite decimales
$(".decimales").on("keypress keyup blur",function (event) {           
     $(this).val($(this).val().replace(/[^0-9\.]/g,''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }


});


});