jQuery(function($){
	var topSpacing = 0;

	if ( $('.sitewide-footer').length ) {
		topSpacing = 45;
	} else if ( $('#wpadminbar').length ) {
		topSpacing = 32;
	}

	$('#site-header').sticky({
		topSpacing: topSpacing, // Space between element and top of the viewport
		zIndex: 100, // z-index
		//stopper: "#bar" // Id, class, or number value
		stickyClass: 'fixed-header' // Class applied to element when it's stuck
	});

	$('.header-bar-menu ul').slicknav({
	});

	$(window).scroll(function(){
		if ($(window).scrollTop() > 46) {
			$('body').addClass('sticky-move-to-top');
		} else {
			$('body').removeClass('sticky-move-to-top');
		}
	});
});