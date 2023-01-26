@extends('admin.layout.master')
@section('content')
<div>
    <a href="{{route('supplier.index')}}" class="btn btn-dark">Back</a>
    <a href="{{route('supplier.create')}}" class="btn btn-success">Create</a>
</div>

<form class="mt-3" action="{{route('supplier.update',$data->id)}}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="form-group">
        <label for="">Enter Name</label>
        <input type="text" name="name" value="{{$data->name}}" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Enter Phone Number</label>
        <input type="text" name="phone" value="{{$data->phone}}" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Choose Image</label>
        <input type="file" name="image" class="form-control">
        <img src="{{$data->image_url}}" alt="" style="width:70px" class="img-thumbnail">
    </div>
    <input type="submit" value="Update" class="btn btn-dark">
</form>
@endsection
