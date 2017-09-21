$(document).foundation()

$().ready(function() {
	// mobile device
	if (typeof window.orientation !== "undefined" || navigator.userAgent.indexOf('IEMobile') !== -1) {
		//$("#map").parent().siblings().remove();
		//$("<div class='mobile-overlay'>").prependTo($("#map").parent().parent());
		$('.nav-tabs-container[data-view="maps"] .nav-tabs-container-buttons').hide();
		$('.nav').css('width', '100%');
		$('#login-wrapper-logo').hide();
		$('#welcome').css('height', '75px');
		$('.nav-tabs-item').css('height', '20px');
	}

	$('.modal-wrapper:not(#login-wrapper)').on('click', function(e) {
		if (e.target === this) {
			$(this).hide();
		}
	});

	$(document).on('click', '.nav-tabs-item:not(.disabled), .nav-tabs-container-item:not(.disabled), .btn[data-view]:not(.disabled)', function() {
		$(this).openNavElement();
	});

	$('.nav-form input').on('keypress', function (e) {
		if (e.which == 13) {
			var view = $(this).parents('.nav-tabs-container').data('view');
			$('.btn-save[data-target=' + view + ']').click();
		}
	});

	// disable tab
	$(':not(input), input[notab]').on('keydown', function(e) {
		if (e.keyCode == 9) {
			e.preventDefault();
		}
	});

	$('#type').on('change', function() {
		if ($(this).val() == "phone" || $(this).val() == "email") {
			$('[data-type="webhook"]').hide();
			$('[data-type="address"]').show();

			if($(this).val() == "phone") {
				$('[data-type="address-phone"]').show();
				$('[data-type="address-email"]').hide();
			} else {
				$('[data-type="address-phone"]').hide();
				$('[data-type="address-email"]').show();
			}
		} else {
			$('[data-type="address-phone"]').hide();
			$('[data-type="address-email"]').hide();
			$('[data-type="address"]').hide();
			$('[data-type="webhook"]').show();
		}

		$('.sub-nav .message').empty();
	});

	$('.formatter').on('focus', function() {
		$(".popover").remove();
		var popover = $("<div class='popover'>");
		$('body').append(popover);
		$(this).keyup();

	}).on('blur', function() {
		$(".popover").remove();
	});

	$('.formatter').on('keyup', function() {
		var format = $(this).val();
		var variables = {
			'%NAME%': 'Pikachu',
			'%MAPNAME%': 'Test Map',
			'%ENDTIME%': '2:34:56 PM',
		}

		if ($(this).attr('id').indexOf('raid') >= 0) {
			variables['%GYMNAME%'] = "Brock's Gym";
			variables['%STARTTIME%'] = '1:34:56 PM';
			variables['%RAIDLEVEL%'] = '3';
		}

		$.each(variables, function (key, value) {
			format = format.split(key).join(value);
		});

		$('.popover').text(format);

		var position = $(this).offset();
		var left = position.left - $('.popover').width() / 2 + $(this).width() / 2;

		if (left < 12) {
			left = 12;
		}

		if (left + $('.popover').width() > $('.nav').width() - 30) {
			left = $('.nav').width() - $('.popover').width() - 30;
		}

		$('.popover').css({
			left: left,
			top: position.top + 40
		});
	});

	$('.info-icon').on('click', function() {
		$(".popover").remove();
		var popover = $("<div class='popover'>");
		var content = $(this).find('.info-icon-content').html();
		popover.html(content);
		$('body').append(popover);

		var position = $(this).offset();
		var left = position.left - popover.width() / 2 + $(this).width() / 2;

		if (left < 12) {
			left = 12;
		}

		if (left + popover.width() > $('.nav').width() - 30) {
			left = $('.nav').width() - popover.width() - 30;
		}

		popover.css({
			left: left,
			top: position.top + 30
		});
	});

	$(document).on('click', function(e) {
		if (!$(e.target).parents('.popover').length && !$(e.target).parents('.info-icon').length && !$(e.target).is('.formatter')) {
			$(".popover").remove();
		}
	});

	$('.nav-tabs-container').on('scroll', function() {
		$(".popover").remove();
	});

	// address verification
	$(document).on('click', '.nav-form-address-verification .btn:not(.disabled)', function() {
		button = $(this);
		button.addClass('disabled');
		form = $('.nav-form-account');
		message = form.parent().parent().find('.message');

		$.ajax({
			type: "POST",
			dataType: "json",
			url: "php/ajax.php",
			data: {
				call: 'verify',
				form: form.serialize()
			},
			success: function(data) {
				button.removeClass('disabled');
				if (data.success) {
					$('.nav .message').empty();
					button.hide();
					$('#verification').show();
				} else {
					if (data.output['message'] == "Verification code has already sent.") {
						button.hide();
						$('#verification').show();
					}

					message.addClass('message-error');
					message.html(data.output['message']);
				}
			}
		});
	});

	$('[data-view="account-form"] .btn-save').on('click', function() {
		form = $('.nav-form-account');
		message = form.parent().parent().find('.message');

		if (!window.new) {
			$('.non-editable-input').prop('disabled', false);
		}

		form.append("<input type='hidden' class='temp' name='new' value='" + (window.new ? 1 : 0) + "'>");
		form.append("<input type='hidden' class='temp' name='id' value='" + window.id + "'>");
		serialized = form.serialize();
		$("input.temp").remove();

		if (!window.new) {
			$('.non-editable-input').prop('disabled', true);
		}

		$.ajax({
			type: "POST",
			dataType: "json",
			url: "php/ajax.php",
			data: {
				call: 'save_account',
				form: serialized
			},
			success: function(data) {
				if (data.success) {
					var account;

					if (data.output['new']) {
						// previously no accounts
						if (!$('.nav-container-accounts .nav-container-options-item').length) {
							$('.nav-tabs-item[data-view="maps"]').removeClass('disabled');
						}

						account = $('[data-view="accounts"] .nav-tabs-container-item-template').clone();
						account.removeClass('nav-tabs-container-item-template');
						account.find('.fa').addClass(data.output['fields']['icon']);
						account.attr('data-id', data.output['fields']['id']);
						$('[data-view="accounts"] .nav-tabs-container-buttons').before(account);
						account.css('display', 'flex');
					} else {
						account = $('[data-view="accounts"] .nav-tabs-container-item[data-id=' + data.output['fields']['id'] + ']');
					}

					account.attr('data-fields', JSON.stringify(data.output['fields']));
					account.find('.nav-tabs-container-item-info-name').text(data.output['fields']['name']);
					account.find('.nav-tabs-container-item-info-details').text(data.output['fields']['detail']);
					$('[data-view="accounts"]').openNavElement();

					setTimeout(function() {
						account.animate({'opacity': 1}, 800);
					}, 300);
				} else {
					message.addClass('message-error');
					message.html(data.output['message']);
				}
			}
		});
	});

	$('[data-view="map-form"] .btn-save').on('click', function() {
		form = $('.nav-form-map');
		message = form.parent().parent().find('.message');
		boundaries = getMapShapes();

		form.append("<input type='hidden' class='temp' name='new' value='" + (window.new ? 1 : 0) + "'>");
		form.append("<input type='hidden' class='temp' name='id' value='" + window.id + "'>");
		form.append("<input type='hidden' class='temp' name='boundaries' value='" + JSON.stringify(boundaries) + "'>");
		serialized = form.serialize();
		$("input.temp").remove();

		$.ajax({
			type: "POST",
			dataType: "json",
			url: "php/ajax.php",
			data: {
				call: 'save_map',
				form: serialized
			},
			success: function(data) {
				if (data.success) {
					var map;

					if (data.output['new']) {
						map = $('[data-view="maps"] .nav-tabs-container-item-template').clone();
						map.find('.fa').addClass(data.output['fields']['icon']);
						map.attr('data-id', data.output['fields']['id']);
						$('[data-view="maps"] .nav-tabs-container-buttons').before(map);
						map.css('display', 'flex');
					} else {
						map = $('[data-view="maps"] .nav-tabs-container-item[data-id=' + data.output['fields']['id'] + ']');
					}

					map.attr('data-fields', JSON.stringify(data.output['fields']));
					map.find('.nav-tabs-container-item-info-name').text(data.output['fields']['name']);
					map.find('.nav-tabs-container-item-info-details').text(data.output['fields']['detail']);
					$('[data-view="maps"]').openNavElement();

					setTimeout(function() {
						map.animate({'opacity': 1}, 800);
					}, 300);
				} else {
					message.addClass('message-error');
					message.html(data.output['message']);
				}
			}
		});
	});
});
