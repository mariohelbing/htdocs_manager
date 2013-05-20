function dom_init() {

	//$('.project_folder').draggable()
	
	$("ul.project_folders").sortable({
		connectWith: ".project_folders",
		stop: function(){
			
			console.clear()
			
			var project_folders = []
			var stared_project_folders = []			
			var aside_project_folders = []			
			var $projectFolders = $("ul.project_folders")
	
			$projectFolders.filter('[data-kind="stared_project_folders"]')
				.each( function(){
				
					var $folders = $(this).find('.project_folder')
				
					$folders.each( function(){
					
						var $folder = $(this)						
						var folder_name = $folder.data('folder_name')
						
						stared_project_folders.push(folder_name)						
						console.log(folder_name)
					
					})
				
				})		
			$projectFolders.filter('[data-kind="aside_project_folders"]')
				.each( function(){
				
					var $folders = $(this).find('.project_folder')
				
					$folders.each( function(){
					
						var $folder = $(this)						
						var folder_name = $folder.data('folder_name')
						
						aside_project_folders.push(folder_name)						
						console.log(folder_name)
					
					})
				
				})		
			$projectFolders.filter('[data-kind="project_folders"]')
				.each( function(){
				
					var $folders = $(this).find('.project_folder')
				
					$folders.each( function(){
					
						var $folder = $(this)						
						var folder_name = $folder.data('folder_name')
						
						project_folders.push(folder_name)
						
						console.log(folder_name)
					
					})
				
				})

			var data =  {
					project_folders : project_folders,
					aside_project_folders : aside_project_folders,
					stared_project_folders : stared_project_folders,
				}
				
			console.log( data )

			$.ajax({
				url: "app/ajax.php",
				type : 'POST',
				data : {
					project_folders : project_folders,
					aside_project_folders : aside_project_folders,
					stared_project_folders : stared_project_folders,
				},
				success: function(data, textStatus, jqXHR ){
				
					console.log( data )
				
				}
			})
		
		},
	}).disableSelection();	

}