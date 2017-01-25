<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
  <meta charset="utf-8">
  <title>Geocoding service</title>
  <style>
    html, body, #map-canvas
    {
      height: 50%;
      margin: 0px;
      padding: 0px
    }
  </style>
  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
  <script>
    //global variables
    var geocoder;
    var map;
    var Ireland = "Washington D.C.";

    function initialize()
    {
      geocoder = new google.maps.Geocoder();
      var latlng = new google.maps.LatLng(53.3496, -6.3263);
      var mapOptions =
      {
        zoom: 8,
        center: latlng
      }
      map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
      codeAddress(Ireland);//call the function
    }

    function codeAddress(address)
    {
      geocoder.geocode( {address:address}, function(results, status)
      {
        if (status == google.maps.GeocoderStatus.OK)
        {
          var myJSONText = JSON.stringify(results);
          alert(myJSONText);
          alert(results[0].geometry.location.lat());
//          map.setCenter(results[0].geometry.location);//center the map over the result
//          //place a marker at the location
//          var marker = new google.maps.Marker(
//                  {
//                    map: map,
//                    position: results[0].geometry.location
//                  });
        } else {
          alert('Geocode was not successful for the following reason: ' + status);
        }
      });
    }

    google.maps.event.addDomListener(window, 'load', initialize);

  </script>
</head>
<body>
<div id="map-canvas"></div>
</body>
</html>