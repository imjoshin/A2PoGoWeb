$().ready(function() {
	// handle nav events
	$('.nav-container:not(.disabled) label, .nav-container-options-item').on('click', function() {
		$(this).openNavElement();
	});
});
