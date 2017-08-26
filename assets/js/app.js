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
					$('.sub-nav .message').addClass('message-error');
					$('.sub-nav .message').html(data.output);
				}
			}
		});
	});
});
