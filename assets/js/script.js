/*
	By Nick Sheffield
	nick@nicksheffield.com
*/

$(document).ready(function(){

// PRETTY DATE
// ##################################################################################

	$('p.date').humaneDates();
	
	/*setInterval(function(){
		$('p.date').prettyDate();
	},5000);*/
	
	
// CREATE ITEM
// ##################################################################################

	$('#post').keyup(function(e){
		// if the enter key is pressed
		if(e.which==13){
			// add the ajax loading icon
			spinner.spin(spinner_target);
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
					spinner.stop(spinner_target);
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
	
	
	/* spinner */
	
	var opts = {
		lines: 8, // The number of lines to draw
		length: 0, // The length of each line
		width: 3, // The line thickness
		radius: 5, // The radius of the inner circle
		color: '#000', // #rgb or #rrggbb
		speed: 1, // Rounds per second
		trail: 33, // Afterglow percentage
		shadow: false // Whether to render a shadow
	};
	var spinner_target = document.getElementById('spinner');
	var spinner = new Spinner(opts);
	
});


