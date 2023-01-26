@extends('admin.layout.master')
@section('header')
Editing Product Details for {{$product->name}}
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<div>
    <a href="{{route('product.index')}}" class="btn btn-dark">Back</a>
    <a href="{{route('product.create')}}" class="btn btn-success">Create</a>
</div>

<form class="mt-3" action="{{route('product.update',$product->id)}}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="container mt-5">
        <div class="row">
        <div class="col-8">
            <div class="card card-body">
                <div class="form-group">
                    <label for="">Enter Name</label>
                    <input type="text" name="name" value="{{$product->name}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Choose Image </label>
                    <input type="file" name="image" class="form-control">
                    <img src="{{$product->image_url}}" alt="" style="width:70px" class="img-thumbnail">
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" value="{{$product->description}}" id="description" class="form-control">{{$product->description}}</textarea>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card card-body">
                <div class="form-group">
                    <label for="">Choose Category</label>
                    <select name="category_id[]" id="category" multiple class="form-control">
                    @foreach ($category as $sCategory)
                    <option value="{{$sCategory->id}}" @foreach ($product->category as $sPCategory)
                        @if ($sPCategory->id==$sCategory->id)
                        selected
                        @endif
                    @endforeach
                    >{{$sCategory->name}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                <label for="">Choose Supplier</label>
                <select name="supplier_id" class="form-control">
                    @foreach ($supplier as $sSupplier)
                    <option value="{{$sSupplier->id}}"
                        @if ($sSupplier->id==$product->supplier_id)
                            selected
                        @endif
                    >{{$sSupplier->name}}</option>
                    @endforeach
                </select>
                </div>
                <div class="form-group">
                    <label for="">Choose Brand</label>
                    <select name="brand_id" class="form-control">
                        @foreach ($brand as $sBrand)
                    <option value="{{$sBrand->id}}"
                        @if ($sBrand->id==$product->brand_id)
                            selected
                        @endif
                    >{{$sBrand->name}}</option>
                    @endforeach
                    </select>
                </div>

                <hr class="m-0 p-0">
                <small class="text-muted">Stock Information</small> <br>
                <div class="form-group">
                    <label for="">Sale Price</label>
                    <input type="number" value="{{$product->sale_price}}" name="sale_price"class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Discounted Price</label>
                    <input type="number" value="{{$product->discounted_price}}" name="discounted_price"class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Stock Qty</label>
                    <input type="text" name="stock_qty" value="{{$product->stock_qty}}" id="" class="form-control">
                </div>

                <input type="submit" value="Edit" class="btn btn-dark btn-block">
                </div>
            </div>

        </div>
    </div>

</form>
@endsection
@section('js')

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(function(){
        $('#description').summernote({
            placeholder:"Enter description"
        })

        $('#category').select2();
    })
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
