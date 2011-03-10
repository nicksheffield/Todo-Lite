<?php

// CReate Update Delete (no reading going on here lul)

# if not from ajax then quit the script

	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) die();
	
	
# set up the database

	$dbname = 'todolite.sqlite';
	$table =  "list";
	$db = new SQLiteDatabase($dbname,0666);
	
	
# to update an item in the database

	if($_GET['type']=='update'){
		
		$updated = $db->queryExec("UPDATE list SET content='".sqlite_escape_string($_POST['content'])."' WHERE id='".sqlite_escape_string($_POST['id'])."'");
		
		echo $updated;
		
	}