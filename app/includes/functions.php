<?php

function print_r2($var, $text = false){ // debug function: print_r with pre 

	echo '<pre style="margin-bottom: 10px; font-family: monospace;">';
	if( $text ) echo '<strong style="background-color: yellow; color: black;">'.$text.':</strong>&nbsp;&nbsp;';
	print_r( $var );
	echo '</pre><br /><br />';
}


function mh_curPageURL( $with_get_params = TRUE ) {
	$pageURL = 'http';		
	if (isset($_SERVER["HTTPS"])) if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	
	// get parameter werden abgeschnitten
	if( $with_get_params === FALSE ){
		$arr = explode("?", $pageURL, 2);
		$pageURL = $arr[0];
	}
	
	return $pageURL;
}

?>
