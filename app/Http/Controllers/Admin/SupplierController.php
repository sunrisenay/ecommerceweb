<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Trait\Image;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    use Image;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Supplier::latest()->paginate(10);
        return view('admin.supplier.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.supplier.create');
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
            'phone'=> "required",
            'image' => "required | mimes:png,jpg,jpeg,bmp,webp | max:500",
        ]);
        $image_name = $this->upload($request->file('image'));
        Supplier::create([
            'slug' => uniqid().$request->name,
            'name' => $request->name,
            'phone' => $request->phone,
            'image' => $image_name,
        ]);
        return redirect('/admin/supplier')->with('success','created');
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
        $data = Supplier::find($id);
        return view('admin.supplier.edit',compact('data'));
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
            'phone' => "required",
        ]);

        $supplier = Supplier::where('id',$id)->first();
        if($file = $request->file('image'))
        {
            $this->delete($supplier->image);
            $image_name = $this->upload($file);
        }
        else
        {
            $image_name = $supplier->image;
        }
        $supplier->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'image' => $image_name,
        ]);
        return redirect('/admin/supplier')->with('success','updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Supplier::where('id',$id)->first();
        $this->delete($data->image);
        $data->delete();
        return redirect('/admin/supplier')->with('success','deleted');
    }
}
