<?php

class template{
	
	function __construct($result){
		
		echo '<section id="'.$result['id'].'">
			<div class="buttons">
				<a href="#" class="delete"><img src="images/12.png"/></a>
			</div>
			
			<h1>'.substr($result['content'],0,50).'</h1>
			<p contenteditable="true">
				'.$result['content'].'
			</p>
			<p class="date" title="'.$result['date'].'">
				&nbsp;
			</p>
		</section>';
		
	}
	
}
