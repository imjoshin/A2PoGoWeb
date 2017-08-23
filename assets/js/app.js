$().ready(function() {

	$('.nav-container').on('click', function() {
		$('.nav-options').slideUp(300);
		$(this).find('.nav-container-options').slideDown(300);
	});
});
