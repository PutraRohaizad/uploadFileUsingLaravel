@extends('layout')

@if(session('success'))
<div class="alert alert-success">{{session('success')}}</div>
@endif

@section('content')
<div class="jumbotron m-5">
    <form method="POST" enctype="multipart/form-data">
        @csrf
        <label for="upload">Upload Your file here..</label>
        <input class="form-control" name="name" type="text" placeholder="Enter File Name Here ...">
        <input class="form-control" name="file" type="file">

        <div class="text-center">
            <button class="btn btn-primary m-2">Save</button>
        </div>
    </form>
</div>
<div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">File Name</th>
                <th scope="col">File</th>
            </tr>
        </thead>
        @forelse ($files as $file)
        <tbody>
            <th scope="row">{{$loop->index +1}}</th>
            <td>{{$file->name}}</td>
            <td>{{$file->file}}</td>
        </tbody>
        @empty
        <td colspan="999" class="alert alert-warning">No Record</td>
        @endforelse
    </table>
</div>
@endsection