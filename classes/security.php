<?php

# This is more of a helper file than a class
# http://net.tutsplus.com/tutorials/tools-and-tips/can-you-hack-your-own-site-a-look-at-some-essential-security-considerations/

function escape_str($str){
	
	$output = filter_html($str);
	return $output;
	
}

function escape_num($num){
	
	if(stripos($num,'.')>=0){
		return floatval($num);
	}else{
		return intval($num);
	}
	
}

function escape_bool($bool){
	
	return stripos($bool,'true') >= 0;
	
}

function filter_html($input){
	
	return strip_tags($input,'<br/>,<p>');
	
}