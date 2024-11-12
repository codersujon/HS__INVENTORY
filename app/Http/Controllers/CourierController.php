<?php

namespace App\Http\Controllers;

use  App\Models\CourierApi;
use Illuminate\Http\Request;
use Carbon\Carbon;


class CourierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $steadfast = CourierApi::where([
            ['type', '=', 'steadfast'],
            ['status', '=', 1]
        ])->first();
        return view('backend.courier.index', compact('steadfast'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $steadfast = CourierApi::find($id);

        $validation = $request->validate([
            'api_key' => 'required',
            'secret_key' => 'required',
            'url' => 'required',
            'status' => 'required',
        ]);

        if($validation){
            $result = $steadfast->update([
                "api_key" => $request->api_key,
                "secret_key" => $request->secret_key,
                "url" => $request->url,
                "status" => $request->status,
                "updated_at" => Carbon::now()
            ]);

            if($result){
                notyf()->position('y', 'top')->duration(2000)->success('API Added Successfully!');
            }
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
