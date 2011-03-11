<?php

class template{
	
	function __construct($result){
		
		echo '<section id="'.$result['id'].'">
			<div class="buttons">
				<img src="assets/images/cancel.png" class="delete"/>
			</div>
			
			<h1>'.substr($result['content'],0,50).'</h1>
			<div contenteditable="true" spellcheck="false" id="content">
				<p>
					'.$result['content'].'
				</p>
			</div>
			<p class="date sub" title="'.$result['date'].'">
				Less than a minute ago
			</p>
		</section>';
		
	}
	
}
