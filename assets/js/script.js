/*
	By Nick Sheffield
	nick@nicksheffield.com
*/

$(document).ready(function(){

// PRETTY DATE
// ##################################################################################

	$('p.date').prettyDate();
	
	setInterval(function(){
		$('p.date').prettyDate();
	},5000);
	
	if (!Modernizr.input.placeholder){
		$('#input input').placeholder('Create New Item','#a9a9a9');
	}
	
	
// CREATE ITEM
// ##################################################################################

	$('#post').keyup(function(e){
		// if the enter key is pressed
		if(e.which==13){
			// call ajax to publish the new item
			$.ajax({
				type:'POST',
				url:'insert.php',
				data:{
					content:$(this).val(),
					db:db
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
	
// UPDATE ITEM
// ##################################################################################

	var t;
	$('#content').live('keyup',function(){
		
		clearTimeout(t);
		
		var content = $(this).html();
		var id = $(this).parent().attr('id');
		
		t = setTimeout(function(){
		
			$.ajax({
				type:'POST',
				url:'update.php',
				data:{
					content:content,
					id:id,
					db:db
				},
				success:function(msg){
					console.log(msg);
					if(!msg){
						console.error('update failed');
					}
				}
			});
			
		},500);
		
	});
	
// DELETE ITEM
// ##################################################################################

	$('.delete').live('click',function(){
		var parent = $(this).parent().parent();
		
		$('p.date',parent).removeClass('date').text('Removing...');
		$.ajax({
				type:'POST',
				url:'delete.php',
				data:{
					id:parent.attr('id'),
					db:db
				},
				success:function(msg){
					if(msg){
						parent.slideUp(200,function(){
							$(this).remove();
						});
					}else{
						console.error('delete failed');
					}
				}
			});
	});
	
// COMPLETED ITEM
// ##################################################################################
	
	$('#show_completed').click(function(){
		
		if($(this).text()=='Show Completed'){
			$('.complete').css('display','block').slideUp(0).slideDown(200);
			$(this).text('Hide Completed');
		}else{
			$('.complete').slideUp(200);
			$(this).text('Show Completed');
		}
		
		return false;
	});

	$('.completed').live('click',function(){
		var parent = $(this).parent().parent();
		var edited = $('div[contenteditable=true]',parent);
		
		$.ajax({
			type:'POST',
			url:'complete.php',
			data:{
				id:parent.attr('id'),
				db:db
			},
			success:function(msg){
				if(msg){
					edited.attr('contenteditable','false');
					if($('#show_completed').text()=='Show Completed'){
						parent.slideUp(200,function(){
							parent.addClass('complete');
						});
					}else{
						parent.addClass('complete');
					}
				}else{
					console.error('completion update failed');
				}
			}
		});
	});
	
	
// UPDATE TITLE
// ##################################################################################

	var t_e;
	$('header h1').keyup(function(){
		
		clearTimeout(t_e);
		
		var name = $(this).text();
		
		t_e = setTimeout(function(){
		
			$.ajax({
				type:'POST',
				url:'update_title.php',
				data:{
					name:name,
					db:db
				},
				success:function(msg){
					console.log(msg);
					if(!msg){
						console.error('update failed');
					}
				}
			});
			
		},500);
		
	});
	
	
	
});


