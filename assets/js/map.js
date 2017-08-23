$().ready(function() {

});

function initMap() {
	map = new google.maps.Map(document.getElementById('map'), {
		center: {lat: 42.280267, lng: -83.7435712},
		zoom: 15,
		streetViewControl: false,
		fullscreenControl: false,
		mapTypeControl: true,
		mapTypeControlOptions: {
			style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
			position: google.maps.ControlPosition.TOP_RIGHT
		},
	});
}
