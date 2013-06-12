/*
	By Nick Sheffield
	nick@nicksheffield.com
*/

$(document).ready(function(){
	
	
// CREATE ITEM
// ##################################################################################

	$('#post').keyup(function(e){
		// if the enter key is pressed
		if(e.which==13){
			save();
		}
	});
	
	$('#submit').click(function(){
		save();
	});
	
	
	function save(){
		if($('#post').val() != ''){

			// add the ajax loading icon
			spinner.spin(spinner_target);
			// call ajax to publish the new item
		
			$.ajax({
				type:'POST',
				url:'actions/insert.php',
				data:{
					content:$('#post').val(),
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
	}
	
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
				url:'actions/update.php',
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
				url:'actions/delete.php',
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
	
	
// UPDATE TITLE
// ##################################################################################

	var t_e;
	$('header h1').keyup(function(){
		
		clearTimeout(t_e);
		
		var name = $(this).text();
		
		t_e = setTimeout(function(){
		
			$.ajax({
				type:'POST',
				url:'actions/update_title.php',
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
		color: '#fff', // #rgb or #rrggbb
		speed: 1, // Rounds per second
		trail: 33, // Afterglow percentage
		shadow: false // Whether to render a shadow
	};
	var spinner_target = document.getElementById('spinner');
	var spinner = new Spinner(opts);
	
});


