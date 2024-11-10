<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
date_default_timezone_set('Asia/Dhaka');

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('backend.category.category_all', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.category.category_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $result = Category::insert([
            'category_name' => ucfirst($request->cat_name),
            'category_des' => $request->cat_desc,
            'created_by' => Auth::user()->id,
            'created_at'=> now()
        ]);

        if($result){
            sweetalert()->success('Category Added Successfully!');
        }else{
            sweetalert()->error('Category not added!');
        }

        return redirect()->route('category.all');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $result = Category::findOrFail($id)->update([
            'category_name' => ucfirst($request->cat_name),
            'category_des' => $request->cat_desc,
            'updated_by' => Auth::user()->id,
            'updated_at'=> now()
        ]);

        if($result){
            sweetalert()->success('Category Updated Successfully!');
        }else{
            sweetalert()->error('Category not Updated!');
        }

        return redirect()->route('category.all');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = Category::findOrFail($id)->delete();

        if($result){
            sweetalert()->success('Category Deleted Successfully!');
        }else{
            sweetalert()->error('Category not Deleted!');
        }

        return redirect()->route('category.all');
    }
}
