@extends('admin.layout.master')
@section('header')
Product Index Page
@endsection
@section('content')

<style>
td,th {
  white-space: normal !important;
  word-wrap: break-word;
}
table {
  table-layout: fixed;
}
</style>

<div>
    <a href="{{route('product.create')}}" class="btn btn-success">Create</a>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Stock</th>
            <th>Sale Price</th>
            <th>Discounted Price</th>
            <th>Add/Remove</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $d)
        <tr>
            <td><img src="{{$d->image_url}}" alt="" style="width: 50px"></td>
            <td>{{$d->name}}</div></td>
            <td>{{$d->stock_qty}}</td>
            <td>{{$d->sale_price}}</td>
            <td>{{$d->discounted_price}}</td>
            <td>
                <a href="{{route('product-transaction.create').'$pid='.$d->id}}" class="btn btn-warning">+</a>
                <a href="" class="btn btn-outline-warning">-</a>
            </td>
            <td class="d-flex">
                <a href="{{route('product.edit',$d->id)}}" class="btn btn-primary">Edit</a>
                <form method="POST" action="{{route('product.destroy',$d->id)}}">
                @csrf @method('DELETE')
                <input type="submit" value="Delete" class="btn btn-danger">
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
