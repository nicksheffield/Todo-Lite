<?php

	require_once('config.php');
	require_once('classes/sqlite.php');
	require_once('classes/template.php');

	$db = new sqlite($config['db'],$config['table']);

	$posts = $db->get('id,content,date');

?>

<!doctype html>	

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7 ]> 				<html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>					<html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>					<html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>					<html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> 	<html lang="en" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?php echo $config['title']; ?></title>
	
	<link rel="shortcut icon" href="favicon.ico">
	<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="assets/css/reset.css">
	<link rel="stylesheet" href="assets/css/style.css?v=<?php echo rand(0,999999);?>">

	<script src="assets/js/modernizr-1.7.min.js"></script>
</head>
<body>

	<div id="container">
		<header>
			<h1><?php echo $config['title']; ?></h1>
		</header>
		
		<div id="main">
			<div id="input">
				<input type="text" id="post" placeholder="Create New Item" />
			</div>
			<?php 
				foreach($posts as $post){
					new template($post);
				}
			?>
		</div>
	</div> <!--! end of #container -->

	<script src="assets/js/jquery-1.5.1.min.js"></script>
	<script src="assets/js/jquery-placeholders.js"></script>
	<script src="assets/js/pretty.js"></script>
	<script src="assets/js/script.js?v=<?php echo rand(0,999999);?>"></script>
</body>
</html>