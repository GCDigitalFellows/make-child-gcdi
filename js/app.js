jQuery(function($){
	$('#site-header').sticky({
		topSpacing: $('#wpadminbar').length ? 32 : 0, // Space between element and top of the viewport
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