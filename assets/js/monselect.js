$().ready(function() {

	$('.btn-pokemon-select').on('click', function() {
		$('.mon-select-modal').parent().show();
	});

	$('.mon-select-modal-images-item').on('click', function() {
		$(this).toggleClass('mon-select-modal-images-item--active');
		updateMonForm();
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

		updateMonForm($(this).data('mon'));
	});
});
