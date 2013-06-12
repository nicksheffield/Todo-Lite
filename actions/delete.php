<?php


	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) die();

	require_once('../classes/sqlite.php');
	require_once('../classes/security.php');
	require_once('../classes/template.php');

	$db = new sqlite('../db/'.$_POST['db'],'list');

	$deleted = $db->del('id',escape_num($_POST['id']));
	
	echo $deleted;