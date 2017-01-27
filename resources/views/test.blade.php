@extends('master')
@section('content')


  <input id="datetimepicker" type="text" >
        <!-- this should go after your </body> -->
<link rel="stylesheet" type="text/css" href="{!! asset('datetimepicker/jquery.datetimepicker.css') !!}"/ >
{{--<script src="{!! asset('datetimepicker/jquery.js') !!}"></script>--}}
<script src="{!! asset('datetimepicker/build/jquery.datetimepicker.full.min.js') !!}"></script>

  <script>
    jQuery('#datetimepicker').datetimepicker();
  </script>

@endsection