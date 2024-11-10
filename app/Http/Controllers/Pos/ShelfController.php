<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shelf;

class ShelfController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shelves = Shelf::latest()->get();
        return view('backend.shelf.shelves_all', compact('shelves'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.shelf.shelves_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $result = Shelf::insert([
            'shelves_name' => ucfirst($request->shelf_name),
            'capacity' => $request->capacity,
            'description' => $request->description,
            'created_at'=> now()
        ]);

        if($result){
            sweetalert()->timer(800)->success('Shelf Added Successfully!');
        }else{
            sweetalert()->timer(800)->error('Shelf not added!');
        }

        return redirect()->route('shelves.all');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $shelf = Shelf::findOrFail($id);
        return view('backend.shelf.shelves_edit', compact('shelf'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $result = Shelf::findOrFail($id)->update([
            'shelves_name' => ucfirst($request->shelf_name),
            'capacity' => $request->capacity,
            'description' => $request->description,
            'updated_at'=> now()
        ]);

        if($result){
            sweetalert()->timer(800)->success('Shelf Updated Successfully!');
        }else{
            sweetalert()->timer(800)->error('Shelf not Updated!');
        }

        return redirect()->route('shelves.all');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = Shelf::findOrFail($id)->delete();

        if($result){
            notyf()->position('y', 'top')->duration(1000)->success('Shelf Deleted Successfully!');
        }

        return redirect()->back();
    }
}
