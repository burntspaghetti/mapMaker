for (i = 0; i < events.length; i++) {
    var image = '../GoogleMapsMarkers/' + markerArray[events[i].marker_id].color + '_Marker' + markerArray[events[i].marker_id].letter + '.png';
    var eventLatLng = {lat: parseFloat(events[i].lat), lng: parseFloat(events[i].lng)};
    var marker = new google.maps.Marker({
        position: eventLatLng,
        map: map,
        title: events[i].details,
        icon: image
    });
}