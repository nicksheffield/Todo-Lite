/* Author: 
	Nick Sheffield
	nick@nicksheffield.com
*/

$(document).ready(function(){
	$('p.date').prettyDate();
	
	setInterval(function(){
		$('p.date').prettyDate();
	},5000);
	
	
	$('#post').keyup(function(e){
		// if the enter key is pressed
		if(e.which==13){
			// call ajax to publish the new item
			$.ajax({
				type:'POST',
				url:'crud.php?type=create',
				data:{
					content:$(this).val()
				},
				success:function(msg){
					if(msg){
						$('#main').append(msg);
					}else{
						console.log('false');
					}
				}
			});
		}
	});
});