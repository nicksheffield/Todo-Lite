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
						
						$('#main section').last().slideUp(0).slideDown(200).find('.delete').css('opacity',0);
						
						$('#post').val('');
					}else{
						console.error('create failed');
					}
				}
			});
		}
	});
	/*
	// Update
	var t;
	$('p[contenteditable=true]').live('keyup',function(){
		
		clearTimeout(t);
		
		var content = $(this);
		var id = $(this).parent().attr('id');
		
		var content_html = content.html().replace('<div>','<br/>');
			content_html = content_html.replace('</div>','');
		
		t = setTimeout(function(){
		
			$.ajax({
				type:'POST',
				url:'crud.php?type=update',
				data:{
					content:content_html,
					id:id
				},
				success:function(msg){
					if(!msg){
						console.error('update failure');
					}
				}
			});
			
			console.log(content_html);
			
		},500);
		
	}).live('keyup',function(e){
		if(e.which==13){
			//e.preventDefault();
			//$(this).focus();
			
		}
	});
	
	// Delete
	$('.delete').css('opacity',0).live('click',function(){
		var parent = $(this).parent().parent();
		$.ajax({
				type:'POST',
				url:'crud.php?type=delete',
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
	$('section').live('mouseover',function(e){
		$('.delete',this).css('opacity',1);
	}).live('mouseout',function(e){
		$('.delete',this).css('opacity',0);
	});
	*/
	
	
	
});


