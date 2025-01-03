<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShippingCharge;
use Carbon\Carbon;

class ShippingChargeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        return view('backend.shipping.index');
    }

    /**
     * Show Shipping Charges
     */
    public function shippingCharges()
    {
        $shippingcharges = ShippingCharge::all();
        return response()->json([
            'status' => 200,
            'shippingcharges' => $shippingcharges
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $validate = $request->validate([
            'title' => 'required|string|max:255',
            'shipping_charge' => 'required|numeric|min:0'
        ]);

        // Store New Shipping Charge
        $shippingCharge = ShippingCharge::create([
            'title' => $validate['title'],
            'shipping_charge' => $validate['shipping_charge'],
            'status' => 1,
            'created_at' => Carbon::now()
        ]);

        $lastEntry = ShippingCharge::latest()->first();
        $totalRows = ShippingCharge::count();
        return response()->json([
            'status' => 200,
            'message' => 'Shipping charge saved!',
            'shippingcharges' => $lastEntry,
            'totalRows' => $totalRows
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $shippingcharge = ShippingCharge::findOrFail($id);
        return response()->json([
            'status' => 200,
            'data' => $shippingcharge
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $shippingcharge = ShippingCharge::findOrFail($id);

        // Validation
        $validateData = $request->validate([
            'title' => 'required|string|max:255',
            'shipping_charge' => 'required|numeric|min:0',
            'status' => 'required|numeric|in:0,1'
        ]);

        $result = $shippingcharge->update([
            'title' => $validateData['title'],
            'shipping_charge' => $validateData['shipping_charge'],
            'status' => $validateData['status'],
            'updated_at' => Carbon::now()
        ]);

        if($result){
            return response()->json([
                'status' => 200,
                'message' => 'Shipping charge Updated!',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shippingcharge = ShippingCharge::findOrFail($id);
        $result = $shippingcharge->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Shipping Charge Deleted!'
        ]);
    }
}
