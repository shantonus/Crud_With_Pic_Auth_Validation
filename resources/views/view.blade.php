@extends('layouts.app')

@section('content')

<div class="text-center">
<a class="btn btn-warning" href="{{ url('/') }}">Back</a>
<br> <br>

Image: <br>
<img src="{{ url($data->Image)}}" style="height: 300px; width: auto;"> <br>
Name: {{ $data->Name }} <br>
Email: {{ $data->Email }} <br>
Age: {{ $data->Age }} <br>
Description: {!! nl2br(e($data->Description)) !!}  <!-- this code preserves spaces and line breaks from textarea field-->
<br> 
</div>

@endsection