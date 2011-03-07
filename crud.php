<?php

// CReate Update Delete (no reading going on here lul)

# if not from ajax then quit the script

	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) die();
	
	
# set up the database

	$dbname = 'todolite.sqlite';
	$table =  "list";
	$db = new SQLiteDatabase($dbname,0666);
	
	
# to create an item in the database

	if($_GET['type']=='create'){
	
		$date = strftime( "%b %d %Y %H:%M", time());
		$content = sqlite_escape_string($_POST['content']); // will add security later, once it's all working, but probably don't need it
		
		$created = $db->queryExec("INSERT INTO $table('id','content','date') VALUES(
			null,
			'$content',
			'$date'
		)");
		
		if($created){
			echo '<section id="'.$db->lastInsertRowid().'">
				<div class="buttons">
					<a href="#" class="delete"><img src="images/cross.png"/></a>
				</div>
				
				<h1>List Item '.$db->lastInsertRowid().'</h1>
				<p contenteditable="true">
					'.$_POST['content'].'
				</p>
				<p class="date" title="'.$date.'">
					just now
				</p>
			</section>';
			
		}else{
			echo false;
		}
		
	}
	
# to update an item in the database

	if($_GET['type']=='update'){
		
		$updated = $db->queryExec("UPDATE list SET content='".$_POST['content']."' WHERE id='".$_POST['id']."'");
		
		echo $updated;
		
	}
	
# to delete an item in the database
	
	if($_GET['type']=='delete'){
		
		$deleted = $db->queryExec("DELETE FROM $table WHERE id='".$_POST['id']."'");
		
		echo $deleted;
		
	}