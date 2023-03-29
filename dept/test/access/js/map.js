google.maps.event.addDomListener(window, 'load', function() {
	var mapdiv = document.getElementById('map_canvas');
	var map_center = new google.maps.LatLng(43.041426,141.350414);
	var myOptions = {
		center: map_center,
		zoom: 17,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	var map = new google.maps.Map(mapdiv, myOptions);

	var marker = new google.maps.Marker({
		position: map_center,
		map: map, 
		title: 'メンズサロン kei'
	});
	var infowindow = new google.maps.InfoWindow({
		content: '<strong>メンズサロン kei</strong><br /><address>札幌市中央区南14条西7丁目2-3</address>TEL：011-512-7472',
		size: new google.maps.Size(500, 150)
	});
	google.maps.event.addListener(marker, 'click', function() {
		infowindow.open(map,marker);
	});
});
