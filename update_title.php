<?php


	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) die();

	require_once('classes/sqlite.php');
	require_once('classes/security.php');
	require_once('classes/template.php');

	$db = new sqlite($_POST['db'],'title');
	
	$db->where('id',1);
	
	$updated = $db->update(array(
		'name' => escape_str($_POST['name'])
	));
	
	echo $updated;