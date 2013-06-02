function dom_init() {

	var $app = $('#app')
	var $content = $('#content')
	var group_markup = '<div class="group"><h2 class="group_title sorthandle">New Group</h2><ul class="project_folders" data-kind=""></ul></div>'

	// app
	$app 
		.bind('add_group', function(){
			
			$(group_markup)
				.prependTo($content)
		
		})
	
	// content
	$content.sortable({
		handle: ".sorthandle",
		//forcePlaceholderSize: true,
		axis: "y",
		stop: function(){
			
			
		
		},
	}).disableSelection();
	
	// project_folders + list
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

	// header navi
	$('.header_navi')
		.on('click', 'a', function(){
		
			var $a = $(this)
			var action = $a.data('action')
			
			switch( action ){			
				case 'add_group':
					$app.trigger('add_group')
					break;			
			}
		
		})
	
	// searchform
	$('form.searchform')
		.on('init', 			function(){
		
			var $form = $(this)
			var $input = $form.find('input')			
			var $searchableElms = $('li.project_folder')
			var $aClear = $form.find('a.clear')
		
			$input.val('')
			$form.data('searchableElms', $searchableElms)
			$form.data('input', $input)
			
			// blur on escape
			$(document).keydown( function(e){ 
			
				if( e.which == 27 ){ 
					$aClear.trigger('click')
					$input.blur() 
				}else{
					$input.focus() 
				}
			
			})
		
		})
		.on('submit', 			function(){		// search tables, hide show trs
		
			var $form = $(this)
			var $searchableElms = $form.data('searchableElms')
			var $input = $form.data('input')
			var value = jQuery.trim( $input.val() )
			
			console.log( 'search for: ' + value )
			
			// has searchvalue: hide uncontaining searchableElms
			if(value){ 
				$searchableElms
					.removeClass('has_searchstring').addClass('hasnot_searchstring')	
					.filter(function() {
						return $(this).text().toUpperCase().indexOf(value.toUpperCase()) >= 0;        
					})
					.addClass('has_searchstring').removeClass('hasnot_searchstring')
			}
			// has no searchvalue: show all searchableElms
			else{
				$searchableElms.removeClass('has_searchstring hasnot_searchstring')
			}
			
			return false;
		
		})
		.on('click', 'a.clear', function(e){	// clear searchform
		
			var $form = $(e.delegateTarget)
			var $input = $form.data('input')
			
			$input.val('').focus()
			$form.trigger('submit')
			
			return false;
		
		})
		.on('keyup', 'input', 	function(e){	// triggers submit
		
			var $form = $(e.delegateTarget)
			var $input = $(this)
			
			$form.trigger('submit')
		
		})
		.trigger('init')	
	
}