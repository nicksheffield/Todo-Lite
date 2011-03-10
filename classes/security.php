<?php


function sec_clean($arr){
	
	# strip slashes
	foreach($arr as $key=>$val){
		$arr[$key] = stripslashes($val);
	}
	
	
	
	return $arr;
}

function sec_escape($str){
	
	return sqlite_escape_string($str);
	
}