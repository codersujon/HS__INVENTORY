<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;

date_default_timezone_set('Asia/Dhaka');

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::latest()->get();
        return view('backend.supplier.supplier_all', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.supplier.supplier_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $supplier = new Supplier();
        $supplier->supplier_name = ucwords($request->supplierN);
        $supplier->contact_person = ucwords($request->contactP);
        $supplier->mobile_no = $request->mobile_no;
        $supplier->email = $request->email;
        $supplier->city  = ucwords($request->city);
        $supplier->country = $request->country;
        $supplier->website = strtolower($request->website);
        $supplier->address = $request->address;
        $supplier->note = $request->note;
        $result = $supplier->save();

        if($result){
            sweetalert()->timer(800)->success('Supplier Added Successfully!');
        }else{
            sweetalert()->timer(800)->error('Supplier not added!');
        }

        return redirect()->route('supplier.all');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('backend.supplier.single_supplier', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('backend.supplier.supplier_edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $result = Supplier::findOrFail($id)->update([
            'supplier_name' => $request->supplierN,
            'contact_person' => $request->contactP,
            'mobile_no' => $request->mobile_no,
            'email' => $request->email,
            'city' => $request->city,
            'country' => $request->country,
            'website' => strtolower($request->website),
            'address' => $request->address,
            'note' => $request->note,
            'updated_at' => now(),
        ]);


        if($result){
            sweetalert()->timer(800)->success('Supplier Updated Successfully!');
        }else{
            sweetalert()->timer(800)->error('Supplier not Updated!');
        }

        return redirect()->route('supplier.all');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = Supplier::findOrFail($id)->delete();

        if($result){
            notyf()->position('y', 'top')->duration(1000)->success('Supplier Deleted Successfully!');
        }

        return redirect()->back();

    }
}
