<?php

########
# SET UP THE DATABASE
########

	$dbname = 'todolite.sqlite';
	$table =  "list";

	$db = new SQLiteDatabase($dbname,0666);

	# if the list table does not exist, create it
	if(!count($db->arrayQuery("SELECT name FROM sqlite_master WHERE type='table' AND name='$table'"))){
		$results = $db->queryExec("CREATE TABLE $table(
			id INTEGER PRIMARY KEY,
			content TINYTEXT NOT NULL,
			date DATETIME NOT NULL
		)");
	}
	
########
# LOAD HTML
########
	
	// page title
	$title = 'Todo Lite';
	
	$list = $db->arrayQuery("SELECT id,content,date FROM $table");
	
	include('page.php');