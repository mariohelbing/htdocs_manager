<?php

	print_r( $_REQUEST );
	
	$path = '../content/';
	
	if( isset($_REQUEST['project_folders']) ){
	
		$project_folders = $_REQUEST['project_folders'];

		array_walk($project_folders, create_function('&$val', '$val = trim($val);')); 
		$project_folders = array_filter($project_folders, 'strlen'); 
		
		file_put_contents($path.'project_folders', implode("\n", $project_folders) );
		
	}	
	if( isset($_REQUEST['aside_project_folders']) ){
	
		$aside_project_folders = $_REQUEST['aside_project_folders'];

		array_walk($aside_project_folders, create_function('&$val', '$val = trim($val);')); 
		$aside_project_folders = array_filter($aside_project_folders, 'strlen'); 
		
		file_put_contents($path.'aside_project_folders', implode("\n", $aside_project_folders) );
		
	}
	if( isset($_REQUEST['stared_project_folders']) ){
	
		$stared_project_folders = $_REQUEST['stared_project_folders'];	
		
		array_walk($stared_project_folders, create_function('&$val', '$val = trim($val);')); 
		$stared_project_folders = array_filter($stared_project_folders, 'strlen'); 
		
		file_put_contents($path.'stared_project_folders', implode("\n", $stared_project_folders) );
		
	}
	

?>