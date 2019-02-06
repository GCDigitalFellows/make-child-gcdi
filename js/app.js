jQuery(function($){
	$('#site-header').sticky({
		topSpacing: $('#wpadminbar').length ? 32 : 0, // Space between element and top of the viewport
		zIndex: 100, // z-index
		//stopper: "#bar" // Id, class, or number value
		stickyClass: 'fixed-header' // Class applied to element when it's stuck
	});

	$('.header-bar-menu ul').slicknav({
	});
});