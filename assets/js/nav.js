$().ready(function() {
	$.fn.extend({
		openNavElement: function() {
			if ($(this).is('.btn-add')) {
				openAdd($(this));
			} else if ($(this).is('.nav-tabs-container-item')) {
				openItem($(this));
			}

			openView($(this));
		}
	});

	// Main header
	function openView(view) {
		viewContainer = $('.nav-tabs-container[data-view="' + view.data('view') + '"]');
		viewContainer.find('.message').empty();
		activeContainer = $('.nav-tabs-container--active');

		if ($('.nav-tabs-container').index(viewContainer) < $('.nav-tabs-container').index(activeContainer)) {
			viewContainer.removeClass("nav-tabs-container--left nav-tabs-container--active nav-tabs-container--right");
			activeContainer.removeClass("nav-tabs-container--left nav-tabs-container--active nav-tabs-container--right");
			activeContainer.addClass("nav-tabs-container--right");
		} else if($('.nav-tabs-container').index(viewContainer) > $('.nav-tabs-container').index(activeContainer)) {
			viewContainer.removeClass("nav-tabs-container--left nav-tabs-container--active nav-tabs-container--right");
			activeContainer.removeClass("nav-tabs-container--left nav-tabs-container--active nav-tabs-container--right");
			activeContainer.addClass("nav-tabs-container--left");
		}

		if (view.is('.nav-tabs-item')) {
			if (!view.hasClass('nav-tabs-item--active')) {
				var tabIndex = $('.nav-tabs-item').index(view);
				$('.nav-tabs-track-slider').attr('data-place', tabIndex + 1);
				$('.nav-tabs-item--active').removeClass('nav-tabs-item--active');
				activeContainer.removeClass('nav-tabs-container--active');
			}

			view.addClass('nav-tabs-item--active');
		}

		viewContainer.addClass('nav-tabs-container--active');
	}


	function openAdd(button) {
		// new map/account
		window.new = true;
		$('.nav-form').trigger("reset");

		if (button.parents('[data-view="accounts"]').length) {
			$('.nav-form-address-verification .btn').show();
			$('#verification').hide();
		} else if (button.parents('[data-view="maps"]').length) {
			$('#map-accounts').empty();
			updateMonForm('-1');
			// get accounts
			$('[data-view="accounts"] .nav-tabs-container-item:not(.nav-tabs-container-item-template)').each(function(k, v) {
				var fields = $.parseJSON($(this).attr('data-fields'));
				var row = $(" \
					<tr> \
						<td><input type='checkbox' id=\"accounts[" + fields['id'] + "]\" name=\"accounts[" + fields['id'] + "]\" /></td> \
						<td>" + fields['name'] + "</td> \
					</tr> \
				");
				$('#map-accounts').append(row);
			});
		}

		$('.formatter').keyup();
		$('.nav-form select').change();
		$('.non-editable-input').prop('disabled', false);
		$('.hidden-edit-input').show();
	}

	// Map/Account item
	function openItem(item) {
		// not new map/account
		var fields = $.parseJSON(item.attr('data-fields'));
		window.new = false;
		window.id = fields['id'];
		$('.nav-form').trigger("reset");

		if (item.parents('[data-view="accounts"]').length) {
			$('.nav-form-address-verification .btn').show();
			$('#verification').hide();
		} else if (item.parents('[data-view="maps"]').length) {
			$('#map-accounts').empty();

			// get accounts
			$('[data-view="accounts"] .nav-tabs-container-item:not(.nav-tabs-container-item-template)').each(function(k, v) {
				var fields = $.parseJSON($(this).attr('data-fields'));
				var row = $(" \
					<tr> \
						<td><input type='checkbox' id=\"accounts[" + fields['id'] + "]\" name=\"accounts[" + fields['id'] + "]\" /></td> \
						<td>" + fields['name'] + "</td> \
					</tr> \
				");
				$('#map-accounts').append(row);
			});

			updateMonForm(fields['pokemon']);
		}

		// Set fields on form
		$.each(fields, function(input, value) {
			input = input.replace('[', '\\[').replace(']', '\\]');
			if ($('[id = ' + input + ']').attr("type") == "checkbox") {
				$('[id = ' + input + ']').prop('checked', value == "on");
			} else {
				$('[id = ' + input + ']').val(value);
			}
		});

		$('.formatter').keyup();
		$('.nav-form select').change();
		$('.non-editable-input').prop('disabled', true);
		$('.hidden-edit-input').hide();
	}
});
