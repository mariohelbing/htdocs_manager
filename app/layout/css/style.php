<?php	

	// compile less to css
	include dirname(__FILE__)."/lessphp/lessc.inc.php";
	lessc::ccompile(dirname(__FILE__).'/fonts.less', dirname(__FILE__).'/fonts.css');
	lessc::ccompile(dirname(__FILE__).'/main.less', dirname(__FILE__).'/main.css');
	lessc::ccompile(dirname(__FILE__).'/trash_browser.less', dirname(__FILE__).'/trash_browser.css');
	
	// echo css
	header("Content-Type: text/css"); 
	echo file_get_contents('reset.css');
	echo file_get_contents('fonts.css');
	echo file_get_contents('main.css');
	echo file_get_contents('trash_browser.css');
	
?>