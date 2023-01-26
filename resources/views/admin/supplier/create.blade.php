@extends('admin.layout.master')
@section('content')
<div>
    <a href="{{route('supplier.index')}}" class="btn btn-dark">Back</a>
    <a href="{{route('supplier.create')}}" class="btn btn-success">Create</a>
</div>

<form class="mt-3" action="{{route('supplier.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="">Enter Name</label>
        <input type="text" name="name" id="" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Enter Phone</label>
        <input type="text" name="phone" id="" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Choose Image</label>
        <input type="file" name="image" class="form-control">
    </div>
    <input type="submit" value="Create" class="btn btn-dark">
</form>
@endsection
