<?php

	$dbname = 'todolite.sqlite';
	$table =  "list";
	
	$date = strftime( "%b %d %Y %H:%M", time());

	$db = new SQLiteDatabase($dbname,0666);
	
	$db->queryExec("INSERT INTO $table('id','content','date') VALUES(
		null,
		'some content',
		'$date'
	)");
	
	header('location:index.php');