<?php


	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) die();

	require_once('config.php');
	require_once('classes/sqlite.php');
	require_once('classes/security.php');
	require_once('classes/template.php');

	$db = new sqlite($config['db'],$config['table']);

	$deleted = $db->del('id',escape_num($_POST['id']));
	
	echo $deleted;