<?php

class template{
	
	function __construct($result){
		
		echo '<section id="'.$result['id'].'">
			<div class="buttons">
				<img src="assets/images/cancel.png" class="delete"/>
			</div>
			
			<h1>'.substr($result['content'],0,50).'</h1>
			<p contenteditable="true" spellcheck="false">
				'.$result['content'].'
			</p>
			<p class="date sub" title="'.$result['date'].'">
				Less than a minute ago
			</p>
		</section>';
		
	}
	
}
