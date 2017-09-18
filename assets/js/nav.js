$().ready(function() {

	var nav = $('.nav')[0];

	$.fn.extend({
		openNavElement: function() {
			openView($(this));

			if ($(this).is('.btn-add')) {
				$('.sub-nav-form').trigger("reset");
				$('.formatter').keyup();
				openAdd($(this));
			} else if ($(this).is('.nav-tabs-container-item')) {
				openItem($(this));
			}

			$('.sub-nav-form select').change();
		}
	});

	// Main header
	function openView(view) {
		viewContainer = $('.nav-tabs-container[data-view="' + view.data('view') + '"]');
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

		if (button.parents('[data-view="maps"]').length) {
			$('#map-accounts').empty();
			// get accounts
			console.log("starting");
			$('[data-view="accounts"] .nav-tabs-container-item').each(function(k, v) {
				console.log(k + ", " + v);
				var row = $(" \
					<tr> \
						<td><input type='checkbox' name=\"accounts[" + $(this).data('id') + "]\" /></td> \
						<td>" + $(this).attr('data-fields')['name'] + "</td> \
					</tr> \
				");
				$('#map-accounts').append(row);
			});
		}
	}

	// Map/Account item
	function openItem(item) {
		// not new map/account
		var fields = $.parseJSON(item.attr('data-fields'));
		window.new = false;
		window.id = fields['id'];

		if (item.parents('[data-view="accounts"]').length) {
			$('.sub-nav #type').trigger('change');

			$('.sub-nav-form').hide();
			$('.sub-nav-form-account').show();

		} else if (item.parents('[data-view="maps"]').length) {
			$('#map-accounts').empty();
			// get accounts
			$('.nav-container-accounts .nav-tabs-container-item').each(function(k, v) {
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
			if ($('#' + input).attr("type") == "checkbox") {
				$('#' + input).prop('checked', value == "on");
			} else {
				$('#' + input).val(value);
			}
		});
	}
});
