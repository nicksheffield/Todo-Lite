<?php

	/*
		By Nick Sheffield
		nick@nicksheffield.com
	*/

	require_once('classes/sqlite.php');
	require_once('classes/security.php');
	require_once('classes/template.php');
	
	$database = isset($_GET['db'])?$_GET['db']:'todo';

	$db = new sqlite($database);

	$posts = $db->get('id,content,date,complete');

?>
<!DOCTYPE html>	

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7 ]> 				<html lang="en" class="ie6"> <![endif]-->
<!--[if IE 7 ]>					<html lang="en" class="ie7"> <![endif]-->
<!--[if IE 8 ]>					<html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9 ]>					<html lang="en" class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> 	<html lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?php echo $database.' list'; ?></title>
	
	<link rel="shortcut icon" href="favicon.ico">
	<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="assets/css/reset.css">
	<link rel="stylesheet" href="assets/css/style.css">

	<script src="assets/js/modernizr-1.7.min.js"></script>
</head>
<body>
	
	<div id="container">
		<header>
			<h1><?php echo $database.' list'; ?></h1>
		</header>
		
		<div id="main">
			<div id="input">
				<input type="text" id="post" placeholder="Create New Item" />
			</div>
			
			<div id="show">
				<a href="#" id="show_completed">Show Completed</a>
			</div>
			
			<?php 
				foreach($posts as $post){
					new template($post);
				}
			?>
		</div>
	</div> <!--! end of #container -->
	
	<script>
		var db = '<?php echo $database; ?>';
	</script>
	
	<script src="assets/js/jquery-1.5.1.min.js"></script>
	<script src="assets/js/jquery-placeholders.js"></script>
	<script src="assets/js/pretty.js"></script>
	<script src="assets/js/script.js"></script>
</body>
</html>