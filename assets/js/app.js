$().ready(function() {

	if ($('#login-modal').length) {
		
	}

	$('.nav-container label').on('click', function() {
		var container = $(this).parent();
		if (container.hasClass('nav-container--active')) {
			container.find('.nav-container-options').slideUp(300);
			container.removeClass('nav-container--active');
		} else {
			$('.nav-container--active .nav-container-options').slideUp(300);
			$('.nav-container--active').removeClass('nav-container--active');
			container.find('.nav-container-options').slideDown(300);
			container.addClass('nav-container--active');
		}

		// reset subnav
		$('#sub-nav').animate({left: '-' + $('#sub-nav').width() + 'px'}, 300);
		$('.nav-container-options-item--active').removeClass('nav-container-options-item--active');
	});

	$('.nav-container-options-item').on('click', function() {
		if ($(this).hasClass('nav-container-options-item--active')) {
			$('#sub-nav').animate({left: '-' + $('#sub-nav').width() + 'px'}, 300);
			$(this).removeClass('nav-container-options-item--active');
		} else {
			$('#sub-nav').animate({left: '0px'}, 300);
			$('.nav-container-options-item--active').removeClass('nav-container-options-item--active');
			$(this).addClass('nav-container-options-item--active');
		}
	});
});
