<?php


	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) die();

	require_once('config.php');
	require_once('classes/sqlite.php');
	require_once('classes/security.php');
	require_once('classes/template.php');

	$db = new sqlite($config['db'],$config['table']);
	
	$_CLEAN = sec_clean($_POST);
	
	$db->where('id',sqlite_escape_string($_CLEAN['id']));
	
	$updated = $db->update(array(
		'complete' => 'true'
	));
	
	echo $updated;