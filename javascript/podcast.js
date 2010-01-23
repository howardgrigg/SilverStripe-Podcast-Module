jQuery(function(){
	jQuery('a.ajax')
		.livequery('click', function(e){
		
		e.preventDefault();
		
		var PageNumber = jQuery(this).attr("href");
		
		jQuery('#ajaxTableBox')
		.fadeOut("slow")
		.html("<img class='center' src='podcast/images/ajax-loading.gif' alt='Loading...' />")
		.load(
			(PageNumber),
			function(){
				jQuery(this).fadeIn("fast");
			}
		)
	return;
	});
});