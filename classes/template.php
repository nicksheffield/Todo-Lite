<?php

class Template{
	
	public static function make_new($result){
		
		$complete = (isset($result['complete']) && $result['complete'] == 'true') ? 'complete' : '' ;
		$editable = (isset($result['complete']) && $result['complete'] == 'true') ? 'false' : 'true' ;
		
		echo '<section id="'.escape_num($result['id']).'" class="item '.$complete.'">
			<div class="buttons">
				<img src="assets/images/tick.png" class="delete" />
			</div>
			
			<h1>'.substr($result['content'],0,50).'</h1>
			<div contenteditable="'.$editable.'" spellcheck="false" id="content" class="posts">
				<p>
					'.stripslashes($result['content']).'
				</p>
			</div>
		</section>';
		
	}
	
}
