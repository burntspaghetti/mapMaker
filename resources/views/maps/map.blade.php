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
      <button class="btn btn-success" onclick="getCoordinatesByAddress();">Fetch</button>
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
          <select>
            <option value="" disabled selected></option>
            @foreach($markers as $marker)
              <option value="{!! $marker->id !!}">{!! $marker->type !!}</option>
            @endforeach
          </select>
          <label>Materialize Select</label>
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
  $(document).ready(function() {
    $('select').material_select();
  });
  jQuery('#date_occurred').datetimepicker();
</script>

<script type="text/javascript" src="{!! asset('customJavascript/getCoordinatesByAddress.js') !!}"></script>
<script>
  lat = <?php echo json_encode($map->lat); ?>;
  lng = <?php echo json_encode($map->lng); ?>;
</script>
<script type="text/javascript" src="{!! asset('customJavascript/generateMap.js') !!}"></script>

@endsection