<?php


	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) die();

	require_once('config.php');
	require_once('classes/sqlite.php');
	require_once('classes/security.php');
	require_once('classes/template.php');

	$db = new sqlite($_POST['db'],$config['table']);
	
	$db->where('id',escape_str($_POST['id']));
	
	$updated = $db->update(array(
		'complete' => 'true'
	));
	
	echo $updated;