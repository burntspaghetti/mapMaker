@extends('master')
@section('content')
  
  {!! Form::open([ 'action' => 'MapController@save', 'class' => 'clearfix', 'style' => 'padding:1em 3em;']) !!}

  <!--name Form Input-->
  <div class="form-group">
      {!! Form::label('name', 'Map Name: ') !!}
      {!! Form::input('text', 'name', null, array('class' => 'form-control')) !!}
      {!! $errors->first('name', '<p class="text-danger" style="padding:1em;">:message</p>') !!}
  </div>

  <!--lat Form Input-->
  <div class="form-group">
      {!! Form::label('lat', 'Latitude: ') !!}
      {!! Form::input('text', 'lat', null, array('class' => 'form-control')) !!}
      {!! $errors->first('lat', '<p class="text-danger" style="padding:1em;">:message</p>') !!}
  </div>

  <!--lng Form Input-->
  <div class="form-group">
      {!! Form::label('lng', 'Longitude: ') !!}
      {!! Form::input('text', 'lng', null, array('class' => 'form-control')) !!}
      {!! $errors->first('lng', '<p class="text-danger" style="padding:1em;">:message</p>') !!}
  </div>

  <!--desc Form Input-->
  <div class="form-group">
      {!! Form::label('desc', 'Description: ') !!}
      {!! Form::textarea('desc', null, array('class' => 'form-control')) !!}
      {!! $errors->first('desc', '<p class="text-danger" style="padding:1em;">:message</p>') !!}
  </div>
  
  <button class="btn btn-success" type="submit">Submit</button>
  <a href="{!! action('HomeController@home') !!}" class="btn btn-danger">Cancel</a>
  
  {!! Form::close() !!}

@endsection