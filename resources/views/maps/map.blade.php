@extends('master')
@section('content')

<div class="section">
  <div id="map-canvas" class="map"></div>
  <br>
  <fieldset>
    <legend>Get Coordinates by Address</legend>
    <div class="row">
      <div class="input-field col s12">
        <input placeholder="" id="address" name="address" type="text" class="validate">
        <label for="address">Address</label>
        <p></p>
        {!! $errors->first('lat', '<p class="text-danger" style="padding:1em;">:message</p>') !!}
      </div>
    </div>
    <div class="row center">
      <button class="btn btn-success" onclick="getCoordinatesByAddress(true);">Fetch</button>
    </div>
  </fieldset>
  <br>
  {!! Form::open([ 'action' => 'MapController@createEvent', 'class' => 'clearfix', 'style' => '']) !!}
  {!! Form::hidden('map_id', $map->id) !!}
    <fieldset>
      <legend>Add Event</legend>
      <div class="row">
        <div class="input-field col s3">
          <input placeholder="" id="lat" name="lat" type="text" class="validate">
          <label for="lat">Latitude</label>
          {!! $errors->first('lat', '<p class="text-danger" style="padding:1em;">:message</p>') !!}
        </div>
        <div class="input-field col s3">
          <input placeholder="" id="lng" name="lng" type="text" class="validate">
          <label for="lng">Longitude</label>
          {!! $errors->first('lng', '<p class="text-danger" style="padding:1em;">:message</p>') !!}
        </div>
        <div class="input-field col s3">
          <input placeholder="" id="date_occurred" type="text" name="date_occurred" class="validate">
          <label for="date_occurred">Date/Time Occurred</label>
        </div>
        <div class="input-field col s3">
          <select name="marker_id">
            <option value="" disabled selected></option>
            @foreach($markers as $marker)
              <option value="{!! $marker->id !!}">{!! $marker->type . " -  " . $marker->letter . " - " . $marker->color!!}</option>
            @endforeach
          </select>
          <label>Marker Type</label>
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
        <button class="btn btn-success" type="submit">Add</button>
      </div>
    </fieldset>
  <br>
  {!! Form::close() !!}

  {!! Form::open([ 'action' => 'MapController@createMarker', 'class' => 'clearfix', 'style' => '']) !!}
  {!! Form::hidden('map_id', $map->id) !!}
  <fieldset>
    <legend>Create Marker</legend>
    <div class="row">
      <div class="input-field col s4">
        <input placeholder="" id="type" name="type" type="text" class="validate">
        <label for="type">Type</label>
        {!! $errors->first('type', '<p class="text-danger" style="padding:1em;">:message</p>') !!}
      </div>
      <div class="input-field col s3">
        <select name="letter">
          <option value="" disabled selected></option>
          <option value="A">A</option>
          <option value="B">B</option>
          <option value="C">C</option>
          <option value="D">D</option>
          <option value="E">E</option>
          <option value="F">F</option>
          <option value="G">G</option>
          <option value="H">H</option>
          <option value="I">I</option>
          <option value="J">J</option>
          <option value="K">K</option>
          <option value="L">L</option>
          <option value="M">M</option>
          <option value="N">N</option>
          <option value="O">O</option>
          <option value="P">P</option>
          <option value="Q">Q</option>
          <option value="R">R</option>
          <option value="S">S</option>
          <option value="T">T</option>
          <option value="U">U</option>
          <option value="V">V</option>
          <option value="W">W</option>
          <option value="X">X</option>
          <option value="Y">Y</option>
          <option value="Z">Z</option>
        </select>
        <label>Marker Letter</label>
      </div>
      <div class="input-field col s3">
        <select name="color">
          <option value="" disabled selected></option>
          <option value="blue">blue</option>
          <option value="brown">brown</option>
          <option value="darkgreen">dark green</option>
          <option value="green">green</option>
          <option value="orange">orange</option>
          <option value="paleblue">pale blue</option>
          <option value="pink">pink</option>
          <option value="purple">purple</option>
          <option value="red">red</option>
          <option value="yellow">yellow</option>
        </select>
        <label>Marker Color</label>
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

{{--<script>--}}
  {{--$( document ).ready(function() {--}}
    {{--$('.datepicker').pickadate({--}}
      {{--selectMonths: true, // Creates a dropdown to control month--}}
      {{--selectYears: 15 // Creates a dropdown of 15 years to control year--}}
    {{--});--}}
  {{--});--}}
{{--</script>--}}

<link rel="stylesheet" type="text/css" href="{!! asset('datetimepicker/jquery.datetimepicker.css') !!}"/ >
{{--<script src="{!! asset('datetimepicker/jquery.js') !!}"></script>--}}
<script src="{!! asset('datetimepicker/build/jquery.datetimepicker.full.min.js') !!}"></script>

<script>
  {{--initialize select inputs--}}
  $(document).ready(function() {
    $('select').material_select();
  });
  {{--initialize date picker--}}
  jQuery('#date_occurred').datetimepicker();

  {{--setting javascript variables for map stuff--}}
  mapLat = <?php echo json_encode($map->lat); ?>;
  mapLng = <?php echo json_encode($map->lng); ?>;
  events = <?php echo json_encode($map->events); ?>;
  markerArray = <?php echo json_encode($markerArray); ?>;
</script>

<script type="text/javascript" src="{!! asset('customJavascript/getCoordinatesByAddress.js') !!}"></script>
<script type="text/javascript" src="{!! asset('customJavascript/generateMap.js') !!}"></script>
<script type="text/javascript" src="{!! asset('customJavascript/plotMarkers.js') !!}"></script>

@endsection