$().ready(function() {

	var nav = $('.nav')[0];

	$.fn.extend({
		openNavElement: function() {
			if ($(this).is('.btn-add')) {

			} else if ($(this).is('.nav-container label')) {
				openContainer($(this).parent());
			} else if ($(this).is('.nav-container-options-item')) {
				openItem($(this));
			}
		}
	});

	// Main header
	function openContainer(container) {
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
		$('#sub-nav').animate({left: '-' + ($('#sub-nav').width() + 10) + 'px'}, 300);
		$('.nav-container-options-item--active').removeClass('nav-container-options-item--active');
	}

	// Map/Account item
	function openItem(item) {
		if (item.hasClass('nav-container-options-item--active')) {
			$('#sub-nav').animate({left: '-' + ($('#sub-nav').width() + 10) + 'px'}, 300);
			item.removeClass('nav-container-options-item--active');
		} else {
			$('#sub-nav').animate({left: '0px'}, 300);
			$('.nav-container-options-item--active').removeClass('nav-container-options-item--active');
			item.addClass('nav-container-options-item--active');
		}
	}

});
