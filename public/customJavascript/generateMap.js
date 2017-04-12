alert(lat);

var mapCoordinates = new google.maps.LatLng( lat, lng );

var myOptions = {
    zoom: 14,
    center: mapCoordinates,
    mapTypeId: google.maps.MapTypeId.ROADMAP
};

var map = new google.maps.Map( document.getElementById( 'map-canvas' ), myOptions );