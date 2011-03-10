<?php

require_once('config.php');
require_once('classes/sqlite.php');
require_once('classes/template.php');

$db = new sqlite($config['db'],$config['table']);

$title = 'Todo Lite';

$list = $db->get('id,content,date');

include('page.php');