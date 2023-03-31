@extends('main')
@section('extra-content')

@if (session('denegar'))
  <script>
    mensaje = {!! json_encode(session('denegar'), JSON_HEX_TAG) !!};
    alertify.success(mensaje);
  </script>
@endif

@endsection
@include('common')
