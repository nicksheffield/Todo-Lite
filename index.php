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
	
	$db->table('title');
	$title = $db->get('name');
	
?>
<!DOCTYPE html>	

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7 ]> <html lang="en" class="ie6"> <![endif]-->
<!--[if IE 7 ]>	<html lang="en" class="ie7"> <![endif]-->
<!--[if IE 8 ]>	<html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9 ]>	<html lang="en" class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> 	<html lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?php echo $title[0]['name']; ?></title>
	
	<link rel="shortcut icon" href="assets/images/favicon.ico" />
	<link rel="stylesheet" href="assets/css/reset.css" />
	<link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
	
	<div id="container">
		<header>
			<h1 contenteditable="true" spellcheck="false"><?php echo $title[0]['name']; ?></h1>
		</header>
		
		<div id="main">
			<div id="input">
				<input type="text" id="post" placeholder="Create New Item" />
				<div id="spinner"></div>
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
	
	<script src="assets/js/jquery-1.6.min.js"></script>
	<script src="assets/js/jquery-placeholders.js"></script>
	<script src="assets/js/humane_date.js"></script>
	<script src="assets/js/spin.js"></script>
	<script src="assets/js/script.js"></script>
</body>
</html>