@extends('master')
@section('content')
  <h1>Create Map</h1>

  {!! Form::open([ 'action' => 'MapController@store', 'class' => 'clearfix', 'style' => 'padding:1em 3em;']) !!}
  <div class="row">
      <div class="input-field col s6">
          <input placeholder="" name="name" id="name" type="text" class="validate">
          <label for="name">Map Name</label>
          {!! $errors->first('name', '<p class="text-danger" style="padding:1em;">:message</p>') !!}
      </div>
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
  </div>
  <div class="row">
      <div class="input-field col s12">
          <textarea placeholder="" id="desc" name="desc" type="text" class="materialize-textarea validate"></textarea>
          <label for="desc">Description</label>
          {!! $errors->first('desc', '<p class="text-danger" style="padding:1em;">:message</p>') !!}
      </div>
  </div>
  <button class="waves-effect waves-light btn" type="submit">Submit</button>
  <a href="{!! action('HomeController@home') !!}" class="waves-effect waves-light btn">Cancel</a>
  
  {!! Form::close() !!}

@endsection