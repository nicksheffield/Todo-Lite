<?php

# This is more of a helper file than a class
# http://net.tutsplus.com/tutorials/tools-and-tips/can-you-hack-your-own-site-a-look-at-some-essential-security-considerations/

function escape_str($str){
	
	$output = filter_html($str);
	return addcslashes($output,"\x00\n\r\'\x1a\x25");
	
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
	
	$safelist = Array(
		'/<b>|<\/b>/i',
		'/<strong>|<\/strong>/i',
		'/<i>|<\/i>/i',
		'/<em>|<\/em>/i',
		'/<br[^>]*>/i',
	);
	
	$output = cleanWhitespace($input);
	$finds = getTags($output);
	
	foreach($finds as $find){
		
		$clean = true;
		
		foreach($safelist as $safetag){
			if(preg_match($safetag,$find) >0){
				$clean = false;
				break;
			}
		}
		if($clean === true){
			$output = str_ireplace($find,htmlentities($find),$output);
		}
		
	}
	
	return $output;
	
}

function cleanWhitespace($input){
	$white_rx = "/<\s*/";
	$output = preg_replace($white_rx, "<", $input);
	return $output;
}

function getTags($input){
	$tag_rx = "/<[^>]*>/";
	preg_match_all($tag_rx, $input, $matches);
	return $matches[0];
}

