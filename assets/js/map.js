$().ready(function() {

});

function initMap() {
	map = new google.maps.Map(document.getElementById('map'), {
		center: {lat: 42.280267, lng: -83.7435712},
		zoom: 14,
		streetViewControl: false,
		fullscreenControl: false,
		mapTypeControl: true,
		mapTypeControlOptions: {
			style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
			position: google.maps.ControlPosition.TOP_RIGHT
		},
	});

	var rectangle = new google.maps.Rectangle({
		strokeColor: '#ffcb05',
		strokeOpacity: 0.8,
		strokeWeight: 2,
		fillOpacity: 0,
		map: map,
		bounds: {
			north: 42.293110,
			south: 42.260220,
			east: -83.713523,
			west: -83.770088
		}
	});
}
