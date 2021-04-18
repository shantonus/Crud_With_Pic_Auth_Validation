@extends('layouts.app')

@section('content')
    
<form method="post" action="{{ url('edit_success/'.$data->id) }}" enctype="multipart/form-data">
    <div class="modal-body">

        @csrf

        <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{ $data->Name }}">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $data->Email }}">
        </div>
        <div class="form-group">
        <label>Age</label>
        <input type="number" name="age" class="form-control" value="{{ $data->Age }}">
        </div>
        <div class="form-group">
        <label>Old Image</label>
        <img src="{{ url($data->Image) }}" style="height: 60px; width: auto"> <br> <br>
        <input name="image" class="form-control" type="file">
        </div>
        <div class="form-group">
        <label>Description</label>
        <textarea name="description" class="form-control" rows="4">{{ $data->Description }}</textarea>
        </div>
        </div>
        <div class="modal-footer">
        <a type="button" href="{{ url('/') }}" class="btn btn-secondary">Back</a>
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
        </div>
</form>

@endsection