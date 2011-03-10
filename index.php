<?php

require_once('config.php');
require_once('classes/sqlite.php');

$db = new sqlite($config['db'],$config['table']);

$title = 'Todo Lite';

$list = $db->get('*');

include('page.php');