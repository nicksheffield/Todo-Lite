/* Author: 
	Nick Sheffield
	nick@nicksheffield.com
*/

$(document).ready(function(){
	$('p.date').prettyDate();
	
	setInterval(function(){
		$('p.date').prettyDate();
	},5000);
	
	
	// CReate
	$('#post').keyup(function(e){
		// if the enter key is pressed
		if(e.which==13){
			// call ajax to publish the new item
			$.ajax({
				type:'POST',
				url:'insert.php',
				data:{
					content:$(this).val()
				},
				success:function(msg){
					if(msg){
						$('#main').append(msg);
						
						$('#main section').last().slideUp(0).slideDown(200);
						
						$('#post').val('');
					}else{
						console.error('create failed');
					}
				}
			});
		}
	});
	
	// Update
	var t;
	$('p[contenteditable=true]').live('keyup',function(){
		
		clearTimeout(t);
		
		var content = $(this).html();
		var id = $(this).parent().attr('id');
		
		t = setTimeout(function(){
		
			$.ajax({
				type:'POST',
				url:'update.php',
				data:{
					content:content,
					id:id
				},
				success:function(msg){
					if(!msg){
						console.error('update failure');
					}else{
						console.log('success!');
						console.log(msg);
					}
				}
			});
			
		},500);
		
	});
	
	// Delete
	$('.delete').live('click',function(){
		var parent = $(this).parent().parent();
		
		$('p.date',parent).removeClass('date').text('Removing...');
		$.ajax({
				type:'POST',
				url:'delete.php',
				data:{
					id:parent.attr('id')
				},
				success:function(msg){
					if(msg){
						parent.slideUp(200);
					}else{
						console.error('delete failed');
					}
				}
			});
	});
	
	
	
});


