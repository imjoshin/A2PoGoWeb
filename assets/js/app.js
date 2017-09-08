$().ready(function() {
	// mobile device
	if (typeof window.orientation !== "undefined" || navigator.userAgent.indexOf('IEMobile') !== -1) {
		$("#map").parent().siblings().remove();
		$("<div class='mobile-overlay'>").prependTo($("#map").parent().parent());
	}

	$('.modal-wrapper:not(#login-wrapper)').on('click', function(e) {
		if (e.target === this) {
			$(this).hide();
		}
	});

	// handle nav events
	$('.nav-container .btn-add, .nav-container:not(.disabled) label, .nav-container-options-item').on('click', function() {
		$(this).openNavElement();
	});

	$('.sub-nav-form-account #type').on('change', function() {
		if ($(this).val() == "Phone" || $(this).val() == "Email") {
			$('.sub-nav-form-address').show();
			$('.sub-nav-form-webhook').hide();

			if($(this).val() == "Phone") {
				$('.sub-nav-form-address-phone').show();
				$('.sub-nav-form-address-email').hide();
			} else {
				$('.sub-nav-form-address-phone').hide();
				$('.sub-nav-form-address-email').show();
			}
		} else {
			$('.sub-nav-form-address').hide();
			$('.sub-nav-form-webhook').show();
		}

		$('.sub-nav .message').empty();
	});

	// address verification
	$('.sub-nav-form-address-verification .btn').on('click', function() {
		button = $(this);
		form = $('.sub-nav-form-account');

		$.ajax({
			type: "POST",
			dataType: "json",
			url: "php/ajax.php",
			data: {
				call: 'verify',
				form: form.serialize()
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

	$('.sub-nav-form-account .btn-save').on('click', function() {
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

					// previously no accounts
					if (!$('.nav-container-accounts .nav-container-options-item').length) {
						$('.nav-container-accounts').removeClass('nav-container--empty');
						$('.nav-container-maps').removeClass('disabled');
						$('.nav-container-maps .btn-add').fadeIn(500);
					}

					var account = $("<div class='nav-container-options-item'></div>");
					account.html("<i class='fa " + data.output['icon'] + "' aria-hidden='true'></i>" + data.output['name']);
					account.hide();
					$('.nav-container-accounts .nav-container-options').append(account);
					account.slideDown(500);

					$(document).closeSubNav(function() {
						$('.sub-nav-form-address-verification .btn').show();
						$('#verification').hide();
					});
				} else {
					$('.sub-nav .message').addClass('message-error');
					$('.sub-nav .message').html(data.output);
				}
			}
		});
	});

	$('.sub-nav-form-map .btn-save').on('click', function() {
		form = $('.sub-nav-form-map');

		$.ajax({
			type: "POST",
			dataType: "json",
			url: "php/ajax.php",
			data: {
				call: 'save_map',
				form: form.serialize()
			},
			success: function(data) {
				if (data.success) {
					$('.sub-nav .message').empty();
					/*
					// previously no maps
					if (!$('.nav-container-maps .nav-container-options-item').length) {
						$('.nav-container-maps').removeClass('nav-container--empty');
					}

					var map = $("<div class='nav-container-options-item'></div>");
					account.html("<i class='fa " + data.output['icon'] + "' aria-hidden='true'></i>" + data.output['name']);
					account.hide();
					$('.nav-container-maps .nav-container-options').append(map);
					account.slideDown(500);

					$(document).closeSubNav();
					*/
				} else {
					$('.sub-nav .message').addClass('message-error');
					$('.sub-nav .message').html(data.output);
				}
			}
		});
	});
});
