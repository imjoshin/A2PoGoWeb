$().ready(function() {

	$('.btn-pokemon-select').on('click', function() {
		$('.mon-select-modal').parent().show();
	});

	$('.mon-select-modal-images-item').on('click', function() {
		$(this).toggleClass('mon-select-modal-images-item--active');
		updateForm();
	});

	$('.mon-select-modal-categories .btn').on('click', function() {
		if ($(this).data('mon') == 'all') {
			$('.mon-select-modal-images-item').addClass('mon-select-modal-images-item--active');
		} else if ($(this).data('mon') == 'none') {
			$('.mon-select-modal-images-item').removeClass('mon-select-modal-images-item--active');
		} else {
			$('.mon-select-modal-images-item').removeClass('mon-select-modal-images-item--active');

			var pokemon = $(this).data('mon').split(',');
			$.each(pokemon, function(key, value) {
				$('.mon-select-modal-images-item').eq(parseInt(value) - 1).addClass('mon-select-modal-images-item--active');
			});
		}

		updateForm($(this).data('mon'));
	});

	function updateForm(pokemon) {
		pokemon = pokemon || "";
		var buttonText = 'Select Pokemon' + ($('.mon-select-modal-images-item--active').length > 0 ? ' (' + $('.mon-select-modal-images-item--active').length + ')' : '');
		$('.btn-pokemon-select').html(buttonText);

		if (!pokemon.length) {
			$.each($(".mon-select-modal-images-item--active"), function(k, v) {
				pokemon += ($(this).index('.mon-select-modal-images-item') + 1) + ",";
			});
		}

		$('#pokemon-selected').val(pokemon);
	}
});
