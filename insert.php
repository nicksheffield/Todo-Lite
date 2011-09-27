<?php


	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) die();

	require_once('classes/sqlite.php');
	require_once('classes/security.php');
	require_once('classes/template.php');
	
	date_default_timezone_set('Pacific/Auckland');

	$db = new sqlite($_POST['db'],'list');
	
	$content = escape_str($_POST['content']);
	$date = gmdate('c');

	$inserted = $db->insert(array(
		'content'=>$content,
		'date'=>$date
	));
	
	if($inserted){
		new template(array(
			'id'		=> $db->last_insert,
			'content'	=> $content,
			'date'		=> $date
		));
	}