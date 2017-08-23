$().ready(function() {

	$('.login-modal-tabs-item').on('click', function() {
		if (!$(this).hasClass('login-modal-tabs-item--active')) {
			$('.login-modal-tabs-item--active').removeClass('login-modal-tabs-item--active');
			$(this).addClass('login-modal-tabs-item--active');

			$('.login-modal-form--active').removeClass('login-modal-form--active');
			$('.login-modal-form[data-form=' + $(this).data('form') + ']').addClass('login-modal-form--active');
		}
	});

});
