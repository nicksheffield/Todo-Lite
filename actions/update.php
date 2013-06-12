<?php


	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) die();

	require_once('../classes/sqlite.php');
	require_once('../classes/security.php');
	require_once('../classes/template.php');

	$db = new sqlite('../db/'.$_POST['db'],'list');
	
	$db->where('id',escape_num($_POST['id']));
	
	$updated = $db->update(array(
		'content' => $_POST['content']
	));
	
	echo $updated;