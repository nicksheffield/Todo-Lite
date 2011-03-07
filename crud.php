<?php


# if not from ajax then quit the script

	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) die();
	
	
# set up the database

	$dbname = 'todolite.sqlite';
	$table =  "list";
	$db = new SQLiteDatabase($dbname,0666);
	
	
# to create an item in the database

	if($_GET['type']=='create'){
	
		$date = date('c');
		$content = $_POST['content']; // will add security later, once it's all working, but probably don't need it
		
		$sent = $db->queryExec("INSERT INTO $table('id','content','date') VALUES(
			null,
			'$content',
			'$date'
		)");
		
		if($sent){
			echo '<section>
				<h1>List Item '.$db->lastInsertRowid.'</h1>
				<p contenteditable="true">
					'.$content.'
				</p>
				<p class="date" title="'.$date.'">
					just now
				</p>
			</section>';
			
		}else{
			echo false;
		}
		
	}