<?php

class template{
	
	function __construct($result){
		
		$complete = (isset($result['complete']) && $result['complete'] == 'true') ? 'complete' : '' ;
		$editable = (isset($result['complete']) && $result['complete'] == 'true') ? 'false' : 'true' ;
		
		echo '<section id="'.escape_num($result['id']).'" class="'.$complete.'">
			<div class="buttons">
				<img src="assets/images/check.png" class="completed" alt="completed" title="mark as completed" />
				<img src="assets/images/cancel.png" class="delete" alt="delete" title="delete" />
			</div>
			
			<h1>'.substr($result['content'],0,50).'</h1>
			<div contenteditable="'.$editable.'" spellcheck="false" id="content" class="posts">
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
