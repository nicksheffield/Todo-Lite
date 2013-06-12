<?php
	
	/*
		By Nick Sheffield
		nick@nicksheffield.com
	*/
	
	require_once('classes/sqlite.php');
	require_once('classes/security.php');
	require_once('classes/template.php');
	
	$database = isset($_GET['db']) ? $_GET['db'] : 'todo';
	
	$db = new sqlite($database);
	
	$posts = $db->get('id, content, date, complete');
	
	$db->table('title');
	$title = $db->get('name');
	
?>
<!DOCTYPE html>	
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php echo $title[0]['name']; ?></title>
	
	<link rel="shortcut icon" href="assets/images/favicon.ico" />
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500|Roboto+Slab:400,300,100|Bad+Script|Source+Sans+Pro:200,300,400' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
	
	<div id="container">
		<header>
			<h1 contenteditable="true" spellcheck="false"><?php echo $title[0]['name']; ?></h1>
		</header>
		
		<div id="main">
			<div id="input">
				<input type="text" id="post" placeholder="What do you need to do?" />
				<input type="submit" id="submit" value="Save" />
				<div id="spinner"></div>
			</div>
			
			<?php 
				foreach($posts as $post){
					Template::make_new($post);
				}
			?>
		</div>
	</div>
	
	<script>
		var db = '<?php echo $database; ?>';
	</script>
	
	<script src="assets/js/jquery-1.6.2.min.js"></script>
	<script src="assets/js/jquery-placeholders.js"></script>
	<script src="assets/js/spin.js"></script>
	<script src="assets/js/script.js"></script>
</body>
</html>