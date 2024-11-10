<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
date_default_timezone_set('Asia/Dhaka');

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = Unit::latest()->get();
        return view('backend.unit.unit_all', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.unit.unit_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $result = Unit::insert([
            'name' => strtolower($request->unit_name),
            'created_by' => Auth::user()->id,
            'created_at'=> now()
        ]);

        if($result){
            sweetalert()->success('Unit Added Successfully!');
        }else{
            sweetalert()->error('Unit not added!');
        }

        return redirect()->route('unit.all');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $unit = Unit::findOrFail($id);
        return view('backend.unit.unit_edit', compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $result = Unit::findOrFail($id)->update([
            'name' => strtolower($request->unit_name),
            'updated_by' => Auth::user()->id,
            'updated_at'=> now()
        ]);

        if($result){
            sweetalert()->success('Unit Updated Successfully!');
        }else{
            sweetalert()->error('Unit not Updated!');
        }

        return redirect()->route('unit.all');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = Unit::findOrFail($id)->delete();

        if($result){
            sweetalert()->success('Unit Deleted Successfully!');
        }else{
            sweetalert()->error('Unit not Deleted!');
        }

        return redirect()->route('unit.all');
    }
}
