<?php


	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) die();

	require_once('config.php');
	require_once('classes/sqlite.php');
	require_once('classes/security.php');
	require_once('classes/template.php');

	$db = new sqlite($config['db'],$config['table']);

	$_CLEAN = sec_clean($_POST);

	$date = strftime("%b %d %Y %H:%M:%S",time());

	$inserted = $db->insert(array('content'=>$_CLEAN['content'],'date'=>$date));
	
	if($inserted){
		new template(array(
			'id'		=> $db->last_insert,
			'content'	=> $_CLEAN['content'],
			'date'		=> $date
		));
	}