@extends('master')
@section('content')

<div class="section">
    {{--if no maps, show create map button, else show the maps--}}
    @if(count($maps) == 0)
      <div class="row">
        <div class="col s12 m6">
          <div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title">Get Started!</span>
            </div>
            <div class="card-action">
              {{--<a class="waves-effect waves-light btn">Create Map</a>--}}
              <a href="{!! action('MapController@create') !!}">Create Map</a>
            </div>
          </div>
        </div>
      </div>
    @else
      <h1>Maps</h1>
      <div class="collection">
        @foreach($maps as $map)
          <a href="#" class="collection-item">{!! $map->name !!}</a>
        @endforeach
      </div>
    @endif


</div>
<div class="section">
  <style>
    .infobox-wrapper {
      display:none;
    }
    #infobox {

    }
  </style>

  <div id="map-canvas" class="map"></div>


</div>
<br><br>
<style>
  .map {
    width: 100%;
    height: 350px;
    display: block;
  }
</style>

<script>
  function initialize() {
    var events = <?php echo json_encode($events); ?>;
    var count = events.length;

    var uaCampusCoordinates = new google.maps.LatLng( 33.211655052789496, -87.53979206085205 );
    var myOptions = {
      zoom: 14,
      center: uaCampusCoordinates,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map( document.getElementById( 'map-canvas' ), myOptions );

    for(x = 0; x < count; x++)
    {
      var coordinates = new google.maps.LatLng( parseFloat(events[x].lat), parseFloat(events[x].lng) );
      var markerTitle = events[x].type;
      var infoBoxContent = events[x].details;

      marker = createMarker(map, coordinates, markerTitle);
      infobox = createInfoBox(infoBoxContent, coordinates);
      listener = createListener(map, marker, infobox, coordinates);
    }
  }

  google.maps.event.addDomListener(window, 'load', initialize);

  function createMarker(map, coordinates, markerTitle)
  {
    marker = new MarkerWithLabel({
      title: markerTitle,
      clickable: true,
      position: coordinates,
      icon: ' ',
      map: map,
      labelContent: '<a type="button" class="btn btn-transparent fa fa-ambulance" style="color:rgba(144,15,15,0.8);"></a>',
      labelClass: "labels" // the CSS class for the label
    });

    marker.setMap( map );

    return marker;
  }

  function createInfoBox(infoBoxContent, coordinates)
  {
    infobox = new InfoBox({
      content: infoBoxContent,
      position: coordinates,
      disableAutoPan: true,
      isHidden: false,
      maxWidth: 150,
      pane: "floatPane",
      enableEventPropagation: true,
      pixelOffset: new google.maps.Size(-140, 0),
      //could do a counter for z index to make more relevant markers show up on top, just remember to sort according to relevancy first
      zIndex: null,
      boxStyle: {
        border: "2px solid black",
        background: "#333",
        color: "#FFF",
        opacity: 0.85,
        padding: ".5em 1em",
        width: "200px",
      },
      closeBoxMargin: "2px 2px 2px 2px",
      closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif",
      infoBoxClearance: new google.maps.Size(1, 1)
    });

    return infobox;
  }

  function createListener(map, marker, infobox, coordinates)
  {
    listener = marker.addListener('click', function() {
      infobox.open(map, this);
      map.panTo(coordinates);
    });

    return listener;
  }

</script>


@endsection