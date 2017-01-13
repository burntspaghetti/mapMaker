@extends('master')
@section('content')

<div class="section">
  <style>
    .infobox-wrapper {
      display:none;
    }
    #infobox {

    }
  </style>

  <div id="map-canvas" class="map"></div>

  {!! Form::open([ 'action' => 'MapController@createEvent', 'class' => 'clearfix', 'style' => 'padding:1em 3em;']) !!}
  {!! Form::hidden('map_id', $map->id) !!}
    <fieldset>
      <legend>Add Event</legend>
      <div class="row">
        <div class="input-field col s4">
          <input placeholder="" id="lat" name="lat" type="text" class="validate">
          <label for="lat">Latitude</label>
          {!! $errors->first('lat', '<p class="text-danger" style="padding:1em;">:message</p>') !!}
        </div>
        <div class="input-field col s4">
          <input placeholder="" id="lng" name="lng" type="text" class="validate">
          <label for="lng">Longitude</label>
          {!! $errors->first('lng', '<p class="text-danger" style="padding:1em;">:message</p>') !!}
        </div>
        <div class="input-field col s4">
          <input type="date" class="datepicker">
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12">
          <textarea placeholder="" id="details" name="details" type="text" class="materialize-textarea validate"></textarea>
          <label for="details">Details</label>
          {!! $errors->first('details', '<p class="text-danger" style="padding:1em;">:message</p>') !!}
        </div>
      </div>

      <div class="row center">
        <button class="btn btn-success" type="submit">Create</button>
      </div>
    </fieldset>
  <br>
  {!! Form::close() !!}

  {!! Form::open([ 'action' => 'MapController@createMarker', 'class' => 'clearfix', 'style' => 'padding:1em 3em;']) !!}
  {!! Form::hidden('map_id', $map->id) !!}
  <fieldset>
    <legend>Create Marker</legend>
    <div class="row">
      <div class="input-field col s4">
        <input placeholder="" id="type" name="type" type="text" class="validate">
        <label for="lat">type</label>
        {!! $errors->first('type', '<p class="text-danger" style="padding:1em;">:message</p>') !!}
      </div>
      <div class="input-field col s8">
        <input placeholder="" id="html" name="html" type="text" class="validate">
        <label for="html">HTML</label>
        {!! $errors->first('html', '<p class="text-danger" style="padding:1em;">:message</p>') !!}
      </div>
    </div>
    <div class="row center">
      <button class="btn btn-success" type="submit">Create</button>
    </div>
  </fieldset>
  <br>
  {!! Form::close() !!}

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
  $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });
</script>

<script>
  function initialize() {
    var events = <?php echo json_encode($map->events); ?>;
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