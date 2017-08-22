$().ready(function() {

});

function initMap() {
	map = new google.maps.Map(document.getElementById('map'), {
		center: {lat: 42.280267, lng: -83.7435712},
		zoom: 15
	});
}
