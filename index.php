<?php

	error_reporting(E_ALL ^ E_NOTICE);
	include_once('app/includes/functions.php');
	
	// -------------------------
	
	define(APP_CONTENT_PATH,  'content/');
	define(HTDOCS_URL, 'http://localhost:8080/');
	define(HTDOCS_PATH, '../');
	
	// -------------------------
	
	$all_projects = array_map('basename', glob(HTDOCS_PATH."*", GLOB_ONLYDIR) );
	
	// -------------------------
	
	// read index files in array
	if( file_exists(APP_CONTENT_PATH.'project_folders') ){ 
		$project_folders = file(APP_CONTENT_PATH.'project_folders');
		array_walk($project_folders, create_function('&$val', '$val = trim($val);')); 
		$project_folders = array_filter($project_folders, 'strlen'); 
	}
	if( file_exists(APP_CONTENT_PATH.'aside_project_folders') ){ 
		$aside_project_folders = file(APP_CONTENT_PATH.'aside_project_folders');
		array_walk($aside_project_folders, create_function('&$val', '$val = trim($val);')); 
		$aside_project_folders = array_filter($aside_project_folders, 'strlen'); 
	}
	if( file_exists(APP_CONTENT_PATH.'stared_project_folders') ){ 
		$stared_project_folders = file(APP_CONTENT_PATH.'stared_project_folders');
		array_walk($stared_project_folders, create_function('&$val', '$val = trim($val);'));
		$stared_project_folders = array_filter($stared_project_folders, 'strlen'); 		
	}
	
	// check for new folders, append to $project_folders[]
	if( is_array($all_projects) ) { foreach( $all_projects as $project ) {
	
		if( !in_array($project, $project_folders) && 
			!in_array($project, $aside_project_folders) &&
			!in_array($project, $stared_project_folders) 
		){
		
			echo 'append to $project_folders[]: ' . $project.' <br>';			
			$project_folders[] = $project;
		
		}else{
		
			// echo $project .'<br>';
		
		} 
	
	} }
	
	// check for deleted folders, delete from $*_project_folder[]
	if( is_array($project_folders) ) { foreach( $project_folders as $project ) {
	
		if( !in_array(trim($project), $all_projects) ){

			echo 'remove from $project_folders[]: ' . $project.' <br>';			

			if(($key = array_search($project, $project_folders)) !== false) {
				unset($project_folders[$key]);
			}			
		
		}else{
		
			// echo $project .'<br>';
		
		} 
	
	} }
	if( is_array($aside_project_folders) ) { foreach( $aside_project_folders as $project ) {
	
		if( !in_array(trim($project), $all_projects) ){

			echo 'remove from $aside_project_folders[]: ' . $project.' <br>';			

			if(($key = array_search($project, $aside_project_folders)) !== false) {
				unset($aside_project_folders[$key]);
			}			
		
		}else{
		
			// echo $project .'<br>';
		
		} 
	
	} }
	if( is_array($stared_project_folders) ) { foreach( $stared_project_folders as $project ) {
	
		if( !in_array(trim($project), $all_projects) ){

			echo 'remove from $stared_project_folders[]: ' . $project.' <br>';			

			if(($key = array_search($project, $stared_project_folders)) !== false) {
				unset($stared_project_folders[$key]);
			}			
		
		}else{
		
			// echo $project .'<br>';
		
		} 
	
	} }
	
	//print_r2( $all_projects );
	//print_r2( $aside_project_folders );
	//print_r2( $stared_project_folders );
	//die;
	
	// chdir('../'); $project_folders = glob("../*", GLOB_ONLYDIR);

?>
<!DOCTYPE html>
<html lang="de">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo basename(dirname(__FILE__)) ?></title>
	<link href="app/layout/css/style.php" rel="stylesheet" media="screen" type="text/css" />
	<link href="app/layout/css/print.css" rel="stylesheet" media="print"  type="text/css" />
	
	<!--[if lt IE 9]>
	<script src="js/html5.js"></script>
	<![endif]-->	
	
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="robots" content="index, follow" />
	<script type="text/javascript">document.documentElement.className += " js";</script>
</head>

<body>

 	<!-- Content goes here -->
	<div id="wrapper">
	
		<header id="header">
			<h1>htdocs manager</h1>
		</header>
		
		<section id="content">
			<?php 
			
			echo '<h2>Favoriten</h2>';
			echo '<ul class="project_folders" data-kind="stared_project_folders">';
			if( is_array($stared_project_folders) ){ 
				foreach( $stared_project_folders as $project_folder ) { 
					echo '<li class="project_folder" data-folder_name="'.$project_folder.'">';
					echo '	<div class="left">';
					echo '		<a class="folder_name" href="'.HTDOCS_URL.$project_folder.'">'.$project_folder.'</a>';
					echo '	</div>';
					echo '	<div class="right">';
					if(file_exists(HTDOCS_PATH.$project_folder.'/_todo.txt')){
						echo implode("\n", file(HTDOCS_PATH.$project_folder.'/_todo.txt') );
					}
					echo '</div>';
					echo '</li>';
				}
			} 			
			echo '</ul>';			
			
			echo '<h2>Aside</h2>';
			echo '<ul class="project_folders" data-kind="aside_project_folders">';
			if( is_array($aside_project_folders) ){ 
				foreach( $aside_project_folders as $project_folder ) { 
					echo '<li class="project_folder" data-folder_name="'.$project_folder.'">';
					echo '	<div class="left">';
					echo '		<a class="folder_name" href="'.HTDOCS_URL.$project_folder.'">'.$project_folder.'</a>';
					echo '	</div>';
					echo '	<div class="right">';
					if(file_exists(HTDOCS_PATH.$project_folder.'/_todo.txt')){
						echo implode("\n", file(HTDOCS_PATH.$project_folder.'/_todo.txt') );
					}
					echo '</div>';
					echo '</li>';
				}
			} 			
			echo '</ul>';

			echo '<h2>Folders</h2>';
			echo '<ul class="project_folders" data-kind="project_folders">';
			if( is_array($project_folders) ){ 
				foreach( $project_folders as $project_folder ) { 
					echo '<li class="project_folder" data-folder_name="'.$project_folder.'">';
					echo '	<div class="left">';
					echo '		<a class="folder_name" href="'.HTDOCS_URL.$project_folder.'">'.$project_folder.'</a>';
					echo '	</div>';
					echo '	<div class="right">';
					if(file_exists(HTDOCS_PATH.$project_folder.'/_todo.txt')){
						echo implode("\n", file(HTDOCS_PATH.$project_folder.'/_todo.txt') );
					}
					echo '</div>';
					echo '</li>';
				} 
			}
			echo '</ul>';

			?>
		</section>
		
		<footer id="footer">			
		</footer>	
	
	</div>

	<script type="text/javascript" src="app/js/jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="app/js/jquery-ui-1.8.23.custom.min.js"></script>
	<script type="text/javascript" src="app/js/domscript.js"></script>
	<script type="text/javascript">jQuery(dom_init);</script>
</body>
</html>