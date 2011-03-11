/*

placeholder simulation attribute of HTML5 v1.0
by Avner Solomon

use	placeholder($(slector),placeholder_value[,color]);
or	$(selector).placeholder(placeholder_value[,color]);

the function will initialize the input with the
placeholder_value unless not null value is given

please report bug at ravenx86.underworld@gmail.com

*/

function placeholder(input_element,input_val,input_val_color){

		//input_color=input_element.css('color');
		input_color='#000';
		
		input_element.val(input_val);
		input_element.css('color',input_val_color);
		
		input_element.focusin(function(){
			if(input_element.val()==input_val){
				input_element.val("");
				input_element.css('color',input_color);
			}
		});
		
		input_element.focusout(function(){
			if(jQuery.trim(input_element.val())==""){
				input_element.val(input_val);
				input_element.css('color',input_val_color);
			}
		});}

// jquery plugin

(function( $ ){

  $.fn.placeholder = function(val,color) {
	placeholder(this,val,color);
  };
})( jQuery );