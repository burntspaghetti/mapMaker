for (i = 0; i < events.length; i++) {
    var infowindow = new google.maps.InfoWindow({
        content: 'loading...',
    });

    //getting the appropriate marker
    var image = '../GoogleMapsMarkers/' + markerArray[events[i].marker_id].color + '_Marker' + markerArray[events[i].marker_id].letter + '.png';
    var eventLatLng = {lat: parseFloat(events[i].lat), lng: parseFloat(events[i].lng)};
    var marker = new google.maps.Marker({
        position: eventLatLng,
        map: map,
        title: events[i].details,
        icon: image,
        html: '<div id="content">'+
        '<div id="siteNotice">'+
        '</div>'+
        '<p><b>Event Type: </b>' + markerArray[events[i].marker_id].type  + '</p>'+
        '<p><b>Location: </b>' + events[i].location  + '</p>'+
        '<p><b>Date/Time: </b>' + events[i].date_occurred  + '</p>'+
        '<p><b>Description: </b>' + events[i].details  + '</p>'+
        '</div>'
    });

    //setting click listener for info window
    google.maps.event.addListener(marker, "click", function () {
        infowindow.setContent(this.html);
        infowindow.open(map, this);
    });
}