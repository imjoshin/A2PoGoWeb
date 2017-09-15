$().ready(function() {

	var nav = $('.nav')[0];

	$.fn.extend({
		openNavElement: function() {
			if ($(this).is('.btn-add')) {
				$('.sub-nav-form').trigger("reset");
				$('.formatter').keyup();
				openAdd($(this));
			} else if ($(this).is('.nav-tabs-item')) {
				openTab($(this));
			} else if ($(this).is('.nav-container-options-item')) {
				$('.sub-nav-form').trigger("reset");
				$('.formatter').keyup();
				openItem($(this));
			}

			$('.sub-nav-form select').change();
		},
		closeSubNav: function(callback) {
			$('.sub-nav').animate({left: '-' + ($('.sub-nav').width() + 10) + 'px'}, 300);
			$('.nav-container-options-item--active').removeClass('nav-container-options-item--active');
			callback();
		}
	});

	function openAdd(button) {
		// new map/account
		window.new = true;
		$('.sub-nav .non-editable-input').prop("disabled", false);
		$(".sub-nav .hidden-edit-input").show();
		$('.nav-container-options-item--active').removeClass('nav-container-options-item--active');

		if (!button.parent().hasClass('nav-container--active')) {
			$('.nav-container--active .nav-container-options').slideUp(300);
			$('.nav-container--active').removeClass('nav-container--active');
			button.parent().find('.nav-container-options').slideDown(300);
			button.parent().addClass('nav-container--active');
		}

		if (button.hasClass('bouncy')) {
			button.removeClass('bouncy');
		}

		if (button.parents('.nav-container-maps').length) {
			$('#map-accounts').empty();
			// get accounts
			$('.nav-container-accounts .nav-container-options-item').each(function(k, v) {
				var row = $(" \
					<tr> \
						<td><input type='checkbox' name=\"accounts[" + $(this).data('id') + "]\" /></td> \
						<td>" + $(this).html() + "</td> \
					</tr> \
				");
				$('#map-accounts').append(row);
			});
		}

		$('.sub-nav-header').html(button.data('name'));
		$('.sub-nav-form').hide();
		$('.sub-nav-form-' + button.data('target')).show();
		$('.sub-nav').animate({left: '0px'}, 300);
	}

	// Main header
	function openTab(tab) {
		if (!tab.hasClass('nav-tabs-item--active')) {
			$('.nav-tabs-item--active').removeClass('nav-tabs-item--active');
			$('.nav-tabs-container--active').removeClass('nav-tabs-container--active');
		}
		tab.addClass('nav-tabs-item--active');
		$('.nav-tabs-container[data-tab="' + tab.data('tab') + '"]').addClass('nav-tabs-container--active');
		console.log('.nav-tabs-container[data-tab="' + tab.data('tab') + '"]');

		// reset subnav

	}

	// Map/Account item
	function openItem(item) {
		// not new map/account
		$('.sub-nav .non-editable-input').prop("disabled", true);
		$(".sub-nav .hidden-edit-input").hide();

		if (item.hasClass('nav-container-options-item--active')) {
			$('.sub-nav').animate({left: '-' + ($('.sub-nav').width() + 10) + 'px'}, 300);
			item.removeClass('nav-container-options-item--active');
			return;
		}

		$('.sub-nav').animate({left: '0px'}, 300);
		$('.nav-container-options-item--active').removeClass('nav-container-options-item--active');
		item.addClass('nav-container-options-item--active');

		var fields = $.parseJSON(item.attr('data-fields'));

		window.new = false;
		window.id = fields['id'];

		if (item.parents('.nav-container-accounts').length) {
			$('.sub-nav #type').trigger('change');

			$('.sub-nav-form').hide();
			$('.sub-nav-form-account').show();

		} else if (item.parents('.nav-container-maps').length) {
			$('#map-accounts').empty();
			// get accounts
			$('.nav-container-accounts .nav-container-options-item').each(function(k, v) {
				var row = $(" \
					<tr> \
						<td><input type='checkbox' id=\"accounts[" + $(this).data('id') + "]\" name=\"accounts[" + $(this).data('id') + "]\" /></td> \
						<td>" + $(this).html() + "</td> \
					</tr> \
				");
				$('#map-accounts').append(row);
			});

			updateMonForm(fields['pokemon']);

			$('.sub-nav-form').hide();
			$('.sub-nav-form-map').show();
		}

		// Set fields on form
		$.each(fields, function(input, value) {
			input = input.replace('[', '\\[').replace(']', '\\]');
			if ($('.sub-nav #' + input).attr("type") == "checkbox") {
				$('.sub-nav #' + input).prop('checked', value == "on");
			} else {
				$('.sub-nav #' + input).val(value);
			}
		});

		$('.sub-nav-header').text('Editing "' + fields['name'] + '"');
	}
});
