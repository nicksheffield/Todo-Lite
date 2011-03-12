<?php


	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) die();

	require_once('config.php');
	require_once('classes/sqlite.php');
	require_once('classes/security.php');
	require_once('classes/template.php');

	$db = new sqlite($config['db'],$config['table']);
	
	$content = escape_str($_POST['content']);
	$date = strftime("%b %d %Y %H:%M:%S",time());

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