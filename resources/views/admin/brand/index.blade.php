@extends('admin.layout.master')
@section('header')
Brand Index Page
@endsection
@section('content')
<div>
    <a href="{{route('brand.create')}}" class="btn btn-success">Create</a>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $d)
        <tr>
            <td>{{$d->name}}</td>
            <td class="d-flex">
                <a href="{{route('brand.edit',$d->id)}}" class="btn btn-primary">Edit</a>
                <form method="POST" action="{{route('brand.destroy',$d->id)}}">
                @csrf @method('DELETE')
                <input type="submit" value="Delete" class="btn btn-danger">
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
