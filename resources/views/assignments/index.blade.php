@extends('assignments.layout')
     
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Create Assignment</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('assignments.create') }}"> Create Assignment</a>
            </div>
        </div>
    </div>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
     
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Title</th>
            <th>Description</th>
            <th>Due Date</th>
            <!-- <th>File</th> -->
            <th width="280px">Action</th>
        </tr>
        @foreach ($assignment as $assi)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $assi->title }}</td>
            <td>{{ $assi->description }}</td>
            <td>{{ $assi->due_date }}</td>
            <!-- <td><file src="/images/{{ $assi->file_path }}" width="100px"></td> -->
            <td>
                <form action="{{ route('assignments.destroy',$assi->id) }}" method="POST">
     
                    <a class="btn btn-info" href="{{ route('assignments.show',$assi->id) }}">Show</a>
      
                    <a class="btn btn-primary" href="{{ route('assignments.edit',$assi->id) }}">Edit</a>
     
                    @csrf
                    @method('DELETE')
        
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    
    {!! $assignment->links() !!}
        
@endsection