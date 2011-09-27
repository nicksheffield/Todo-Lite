<?php

	//require_once('classes/sqlite.php');
	//require_once('classes/security.php');
	
	$status = '';
	
	if($_POST['submit']){
		$file = file_get_contents($_POST['url']);
		//$new_db = 
		if($file){
			echo $file;
			$status = 'success';
		}else{
			$status = 'failed';
		}
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tdlite Sync</title>
	<link rel="shortcut icon" href="assets/images/favicon.ico">
	<link rel="stylesheet" href="assets/css/reset.css" />
	<link rel="stylesheet" href="assets/css/style.css" />
	<style>
		body{
			margin:40px 60px;
		}
		
		input[type=text]{
			padding:5px;
			margin-right:10px;
			border:0px;
			background:#eee;
			border-radius:3px;
			outline:none;
		}
		input[type=submit]{
			border:0px;
			border-radius:3px;
			background:#eee;
			color:#222;
			padding:5px 10px;
			text-shadow:none;
		}
	</style>
</head>
<body>
	<div id="container">
		<header>
			<h1>TDLite Sync Tool</h1>
		</header>
		
		<div id="main">
			
			<form method="post">
				<input type="text" name="url" />
				<input type="submit" name="submit" value="Sync" />
			</form>
			
			<div id="status"><?php echo $status; ?></div>
		</div>
	</div>
</body>
</html>