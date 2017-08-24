$().ready(function() {

	$('.login-modal-tabs-item').on('click', function() {
		if (!$(this).hasClass('login-modal-tabs-item--active')) {
			$('.login-modal-tabs-item--active').removeClass('login-modal-tabs-item--active');
			$(this).addClass('login-modal-tabs-item--active');

			$('.login-modal-form--active').removeClass('login-modal-form--active');
			$('.login-modal-form[data-form=' + $(this).data('form') + ']').addClass('login-modal-form--active');
		}
	});

	$('.login-modal-form .btn').on('click', function() {
		var form = $(this).parent();
		var formType = form.parent().data('form');

		$.each(form.find('input'), function() {
			if(!$(this).val().trim().length) {
				$(this).addClass('input-error');
			} else {
				$(this).removeClass('input-error');
			}
		});

		if (!form.find('input-error').length) {
			$.ajax({
				type: "POST",
				dataType: "json",
				url: "php/ajax.php",
				data: {
					call: formType,
					form: form.serialize()
				},
				success: function(data) {
					if (data.success) {
						$('.login-modal .message').empty();
						location.reload();
					} else {
						$('.login-modal .message').addClass('message-error');
						$('.login-modal .message').html(data.output);
					}
				}
			});
		}
	});

	$('.logout').on('click', function() {
		$.ajax({
			type: "POST",
			dataType: "json",
			url: "php/ajax.php",
			data: {
				call: 'logout'
			},
			success: function(data) {
				console.log(data);
				if (data.success) {
					location.reload();
				} else {
					// TODO do something about it
					location.reload();
				}
			}
		});
	});
});
