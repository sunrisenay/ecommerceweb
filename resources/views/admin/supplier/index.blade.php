@extends('admin.layout.master')
@section('content')

<div>
    <a href="{{route('supplier.create')}}" class="btn btn-success">Create</a>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $d)
        <tr>
            <td><img src="{{$d->image_url}}" alt="" style="width: 50px"></td>
            <td>{{$d->name}}</td>
            <td>{{$d->phone}}</td>
            <td class="d-flex">
                <a href="{{route('supplier.edit',$d->id)}}" class="btn btn-primary">Edit</a>
                <form method="POST" action="{{route('supplier.destroy',$d->id)}}">
                @csrf @method('DELETE')
                <input type="submit" value="Delete" class="btn btn-danger">
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
