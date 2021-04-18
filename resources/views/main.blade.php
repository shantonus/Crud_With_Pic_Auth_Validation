@extends('layouts.app')
@section('content')
    
<div class="container">
    <div class="col-sm-10">
        <b>Data list</b>
        <button type="button" class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#exampleModalCenter">Add New</button>
    </div>    
    
    <br>
    <div id="valid">
        @if ($errors->any())        <!-- laravel validation method-->
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

</div>    
    <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add New Data</h5>  
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>  
          </button>  
        </div>  


            <form method="post" action="{{ url('/add') }}" enctype="multipart/form-data">
                <div class="modal-body">
            
                    @csrf

                    <div class="form-group">
                    <label>Name</label>
                    
                    <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" placeholder="Enter name...">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" i value="{{ Auth::user()->email }}" placeholder="Email...">
                    </div>
                    <div class="form-group">
                    <label>Age</label>
                    <input type="number" name="age" class="form-control" placeholder="Enter age..." value="{{ old('age') }}">
                    </div>
                    <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Enter description...">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control" rows="4"></textarea>
                    </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                    <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                    </div>
            </form>
      </div>
    </div>
  </div>
  {{-- Modal --}}
   
    {{-- View Data --}}
    <div class="container">
    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Image</th>
            <th>Action</th>
        </tr>

        @foreach($show as $row)
        
        <tr>
            <td>{{ $row->id }}</td>
            <td>{{ $row->Name }}</td>
            <td>{{ $row->Email }}</td>
            <td>{{ $row->Age }}</td>
            <td><img src="{{$row->Image}}" style="height: 50px; width: autopx"></td>
            <td>
                <a class="btn btn-primary btn-sm" href="{{ url('view/'.$row->id) }}">View</a>
                <a class="btn btn-warning btn-sm" href="{{ url('edit/'.$row->id) }}">Edit</a>
                <a class="btn btn-danger btn-sm" id="delete" href="{{ url('delete/'.$row->id) }}">Delete</a>
            </td>
        </tr>
        
        @endforeach

    </table>  
</div>
{{-- View data ends --}}

@endsection
