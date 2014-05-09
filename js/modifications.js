// Add construction so we can use normal jQuery style code. 
!function($) {
	$(function(){
    	//RC2013-10-28 "Binky" places discussion link in <bdi>.
    	//The default Bootstrap CSS therefore won't color the "Discussion" and other links,
    	//since it isn't a direct child of an <li>. So we simply remove all <bdi> tags.
		$('bdi').contents().unwrap();
	
		// Make the configuration page more readable
		$('#config__manager tr > td.label').removeClass('label');
	
		// add text-primariy to all header tags (h1,h2 etc) to the content
		$('.page > :header').addClass('text-primary');
	
		// make edit and other submit buttons to show in bootstrap style
		$('input[type=\"submit\"], input[type=\"reset\"]').removeClass('button');
		$('input[type=\"submit\"], input[type=\"reset\"]').addClass('btn btn-default btn-sm');
		$('input[value=\"Edit\"][type=\"submit\"]').addClass('pull-right');

		// Add sroll behavior to TOC
		$('body').scrollspy({ target: '.bs-sidebar'});

		// Put right width to the sidebar element. This is because it's "fixed" and therefor does not inherrit it's parents width
		$('.bs-sidebar').css('width', $('.col-md-3').width() + 'px');
	});

	// Put right width to the sidebar element. This is because it's "fixed" and therefor does not inherrit it's parents width
	// This will re-calibrate the width on resize
	$(window).on('resize', function(){
		$('.bs-sidebar').css('width', $('.col-md-3').width() + 'px');
	});
}(jQuery);
	

