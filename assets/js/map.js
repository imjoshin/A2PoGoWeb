var map;
var shapes = [];

function initMap() {
	map = new google.maps.Map(document.getElementById('map-container-object'), {
		center: {lat: 42.280267, lng: -83.7595712},
		zoom: 14,
		zoomControl: false,
		streetViewControl: false,
		fullscreenControl: false,
		mapTypeControl: true,
		mapTypeControlOptions: {
			style: google.maps.MapTypeControlStyle.DEFAULT,
			position: google.maps.ControlPosition.RIGHT_BOTTOM
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

	var centerControlDiv = document.createElement('div');
	var addRectControl = createControl('<i class="fa fa-plus-square-o"></i>', "Add a rectangle to the map", addRect);
	var removeRectControl = createControl('<i class="fa fa-minus-square-o"></i>', "Remove the last rectangle from the map", removeShape);
	var trashControl = createControl('<i class="fa fa-trash-o"></i>', "Remove all shapes from the map", removeAllShapes);

	centerControlDiv.appendChild(addRectControl);
	centerControlDiv.appendChild(removeRectControl);
	centerControlDiv.appendChild(trashControl);
	centerControlDiv.className += ' map-container-control';

	centerControlDiv.index = 1;
	map.controls[google.maps.ControlPosition.TOP_CENTER].push(centerControlDiv);
}

function addRect() {
	var center = map.getCenter();

	var rect = new google.maps.Rectangle({
		type: 'rect',
		strokeColor: '#EA231C',
		strokeOpacity: 0.8,
		strokeWeight: 2,
		fillColor: '#EA231C',
		fillOpacity: 0.15,
		editable: true,
		draggable: true,
		map: map,
		bounds: {
			north: center.lat() + 0.005,
			south: center.lat() - 0.005,
			east: center.lng() + 0.014,
			west: center.lng() - 0.002
		}
	});

	shapes.push(rect);
}

function removeShape() {
	if (shapes.length) {
		var shape = shapes.pop();
		shape.setMap(null);
	}
}

function removeAllShapes() {
	$.each(shapes, function(k, shape) {
		shape.setMap(null);
	});
	shapes = [];
}

function createControl(text, title, callback) {
	// Set CSS for the control border.
	var controlUI = document.createElement('div');
	controlUI.title = title;
	controlUI.className += ' map-container-control-center';

	// Set CSS for the control interior.
	var controlText = document.createElement('div');
	controlText.innerHTML = text;
	controlText.className += ' map-container-control-center-text';
	controlUI.appendChild(controlText);

	controlUI.addEventListener('click', callback);
	return controlUI;
}

function showMapDrawing(rects) {
	$('.map-container-control').addClass('map-container-control--active');

	// $.each(rects, function(k, rect) {
	//
	// });
}

function hideMapDrawing() {
	$('.map-container-control').removeClass('map-container-control--active');
	removeAllShapes();
}

function getRects() {
	var ret = [];
	$.each(shapes, function(k, shape) {
		if (shape.type = 'rect') {
			var bounds = shape.getBounds();
			var ne = bounds.getNorthEast();
			var sw = bounds.getSouthWest();
			ret.push({
				'max_lat': ne.lat(),
				'min_lat': sw.lat(),
				'max_lng': ne.lng(),
				'min_lng': sw.lng(),
			});
		}
	});
	return ret;
}
