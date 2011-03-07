/* Author: 
	Nick Sheffield
	nick@nicksheffield.com
*/

$(document).ready(function(){
	$('p.date').prettyDate();
	
	setInterval(function(){
		$('p.date').prettyDate();
	},5000);
	
	
	// create
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
						
						$('#main section').last().slideUp(0).slideDown(100);
						
						$('#post').val('');
					}else{
						console.log('false');
					}
				}
			});
		}
	});
	
	// delete
	$('.delete').css('opacity',0).click(function(){
		$.ajax({
				type:'POST',
				url:'crud.php?type=delete',
				data:{
					id:$(this).parent().parent().attr('id')
				},
				success:function(msg){
					console.log(msg);
					if(msg){
						console.log('deleted')
					}else{
						console.log('not deleted');
					}
				}
			});
	});
	$('section').hover(function(e){
		$('.delete',this).hoverFlow('mouseover', {'opacity':1}, 200);
	},function(e){
		$('.delete',this).hoverFlow('mouseout', {'opacity':0}, 200);
	});
	
	
	
	
});


