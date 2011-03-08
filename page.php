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

	<title><?php echo $title; ?></title>
	
	<link rel="shortcut icon" href="favicon.ico">
	<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css?v=<?php echo rand(0,999999);?>">

	<script src="js/modernizr-1.7.min.js"></script>
</head>
<body>

	<div id="container">
		<header>
			<h1><?php echo $title; ?></h1>
			
			<input type="text" placeholder="New List Item" id="post" />
		</header>
		
		<div id="main">
			<?php foreach($list as $post): ?>
			
			<section id="<?php echo $post['id']; ?>">
				<div class="buttons">
					<a href="#" class="delete"><img src="images/cross.png"/></a>
				</div>
				
				<h1><?php echo substr($post['content'],0,50); ?></h1>
				<p contenteditable="true">
					<?php echo $post['content']; ?>
				</p>
				<p class="date" title="<?php echo $post['date']; ?>">
					&nbsp;
				</p>
			</section>
			
			<?php endforeach; ?>
		</div>
		
		<footer>
			
		</footer>
	</div> <!--! end of #container -->

	<script src="js/jquery-1.5.1.min.js"></script>
	<script src="js/pretty.js"></script>
	<script src="js/script.js?v=<?php echo rand(0,999999);?>"></script>
</body>
</html>