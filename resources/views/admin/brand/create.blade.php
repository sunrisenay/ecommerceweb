@extends('admin.layout.master')
@section('header')
Creating New Brand 
@endsection
@section('content')
<div>
    <a href="{{route('brand.index')}}" class="btn btn-dark">Back</a>
    <a href="{{route('brand.create')}}" class="btn btn-success">Create</a>
</div>

<form class="mt-3" action="{{route('brand.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="">Enter Name</label>
        <input type="text" name="name" id="" class="form-control">
    </div>
    <input type="submit" value="Create" class="btn btn-dark">
</form>
@endsection
