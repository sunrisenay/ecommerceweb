<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Trait\Image;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAddTransition;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use Image;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::orderBy('id','desc')->paginate(12);
        return view('admin.product.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brand = Brand::all();
        $supplier = Supplier::all();
        $category = Category::all();
        return view('admin.product.create',compact('brand','supplier','category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => "required",
            'image' => "required | mimes:png,jpg,jpeg,bmp,webp | max:500",
            'description' => "required",
            'brand_id'=> "required",
            'category_id.*'=> "required",
            'supplier_id'=> "required",
            'sale_price'=> "required",
            'discounted_price'=> "required",
            'stock_qty'=> "required",
        ]);
        // image-upload
        $image_name = $this->upload($request->file('image'));

        //Product table store
        $created_product = Product::create([
            'name' => $request->name,
            'image' => $image_name,
            'slug' => Str::slug($request->name).uniqid(),
            'description' => $request->description,
            'brand_id'=> $request->brand_id,
            'supplier_id'=> $request->supplier_id,
            'sale_price'=> $request->sale_price,
            'discounted_price'=> $request->discounted_price,
            'stock_qty'=> $request->stock_qty,
        ]);

        // ProductAddTransaction

        ProductAddTransition::create([
            'product_id'=>$created_product->id,
            'supplier_id' => $request-> supplier_id,
            'stock_qty' => $request -> stock_qty,
            'description' => "From Product Stored",

        ]);

        //category pivot store

        $product = Product::Find($created_product->id);
        $product->category()->sync($request->category_id);

        return redirect('/admin/product')->with('success','created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $brand = Brand::all();
        $supplier = Supplier::all();
        $category = Category::all();
        return view('admin.product.edit',compact('product','brand','supplier','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => "required",
            'description' => "required",
            'brand_id'=> "required",
            'category_id.*'=> "required",
            'supplier_id'=> "required",
            'sale_price'=> "required",
            'discounted_price'=> "required",
            'stock_qty'=> "required",
        ]);

        $product = Product::where('id',$id)->first();

        // image update
        if($file = $request->file('image'))
        {
            $this->delete($product->image);
            $image_name = $this->upload($file);
        }
        else
        {
            $image_name = $product->image;
        }
        //Product table update

        $product->update([
            'name' => $request->name,
            'image' => $image_name,
            'slug' => Str::slug($request->name).uniqid(),
            'description' => $request->description,
            'brand_id'=> $request->brand_id,
            'supplier_id'=> $request->supplier_id,
            'sale_price'=> $request->sale_price,
            'discounted_price'=> $request->discounted_price,
            'stock_qty'=> $request->stock_qty,
        ]);

        // ProductAddTransaction

        ProductAddTransition::where('id',$id)->update([
            'supplier_id' => $request-> supplier_id,
            'stock_qty' => $request -> stock_qty,
            'description' => "From Product Stored",

        ]);

        //category pivot store

        $product = Product::Find($product->id);
        $product->category()->sync($request->category_id);

        return redirect('/admin/product')->with('success','updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $product = Product::where('id', $id)->first();
        if ($product != null) {
            $product->delete();
            ProductAddTransition::where('product_id', $product->id)->delete();
            $product->category()->detach($request->category_id);
            $this->delete($product->image);
            return redirect()->back()->with('success', 'Product Deleted!');
        }
        return redirect()->back()->with('error', 'No Product Found!');



    }
}
