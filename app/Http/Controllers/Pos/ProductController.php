<?php

namespace App\Http\Controllers\Pos;

date_default_timezone_set('Asia/Dhaka');
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\Category;
use App\Models\Product;
use App\Models\Shelf;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('backend.product.product_all', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $supplier = Supplier::all();
        $unit = Unit::all();
        $category = Category::all();
        $shelf = Shelf::all();

        return view('backend.product.product_add', compact('supplier', 'unit', 'category', 'shelf'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = new Product();
         // FOR IMAGE
         $customName ="";
        if($request->file('p_image')){
            $file = $request->file('p_image');
            $customName =  date('YmdHi').'.'.$file->getClientOriginalExtension();
            //Image Intervention Package Use
            $manager = new ImageManager(new Driver());
            $file = $manager->read($file); // File Read
            $file->resize(130, 70)->save('upload/product/'.$customName); // Resize and save

        }else{
            $customName =  $product->product_image;
        }

        $result = Product::insert([
            'product_name'=> ucwords($request->productN),
            'product_sku'=> $request->p_sku,
            'supplier_id'=> $request->supplier_id,
            'shelf_id'=> $request->shelf_id,
            'unit_id'=> $request->unit_id,
            'category_id'=> $request->category_id,
            'product_desc'=> $request->product_desc,
            // 'quantity'=> $request->p_qty,
            'product_image'=> $customName,
            'created_by'=> Auth::user()->id,
            'created_at'=> now(),
        ]);


        if($result){ 
            notyf()->position('x', 'right')->position('y', 'top')->duration(1000)->success('Product Added Successfully!');
        }else{
            notyf()->position('x', 'right')->position('y', 'top')->duration(1000)->error('Product not added!');
        }

        return redirect()->route('product.all');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $supplier = Supplier::all();
        $unit = Unit::all();
        $category = Category::all();
        $shelf = Shelf::all();
        return view('backend.product.product_edit', compact('product', 'supplier', 'unit', 'category', 'shelf'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        // FOR IMAGE
        $customName ="";
        if($request->file('p_image')){
            $file = $request->file('p_image');
            $customName =  date('YmdHi').'.'.$file->getClientOriginalExtension();
            @unlink(public_path('upload/product/'.$product->product_image));
            //Image Intervention Package Use
            $manager = new ImageManager(new Driver());
            $file = $manager->read($file); // File Read
            $file->resize(130, 70)->save('upload/product/'.$customName); // Resize and save

        }else{
            $customName =  $product->product_image;
        }

        $result = Product::findOrFail($id)->update([
            'product_name'=> ucwords($request->productN),
            'supplier_id'=> $request->supplier_id,
            'shelf_id'=> $request->shelf_id,
            'unit_id'=> $request->unit_id,
            'category_id'=> $request->category_id,
            'product_desc'=> $request->product_desc,
            'product_image'=> $customName,
            'updated_by'=> Auth::user()->id,
            'updated_at'=> now(),
        ]);

        if($result){
            sweetalert()->position('x', 'right')->position('y', 'top')->timer(800)->success('Product Updated Successfully!');
        }else{
            sweetalert()->position('x', 'right')->position('y', 'top')->timer(800)->error('Product not Updated!');
        }

        return redirect()->route('product.all');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        @unlink(public_path('upload/product/'.$product->product_image));
        $result = Product::findOrFail($id)->delete();

        if($result){
            notyf()->position('x', 'right')->position('y', 'top')->duration(1000)->success('Product Deleted Successfully!');
        }

        return redirect()->back();
    }
}
