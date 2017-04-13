function getCoordinatesByAddress(isMapPresent)
{
    address = document.getElementById('address');
    if(address.value)
    {
        geocoder = new google.maps.Geocoder();
        geocoder.geocode( {address:address.value}, function(results, status)
        {
            if (status == google.maps.GeocoderStatus.OK)
            {
//          var myJSONText = JSON.stringify(results);
//          alert(myJSONText);
                lat = results[0].geometry.location.lat();
                lng = results[0].geometry.location.lng();

                if(isMapPresent == true)
                {
                    map.setCenter(results[0].geometry.location);//center the map over the result
        //          //place a marker at the location
                    var marker = new google.maps.Marker(
                        {
                            map: map,
                            position: results[0].geometry.location
                        });
                }

                //put lat and lng into input boxes
                document.getElementById("lat").value = lat;
                document.getElementById("lng").value = lng;

                var $toastContent = $('<span style="color:green;"><b>Latitude and longitude found</b></span>');
                Materialize.toast($toastContent, 6000); // 4000 is the duration of the toast

            }
            else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }
    else
    {
        var $toastContent = $('<span style="color:red;"><b>Please enter an address first.</b></span>');
        Materialize.toast($toastContent, 6000); // 4000 is the duration of the toast
    }
}