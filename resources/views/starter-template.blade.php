<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Starter Template - Materialize</title>

  <!-- google maps stuff -->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="//maps.google.com/maps/api/js?sensor=true"></script>
  <script src="{!! URL::asset('gmaps/gmaps.min.js') !!}"></script>
  <script type="text/javascript" src="{!! asset('v3-utility-library/markerwithlabel/src/markerwithlabel.js') !!}"></script>
  <script type="text/javascript" src="{!! asset('v3-utility-library/infobox/src/infobox.js') !!}"></script>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="{!! asset('starter-template/css/materialize.css') !!}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="{!! asset('starter-template/css/style.css') !!}" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <nav class="teal lighten-2" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">Logo</a>
      <ul class="right hide-on-med-and-down">
        <li><a href="#">Navbar Link</a></li>
      </ul>

      <ul id="nav-mobile" class="side-nav">
        <li><a href="#">Navbar Link</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h1 class="header center">Map Maker</h1>
    </div>
  </div>


  <div class="container">
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

    <div class="section">

    </div>
  </div>

  <footer class="page-footer teal">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Company Bio</h5>
          <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>


        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Settings</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Connect</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">

      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="{!! asset('starter-template/js/materialize.js') !!}"></script>
  <script src="{!! asset('starter-template/js/init.js') !!}"></script>

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



  </body>
</html>
