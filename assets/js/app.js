$().ready(function() {
	// handle nav events
	$('.nav-container .btn-add, .nav-container:not(.disabled) label, .nav-container-options-item').on('click', function() {
		$(this).openNavElement();
	});

	$('.sub-nav-form-account #type').on('change', function() {
		if ($(this).val() == "Phone/Email") {
			$('.sub-nav-form-address').show();
			$('.sub-nav-form-webhook').hide();
		} else {
			$('.sub-nav-form-address').hide();
			$('.sub-nav-form-webhook').show();
		}
	});

	// address verification
	$('.sub-nav-form-address-verification .btn').on('click', function() {
		button = $(this);

		$.ajax({
			type: "POST",
			dataType: "json",
			url: "php/ajax.php",
			data: {
				call: 'verify',
				address: $('#address').val()
			},
			success: function(data) {
				if (data.success) {
					$('.sub-nav .message').empty();
					button.hide();
					$('#verification').show();
				} else {
					if (data.output == "Verification code has already sent.") {
						button.hide();
						$('#verification').show();
					}

					$('.sub-nav .message').addClass('message-error');
					$('.sub-nav .message').html(data.output);
				}
			}
		});
	});

	$('.sub-nav-form-account .btn').on('click', function() {
		form = $('.sub-nav-form-account');

		$.ajax({
			type: "POST",
			dataType: "json",
			url: "php/ajax.php",
			data: {
				call: 'add_account',
				form: form.serialize()
			},
			success: function(data) {
				if (data.success) {
					$('.sub-nav .message').empty();
					var account = $("<div class='nav-container-options-item'></div>");
					account.html(data.output['name']);
					account.hide();
					$('.nav-container-accounts').append(account);
					account.slideDown(500);
					$.closeSubNav();
				} else {
					$('.sub-nav .message').addClass('message-error');
					$('.sub-nav .message').html(data.output);
				}
			}
		});
	});
});
